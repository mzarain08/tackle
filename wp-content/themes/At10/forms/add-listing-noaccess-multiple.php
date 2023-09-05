<?php
/* 
* Theme: PREMIUMPRESS CORE FRAMEWORK FILE
* Url: www.premiumpress.com
* Author: Mark Fail
*
* THIS FILE WILL BE UPDATED WITH EVERY UPDATE
* IF YOU WANT TO MODIFY THIS FILE, CREATE A CHILD THEME
*
* http://codex.wordpress.org/Child_Themes
*/
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }

global $userdata, $CORE;

// SEE IF WE HAVE ANY OTHER LISTINGS ALREADY
if($userdata->ID){

$SQL = "SELECT ID FROM ".$wpdb->prefix."posts WHERE post_type='".THEME_TAXONOMY."_type' and post_status != 'trash' AND post_author='".$userdata->ID."' ORDER BY ID DESC LIMIT 1";	
$result = $wpdb->get_results($SQL);
 
}
	
if(!empty($result)){
?>

<div class="bg-white p-4 border  text-center col-md-8 mx-auto my-5">
 
  <h1 class="mt-4"><?php echo  __("We've found your Ad.","premiumpress"); ?></h1>
 
  
  <div class="lead col-md-10 mx-auto my-4"><?php echo __("You can only create 1 Ad per account.","premiumpress"); ?></div>
 
  <div class="col-md-10 mx-auto mb-4"><?php echo __("We'll redirect you to edit your existing Ad now.","premiumpress"); ?></div>
 
  <div class="text-center mb-5 pt-5"><i class="fa fa-spinner fa-4x text-dark fa-spin"></i></div>

<script>
  jQuery(document).ready(function(){
  jQuery("#add-packages").hide(); jQuery("#add-main").show();
  });
  setTimeout(function() { window.location.href = "<?php echo _ppt(array('links','add')); ?>/?eid=<?php echo $result[0]->ID; ?>"; }, 3000);
</script>

</div>

<?php }else{ ?>

<div class="text-center my-5">
<h2><?php echo __("No Access","premiumpress"); ?></h2>
</div>

<?php } ?>