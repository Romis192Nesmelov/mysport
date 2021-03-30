<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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

    use RegistersUsers, GoogleCaptchaTrait;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

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
//            'phone' => $this->validationPhone,
            'email' => 'required|string|email|max:255|unique:users',
            'password' => $this->validationPassword,
            'g-recaptcha-response' => 'required|string',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'email' => $data['email'],
//            'phone' => $data['phone'],
            'password' => bcrypt($data['password']),
            'confirm_token' => $this->randString(),
            'active' => false,
            'type' => 3,
            'send_mail' => 1
        ]);
        return $user;
    }

    public function confirmRegistration($token)
    {
        $user = User::where('confirm_token',$token)->first();
        if ($user) {
            $user->active = 1;
            $user->confirm_token = '';
            $user->save();
            Session::flash('message', trans('auth.register_success'));
            Auth::login($user);
        } else Session::flash('message', trans('auth.register_error'));
        return redirect('/profile');
    }

//    public function sendConfirmMail()
//    {
//        return view('auth.send_confirm_mail');
//    }
    
    public function confirmUser(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:users,email',
            'g-recaptcha-response' => 'required|string',
        ]);

        if (!$this->reCapchaRequest($request->input('g-recaptcha-response')))
            return redirect()->back()->withErrors(['g-recaptcha-response' => trans('auth.capcha-error')]);

        $user = User::where('email',$request->input('email'))->first();
        if ($user->active) return back()->withInput()->withErrors(['email' => trans('auth.user_already_active')]);
        $this->sendMessage($user->email, 'auth.emails.registration', ['token' => $user->confirm_token]);
        return redirect('/')->with('message', trans('auth.check_your_mail'));
    }
}
