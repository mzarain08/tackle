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

global $CORE, $CORE_UI, $settings, $post, $userdata;

if(defined('DEBUG_SPEED')){ $GLOBALS['ppt_card_inner'] = microtime(true); }
	 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

	// THIS THEME
	$ThisTheme = THEME_KEY;
	if(isset($GLOBALS['TEST_THEME_KEY'])){
	$ThisTheme = $GLOBALS['TEST_THEME_KEY'];
	}
	
	$post->thistheme = $ThisTheme;
	
	// CLEAN SETITNGS GOBAL
	if( is_object($settings) ){
		unset($settings); 
		$settings = array();
	}
	 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
   // ADMIN PREVIEW
    if(!isset($post->ID)){
		$post = new stdClass();
		$post->ID 			= 1;
		$post->post_title 	= "This is a sample title."; 
		$post->post_author 	= 1; 
		$post->post_excerpt = "";
		$post->post_content = "";
		$post->comment_count = 0;
	}
	
	$thiscard = "";
 
	if(isset($settings['card']) && strlen($settings['card']) > 0){
		$thiscard = $settings['card'];
	}else{		
		$thiscard = _ppt(array('design','search_card'));	
	}
	 
	$post->card = $thiscard;
	
	// USER EDIT BOX
	$post->showupgrades = 0;
	$hits = $CORE->PACKAGE("get_hits", array($post->ID,"all"));
	 
	$status = "";
	if($userdata->ID == $post->post_author){
	
		if(isset($settings['accountpage'])){
		$post->showupgrades = 1;
		}
	
		
	
		$cstatus = $CORE->PACKAGE("get_status", $post->ID);
		if(is_array($cstatus) && isset($cstatus['key'])){
		$status = '<div class="d-flex '.$cstatus['css-btn'].' text-600" data-ppt-btn><div ppt-flex-middle><div ppt-icon-20 data-ppt-icon-size="20" class="mr-2 mt-n1">'.$CORE_UI->icons_svg['verified'].'</div></div><div ppt-flex-middle>'.$cstatus['name'].'</div></div>';
		}
	
	}
 	
	
	// READ MORE TEXT
	$post->readmore = $CORE->LAYOUT("captions","readmore"); 
	if($post->readmore == ""){ $post->readmore = __("Read More","premiumpress");}
	
	// LINK
	if(in_array($ThisTheme, array("cp")) ){
	 	
		$post->linkclean 	= get_permalink($post->ID);
		$post->link 		= $post->linkclean;
		if(substr($post->link,-1) == "/"){
			$post->link .= "?__sid=".$post->ID;
		}else{
			$post->link .= "&__sid=".$post->ID;
		}
		
	}else{
		$post->link = get_permalink($post->ID);
	}
	
	
	// CHECK MEMBERSHIP
	$post->hasMem = false;
	if(_ppt(array('mem','enable')) == "1"){
		$mymem = $CORE->USER("get_user_membership", $post->post_author);	
		if(isset($mymem['key']) && $mymem['expired'] == "0" && $mymem['user_approved'] == "1"){
			$post->hasMem = 1;
		}
	}
	

	// CHECK FOR TAX
	$post->istax = 0;
	if(isset($settings['tax']) && !empty($settings['tax']) ){
		$post->istax = 1;
	}
	
	// TITLE
	$post->title = $post->post_title;
	 
	// CLASS
	$extracss = "";
	if(in_array($ThisTheme, array("sp","da")) ){ 
	$extracss = "no-resize";
	}
	
	$post->cardclass = "card-search card-".$thiscard." card-theme-".$ThisTheme." card-zoom bg-white ".$extracss; // card-top-image  bg-white list-xsmall product mb-3 no-img-resize	
	
	// HASD VIDEO
	$post->hasVideo = 0;
	/*
	$viddata = $CORE->MEDIA("get_video_space_used", array($post->ID,0));
	if($viddata['published'] > 0){
	$post->hasVideo = 1;
	}
	*/
	 
	// ONLINE
	$post->online = 0;
	if(!in_array($ThisTheme, array("sp","ph","cm","vt","cp","dt","jb")) && $CORE->USER("get_online_status", $post->post_author)){
	$post->online = 1;
	}
	 
	// IMAGE
	$imgdata = $CORE->MEDIA("get_image_data", $post->ID);
	
	$post->image = $imgdata['thumbnail'];
	$post->imageh = $imgdata['h'];
	$post->imagew = $imgdata['w'];
	
	// USE STORE IMAGE IN CP 
	if(in_array($ThisTheme, array("cp")) ){  // && strpos($post->image, "nophoto") !== false
 
		$t = wp_get_post_terms( $post->ID, 'store', array() );	
		
		$post->store_link = "";
		$post->store_name = "";
		$post->store_image = "";
		$post->storeimageset = 0;
		$post->store_id = "";
		
			if(is_array($t) && !empty($t)){
				
				$post->store_id = $t[0]->term_id;
				$post->store_link = get_term_link($t[0]->term_id, "store");	 
				$post->store_name = strip_tags(do_shortcode('[STORENAME]')); 				
				$post->store_image = do_shortcode('[STOREIMAGE sid='.$t[0]->term_id.']');				
				$post->storeimageset = 1;
			} 
	}
	
	
	// LOCATION
	$address = "";
	$post->mapdatalink = "";
	$post->carddata = 'data-pid="'.$post->ID.'"';
	
	if(_ppt(array('maps','enable')) == 1 ){
		
		// HIDE DATA FOR BASIC MAP SETUP
		if(_ppt(array("maps","provider")) != "basic"){
		
			$long 		= get_post_meta($post->ID,'map-log',true); 
			$lat 		= get_post_meta($post->ID,'map-lat',true);	
			$address 	= get_post_meta($post->ID,'map-location',true);
			 
			if($long != ""){
			$post->carddata .= ' data-pid="'.$post->ID.'" data-lat="'. $lat.'" data-long="'.$long.'"  data-address="" ';//'.esc_attr($address).'
			$post->mapdata = ' data-pid="'.$post->ID.'" data-lat="'. $lat.'" data-long="'.$long.'"  data-address="" ';//'.esc_attr($address).'
			
			
			$post->mapdatalink = 'data-pid="'.$post->ID.'" data-title="'.strip_tags($post->title).'" 
			data-url="'.$post->link.'" 
			data-newlatitude="'.$lat.'" 
			data-address="" 
			data-newlongitude="'.$long.'"';
			
			}
			$post->maplat = $lat;
			$post->maplong = $long;
			$post->maplocation = $address; //do_shortcode('[LOCATION]');
		
		}
		
		$post->city = get_post_meta($post->ID,'map-city',true);
		$post->address = $address;
	
	}
	
	// PRICE
	if(in_array($ThisTheme, array("at")) ){
	$post->price = str_replace(",","",hook_price(array(get_post_meta($post->ID,"price_current", true), 0)));
	}else{
	$post->price = str_replace(",","",hook_price(array(get_post_meta($post->ID,"price", true), 0)));
	}
	
	// ADDONS
	$post->featured = $CORE->PACKAGE("featured",$post->ID);	
	if($post->featured){
	$extracss .= " featured";
	}
	
	// SPONSORED
	$post->sponsored = 0;
 	
	// BOOSTED
	if(isset($post->boosted)){
		$extracss .= " boosted";
	}
	
	// FAVS 
	if(in_array(_ppt(array('user','favs')), array("","1")) && !in_array($ThisTheme, array("cp")) ){
		$extracss .= " favs";
		$post->isFavs = 0; 
		if( $userdata->ID && $CORE->USER("favs_found",$post->ID) ){
			$post->isFavs = 1;
			$extracss .= " isFavs";
		}
	}
	
	// MAIN CSS CLASS
	$post->cardclass = "card-ppt-search card-zoom ".$thiscard." ".$extracss; // card-top-image  bg-white list-xsmall product mb-3 no-img-resize	

 
	// DISTANCE
	$post->distance = 0;
	$post->distance_text = "";
	if(isset($GLOBALS['distance_value']) && is_numeric($GLOBALS['distance_value'])){
	
	 	$miles =  floor($GLOBALS['distance_value']); 
		
		 
		if(!is_numeric($miles)){
		$miles = 100;
		} 
		 	
		// GET THE UNIT
		$unit = strtoupper(_ppt(array('maps','mapmetric')));			
		if ($unit == "1") {	
		
			if($miles < 2){
		   	$rt = __("Within 1 KM","premiumpress");	
			$miles=1;
		    }else{
		   	$rt = str_replace("%s", number_format(round(($miles * 1.609344),0)), __("%s KM away","premiumpress"));
		    }   
			
		} else {
		
		   if($miles < 2){
		   $rt = __("Within 1 mile","premiumpress");
		   $miles=1;
		   }else{
		   $rt = str_replace("%s", number_format($miles), __("%s miles away","premiumpress"));
		   }		    
		}
		
		//echo $rt."<--".$miles;
		 
		$post->distance = $miles;
		$post->distance_text = $rt;
	}
 
 
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 

$list_top = ""; $list_bottom = ""; $grid_bottom = "";
if($thiscard == "list"){ 
	$card_data = 'content-list';	
}else{ 
	$card_data = 'content-grid';
}
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

ob_start();
_ppt_template( $card_data ); 
$search_card = ob_get_contents();
ob_end_clean(); 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
$bottom  = ppt_theme_card_data_output($ShowdataKey = "mobile", array() );

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
$image = $post->image_formatted; 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
$cat = "";
$cat = do_shortcode('[CATEGORY limit=1]');
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
 
$data = ppt_theme_block_output($search_card, array(
"title" 			=> $post->title, 
"subtitle" 			=> "456", 
"image" 			=> $post->image, 

),array("widget")); 

$data = str_replace("%image%",$post->image,$data);
$data = str_replace("%title%",$post->title,$data);
$data = str_replace("%postid%",$post->ID,$data);
$data = str_replace("%link%",$post->link,$data);
$data = str_replace("%bottom%",$bottom,$data);
$data = str_replace("%price%",$post->price,$data);
$data = str_replace("%category%",$cat ,$data);
 
//$data = str_replace("%reviews%",$reviews,$data);
$data = str_replace("%city%",$post->city,$data);
$data = str_replace("%list_top%",$list_top,$data);
$data = str_replace("%list_bottom%",$list_bottom,$data);
$data = str_replace("%grid_bottom%",$grid_bottom,$data);

$data = str_replace("%hits%",$hits,$data);
$data = str_replace("%status%",$status,$data);



if(in_array(_ppt(array('searchcustom', 'mobileperrow')),array("1"))){
$data = str_replace("hide-mobile","",$data);
}
echo $data; 

 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////	

if(defined('DEBUG_SPEED')){
	$time = round(microtime(true) -  $GLOBALS['ppt_card_inner'],2);
	if($time > 0){ echo "card loaded in ".$time."  seconds <br>"; }
}
?>