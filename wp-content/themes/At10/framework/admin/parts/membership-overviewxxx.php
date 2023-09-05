<?php
// CHECK THE PAGE IS NOT BEING LOADED DIRECTLY
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }


global $settings, $CORE; 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 $settings = array(
  
  "title" => __("Membership Settings","premiumpress"), 
  "desc" =>  __("Set default membership and pricing plans for your website.","premiumpress"),
  
  "doclink" => "https://www.premiumpress.com/doc/memberships/",
  
  
  
  "video" => "",
  );
   _ppt_template('framework/admin/_form-wrap-top' ); 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
?>

<style>
#overview-box, #p-box {
	display:none;
}
</style>

<div class="card p-3">

<a href="javascript:void(0);" class="_admin_iconbox icon-box" style="border-bottom:0px;" onclick="jQuery('#p-tab').trigger('click');window.scrollTo({ top: 0, behavior: 'smooth' });">
<i class="fal <?php echo $CORE->LAYOUT("captions","icon"); ?>"></i><strong><?php echo __("Membership Pricing Plans","premiumpress"); ?></strong>
<p><?php echo __("Manage your user memberships here.","premiumpress"); ?></p></a>

</div>

 
<div class="card p-3">

<div id="overviewlist"></div>   
 
</div>
 
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?> 