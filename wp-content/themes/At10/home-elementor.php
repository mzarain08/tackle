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
 
global $CORE;
	
	// TURN OFF HEADER/FOOTER FOR DISPLAY
	define('NOHEADERFOOTER', 1);
	 
 	// GET TEMPLATE DETAILS
	$g = $CORE->LAYOUT("load_single_design", $_SESSION['design_preview']);
	 
	$preview_name = $g['key']." - ".date('Y');	
	
	// CHECK FOR PAGE
	$exi = get_page_by_title( $preview_name , OBJECT, 'elementor_library');	
	
	// CHECK EXISTS
	if ($exi && $exi->post_status == "publish") {
	
		$f = get_page_by_title( $preview_name , OBJECT, 'elementor_library');
		
		get_header();
		
		echo do_shortcode( "[premiumpress_elementor_template id='".$f->ID."']");
		
		get_footer();		
	
	// CREATE NEW ONE
	}else{	
	
		// DELETE CURRENT PAGE
		if($exi){
			wp_delete_post($exi->ID, true);
		}
	
		$elementor_file = $g['elementor']['homepage'];	
	 
		if(!file_exists($elementor_file)){ unset($_SESSION['design_preview']); die("preview file not found"); }
		 
		// PROCESS IT 
		$elementor_importer = new PremiumPress_Elementor_Importer();
		$id = $elementor_importer->import_elementor_file( $elementor_file, $g['key']." - ".date('Y') );
	
		// DISLAY IT
		get_header(); 	
					
		echo do_shortcode( "[premiumpress_elementor_template id='".$id."']");	
						
		get_footer();
	}	
	
 

?>