<!-- FAN -->
<!-- accept the appointment request -->
<?php
$page_title = 'accept_appoinment';
include ('includes/header.php');

$poster = $_GET['poster_id'];
$message_id = $_GET['message_id'];
$responder = $_COOKIE['user_id'];


$q = "INSERT INTO appointments (poster_id,responder_id) VALUES ('$poster','$responder')";
$r = @mysqli_query($dbc, $q);


$up = "UPDATE appointments SET is_accepted = 1 WHERE message_id = $message_id ";
$u = mysqli_query($dbc, $up);

if($u){
$qname="SELECT * FROM users WHERE user_id = $poster";
$rname = @mysqli_query($dbc, $qname);
$rs = mysqli_fetch_array($rname);
	
	echo '<h2>You accept ' . $rs['first_name'] . '\'s appointment request now !</h2>';
}else{
	echo '<h1>' . mysqli_error($dbc) . '</h1>';
}
include('includes/footer.html');

?>