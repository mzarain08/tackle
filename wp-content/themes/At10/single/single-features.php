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
   
   global $CORE, $CORE_UI, $userdata, $settings, $post, $new_settings; 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
$title = "";
switch(THEME_KEY){

	
	case "es": {
	$title = __("Services","premiumpress");
	} break;

	case "da": {
	$title = __("My Interests","premiumpress");
	} break;

	case "mj": {
	$title = __("Why Choose Me?","premiumpress");
	} break;	
	
	case "ll": {
	$title = __("Skills you will gain","premiumpress");
	} break;	
		
	case "jb": {
	$title = "";
	} break; 
	
	case "dt": {
	$title = __("Amenities","premiumpress");
	} break; 
	
	default: {	
	$title = __("Features","premiumpress");
	} break;
} 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
$GLOBALS['flag-featurs-title-set'] = 1;
?>

<div ppt-box class="rounded">
  <div class="_header d-md-flex align-items-center" >
    <div class="_title w-100">
      <?php echo $title; ?>
    </div> 
  </div>
  <div class="_content py-3">
    <?php

	// FEATURES
	$GLOBALS['single-data-block'] = "features";
    echo _ppt_template( 'single/single-content-data-block' ); 
    unset($GLOBALS['single-data-block']);  

?>
  </div>
</div> 