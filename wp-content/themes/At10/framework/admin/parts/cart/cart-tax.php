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

 

global $settings;

$settings = array("title" => __("Website Tax","premiumpress"), "desc" => "", "back" => "overview");

_ppt_template('framework/admin/_form-wrap-top' ); ?>

<div class="card card-admin">
<div class="card-body">
  <div class="row">
    <div class="col-md-2">
      <label><?php echo __("Enable","premiumpress"); ?></label>
      <div class="mt-3">
        <label class="radio off">
        <input type="radio" name="toggle" 
                                  value="off" onchange="document.getElementById('system_tax').value='0'">
        </label>
        <label class="radio on">
        <input type="radio" name="toggle"
                                  value="on" onchange="document.getElementById('system_tax').value='1'">
        </label>
        <div class="toggle <?php if(_ppt('system_tax') == '1'){  ?>on<?php } ?>">
          <div class="yes">
            ON
          </div>
          <div class="switch">
          </div>
          <div class="no">
            OFF
          </div>
        </div>
      </div>
      <input type="hidden" id="system_tax" name="admin_values[system_tax]" 
                             value="<?php echo _ppt('system_tax'); ?>">
    </div>
    <div class="col-md-10">
      <div class="bg-light p-3 rounded-lg m-3">
        <?php echo   __("By default tax charges are enabled per item. Enable this option to turn tax on for all items.","premiumpress"); ?>
      </div>
    </div>
  </div>
</div>
<?php


_ppt_template('framework/admin/_form-wrap-bottom' ); 

$settings = array(
	"title" => __("Flat Rate Tax","premiumpress"), 
	"desc" => __("This will apply tax to all items at checkout.","premiumpress"), 
);

_ppt_template('framework/admin/_form-wrap-top' );


 ?>
<div class="card card-admin">
  <div class="card-body">
    <div class="row" style="border-top:0px; padding:0px;">
      <div class="col-md-3">
        <label><?php echo __("Enable","premiumpress"); ?></label>
        <div class="mt-4">
          <label class="radio off">
          <input type="radio" name="toggle" 
                                  value="off" onchange="document.getElementById('basic_tax_flatrate').value='0'">
          </label>
          <label class="radio on">
          <input type="radio" name="toggle"
                                  value="on" onchange="document.getElementById('basic_tax_flatrate').value='1'">
          </label>
          <div class="toggle <?php if(_ppt('basic_tax_flatrate') == '1'){  ?>on<?php } ?>">
            <div class="yes">
              ON
            </div>
            <div class="switch">
            </div>
            <div class="no">
              OFF
            </div>
          </div>
        </div>
        <input type="hidden" id="basic_tax_flatrate" name="admin_values[basic_tax_flatrate]" 
                             value="<?php echo _ppt('basic_tax_flatrate'); ?>">
      </div>
      <div class="col-md-4">
        <label><?php echo __("Flat Rate","premiumpress"); ?> <br />
        <small class="text-muted">(<?php echo __("fixed price","premiumpress"); ?>)</small> </label>
        <div class="input-group">
          <span class="add-on input-group-prepend"><span class="input-group-text">
          <?php if(strpos( _ppt(array('currency','symbol')), "fa") === false){ echo hook_currency_symbol('');  }else{ echo '<i class="'._ppt(array('currency','symbol')).'"></i>'; } ?>
          </span></span>
          <input type="text" name="admin_values[basic_tax][flatrate]"  value="<?php echo _ppt(array('basic_tax','flatrate')); ?>" class="form-control numericonly" >
        </div>
      </div>
      <div class="col-md-4">
        <label><?php echo __("Flat Rate","premiumpress"); ?> <br />
        <small class="text-muted">(<?php echo __("percentage","premiumpress"); ?>)</small> </label>
        <div class="input-group">
          <span class="add-on input-group-prepend"><span class="input-group-text">%</span></span>
          <input type="text" name="admin_values[basic_tax][flatrate_percent]"   value="<?php echo _ppt(array('basic_tax','flatrate_percent')); ?>" class="form-control numericonly" >
        </div>
      </div>
    </div>
  </div>
</div>
<?php


_ppt_template('framework/admin/_form-wrap-bottom' ); 

$settings = array(
	"title" => __("Country Tax","premiumpress"), 
	"desc" => __("This will apply tax to users from the selected country.","premiumpress"), 
);

_ppt_template('framework/admin/_form-wrap-top' );


 ?>
<div class="card card-admin">
  <div class="card-body">
    <div class="row" style="border-top:0px; padding:0px;">
      <div class="col-md-3">
        <label><?php echo __("Enable","premiumpress"); ?></label>
        <div class="mt-2">
          <label class="radio off">
          <input type="radio" name="toggle" 
                                  value="off" onchange="document.getElementById('basic_country_tax_tax').value='0'">
          </label>
          <label class="radio on">
          <input type="radio" name="toggle"
                                  value="on" onchange="document.getElementById('basic_country_tax_tax').value='1'">
          </label>
          <div class="toggle <?php if(_ppt('basic_country_tax_tax') == '1'){  ?>on<?php } ?>">
            <div class="yes">
              ON
            </div>
            <div class="switch">
            </div>
            <div class="no">
              OFF
            </div>
          </div>
        </div>
        <input type="hidden" id="basic_country_tax_tax" name="admin_values[basic_country_tax_tax]" 
                             value="<?php echo _ppt('basic_country_tax_tax'); ?>">
      </div>
      <div class="col-md-9">
      
        <div id="ppt_tax_country"></div>
        
<?php $regions = _ppt('regions');
if(is_array($regions)){ 
$i=0; 
while($i < count($regions['name']) ){
if($regions['name'][$i] !=""){	 ?>
        <div class="row mb-4">
          <div class="col-md-12">
            <label class="small"><?php echo $regions['name'][$i]; ?></label>
            <!--<small><?php echo $regions['key'][$i]; ?></small>-->
          </div>
          <div class="col-md-6">
            <div class="input-group">
              <span class="add-on input-group-prepend"><span class="input-group-text">
              <?php if(strpos( _ppt(array('currency','symbol')), "fa") === false){ echo hook_currency_symbol('');  }else{ echo '<i class="'._ppt(array('currency','symbol')).'"></i>'; } ?>
              </span></span>
              <input type="text" name="admin_values[tax_country][price_<?php echo $regions['key'][$i]; ?>]"  value="<?php echo _ppt(array('tax_country','price_'.$regions['key'][$i])); ?>" class="form-control numericonly" >
            </div>
          </div>
          <div class="col-md-6">
            <div class="input-group">
              <span class="add-on input-group-prepend"><span class="input-group-text">%</span></span>
              <input type="text" name="admin_values[tax_country][percentage_<?php echo $regions['key'][$i]; ?>]"  value="<?php echo _ppt(array('tax_country','percentage_'.$regions['key'][$i])); ?>"  class="form-control numericonly">
            </div>
          </div>
        </div>
        <?php	
						
								
							} // end if
							$i++;
						} // end foreach
					}else{			 
					?>
        <?php } ?>
      </div>
    </div>
  </div>
  <div class="p-4 bg-light text-center mt-4">
    <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
  </div>
</div>
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?>
