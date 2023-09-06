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

global $CORE, $post, $userdata, $new_settings, $CORE_UI; 


$blockType = "description";
 
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if(isset($GLOBALS['single-data-block'])){

	$blockType = $GLOBALS['single-data-block'];
	
}elseif(isset($new_settings['block_type'])){

	$blockType  = $new_settings["block_type"];
}
 

 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

switch($blockType){

	case "cashback": {

	_ppt_template( 'single/sidebar/sidebar_cb' );
	
	} break;
	case "learning": {

	_ppt_template( 'single/sidebar/sidebar_ll' );
	
	} break;
 
	case "project": {

	_ppt_template( 'single/sidebar/sidebar_pj' );
	
	} break;
	case "project-bids": {

	_ppt_template( 'single/sidebar/sidebar_pj_bids' );
	
	} break; 
	
	case "files": {
 
	_ppt_template( 'single/single-content-data-files' );
	
	} break;
	
	case "contact": {
	
	_ppt_template( 'single/single-content-data-contact' ); 
	
	} break; 

	case "related": {
	
	_ppt_template( 'single/single-content-data-related' ); 
	
	} break; 	
	
	case "membershipaccess": {
	
	_ppt_template( 'single/single-content-data-membershipaccess' );
	
	} break;
	case "faq": {

	_ppt_template( 'single/single-content-data-faq' );
	
	} break;				
	case "description": {
	
	_ppt_template( 'single/single-content-data-description' );
	
	} break;
	case "features": {
 
	 _ppt_template( 'single/single-content-data-features' ); 
	
	} break; 
	 
	 
	case "author-big":
	case "author": {
	
		$canShow = 1;
		if(is_admin()){
		
		}elseif(in_array(THEME_KEY, array('es')) && get_post_meta($post->ID,"lookinggen", true ) != 2 ){ 
			$canShow = 0; 
		}
		
		if($canShow){
			_ppt_template( 'single/single-content-data-author' );
		}
	
	} break;
  
	case "share": {
	 
		_ppt_template( 'single/single-content-data-share' );
		
	} break;
	case "hours": {
	
		_ppt_template( 'single/single-content-data-hours' );
		
	} break;
	case "services": {
	
		_ppt_template( 'single/single-content-data-services' );
		
	} break;
	
	case "map":
	case "map-big": {
	
		_ppt_template( 'single/single-content-data-map' );
		
	} break;
	case "customfields": {
	
	_ppt_template( 'single/single-content-data-fields' ); 
	
	} break;	
	case "gifts": {
	
	_ppt_template( 'single/single-content-data-gifts' );
	
	} break;
	case "videos": {
	
	_ppt_template( 'single/single-content-data-videos' );
	
	} break;
	case "rates": {
	
	_ppt_template( 'single/single-content-data-rates' );
	
	} break;
	case "reviews": {
		
		if( in_array(THEME_KEY,array("ct","da","dl","jb","pj"))){
		
		}else{
		_ppt_template( 'single/single-content-data-reviews' );
		
		}
	
	} break;
	
	case "microjob": {
	
	_ppt_template( 'single/sidebar/sidebar_mj' ); 
	 
	} break;
	
	case "dating": {
	
	_ppt_template( 'single/sidebar/sidebar_da' ); 
	 
	} break;
	
	case "compare": {
	
	_ppt_template( 'single/sidebar/sidebar_cm' ); 
	 
	} break;
	
	case "coupon": {
	
	_ppt_template( '_coupon/popup' ); 
	 
	} break;
	
	case "software": {
	
	 // RMEOVED
	 
	} break;
	
	case "classifieds": {
	
	_ppt_template( 'single/sidebar/sidebar_ct' ); 
	
	} break;
		
	case "shop": {
	
	_ppt_template( 'single/sidebar/sidebar_sp' ); 
	
	} break;
	
	case "video": {
	
	_ppt_template( 'single/sidebar/sidebar_vt' ); 
	
	} break;	
	
	case "claim":
	case "directory": {
	
	_ppt_template( 'single/sidebar/sidebar_dt_claimbox' ); 
	
	} break;
	
	case "auction": {
	
	_ppt_template( 'single/sidebar/sidebar_at_buy' ); 
	
	_ppt_template( 'single/sidebar/sidebar_at_bidbox' );
	 
	} break;
	
	  
} 


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
?>