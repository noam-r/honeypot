<?php

namespace Honeypot;

class Record {

	public static function save($filename, $message) {
		Files::saveDataFile($filename, self::line($message));
	}

	public static function read($encodedLine) {
		$line = @base64_decode($encodedLine);
		if (empty($line)) return false;
		$parts = @explode(' | ', $line, 2);
		$content =@json_decode(@$parts[1], true);
		if (empty($content)) $content=@$parts[1];
		return [
			'time'=>@$parts[0],
			'content'=>$content
		];
	}

	private static function line($message) {
		$now = new \DateTime();
		return base64_encode($now->format('Y-m-d H:i:s')." | ".$message);
	}

}