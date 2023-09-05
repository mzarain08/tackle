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


if($GLOBALS['accounttype']['key'] == "visitor" && $GLOBALS['accounttype']['can_view_ads'] == "0"){
$CORE->Authorize();
}elseif($GLOBALS['accounttype']['can_view_ads'] == "0"){
header("location:"._ppt(array('links','myaccount'))."/?noaccess=1&can_view_ads=1");
die();
}
 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if(_ppt(array('captcha','enable')) == 1 && _ppt('captcha','sitekey') != ""){
 wp_enqueue_script( 'recaptcha', 'https://www.google.com/recaptcha/api.js' );
}

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

get_header();  


// BREADCRUMBS
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////// 

_ppt_template( 'single/single-breadcrumbs' );


// MOBILE BOTTOM
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////// 

_ppt_template( 'single/single-content-mobile-top' ); 
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////// 

$pageLinkingID = _ppt_pagelinking("listingpage");
 
if( substr($pageLinkingID ,0,9) == "elementor" ){ 

	$GLOBALS['flag-single-elementor'] = 1;

	echo do_shortcode( "[premiumpress_elementor_template id='".substr($pageLinkingID,10,100)."']");

}else{
	
	switch(THEME_KEY){ 
	
		case "es": {		
		_ppt_template( 'single/themes/layout_es' );		
		} break;
		
		case "mj": {		
		_ppt_template( 'single/themes/layout_mj' );		
		} break;
		
		case "cp": {		
		_ppt_template( 'single/themes/layout_cp' );		
		} break;
		
		case "dt": {		
		_ppt_template( 'single/themes/layout_dt' );		
		} break;

		case "da": {		
		_ppt_template( 'single/themes/layout_da' );		
		} break;
		
		case "at": {		
		_ppt_template( 'single/themes/layout_at' );		
		} break;
		
		case "ct": {		
		_ppt_template( 'single/themes/layout_ct' );		
		} break;
		
		case "jb": {		
		_ppt_template( 'single/themes/layout_jb' );		
		} break; 
		
		case "dl": {		
		_ppt_template( 'single/themes/layout_dl' );		
		} break;
		
		case "vt": {		
		_ppt_template( 'single/themes/layout_vt' );		
		} break;
			 
		case "rt": {		
		_ppt_template( 'single/themes/layout_rt' );		
		} break;
		
		case "pj": {		
		_ppt_template( 'single/themes/layout_pj' );		
		} break;
		
		case "sp": {		
		_ppt_template( 'single/themes/layout_sp' );		
		} break;	
		
		case "so": {		
		_ppt_template( 'single/themes/layout_so' );		
		} break;	
		 
		case "ll": {		
		_ppt_template( 'single/themes/layout_ll' );		
		} break;	
		
		case "cb": {		
		_ppt_template( 'single/themes/layout_cb' );		
		} break;	
		 
		case "cm": {		
		_ppt_template( 'single/themes/layout_cm' );		
		} break;
				 
		default: {		
		
		_ppt_template( 'single/themes/layout1' );
		
		} break; 
	} 

}


// AUTHOR SIDEBAR EDITOR
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////// 

if($userdata->ID == $post->post_author){

	_ppt_template( 'single/single-edit-page' );

}

// MOBILE BOTTOM
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////// 

if(in_array(_ppt(array('design', 'display_mobile_bottom')), array("","1"))){

	_ppt_template( 'single/single-content-mobile-bot' ); 
	
}

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

_ppt_template( 'single/single-js' ); 

get_footer(); 

?>