<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Hei;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
            'hei_uii' => ['required', 'string', 'max:50'],
            'fhe_focal_lname' => ['required', 'string', 'max:255'],
            'fhe_focal_fname' => ['required', 'string', 'max:255'],
            'fhe_focal_mname' => ['required', 'string', 'max:255'],
            'contact_number' => 'required|regex:/^(09)\d{9}$/',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
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
    $hei = Hei::where('hei_uii', $data['hei_uii'])->first();

    if (!$hei) {
        $message = 'HEI with the given hei_uii does not exist.';
        $script = "swal('Error', '$message', 'error').then(() => { window.history.back(); });";
        return redirect()->back()->withErrors(['script' => $script]);
    }

    $user = User::create([
        'hei_sid' => $hei->hei_sid,
        'hei_uii' => $data['hei_uii'],
        'fhe_focal_lname' => $data['fhe_focal_lname'],
        'fhe_focal_fname' => $data['fhe_focal_fname'],
        'fhe_focal_mname' => $data['fhe_focal_mname'],
        'contact_no' => $data['contact_number'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'is_admin' => false,
    ]);

    return $user;
}
}
