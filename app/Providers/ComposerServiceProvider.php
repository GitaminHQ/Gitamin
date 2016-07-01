<?php

namespace Gitamin\Providers;

use Gitamin\Composers\AppComposer;


use Illuminate\Contracts\View\Factory;
use Illuminate\Support\ServiceProvider;


class ComposerServiceProvider extends ServiceProvider
{

	public function boot(Factory $factory)
	{
		$factory->composer('*', AppComposer::class);
	}


	public function register()
	{
		//
	}

}