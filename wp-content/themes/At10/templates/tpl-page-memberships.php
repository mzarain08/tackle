<?php
/*
Template Name: [PAGE - MEMBERSHIPS]
*/

global $wpdb, $post, $wp_query;

if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
 
$GLOBALS['flag-memberships'] = 1; 
 
 
$pageLinkingID = _ppt_pagelinking("memberships");

if( substr($pageLinkingID ,0,9) == "elementor" ){ 

	get_header(); 
	
	_ppt_template( 'page-before' );
	
	echo do_shortcode( "[premiumpress_elementor_template id='".substr($pageLinkingID,10,100)."']"); 
	
	_ppt_template( 'page-after' );  
	
	get_footer();  

}else{  
  
	//$CORE->LAYOUT("get_innerpage_blocks", array("page_memberships","load"));  
	
	// FORMS
   _ppt_template( 'page', 'forms' ); 
	

}
 

?>