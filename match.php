<form action='index.php' method='post'>
	<h3>When are you available?</h3>
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

		echo "<h3>Your Matches</h3>";

		require_once('../mysqli_connect.php');

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

			$q = "INSERT INTO time_windows (begins_date, begins_time, ends_time, tag, user_id) VALUES ('$bd', '$bt', '$et', '$t', $user_id)";

			$r = @mysqli_query($dbc, $q);

			if ($r) {

				// JOIN query to produce matches.
				$query ="
				SELECT first_name, last_name, email, begins_date, begins_time, ends_time, tag
				FROM users INNER JOIN time_windows
				USING (user_id)
				WHERE user_id <> '$user_id'
					AND begins_date = '$bd'
				";

				$result = @mysqli_query($dbc, $query);
				
				// count the number of results
				$num = mysqli_num_rows($result);


				if ($num > 0) {
					echo '<h3>' . $num . ' result(s) found.</h3>';
					echo '<table class="table">
							<tr><th>First Name</th><th>Last Name</th><th>Email</th><th>Date</th><th>Begins</th><th>Ends</th><th>Tag</th></tr>';
					while ($row = mysqli_fetch_array($result)) {
						echo '<tr>
						<td>' . $row['first_name'] . '</td>
						<td>' . $row['last_name']. '</td>
						<td>' . $row['email'] . '</td>
						<td>' . $row['begins_date'] . '</td>
						<td>' . $row['begins_time'] . '</td>
						<td>' . $row['ends_time'] . '</td>
						<td>' . $row['tag'] . '</td></tr>';
					}
					echo '</table>';
				} else {
					echo '<h3>No Match Found.</h3>';
				}
				
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
	}
}

?>