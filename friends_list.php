<!-- FAN -->
<!-- show the group of friends and support flagging the friend -->
<?php

$page_title = 'Friends List';

include ('includes/header.php');

if(isset($_COOKIE['user_id']))
{
	$q = "SELECT user_id, first_name, last_name, email, likenum, badlikenum
	FROM users 
	INNER JOIN friends ON friender_id=user_id
	INNER JOIN (SELECT *, SUM(private_like) as likenum, SUM(bad_like) as badlikenum
	FROM likes
	GROUP BY likee_id) AS alllikes ON likee_id=user_id
    WHERE friendee_id={$_COOKIE['user_id']}";


    $rs = mysqli_query($dbc, $q);

    $friends_all = mysqli_num_rows($rs);
    
    echo '<h3>You have ' . $friends_all . ' friends now! </h3>'; 

    echo '<table class="table">
    <tr>
        <th>User ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Like Num</th>
        <th>Flag Num</th>
    </tr>';
    while($row = mysqli_fetch_array($rs)) {
        echo
        '</tr>
        <td>' . $row['user_id'] . '</td>
        <td>' . $row['first_name'] . ' ' . $row['last_name'] . '</td>
        <td>' . $row['email'] . '</td>
        <td>' . $row['likenum'] . '			<a class="btn btn-primary btn-sm" href="like.php?likee_id='
							. $row['user_id'] . '">Like</a></td>
        <td>'. $row['badlikenum'] . '		<a class="btn btn-primary btn-sm" href="Flag.php?likee_id='
							. $row['user_id'] . '">Flag</a></td>
        </tr>';                            
    }
    echo '</table>';
}
else
{
        echo 'You must be logged to access this page.';
}
include ('includes/footer.html');
?>