<?php
/*
Template Name: [PAGE - TESTIMONIALS]
*/

global $wpdb, $post, $wp_query;

if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }

$GLOBALS['flag-testimonials'] = true;
 
$pageLinkingID = _ppt_pagelinking("testimonials");

if( substr($pageLinkingID ,0,9) == "elementor" ){

	get_header(); 
	echo do_shortcode( "[premiumpress_elementor_template id='".substr($pageLinkingID,10,100)."']");
	get_footer();

}else{
 
   get_header();
   
   _ppt_template( 'page-before' );
   
    $CORE->LAYOUT("get_innerpage_blocks", array("page_testimonials","load"));
 
	_ppt_template( 'page-after' );
	
	get_footer();  
}

?>