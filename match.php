<?php

echo '<h4 class="patterns">Empty States, Expandable Inputs, Stats/Dashboard</h4>';

if (!$is_loggedin) {
	$q = "SELECT user_id FROM users";
	$r = @mysqli_query($dbc, $q);
	$num_users = mysqli_num_rows($r);
	echo '<p>Hi, there. We have ' . $num_users . ' users in our platform. Please sign up or log in.</p>';
	echo '<p>For those who are lazy, try username: johnd@email.com password: 123</p>';
} else {
	$q = "SELECT user_id FROM users WHERE user_id <> {$_COOKIE['user_id']}";
	$r = @mysqli_query($dbc, $q);
	$num_users = mysqli_num_rows($r);
	echo '<p>Hi, ' . $fn . '. You have ' . $num_users . ' other users in our platform. Find your partner!</p>';

	$q = "SELECT time_id FROM times
	WHERE user_id <> {$_COOKIE['user_id']}
	AND begins_date >= GETDATE(NOW())";

	if (!$r) {
		$r = @mysqli_query($dbc, $q);
		$num_times = mysqli_num_rows($r);
		echo '<p>The available time slots waiting for you: ' . $num_times . '</p>';
	} else {
		echo '<p>Currently, no available time slots waiting for you.</p>';
		echo '<p>Add your own available time and wait!</p>';
	}	
}

?>

<form action='index.php' method='post'>
	<p>
		<input id='date' type='date' name='begins_date'>
		<input id='begins_time' type='time' name='begins_time' step='900' value='13:00'>
		<input id='ends_time' type='time' name='ends_time' step='900' value='14:00'>
		<input id='tag' type='text' name='tag' placeholder="Tag">
	</p>
	<input type="hidden" name="submitted" value="TRUE" />
	<input type='submit'>
</form>

<?php

echo '<hr />';
echo '<h4 class="patterns">Action Context</h4>';
echo '<h4>Your Matches</h4>';


if (!$is_loggedin) {
	echo '<p>You can find your matches after logging in!</p>';
}

if (!isset($_POST['submitted'])) {
	echo '<p>You can find your matches once you input your availability above.</p>';
	
} else {

	$errors = array();

	if (empty($_POST['begins_date'])) {
		$errors[] = 'You forgot to enter your available date.<br />';
	} else {
		$bd = mysqli_real_escape_string($dbc, trim($_POST['begins_date']));
	}

	if (empty($_POST['begins_time'])) {
		$errors[] = 'You forgot to enter your available time.<br />';
	} else {
		$bt = mysqli_real_escape_string($dbc, trim($_POST['begins_time']));
	}

	if (empty($_POST['ends_time'])) {
		$errors[] = 'You forgot to enter how long you would like to play.<br />';
	} else {
		$et = mysqli_real_escape_string($dbc, trim($_POST['ends_time']));
	}

	if (empty($_POST['tag'])) {
		$errors[] = 'You forgot to enter tag.<br />';
	} else {
		$t = mysqli_real_escape_string($dbc, trim($_POST['tag']));
	}

	if (!empty($errors)) {
		foreach($errors as $msg) {
			echo $msg;
		}
	} else {
		$q = "INSERT INTO times (begins_date, begins_time, ends_time, tag, user_id) VALUES ('$bd', '$bt', '$et', '$t', '$user_id')";

		$r = @mysqli_query($dbc, $q);

		if (!$r) {

			echo '<p class="error">' . mysqli_error($dbc) . '</p>';

		} else {

			$q = "SELECT user_id, first_name, last_name, email, begins_date, begins_time, ends_time, tag, time_id
FROM users INNER JOIN times USING (user_id)
WHERE user_id <> '$user_id' AND begins_date = '$bd' AND begins_time = '$bt'";

			$r = @mysqli_query($dbc, $q);


			if (!$r || mysqli_num_rows($r) == 0) {

				echo '<p>No match found.</p>';

			} else {
				echo '<table class="table">
				<tr>
					<th>Name</th>
					<th>Email</th>
					<th>Date</th>
					<th>Begins</th>
					<th>Ends</th>
					<th>Tag</th>
					<th>Dashboard</th>
					<th>Friend Request</th>
					<th>Match Request</th>
					<th>Like this guy!</th>
				</tr>';

				while ($row = mysqli_fetch_array($r)) {
					$likeq = "SELECT * FROM likes WHERE likee_id = {$row['user_id']}";
					$liker = mysqli_query($dbc, $likeq);
					$num_like = mysqli_num_rows($liker);
					echo
					'<tr>
						<td>' . $row['first_name'] . ' ' . $row['last_name'] . '</td>
						<td>' . $row['email'] . '</td>
						<td>' . $row['begins_date'] . '</td>
						<td>' . $row['begins_time'] . '</td>
						<td>' . $row['ends_time'] . '</td>
						<td>' . $row['tag'] . '</td>
						<td><a class="btn btn-primary btn-sm"
						a href="dashboard.php?profile_id='
						. $row['user_id'] . '& user='. $_COOKIE['user_id'] . '">Dashboard</a></td>

						<td><a class="btn btn-primary btn-sm" href="friend_request.php?receiver_id='
						. $row['user_id'] . '">Let\'s know</a></td>

						<td><a class="btn btn-primary btn-sm" href="appoinment_request.php?receiver_id='
						. $row['user_id'] . '& time_id='. $row['time_id'] . '& begins_date='. $row['begins_date'] . '& begins_time=' . $row['begins_time'] . '& ends_time=' . $row['ends_time'] . '">Let\'s play</a></td>

						<td><a class="btn btn-primary btn-sm" href="like.php?likee_id='
						. $row['user_id'] . '">Like</a>' . $num_like . '</td>
					</tr>';
				}

				echo '</table>';

			} // end of if (!$r || mysqli_num_rows($r) == 0) {} else
		} // end of if (!$r) {} else		
	} // end of if (!empty($errors)) {} else
}
?>