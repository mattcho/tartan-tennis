<?php
$page_title = 'Read Message';
include ('includes/header.php');
?>
<div class="row">
  <div class="col-md-8">
<?php
$id = $_GET['message_id'];

$q = "SELECT * FROM messages WHERE message_id = $id";

$ra = mysqli_query($dbc, $q);

while ($r = mysqli_fetch_array($ra)) {

	$up = "UPDATE messages SET is_read = 1 WHERE message_id = $id";
	$u = mysqli_query($dbc, $up);

	if($r['message_title']=='Friend Request'){
		echo '<h3>' . $r['message_title'] . '</h3>';
		echo $r['message_body'];
		echo '<h3> </h3>';
		echo '<a class="btn btn-primary btn-sm" href="accept_friend.php?friender_id='
                            . $r['sender_id'] . '">Accept</a>		';
		echo '		<a class="btn btn-primary btn-sm" href="reject_friend.php?receiver_id='
                            . $r['sender_id'] . '">Reject</a>		';
        echo '		<a class="btn btn-primary btn-sm" href="send_message.php?receiver_id='
                            . $r['sender_id'] . '">Send Message</a>';
	}else if($r['message_title']=='Appointment Request'){
		echo '<h3>' . $r['message_title'] . '</h3>';
		echo $r['message_body'];
		echo '<h3> </h3>';
		echo '<a class="btn btn-primary btn-sm" href="accept_appointment.php?poster_id='
                            . $r['sender_id'] . '& message_id='. $id . '">Accept</a>		';
		echo '		<a class="btn btn-primary btn-sm" href="reject_appointment.php?receiver_id='
                            . $r['sender_id'] . '">Reject</a>		';
        echo '		<a class="btn btn-primary btn-sm" href="send_message.php?receiver_id='
                            . $r['sender_id'] . '">Send Message</a>';
	}else{
		echo '<h3>' . $r['message_title'] . '</h3>';
		echo $r['message_body'];
		echo '<h3> </h3>';
		echo '<a class="btn btn-primary btn-sm" href="send_message.php?receiver_id='
                            . $r['sender_id'] . '">Send Message</a>';
	}
}

?>
  </div>
  <div class="col-md-4">
<?php
$q = "SELECT * FROM messages WHERE message_id = $id";

$ra = mysqli_query($dbc, $q);
while ($r = mysqli_fetch_array($ra)) {
	$s = "SELECT first_name FROM users WHERE user_id = {$r['sender_id']}";
	$v = "SELECT first_name FROM users WHERE user_id = {$r['receiver_id']}";
	$sc = mysqli_query($dbc, $s);
	$vc = mysqli_query($dbc, $v);
	while($sr = mysqli_fetch_array($sc)) {
		$sendername = $sr['first_name'];
	}
	while($vr = mysqli_fetch_array($vc)) {
		$receivername = $vr['first_name'];
	}
	echo '<h4>Sender</h4>';
	echo $sendername;
	echo '<h4>Receiver</h4>';
	echo $receivername;
	echo '<h4>Time</h4>';
	echo $r['created_at'];
}

?>  	
  </div>
</div>
<?php

include ('includes/footer.html');

?>
