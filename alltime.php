<!-- FAN -->
<!-- show all the available time slots in the system -->

<?php

$page_title = 'All available time';

include ('includes/header.php');

if(isset($_COOKIE['user_id']))
{

    if (isset($_POST['submitted'])) {

        $search = mysqli_real_escape_string($dbc, $_POST['search']);

        $q = "SELECT user_id, first_name, last_name, email, begins_date, begins_time, ends_time, tag
            FROM users INNER JOIN times USING (user_id)
            WHERE MATCH (begins_date, begins_time, ends_time, tag) AGAINST('$search' IN NATURAL LANGUAGE MODE)
            AND begins_date >= NOW()";
    } else {
        $q = "SELECT user_id, first_name, last_name, email, begins_date, begins_time, ends_time, tag
            FROM users INNER JOIN times USING (user_id)
            WHERE begins_date >= NOW()";
    }

    $r = @mysqli_query($dbc, $q);
    $num_times = mysqli_num_rows($r);
    echo '<h3>The available time slots from all users: ' . $num_times . '</h3>';

    echo '<form action="alltime.php" method="post" class="navbar-form">
            <div class="form-group">
                <input name="search" type="text" class="form-control" placeholder="Search" />
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
            <input type="hidden" name="submitted" value="TRUE" />
        </form>';
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

while ($row = mysqli_fetch_array($r)) {
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