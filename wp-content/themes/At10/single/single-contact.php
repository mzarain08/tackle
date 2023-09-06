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

global $CORE, $CORE_UI, $new_settings; 
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
			
?>

<div ppt-box class="rounded">
  <div class="_header d-flex">
    <div class="_icon">
      <div ppt-icon-24 data-ppt-icon-size="24">
        <?php echo $CORE_UI->icons_svg['chat']; ?>
      </div>
    </div>
    <div class="_title w-100">
      <?php echo __("Send Message","premiumpress") ?>
    </div>
    <div class="_close btn-close">
      <div ppt-icon-24 data-ppt-icon-size="24">
        <?php echo $CORE_UI->icons_svg['close']; ?>
      </div>
    </div>
  </div>
  <div class="_content py-3 ppt-forms style3">
    <?php
	$GLOBALS['single-data-block'] = "contact";
	echo _ppt_template( 'single/single-content-data-block' ); 
	unset($GLOBALS['single-data-block']); 
?>
  </div>
</div>
</div>
