<!-- FAN -->
<!-- sent the appointment request -->
<?php

// save the message

require('mysqli_connect.php');

$sender_id = $_COOKIE['user_id'];
$receiver_id = $_GET['receiver_id'];
$time_id=$_GET['time_id'];
$begins_date=$_GET['begins_date'];
$begins_time=$_GET['begins_time'];
$ends_time=$_GET['ends_time'];


$message_title = "Appointment Request";
$message_body = "Your friend invite you to play tennis at ". $begins_time . " to " . $ends_time . " on " . $begins_date . ".";

$q = "INSERT INTO messages (sender_id, receiver_id, message_title, message_body) VALUES ('$sender_id', '$receiver_id', '$message_title', '$message_body')";
$r = @mysqli_query($dbc, $q);

$mi="SELECT * FROM messages WHERE sender_id = '$sender_id' AND receiver_id='$receiver_id' AND message_body='$message_body'";
$rm= @mysqli_query($dbc, $mi);
$row = mysqli_fetch_array($rm);
$message_id=$row['message_id'];

$qi="INSERT INTO appointments (poster_id, responder_id, time_id, message_id) VALUES ('$sender_id', '$receiver_id', '$time_id', '$message_id')";
$ri=@mysqli_query($dbc, $qi);

if ($r & $ri) {
	echo '<h1>Your request has been sent!</h1>';
} else {
	echo '<h1>' . mysqli_error($dbc) . '</h1>';
}
mysqli_close($dbc);


?>