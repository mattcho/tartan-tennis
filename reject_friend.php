<!-- FAN -->
<!-- reject the friend request -->
<?php
$page_title = 'reject_friend';
include ('includes/header.php');
require('mysqli_connect.php');

$sender_id = $_COOKIE['user_id'];
$receiver_id = $_GET['receiver_id'];

$qname="SELECT * FROM users WHERE user_id = $receiver_id";
$r = @mysqli_query($dbc, $qname);
$rs = mysqli_fetch_array($r);

$sname="SELECT * FROM users WHERE user_id = $sender_id";
$s = @mysqli_query($dbc, $sname);
$ss = mysqli_fetch_array($s);

$message_title = "Reject Friend Request";
$message_body = "" . $ss['first_name'] . " reject your friend request.";


$q = "INSERT INTO messages (sender_id, receiver_id, message_title, message_body) VALUES ('$sender_id', '$receiver_id', '$message_title', '$message_body')";

$r = @mysqli_query($dbc, $q);

if ($r) {
	echo '<h1>You reject ' . $rs['first_name'] . '\'s friend request !</h1>';
} else {
	echo '<h1>' . mysqli_error($dbc) . '</h1>';
}
mysqli_close($dbc);




include('includes/footer.html');

?>