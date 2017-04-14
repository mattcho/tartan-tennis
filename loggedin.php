<?php

if (!isset($_COOKIE['user_id'])) {
	require_once('includes/login_functions.php');

	$url = absolute_url();

	header("Location: $url");

	exit();
}


$page_title = 'Logged In!';

include('includes/header.php');

echo "<h1>Logged In!</h1>

<p>You are now logged in, {$_COOKIE['first_name']}!</p>";

include('includes/footer.html');


?>