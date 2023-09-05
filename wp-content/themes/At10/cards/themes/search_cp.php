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
		$post->storeimageset = "";
		$post->store_image = "";
		$post->carddata = "";
	}

 	$title = $post->post_title;
	$name = "";
	$found 	= wp_get_object_terms( $post->ID, 'store' );
	$store_id = "";
	$store_image = "";
	$link = "";
	
	if(is_array($found) && !empty($found)){
		$link = get_term_link($found[0]->term_id, "store");	 
		$name = strip_tags(do_shortcode('[STORENAME]')); 
		$store_image = do_shortcode('[STOREIMAGE sid='.$found[0]->term_id.']');
		$store_id = $found[0]->term_id;
	} 
	
	if(defined('WLT_DEMOMODE') && $store_image == ""){
		if(isset($_SESSION['design_preview'])){
			$store_image = DEMO_IMGS."?fw=text160&i=".rand(1,8)."&t=".THEME_KEY."&ct=".$_SESSION['design_preview'];
		}
	}
	
?>

<div ppt-box class="hide-mobile rounded shadow-hover-lg mb-4 _sfavs <?php if(isset($post->isFavs) && $post->isFavs){ ?>isFavs<?php } ?>" data-pid='%postid%' <?php if(isset($post->carddata)){ echo $post->carddata; } ?>>
  <figure class="position-relative overflow-hidden bg-dark search7" style="height:180px;">
    <div class=" z-10">
      <?php _ppt_template( 'cards/themes/search_badges' ); ?>
    </div>
    <div class="bg-image opacity-5" data-ppt-image-bg>
      &nbsp;
    </div>
    
    <div class="p-sm-3 overflow-hidden position-relative z-1 y-middle" style="height:180px;">
      <a href="javascript:void(0);" class="btn-gocoupon" data-nextlink="<?php echo $link; ?>" data-store="1" data-couponid="<?php echo $store_id; ?>">
      <div style="height:100px; width:100px; min-width:100px; " class="store-icon-small mx-auto">
        <div ppt-border1 class="h-100 position-relative overflow-hidden" style="border-radius: 100%;">
          <div class="bg-image p-2" data-bg="<?php echo $store_image; ?>">
            &nbsp;
          </div>
        </div>
      </div>
      </a>
    </div>
   
  </figure>
  <?php _ppt_template( 'cards/themes/search_distance' ); ?>
  <div class="_content border-top pb-2">
  
    <div class="fs-5 text-600 pt-2 lh-30 cursor" style="line-height:20px;" onclick="jQuery('.coupon-btn-<?php echo $post->ID; ?>').trigger('click');">
      <?php echo $title; ?>
    </div>
    
    
 <div class="d-flex justify-content-between align-items-baseline">
 
 <div> <div class="d-flex mt-1"> <?php _ppt_template( 'cards/themes/search_icons' ); ?> </div> </div>
  
  <div class="fs-sm">
  
  <?php if(defined('WLT_DEMOMODE') && $name == ""){ ?>
  
  <a href="<?php echo _ppt(array('links','stores')); ?>" class="text-dark text-600 opacity-5">Example Store</a>
  
  <?php }elseif( strlen($name) > 1){ ?>
  <a href="<?php echo $link; ?>" class="text-dark text-600 opacity-5"><?php echo $name; ?></a>
  <?php } ?>
  
  </div> 
    
    
  </div>
 
 
  </div>
  <div class="_footer small  py-2">
  
  <?php echo do_shortcode('[CBUTTON]'); ?>
  
   
   
  </div>
</div>


<?php echo do_shortcode('[CBUTTON hidden=1]'); ?>


<div class="show-mobile">
  <div class="d-flex position-relative mb-3 border-bottom pb-3">
    <div class="w-100">
      <div class="fs-5 lh-20 text-700 mobile-mb-2 cursor"  onclick="jQuery('.coupon-btn-<?php echo $post->ID; ?>').trigger('click');">
        <?php echo $title; ?>
      </div>
      <div class="d-flex mt-2 fs-sm align-items-center">
        <?php if(is_array($found) && !empty($found)){ ?>
        <a href="javascript:void(0);" class="btn-gocoupon" data-nextlink="<?php echo $link; ?>" data-store="1" data-couponid="<?php echo $found[0]->term_id; ?>">
        <div style="height:25px; width:50px; min-width:50px;" class="store-icon-small  mr-3">
          <div ppt-border1 class="h-100 position-relative">
            <div class="bg-image" data-bg="<?php echo $store_image; ?>">
              &nbsp;
            </div>
          </div>
        </div>
        </a>
        <?php } ?>
        <div>
          <div class="d-inline-flex verified text-success text-600 mr-2">
            <div ppt-icon-16 data-ppt-icon-size="16">
              <?php echo $CORE_UI->icons_svg['check_circle']; ?>
            </div>
            <div class="ml-1">
              <?php echo __("Verified","premiumpress"); ?>
            </div>
          </div>
        </div>
        <div class="">
          <?php echo do_shortcode('[TIMELEFT textonly=1]'); ?>
        </div>
      </div>
    </div>
  </div>
</div>
</div>