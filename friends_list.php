<!-- FAN -->
<!-- show the group of friends and support flagging the friend -->
<?php

$page_title = 'Friends List';

include ('includes/header.php');

if(isset($_COOKIE['user_id']) AND isset($_COOKIE['user_id']))
{
   
    $all = "SELECT * FROM friends WHERE friender_id = {$_COOKIE['user_id']} OR friendee_id = {$_COOKIE['user_id']}";
    $ra = mysqli_query($dbc, $all);
    $num_friends = mysqli_num_rows($ra);


    echo '<h3>You have ' . $num_friends . ' friends now! </h3>'; 
if ($num_friends > 0) {
    echo '<table class="table">
    <tr>
        <th>User ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Like Num</th>
        <th>Flag Num</th>
    </tr>';
    while($row = mysqli_fetch_array($ra)) {

        $q = "SELECT user_id, first_name, last_name, email, likenum, badlikenum FROM users 
                INNER JOIN friends ON friendee_id=user_id
                INNER JOIN (SELECT *, SUM(private_like) as likenum, SUM(bad_like) as badlikenum
                FROM likes
                GROUP BY likee_id) AS alllikes ON likee_id=user_id
                WHERE user_id = {$row['friendee_id']}";
        $r = mysqli_query($dbc, $q);
        $subr = mysqli_fetch_array($r);
        $num_subr=mysqli_num_rows($r);

        $qs = "SELECT * FROM users WHERE user_id = {$row['friendee_id']}";
        $rs= mysqli_query($dbc, $qs);
        $subrs = mysqli_fetch_array($rs);
        

        $q2 = "SELECT user_id, first_name, last_name, email, likenum, badlikenum FROM users 
                INNER JOIN friends ON friender_id=user_id
                INNER JOIN (SELECT *, SUM(private_like) as likenum, SUM(bad_like) as badlikenum
                FROM likes
                GROUP BY likee_id) AS alllikes ON likee_id=user_id
                WHERE user_id = {$row['friender_id']}";
        $r2 = mysqli_query($dbc, $q2);                    
        $subr2 = mysqli_fetch_array($r2);
        $num_subr2=mysqli_num_rows($r2);

        $q2s = "SELECT * FROM users WHERE user_id = {$row['friender_id']}";
        $r2s = mysqli_query($dbc, $q2s);                    
        $subr2s = mysqli_fetch_array($r2s);


        if($row['friender_id'] == $_COOKIE['user_id']){
            if($num_subr==0){
        echo
        '<tr>
        <th>' . $row['friendee_id'] . '</th>
        <th>' . $subrs['first_name'] . ' ' . $subrs['last_name'] . '</th>
        <th>' . $subrs['email'] . '</th>
        <th> ' . 0 . '          <a class="btn btn-primary btn-sm" href="like_private.php?likee_id='
                            . $row['friendee_id'] . '">Like</a></th>
        <th>  ' . 0 . '          <a class="btn btn-primary btn-sm" href="Flag.php?likee_id='
                            . $row['friendee_id'] . '">Flag</a></th>
        </tr>';     
            }else{
        echo
        '<tr>
        <th>' . $row['friendee_id'] . '</th>
        <th>' . $subr['first_name'] . ' ' . $subr['last_name'] . '</th>
        <th>' . $subr['email'] . '</th>
        <th>' . $subr['likenum'] . '            <a class="btn btn-primary btn-sm" href="like_private.php?likee_id='
                            . $row['friendee_id'] . '">Like</a></th>
        <th>'. $subr['badlikenum'] . '      <a class="btn btn-primary btn-sm" href="Flag.php?likee_id='
                            . $row['friendee_id'] . '">Flag</a></th>
        </tr>';                            
    }}else{
        if($num_subr2==0){
            echo
        '<tr>
        <th>' . $row['friender_id'] . '</th>
        <th>' . $subr2s['first_name'] . ' ' . $subr2s['last_name'] . '</th>
        <th>' . $subr2s['email'] . '</th>
        <th>' . 0 . '         <a class="btn btn-primary btn-sm" href="like_private.php?likee_id='
                            . $row['friender_id'] . '">Like</a></th>
        <th>'. 0 . '       <a class="btn btn-primary btn-sm" href="Flag.php?likee_id='
                            . $row['friender_id'] . '">Flag</a></th>
        </tr>'; 
        }else{
        echo
        '<tr>
        <th>' . $row['friender_id'] . '</th>
        <th>' . $subr2['first_name'] . ' ' . $subr2['last_name'] . '</th>
        <th>' . $subr2['email'] . '</th>
        <th>' . $subr2['likenum'] . '         <a class="btn btn-primary btn-sm" href="like_private.php?likee_id='
                            . $row['friender_id'] . '">Like</a></th>
        <th>'. $subr2['badlikenum'] . '       <a class="btn btn-primary btn-sm" href="Flag.php?likee_id='
                            . $row['friender_id'] . '">Flag</a></th>
        </tr>';                            
            }
     }
    }
    echo '</table>';

    echo   '<a class="btn btn-primary btn-sm" href="like_list.php?user_id='
                            . $_COOKIE['user_id'] . '">See Private Like </a> </h3> ';
    }  else {
                    echo '<h3>You have no friends now.</h3>';
                    echo '<h4>Wanna see more users?</h4>';
                    echo '<a class="btn btn-primary btn-sm" href="alltime.php">Go and see</a></h3>';
                }
    // } else
    // {
    //     echo 'You must be logged to access this page.';
    }         
include ('includes/footer.html');
?>