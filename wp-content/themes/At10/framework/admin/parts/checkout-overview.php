<?php
// CHECK THE PAGE IS NOT BEING LOADED DIRECTLY
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }


global $settings, $CORE; 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 $settings = array(
  
  "title" => __("Payment &amp; Checkout","premiumpress"), 
  "desc" =>  __("Manage payment gateways, tax, shipping, coupons etc","premiumpress"),
  
  "doclink" => "https://www.premiumpress.com/docs/checkout/",
 
  "video" => "",
  );
   _ppt_template('framework/admin/_form-wrap-top' ); 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
?>

<style>
#gateways-box, #invoice-box, #overview-box {
	display:none;
}
</style>
 
 
<div class="card p-3">

<a href="javascript:void(0);" class="_admin_iconbox icon-box" style="border-bottom:0px;" onclick="jQuery('#gateways-tab').trigger('click');window.scrollTo({ top: 0, behavior: 'smooth' });">
<i class="fal fa-credit-card"></i><strong><?php echo __("Payment Gateways","premiumpress"); ?></strong><p><?php echo __("Here you can setup and configure payment gateways for your website.","premiumpress"); ?></p></a>
 
</div> 
 
 
 
 
<div class="card p-3">

<div id="overviewlist"></div>   
 
</div>



 
<div class="card p-3">

<a href="admin.php?page=settings&lefttab=company" class="_admin_iconbox icon-box" style="border-bottom:0px;">
<i class="fal fa-file"></i><strong><?php echo __("Invoice Address","premiumpress"); ?></strong><p><?php echo __("Here you can modify your company details &amp; invoice address.","premiumpress"); ?></p></a>
 
</div> 

<!-- end admin card -->
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?> 