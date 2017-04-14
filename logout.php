<?php

if (!isset($_COOKIE['user_id'])) {

	require_once('includes/login_functions.php');

	$url = absolute_url();

	header("Location: $url");

	exit();
} else {
	setcookie('user_id', '');
	setcookie('first_name', '');
}

$page_title = 'Logged Out!';

include('includes/header.php');

echo "<h1>Logged Out!</h1>
<p>You are now logged out, {$_COOKIE['first_name']}!</p>";

include('includes/footer.html');
?>