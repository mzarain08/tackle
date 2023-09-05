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
  
  $settings = array(
  
  "title" => __("Gift Images","premiumpress"), 
  "desc" => __("Here you can change the gift icons and set custom prices for each gift.","premiumpress"), 
  "back" => "overview"
  
  );
  
   _ppt_template('framework/admin/_form-wrap-top' );
   
    ?>
<div class="card card-admin">
  <div class="card-body">
   
    <div class="container px-0 border-bottom mb-3">
      <div class="row py-2">
        <div class="col-md-7">
          <label><?php echo __("Send Gifts","premiumpress"); ?></label>
          <p class="text-muted"><?php echo __("Turn on/off the option for users to send gifts.","premiumpress"); ?></p>
        </div>
        <div class="col-md-5">
          <div class="mt-3">
            <label class="radio off">
            <input type="radio" name="toggle" 
               value="off" onchange="document.getElementById('display_gifts').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
               value="on" onchange="document.getElementById('display_gifts').value='1'">
            </label>
            <div class="toggle <?php if( in_array(_ppt(array('gifts', 'enable')), array("", "1")) ){  ?>on<?php } ?>">
              <div class="yes">ON</div>
              <div class="switch"></div>
              <div class="no">OFF</div>
            </div>
          </div>
          <input type="hidden" id="display_gifts" name="admin_values[gifts][enable]" value="<?php if(_ppt(array('gifts', 'enable')) == ""){ echo 1; }else{ echo _ppt(array('gifts', 'enable')); } ?>">
        </div>
      </div>
    </div>
    <!-- ------------------------- -->
    <div class="container px-0 border-bottom mb-3">
 
        <div class="container">
          <div class="row">
<?php

$lst_backgrounds = array(1,2,3,4,5,6,7,8,9); 

foreach($lst_backgrounds as $k ){

if(defined('THEME_KEY') && in_array(THEME_KEY, array("es")) ){
$defaultimg = get_template_directory_uri()."/_escort/icons/".$k.".png";

}else{
$defaultimg = get_template_directory_uri()."/_dating/icons/".$k.".png";

}
 
?>

<div class="col-md-4">

<div class="card p-3 mb-4">
<figure>
<div class="position-relative"> <img data-src="<?php if(_ppt(array('giftimg', $k)) == ""){ echo $defaultimg; }else{ echo _ppt(array('giftimg', $k )); } ?>" alt="img" class="img-fluid lazy"> </div>
</figure>
              

<div class="input-group position-relative">

<button type="button"  id="path<?php echo $k; ?>9" class="position-absolute download_path_select" style="right:10px; top:10px; z-index: 12; background:#fff; font-size: 11px;"><?php echo __("Image","premiumpress"); ?></button>

 <input class="form-control" id="download_path<?php echo $k; ?>9" name="admin_values[giftimg][<?php echo $k; ?>]" value="<?php if(_ppt(array('giftimg', $k)) == ""){ }else{ echo _ppt(array('giftimg', $k )); } ?>" />

</div>

 

<div class="form-group mt-4">
	<label><?php echo __("Gift Price","premiumpress"); ?></label>
    <div class="input-group">   
	<input class="form-control numericonly" placeholder="0" name="admin_values[giftprice][<?php echo $k; ?>]" value="<?php echo _ppt(array('giftprice', $k)); ?>" style="padding-left:30px !important;"/>
    
    <div class="position-absolute" style="bottom: 8px;    left: 10px; z-index:100;"><?php if(strpos( _ppt(array('currency','symbol')), "fa") === false){ echo hook_currency_symbol('');  }else{ echo '<i class="'._ppt(array('currency','symbol')).'"></i>'; } ?></div>
    
   
    </div>
</div>

 
</div>

</div>      
            
            <?php } ?>
          </div>
        </div>
  </div>
    
    <div class="p-4 bg-light text-center mt-4">
      <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
    </div>
    
  </div>
</div>
 
 
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?>