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
 
 
global $settings, $CORE_ADMIN, $CORE;


  $settings = array(
  
  "title" => __("Comment Settings","premiumpress"), 
  
  "desc" => __("Here are your website comment settings.","premiumpress"),  
   
  "back" => "overview",

  
  );    
  
  _ppt_template('framework/admin/_form-wrap-top' ); 
  
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
  
 $g = array(
 
		 "comments" => array(
		 
			 "name" => __("User Comments","premiumpress"), 
			 "desc" => __("Here you can turn on/off user comments and reviews.","premiumpress"), 
			 "type" => "yesno", 
			 "d" => 1,
			  "col8" => true 
		 ),	 
		 
  
);
  
 
  
  
  ?>
   
<div class="card card-admin">
  <div class="card-body">
  
  
  <?php foreach ($g as $fieldkey => $fielddata){ echo str_replace("border-bottom","",$CORE_ADMIN->LoadCongifField($fielddata, $fieldkey, "user")); }; ?>

  
      <div class="p-4 bg-light text-center mt-4">
      <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
    </div>
    
  </div>
</div>
<!-- end admin card --> 

 
  <?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?>