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

global $CORE, $new_settings, $CORE_UI; 
 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
			
?>
 
<div ppt-box class="rounded mb-4 ppt-single-reviews-wrapper">

<div class="_header">
<div class="_title w-100">
  <?php echo __("User Reviews","premiumpress"); ?>
</div> 

</div>
<div class="_content p-3">
<?php

$GLOBALS['single-data-block'] = "reviews";
echo _ppt_template( 'single/single-content-data-block' ); 
unset($GLOBALS['single-data-block']);
?>


</div>
</div>