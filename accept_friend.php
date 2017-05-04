<!-- FAN -->
<!-- accept the friend request -->
<?php
$page_title = 'accept_friend';
include ('includes/header.php');

$friender = $_GET['friender_id'];
$friendee = $_COOKIE['user_id'];


$q = "INSERT INTO friends (friender_id,friendee_id) VALUES ('$friender','$friendee')";
$r = @mysqli_query($dbc, $q);

$qname="SELECT * FROM users WHERE user_id = $friender ";
$rname = @mysqli_query($dbc, $qname);
$rs = mysqli_fetch_array($rname);
	
	echo '<h2>You are friend with ' . $rs['first_name'] . ' now !</h2>';


include('includes/footer.html');

?>