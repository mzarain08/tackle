<?php
   /*
   Template Name: [SHOP - CART]
   */
 
   if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
 
   global  $userdata, $CORE, $CORE_CART; wp_get_current_user();        
   

_ppt_template('forms/checkout' ); 

?>