<?php
   /*
   Template Name: [PAGE - ADD LISTING]
    
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
   
   global $CORE, $userdata, $CORE;  
 
$GLOBALS['flag-add'] = 1;

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if(_ppt(array('captcha','enable')) == 1 && _ppt('captcha','sitekey') != ""){
 wp_enqueue_script( 'recaptcha', 'https://www.google.com/recaptcha/api.js' );
}

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if($GLOBALS['accounttype']['key'] == "visitor" && $GLOBALS['accounttype']['can_add'] == "0"){
$CORE->Authorize();
}

get_header();   
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$canContinue = 1;
 
 
if( !isset($_GET['eid']) && isset($GLOBALS['accounttype']) && $GLOBALS['accounttype']['can_add'] == "0" && !$CORE->USER("membership_hasaccess", "listings_multiple") ){

	$canContinue = 0;
	_ppt_template( 'forms/add-listing-noaccess' );	 
}
 
if( !isset($_GET['eid']) && isset($GLOBALS['accounttype']) && $GLOBALS['accounttype']['can_add_multiple'] == "0" && $userdata->ID ){  	
 
	if(in_array(THEME_KEY, array("da")) || $CORE->USER("count_listings_all", $userdata->ID) > 0 && !$CORE->USER("membership_hasaccess", "listings_multiple")){
	
	$canContinue = 0;
	_ppt_template( 'forms/add-listing-noaccess-multiple' );
	
	}

}

if($canContinue){
	_ppt_template('forms/add-listing' );
}


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

get_footer();  ?>
