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

global $settings, $post, $CORE, $new_settings;

$settings['card'] = "info";
$settings['title'] = "Related";

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$descTitle = 1;

if(isset($new_settings['block_title'])){
	$descTitle  = $new_settings["block_title"];
}
 
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
?>


<div id="recommended" class="section-60 border-top <?php if(in_array(_ppt(array('design', 'display_mobile_bottom')), array("","1"))){ ?>pb-4 pb-sm-0 mb-4 mb-sm-0<?php } ?> mobile-mb-6">
<div class="container">
  <div class="row">

    <div class="col-12"> 
    
<div class="mb-5 text-700"><?php echo __("Recommended For You","premiumpress"); ?></div> 
      
      
<?php

$GLOBALS['single-data-block'] = "related";
echo _ppt_template( 'single/single-content-data-block' ); 
unset($GLOBALS['single-data-block']);

?>
      
    </div>
  </div>
</div>
</div>