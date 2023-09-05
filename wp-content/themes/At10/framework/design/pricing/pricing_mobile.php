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

global $CORE, $settings;

if(isset($settings['pricing_data'])){


 
$pricing_data = $settings['pricing_data'];
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
if(!empty($pricing_data)){
?>
<div class="<?php if(!isset($GLOBALS['flag-upgrade-memberships'])){ ?>show-mobile<?php } ?>">
<div>
<hr />
<?php 
 $i=1; foreach($pricing_data as $pak){ ?>
<div class="row">
 <div class="col-8">
 
 <p><strong><?php echo $pak['title']; ?></strong></p>
 
 <?php if(isset($pak['desc'])){ ?>
 <p class="mb-0"><?php echo $pak['desc']; ?></p>
 <?php } ?>
 
 </div>
 <div class="col-4 pt-2">
  <?php if($pak['button'] == "existing"){ ?>
  <a data-ppt-btn class=" btn-outline-primary btn-block" href="#"><?php echo __("Current Plan","premiumpress"); ?></a>
  <?php }else{ ?>
  <a data-ppt-btn class=" btn-primary btn-block" <?php echo $pak['button']; ?>><?php echo __("Select","premiumpress"); ?></a>
  <?php } ?>
  
  <?php /*
  <div class="small text-center mt-2">
  <span class="<?php if(is_numeric($pak['price']) && $pak['price'] != "0"){ echo $CORE->GEO("price_formatting",array()); } ?>"><?php if($pak['price'] == 0){ echo $pak['price_text']; }else{  echo $pak['price']; } ?></span>
  </div>
  */ ?>
  
 </div>
<div class="col-12"><hr /></div> 
</div>
 <?php } ?> 
 </div> 
</div>
<?php
}

}
?>