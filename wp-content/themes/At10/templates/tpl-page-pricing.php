<?php
/*
Template Name: [PAGE - PRICING]
*/
 
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
 
global  $userdata, $CORE;

$GLOBALS['flag-pricing'] = 1;

$pageLinkingID = _ppt_pagelinking("pricing");
 
if( substr($pageLinkingID ,0,9) == "elementor" ){

	get_header(); 

		echo do_shortcode( "[premiumpress_elementor_template id='".substr($pageLinkingID,10,100)."']");

	get_footer();

}else{
 
   get_header(); 
   
   _ppt_template( 'page-before' ); 
   
   $CORE->LAYOUT("get_innerpage_blocks", array("page_pricing","load"));
 	
	_ppt_template( 'page-after' );
	
	get_footer(); 

} ?>