<?php
require('mysqli_connect.php');

$q = "SELECT user_id FROM users";
$r = @mysqli_query($dbc, $q);
$num_users = mysqli_num_rows($r);

$q1 = "SELECT time_id FROM times ";
$r1 = @mysqli_query($dbc, $q1);

$q2 = "SELECT time_id FROM times WHERE user_id <> {$_COOKIE['user_id']}";
$r2= @mysqli_query($dbc, $q2);

if (isset($_COOKIE['first_name']) AND isset($_COOKIE['user_id'])) {
	$num_times = mysqli_num_rows($r2);
}else{
	$num_times = mysqli_num_rows($r1);
}

echo '<h3>The current number of users: ' . $num_users . '</h3>';
echo '<h3>The available time slots waiting for you: ' . $num_times . '</h3>';

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

if (isset($_COOKIE['first_name']) AND isset($_COOKIE['user_id'])) {

	if (isset($_POST['submitted'])) {

		echo "<h4>~~~~~~~~~~~~Your Matches~~~~~~~~~~~~</h4>";

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

		if (empty($errors)) {

			$user_id = $_COOKIE['user_id'];

			$q = "INSERT INTO times (begins_date, begins_time, ends_time, tag, user_id) VALUES ('$bd', '$bt', '$et', '$t', $user_id)";

			$r = @mysqli_query($dbc, $q);

			if ($r) {

				// JOIN query to produce matches.
				$query ="
				SELECT user_id, first_name, last_name, email, begins_date, begins_time, ends_time, tag, time_id
				FROM users INNER JOIN times
				USING (user_id)
				WHERE user_id <> '$user_id'
					AND begins_date = '$bd'
				";

				$result = @mysqli_query($dbc, $query);
				
				// count the number of results
				$num = mysqli_num_rows($result);




				if ($num > 0) {
					echo '<h4>' . $num . ' result(s) found.</h4>';
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
					while ($row = mysqli_fetch_array($result)) {
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
					echo '<h3> </h3>';

				} else {
					echo '<h3>No Match Found.</h3>';
				}
				echo '<h4>Can\'t find suitable match? See all!</h4>';
				echo '<a class="btn btn-primary btn-sm" href="alltime.php">Show all</a></h3>';	
			} else {
				echo '<h1>' . mysqli_error($dbc) . '</h1>';
			}
			
		} else {
			foreach($errors as $msg) {
				echo $msg;
			}
		}
	}
} else {
	if (isset($_POST['submitted'])) {
		echo "<h3>Please sign up or log in!</h3>";
		echo "<h4>If you think you are too lazy to sign up,</h4>";
		echo "<h4>try \"john@email.com\" and \"1234567\"</h4>";
	}
}

?>