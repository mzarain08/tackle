<?php
// CHECK THE PAGE IS NOT BEING LOADED DIRECTLY
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }


global $settings, $CORE; 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 $settings = array(
  
  "title" => str_replace("%s", $CORE->LAYOUT("captions","1"), __("%s Settings","premiumpress")), 
  "desc" => str_replace("%s", strtolower($CORE->LAYOUT("captions","1")), __("Set default %s settings, custom fields, add-ons and more.","premiumpress")),
  
  "doclink" => "https://www.premiumpress.com/docs/listing-setup/",
  
  "video" => "",
  );
   _ppt_template('framework/admin/_form-wrap-top' ); 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
?>

<style>
#overview-box, #single-box, #s-box, #m-box, #gallery-box {
	display:none;
}
</style>


<div class="card p-3">

<a href="javascript:void(0);" class="_admin_iconbox icon-box" style="border-bottom:0px;" onclick="jQuery('#single-tab').trigger('click');window.scrollTo({ top: 0, behavior: 'smooth' });">
<i class="fal <?php echo $CORE->LAYOUT("captions","icon"); ?>"></i><strong><?php echo str_replace("%s", $CORE->LAYOUT("captions","1"), __("%s Page Design","premiumpress") ); ?></strong>
<p><?php echo str_replace("%s", strtolower($CORE->LAYOUT("captions","1")), __("Choose what's displayed on the %s page.","premiumpress")); ?></p></a>

</div>



<div class="card p-3">

<a href="javascript:void(0);" class="_admin_iconbox icon-box" style="border-bottom:0px;" onclick="jQuery('#gallery-tab').trigger('click');window.scrollTo({ top: 0, behavior: 'smooth' });">
<i class="fal fa-image"></i><strong><?php echo __("Image Gallery","premiumpress"); ?></strong>
<p><?php echo  __("Here are additional settings for the image gallery display","premiumpress"); ?></p></a>

</div>

 
<div class="card p-3">

<div id="overviewlist"></div>   
 
</div>

<?php  if( $CORE->LAYOUT("captions","listings") ){ ?>  
<div class="card p-3">

<a href="javascript:void(0);" class="_admin_iconbox icon-box" onclick="jQuery('#s-tab').trigger('click');window.scrollTo({ top: 0, behavior: 'smooth' });">
<i class="fal fa-cog"></i><strong><?php echo __("Settings","premiumpress"); ?></strong>
<p><?php echo str_replace("%s", strtolower($CORE->LAYOUT("captions","2")), __("Manage system settings related to your website %s.","premiumpress")); ?></p></a>


<a href="javascript:void(0);" class="_admin_iconbox icon-box" style="border-bottom:0px;" onclick="jQuery('#m-tab').trigger('click');window.scrollTo({ top: 0, behavior: 'smooth' });">
<i class="fal fa-images"></i><strong><?php echo __("Media Settings","premiumpress"); ?></strong>
<p><?php echo str_replace("%s", strtolower($CORE->LAYOUT("captions","2")), __("Manage image, video and audio settings for your %s.","premiumpress")); ?></p></a>


</div>
<?php } ?>

<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?>