<?php
require 'lib/openplatform.php';

$request = explode('?', $_SERVER['REQUEST_URI'], 2);

if(!isset($_GET["openplatform"])) {
	show_401();
	exit;
}

switch ($request[0]) {
	case '/api/logoff/':
		// Here you could remove user session
		echo true;
		break;
    case '/' :
	case '' :

		$op_url = htmlspecialchars($_GET["openplatform"]);
		$op = new Openplatform;

		$user = $op->authorization($op_url);

		if($user) {
        	require __DIR__ . '/views/home.php';
		} else {
			show_401();
		}
        break;
    default:
        show_401();
        break;
}

function show_401() {
    header("HTTP/1.1 401 Unauthorized");
	require __DIR__ . '/views/401.php';
}