<?php

$page_title = 'Welcome';

include ('includes/header.php');

if (isset($_COOKIE['first_name']) AND isset($_COOKIE['user_id'])) {
	require_once('time_window.php');
}

include ('includes/footer.html');

?>

