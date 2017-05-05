<!-- FAN -->
<!-- activity_feeds showing user's friends recent appointments -->

<?php
$page_title = 'Activity feeds';

require('mysqli_connect.php');

if (isset($_COOKIE['first_name']) AND isset($_COOKIE['user_id'])) {

echo '<h3> My Friends\' Activities </h3> ';

$all = "SELECT * FROM friends WHERE friender_id = {$_COOKIE['user_id']} OR friendee_id = {$_COOKIE['user_id']}";
$ra = mysqli_query($dbc, $all);

$num_friends = mysqli_num_rows($ra);
echo $num_friends;

if ($num_friends > 0) {
					echo '<table class="table">
							<tr>
								<th>User ID</th>
								<th>Name</th>
								<th>Appointment Date</th>
								<th>With</th>
							</tr>';
					while ($row = mysqli_fetch_array($ra)) {

							$all1="SELECT * 
									FROM appointments INNER JOIN times
									USING (time_id)
									WHERE poster_id = {$row['friender_id']} OR responder_id = {$row['friender_id']}";
							$ra1 = mysqli_query($dbc, $all1);
							$row1=mysqli_fetch_array($ra1)

							$q = "SELECT first_name, last_name FROM users WHERE user_id = {$row1['poster_id']}";
							$r = mysqli_query($dbc, $q);
							$subr = mysqli_fetch_array($r);

							$q1 = "SELECT first_name, last_name FROM users WHERE user_id = {$row1['responder_id']}";
							$r1 = mysqli_query($dbc, $q1);
							$subr1 = mysqli_fetch_array($r1);



							$all2="SELECT * 
									FROM appointments INNER JOIN times
									USING (time_id)
									WHERE poster_id = {$row['friendee_id']} OR responder_id = {$row['friendee_id']}";
							$ra2 = mysqli_query($dbc, $all2);
							$row2=mysqli_fetch_array($ra2)

					        $q2 = "SELECT first_name, last_name FROM users WHERE user_id = {$row2['responder_id']}";
					        $r2 = mysqli_query($dbc, $q2);
					        $subr2 = mysqli_fetch_array($r2);

					        $q3 = "SELECT first_name, last_name FROM users WHERE user_id = {$row2['poster_id']}";
					        $r3 = mysqli_query($dbc, $q3);
					        $subr3 = mysqli_fetch_array($r3);

						if($row['friender_id'] == $_COOKIE['user_id']){
							if ($row2['poster_id'] == $row['friendee_id']) {
						echo
						'<tr>
							<td>' . $row2['poster_id'] . '</td>
							<td>' . $subr2['first_name'] . ' ' . $subr2['last_name'] . '</td>
							<td>' . $row2['begins_date'] . '</td>
							<td>' . $row2['tag'] . '</td>
						</tr>';
						}else{
							echo
						'<tr>
							<td>' . $row2['responder_id'] . '</td>
							<td>' . $subr3['first_name'] . ' ' . $subr3['last_name'] . '</td>
							<td>' . $row2['begins_date'] . '</td>
							<td>' . $row2['tag'] . '</td>
						</tr>';
						}
						}

						if($row['friendee_id'] == $_COOKIE['user_id']){	
							if($row1['poster_id'] == $row['friender_id']){
						echo
						'<tr>
							<td>' . $row1['poster_id'] . '</td>
							<td>' . $subr1['first_name'] . ' ' . $subr1['last_name'] . '</td>
							<td>' . $row1['begins_date'] . '</td>
							<td>' . $row1['tag'] . '</td>
						</tr>';							
						}else{
						echo
						'<tr>
							<td>' . $row1['responder_id'] . '</td>
							<td>' . $subr['first_name'] . ' ' . $subr['last_name'] . '</td>
							<td>' . $row1['begins_date'] . '</td>
							<td>' . $row1['tag'] . '</td>
						</tr>';	
						}						
						}
					}
					echo '</table>';
					echo " ";
					echo '<h3><a class="btn btn-primary btn-sm" href="friends_list.php?receiver_id='
							. $_COOKIE['user_id'] . '">See Details</a> </h3> ';
				} else {
					echo '<h3>Your friends have no appointments now.</h3>';
					echo '<h4>Go to invite them!</h4>';
					echo '<a class="btn btn-primary btn-sm" href="alltime.php">Go and see</a></h3>';
				}
				
}

?>
