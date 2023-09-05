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
   

	"title" => __("Social Login","premiumpress"), 
		
	"desc" => __("Allow users to login using their social media account such as Twitter, Facebook, Google etc.","premiumpress"),	
  
	"back" => "overview",
   
  );

 
   _ppt_template('framework/admin/_form-wrap-top' );
   
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

   
   
    ?>
   
   <div class="card card-admin">
  <div class="card-body">
   <?php 
   
   
$g = array(	 
		 
		 
		 	 "sociallogin" => array(
		 
			 "name" => __("Enable Social Login","premiumpress"), 
			 "desc" => __("Turn on to enable this feature.","premiumpress"),
			 "type" => "yesno", 
			 "d" => "0" ,
			"col8" => true 
		 ),			 
		 
		 
		 "socialoptions" => array( 
			 "name" => "", 
			 "desc" => "",
			 "type" => "custom", 
			 "path" => "socialogin",
			 "col12" => true 
		 ),		
			
 
);


if(in_array(THEME_KEY, array("da","ex")) ){

}else{
unset($g['da_seeking']);
unset($g['da_reggender']);
 
}

 
 
 foreach ($g as $fieldkey => $fielddata){ echo $CORE_ADMIN->LoadCongifField($fielddata, $fieldkey, "register"); }
?>


      <div class="p-4 bg-light text-center mt-4">
      <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
    </div>
    
  </div>
</div>
<!-- end admin card --> 

 
  <?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?>