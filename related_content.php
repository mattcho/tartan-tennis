<?php

if ($is_loggedin) {

	echo '<h4 class="patterns">Related Content</h4>';
	echo '<p>People made successful appointments on days/times as follows:</p>';

	echo '<h5>Popular Days People Like</h5>';

	$q = "SELECT DAYNAME(begins_date) AS day FROM times JOIN appointments USING (time_id)";
	$r = @mysqli_query($dbc, $q);

	$days = array(
		"Monday"=>0,
		"Tuesday"=>0,
		"Wednesday"=>0,
		"Thursday"=>0,
		"Friday"=>0,
		"Saturday"=>0,
		"Sunday"=>0
	);

	while ($row = mysqli_fetch_array($r)) {

		if ($row['day'] == 'Monday') {
			$days['Monday']++;
		} else if ($row['day'] == 'Tuesday') {
			$days['Tuesday']++;
		} else if ($row['day'] == 'Wednesday') {
			$days['Wednesday']++;
		} else if ($row['day'] == 'Thursday') {
			$days['Thursday']++;
		} else if ($row['day'] == 'Friday') {
			$days['Friday']++;
		} else if ($row['day'] == 'Saturday') {
			$days['Saturday']++;
		} else if ($row['day'] == 'Sunday') {
			$days['Sunday']++;
		}
	}

	arsort($days);

	while($element = current($days)) {
	    echo key($days)." (".$element."),\n";
	    next($days);
	}

	echo '<br />';

	echo '<h5>Popular Times People Like</h5>';

	$q = "SELECT begins_time FROM times JOIN appointments USING (time_id)";
	$r = @mysqli_query($dbc, $q);

	$times = array();

	while ($row = mysqli_fetch_array($r)) {
		array_push($times, $row['begins_time']);
	}

	$frequency = array_count_values($times);

	arsort($frequency);

	foreach($frequency as $key => $value) {
		echo $key . ' (' . $value . '), ';

	}

	


	// end($result);
	// $answer = key($result);

	// echo $answer;

}

?>