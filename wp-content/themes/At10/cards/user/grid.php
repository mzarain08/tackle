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

global $post, $CORE_UI, $userdata, $CORE;

   // ADMIN PREVIEW
    if(!isset($post->ID)){
		$post = new stdClass();
		$post->ID 			= 1;
		$post->post_title 	= "This is a sample title."; 
		$post->post_author 	= 1; 
		$post->post_excerpt = "";
		$post->post_content = "";
		$post->comment_count = 0;
		$post->thistheme = THEME_KEY;
		$post->carddata = "";
	}
 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////



?>
 
<div class="rounded-20 mb-4 p-2" ppt-border1>
<div class="py-3 text-center">

<a href="%link%">

<div class="position-relative user_img rounded-20 overflow-hidden" style="height:150px; width:150px; margin: auto;">
	<div class="bg-image" data-bg="%image%"></div>
</div>

</a>        

<div class="link-dark text-700 mt-2"><a href="%link%">%title%</a></div>
                  
<div class="mb-2 text-center my-2"><div class="d-inline-flex">%rating%</div></div>

<a href="%link%" data-ppt-btn class="btn-primary hide-mobile"><?php echo __("View Profile","premiumpress") ?></a>
      
</div>   
</div>