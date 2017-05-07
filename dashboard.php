<?php

$page_title = 'Dashboard';

include ('includes/header.php');

$profile_id = $_GET['profile_id'];
$user = $_GET['user'];
if(isset($_COOKIE['user_id'])) {
    $user = $_COOKIE['user_id'];
}

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

    if($user != $profile_id) {
        echo '<a class="btn btn-primary btn-sm" href="send_message.php?receiver_id='
                            . $profile_id . '">Send Message</a>' . '              ' . 
        '<a class="btn btn-primary btn-sm" href="friend_request.php?receiver_id='
                            . $profile_id . '">Add friend</a>';        
        echo '<h3><a class="btn btn-primary btn-sm" 
        href="index.php">Go Back</a> </h3> ';

    } else {
        echo '<h3><a class="btn btn-primary btn-sm" 
                href="index.php">Go Back</a> </h3> ';
        echo "<br>";
        echo "<br>";
               
        $tagq = "SELECT DISTINCT tag FROM times WHERE user_id = {$user}";
        $tagr = mysqli_query($dbc, $tagq);
        $tagnum = mysqli_num_rows($tagr);
        if($tagnum > 0) {
            echo '<h3>Tags Made</h3>';
        }
        echo '<table class="table">';
        while($tagrow = mysqli_fetch_array($tagr)) {
                    echo
                    '<tr>
                    <td>' . $tagrow['tag'] . '</td>
                    <td>' . '<a class="btn btn-primary btn-sm" href="tag_time.php?tag='
                            . $tagrow['tag'] . '">See All</a>' . '</td>
                    </tr>';

        }                               
        echo '</table>';
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

    if ($num_friends > 0) {
        echo '<table class="table">
        <tr>
        <th>UserID</th>
        <th>Name</th>
        </tr>';   
    
        while($row = mysqli_fetch_array($ra)) {

            if($row['friender_id'] == $profile_id){
                $q1 = "SELECT * FROM users WHERE user_id = {$row['friendee_id']}";
                $r1 = mysqli_query($dbc, $q1);
                while($row_1 = mysqli_fetch_array($r1)) {
                    echo
                    '<tr>
                    <td>' . $row['friendee_id'] . '</td>
                    <td>' . $row_1['first_name'] . ' ' . $row_1['last_name'] . '</td>
                    </tr>';
                }
            } else {
                $q2 = "SELECT * FROM users WHERE user_id = {$row['friender_id']}";
                $r2 = mysqli_query($dbc, $q2);
                while($row_2 = mysqli_fetch_array($r2)) {
                    echo
                    '<tr>
                    <td>' . $row['friender_id'] . '</td>
                    <td>' . $row_2['first_name'] . ' ' . $row_2['last_name'] . '</td>
                    </tr>';
                }
            }
        }   
        echo '</table>';
        
    }

}

?>      
  </div>
</div>

<?php

include ('includes/footer.html');

?>