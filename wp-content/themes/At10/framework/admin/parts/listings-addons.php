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
 
 
 $addons_array = $CORE->PACKAGE("get_packages_addons", array() );
 if(!empty($addons_array)){
 
  $settings = array("title" => __("Upgrades","premiumpress"), 
  
  "desc" => str_replace("%s", strtolower($CORE->LAYOUT("captions","1")),__("Upgrades are additonal add-ons for a %s. Set all values to OFF to hide display on the frontend.","premiumpress")."<br><br>".__("Set the days value to 0 to expire when the listing expires.","premiumpress")), 
  
  
    "back" => "overview",
  
  );
  
  
  
  
   _ppt_template('framework/admin/_form-wrap-top' ); ?>
<div class="card card-admin">
  <div class="card-body">
    <div class="container px-0  border-bottom mb-3 ">
      <div class="row">
        <div class="col-4"> </div>
        
        
        <div class="col-3">
          <label><?php echo __("Price","premiumpress"); ?></label>
        </div>
        
         <div class="col-3">
          <label><?php echo __("Duration","premiumpress"); ?></label>
        </div>
        
        
        <div class="col-2">
          <label><?php echo __("Enable","premiumpress"); ?></label>
        </div>
      </div>
    </div>
    <?php foreach( $addons_array as $a){ ?>
    <div class="container px-0  border-bottom mb-3">
      <div class="row">
       
        <div class="col-4">
         
          <label><span class="<?php echo $a['color']; ?>"><?php echo $a['name']; ?></span></label>
         
         
         <div class="my-2">
         <a href="javascript:void(0);" onclick="<?php echo $a['ajax']; ?>()" class="btn btn-system"><?php echo __("Preview","premiumpress"); ?></a>
         </div>
         
        </div>
        
        <div class="col-3">
          <div class="position-relative">
            <input type="text" value="<?php if( _ppt(array('lst', $a['key'].'_price')) == ""){ echo 10; }else{ echo _ppt(array('lst', $a['key'].'_price')); } ?>" name="admin_values[lst][<?php echo $a['key']; ?>_price]" class="form-control" />
            <div class="position-absolute text-muted small" style="bottom: 15px; right: 10px;"><?php echo hook_currency_code(''); ?></div>
          </div>
        </div>
        
        <div class="col-3">
          <div class="position-relative">
            <input type="text" value="<?php if( _ppt(array('lst', $a['key'].'_days')) == ""){ if($a['key'] == "addon_boost" ){ echo 24; }else{ echo 0; } }else{ echo _ppt(array('lst', $a['key'].'_days')); } ?>" name="admin_values[lst][<?php echo $a['key']; ?>_days]" class="form-control" />
            <div class="position-absolute text-muted small" style="bottom: 15px; right: 10px;"><?php if($a['key'] == "addon_boost" ){ echo __("hours","premiumpress"); }else{ echo __("days","premiumpress"); } ?></div>
          </div>
        </div>
        
        
        <div class="col-2">
          <div>
            <label class="radio off">
            <input type="radio" name="toggle" 
               value="off" onchange="document.getElementById('<?php echo $a['key']; ?>_enable').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
               value="on" onchange="document.getElementById('<?php echo $a['key']; ?>_enable').value='1'">
            </label>
            <div class="toggle <?php if( _ppt(array('lst', $a['key'].'_enable')) == '1'){  ?>on<?php } ?>">
              <div class="yes">ON</div>
              <div class="switch"></div>
              <div class="no">OFF</div>
            </div>
          </div>
          <input type="hidden" id="<?php echo $a['key']; ?>_enable" name="admin_values[lst][<?php echo $a['key']; ?>_enable]" value="<?php echo _ppt(array('lst', $a['key'].'_enable')); ?>">
        </div>
      </div>
    </div>
    <?php } ?>
    <div class="p-4 bg-light text-center mt-4">
      <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
    </div>
  </div>
</div>
<!-- end admin card -->
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); 

}
?>
 