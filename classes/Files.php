<?php

namespace Honeypot;

class Files {

	private static $path = __DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."data".DIRECTORY_SEPARATOR;

	public static function saveLink($hash, $link, $secret) {
		return @file_put_contents(self::$path.$hash.'.link', base64_encode($link).PHP_EOL.$secret);
	}

	public static function getDataFileFromLinkFile($hash, $line) {
		//line 0 => link
		//line 1 => data file
		if (false === file_exists(self::$path.$hash.'.link')) return false;
		$file=@file(self::$path.$hash.'.link');
		if (empty($file)) return false;
		return @$file[$line];
	}

	public static function saveDataFile($dataFileHash, $content) {
		return @file_put_contents(self::$path.$dataFileHash.".data", $content.PHP_EOL, FILE_APPEND);
	}

	public static function get($hash) {
		$file = self::read($hash);
		if (empty($file)) return false;
		$lines = self::parse($file);
		return $lines;
	}

	public static function deleteOldFiles() {
		$deletedFiles=['success'=>0, 'failed'=>0];
		if (!isset($_ENV['KEEP_FILES_HOURS']) || $_ENV['KEEP_FILES_HOURS'] <= 1) throw new \Exception("Bad settings");
		$files = glob(self::$path."*");
		if (empty($files)) return 0;
		foreach ($files as $file) {
			if (is_file($file)) {
				if (time() - filemtime($file) >= 3600 * $_ENV['KEEP_FILES_HOURS']) {
					$success = @unlink($file);
					if (false === $success) $deletedFiles['failed']++;
						else $deletedFiles['success']++;
				}
			}
		}
		return $deletedFiles;
	}

	private static function read($hash) {
		if (false === file_exists(self::$path.$hash.'.data')) return false;
		$lines = @file(self::$path.$hash.'.data');
		if (empty($lines)) return false;
		return $lines;
	}

	private static function parse($file) {
		$lines=[];
		foreach($file as $line) {
			$lines[]=Record::read($line);
		}
		return $lines;
	}

}