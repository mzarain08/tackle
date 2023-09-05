<?php
/*
* @@ PremiumPress Framework Config
* @ Developed By Mark Fail
*
*
*
*
*
*
*
*
*
*
*
*
*
*
*/
$GLOBALS['ppt_start_time'] = microtime(true);
$GLOBALS['ppt_start_time_top'] = $GLOBALS['ppt_start_time'];
/*
 
=============================================================================
   LOAD IN FRAMEWORK IMAGES
============================================================================*/ 
  	
//ini_set('max_execution_time', '0');
//error_reporting( E_ERROR | E_WARNING | E_PARSE | E_NOTICE | E_STRICT );	 
//ini_set( 'display_errors', 0);

$host = $_SERVER['HTTP_HOST'];
if( in_array($host, array('localhost','10.0.0.3')) || strpos($host,"premiummod.com") !== false ){	
	define('WLT_DEMOMODE',true); 
}

/*
define("CDN_PATH", "http://localhost/WP/wp-content/themes/MOVED_OUT_FOR_CDN/");
define("DEMO_IMG_PATH", "http://localhost/V10IMAGES/_demoimagesv10/");
define("DEMO_IMGS", "http://localhost/demoimages/img.php");
define("ELE_PATH", "http://localhost/ELEMENTOR/server.php");
define("IP_PATH", "http://localhost/IPGET/index.php");
*/

//define("DEBUG_SPEED",1);

define("DEMO_IMGS", "https://premiummod.com/demoimages/img.php");
define("CDN_PATH", "https://ppt1080.b-cdn.net/");
define("DEMO_IMG_PATH", "https://premiumpress1063.b-cdn.net/_demoimagesv10/"); 
define("ELE_PATH", "https://premiummod.com/elementor/server.php");
define("IP_PATH", "https://premiummod.com/ipdata/index.php");

/*
=============================================================================
   QUICK VALIDATION FOR USERS
============================================================================*/ 
 
if(isset($_GET['eid'])){
	if(!is_numeric($_GET['eid'])){
		die("invalid ID");
	}
}
if(isset($_GET['s'])){
	$_GET['s'] = esc_attr($_GET['s']);
}

/*
*
=============================================================================
   LOAD IN FRAMEWORK IMAGES
============================================================================*/ 
 
define("THEME_TAXONOMY", "listing");
if(function_exists('wp_get_current_user')){
define('ppt_orderby_PATH',    get_template_directory()."/framework/orderby/");
define('ppt_orderby_URL',     get_template_directory_uri()."/framework/orderby/");
require_once get_template_directory() ."/framework/orderby/main.php";
} 
 
/*=============================================================================
   LOAD IN THEME EXTRAS
============================================================================*/

$coretheme = get_option('ppt_theme');
if($coretheme != ""){
	if(file_exists(get_template_directory() .'/_'.$coretheme.'/functions.php')){
		require_once get_template_directory() .'/_'.$coretheme.'/functions.php';
	}
} 
if(!defined('THEME_KEY')){
	define('THEME_KEY','dt');
}
 
/*=============================================================================
   LOAD IN THEME EXTRAS
============================================================================*/

require_once get_template_directory() ."/framework/data/_cities.php";
 
$files = array(
"ppt_1_functions.php","ppt_2_layout.php","ppt_3_media.php","ppt_4_orders.php","ppt_5_search.php","ppt_6_shortcodes.php","ppt_7_updates.php","ppt_8_email.php","ppt_9_ajax.php","ppt_10_geo.php","ppt_11_advertising.php","ppt_12_addlisting.php","ppt_13_user.php","ppt_14_mobile.php","ppt_15_wptemplates.php","ppt.php","ppt_extra_walkers.php","ppt_extra_widgets.php","ppt_core.php","ppt_16_ui.php","ppt_hooks_filters.php","ppt_gateways.php","ppt_extra_install.php"); 

foreach($files as $f){
include get_template_directory() ."/framework/new_class/".$f;
}

$CORE			= new premiumpress_themes;
$CORE_UI		= new premiumpress_ui;
 

if(defined('WLT_CART') || defined('THEME_KEY') && in_array(THEME_KEY, array("so")) ){
	require_once get_template_directory() ."/framework/new_class/ppt_extra_cart.php";
	$CORE_CART	= new framework_cart;
}


// ELEMENTOR PAGE BUILDER BLOCKS
define('ELEMENTOR_WIDGET_NAME','new-hero');
require_once get_template_directory() ."/framework/elementor/elementor-functions.php";
if(defined('ELEMENTOR_VERSION') ){
require_once get_template_directory() ."/framework/elementor/elementor.php";
}
 

/*=============================================================================
   LOAD IN ADMIN FRAMEWORK
============================================================================*/

if(is_admin()){
	require_once (get_template_directory() ."/framework/new_class/class_admin_design.php");
	require_once (get_template_directory() ."/framework/new_class/class_admin.php");
	
	$CORE_ADMIN	 			= new ppt_admin;
	$WLT_ADMIN 				= $CORE_ADMIN;
 	
}else{
	add_action('init', array( $CORE, 'INIT') );
}

?>