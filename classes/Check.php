<?php

namespace Honeypot;

class Check extends HoneypotAbs {

	public static function Show($message='') {
		$_SESSION['checking']='yes';
		$template = self::getTemplate();
		echo $template->render('check.twig', ['title'=>$_ENV['SYSTEM_NAME'], 'message'=>$message]);
	}

	public static function Check() {
		if (!isset($_SESSION['checking']) || $_SESSION['checking'] != 'yes') {
			self::Show('Cannot check key. Have you re-sumbitted the page? Are your cookies enabled? Check and try again.');
			exit;
		}
		unset($_SESSION['checking']);

		$request = \Flight::request();
		$data = $request->data;
		if (isset($data->token) && !empty($data->token)) throw new \Exception("bad request");
		if (false === isset($data->key)) throw new \Exception("bad request");
		$key = trim($data->key);
		if (false === Hash::isValid($key)) {
			self::Show('Key is not valid');
			exit;
		}
		$lines = Files::get($key);
		if (empty($lines)) {
			self::Show('Cannot find key');
			exit;
		}
		$template = self::getTemplate();
		echo $template->render('checked.twig', ['title'=>$_ENV['SYSTEM_NAME'], 'lines'=>$lines, 'key'=>$key]);

	}

}