<!DOCTYPE html>
<html>
<head>
	<title><?php echo $page_title ?></title>
	<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="includes/styles.css">
	<script src="bower_components/jquery/dist/jquery.js"></script>
	<script src="includes/scripts.js"></script>
</head>
<body>

<div class="container">

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">Tartan Tennis</a>
    </div>
    <ul class="nav navbar-nav navbar-right">
<?php

require('mysqli_connect.php');

$q = "SELECT message_id FROM messages WHERE receiver_id={$_COOKIE['user_id']} AND is_read = 0";

$r = @mysqli_query($dbc, $q);

$num = mysqli_num_rows($r);

if (isset($_COOKIE['user_id']) AND isset($_COOKIE['first_name'])) {
	echo "<li><a href='index.php'>Hi, " . $_COOKIE['first_name'] . "</a></li>";
	//echo "<li><a href='message.php'>New Message ($num)</a></li>";
	if($num > 0) {
		echo "<li><a href='message.php'>New Message ($num)</a></li>";
	} else {
		echo "<li><a href='message.php'>Message</a></li>";
	}
	echo "<li><a href='logout.php'>Log Out</a></li>";
} else {
	echo "<li><a href='register.php'>Sign Up</a></li><li><a href='login.php'>Log In</a></li>";
}
?>	
    </ul>
  </div>
</nav>