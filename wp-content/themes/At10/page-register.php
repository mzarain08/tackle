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

	$GLOBALS['flag-register'] = 1;	
	if( get_option('users_can_register') != '1'){ 	
	die(__("We are not accepting new user registrations at this time.","premiumpress"));	
	}
	 

   // FORMS
   _ppt_template( 'page', 'forms' ); 

?>