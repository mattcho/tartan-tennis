<!-- FAN -->
<!-- show the friends of the user -->

<?php


require('mysqli_connect.php');

if (isset($_COOKIE['first_name']) AND isset($_COOKIE['user_id'])) {

echo '<h3> My Friends List    <a class="btn btn-primary btn-sm" href="friends_list.php?receiver_id='
							. $_COOKIE['user_id'] . '">Details </a> </h3> ';

$q = "SELECT user_id, first_name, last_name FROM users INNER JOIN friends ON friender_id=user_id WHERE friendee_id={$_COOKIE['user_id']}";

$r = @mysqli_query($dbc, $q);
 
$num_friends = mysqli_num_rows($r);

if ($num_friends > 0) {
					echo '<table class="table">
							<tr>
								<th>UserID</th>
								<th>Name</th>
							</tr>';
					while ($row = mysqli_fetch_array($r)) {
						echo
						'<tr>
							<td>' . $row['user_id'] . '</td>
							<td>' . $row['first_name'] . ' ' . $row['last_name'] . '</td>
						</tr>';
					}
					echo '</table>';
				} else {
					echo '<h3>You have no friend now.</h3>';
				}
}

?>
