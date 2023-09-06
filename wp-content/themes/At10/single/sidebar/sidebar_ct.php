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

global $CORE, $userdata, $post;

  
 	
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if(get_post_meta($post->ID, "status", true ) == 1){ ?>

<a href="javascript:void(0);" data-ppt-btn class="btn-system btn-block"><?php echo __("item sold","premiumpress"); ?></a>

<?php 

}else{

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$GLOBALS['single-data-field'] = "price";
?>
<div class="mb-2"><?php 
echo _ppt_template( 'single/single-content-data-fields-single' ); ?>
</div>
<?php
unset($GLOBALS['single-data-field']); 

// GET SHIPPING OST
$price_shipping = get_post_meta($post->ID,'price_shipping',true);
if($price_shipping == "" || !is_numeric($price_shipping)){$price_shipping = 0; } 



		$GLOBALS['single-data-button'] = "favs1";
		echo "<div class='mb-3'>"._ppt_template( 'single/single-content-data-buttons' )."</div>"; 
		unset($GLOBALS['single-data-button']);
 
	if(get_post_meta($post->ID, "offertype", true ) == 1){
	
		$GLOBALS['single-data-button'] = "offer"; 
		echo _ppt_template( 'single/single-content-data-buttons' ); 
		unset($GLOBALS['single-data-button']); 
		
		$GLOBALS['single-data-button'] = "buynow"; 
		echo _ppt_template( 'single/single-content-data-buttons' ); 
		unset($GLOBALS['single-data-button']); 
	
	}else{

		$GLOBALS['single-data-button'] = "offer"; 
		echo _ppt_template( 'single/single-content-data-buttons' ); 
		unset($GLOBALS['single-data-button']); 
		
	} 


	
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if($price_shipping > 0){ ?>
      <div class="small mb-4 mt-n1">
        <i class="fal fa-box mr-2"></i> <?php echo __("Shipping cost","premiumpress"); ?>: <span class="<?php echo $CORE->GEO("price_formatting",array()); ?>"><?php echo hook_price(array($price_shipping,0)) ; ?></span>
      </div>
      <?php 
} 

}  
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>