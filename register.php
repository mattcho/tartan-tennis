<?php

$page_title = 'Register';

include ('includes/header.php');

if (isset($_POST['submitted'])) {

	require_once('mysqli_connect.php');

	$errors = array();

	if (empty($_POST['first_name'])) {
		$errors[] = 'You forgot to enter your first name.<br />';
	} else {
		$fn = mysqli_real_escape_string($dbc, trim($_POST['first_name']));
	}

	if (empty($_POST['last_name'])) {
		$errors[] = 'You forgot to enter your last name.<br />';
	} else {
		$ln = mysqli_real_escape_string($dbc, trim($_POST['last_name']));
	}

	if (empty($_POST['username'])) {
		$errors[] = 'You forgot to enter your username.<br />';
	} else {
		$u = mysqli_real_escape_string($dbc, trim($_POST['username']));
	}

	if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter your email address.<br />';
	} else {
		$e = mysqli_real_escape_string($dbc, trim($_POST['email']));
	}

	if (!empty($_POST['pass1'])) {
		if ($_POST['pass1'] != $_POST['pass2']) {
			$errors[] = 'Your password did not match the confirmed password.<br />';
		} else {
			$p = mysqli_real_escape_string($dbc, trim($_POST['pass1']));
		}
	} else {
		$errors[] = 'You forgot to enter your password.<br />';
	}

	// If everything is OK...
	if (empty($errors)) {

		$q = "INSERT INTO users (first_name, last_name, username, email, pass) VALUES ('$fn', '$ln', '$u', '$e', SHA1('$p'))";

		$r = @mysqli_query($dbc, $q);

		if ($r) {

			echo '<h1>Thank you!</h1>
			<p>Your are now registered. You can <a href="login.php">log in</a>.</p>';
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

<h1>Register</h1>
<form action="register.php" method="post">
<p>First Name: <input type="text" name="first_name" value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>" /></p>
<p>Last Name: <input type="text" name="last_name" value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>" /></p>
<p>Username: <input type="username" name="username" value="<?php if (isset($_POST['username'])) echo $_POST['username']; ?>" /></p>
<p>Email Address: <input type="email" name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" /></p>
<p>Password: <input type="password" name="pass1" /></p>
<p>Confirm Password: <input type="password" name="pass2" /></p>
<p><input type="submit" name="submit" value="Resister" /></p>
<input type="hidden" name="submitted" value="TRUE" />
</form>

<?php
include ('includes/footer.html');
?>