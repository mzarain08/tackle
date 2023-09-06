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

global $settings, $CORE;
 
 $memnames = array( __("No Membership","premiumpress"), 'Bronze','Silver','Gold','','','','','','','' );

 
  $settings = array(
  
   "title" => __("Memberships Features","premiumpress"),
  
   "desc" => __("Use this page as a reference to check for any issues with your membership packages.","premiumpress"),
   
   "back" => "overview",
   
    );
   
   _ppt_template('framework/admin/_form-wrap-top' ); ?>
 
 

 
      <div class="card card-admin">
        <div class="card-body">
        
        
        <?php echo $CORE->USER("membership_features_list_full", array() ); ?> 
    
  </div>
</div>

  
<!-- end admin card -->
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?>