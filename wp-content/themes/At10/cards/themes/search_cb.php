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
	}
	
	
	$oldPrice = get_post_meta($post->ID,"old_price",true);
	
 	$title = $post->post_title;
	$storename = "";
	$found 	= wp_get_object_terms( $post->ID, 'store' );
	$store_id = "";
	$store_image = "";
	$link = "";
	if(is_array($found) && !empty($found)){
		$link = get_term_link($found[0]->term_id, "store");	 
		$storename = strip_tags(do_shortcode('[STORENAME]')); 
		$store_image = do_shortcode('[STOREIMAGE sid='.$found[0]->term_id.']');
		$store_id = $found[0]->term_id;
	}
	
	
	if(defined('WLT_DEMOMODE') && $store_image == ""){
		if(isset($_SESSION['design_preview'])){
			$store_image = DEMO_IMGS."?fw=text160&i=".rand(1,8)."&t=".THEME_KEY."&ct=".$_SESSION['design_preview'];
		}
	}
	
	$type = 0;
	if(get_post_meta($post->ID,'type', true) == 1){
	$type = 1;
	}
	 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
?>

<div ppt-box class="hide-mobile rounded shadow-hover-lg mb-4 _sfavs <?php if(isset($post->isFavs) && $post->isFavs){ ?>isFavs<?php } ?>" data-pid='%postid%' <?php if(isset($post->carddata)){ echo $post->carddata; } ?>>
  <?php _ppt_template( 'cards/themes/search_image' ); ?> 
  <?php _ppt_template( 'cards/themes/search_distance' ); ?>
  <div class="_content border-top ">
 
    <div class="fs-sm  pt-3 link-dark opacity-2">
      %category% 
    </div>
    <div class="fs-5 text-600 py-2 lh-30">
      <a href="%link%" class="text-black _adtitle">%title%</a>
    </div>
    <div class="pb-2" ppt-flex-between>
      <div class="text-600">
        <div class="d-flex">
          <div>
 
            <?php echo do_shortcode('[RATING bg="" short="1" hide_empty="1"]'); ?>
        
          </div>
        </div>
      </div>
      <div class="badge badge-primary link-light text-truncate" style="max-width: 150px;">
       <a href="<?php echo $link; ?>"><?php echo $storename; ?></a>
      </div>
      
      
      
      
    </div>
  </div>
  <div class="_footer small" ppt-flex-between>
    <div class="d-flex">
      <?php _ppt_template( 'cards/themes/search_icons' ); ?>
    </div>
    <div class="text-truncate">
    
    <?php if($type == 1){ ?>
    
    
    <span class="text-600"><?php echo str_replace("%s",do_shortcode('[CASHBACK]'),__("Upto %s cashback!","premiumpress")); ?></span>
    
    
    <?php }else{ ?>
    
      <span class="fs-5 text-600  <?php echo $CORE->GEO("price_formatting",array()); ?>">%price%</span>
       <?php if(is_numeric($oldPrice) && $oldPrice > 0){ ?>
      <span class="fs-sm opacity-5 strike <?php echo $CORE->GEO("price_formatting",array()); ?>"><?php echo $oldPrice; ?></span>
      <?php } ?>
      
    <?php } ?> 
      
    
    </div>
  </div>
</div>
 
<div class="show-mobile">
  <div class="position-relative mb-3">
    <a href="%link%">
    <div style="height:150px; width:150px; min-width:65px;" class="position-relative"  ppt-border1 >
      <?php _ppt_template( 'cards/themes/search_badges' ); ?>
      <?php _ppt_template( 'cards/themes/search_buttons' ); ?>
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
      <span class="fs-sm opacity-5 strike <?php echo $CORE->GEO("price_formatting",array()); ?>"><?php echo $oldPrice; ?></span>
      <?php } ?>
    </div>
  </div>
</div> 