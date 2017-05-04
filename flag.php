<!-- FAN -->
<!-- flag the friends who haven't show in the appointment -->
<?php
$page_title = 'flag';
include ('includes/header.php');

$likee = $_GET['likee_id'];
$liker = $_COOKIE['user_id'];

$q = "INSERT INTO likes (bad_like,public_like, private_like, liker_id, likee_id) VALUES (1,0, 0, '$liker', '$likee')";
$r = mysqli_query($dbc, $q);

if($r) {
	echo '<h2>You just successfully flag the user!</h2>';
}

include('includes/footer.html');

?>