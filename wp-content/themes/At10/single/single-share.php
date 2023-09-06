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
   
   global $CORE, $userdata, $settings, $post; 

 if(in_array(_ppt(array('design', 'socialshare' )), array("1",""))){
 
   // ADMIN PREVIEW
    if(!isset($post->ID)){
		$post = new stdClass();
		$post->ID 			= 1;
		$post->post_title 	= "This is a sample title."; 
		$post->post_author 	= 1; 
		$post->post_excerpt = "";
		$post->post_content = "";
		$post->comment_count = 0;
	} 							   
  
?>
  

<div class="p-4 hide-mobile rounded" ppt-box>

<p class="text-600"><?php echo __("Share this link via","premiumpress"); ?></p>

<?php

$GLOBALS['single-data-block'] = "share";
echo _ppt_template( 'single/single-content-data-block' ); 
unset($GLOBALS['single-data-block']);

?>
</div>  
 
<?php } ?>