<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\RoleUser;
use App\Models\Profile;
use App\Models\Referral;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile_phone' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'captcha' => ['required','captcha'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $npwp = IdGenerator::generate(['table' => 'users','field'=>'npwp', 'length' => 16, 'prefix' => '183573002']);
        $nik = IdGenerator::generate(['table' => 'users','field'=>'username', 'length' => 16, 'prefix' => '293573001']);
        $ref = strtoupper($data['referral']);
        $cek = Referral::where([['code', $ref],['start_date', '<=', date('Y-m-d')], ['end_date', '>=', date('Y-m-d')]])->first();
        $user = User::create([
            'name' => $data['name'],
            'username' => $nik,
            'npwp' => $npwp,
            'email' => $data['email'],
            'mobile_phone' => $data['mobile_phone'],
            'password' => Hash::make($data['password']),
            'paket' => ($cek) ? 'premium' : null,
            'end_date' => ($cek) ? date("Y-m-d", strtotime("+".$cek->length." days")) : null,
            'referral_code' => $ref,
        ]);

        RoleUser::create([
            'user_id' => $user->id,
            'role_id' => 2,
        ]);

        Profile::create([
            'user_id' => $user->id,
            'corporate_name' => 'PT. '.$data['name'],
        ]);

        return $user;

    }
}
