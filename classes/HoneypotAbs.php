<?php

namespace Honeypot;



class HoneypotAbs {

	protected static function getTemplate() {
		$loader = new \Twig_Loader_Filesystem(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'templates');
		$twig = new \Twig_Environment($loader, [
			'cache' => __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'cache',
			'debug' => $_ENV['DEBUG']
		]);
		return $twig;
	}

}