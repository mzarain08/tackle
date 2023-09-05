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

global $post;

switch($post->thistheme){ 
	 
		case "cp": {
		$grid_bottom = ppt_theme_card_data_output($ShowdataKey = "grid_bottom", array());		
		$card_data = 'cards/themes/search_cp'; 		
		} break; 		
		case "pj": {		
		$card_data = 'cards/themes/search_pj'; 		
		} break; 
		case "da":	
		case "es": {		
		$card_data = 'cards/themes/search_es'; 		
		} break; 		
		case "dt": {		
		$card_data = 'cards/themes/search_dt'; 
		} break; 
		case "jb": {		
		$card_data = 'cards/themes/search_jb'; 
		} break; 
		case "at": {		
		$card_data = 'cards/themes/search_at'; 		
		} break;
		case "dl": {		
		$card_data = 'cards/themes/search_dl'; 		
		} break;
		case "ct": {		
		$card_data = 'cards/themes/search_ct'; 		
		} break;
		case "rt": {		
		$card_data = 'cards/themes/search_rt'; 		
		} break;
		case "vt": {		
		$card_data = 'cards/themes/search_vt'; 		
		} break;
		case "mj": {		
		$card_data = 'cards/themes/search_mj'; 		
		} break;
		case "ll": {		
		$card_data = 'cards/themes/search_ll'; 		
		} break;
		case "so": {		
		$card_data = 'cards/themes/search_so'; 		
		} break;
		case "sp": {		
		$card_data = 'cards/themes/search_sp'; 		
		} break;
		case "cb": {		
		$card_data = 'cards/themes/search_cb'; 		
		} break;
		case "cm": {		
		$card_data = 'cards/themes/search_cm'; 		
		} break;
		default: {			
		$card_data = 'cards/themes/search2'; 		
		} break;	
	} 
	
_ppt_template( $card_data ); 
?>