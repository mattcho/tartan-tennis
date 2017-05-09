<?php

if ($is_loggedin) {

	echo '<h4 class="patterns">Related Content</h4>';
	echo '<p>Most popular days. People made successful appointments on days as follows:</p>';

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
}

?>