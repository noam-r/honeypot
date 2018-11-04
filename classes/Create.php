<?php

namespace Honeypot;

class Create extends HoneypotAbs {

	public static function Show($message='') {
		$_SESSION['created']='yes';
		$template = self::getTemplate();
		echo $template->render('create.twig', ['title'=>$_ENV['SYSTEM_NAME'], 'message'=>$message]);
	}

	public static function Created($link, $secret) {
		$template = self::getTemplate();
		echo $template->render('created.twig', ['title'=>$_ENV['SYSTEM_NAME'], 'link'=>$link, 'secret'=>$secret]);
	}

	public static function Create() {
		if (!isset($_SESSION['created']) || $_SESSION['created'] != 'yes') {
			self::Show('Cannot create link. Have you re-sumbitted the page? Are your cookies enabled? Check and try again.');
			exit;
		}
		unset($_SESSION['created']);

		$request = \Flight::request();
		$data = $request->data;
		if (isset($data->token) && !empty($data->token)) throw new \Exception("bad request");
		if (false === isset($data->link)) throw new \Exception("bad request");
		$link = $data->link;
		if (false === filter_var($link, FILTER_VALIDATE_URL)) {
			self::Show('Invalid URL provided');
			exit;
		}
		$hash = Hash::Create();
		$secret = Hash::Create();
		if (false === Files::saveLink($hash, $link, $secret)) {
			self::Show('Cannot create link, please contact the admin');
			exit;
		}

		if (false === Record::save($secret, 'created')) {
			self::Show('Cannot create secret, please contact the admin');
			exit;
		}

		$link = $_ENV['SYSTEM_ROOT']."r/".$hash;

		self::Created($link, $secret);

	}

}