<?php
include_once('../config.php');

try {
	$db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8', DB_USER, DB_PASSWORD);
}
catch (Exception $e) {
	echo 'Error: can\'t connect to database';
	exit();
}

function get_db ()
{
	global $db;
	return $db;
}
