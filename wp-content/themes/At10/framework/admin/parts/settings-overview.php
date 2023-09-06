<?php
// CHECK THE PAGE IS NOT BEING LOADED DIRECTLY
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }


global $settings, $CORE; 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 $settings = array(
  
  "title" => __("Settings","premiumpress"), 
  "desc" =>  __("Manage your website settings.","premiumpress"),
  
  "doclink" => "https://www.premiumpress.com/docs/admin/",
 
  "video" => "",
  );
   _ppt_template('framework/admin/_form-wrap-top' ); 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
?>

<style>
#overview-box, #pagelinks-box, #cleaning-box, #maps-box, #adsense-box, #analytics-box, #captcha-box, #taxonomies-box {
	display:none;
}
</style>


<div class="card p-3">

<a href="javascript:void(0);" class="_admin_iconbox icon-box"  onclick="jQuery('#pagelinks-tab').trigger('click');window.scrollTo({ top: 0, behavior: 'smooth' });">
<i class="fal fa-link"></i><strong><?php echo __("Page Links","premiumpress"); ?></strong>
<p><?php echo __("Page links tell the theme where to send users when they click on links and buttons.","premiumpress"); ?></p></a>


<a href="javascript:void(0);" class="_admin_iconbox icon-box"  style="border-bottom:0px;"   onclick="jQuery('#taxonomies-tab').trigger('click');window.scrollTo({ top: 0, behavior: 'smooth' });">
<i class="fal fa-filter"></i><strong><?php echo __("Taxonomies","premiumpress"); ?></strong>
<p><?php echo __("Here you can setup your own custom taxonomies.","premiumpress"); ?></p></a>

 
</div>
 
<div class="card p-3">

<div id="overviewlist"></div>   
 
</div>


<div class="card p-3">

 
<a href="javascript:void(0);" class="_admin_iconbox icon-box" onclick="jQuery('#maps-tab').trigger('click');window.scrollTo({ top: 0, behavior: 'smooth' });">
<i class="fal fa-map-marker"></i><strong><?php echo __("Google Maps","premiumpress"); ?></strong>
<p><?php echo __("Here are all the Google Map settings for your website.","premiumpress"); ?></p></a>
 

<a href="javascript:void(0);" class="_admin_iconbox icon-box"    onclick="jQuery('#adsense-tab').trigger('click');window.scrollTo({ top: 0, behavior: 'smooth' });">
<i class="fal fa-ad"></i><strong><?php echo __("Google Adsense","premiumpress"); ?></strong>
<p><?php echo __("Here are all the Google Adsense settings for your website.","premiumpress"); ?></p></a>


<a href="javascript:void(0);" class="_admin_iconbox icon-box"    onclick="jQuery('#analytics-tab').trigger('click');window.scrollTo({ top: 0, behavior: 'smooth' });">
<i class="fal fa-signal-alt"></i><strong><?php echo __("Google Analytics","premiumpress"); ?></strong>
<p><?php echo __("Here are all the Google Analytics settings for your website.","premiumpress"); ?></p></a>

 <a href="javascript:void(0);" class="_admin_iconbox icon-box"  style="border-bottom:0px;"  onclick="jQuery('#captcha-tab').trigger('click');window.scrollTo({ top: 0, behavior: 'smooth' });">
<i class="fal fa-project-diagram"></i><strong><?php echo __("Google Captcha V2","premiumpress"); ?></strong>
<p><?php echo __("This is to stop bots commenting. If turned OFF there will be no CAPTCHA security code.","premiumpress"); ?></p></a>

</div>

<div class="card p-3">

<a href="javascript:void(0);" class="_admin_iconbox icon-box" style="border-bottom:0px;"  onclick="jQuery('#cleaning-tab').trigger('click');window.scrollTo({ top: 0, behavior: 'smooth' });">
<i class="fal fa-key"></i><strong><?php echo __("License Key","premiumpress"); ?></strong>
<p><?php echo __("Here you can change your license key.","premiumpress"); ?></p></a>

 
</div>




<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?> 