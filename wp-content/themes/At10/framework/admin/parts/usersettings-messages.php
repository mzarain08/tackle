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
  
  "title" => __("Message System","premiumpress"), 
  "desc" => __("Here you can change options for the built-in message system.","premiumpress"),
  
  "back" => "overview"
  
  );  _ppt_template('framework/admin/_form-wrap-top' ); ?>
   
<div class="card card-admin">
  <div class="card-body">


<?php

$g = array(


		 "account_messages" => array(
		 
			 "name" => __("Message System","premiumpress"), 
			 "desc" => __("Here you can turn on/off the private message system within user account.","premiumpress"), 
			 "type" => "yesno", 
			 "d" => "1" ,
			  "col8" => true 
		 ),	
		 
		 "account_messages_attachments" => array(
		 
			 "name" => __("Message Attachments","premiumpress"), 
			 "desc" => __("Here you can turn on/off the file attachment feature for the message system.","premiumpress"), 
			 "type" => "yesno", 
			 "d" => "1" ,
			  "col8" => true 
		 ),	
		 
		"messages_login_required" => array(
		 
			 "name" => __("Require Login?","premiumpress"), 
			 "desc" => __("Turn on to stop showing the contact form to non-logged in members.","premiumpress"), 
			 "type" => "yesno", 
			 "d" => "0" ,
			  "col8" => true 
		 ),	
		 
		 /*
		  "messages_limit" => array(
		 
			 "name" => __("Dashboard Display Limit","premiumpress"), 
			 "desc" => __("Set how many messages to display within the chat history window on the dashboard page.","premiumpress"), 
			 "type" => "input", 
			 "d" => "10" ,
			  "col8" => true 
		 ),	*/

); 

if(!in_array(THEME_KEY,array("dt","rt"))){
unset($g["messages_login_required"]);
}

if(in_array(THEME_KEY,array("cb","cp"))){
$g["account_messages"]['d'] = 0;
}

foreach ($g as $fieldkey => $fielddata){ echo $CORE_ADMIN->LoadCongifField($fielddata, $fieldkey, "user"); }
?>


      <div class="p-4 bg-light text-center mt-4">
      <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
    </div>
    
  </div>
</div>
<!-- end admin card -->
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?>