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

global $post, $CORE;

$list_top = ppt_theme_card_data_output($ShowdataKey = "list_top", array());
	
$list_bottom = ppt_theme_card_data_output($ShowdataKey = "list_bottom", array());

switch($post->thistheme){ 
		
		case "da":
		case "es": {
		$card_data = 'cards/themes/search_list_es';			
		} break;
			  
		case "cp": {
		$card_data = 'cards/themes/search_list_cp';			
		} break;
		
		default: {
		$card_data = 'cards/themes/search_list1';		
		} break;
}

_ppt_template( $card_data ); 

?>