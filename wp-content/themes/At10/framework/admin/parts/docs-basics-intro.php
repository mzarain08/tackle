<?php
// CHECK THE PAGE IS NOT BEING LOADED DIRECTLY
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }


global $settings, $CORE; 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 $settings = array(
  
  "title" => __("Docs","premiumpress"), 
  "desc" =>  __("Here are additional resources and functions built into the theme.","premiumpress"),
  
  "doclink" => "https://www.premiumpress.com/contact/",
  
  
  
  "video" => "",
  );
   _ppt_template('framework/admin/_form-wrap-top' ); 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
?>

<style>
#overview-box {
	display:none;
}
</style>
 
<div class="card p-3">

<div id="overviewlist"></div>   
 
</div>
<!-- end admin card -->
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?> 