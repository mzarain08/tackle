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

 
$settings = array(
"title" => __("Thank You Tracking Code","premiumpress"), 
"desc" => __("Here you can paste in any tracking code you want to use for the thank you page.","premiumpress"), 
"back" => "overview"
);

_ppt_template('framework/admin/_form-wrap-top' ); ?>

<div class="card card-admin">
  <div class="card-body">
    
	
    <textarea class="form-control"   name="adminArray[google_conversion]" style="height:200px !important;"><?php echo strip_tags(get_option('google_conversion')); ?></textarea>
    
    <p class="mt-3">Shortcodes: <strong>[orderid]</strong> = order ID <strong>[description]</strong> = description <strong>[total]</strong> = total</p>
    
    <div class="p-4 bg-light text-center mt-4">
      <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
    </div>
  </div>
</div>
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?>
