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

global $CORE, $userdata;


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if(isset($GLOBALS['flag-taxonomy']) && $GLOBALS['flag-taxonomy-type'] == "store"){ 

	 
	_ppt_template( 'search', 'taxonomy-store-sidebar' ); 

} 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
echo $CORE->ADVERTISING("display_banner", "search_sidebar_top" ); 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

ob_start();
dynamic_sidebar("search_sidebar"); 
$sidebar_content = ob_get_clean();
if (ob_get_level() > 0) {ob_flush();}

// WP BLANK DEFAULTS
if(strpos($sidebar_content,"blank-widget") !== false){ $sidebar_content = ""; }

if(strlen($sidebar_content) < 10 && defined("THEME_KEY") && THEME_KEY == "cp" && !isset($GLOBALS['flag-taxonomy']) ){ 
		
		global $settings;
		
		$settings['num'] = 3;
		
		_ppt_template( 'framework/design/widgets/widget', 'coupon-pop' );		
		
		_ppt_template( 'framework/design/widgets/widget', 'coupon-categories' );		
		 	
		_ppt_template( 'framework/design/widgets/widget', 'coupon-stores' );
		
		//_ppt_template( 'framework/design/widgets/widget', 'coupon-deals' );
		
		_ppt_template( 'framework/design/widgets/widget', 'blog-recent' );
 
}else{

echo $sidebar_content;

}
 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

//echo $CORE->ADVERTISING("display_banner", "search_sidebar_bottom_small" );  
 
 
echo $CORE->ADVERTISING("display_banner", "search_sidebar_bottom" ); 
		
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
	
?>