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

global $CORE, $userdata, $CORE_UI, $post;


switch(THEME_KEY){


case "sp": {

?>

 <div class="mb-4">
      <h1 class="fs-lg text-600"><?php _ppt_template( 'single/single-content-data-title' );  ?></h1>
    </div>



<?php

} break;

case "cp": {

	$found 	= wp_get_object_terms( $post->ID, 'store' );
	if(is_array($found) && !empty($found)){
		$link = get_term_link($found[0]->term_id, "store");	 
		$name = strip_tags(do_shortcode('[STORENAME]')); 
		
		$store_image = do_shortcode('[STOREIMAGE sid='.$found[0]->term_id.']');
	}
	

?>

  <div class="d-flex align-items-center mb-4">
    <?php if(is_array($found) && !empty($found)){ ?>
    <a href="javascript:void(0);" class="btn-gocoupon mr-3" data-nextlink="<?php echo $link; ?>" data-store="1" data-couponid="<?php echo $found[0]->term_id; ?>">
    <div style="height:40px; width:80px; min-width:80px;" class="store-icon-small">
      <div ppt-border1 class="h-100 position-relative">
        <div class="bg-image" data-bg="<?php echo $store_image; ?>">
          &nbsp;
        </div>
      </div>
    </div>
    </a>
    <?php } ?>
    <div class="fs-5 text-600 cursor " onclick="jQuery('.coupon-btn-<?php echo $post->ID; ?>').trigger('click');">
      <h1 class="fs-lg text-600"><?php _ppt_template( 'single/single-content-data-title' );  ?></h1>
    </div>
  </div>

<?php

} break;

case "cb": {

 
$url = get_post_meta($post->ID, "buy_link", true);
if($url == ""){

	$found 	= wp_get_object_terms( $post->ID, 'store' ); 
	if(is_array($found) && !empty($found)){
	 	
		if(  strlen(_ppt('storelinkaff_'.$found->term_id)) >  2){  
			$url = _ppt('storelinkaff_'.$found->term_id);		
		}elseif( strlen(_ppt('storelink_'.$found->term_id)) >  2){  
			$url = _ppt('storelink_'.$found->term_id); 
		} 
		 
	} 

}

if(substr($url,0,4) != "http"){
	$url = "https://".$url;
} 

?>
 
<div class="mb-4 pb-3 border-bottom">
<div class="row">
<div class="col-md-8">


<h1 class="fs-lg text-600">
<?php _ppt_template( 'single/single-content-data-title' );  ?>
</h1>


    <div class="mt-3 d-md-flex text-600 link-dark fs-6 mt-3 download-bar mobile-mb-2">
     
    		
    <?php if(strlen($url) > 1){ ?>
    <a target="_blank" class="mr-3" href="<?php echo $url; ?>" rel="nofollow" target="_blank">
    <i class="fal fa-external-link mr-2 text-primary"></i> <span class="ml-2"><?php echo __("Visit Store","premiumpress"); ?></span>
    </a>
    <?php } ?>
    
     <div class="mr-3">
			<i class="fal fa-eye mr-2 text-primary"></i> <span><?php echo do_shortcode('[HITS]'); ?> <?php echo __("Views","premiumpress"); ?></span>
	</div>
    
    <?php if(in_array(_ppt(array('user','favs')), array("","1")) ){ ?>
    <div class=" d-inline-flex cursor">
    <div class="mr-2"><i class="fal fa-star mr-2 text-primary"></i></div> <span><?php echo do_shortcode('[BUTTON_USER type="favs" button="0" class="" text=1 uid="'.$userdata->ID.'"]'); ?></span>
    </div>
    <?php } ?>
    
    </div>

</div>
<div class="col-md-4 y-middle">

 <?php
 
$GLOBALS['single-data-button'] = "cashback";
echo _ppt_template( 'single/single-content-data-buttons' ); 
unset($GLOBALS['single-data-button']); 
 
 ?>

</div>
</div>
</div>
<?php
	
	} break;


	case "so": {

 
$url = get_post_meta($post->ID, "url", true);
$url_demo = get_post_meta($post->ID, "url_demo", true);
 

?>
 
<div class="mb-4 pb-3 border-bottom">
<div class="row">
<div class="col-md-8">


<h1 class="fs-lg text-600">
<?php _ppt_template( 'single/single-content-data-title' );  ?>
</h1>


    <div class="mt-3 d-md-flex text-600 link-dark fs-6 mt-3 download-bar mobile-mb-2">
    <?php if(strlen($url) > 1){ ?>
    <a target="_blank" class="mr-3" href="<?php echo $url; ?>" rel="nofollow" target="_blank">
    <i class="fal fa-external-link mr-2 text-primary"></i> <span class="ml-2"><?php echo __("Developer Website","premiumpress"); ?></span>
    </a>
    <?php } ?>
    
    <?php if(strlen($url_demo) > 1){ ?>
    <a target="_blank" class="mr-3" href="<?php echo $url_demo; ?>" rel="nofollow" target="_blank">
    <i class="fal fa-eye mr-2 text-primary"></i> <span><?php echo __("View Demo","premiumpress"); ?></span>
    </a>
    <?php } ?>
    
    <?php if(in_array(_ppt(array('user','favs')), array("","1")) ){ ?>
    <div class=" d-inline-flex cursor">
    <div class="mr-2"><i class="fal fa-star mr-2 text-primary"></i></div> <span><?php echo do_shortcode('[BUTTON_USER type="favs" button="0" class="" text=1 uid="'.$userdata->ID.'"]'); ?></span>
    </div>
    <?php } ?>
    
    </div>

</div>
<div class="col-md-4 y-middle">

 <?php
 
$GLOBALS['single-data-button'] = "download";
echo _ppt_template( 'single/single-content-data-buttons' ); 
unset($GLOBALS['single-data-button']); 
 
 ?>

</div>
</div>
</div>
<?php
	
	} break;

	case "es": {
	
		$geo = $CORE->GEO("get_post_geo_data", $post->ID);
	 	 
		 
		?> 
		<div class="mb-4 pb-3 border-bottom">
		 
		
		
		<h1 class="fs-lg text-600">
		<?php _ppt_template( 'single/single-content-data-title' );  ?>
		</h1>
		
		
			<div class="mt-3 d-md-flex text-600 link-dark fs-7 mt-3 download-bar mobile-mb-2">
			<?php if(strlen($geo['city']) > 1){ ?>
			<a class="mr-3 text-dark" href="<?php echo $geo['city_link']; ?>">
			<i class="fal fa-map-marker mr-2 text-primary"></i> <span><?php echo $geo['city']; ?></span>
			</a>
			<?php } ?>
			 
			<?php if(in_array(_ppt(array('user','favs')), array("","1")) ){ ?>
			<div class=" d-inline-flex cursor">
			<div class="mr-2"><i class="fal fa-star mr-2 text-primary"></i></div> <span><?php echo do_shortcode('[BUTTON_USER type="favs" button="0" class="" text=1 uid="'.$userdata->ID.'"]'); ?></span>
			</div>
            <?php } ?>
			
			</div>
	 
		</div><?php
	
	} break;


	case "jb": {
	
		$url = get_post_meta($post->ID, "url", true);
		if($url == ""){
			$url = get_post_meta($post->ID, "website", true);
		}
		
		$geo = $CORE->GEO("get_post_geo_data", $post->ID);
	 	 
		 
		?> 
		<div class="mb-4 pb-3 border-bottom">
		<div class="row">
		<div class="col-md-8">
		
		
		<h1 class="fs-lg text-600">
		<?php _ppt_template( 'single/single-content-data-title' );  ?>
		</h1>
		
		
			<div class="mt-3 d-md-flex text-600 link-dark fs-6 mt-3 download-bar mobile-mb-2">
			<?php if(strlen($url) > 8){
			
			if(substr($url,0,4) != "http"){
			$url = "https://".$url;
			}
			
			 ?>
			<a target="_blank" class="mr-3" href="<?php echo $url; ?>" rel="nofollow" target="_blank">
			<i class="fal fa-external-link mr-2 text-primary"></i> <span class="ml-2"><?php echo __("Visit Website","premiumpress"); ?></span>
			</a>
			<?php } ?>
			
		    <?php if(strlen($geo['city']) > 1){ ?>
			<a class="mr-3 text-dark" href="<?php echo $geo['city_link']; ?>">
			<i class="fal fa-map-marker mr-2 text-primary"></i> <span><?php echo $geo['city']; ?></span>
			</a>
			<?php }else{ ?>
			<div class="mr-3">
			<i class="fal fa-eye mr-2 text-primary"></i> <span><?php echo do_shortcode('[HITS]'); ?> <?php echo __("Views","premiumpress"); ?></span>
			</div>
            <?php } ?>
			 
			
			<div class=" d-inline-flex cursor">
			<div class="mr-2"><i class="fal fa-star mr-2 text-primary"></i></div> <span><?php echo do_shortcode('[BUTTON_USER type="favs" button="0" class="" text=1 uid="'.$userdata->ID.'"]'); ?></span>
			</div>
			
			</div>
		
		</div>
		<div class="col-md-4 y-middle">
		
		 <?php
		 
		$GLOBALS['single-data-button'] = "offer";
		echo _ppt_template( 'single/single-content-data-buttons' ); 
		unset($GLOBALS['single-data-button']); 
		 
		 ?>
		
		</div>
		</div>
		</div><?php
	
	} break;
	
	case "dt": {
	
		$url = get_post_meta($post->ID, "url", true);
		if($url == ""){
			$url = get_post_meta($post->ID, "website", true);
		}
		
		$geo = $CORE->GEO("get_post_geo_data", $post->ID);
	 	 
		 
		?> 
		<div class="mb-4 pb-3 border-bottom">
		<div class="row">
		<div class="col-md-8">
		
		
		<h1 class="fs-lg text-600">
		<?php _ppt_template( 'single/single-content-data-title' );  ?>
		</h1>
		
		
			<div class="mt-3 d-md-flex text-600 link-dark fs-6 mt-3 download-bar mobile-mb-2">
			<?php if(strlen($url) > 8){
			
			if(substr($url,0,4) != "http"){
			$url = "https://".$url;
			}
			
			 ?>
			<a target="_blank" class="mr-3" href="<?php echo $url; ?>" rel="nofollow" target="_blank">
			<i class="fal fa-external-link mr-2 text-primary"></i> <span class="ml-2"><?php echo __("Visit Website","premiumpress"); ?></span>
			</a>
			<?php } ?>
			
		    <?php if(strlen($geo['city']) > 1){ ?>
			<a class="mr-3 text-dark" href="<?php echo $geo['city_link']; ?>">
			<i class="fal fa-map-marker mr-2 text-primary"></i> <span><?php echo $geo['city']; ?></span>
			</a>
			<?php }else{ ?>
			<div class="mr-3">
			<i class="fal fa-eye mr-2 text-primary"></i> <span><?php echo do_shortcode('[HITS]'); ?> <?php echo __("Views","premiumpress"); ?></span>
			</div>
            <?php } ?>
			 
			
			<div class=" d-inline-flex cursor">
			<div class="mr-2"><i class="fal fa-star mr-2 text-primary"></i></div> <span><?php echo do_shortcode('[BUTTON_USER type="favs" button="0" class="" text=1 uid="'.$userdata->ID.'"]'); ?></span>
			</div>
			
			</div>
		
		</div>
		<div class="col-md-4 y-middle">
		
		 <?php
		 
		$GLOBALS['single-data-button'] = "message";
		echo _ppt_template( 'single/single-content-data-buttons' ); 
		unset($GLOBALS['single-data-button']); 
		 
		 ?>
		
		</div>
		</div>
		</div><?php
	
	} break;
	
	default: {
	?>
	<h1 class="fs-lg text-600">
	<?php _ppt_template( 'single/single-content-data-title' );  ?>
	</h1>
	
	<?php
	
	}

}

?>