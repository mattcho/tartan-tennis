<!-- FAN -->
<!-- show the friends of the user -->

<?php
$page_title = 'Some Frineds';

if (isset($_COOKIE['first_name']) AND isset($_COOKIE['user_id'])) {

echo '<h4 class="patterns">Friends List</h4> ';

$all = "SELECT * FROM friends WHERE friender_id = {$_COOKIE['user_id']} OR friendee_id = {$_COOKIE['user_id']} LIMIT 10";
$ra = mysqli_query($dbc, $all);
$num_friends = mysqli_num_rows($ra);

if ($num_friends > 0) {
					echo '<table class="table">
							<tr>
								<th>User ID</th>
								<th>Name</th>
							</tr>';
					while ($row = mysqli_fetch_array($ra)) {
							$q = "SELECT first_name, last_name FROM users WHERE user_id = {$row['friender_id']}";
					        $q2 = "SELECT first_name, last_name FROM users WHERE user_id = {$row['friendee_id']}";
					        $r = mysqli_query($dbc, $q);
					        $r2 = mysqli_query($dbc, $q2);
					        $subr = mysqli_fetch_array($r);
					        $subr2 = mysqli_fetch_array($r2);
						if($row['friender_id'] == $_COOKIE['user_id']){
						echo
						'<tr>
							<td>' . $row['friendee_id'] . '</td>
							<td>' . $subr2['first_name'] . ' ' . $subr2['last_name'] . '</td>
						</tr>';
						}else{
						echo
						'<tr>
							<td>' . $row['friender_id'] . '</td>
							<td>' . $subr['first_name'] . ' ' . $subr['last_name'] . '</td>
						</tr>';
						}
					}
					echo '</table>';
					echo " ";
					echo '<h3><a class="btn btn-primary btn-sm" href="friends_list.php">Show more</a> </h3> ';
				} else {
					echo '<h3>You have no friends now.</h3>';
					echo '<h4>Wanna see more users?</h4>';
					echo '<a class="btn btn-primary btn-sm" href="alltime.php">Go and see</a></h3>';
				}

}

?>
