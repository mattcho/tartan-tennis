<?php
$page_title = 'Send Message';
include ('includes/header.php');

$user = $_COOKIE['user_id'];
$id = $_GET['receiver_id'];

if (isset($_POST['submitted'])) {

	require_once('mysqli_connect.php');

	$errors = array();

	if (empty($_POST['receiver_id'])&empty($_GET['receiver_id'])) {
		$errors[] = 'You forgot to enter the reveiver.<br />';
	} else {
		$fn = mysqli_real_escape_string($dbc, trim($_POST['receiver_id']));
	}

	if (empty($_POST['title'])) {
		$errors[] = 'You forgot to enter the title.<br />';
	} else {
		$ln = mysqli_real_escape_string($dbc, trim($_POST['title']));
	}

	if (empty($_POST['message'])) {
		$errors[] = 'You forgot to enter message content.<br />';
	} else {
		$mn = mysqli_real_escape_string($dbc, $_POST['message']);
	}

	// If everything is OK...
	if (empty($errors)) {

		$q = "INSERT INTO messages (sender_id, receiver_id, message_title, message_body) VALUES ('$user', '$fn', '$ln', '$mn')";

		$r = @mysqli_query($dbc, $q);

		if ($r) {

			echo '<h1>Thank you!</h1>
			<p>Your message has been sent.</p>';
		} else {
			echo '<h1>' . mysqli_error($dbc) . '</h1>';
		}
		mysqli_close($dbc);

		include('includes/footer.html');
		exit();
	} else {
		foreach($errors as $msg) {
			echo $msg;
		}
	}

	mysqli_close($dbc);
}

?>
<div class="content">
	<h1>Send Message</h1>
	<form action="send_message.php" method="post">
		<p>Receiver: <input type="text" name="receiver_id" value="<?php if (isset($_POST['receiver_id'])) echo $_POST['receiver_id']; else echo $_GET['receiver_id']?>" /></p>
		<p>Title: <input type="text" name="title" value="<?php if (isset($_POST['title'])) echo $_POST['receiver_id']; ?>" /></p>
		<p>Message:</p>
		<p><textarea cols="40" rows="5" id="message" name="message"><?php echo htmlentities($omessage, ENT_QUOTES, 'UTF-8'); ?></textarea></p>
		<p><input type="submit" name="Send" value="Send" /></p>
		<input type="hidden" name="submitted" value="TRUE" />
	</form>
</div>