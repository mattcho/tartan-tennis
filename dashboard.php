<?php

$page_title = 'Dashboard';

include ('includes/header.php');

$profile_id = $_GET['profile_id'];
$user = $_GET['user'];

?>

<div class="row">
  <div class="col-md-8">
<?php 
// profile zone
$q = "SELECT first_name, last_name, email FROM users WHERE user_id = {$profile_id}";

$r = @mysqli_query($dbc, $q);

while($row = mysqli_fetch_array($r)) {
    echo '<h3>USER ID: ' . $profile_id . '</h3>';
    echo '<h3>USER Name: ' . $row['first_name'] . ' ' . $row['last_name'] . '</h3>';
    echo '<h3>Email: ' . $row['email'] . '</h3>';

    if($user == $profile_id) {
        echo '<h3><a class="btn btn-primary btn-sm" 
        href="index.php">Go Back</a> </h3> ';

    } else {
        echo '<a class="btn btn-primary btn-sm" href="send_message.php?receiver_id='
                            . $profile_id . '">Send Message</a>';
        echo '<h3> </h3>';
        echo '<a class="btn btn-primary btn-sm" href="friend_request.php?receiver_id='
                            . $profile_id . '">Add friend</a>';

    }
}


?>
  </div>
  <div class="col-md-4">
<?php 
//friend list zone
$likeeq = "SELECT * FROM likes WHERE likee_id = {$profile_id}";
$likerq = "SELECT * FROM likes WHERE liker_id = {$profile_id}";
$badlikerq = "SELECT * FROM likes WHERE liker_id = {$profile_id} AND bad_like = 1";
$badlikeeq = "SELECT * FROM likes WHERE likee_id = {$profile_id} AND bad_like = 1";
$aq = "SELECT * FROM appointments WHERE poster_id = {$profile_id} OR responder_id = {$profile_id}";

$likeer = mysqli_query($dbc, $likeeq);
$likerr = mysqli_query($dbc, $likerq);
$badlikeer = mysqli_query($dbc, $badlikeeq);
$badlikerr = mysqli_query($dbc, $badlikerq);

$num_likeer = mysqli_num_rows($likeer);
$num_likerr = mysqli_num_rows($likerr);
$num_badlikeer = mysqli_num_rows($badlikeer);
$num_badlikerr = mysqli_num_rows($badlikerr);

echo '<h4>Liked by: ' . $num_likeer . '</h4>';
echo '<h4>Likes: ' . $num_likerr . '</h4>';
echo '<h4>Flagged by: ' . $num_badlikeer . '</h4>';
echo '<h4>Flags: ' . $num_badlikerr . '</h4>';

echo '<h3> </h3>';
echo '<h3> </h3>';

if($user == $profile_id) {
    include ('personal.php');
} else {
    $all = "SELECT * FROM friends WHERE friender_id = {$profile_id} OR friendee_id = {$profile_id}";
    $ra = mysqli_query($dbc, $all);
    $num_friends = mysqli_num_rows($ra);

    echo '<h3>Current Friend: ' . $num_friends . '</h3>';
    while($row = mysqli_fetch_array($ra)) {

        if ($num_friends > 0) {
            echo '<table class="table">
            <tr>
            <th>UserID</th>
            <th>Name</th>
            </tr>';
            while ($row2 = mysqli_fetch_array($ra)) {
                $q_1 = "SELECT first_name, last_name FROM users WHERE user_id = {$row['friender_id']}";
                $q2_2 = "SELECT first_name, last_name FROM users WHERE user_id = {$row['friendee_id']}";
                $r_1 = mysqli_query($dbc, $q_1);
                $r_2 = mysqli_query($dbc, $q_2);
                $subr_1 = mysqli_fetch_array($r_1);
                $subr_2 = mysqli_fetch_array($r_2);
                if($row2['friender_id'] == $profile_id){
                    echo
                    '<tr>
                    <td>' . $row2['friendee_id'] . '</td>
                            <td>' . $subr_2['first_name'] . ' ' . $subr_2['last_name'] . '</td>
                    </tr>';

                } else {
                    echo
                    '<tr>
                    <td>' . $row2['friender_id'] . '</td>
                    <td>' . $subr_1['first_name'] . ' ' . $subr_1['last_name'] . '</td>
                    </tr>';
                }
            }
                    echo '</table>';
        }
    }

}

?>      
  </div>
</div>

<?php

include ('includes/footer.html');

?>