<?php

$page_title = 'All available time';

include ('includes/header.php');
require('mysqli_connect.php');

$tag = $_GET['tag'];
echo '<h3>Appointment with tag ' . $tag . '</h3>';
//echo $tag;

if(isset($_COOKIE['user_id']))
{

    $q = "SELECT time_id FROM times ";
    $r = @mysqli_query($dbc, $q);
    $num_times = mysqli_num_rows($r);

    $qt =" SELECT user_id, first_name, last_name, email, begins_date, begins_time, ends_time, tag
                    FROM users INNER JOIN times
                    USING (user_id)
                    WHERE user_id <> '$user_id'
                    AND tag = '$tag';
                    ";

    $result = @mysqli_query($dbc, $qt);
                    
     // count the number of results
    $num = mysqli_num_rows($result);

    echo '<table class="table">
    <tr>
    <th>Name</th>
    <th>Email</th>
    <th>Date</th>
    <th>Begins</th>
    <th>Ends</th>
    <th>Tag</th>
    <th>Dashboard</th>
     <th>Friend Request</th>
    <th>Match Request</th>
    <th>Like this guy!</th>
    </tr>';

while ($row = mysqli_fetch_array($result)) {
    echo
    '<tr>
    <td>' . $row['first_name'] . ' ' . $row['last_name'] . '</td>
    <td>' . $row['email'] . '</td>
    <td>' . $row['begins_date'] . '</td>
    <td>' . $row['begins_time'] . '</td>
    <td>' . $row['ends_time'] . '</td>
    <td>' . $row['tag'] . '</td>
    <td><a class="btn btn-primary btn-sm"
    a href="dashboard.php?profile_id='
     . $row['user_id'] . '& user='. $_COOKIE['user_id'] . '">Dashboard</a></td>
    <td><a class="btn btn-primary btn-sm" href="friend_request.php?receiver_id='
     . $row['user_id'] . '">Let\'s know</a></td>
    <td><a class="btn btn-primary btn-sm" href="appoinment_request.php?receiver_id='
    . $row['user_id'] . '& begins_date='. $row['begins_date'] . '& begins_time=' . $row['begins_time'] . '& ends_time=' . $row['ends_time'] . '">Let\'s play</a></td>
    <td><a class="btn btn-primary btn-sm" href="like.php?likee_id='
     . $row['user_id'] . '">Like</a></td>
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