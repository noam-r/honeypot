<?php

namespace Honeypot;

class Link {

	public static function Redirect($hash) {
		$link = Files::getDataFileFromLinkFile($hash, 0);
		if (empty($link)) die ("unknown link");
		$link = base64_decode($link);
		$secret = Files::getDataFileFromLinkFile($hash, 1);
		$requestData = RequestData::Get();
		Record::save($secret, json_encode($requestData));
		//header('HTTP/1.1 302 Found');
		header('Location: '.$link, true, 302);
		exit;
	}

}