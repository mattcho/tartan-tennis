<!DOCTYPE html>
<html>
<head>
	<title><?php echo $page_title ?></title>
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
</div>

<hr />