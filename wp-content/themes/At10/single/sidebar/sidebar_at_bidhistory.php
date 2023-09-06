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
   
   global $CORE;
 
if(in_array(_ppt(array('design', 'display_hbid')), array("","1"))){ 
?>

<div id="bidders_high" style="display:none;">
  <div class="p-3 p-md-4 p-md-4 mb-4 mt-4" ppt-border1>
 
   <span id="bidders_high_name" class="text-700"></span> <?php echo __("is the highest bidder.","premiumpress"); ?>
    
    <div class="my-3"></div>
    <div id="bidding_history_data"></div>
  </div>
</div>
<?php } ?>
