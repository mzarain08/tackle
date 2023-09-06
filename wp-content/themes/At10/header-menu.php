<?php
/* 
* Theme: PREMIUMPRESS CORE FRAMEWORK FILE
* Url: www.premiumpress.com
* Author: Mark Fail1
*
* THIS FILE WILL BE UPDATED WITH EVERY UPDATE
* IF YOU WANT TO MODIFY THIS FILE, CREATE A CHILD THEME
*
* http://codex.wordpress.org/Child_Themes
*/
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }

global $CORE, $userdata, $settings;


if(_ppt(array('design','notify')) == 1){
?>
<div class="py-2 small" style="background:#222; color:#fff;">

<div class="text-center">

<span class="mr-3"><?php echo _ppt(array('design','notify_text')); ?></span> <a href="<?php echo _ppt(array('design','notify_link')); ?>" class="btn btn-sm btn-light" style="font-size:10px; letter-spacing:1px; line-height:10px;"><?php echo __("learn more","premiumpress"); ?></a>

</div>

</div>

<?php
}
 
 

// CHECK FOR CUSTOM HEADER
$pageLinkingID = _ppt_pagelinking("header"); 
 

if(defined('NOHEADERFOOTER')){ 

		 
}elseif(_ppt(array('design','header_style')) == "elementor" && isset($_SESSION['design_preview']) && strlen($_SESSION['design_preview']) > 1){ // CHILD THEME PREVIEWS		
		 
	_ppt_template( 'header', 'elementor' ); 	
	
		
}elseif( substr($pageLinkingID ,0,9) == "elementor" ){ //&& get_post_meta(substr($pageLinkingID,10,100), "_wp_page_template", true) != "elementor_canvas" 
 
	echo do_shortcode( "[premiumpress_elementor_template id='".substr($pageLinkingID,10,100)."']");	 
	
	  
	
}elseif ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) {
		  
				
	$design = _ppt(array('design','header_style'));
	$slot1 = _ppt(array('design','slot1_style'));
	 		 
	if(strlen($design) > 1 ){	
	 
		if( isset($GLOBALS['flag-home']) && ( substr($slot1,0,6) == "intro_" || in_array($slot1,array("hero2","hero3","hero8","hero12","hero18","hero21","hero24","hero25","hero26")) ) ){
		// do nothing
		
		}else{
		$CORE->LAYOUT("load_single_block",$design);	
		}
	}
	  
} 

?>