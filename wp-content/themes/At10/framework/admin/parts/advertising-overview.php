<?php
// CHECK THE PAGE IS NOT BEING LOADED DIRECTLY
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }


global $settings, $CORE; 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 $settings = array(
  
  "title" => __("Advertising","premiumpress"), 
  "desc" =>  __("Manage advertising space for your website.","premiumpress"),
  
  "doclink" => "https://www.premiumpress.com/docs/advertising/",
 
  "video" => "",
  );
   _ppt_template('framework/admin/_form-wrap-top' ); 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
?>

<style>
#overview-box, #add-box, #s-box, #q-box  {
	display:none;
}
</style>



<div class="card p-3">

<a href="javascript:void(0);" class="_admin_iconbox icon-box"  onclick="jQuery('#s-tab').trigger('click');">
<i class="fal fa fa-ad"></i><strong><?php echo __("Advertising Slots","premiumpress"); ?></strong><p><?php echo __("Manage default banner spaces on your website.","premiumpress"); ?></p></a>


<a href="admin.php?page=news" class="_admin_iconbox icon-box" style="border-bottom:0px;">
<i class="fal fa fa-comment-alt-lines"></i><strong><?php echo __("Popup Ads","premiumpress"); ?></strong><p><?php echo __("Manage default banner spaces on your website.","premiumpress"); ?></p></a>


</div>
 
<div class="card p-3">

<a href="javascript:void(0);" class="_admin_iconbox icon-box" style="border-bottom:0px;" onclick="jQuery('#q-tab').trigger('click');">
<i class="fal fa fa-copy"></i><strong><?php echo __("Quick Setup","premiumpress"); ?></strong><p><?php echo __("Here you can quickly copy/paste in existing banner code.","premiumpress"); ?></p></a>

</div>
 
<div class="card p-3">

<div id="overviewlist"></div>   
 
</div>
<!-- end admin card -->
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?> 