<?php
// CHECK THE PAGE IS NOT BEING LOADED DIRECTLY
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }


global $settings, $CORE; 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 $settings = array(
  
  "title" => __("Design Settings","premiumpress"), 
  "desc" =>  __("Customize your website design, manage page content, logo etc.","premiumpress"),
  
 // "sitemanager" => 1,
  
  
  "doclink" => "https://www.premiumpress.com/docs/customizing/",
  
  
  
  "video" => "",
  );
   _ppt_template('framework/admin/_form-wrap-top' ); 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
$preview = "https://premiummod.com/webshot/index.php?license=".get_option('ppt_license_key')."&web=".home_url()."&tk=".THEME_KEY."&email=".get_option('admin_email');
	
 
 
?>

<style>
#overview-box, #ideas-box, #pages-box, #menu-box, #header-box, #logo-box, #colors-box, #text-box, #footer-box  {
	display:none;
}
</style>




<div class="card">


<div class="col-12">

 

<div class="dropdown mb-4 mx-auto col-md-6 text-center">

<h4 class="text-center my-4"><?php echo __("Current Design","premiumpress"); ?></h4>

  <button class="btn btn-primary px-4 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   <?php echo __("Customize","premiumpress"); ?> 
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
  	
    
    
    
   
     <a class="dropdown-item" href="#top" onclick="jQuery('#logo-box').trigger('click');window.scrollTo({ top: 0, behavior: 'smooth' });"><?php echo __("Logo &amp; Fonts","premiumpress"); ?></a>
    
    <a class="dropdown-item" href="#top" onclick="jQuery('#colors-box').trigger('click');window.scrollTo({ top: 0, behavior: 'smooth' });"><?php echo __("Change Colors","premiumpress"); ?></a>
    
    <a class="dropdown-item" href="#top" onclick="jQuery('#header-box').trigger('click');window.scrollTo({ top: 0, behavior: 'smooth' });"><?php echo __("Header Design","premiumpress"); ?></a>
    
    <a class="dropdown-item" href="#top" onclick="jQuery('#footer-box').trigger('click');window.scrollTo({ top: 0, behavior: 'smooth' });"><?php echo __("Footer Design","premiumpress"); ?></a>
     
     <a class="dropdown-item" href="admin.php?page=ppt_editor"><?php echo __("Edit Pages","premiumpress"); ?></a>
    
    <a class="dropdown-item" href="#top" onclick="jQuery('#menu-tab').trigger('click');window.scrollTo({ top: 0, behavior: 'smooth' });"><?php echo __("Navigation","premiumpress"); ?></a>
     
    <a class="dropdown-item" href="#top" onclick="jQuery('#text-tab').trigger('click');window.scrollTo({ top: 0, behavior: 'smooth' });"><?php echo __("Edit Language","premiumpress"); ?></a>
    
   
    
  </div>
</div>



</div> 

<div class="col-12">

    <div class="d-flex  align-self-end"  style="height:300px; overflow:hidden;">
    
    <div class="position-relative mx-auto col-md-10 rounded-lg shadow" style="border:10px solid #ddd; border-bottom:0px;">
    
    <div class="bg-image" style="background-image:url('<?php echo $preview; ?>');"></div>
    </div>
    
    
    </div>
  

</div>
 
</div>

 


<div class="card p-3">

<a href="javascript:void(0);" class="_admin_iconbox icon-box" style="border-bottom:0px;" onclick="jQuery('#ideas-tab').trigger('click');window.scrollTo({ top: 0, behavior: 'smooth' });">
<i class="fal fa fa-desktop"></i><strong><?php echo __("Change Design","premiumpress"); ?></strong><p><?php echo __("Select a different design from our design library.","premiumpress"); ?></p></a>
 
</div> 
 
 
<div class="card p-3">

<div id="overviewlist"></div>   
 
</div>




<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?> 