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
 
	default: {	
	$title = __("Gifts","premiumpress");
	} break;
} 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


ob_start(); 
	$GLOBALS['single-data-block'] = "gifts";
	echo _ppt_template( 'single/single-content-data-block' ); 
	unset($GLOBALS['single-data-block']); 
	$output_gift = ob_get_contents();
ob_end_clean(); 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


?>

<div ppt-box class="rounded">
  <div class="_header d-md-flex align-items-center" >
    <div class="_title w-100">
      <?php echo $title; ?>
    </div>
  </div>
  <?php if(strlen($output_gift) > 30){ ?>
  <div class="_content py-3">
    <?php echo $output_gift; ?>
  </div>
  <a <?php echo _button_gift($post->post_author, $post->ID); ?> class="text-dark">
  <div class="_footer small" ppt-flex-row>
    <?php echo str_replace("%s",$post->post_title, __("Send %s a virtual gift.","premiumpress")); ?>
    <div ppt-icon-24 data-ppt-icon-size="24" class="text-primary">
      <?php echo $CORE_UI->icons_svg['arrow-long-right']; ?>
    </div>
  </div>
  </a>
  <?php  }else{ ?>
  <a <?php echo _button_gift($post->post_author, $post->ID); ?> class="text-dark">
  <div class="_content py-4 h-100" ppt-flex-middle="">
    <div class="text-center my-4">
      <div ppt-icon-64 data-ppt-icon-size="64" class="text-primary">
        <?php echo $CORE_UI->icons_svg['gift']; ?>
      </div>
      <div class="fs-5 text-600 mt-3">
        <?php echo str_replace("%s",$post->post_title, __("Send a virtual gift.","premiumpress")); ?>
      </div>
    </div>
  </div>
  </a>
  <?php } ?>
</div>
