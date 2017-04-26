<?php

// save the message

require('mysqli_connect.php');

$sender_id = $_COOKIE['user_id'];
$receiver_id = $_GET['receiver_id'];
$message_title = "Friend Request";
$message_body = "This is your friend request.";

$q = "INSERT INTO messages (sender_id, receiver_id, message_title, message_body) VALUES ('$sender_id', '$receiver_id', '$message_title', '$message_body')";

$r = @mysqli_query($dbc, $q);

if ($r) {
	echo '<h1>Your request has been sent!</h1>';
} else {
	echo '<h1>' . mysqli_error($dbc) . '</h1>';
}
mysqli_close($dbc);


?>