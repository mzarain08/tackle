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

 
?>

<div class="bg-white p-4 border  text-center col-md-8 mx-auto my-5">
 
  <h1 class="my-4"><?php echo  __("No Access","premiumpress"); ?></h1>
 
  <div class="lead col-md-10 mx-auto mb-4"><?php echo __("I'm sorry but your account type does not allow ad creation. If this is an error please contact us asap.","premiumpress"); ?></div>
 
  <div class="text-center mb-5 pt-5"><i class="fa fa-spinner fa-4x text-dark fa-spin"></i>

</div>

<script>
  jQuery(document).ready(function(){
  jQuery("#add-packages").hide(); jQuery("#add-main").show();
  });
  setTimeout(function() { window.location.href = "<?php echo _ppt(array('links','myaccount')); ?>"; }, 3000);
</script>
</div> 