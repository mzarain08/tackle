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
 
global $df, $settings, $CORE;

 
if(isset($df['section_overlay']) && $df['section_overlay'] != "none"){ 
	
	switch($df['section_overlay']){	 
	
		case "gradient": {
		
		echo "<div class='bg-overlay-gradient'></div>";
		} break;
		
		case "gradient-left": {
		
		echo "<div class='bg-overlay-gradient-left'></div>";
		} break;
		
		case "gradient-left-small": {
		
		echo "<div class='bg-overlay-gradient-left-small'></div>";
		} break;
		
		case "gradient-left-white": {
		
		echo "<div class='bg-overlay-gradient-left-white'></div>";
		} break;
		
		case "gradient-left-small-white": {
		
		echo "<div class='bg-overlay-gradient-left-small-white'></div>";
		} break;
		
		case "dark":
		case "black": {
		
		echo "<div class='bg-overlay-black'></div>";
		} break;
		
		case "grey": {
		
		echo "<div class='bg-overlay-grey'></div>";
		} break;
		
		case "white": {
		
		echo "<div class='bg-overlay-white'></div>";
		} break;

		case "green": {
		
		echo "<div class='bg-overlay-green'></div>";
		} break;
				
		case "primary": {
		
		echo "<div class='bg-overlay-primary bg-primary'></div>";
		} break;
		
		case "secondary": {
		
		echo "<div class='bg-overlay-secondary bg-secondary'></div>";
		} break;
		 
	
	}

} ?>