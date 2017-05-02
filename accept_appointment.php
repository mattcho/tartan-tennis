<!-- FAN -->
<!-- accept the appointment request -->
<?php
$page_title = 'accept_appoinment';
include ('includes/header.php');

$poster = $_GET['poster_id'];
$responder = $_COOKIE['user_id'];


$q = "INSERT INTO appointments (poster_id,responder_id) VALUES ('$poster','$responder')";
$r = @mysqli_query($dbc, $q);

$qname="SELECT * FROM users WHERE user_id = $poster";
$rname = @mysqli_query($dbc, $qname);
$rs = mysqli_fetch_array($rname);
	
	echo '<h2>You accept ' . $rs['first_name'] . '\'s appointment request now !</h2>';

include('includes/footer.html');

?>