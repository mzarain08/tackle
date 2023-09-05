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
	}
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 

?>

<div ppt-box class="rounded">
  <div class="_header d-md-flex align-items-center" >
    <div class="_title w-100">
      <?php echo ppt_title_description(); ?>
    </div>
    <div class="lh-10 w-100 mt-2 pt-1 mr-3 hide-mobile" ppt-flex-end>
      <?php theme_sidebar_buttons("badges", "" );  ?>
    </div>
  </div>
  <div class="_content py-3 pl-4 py-lg-4">
  
  
  <?php if(THEME_KEY == "vt"){ ?>
  <h1 class="fs-6 text-700 mb-3"><?php echo $post->post_title; ?></h1>
  <?php } ?>
  
    <?php

	$GLOBALS['single-data-block'] = "description";
    echo _ppt_template( 'single/single-content-data-block' ); 
    unset($GLOBALS['single-data-block']);
	
	?>
    
    <?php
	// FEATURES
	$GLOBALS['single-data-block'] = "features";
    echo _ppt_template( 'single/single-content-data-block' ); 
    unset($GLOBALS['single-data-block']); 
	?>
  
    
  <?php if(THEME_KEY == "cb"){ ?>
  <hr />
  
  <div class="text-600 mb-3 fs-6"><?php echo __("How does it work?","premiumpress"); ?></div>
<div class="row">
    <div class="col-md-4 mobile-mb-2">
    
    <div class="text-600 mb-2"><i class="fa fa-search mr-2 text-primary"></i> <?php echo __("Browse","premiumpress"); ?></div>
    <div class="fs-sm"><?php echo __("Browse our website and choose from 1000's of retailers and exclusive cashback offers.","premiumpress"); ?></div>
   
    </div>
    <div class="col-md-4 mobile-mb-2">
    
    <div class="text-600 mb-2"><i class="fa fa-shopping-cart mr-2 text-primary"></i> <?php echo __("Shop","premiumpress"); ?></div>
     <div class="fs-sm"><?php echo __("Activate the cashback button on this page and buy the item from the retailer using the link provided.","premiumpress"); ?></div>
   
    </div>
    <div class="col-md-4">
    <div class="text-600 mb-2"><i class="fa fa-shopping-basket mr-2 text-primary"></i> <?php echo __("Buy","premiumpress"); ?></div>
    <div class="fs-sm"><?php echo __("The retailer pays us a commission for your purchase and we'll add this as cashback to account.","premiumpress"); ?>
      
    </div>
    
    </div>
</div> 
  
  
  <?php } ?>
    
    
    
  </div>
</div>