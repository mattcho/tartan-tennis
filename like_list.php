<?php

$page_title = 'Your like friend';

include ('includes/header.php');

if(isset($_COOKIE['user_id']))
{
	$q = "SELECT likee_id FROM likes WHERE liker_id = {$_COOKIE['user_id']} AND private_like = 1";

    $rs = mysqli_query($dbc, $q);

    $like_all = mysqli_num_rows($rs);
    
    echo '<h3>You already like ' . $like_all . ' users now! </h3>'; 

    echo '<table class="table">
    <tr>
        <th>User ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Profile</th>
        <th>Message</th>       
    </tr>';
    while($row = mysqli_fetch_array($rs)) {
        $q2 = "SELECT first_name, last_name, email FROM users WHERE user_id = {$row['likee_id']}";
        $rs2 = mysqli_query($dbc, $q2);
        while($row2 = mysqli_fetch_array($rs2)) {
            echo 
            '<tr>
            <th>' . $row['likee_id'] . '</th>
            <th>' . $row2['first_name'] . ' ' . $row2['last_name'] . '</th>
            <th>' . $row2['email'] . '</th>
            <td><a class="btn btn-primary btn-sm" href="dashboard.php?profile_id='
                            . $row['likee_id'] . '">Visit</a></td>
            <td><a class="btn btn-primary btn-sm" href="send_message.php?receiver_id='
                            . $row['likee_id'] . '">Send</a></td>                
            </tr>';
        }
                          
    }
    echo '</table>';

    echo   '<a class="btn btn-primary btn-sm" href="friends_list.php?user_id='
                            . $_COOKIE['user_id'] . '">Go Back</a> </h3> ';
}
else
{
        echo 'You must be logged to access this page.';
}
include ('includes/footer.html');
?>