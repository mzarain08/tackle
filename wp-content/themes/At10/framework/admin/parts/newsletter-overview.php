<?php
// CHECK THE PAGE IS NOT BEING LOADED DIRECTLY
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }


global $settings, $CORE; 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 $settings = array(
  
  "title" => __("Newsletter Settings","premiumpress"), 
  "desc" =>  __("Create and send newsletters, manage mailing lists etc.","premiumpress"),
  
  "doclink" => "https://www.premiumpress.com/docs/email/",
  
  
  
  "video" => "",
  );
   _ppt_template('framework/admin/_form-wrap-top' ); 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
?>

<style>
#overview-box, #sn-box {
	display:none;
}
</style>
 
<?php if( _ppt(array('newsletter','newsdefault')) != "0" ){  ?>
<div class="card p-3">



<a href="javascript:void(0);" class="_admin_iconbox icon-box" style="border-bottom:0px;" onclick="jQuery('#sn-tab').trigger('click');window.scrollTo({ top: 0, behavior: 'smooth' });">
<i class="fal fa-envelope-open"></i><strong><?php echo __("Send Newsletter","premiumpress"); ?></strong>
<p><?php echo __("Here you can send a newsletter to your subscribers.","premiumpress"); ?></p></a>
 
 
</div>
<?php } ?> 



<div class="card p-3">

 <div id="overviewlist"></div>   
</div>


 
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?> 