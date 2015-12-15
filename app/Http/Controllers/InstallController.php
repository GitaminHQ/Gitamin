<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Http\Controllers;

use Gitamin\Models\Setting;
use Gitamin\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class InstallController extends Controller
{
    /**
     * Array of cache drivers.
     *
     * @var string[]
     */
    protected $cacheDrivers = [
        'file' => 'File',
        'memcached' => 'Memcached',
        'redis' => 'Redis',
        'apc' => 'APC(u)',
        'array' => 'Array',
        'database' => 'Database',
    ];

    /**
     * Create a new install controller instance.
     */
    public function __construct()
    {
        $this->beforeFilter('csrf', ['only' => ['postGitamin']]);
    }

    /**
     * Returns the install page.
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        // If we've copied the .env.example file, then we should try and reset it.
        if (strlen(Config::get('app.key')) !== 32) {
            $this->keyGenerate();
        }

        $supportedLanguages = Request::getLanguages();
        $userLanguage = Config::get('app.locale');

        foreach ($supportedLanguages as $language) {
            $language = str_replace('_', '-', $language);

            if (isset($this->langs[$language])) {
                $userLanguage = $language;
                break;
            }
        }

        return View::make('install')
            ->withPageTitle(trans('install.install'))
            ->withCacheDrivers($this->cacheDrivers)
            ->withUserLanguage($userLanguage)
            ->withAppUrl(Request::root());
    }

    /**
     * Handles validation on step one of the install form.
     *
     * @return \Illuminate\Http\Response
     */
    public function postStep1()
    {
        $postData = Request::all();

        $v = Validator::make($postData, [
            'env.cache_driver' => 'required|in:'.implode(',', array_keys($this->cacheDrivers)),
            'env.session_driver' => 'required|in:'.implode(',', array_keys($this->cacheDrivers)),
        ]);

        if ($v->passes()) {
            return Response::json(['status' => 1]);
        }

        return Response::json(['errors' => $v->getMessageBag()], 400);
    }

    /**
     * Handles validation on step two of the install form.
     *
     * @return \Illuminate\Http\Response
     */
    public function postStep2()
    {
        $postData = Request::all();

        $v = Validator::make($postData, [
            'env.cache_driver' => 'required|in:'.implode(',', array_keys($this->cacheDrivers)),
            'env.session_driver' => 'required|in:'.implode(',', array_keys($this->cacheDrivers)),
            'settings.app_name' => 'required',
            'settings.app_domain' => 'required',
            'settings.app_timezone' => 'required',
            'settings.app_locale' => 'required',
        ]);

        if ($v->passes()) {
            return Response::json(['status' => 1]);
        }

        return Response::json(['errors' => $v->getMessageBag()], 400);
    }

    /**
     * Handles the actual app install, including user, settings and env.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function postStep3()
    {
        $postData = Request::all();

        $v = Validator::make($postData, [
            'env.cache_driver' => 'required|in:'.implode(',', array_keys($this->cacheDrivers)),
            'env.session_driver' => 'required|in:'.implode(',', array_keys($this->cacheDrivers)),
            'settings.app_name' => 'required',
            'settings.app_domain' => 'required',
            'settings.app_timezone' => 'required',
            'settings.app_locale' => 'required',
            'user.username' => ['required', 'regex:/\A(?!.*[:;]-\))[ -~]+\z/'],
            'user.email' => 'email|required',
            'user.password' => 'required',
        ]);

        if ($v->passes()) {
            // Pull the user details out.
            $userDetails = array_pull($postData, 'user');

            $user = User::create([
                'username' => $userDetails['username'],
                'email' => $userDetails['email'],
                'password' => $userDetails['password'],
                'level' => 1,
            ]);

            Auth::login($user);

            $settings = array_pull($postData, 'settings');

            foreach ($settings as $settingName => $settingValue) {
                Setting::create([
                    'name' => $settingName,
                    'value' => $settingValue,
                ]);
            }

            $envData = array_pull($postData, 'env');

            // Write the env to the .env file.
            foreach ($envData as $envKey => $envValue) {
                $this->writeEnv($envKey, $envValue);
            }

            Session::flash('install.done', true);

            if (Request::ajax()) {
                return Response::json(['status' => 1]);
            }

            return Redirect::to('dashboard');
        }

        if (Request::ajax()) {
            return Response::json(['errors' => $v->getMessageBag()], 400);
        }

        return Redirect::route('install.index')->withInput()->withErrors($v->getMessageBag());
    }

    /**
     * Writes to the .env file with given parameters.
     *
     * @param string $key
     * @param mixed  $value
     */
    protected function writeEnv($key, $value)
    {
        static $path = null;

        if ($path === null || ($path !== null && file_exists($path))) {
            $path = base_path('.env');
            file_put_contents($path, str_replace(
                env(strtoupper($key)), $value, file_get_contents($path)
            ));
        }
    }

    /**
     * Generate the app.key value.
     */
    protected function keyGenerate()
    {
        $key = str_random(42);

        $path = base_path('.env');

        file_put_contents($path, str_replace(
            Config::get('app.key'), $key, file_get_contents($path)
        ));

        Config::set('app.key', $key);
    }
}
