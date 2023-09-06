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

global $CORE; 
 
 
if(isset($_GET['price1']) && is_numeric($_GET['price1'])){ $price1 = esc_attr($_GET['price1']); }else{ $price1 = ""; }		
if(isset($_GET['price2']) && is_numeric($_GET['price2']) && $_GET['price2'] > 0){ $price2 = esc_attr($_GET['price2']); }else{  
	$price2 = ""; 
} 

// FIND THE MAX PRICE OF ITEMS IN OUR DATABASE
 
if(THEME_KEY == "at"){
$SQL = "SELECT meta_value FROM ".$wpdb->prefix."postmeta WHERE meta_key = 'price_current' AND meta_value != '' ORDER BY meta_value DESC LIMIT 1"; 
}else{
$SQL = "SELECT meta_value FROM ".$wpdb->prefix."postmeta WHERE meta_key = 'price' AND meta_value != '' ORDER BY meta_value DESC LIMIT 1"; 
}
$result = $wpdb->get_results($SQL);
if(empty($result)){
	$max_price = "10000";
}else{
	$max_price = preg_replace("/[^0-9.]/", "", $result[0]->meta_value);
}
 


if(THEME_KEY == "pj"){ 

$title1 = __("Min. Budget","premiumpress"); 
$title2 = __("Max. Budget","premiumpress");
}else{ 
$title1 = __("Min. Price","premiumpress"); 
$title2 = __("Max. Price","premiumpress");
}
 
?>
<div class="container  <?php if(!is_admin() && isset($_POST['action'])){ ?>pb-3<?php }else{ ?>px-0<?php } ?>">
<div class="row">
  <div class="col-md-6 mb-3 mb-sm-0">
    <label class="text-600">
   <?php echo $title1;  ?>
    </label>
    <div class="position-relative">
      <input type="text" placeholder="<?php echo __("Any","premiumpress"); ?>" name="price1" autocomplete="off" <?php if(!$CORE->isMobileDevice()){ ?>onchange="_filter_update()" <?php } ?> class="form-control customfilter val-numeric" data-formatted-text="<?php echo $title1; ?>" data-type="text" data-key="price1" id="filter_price_value_1" value="<?php echo $price1; ?>">
      <span class="position-absolute iconbit" style="top: 10px;    right: 10px;">
      <?php if(strpos( _ppt(array('currency','symbol')), "fal") === false){ echo hook_currency_symbol('');  }else{ echo '<i class="'._ppt(array('currency','symbol')).'"></i>'; } ?>
      </span>
    </div>
  </div>
  <div class="col-md-6">
    <label class="text-600">
    <?php echo $title2;  ?>
    </label>
    <div class="position-relative">
      <input type="text" placeholder="<?php echo __("Any","premiumpress"); ?>" class="form-control customfilter val-numeric" autocomplete="off" <?php if(!$CORE->isMobileDevice()){ ?>onchange="_filter_update()" <?php } ?> data-formatted-text="<?php echo $title2; ?>" name="price2" data-type="text" data-key="price2" id="filter_price_value_2" value="<?php echo $price2; ?>">
      <span class="position-absolute iconbit" style="top: 10px;    right: 10px;">
      <?php if(strpos( _ppt(array('currency','symbol')), "fal") === false){ echo hook_currency_symbol('');  }else{ echo '<i class="'._ppt(array('currency','symbol')).'"></i>'; } ?>
      </span>
    </div>
  </div>
</div>
</div>

<div class="<?php if(!is_admin() && isset($_POST['action'])){ ?>pb-3<?php } ?>">
<input type="hidden" class="price-slider" data-max="<?php echo $max_price; ?>" value=""  />
</div>
 