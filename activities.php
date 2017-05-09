<!-- FAN -->
<!-- show the appointments the user already have (acticity feeds) -->

<?php

$page_title = 'Activity List';
include ('includes/header.php');

if (isset($_COOKIE['first_name']) AND isset($_COOKIE['user_id'])) {

echo '<h3>Appointments History</h3> ';


$all="SELECT * 
		FROM appointments INNER JOIN times
		USING (time_id)
		WHERE (poster_id = {$_COOKIE['user_id']} OR responder_id = {$_COOKIE['user_id']}) AND (begins_date<CURRENT_TIMESTAMP)";
$ra = mysqli_query($dbc, $all);
$num_activities = mysqli_num_rows($ra);

if ($num_activities > 0) {
					echo '<table class="table">
							<tr>
								<th>PartnerID</th>
								<th>Name</th>
								<th>Email</th>
								<th>Date</th>
								<th>Begin</th>
								<th>End</th>
								<th>Tag</th>
							</tr>';
					while ($row = mysqli_fetch_array($ra)) {
							$q = "SELECT first_name, last_name, email FROM users WHERE user_id = {$row['poster_id']}";
					        $q2 = "SELECT first_name, last_name, email FROM users WHERE user_id = {$row['responder_id']}";
					        $r = mysqli_query($dbc, $q);
					        $r2 = mysqli_query($dbc, $q2);
					        $subr = mysqli_fetch_array($r);
					        $subr2 = mysqli_fetch_array($r2);
						if($row['poster_id'] == $_COOKIE['user_id']){
						echo
						'<tr>
							<td>' . $row['responder_id'] . '</td>
							<td>' . $subr2['first_name'] . ' ' . $subr2['last_name'] . '</td>
							<td>' . $subr2['email'] . '</td>
							<td>' . $row['begins_date'] . '</td>
							<td>' . $row['begins_time'] . '</td>
							<td>' . $row['ends_time'] . '</td>
							<td>' . $row['tag'] . '</td>
						</tr>';
						}else{
						echo
						'<tr>
							<td>' . $row['poster_id'] . '</td>
							<td>' . $subr['first_name'] . ' ' . $subr['last_name'] . '</td>
							<td>' . $subr['email'] . '</td>
							<td>' . $row['begins_date'] . '</td>
							<td>' . $row['begins_time'] . '</td>
							<td>' . $row['ends_time'] . '</td>
							<td>' . $row['tag'] . '</td>
						</tr>';
						}
					}
					echo '</table>';
					
				} else {
					echo '<h3>You have no activities now.</h3>';
					echo '<h4>Wanna see more users?</h4>';
					echo '<a class="btn btn-primary btn-sm" href="alltime.php">Go and see</a></h3>';
				}

}else
{
        echo 'You must be logged to access this page.';
}

?>
