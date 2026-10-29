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
use App\Services\ServiceLaunch;
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

        // Token layanan dibuat saat tombol Launch diklik (ServiceLaunchController)
        app(ServiceLaunch::class)->rememberAvailableServices($request, $authUser);

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