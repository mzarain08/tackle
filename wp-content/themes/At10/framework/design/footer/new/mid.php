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

global $CORE, $userdata, $settings, $CORE_UI, $df, $footer;


$txtbg = "light";
if(strlen($df['footermid_txtbg']) > 0){
$txtbg = $df['footermid_txtbg'];
}
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if($df['footermid_show'] == "1"){

?>

<div class="footer-txt-<?php echo $txtbg; ?>" <?php if(isset($df['footermid_bg_color'])){ ?> style="background:<?php echo $df['footermid_bg_color']; ?>!important;"<?php } ?>>


<?php 

switch($df['footermid_fmid_style']){ 
 
case "5": {
 
?>

<div class="container pt-5 py-3">
    <div class="row">
    	<div class="col-md-6 logo-lg"> %logo% </div>
   	 	<div class="col-md-6 text-right"> %social_big% </div>
    </div>
</div>
<?php

} break;

case "4": {
 
?>

<div class="container py-5"> 

<div class="row text-center ">
      <div class="col-md-12 logo-lg">
       %logo% 
      </div>
      <div class="col-md-12 my-4">
        <nav ppt-nav class=" seperator d-flex d-flex justify-content-center"> %menu1% </nav>
      </div>
      <div class="col-md-12">
         %social_big%
      </div>
</div>

</div>

<?php

} break;

case "3": {
	
?>
<div class="container py-3 pt-4">
    <div class="row">
    
      <div class="col-md-4 text-center text-md-left logo-lg">
      
        <?php if($df['footermid_show_logo']){ ?><div class="mb-4"> %logo% </div><?php } ?> 
        
        <div class="lh-30 col-md-10 px-0 mobile-mb-2" data-ppt-footerdesc>%desc%</div>
      
      </div>
   
      <div class="col-6 col-md-3 col-xl-2 text-center text-md-left"> 
         
        <div class="fs-5 mb-2 text-600" data-ppt-footer-menutitle1>%menu1_title%</div> 
        <div class="lh-30">%menu1%</div>
        
      </div> 
      
      <div class="col-6 col-md-3 col-xl-2 text-center text-md-left">
        
        <div class="fs-5 mb-2 text-600" data-ppt-footer-menutitle2>%menu2_title%</div> 
        <div class="lh-30">%menu2%</div>
           
      </div> 
 
      <div class="col-6 col-md-3 col-xl-2 text-center text-md-left">
        
        <div class="fs-5 mb-2 text-600" data-ppt-footer-menutitle3>%menu3_title%</div> 
        <div class="lh-30">%menu3%</div>
           
      </div> 
      
	<div class="col-6 col-md-3 col-xl-2 text-center text-md-left">
        
        <div class="fs-5 mb-2 text-600" data-ppt-footer-menutitle4>%menu4_title%</div> 
        <div class="lh-30">%menu4%</div>
           
      </div>
      
</div>
</div>
<?php
	} break;

case "2": {
	
?>
<div class="container py-3 pt-4">
    <div class="row"> 
    
      <div class="col-md-6 text-center text-md-left logo-lg">
      
        <?php if($df['footermid_show_logo']){ ?><div class="mb-4"> %logo% </div><?php } ?> 
        
        <div class="lh-30 col-md-10 px-0 mobile-mb-2" data-ppt-footerdesc>%desc%</div>
      
      </div>
      
   
      <div class="col-6 col-md-3 col-xl-2 text-center text-md-left"> 
         
        <div class="fs-5 mb-2 text-600" data-ppt-footer-menutitle1>%menu1_title%</div> 
        <div class="lh-30">%menu1%</div>
        
      </div> 
      
      <div class="col-6 col-md-3 col-xl-2 text-center text-md-left">
        
        <div class="fs-5 mb-2 text-600" data-ppt-footer-menutitle2>%menu2_title%</div> 
        <div class="lh-30">%menu2%</div>
           
      </div> 
 
      <div class="col-6 col-md-3 col-xl-2 text-center text-md-left">
        
        <div class="fs-5 mb-2 text-600" data-ppt-footer-menutitle3>%menu3_title%</div> 
        <div class="lh-30">%menu3%</div>
           
      </div> 
      
</div>
</div>
<?php
	} break;

case "1": {
	
?>
<div class="container py-3 pt-4">
    <div class="row"> 
    
      <div class="col-md-6 text-center text-md-left logo-lg">
      
        <?php if($df['footermid_show_logo']){ ?><div class="mb-4"> %logo% </div><?php } ?> 
        
        <div class="lh-30 col-md-10 px-0 mobile-mb-2" data-ppt-footerdesc>%desc%</div>
      
      </div>
      
   
      <div class="col-6 col-md-3 col-xl-2 offset-xl-2 text-center text-md-left"> 
         
        <div class="fs-5 mb-2 text-600" data-ppt-footer-menutitle1>%menu1_title%</div> 
        <div class="lh-30">%menu1%</div>
        
      </div> 
      
      <div class="col-6 col-md-3 col-xl-2 text-center text-md-left">
        
        <div class="fs-5 mb-2 text-600" data-ppt-footer-menutitle2>%menu2_title%</div> 
        <div class="lh-30">%menu2%</div>
           
      </div> 
 

</div>
</div>
<?php
	} break;
	default: {
?>

<div class="container py-4 pt-5">
    <div class="row"> 
    
      <div class="col-md-4 text-center text-md-left logo-lg">
      
        <?php if($df['footermid_show_logo']){ ?><div class="mb-4"> %logo% </div><?php } ?> 
        
        <div class="lh-30 mobile-mb-2" data-ppt-footerdesc>%desc%</div>
      
      </div>
      
      <div class="col-6 col-md-3 col-xl-2 text-center text-md-left mobile-mb-2"> 
         
        <div class="fs-5 mb-2 text-600" data-ppt-footer-menutitle1>%menu1_title%</div> 
        <div class="lh-30">%menu1%</div>
        
      </div> 
      
      <div class="col-6 col-md-3 col-xl-2 text-center text-md-left mobile-mb-2">
        
        <div class="fs-5 mb-2 text-600" data-ppt-footer-menutitle2>%menu2_title%</div> 
        <div class="lh-30">%menu2%</div>
           
      </div> 
   
    
      <div class="col-md-4"> 
      
        <div class="fs-5 mb-2 text-600"><?php echo __("Join our newsletter","premiumpress"); ?></div>
        <p class="opacity-8 mb-3"><?php echo __("We write rarely, but only the best content.","premiumpress"); ?></p>
        %newsbox%
        <div class="small opacity-8 mt-4">
          <?php echo __("We'll never share your details. See our","premiumpress"); ?> <a class="opacity-8" href="<?php echo _ppt(array('links','privacy')); ?>"><?php echo __("Privacy Policy","premiumpress"); ?></a>
        </div>
    
      </div>

</div>
</div>
<?php
	} break;


} ?>

</div>
<?php } ?>