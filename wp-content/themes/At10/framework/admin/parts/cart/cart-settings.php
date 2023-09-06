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

global $settings;
 

// COUNTRY LIST
$country_string1 = "";
foreach($GLOBALS['core_country_list'] as $key=>$value){
	$country_string1 .= "<option value='".$key."'>".$value."</option>";
} // end if 
  
 


$settings = array(
"title" => __("Regions","premiumpress"), 
"desc" => __("Regions let you setup country/state combinations which can be used for custom tax and shipping prices. <br><br>Note: If you are applying the same tax/ship price for the entire country, you do not need to add all of the states/provinces as well.","premiumpress"), 
"back" => "overview");

_ppt_template('framework/admin/_form-wrap-top' ); ?>  <div class="card card-admin"><div class="card-body">
 
  

 <?php _ppt_template('framework/admin/parts/cart/shipping-regions' ); ?>
 
 
<div class="p-4 bg-light text-center mt-4">
         <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
    </div>
    
    
    
    
    


</div></div><?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?>

