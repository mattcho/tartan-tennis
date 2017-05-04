<?php

$page_title = 'Welcome';

include ('includes/header.php');

?>

<div class="row">
  <div class="col-md-8">
<?php include ('match.php'); ?>
  </div>
  <div class="col-md-4">
<?php include ('personal.php'); ?>
<br><br><br><br><br><br><br><br><br><br><br><br>
<?php include ('activity_feeds.php'); ?> 
  </div>
</div>

<?php
include ('includes/footer.html');
?>

