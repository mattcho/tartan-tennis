<?php
$url = parse_url("mysql://b6462fd95a3ca6:74cff4fe@us-cdbr-iron-east-03.cleardb.net/heroku_001d354c1fbc833?reconnect=true");

$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);

$conn = new mysqli($server, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
	echo "Connection successful!";
} 

mysqli_close($conn);
?>