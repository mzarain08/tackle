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
  
  "title" => __("User Verification","premiumpress"), 
  
  "desc" => __("Manage user verification options.","premiumpress"),  
   
  "back" => "overview",

  
  );    
  
  _ppt_template('framework/admin/_form-wrap-top' ); 
  
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
  
 $g = array(



 "forcemailverify" => array(
		 
			 "name" => __("Email Verification","premiumpress"), 
			 "desc" => __("Turn on if you want to stop users accessing account features until they have verified their email address. You must setup the verification email under the email options for email verification to work.","premiumpress"),
			 "type" => "yesno", 
			 "d" => "0" ,
			 "col8" => true 
		 ),	
		 
		 
		 
 "photoverify" => array(
		 
			 "name" => __("Photo Verification (Manual Process)","premiumpress"), 
			 "desc" => __("Users must upload a document to verify their identity before they can access account features. Requires admin approval before they can continue.","premiumpress"),
			 "type" => "yesno", 
			 "d" => "0" ,
			 "col8" => true 
		 ),	
		 
 "photoverify_type" => array( 
				 "name" => "", 
				 "desc" => "",
				 "type" => "custom", 
				 "path" => "photoverify",
				 "col12" => true 
			),	
		 
  
);
  
  
  
  
  
  ?>
   
<div class="card card-admin">
  <div class="card-body">
  
  
  <?php foreach ($g as $fieldkey => $fielddata){ echo str_replace("border-bottom","",$CORE_ADMIN->LoadCongifField($fielddata, $fieldkey, "register")); }; ?>





<a href="admin.php?page=settings&lefttab=sms" class="_admin_iconbox icon-box" style="border-bottom:0px;">
<i class="fal fa-mobile"></i><strong><?php echo __("SMS Verification","premiumpress"); ?></strong>
<p><?php echo __("Here you can turn on SMS verification.","premiumpress"); ?></p></a>



  
      <div class="p-4 bg-light text-center mt-4">
      <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
    </div>
    
  </div>
</div>
<!-- end admin card --> 

 
  <?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?>