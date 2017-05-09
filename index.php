<?php

$page_title = 'Welcome';

include ('includes/header.php');

?>

<div class="row">
  <div class="col-md-8">
	<?php include ('match.php'); ?>
	<hr />
	<?php include ('related_content.php'); ?> 
  </div>
  <div class="col-md-4">
  	<?php include ('recommendations.php'); ?>
  	<hr />
  	<?php include ('personal.php'); ?> 
  	<hr />
	<?php include ('activity_feeds.php'); ?>
  </div>
</div>

<?php
include ('includes/footer.html');
?>

