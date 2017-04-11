<?php
$url = parse_url("mysql://b6462fd95a3ca6:74cff4fe@us-cdbr-iron-east-03.cleardb.net/heroku_001d354c1fbc833?reconnect=true");

$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);

$conn = new mysqli($server, $username, $password, $db);

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

echo mysqli_get_server_info($conn);

mysqli_close($conn);
?>