<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SocialAccount;
use App\Models\User;
use App\Models\RoleUser;
use App\Models\Profile;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Hash;
use Firebase\JWT\JWT;
use DB;
use Illuminate\Support\Facades\Log;
use Exception;

class SocialiteController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProvideCallback(Request $request, $provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->stateless()->user();
        } catch (Exception $e) {
            Log::error("Socialite {$provider} login failed: " . $e->getMessage());
            return redirect()->back();
        }
        // find or create user and send params user get from socialite and provider
        $authUser = $this->findOrCreateUser($socialUser, $provider);

        // login user
        if($authUser=='error'){
            return redirect()->route('login');
        }
        Auth()->login($authUser, true);
        //session
        $request->session()->regenerate();

        $key = config('app.key');
        $user = User::where('email', $socialUser->getEmail())->first();
        $payload = [
            'iss' => config('app.url'),
            'sub' => $user->email,
            'iat' => time(),
            'exp' => time() + 3600 // 1 hour expiration
        ];

        $token = JWT::encode($payload, $key, 'HS256');

        $exam_cek = DB::connection('second_db')
            ->table('users')
            ->where('email', $user->email)
            ->first();
        $exam = (bool)$exam_cek;
        $request->session()->put('exam', $exam);
        if($exam){
            $examUrl = 'https://exam.routind.com/token-login?token='.$token;
            $request->session()->put('exam_url', $examUrl);
        }

        $coretax_cek = DB::connection('coretax_db')
            ->table('users')
            ->where('email', $user->email)
            ->first();
        $coretax = (bool)$coretax_cek;
        $request->session()->put('coretax', $coretax);

        if($coretax){
            $coretaxUrl = 'https://tax.routind.com/token-login?token='.$token;
            $request->session()->put('coretax_url', $coretaxUrl);
        }

        // E-Learning: jika database tidak bisa diakses, login Routind tetap berjalan
        try {
            $elearning = DB::connection('elearning_db')
                ->table('users')
                ->where('email', $user->email)
                ->exists();
        } catch (Exception $e) {
            report($e);
            $elearning = false;
        }
        $request->session()->put('elearning', $elearning);

        if($elearning){
            $elearningUrl = 'https://elearning.routind.com/token-login?token='.$token;
            $request->session()->put('elearning_url', $elearningUrl);
        }

        // setelah login redirect ke dashboard
        return redirect()->route('home');
    }

    public function findOrCreateUser($socialUser, $provider)
    {
        // Get Social Account
        $socialAccount = SocialAccount::where('provider_id', $socialUser->getId())
            ->where('provider_name', $provider)
            ->first();

        // Jika sudah ada
        if ($socialAccount) {
            // return user
            return $socialAccount->user;

            // Jika belum ada
        } else {

            // User berdasarkan email
            $user = User::where('email', $socialUser->getEmail())->first();

            // Jika Tidak ada user
            if (!$user) {
//                // Create user baru
//                $npwp = IdGenerator::generate(['table' => 'users','field'=>'npwp', 'length' => 16, 'prefix' => '183573002']);
//                $nik = IdGenerator::generate(['table' => 'users','field'=>'username', 'length' => 16, 'prefix' => '293573001']);
//                $user = User::create([
//                    'name' => $socialUser->getName(),
//                    'username' => $nik,
//                    'npwp' => $npwp,
//                    'email' => $socialUser->getEmail(),
//                    'password' => Hash::make($nik),
//                    'email_verified_at' => date('Y-m-d H:i:s'),
//                ]);
//
//                RoleUser::create([
//                    'user_id' => $user->id,
//                    'role_id' => 2,
//                ]);
//
//                Profile::create([
//                    'user_id' => $user->id,
//                    'corporate_name' => 'PT. '.$socialUser->getName(),
//                ]);
                return "error";
            }

            // Buat Social Account baru
            $user->socialAccounts()->create([
                'provider_id'   => $socialUser->getId(),
                'provider_name' => $provider
            ]);

            // return user
            return $user;
        }
    }
}