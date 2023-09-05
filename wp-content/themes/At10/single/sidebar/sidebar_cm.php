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

$data = get_post_meta($post->ID,'comparedata',true);

$blink = get_post_meta($post->ID, 'buy_link',true);

if(is_admin()){

 // SAMPLE DATA HERE
}


?>

<a href="<?php echo $blink; ?>" target="_blank" rel="nofollow" data-ppt-btn class="btn-primary mb-1 btn-lg btn-block"><?php echo __("View Deal","premiumpress"); ?></a>

<?php

if(is_array($data) && !empty($data) ){ $i = 0;

?>
<script type="text/javascript"> 
jQuery(document).ready(function(){ 
 
	if(jQuery("#4_services_wrap").html().length < 800){
		jQuery("#4_services_wrap").hide();
	}
			
});
</script>
 
<div id="pricecomparetable" class="my-4">
 
<?php if(!isset($data['store']) || isset($data['store']) && !is_array($data['store'])){ $data['store'] = array(); }

 

foreach($data['store'] as $d){ 

$storedata = get_term_by('id', $d, 'store');
if(isset($storedata->name)){
$store_name =  $storedata->name;

$store_image = do_shortcode('[STOREIMAGE sid='.$storedata->term_id.']');
	if(defined('WLT_DEMOMODE') && $store_image == ""){
		if(isset($_SESSION['design_preview'])){
			$store_image = DEMO_IMGS."?fw=text160&i=".rand(1,8)."&t=".THEME_KEY."&ct=".$_SESSION['design_preview'];
		}
	}
?>

    <a href="<?php echo $data['link'][$i]; ?>"  class="text-decoration-none text-dark link-dark btn-block border shadow-sm p-3 rounded bg-white">
    <div class="d-flex">
      <div class="w-100">
      
      <div>
      
      <img src="<?php echo $store_image; ?>" style="max-height:60px; width:60px; margin-right:10px;float:left; margin-top:5px;" />
      </div>
      
      
        <div class="d-flex justify-content-between">
          <div>
            <div  class="text-700">
            <?php echo $store_name; ?> 
            </div>
            <div class="d-flex justify-content-between small mt-2">
              <div class="text-700 text-primary prictag h6 mb-0">
               <span data-val="<?php echo $data['price'][$i]; ?>"> <?php echo hook_price($data['price'][$i]); ?> </span>
              </div>
             
            </div>
          </div>
          <i class="fa fa-chevron-right fa-2x mt-2 mr-2"></i>
        </div>
      </div>
    </div>
    </a>


<?php $i++; } ?>
 <?php  }  } ?>
 
 <?php
 
 


// ONLY LOAD THIS IN IF THE DATAFEEDR PLUGIN
// HAS BEEN FOUND AND WORKING
if(defined('DFRCS_VERSION')){

ob_start();
	$price 	= get_post_meta($post->ID, 'price', true);
	$ean 	= get_post_meta($post->ID, 'ean', true);
	$upc 	= get_post_meta($post->ID, 'upu', true);
	$isbn 	= get_post_meta($post->ID, 'isbn', true);
	$asin 	= "";//get_post_meta($post->ID, 'asin', true);
	
	if(!is_numeric($price)){ $price = 0; }
 	 
 
	if(strlen($asin) > 1){
		echo do_shortcode('[dfrcs asin="'.$asin.'"  filters="finalprice_min='.$price.'"]');
	 
	}elseif($ean != ""){
		echo do_shortcode('[dfrcs ean="'.$ean.'"  filters="finalprice_min='.$price.'"]');
	}elseif($upc != ""){
		echo do_shortcode('[dfrcs upc="'.$upc.'" filters="finalprice_min='.$price.'"]');
	}elseif($isbn != ""){
		echo do_shortcode('[dfrcs isbn="'.$isbn.'" filters="finalprice_min='.$price.'"]');
	}else{
		
		$tags = $CORE->get_edit_data('post_tags', $post->ID ); 
		$keywords = $tags;
		
		if(strlen($keywords) < 4){
		$keywords = $post->post_title;
		}
	 
		echo do_shortcode('[dfrcs name="'.$keywords.'" filters="finalprice_min='.$price.'"]');
	}

$content = ob_get_contents();
ob_end_clean();

echo $content; 

} 
?>
</div>
<style>
#pricecomparetable h2 { display:none; }
</style>
<script>
jQuery(document).ready(function() { 
	
	setTimeout( function(){ 
	
	jQuery( "#pricecomparetable .dfrcs_price" ).addClass("text-dark");
	
	jQuery( "#pricecomparetable .dfrcs_action" ).addClass("btn btn-primary").removeClass('dfrcs_action').html('<?php echo __("View Deal","premiumpress"); ?>');
		
	  }  , 1000 );
});
</script>