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

global $CORE, $post, $userdata, $new_settings; 


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

 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$mapImage = CDN_PATH."images/mapbg.jpg";
$DirectionsLink = "";

if(_ppt(array("maps","provider")) != "basic"){
	
		$long 		= get_post_meta($post->ID,'map-log',true); 
		$lat 		= get_post_meta($post->ID,'map-lat',true);	
		$address	= get_post_meta($post->ID,'map-location',true);			
				
		$post->carddata = 'data-pid="'.$post->ID.'" data-lat="'. $lat.'" data-long="'.$long.'" data-address="'.$address .'" ';
		$post->maplat = $lat;
		$post->maplong = $long;
		
		if(strlen($lat) > 1 && strlen($long) > 1){
		$DirectionsLink = "https://www.google.com/maps/dir/?api=1&origin=".$lat.",".$long."&destination=".$lat.",".$long."";
		}
	}
	
	if(is_admin() || in_array(_ppt(array("maps","provider")), array("basic","")) ){ 
	
	
	}elseif(strlen($address) > 2 && _ppt(array("maps","provider")) == "google"){ 

	$mapImage = CDN_PATH."images/mapbg.jpg";	
	
	}elseif(strlen($address) > 2 && _ppt(array("maps","provider")) == "mapbox"){
	
	$mapImage = "https://api.mapbox.com/styles/v1/mapbox/streets-v11/static/".$long.",".$lat.",16,0,10/1000x1000?access_token="._ppt(array('maps','apikey'));	
	
	} 
 	
	if(is_admin()){
	$mapImage = CDN_PATH."images/mapbg.jpg";
	$address 	= "Buckingham Palace, London SW1A 1AA, United Kingdom.";
	$post->maplocation = "Buckingham Palace, London SW1A 1AA, United Kingdom.";
	$post->city = "London";
	}else{
	$address 	= get_post_meta($post->ID,'map-location',true);
	$post->maplocation = do_shortcode('[LOCATION]');
	$post->city = do_shortcode('[CITY]');

 	}


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
if(strlen($address) > 2){
 ?>


<div class="position-relative rounded overflow-hidden w-100 mt-2" >
	<div class="bg-image bg-light" data-bg="<?php echo $mapImage; ?>"></div>
    
    
    <div class="z-1 d-flex y-middle" style="height:200px;">
    
   <div class="z-10">
       <?php if(_ppt(array("maps","provider")) != "basic" && $post->maplat != "" && $post->maplong != "" ){ ?>
        <a href="javascript:void(0);" class=" btn btn-primary text-600 <?php if($address == ""){  }else{ echo "single-map-item"; } ?>"
    data-title="<?php echo strip_tags($post->post_title); ?>" 
    data-url="<?php echo get_permalink($post->ID); ?>" 
    data-newlatitude="<?php echo $post->maplat; ?>" 
    data-address="<?php echo $post->maplocation; ?>" 
    data-newlongitude="<?php echo $post->maplong; ?>"> <i class="fal fa-map-marker mr-2"></i> <?php echo __("View Map","premiumpress"); ?> </a>
        <?php } ?>
        
        
        <?php if(strlen($address) > 3 && !isset($DirectionsLinkSet) && isset($DirectionsLink) && strlen($DirectionsLink) > 1){ ?>
        <a href="<?php echo $DirectionsLink; ?>" target="_blank" class="ml-3 btn hide-mobile btn-primary text-600"><?php echo __("Get Directions","premiumpress"); ?></a>
        <?php } ?>
    </div>
    
    </div>
    
</div> 

<div class="text-600 mt-3"><?php echo $address; ?></div>

 
<?php 

}

?>