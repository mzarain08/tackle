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
 

$price = get_post_meta($post->ID,"price_cart", true);
if(!is_numeric($price) || $price == "0"){
$price = __("Free","premiumpress");
}

$oldPrice = get_post_meta($post->ID,"price", true);

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
?>

<div ppt-box  class="hide-mobile rounded mb-4 _sfavs <?php if(isset($post->isFavs) && $post->isFavs){ ?>isFavs<?php } ?>" data-pid='%postid%' <?php if(isset($post->carddata)){ echo $post->carddata; } ?>>
  <?php if(isset($post->isFavs)){ ?>
  <div class="showfavs position-absolute z-1 bg-white rounded-pill shadow p-1"  style="top:-5px; left:0px;">
    <div ppt-icon-20 data-ppt-icon-size="20" style="cursor:pointer" class="text-primary mb-n1">
      <?php echo $CORE_UI->icons_svg['heart-full']; ?>
    </div>
  </div>
  <?php } ?>
  <div class="p-1">
    <?php _ppt_template( 'cards/themes/search_image' ); ?>
  </div>
  <div class="_content border-top pb-2">
    <?php if(!user_can($post->post_author, 'administrator')){ ?>
    <div class="position-absolute mt-n3 z-1" style="right:10px;">
      <?php echo $CORE_UI->AVATAR("user", array("size" => "sm", "uid" => $post->post_author, "css" => "rounded-circle border bg-white", "online" => 0))  ?>
    </div>
    <?php } ?>
    <div class="fs-sm  pt-3 mt-n2 link-dark opacity-2">
      %category% &bull; %hits% <?php echo __("views","premiumpress"); ?>
    </div>
    <div class="lh-30 fs-5 text-700 my-1">
      <a href="%link%" class="text-black _adtitle">%title%</a>
    </div>
    <div class="d-flex align-items-baseline">
      <span class="fs-6 text-600  <?php if($price > 0){ echo $CORE->GEO("price_formatting",array()); } ?>"><?php echo $price; ?></span>
      <?php if(is_numeric($oldPrice) && $oldPrice > 0){ ?>
      <span class="fs-sm opacity-5 strike ml-2 <?php echo $CORE->GEO("price_formatting",array()); ?>"><?php echo $oldPrice; ?></span>
      <?php } ?>
      <span class="ml-3"><?php echo do_shortcode('[RATING bg="" short="1" hide_empty="1" reviews_show=0]'); ?></span>
    </div>
  </div>
</div>
<div class="show-mobile">
  <div class="position-relative mb-3">
    <a href="%link%">
    <div style="height:120px; width:150px; min-width:65px;" class="position-relative"  ppt-border1 >
      <?php _ppt_template( 'cards/themes/search_badges' ); ?>
      <div class="h-100 position-relative">
        <div class="bg-image z-0" data-bg="%image%">
          &nbsp;
        </div>
      </div>
    </div>
    </a>
    <div class="fs-14 text-600" style="margin-top:10px;">
      %title%
    </div>
  </div>
</div>
</div>
