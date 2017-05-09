<?php

$page_title = 'Welcome';

include ('includes/header.php');

?>

<div class="row">
  <div class="col-md-6">
<?php include ('match.php'); ?>
  </div>
  <div class="col-md-6">
  	<?php include ('related_content.php'); ?> 
  	<hr />
  	<?php include ('recommendations.php'); ?> 
  	<?php include ('personal.php'); ?> 
	<?php include ('activity_feeds.php'); ?>
  </div>
</div>

<?php
include ('includes/footer.html');
?>

