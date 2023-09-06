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
  <div class="py-3">
    <div class="container">
      <div class="row no-gutter">
        <div class="col-md-9">
          <div class="d-flex">
            <div class="mr-5">
              <a href="%link%">
              <div class="position-relative user_img rounded-20 overflow-hidden bg-light" style="height:150px; width:150px;">
                <div class="bg-image" data-bg="%image%">
                </div>
              </div>
              </a>
            </div>
            <div>
              <div>
                %user_type%
              </div>
              <div class="link-dark fs-lg text-700 mb-2">
                <a href="%link%">%title%</a>
              </div>
              <div class="opacity-5">
                <?php echo __("Member since","premiumpress") ?> %joined%
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3 d-flex  align-self-center text-center">
          <div>
            <div class="text-center mb-3 opacity-5 text-uppercase fs-sm">
              %count% Ads
            </div>
            <div class="mb-2">
              <div class="d-inline-flex mx-auto mb-3 ml-n3">
                %rating%
              </div>
            </div>
            <a href="%link%" data-ppt-btn class="btn-primary hide-mobile"><?php echo __("View Profile","premiumpress") ?></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> 