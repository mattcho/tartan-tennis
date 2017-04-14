<!DOCTYPE html>
<html>
<head>
	<title><?php echo $page_title ?></title>
	<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="includes/styles.css">
	<script src="bower_components/jquery/dist/jquery.min.js"></script>
	<script src="includes/scripts.js"></script>
</head>
<body>

<div id="header">
	<h1>Tartan Tennis</h1>
	<h2>Find your tennis partner at CMU!</h2>
</div>

<div id="navigation">
	<ul>
	<li><a href="index.php">Tartan Tennis</a></li>
	<?php
	if (isset($_COOKIE['user_id'])) {
		echo "<li><a href='logout.php'>Log Out</a></li>";
	} else {
		echo "<li><a href='register.php'>Sign Up</a></li>
			  <li><a href='login.php'>Log In</a></li>";
	}
	?>				
	</ul>
	<?php
	if (isset($_COOKIE['first_name'])) {
		echo "<h2>Hi, " . $_COOKIE['first_name'] . "!</h2>";
	}
	?>
</div>

<hr />