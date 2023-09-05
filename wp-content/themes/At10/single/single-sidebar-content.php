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

global $CORE, $CORE_UI, $userdata, $post;

?>
 <div class="mb-3">
<?php
if(defined('THEME_KEY')){
	switch(THEME_KEY){
	
		case "so": {
		
	 	
		} break;
		case "cb": {
		
		$GLOBALS['single-data-block'] = "cashback";
		echo _ppt_template( 'single/single-content-data-block' ); 
		unset($GLOBALS['single-data-block']);		
		
		} break;
		case "ll": {
		
		$GLOBALS['single-data-block'] = "learning";
		echo _ppt_template( 'single/single-content-data-block' ); 
		unset($GLOBALS['single-data-block']);		
		
		} break;	
		case "pj": {
		
		$GLOBALS['single-data-block'] = "project";
		echo _ppt_template( 'single/single-content-data-block' ); 
		unset($GLOBALS['single-data-block']);		
		
		} break;
	
		case "at": {
		
		$GLOBALS['single-data-block'] = "auction";
		echo _ppt_template( 'single/single-content-data-block' ); 
		unset($GLOBALS['single-data-block']);	
		
		} break;
		
		case "cp": {
		
		$GLOBALS['single-data-block'] = "coupon";
		echo _ppt_template( 'single/single-content-data-block' ); 
		unset($GLOBALS['single-data-block']);	
		
		} break;
		
		case "da": {
		
		$GLOBALS['single-data-block'] = "dating";
		echo _ppt_template( 'single/single-content-data-block' ); 
		unset($GLOBALS['single-data-block']);	
		
		} break;
		
		case "es": {
		
		$GLOBALS['single-data-block'] = "escort";
		echo _ppt_template( 'single/single-content-data-block' ); 
		unset($GLOBALS['single-data-block']);	
		
		} break;
		
		case "mj": {
		
		$GLOBALS['single-data-block'] = "microjob";
		echo _ppt_template( 'single/single-content-data-block' ); 
		unset($GLOBALS['single-data-block']);	
		
		} break;
		
		case "ct": {
		
		$GLOBALS['single-data-block'] = "classifieds";
		echo _ppt_template( 'single/single-content-data-block' ); 
		unset($GLOBALS['single-data-block']);	
		
		} break;
		
		case "sp": {
		
		$GLOBALS['single-data-block'] = "shop";
		echo _ppt_template( 'single/single-content-data-block' ); 
		unset($GLOBALS['single-data-block']);	
		
		} break;
		
		case "vt": {
		
		$GLOBALS['single-data-block'] = "video";
		echo _ppt_template( 'single/single-content-data-block' ); 
		unset($GLOBALS['single-data-block']);	
		
		} break;
		
		case "ll":
		
 		case "sp":
		//case "rt":
		//case "jb":
		case "ct":
		case "cm": 
		case "dl": {
		
		 $GLOBALS['single-data-field'] = "price";
		 echo _ppt_template( 'single/single-content-data-fields-single' );
		 unset($GLOBALS['single-data-field']); 
		
		} break;		
	
	}
}
?>
 
</div>
<?php 
 


if(defined('THEME_KEY')){
	switch(THEME_KEY){
	
		case "at": {
		
		_ppt_template( 'single/sidebar/sidebar_at_bidhistory' );		
		
		} break;
		
		case "dt": {
		
	
		} break; 
		
		case "cm": {
		
		$GLOBALS['single-data-block'] = "compare";
		echo _ppt_template( 'single/single-content-data-block' ); 
		unset($GLOBALS['single-data-block']);		
		
		} break;
		
  
				

 
		default: {
		
		 		
		} break;	
	
	}
} 
 

?>