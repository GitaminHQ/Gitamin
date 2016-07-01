<?php

namespace Gitamin\Services\TwigBridge\Extensions;

use Twig_Extension;
use Twig_SimpleFunction;
use Twig_SimpleFilter;

class Avatar extends Twig_Extension
{
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'TwigBridge_Extension_Avatar';
    }


   /**
     * Dodatkowe filtry Twig zwiazane z formatowaniem danych uzytkownika
     *
     * @return Twig_SimpleFilter[]
     */
    public function getFunctions()
    {
        return [

            new Twig_SimpleFunction(
            	'avatar', function($email,$size){
            		return $this->getUserAvatar($email,$size);
            	}
            ),
        ];
    }

    protected function getUserAvatar($email, $size)
    {
    	$url = "//gravatar.com/avatar/";
		$query = ["s=$size"];
		$id = md5(strtolower($email));
        return $url . $id . "?" . implode('&', $query);
    }
}