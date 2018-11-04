<?php

namespace Honeypot;

class Validate {

	private static $requiredDirectories = ['cache', 'data'];

	public static function Validate() {
		try {
			$dirs = self::directories();
		} catch (\Exception $e) {
			//TODO: make a nicer error show
			die ($e->getMessage());
		}
		die ("All is well");
	}

	private static function directories() {
		foreach (self::$requiredDirectories as $directory) {
			if (false === file_exists(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.$directory)) throw new \Exception("directory ".$directory." does not exists");
			if (false === is_writable(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.$directory)) throw new \Exception("directory ".$directory." is not writable");
		}
		return true;
	}

}