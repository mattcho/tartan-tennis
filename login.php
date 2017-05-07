<?php

if (isset($_POST['submitted'])) {

	if (!isset($_POST['username'])) {
		echo '<p class="error">You did not enter your username</p>';
	} else {
		$u = $_POST['username'];
	}

	if (!isset($_POST['pass'])) {
		echo '<p class="error">You did not enter your password</p>';
	} else {
		$p = $_POST['pass'];
	}

	require_once('mysqli_connect.php');

	$q = "SELECT user_id, first_name FROM users WHERE (username='$u' OR email='$u') AND pass=SHA('$p')";

	$r = @mysqli_query($dbc, $q);

	if (mysqli_num_rows($r) == 1) {

		$row = mysqli_fetch_array($r, MYSQLI_ASSOC);

		setcookie('user_id', $row['user_id']);
		setcookie('first_name', $row['first_name']);
		
		$page = 'index.php';
		$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
		$url = rtrim($url, '/\\');
		$url .= '/' . $page;
		
		header("Location: $url");
		exit();
	} else {
		echo 'No such user found.';
	}
	mysqli_close($dbc);
}

$page_title = 'Log In';

include('includes/header.php');

?>

<div class="row">
	<h1>Log In</h1>
	<form action="login.php" method="post">
		<p>Username: <input type="text" name="username" value="<?php if (isset($_POST['username'])) echo $_POST['username']; ?>" /></p>
		<p>Password: <input type="password" name="pass" /></p>
		<p><input type="submit" name="submit" value="Log In" /></p>
		<input type="hidden" name="submitted" value="TRUE" />
	</form>
</div>

<?php
include('includes/footer.html');
?>