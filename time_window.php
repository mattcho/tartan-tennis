<?php

if (isset($_POST['submitted'])) {

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
		$ed = mysqli_real_escape_string($dbc, trim($_POST['begins_time']));
	}

	if (empty($_POST['duration'])) {
		$errors[] = 'You forgot to enter how long you would like to play.<br />';
	} else {
		$d = mysqli_real_escape_string($dbc, trim($_POST['duration']));
	}

	if (empty($errors)) {

		$ends_time = $ed + ($d * 60);
		$user_id = $_COOKIE['user_id'];

		$q = "INSERT INTO time_windows (begins_date, begins_time, ends_time, user_id) VALUES ('$bd', '$ed', '$ends_time', $user_id)";

		$r = @mysqli_query($dbc, $q);

		if ($r) {

			$result = @mysqli_query($dbc, "SELECT * FROM time_windows WHERE user_id=$user_id");

			echo '<table>
			<th><td>Date</td>Time<td></td>Duration<td></td></th>';

			while ($row = mysqli_fetch_array($result)) {
				echo '<tr>
				<td>' . $row['begins_date']. '</td>
				<td>' . $row['begins_time']. '</td>
				<td>' . $row['ends_time'] . '</td></tr>';
			}

			echo '</table>';

			// display how many results found
			// list up all the time windows matched
			
		} else {
			echo '<h1>' . mysqli_error($dbc) . '</h1>';
		}
		
	} else {
		foreach($errors as $msg) {
			echo $msg;
		}
	}
}

?>

<form action='index.php' method='post'>

	<p>How long would you like to play? (at least 30 minutes)</p>
	<p>
		<input id='minutes' type='number' name='duration' min='30' placeholder='30' step='15'> minutes
	</p>

	<p>When are you available?</p>
	<p>
		<input id='date' type='date' name='begins_date'>
		<input id='time' type='time' name='begins_time' step='900' value='12:00:00'>
	</p>
	<input type="hidden" name="submitted" value="TRUE" />
	<input type='submit'>
</form>