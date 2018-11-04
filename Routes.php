<?php
try {

	Flight::route('/', ['Honeypot\Home', 'Show']);

	Flight::route('GET /create', ['Honeypot\\Create', 'Show']);
	Flight::route('POST /create', ['Honeypot\\Create', 'Create']);

	Flight::route('GET /check', ['Honeypot\\Check', 'Show']);
	Flight::route('POST /check', ['Honeypot\\Check', 'Check']);

	Flight::route('/r/@hash:[a-z\-]+', ['Honeypot\\Link', 'Redirect']);

	Flight::route('/validate', ['Honeypot\\Validate', 'Validate']);

	Flight::start();

} catch (Exception $e) {
	//TODO: create nicer errors
	die($e->getMessage());
}