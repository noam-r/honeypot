<?php

namespace Honeypot;

class RequestData {

	public static function Get() {
		return [
			'ip'=>self::realIp(),
			'proxy'=>self::isProxy(),
			'userAgent'=>self::userAgent()
		];
	}

	private static function realIp() {
		return getenv('HTTP_CLIENT_IP')?:
			getenv('HTTP_X_FORWARDED_FOR')?:
				getenv('HTTP_X_FORWARDED')?:
					getenv('HTTP_FORWARDED_FOR')?:
						getenv('HTTP_FORWARDED')?:
							getenv('REMOTE_ADDR');
	}

	private static function isProxy() {
		$proxy_headers = array(
			'HTTP_VIA',
			'HTTP_X_FORWARDED_FOR',
			'HTTP_FORWARDED_FOR',
			'HTTP_X_FORWARDED',
			'HTTP_FORWARDED',
			'HTTP_CLIENT_IP',
			'HTTP_FORWARDED_FOR_IP',
			'VIA',
			'X_FORWARDED_FOR',
			'FORWARDED_FOR',
			'X_FORWARDED',
			'FORWARDED',
			'CLIENT_IP',
			'FORWARDED_FOR_IP',
			'HTTP_PROXY_CONNECTION'
		);
		foreach($proxy_headers as $header){
			if (isset($_SERVER[$header])) return ['header'=>$header, 'value'=>$_SERVER[$header]];
		}
		return false;
	}

	private static function userAgent() {
		/*  returns array(
					'platform' => '[Detected Platform]',
					'browser'  => '[Detected Browser]',
					'version'  => '[Detected Browser Version]',
				);
		 */
		$ua = parse_user_agent();
		$ua['full']=$_SERVER['HTTP_USER_AGENT'];
		return $ua;
	}

}