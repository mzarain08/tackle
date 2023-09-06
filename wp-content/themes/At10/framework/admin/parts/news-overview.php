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

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 $settings = array(
  
  "title" => __("Live Ads","premiumpress"), 
  "desc" => __("Live ads are custom pop-ups and messages displayed on your website.","premiumpress"),
  
  "doclink" => "https://www.premiumpress.com/docs/advertising/",
  
  "video" => "",
  );
   _ppt_template('framework/admin/_form-wrap-top' ); 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
?>

<style>
#overview-box, #s-box, #add-box, #m-box {
	display:none;
}
</style>

 



<div class="card p-3">
 
<a href="javascript:void(0);" class="_admin_iconbox icon-box" onclick="jQuery('#m-tab').trigger('click');window.scrollTo({ top: 0, behavior: 'smooth' });" style="border-bottom:0px;">
<i class="fal fa-ad"></i><strong><?php echo __("Manage","premiumpress"); ?></strong>
<p><?php echo __("Here you can manage existing live ads.","premiumpress"); ?></p></a>

</div>
 

<div class="card p-3">
 
<a href="admin.php?page=news&eid=0" class="_admin_iconbox icon-box" style="border-bottom:0px;">
<i class="fal fa-plus"></i><strong><?php echo __("Add New","premiumpress"); ?></strong>
<p><?php echo __("Here you can create a new live ad.","premiumpress"); ?></p></a>

</div>

<div class="card p-3">

<a href="javascript:void(0);" class="_admin_iconbox icon-box" onclick="jQuery('#s-tab').trigger('click');window.scrollTo({ top: 0, behavior: 'smooth' });" style="border-bottom:0px;">
<i class="fal fa-cog"></i><strong><?php echo __("Settings","premiumpress"); ?></strong>
<p><?php echo __("Here you can update your live ad settings.","premiumpress"); ?></p></a>
 
</div>
 
 
<div id="overviewlist"  style="display:none;"></div>   
 
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?>