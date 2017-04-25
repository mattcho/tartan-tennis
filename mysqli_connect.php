<?php

// Flag true if ready for production.
DEFINE('LIVE', false);

// Heroku ClearDB MySQL URL
$url = parse_url("mysql://b6462fd95a3ca6:74cff4fe@us-cdbr-iron-east-03.cleardb.net/heroku_001d354c1fbc833?reconnect=true");

if (LIVE) {
	DEFINE('DB_USER', $url["user"]);
	DEFINE('DB_PASSWORD', $url["pass"]);
	DEFINE('DB_HOST', $url["host"]);
	DEFINE('DB_NAME', substr($url["path"], 1));
} else {

	// Change this according to MySQL configuration on your local environment
	DEFINE('DB_USER', 'root');
	DEFINE('DB_PASSWORD', 'root');
	DEFINE('DB_HOST', 'localhost');
	DEFINE('DB_NAME', 'tartan_tennis');	
}

$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die('Could not connect to MySQL: ' . mysqli_connect_error());

?>