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


switch(THEME_KEY){
 
	case "cp": { global $CORE_COUPON;
	
	if($CORE->isMobileDevice()){
	// TYPE
	$type = strip_tags(do_shortcode('[CTYPE]'));

	// GET CODE
	$code = get_post_meta($post->ID,'code',true);
	if($code == "" && strtolower($type) == "coupon" ){
		$code = $CORE_COUPON->_randomcode(6);
	}
 	if($code != ""){
	?>
        
    <div class="ppt-tabs-listing border-0 show-mobile">
    <div class="fieldset">
    <div class="_title bg-white"><?php echo __("Coupn Code","premiumpress"); ?></div>
    <div class="_price">
              <?php echo $code; ?>
         </div>
    </div>
    </div>
       
       
    <?php
    
    } } ?>
    
    
    <?php if(_ppt(array('cashback', 'enable' )) != '0'){ ?>
      <div class="text-center p-3 bg-light mb-4 show-mobile">
        <?php   echo do_shortcode('[CASHBACK text="'.__("Earn %s cashback!","premiumpress").'"]'); ?>
      </div>
      <?php } ?>
    
    <?php


	} break; 
	
	case "vt": {
	?>
    <div class="show-mobile pt-2">&nbsp;</div>
    <?php
	} break;
	
	case "cb":
	case "jb":
	case "pj": {
	
	?>
    <div class="show-mobile pt-3">&nbsp;</div>
    <?php
	} break;
	
	
	default: {
	?>
    
    <div id="mobileGallery"></div>
    
    <?php
	
// GET FILES
/*
$files = $CORE->MEDIA("get_formatted_images_for_header", 0);

// LIGHTBOX FIX FOR ELMENTOR
$lightbox = 'data-toggle="lightbox"';
  
	
?>


<div class="show-mobile">
    <div class="owl-mobile-slider position-relative">
        <div class="bg-light" style="height:250px; overflow:hidden;">
        
            <div  class="owl-carousel-basic owl-carousel owl-theme clearfix mb-4 overflow-hidden" data-1000="1" data-600="1">      
                  <?php $i=1; foreach($files as $f){ ?>
                  <div class="item">
                 
                      <a href="<?php echo $f['src']; ?>" <?php echo $lightbox; ?> data-type="image"> <img src="<?php echo $f['src']; ?>" class="img-fluid" alt="image <?php echo $i; ?>"> </a>
                
                  </div>
                  <?php $i++; } ?>
            </div>  
        </div>
        
         <a href="javascript:void(0);" class="btn next position-absolute h-100" style="z-index:10;top:0px; right:0px; line-height: 240px;"><i class="fa fa-chevron-right text-light fa-2x"></i> </a>
        <a href="javascript:void(0);" class="btn prev position-absolute h-100" style="z-index:10;top:0px; leftt:0px; line-height: 240px;"><i class="fa fa-chevron-left text-light fa-2x"></i> </a>
        
    <div style="height:40px; border-radius:20px;" class="bg-white m-n2">&nbsp;</div>
    </div>
</div>
  

<?php
*/	
	
	
	} break;
	
	
	
	
 
} 
?>

