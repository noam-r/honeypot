<?php

date_default_timezone_set('UTC');

require __DIR__ . DIRECTORY_SEPARATOR . '..'.DIRECTORY_SEPARATOR.'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

session_start();

try {
	$dotenv = new Dotenv\Dotenv(__DIR__ . DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR);
	$dotenv->load();
	$dotenv->required(['SYSTEM_NAME', 'SYSTEM_ROOT', 'DEBUG']);
} catch (Exception $e) {
	die("Cannot load env file");
}

$_ENV['running']=true;

require_once __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Routes.php';
