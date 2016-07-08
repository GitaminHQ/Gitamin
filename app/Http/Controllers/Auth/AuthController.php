<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Http\Controllers\Auth;

use AltThree\Validator\ValidationException;
use Gitamin\Commands\Identity\AddIdentityCommand;
use Gitamin\Http\Controllers\Controller;
use Gitamin\Models\Identity;
use Gitamin\Models\Provider;
use Gitamin\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;
use Validator;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logout', 'getLogout']]);
    }

    public function getLogin()
    {
        $providers = Provider::orderBy('created_at', 'desc')->get();

        return View::make('auth.login')
            //->withCaptchaLoginDisabled(Config::get('setting.captcha_login_disabled'))
            ->withCaptcha(route('captcha', ['random' => time()]))
            ->withConnectData(Session::get('connect_data'))
            ->withProviders($providers)
            ->withPageTitle(trans('dashboard.login.login'));
    }

    /**
     * Logs the user in.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postLogin()
    {
        $userData = Input::only(['login', 'password', 'verifycode']);

        $verifycode = array_pull($userData, 'verifycode');
        if ($verifycode != Session::get('phrase')) {
            // instructions if user phrase is good
            return Redirect::to('auth/login')
            ->withInput(Input::except('password'))
            ->withErrors(trans('gitamin.captcha.failure'));
        }
        // Login with username or email.
        $loginKey = Str::contains($userData['login'], '@') ? 'email' : 'username';
        $userData[$loginKey] = array_pull($userData, 'login');

        // Validate login credentials.
        if (Auth::validate($userData)) {

            // We probably want to add support for "Remember me" here.
            Auth::attempt($userData, false);

            if (Session::has('connect_data')) {
                $connect_data = Session::get('connect_data');
                dispatch(new AddIdentityCommand(Auth::user()->id, $connect_data));
            }

            return Redirect::intended('/')
                ->withSuccess(sprintf('%s %s', trans('gitamin.awesome'), trans('gitamin.login.success')));
        }

        return redirect('/auth/login')
            ->withInput(Input::except('password'))
            ->withErrors(trans('gitamin.login.invalid'));
    }

    public function getRegister()
    {
        return View::make('auth.register')
            ->withCaptcha(route('captcha', ['random' => time()]))
            ->withPageTitle(trans('dashboard.login.register'));
    }

    public function postRegister()
    {
        $userData = Input::only(['username', 'email', 'password', 'password_confirmation', 'verifycode']);

        $verifycode = array_pull($userData, 'verifycode');

        try {
            $user = $this->create($userData);
        } catch (ValidationException $e) {
            return Redirect::to('auth/register')
                ->withTitle(sprintf('%s %s', trans('gitamin.whoops'), trans('gitamin.users.add.failure')))
                ->withInput(Input::all())
                ->withErrors($e->getMessageBag());
        }

        Auth::guard($this->getGuard())->login($user);

        return redirect($this->redirectPath());
    }

    public function provider($slug)
    {
        return Socialite::with($slug)->redirect();
    }

    public function callback($slug)
    {
        if (Input::has('code')) {
            $provider = Provider::where('slug', '=', $slug)->firstOrFail();
            try {
                $extern_user = Socialite::with($slug)->user();
            } catch (InvalidStateException $e) {
                return Redirect::to('/auth/login')
                    ->withErrors(['授权失效']);
            }

            //检查是否已经连接过
            $identity = Identity::where('provider_id', '=', $provider->id)->where('extern_uid', '=', $extern_user->id)->first();

            if (is_null($identity)) {
                Session::put('connect_data', ['provider_id' => $provider->id, 'extern_uid' => $extern_user->id, 'nickname' => $extern_user->nickname]);

                return Redirect::to('/auth/landing');
            }
            //已经连接过，找出user_id, 直接登录
            $user = User::find($identity->user_id);

            if (!Auth::check()) {
                Auth::login($user, true);
                //event(new UserWasLoggedinEvent($user));
            }

            return Redirect::to('/')
            ->withSuccess(sprintf('%s %s', trans('gitamin.awesome'), trans('gitamin.login.success_oauth', ['provider' => $provider->name])));
        }
    }

    public function landing()
    {
        return View::make('auth.landing')
            ->withConnectData(Session::get('connect_data'))
            ->withPageTitle('');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username'     => 'required|max:255',
            'email'        => 'required|email|max:255|unique:users',
            'password'     => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     *
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'username'     => $data['username'],
            'email'        => $data['email'],
            'password'     => bcrypt($data['password']),
        ]);
    }
}
