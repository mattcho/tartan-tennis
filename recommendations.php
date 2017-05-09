<?php

if ($is_loggedin) {

	echo '<h4 class="patterns">Recommendations</h4>';
	echo '<p>People tend to make friends with their friends of friends:</p>';

	// The logged in user's friends
	$friends_list = array();

	$q = "SELECT friendee_id FROM friends WHERE friender_id=$user_id";
	$r = @mysqli_query($dbc, $q);
	while ($row = mysqli_fetch_array($r)) {
		array_push($friends_list, $row['friendee_id']);
	}

	$q = "SELECT friender_id FROM friends WHERE friendee_id=$user_id";
	$r = @mysqli_query($dbc, $q);
	while ($row = mysqli_fetch_array($r)) {
		array_push($friends_list, $row['friendee_id']);
	}

	// Friends of friends
	foreach ($friends_list as $friend) {

		$friends_of_friends = array();

		$q = "SELECT friendee_id FROM friends WHERE friender_id=$friend";
		$r = @mysqli_query($dbc, $q);
		while ($row = mysqli_fetch_array($r)) {
			array_push($friends_of_friends, $row['friendee_id']);
		}

		$q = "SELECT friender_id FROM friends WHERE friendee_id=$friend";
		$r = @mysqli_query($dbc, $q);
		while ($row = mysqli_fetch_array($r)) {
			array_push($friends_of_friends, $row['friender_id']);
		}
	}

	// delete me from the list
	if(($key = array_search($user_id, $friends_of_friends)) !== false) {
	    unset($friends_of_friends[$key]);
	}

	// display recommendations
	foreach ($friends_of_friends as $user) {
		$q = "SELECT * FROM users WHERE user_id=$user"; 
		$r = @mysqli_query($dbc, $q);
		while ($row = mysqli_fetch_array($r)) {
			
			echo "<a href=\"dashboard.php?profile_id=" . $row['user_id'] . "\">" . $row['first_name'] . " " . $row['last_name'] . "</a>";
		}
	}
}



?>