<?php

$page_title = 'Log In';

if (isset($_POST['submitted'])) {

	require_once('includes/login_functions.php');

	require_once('../mysqli_connect.php');

	list ($check, $data) = check_login($dbc, $_POST['email'], $_POST['pass']);

	if ($check) {

		setcookie('user_id', $data['user_id']);
		setcookie('first_name', $data['first_name']);

		$url = absolute_url('loggedin.php');

		header("Location: $url");

		exit();
	} else {

		$errors = $data;
	}

	mysqli_close($dbc);
}

?>

<h1>Log In</h1>
<form action="login.php" method="post">
<p>Email Address: <input type="email" name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" /></p>
<p>Password: <input type="password" name="pass" /></p>
<p><input type="submit" name="submit" value="Log In" /></p>
<input type="hidden" name="submitted" value="TRUE" />
</form>

<?php
include ('includes/footer.html');
?>