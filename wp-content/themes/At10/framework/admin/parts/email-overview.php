<?php
// CHECK THE PAGE IS NOT BEING LOADED DIRECTLY
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }


global $settings, $CORE; 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 $settings = array(
  
  "title" => __("Email Settings","premiumpress"), 
  "desc" =>  __("Customize your website emails, manage mailing lists etc.","premiumpress"),
  
  "doclink" => "https://www.premiumpress.com/docs/email/",
  
  
  
  "video" => "",
  );
   _ppt_template('framework/admin/_form-wrap-top' ); 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
?>

<style>
#overview-box, #sendemail-box, #ns-box, #sn-box, #subscribers-box, #add-box, #newsimport-box {
	display:none;
}
</style>
 
 
<div class="card p-3">

<a href="javascript:void(0);" class="_admin_iconbox icon-box" style="border-bottom:0px;"  onclick="jQuery('#sendemail-tab').trigger('click');window.scrollTo({ top: 0, behavior: 'smooth' });">
<i class="fal fa-envelope"></i><strong><?php echo __("Send Email","premiumpress"); ?></strong>
<p><?php echo __("Send an email to a single user or your entire community.","premiumpress"); ?></p></a>

 
</div>
 
 
<div class="card p-3">

<div id="overviewlist"></div>   
 
</div>
 

 
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?> 


