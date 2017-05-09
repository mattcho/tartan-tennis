<?php

$page_title = 'Personal Message';

include ('includes/header.php');

if(isset($_COOKIE['user_id']))
{

    $all = "SELECT * FROM messages WHERE sender_id = {$_COOKIE['user_id']} OR receiver_id = {$_COOKIE['user_id']}";
    $new = "SELECT * FROM messages WHERE receiver_id = {$_COOKIE['user_id']} AND is_read = 0";

    $ra = mysqli_query($dbc, $all);
    $rn = mysqli_query($dbc, $new);

    $message_all = mysqli_num_rows($ra);
    $message_new = mysqli_num_rows($rn);
    echo '<h3>Your personal message: ' . $message_all . '</h3>'; 
    echo '<h3>New message: ' . $message_new . '</h3>';
    echo '<h3> <a class="btn btn-primary btn-sm" href="send_message.php?receiver_id='
                            . $_COOKIE['user_id'] . '">Send Message</a></h3> ';
    echo '<table class="table">
    <tr>
        <th>Message Title</th>
        <th>Sender</th>
        <th>Receiver</th>
        <th>Time</th>
        <th>Status</th>
        <th>Read</th>
    </tr>';
    while($row = mysqli_fetch_array($ra)) {
        $newmessage = "New";
        $q = "SELECT first_name FROM users WHERE user_id = {$row['sender_id']}";
        $q2 = "SELECT first_name FROM users WHERE user_id = {$row['receiver_id']}";
        $r = mysqli_query($dbc, $q);
        $r2 = mysqli_query($dbc, $q2);
        $subr = mysqli_fetch_array($r);
        $subr2 = mysqli_fetch_array($r2);
        setcookie("message", $row['message_id']);

        if($row['is_read'] == 1) {
            $newmessage = "Already Read";
        }
        echo
        '</tr>
        <td>' . $row['message_title'] . '</td>
        <td>' . $subr['first_name'] . '</td>
        <td>' . $subr2['first_name'] . '</td>
        <td>' . $row['created_at'] . '</td>
        <td>' . $newmessage . '</td>
        <td><a class="btn btn-primary btn-sm" href="read_message.php?message_id='
                            . $row['message_id'] . '">Read</a></td>
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