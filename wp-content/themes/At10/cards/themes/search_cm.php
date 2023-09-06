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
	
	$oldPrice = get_post_meta($post->ID,"old_price",true);
	 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
?>

<div ppt-box class="hide-mobile rounded  mb-4 _sfavs <?php if(isset($post->isFavs) && $post->isFavs){ ?>isFavs<?php } ?>" data-pid='%postid%' <?php if(isset($post->carddata)){ echo $post->carddata; } ?>>
 
 
  <div class="m-2"><?php _ppt_template( 'cards/themes/search_image' ); ?></div>
  
  <?php _ppt_template( 'cards/themes/search_distance' ); ?>
  
  
  <div class="_content pb-2">
 
    <div class="fs-6 text-600 py-2 " style="line-height:20px;">
      <a href="%link%" class="text-black _adtitle">%title%</a>
    </div>
    
    <span class="fs-5 text-700  <?php echo $CORE->GEO("price_formatting",array()); ?>">%price%</span>
       <?php if(is_numeric($oldPrice) && $oldPrice > 0){ ?>
      <span class="fs-sm opacity-5 strike <?php echo $CORE->GEO("price_formatting",array()); ?>"><?php echo $oldPrice; ?></span>
      <?php } ?> 
      </span>
  
  </div>
   
</div>
 
<div class="show-mobile">
  <div class="position-relative mb-3">
    <a href="%link%">
    <div style="height:190px; width:150px; min-width:65px;" class="position-relative"  ppt-border1 >
      <?php _ppt_template( 'cards/themes/search_badges' ); ?>
      <div class="h-100 position-relative">
        <div class="bg-image z-0" data-bg="%image%">
          &nbsp;
        </div>
      </div>
    </div>
    </a>
    
    <div class="lh-20 fs-5 text-600 text-center" style="margin-top:10px;">
      <span class="<?php echo $CORE->GEO("price_formatting",array()); ?>">%price%</span>
      <?php if(is_numeric($oldPrice) && $oldPrice > 0){ ?>
      <span class=" opacity-5 strike <?php echo $CORE->GEO("price_formatting",array()); ?>"><?php echo $oldPrice; ?></span>
      <?php } ?>
    </div>
    
  </div>
</div>
