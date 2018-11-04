<?php

date_default_timezone_set('UTC');

require __DIR__ . DIRECTORY_SEPARATOR . '..'.DIRECTORY_SEPARATOR.'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

try {
	$dotenv = new Dotenv\Dotenv(__DIR__ . DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR);
	$dotenv->load();
	$dotenv->required(['SYSTEM_NAME', 'SYSTEM_ROOT', 'DEBUG']);
} catch (Exception $e) {
	die("Cannot load env file");
}

try {
	$deletedFiles = Honeypot\Files::deleteOldFiles();
	echo $deletedFiles['success']." successfully deleted ; ".$deletedFiles['failed']." failed to delete\n";
} catch (Exception $e) {
	die ("ERROR: ".$e->getMessage()."\n");
}

echo "Done\n";