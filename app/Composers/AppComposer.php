<?php

namespace Gitamin\Composers;


use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Config;

class AppComposer
{

	public function compose(View $view)
	{
		$app = [
			'theme'=> 'default',
			'requrest' => [
				'basepath' => '',
			],
		];
		$owner = 'Gitamin';
		$view->withOwner($owner);
		$view->withApp($app);
	}
}