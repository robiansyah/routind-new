<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Firebase\JWT\JWT;
use App\Models\User;
use DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'email';
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
            'captcha' => 'required',
        ]);
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $key = config('app.key');
        $user = Auth::user();
        $payload = [
            'iss' => config('app.url'),
            'sub' => $user->email,
            'iat' => time(),
            'exp' => time() + 3600 // 1 hour expiration
        ];

        $token = JWT::encode($payload, $key, 'HS256');

        $services = [
            'exam'      => ['db' => 'second_db', 'url' => 'https://exam.routind.com/token-login'],
            'coretax'   => ['db' => 'coretax_db', 'url' => 'https://tax.routind.com/token-login'],
            'elearning' => ['db' => 'elearning_db', 'url' => 'https://elearning.routind.com/token-login'],
        ];

        foreach ($services as $key => $config) {
            // A service that cannot be reached must not block signing in to Routind.
            try {
                $exists = DB::connection($config['db'])
                    ->table('users')
                    ->where('email', $user->email)
                    ->exists();
            } catch (\Throwable $e) {
                report($e);
                $exists = false;
            }

            $request->session()->put($key, $exists);

            if ($exists) {
                $request->session()->put($key . '_url', $config['url'] . '?token=' . $token);
            }
        }

        $this->clearLoginAttempts($request);

        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect()->intended($this->redirectPath());
    }
}
