<?php

if ($is_loggedin) {

	echo '<h4 class="patterns">Related Content</h4>';
	echo '<p>People made successful appointments on days as follows:</p>';

	$q = "SELECT DAYNAME(begins_date) AS day FROM times JOIN appointments USING (time_id)";
	$r = @mysqli_query($dbc, $q);

	$mon = 0;
	$tue = 0;
	$wed = 0;
	$thu = 0;
	$fri = 0;
	$sat = 0;
	$sun = 0;

	while ($row = mysqli_fetch_array($r)) {

		if ($row['day'] == 'Monday') {
			$mon++;
		} else if ($row['day'] == 'Tuesday') {
			$tue++;
		} else if ($row['day'] == 'Wednesday') {
			$wed++;
		} else if ($row['day'] == 'Thursday') {
			$thu++;
		} else if ($row['day'] == 'Friday') {
			$fri++;
		} else if ($row['day'] == 'Saturday') {
			$sat++;
		} else if ($row['day'] == 'Sunday') {
			$sun++;
		}
	}

	echo '<p>Monday: ' . $mon . '</p>';
	echo '<p>Tuesday: ' . $tue . '</p>';
	echo '<p>Wednesday: ' . $wed . '</p>';
	echo '<p>Thursday: ' . $thu . '</p>';
	echo '<p>Friday: ' . $fri . '</p>';
	echo '<p>Saturday: ' . $sat . '</p>';
	echo '<p>Sunday: ' . $sun . '</p>';
}

?>