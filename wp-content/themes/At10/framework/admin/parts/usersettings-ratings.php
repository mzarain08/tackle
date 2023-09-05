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
  
  "title" => __("User Ratings","premiumpress"), 
  
  "desc" => __("Here you can modify the user rating system.","premiumpress"),  
   
  "back" => "overview",

  
  );    
  
  _ppt_template('framework/admin/_form-wrap-top' ); 
  
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
  
 $g = array(


		 "ratings" => array(
		 
			 "name" => __("Rating System","premiumpress"), 
			 "desc" => __("The user rating is based on feedback left by other users. Turn off to disable the display of user ratings.","premiumpress"), 
			 "type" => "yesno", 
			 "d" => 1,
			  "col8" => true 
		 ),	
		 
		 
	 "ratings_breakdown" => array(
		 
			 "name" => __("Show Rating Chart","premiumpress"), 
			 "desc" => __("This is rating breakdown displayed above the user comments.","premiumpress"), 
			 "type" => "yesno", 
			 "d" => 1 ,
			 "col8" => true 
		 ),	
		 
		 	 
		 "comments" => array(
		 
			 "name" => __("User Comment","premiumpress"), 
			 "desc" => __("Here you can turn on/off user comments within the account page.","premiumpress"), 
			 "type" => "yesno", 
			 "d" => 1,
			  "col8" => true 
		 ),	 
		 
		 
  
);
  
  
if(!in_array(THEME_KEY, array("da","vt")) ){

unset($g['likes']);

}  
  
  
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