<?php

try {
	$db = new PDO(); // HIDDEN
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
