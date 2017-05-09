<?php

if ($is_loggedin) {

	echo '<h4 class="patterns">Recommendations</h4>';
	echo '<p>People tend to make friends with a friend of the friends:</p>';

	$q = "SELECT DAYNAME(begins_date) AS day FROM times JOIN appointments USING (time_id)";
	$r = @mysqli_query($dbc, $q);

	while ($row = mysqli_fetch_array($r)) {
	}
}

?>