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

global $CORE, $post, $userdata; 

$rates = array(
	1 => __("1 Hour","premiumpress"),
	2=> __("2 Hours","premiumpress"),
	3 => __("3 Hours","premiumpress"),
	4 =>__("6 Hours","premiumpress"),
	5 => __("12 Hours","premiumpress"),
);

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

 
?>
<div class="addeditmenu" data-key="callrates"></div>
<div class="card-rates">
  <div class="row no-gutters">
    <div class="col-6 _title pl-0 text-left">
      <div class="text-600">
        <?php echo __("My Rates","premiumpress") ?>
      </div>
    </div>
    <div class="col-3 _title text-center">
      <div>
        <?php echo __("Incall","premiumpress") ?>
      </div>
    </div>
    <div class="col-3 _title text-center">
      <div>
        <?php echo __("Out Call","premiumpress") ?>
      </div>
    </div>
    <?php  foreach($rates as $k => $r){ 
	   
	   $int = get_post_meta($post->ID, 'rate_incall'.$k, true ); 
	   $out = get_post_meta($post->ID, 'rate_outcall'.$k, true ); 
	   
	   if(!is_numeric($int)){ $int = 0; }
	   if(!is_numeric($out)){ $out = 0; }
	   
	  
	   ?>
    <div class="col-6">
      <span class="text-600"><?php echo $r ?> </span>
    </div>
    <div class="col-3 text-center">
      <?php if($int != 0){ ?>
      <span class="<?php echo $CORE->GEO("price_formatting",array()); ?>"><?php echo $int; ?></span>
      <?php }else{ ?>
      <i class="fa fa-times"></i>
      <?php } ?>
    </div>
    <div class="col-3 text-center">
      <?php if($out != 0){ ?>
      <span class="<?php echo $CORE->GEO("price_formatting",array()); ?>"><?php echo $out; ?></span>
      <?php }else{ ?>
      <i class="fa fa-times"></i>
      <?php } ?>
    </div>
    <?php }  ?>
  </div>
</div>
