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

global $CORE, $post, $userdata, $new_settings, $CORE_UI; 



?>

<div ppt-box class="rounded">
  <div class="_header d-flex">
    <div class="_title w-100">
      <?php echo __("Attachments","premiumpress"); ?>
    </div>
  </div>
  <div class="_contentx p-3">
    <?php

$GLOBALS['single-data-block'] = "files";
echo _ppt_template( 'single/single-content-data-block' ); 
unset($GLOBALS['single-data-block']);	
?>
  </div>
</div>
