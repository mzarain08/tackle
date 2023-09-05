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

global $CORE, $post, $userdata, $CORE_UI; 


$default = _ppt(array('design', 'default_gallery'));

if(isset($_GET['style'])){
$default = $_GET['style'];
}
 
if($default != ""){

		switch($default){
		
		case "tall": {
			_ppt_template( 'single/single-gallery-tall' );
		} break;
		
		case "grid": {
			_ppt_template( 'single/single-gallery-grid' );	
		} break;
		
		case "gallery":
		case "row": {
			_ppt_template( 'single/single-gallery-row' );	
		} break;
		
		case "carousel": {
			_ppt_template( 'single/single-gallery-carousel' );	
		} break;
		
		default: {			
				
		} break;	
	}


}else{
 

	switch(THEME_KEY){
		case "es": {
			_ppt_template( 'single/single-gallery-tall' );
		} break;
		default: {			
			_ppt_template( 'single/single-gallery-grid' );		
		} break;	
	}

}


?>