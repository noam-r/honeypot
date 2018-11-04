<?php

namespace Honeypot;


class Home extends HoneypotAbs {

	public static function Show() {
		$template = self::getTemplate();
		echo $template->render('homepage.twig', ['title'=>$_ENV['SYSTEM_NAME']]);
	}

}