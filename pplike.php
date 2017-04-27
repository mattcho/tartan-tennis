<?php
$page_title = 'Public/Private like';

//require('mysqli_connect.php');
//$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die('Could not 
//                        connect to MySQL: ' . mysqli_connect_error());

//$account = $_SESSION['user'];
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    require('mysqli_connect.php');
    if (!empty($_POST['publiclike'])) {
        //if (!isset($_COOKIE['user_id'])) {
        //echo  '<h1>Please log in! </h1>';
        //return;
        //}
        //$account = $_COOKIE['user_id'];
        $account = 9;
        $ID = $_POST['publiclike'];
        $marked = false;
        $sql="SELECT liker_id, likee_id, public_like FROM likes WHERE liker_id='$account'";
        $retval = mysqli_query($dbc, $sql);
        if($retval != FALSE)
        {    
            $row = mysqli_fetch_array($retval);
            if($row)
            {
                if($row['lkiee_id'] == $ID) {
                    $marked = true;
                }
            }
        }
        if ($marked == false) {
            $sql = "INSERT INTO likes (liker_id, likee_id, public_like) 
                        VALUES ('$account', '$ID', 1);";
            $retval = mysqli_query($dbc, $sql);
            if ($retval) {
                echo '<h1>public like success!</h1>';
            } else {
                echo '<h1>public like error!</h1>';
            }
        }
    }

    if (!empty($_POST['privatelike'])) {
        //if (!isset($_COOKIE['user_id'])) {
        //    echo  '<h1> Please log in! </h1>';
        //    return;
        //}
        //$account = $_COOKIE['user_id'];
        $account = 9;
        $ID = $_POST['privatelike'];
        $marked = false;
        $sql="SELECT liker_id, likee_id, private_like FROM likes WHERE liker_id='$account'";
        $retval = mysqli_query($dbc, $sql);
        if($retval != FALSE)
        {    
            $row = mysqli_fetch_array($retval);
            if($row)
            {
                if($row['lkiee_id'] == $ID) {
                    $marked = true;
                }
            }
        }
        if ($marked == false) {
            $sql = "INSERT INTO likes (liker_id, likee_id, private_like) 
                        VALUES ('$account', '$ID', 1);";
            $retval = mysqli_query($dbc, $sql);
            if ($retval) {
                echo '<h1>private like success!</h1>';
            } else {
                echo '<h1>private like error!</h1>';
            }
        }    
    }
    mysqli_close($dbc);
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Public/Private like</title>
</head>
<body>
<form action="tag.php" method="post">
<p>Please input the user id you wish to public like: </p>
<p><input type="text" name="publiclike" value="<?php if (isset($_POST['publiclike'])) echo $_POST['publiclike']; ?>" /></p>
<p>Please input the user id you wish to private like: </p>
<p><input type="text" name="privatelike" value="<?php if (isset($_POST['privatelike'])) echo $_POST['privatelike']; ?>" /></p>
<p><input type="submit" name="submit" value="Done" /></p>
</form>
</body>
</html>

