<?php
$page_title = 'like';
include ('includes/header.php');

$likee = $_GET['likee_id'];
$liker = $_COOKIE['user_id'];

$q = "INSERT INTO likes (public_like, private_like, liker_id, likee_id) VALUES (0, 1, '$liker', '$likee')";
$r = mysqli_query($dbc, $q);

if($r) {
	echo '<h2>You just successfully like the user!</h2>';
}

include('includes/footer.html');

?>