<!-- FAN -->
<!-- sent the appointment request -->
<?php

// save the message

require('mysqli_connect.php');

$sender_id = $_COOKIE['user_id'];
$receiver_id = $_GET['receiver_id'];

$begins_date=$_GET['begins_date'];
$begins_time=$_GET['begins_time'];
$ends_time=$_GET['ends_time'];

$message_title = "Appointment Request";
// $message_body = 'Your friend invite you to play tennis at'. $begins_time . ' to ' . $ends_time . ' on ' . $begins_date . '.';
$message_body = "Your friend invite you to play tennis at ". $begins_time . " to " . $ends_time . " on " . $begins_date . ".";

$q = "INSERT INTO messages (sender_id, receiver_id, message_title, message_body) VALUES ('$sender_id', '$receiver_id', '$message_title', '$message_body')";

$r = @mysqli_query($dbc, $q);

if ($r) {
	echo '<h1>Your request has been sent!</h1>';
} else {
	echo '<h1>' . mysqli_error($dbc) . '</h1>';
}
mysqli_close($dbc);


?>