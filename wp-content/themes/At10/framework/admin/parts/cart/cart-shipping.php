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

global $region_list;


$current_country_ship_array = get_option('ppt_country_ship_price_array'); $current_amount_ship_array = get_option('ppt_amount_ship_price_array'); $current_free_shipping_array = get_option('ppt_free_shipping_array');
 
global $settings;

$settings = array(
"title" => __("Shipping","premiumpress"), 
"desc" => "", 
"back" => "overview",

);

_ppt_template('framework/admin/_form-wrap-top' ); ?>  <div class="card card-admin"><div class="card-body">
 
   
<?php if(defined('WLT_CART')){  ?>
<?php } ?> 



<div class="row">

 
    
    <div class="col-md-2">
     <label><?php echo __("Enable","premiumpress"); ?></label>
	<div class="mt-3">
                                    <label class="radio off">
                                  <input type="radio" name="toggle" 
                                  value="off" onchange="document.getElementById('system_shipping').value='0'">
                                  </label>
                                  <label class="radio on">
                                  <input type="radio" name="toggle"
                                  value="on" onchange="document.getElementById('system_shipping').value='1'">
                                  </label>
                                  <div class="toggle <?php if(_ppt('system_shipping') == '1'){  ?>on<?php } ?>">
                                    <div class="yes">ON</div>
                                    <div class="switch"></div>
                                    <div class="no">OFF</div>
                                  </div>
                                </div> 
                           
                             
                             <input type="hidden" id="system_shipping" name="admin_values[system_shipping]" 
                             value="<?php echo _ppt('system_shipping'); ?>"> 
                             
                              
    
</div>


   <div class="col-md-10">
    
            
        <div class="bg-light p-3 m-3"><?php echo __("By default shipping charges are enabled per item.  Enable this option to turn shipping on for all items.","premiumpress"); ?></div>
        
    </div>

</div>




</div>
</div>

<?php


_ppt_template('framework/admin/_form-wrap-bottom' ); 

$settings = array(
	"title" => __("Flat Rate Shipping","premiumpress"), 
	"desc" => __("This will apply shipping to all items at checkout.","premiumpress"), 
);

_ppt_template('framework/admin/_form-wrap-top' );


 ?> 
 
 <div class="card card-admin"><div class="card-body"> 
  
  

<div class="row">

<div class="col-md-3">

    <label><?php echo __("Enable","premiumpress"); ?></label>
  <div class="mt-3">
                                  <label class="radio off">
                                  <input type="radio" name="toggle" 
                                  value="off" onchange="document.getElementById('basic_shipping_flatrate').value='0'">
                                  </label>
                                  <label class="radio on">
                                  <input type="radio" name="toggle"
                                  value="on" onchange="document.getElementById('basic_shipping_flatrate').value='1'">
                                  </label>
                                  <div class="toggle <?php if(_ppt('basic_shipping_flatrate') == '1'){  ?>on<?php } ?>">
                                    <div class="yes">ON</div>
                                    <div class="switch"></div>
                                    <div class="no">OFF</div>
                                  </div>
                                </div> 
                           
                             
                             <input type="hidden" id="basic_shipping_flatrate" name="admin_values[basic_shipping_flatrate]" 
                             value="<?php echo _ppt('basic_shipping_flatrate'); ?>"> 
  

</div>

<div class="col-md-4">

	<label class="txt500"><?php echo __("Flat Rate","premiumpress"); ?> <br /><small> (<?php echo __("fixed price","premiumpress"); ?>)</small></label>
    <div class="input-group">
      <span class="add-on input-group-prepend"><span class="input-group-text"><?php if(strpos( _ppt(array('currency','symbol')), "fa") === false){ echo hook_currency_symbol('');  }else{ echo '<i class="'._ppt(array('currency','symbol')).'"></i>'; } ?></span></span>
        <input type="text" name="admin_values[basic_shipping][flatrate]"  value="<?php echo _ppt(array('basic_shipping','flatrate')); ?>" class="form-control" >    
    </div>   
 
</div>

 

<div class="col-md-4">

	<label class="txt500"><?php echo __("Flat Rate","premiumpress"); ?> <br /><small>(<?php echo __("percentage","premiumpress"); ?>)</small></label>
    <div class="input-group">
     <span class="add-on input-group-prepend"><span class="input-group-text">%</span></span>
   <input type="text" name="admin_values[basic_shipping][flatrate_percent]" value="<?php echo _ppt(array('basic_shipping','flatrate_percent')); ?>" class="form-control" >   
    </div>   
 
</div>


 

</div> 

 
 
 
</div></div>



<?php


_ppt_template('framework/admin/_form-wrap-bottom' ); 

$settings = array(
	"title" => __("Free Shipping","premiumpress"), 
	"desc" => __("This will check the total cart value at the end of checkout.","premiumpress"), 
);

_ppt_template('framework/admin/_form-wrap-top' );


 ?> 
 
 <div class="card card-admin"><div class="card-body"> 
  
 
 
 

<div class="row">

<div class="col-md-3">

    <label><?php echo __("Enable","premiumpress"); ?></label>
  <div>
                                  <label class="radio off">
                                  <input type="radio" name="toggle" 
                                  value="off" onchange="document.getElementById('basic_free_shipping').value='0'">
                                  </label>
                                  <label class="radio on">
                                  <input type="radio" name="toggle"
                                  value="on" onchange="document.getElementById('basic_free_shipping').value='1'">
                                  </label>
                                  <div class="toggle <?php if(_ppt('basic_free_shipping') == '1'){  ?>on<?php } ?>">
                                    <div class="yes">ON</div>
                                    <div class="switch"></div>
                                    <div class="no">OFF</div>
                                  </div>
                                </div> 
                           
                             
                             <input type="hidden" id="basic_free_shipping" name="admin_values[basic_free_shipping]" 
                             value="<?php echo _ppt('basic_free_shipping'); ?>"> 
  

</div>

<div class="col-md-4">

  <label><?php echo __("Select Region","premiumpress"); ?></label>
               
                
                  <select data-placeholder="Choose a region..." class="form-control" name="basic_free_ship" id="freeship" style="width:100%;">
                
                    <option value="" title='<?php if(isset($current_free_shipping_array['default'])){ echo $current_free_shipping_array['default']; } ?>'><?php echo __("All Regions","premiumpress"); ?></option>
                    
                    <?php
					
					$regions = _ppt('regions');
					
					 
					if(is_array($regions)){ 
						$i=0; 
						if(isset($regions['name'])){
						
						 
						while($i < count($regions['name']) ){
						
							if($regions['name'][$i] !=""){	
							
								$pp1 = "";
								$amount = 0;
								
								if( isset($current_free_shipping_array[$regions['name'][$i]]) && is_numeric($current_free_shipping_array[$regions['name'][$i]]) && $current_free_shipping_array[$regions['name'][$i]] > 0 ){
								$amount = $current_free_shipping_array[$regions['name'][$i]];
								}
								
								
								$pp1 = "title='".$amount."|'";	
								 
											
								echo "<option value='".$regions['name'][$i]."' ".$pp1." id='".$i."'>".$regions['name'][$i]."</option>";	
								
							} // end if
							$i++;
						} // end foreach
					}// end if		
					}		 
					?>                    
                  </select>

</div>
      <script>
			jQuery(document).ready(function(){
				jQuery( "#freeship" ).change(function() {				 
					var sdt = jQuery("option:selected", this).attr("title");						 	 
					if(sdt != ""){	
					var exploded = sdt.split('|');
					 jQuery('#free_ship_price').val(exploded[0]);
					 
					}
				});		
			});
			</script> 

<div class="col-md-4">
	<label class="span4"><?php echo __("Orders Over","premiumpress"); ?></label>
    <div class="input-group">
      <span class="add-on input-group-prepend"><span class="input-group-text"><?php if(strpos( _ppt(array('currency','symbol')), "fa") === false){ echo hook_currency_symbol('');  }else{ echo '<i class="'._ppt(array('currency','symbol')).'"></i>'; } ?></span></span>
        <input type="text" class="form-control" name="free_ship_price" id="free_ship_price" value="<?php if(isset($current_free_shipping_array['default']) && $current_free_shipping_array['default'] > 0){ echo $current_free_shipping_array['default']; } ?>">    
    </div>  
    
 

</div> 

 
 </div>  
 
 </div>  </div>
  
 
<?php


_ppt_template('framework/admin/_form-wrap-bottom' ); 

$settings = array(
	"title" => __("Country Shipping","premiumpress"), 
	"desc" => __("This will apply shipping to users from the selected country.","premiumpress"), 
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
                                  value="off" onchange="document.getElementById('basic_country_ship_ship').value='0'">
          </label>
          <label class="radio on">
          <input type="radio" name="toggle"
                                  value="on" onchange="document.getElementById('basic_country_ship_ship').value='1'">
          </label>
          <div class="toggle <?php if(_ppt('basic_country_ship_ship') == '1'){  ?>on<?php } ?>">
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
        <input type="hidden" id="basic_country_ship_ship" name="admin_values[basic_country_ship_ship]" 
                             value="<?php echo _ppt('basic_country_ship_ship'); ?>">
      </div>
      <div class="col-md-9">
        <div id="ppt_ship_country">
        </div>
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
              <input type="text" name="admin_values[ship_country][price_<?php echo $regions['key'][$i]; ?>]"  value="<?php echo _ppt(array('ship_country','price_'.$regions['key'][$i])); ?>" class="form-control numericonly" >
            </div>
          </div>
          <div class="col-md-6">
            <div class="input-group">
              <span class="add-on input-group-prepend"><span class="input-group-text">%</span></span>
              <input type="text" name="admin_values[ship_country][percentage_<?php echo $regions['key'][$i]; ?>]"  value="<?php echo _ppt(array('ship_country','percentage_'.$regions['key'][$i])); ?>"  class="form-control numericonly">
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
 
 
 
 
 
<?php

$settings = array(
	"title" => __("Custom Methods","premiumpress"), 
	"desc" => __("This will give the user optional extras at checkout.","premiumpress"), 
);

_ppt_template('framework/admin/_form-wrap-top' );


 ?> 
 
 <div class="card card-admin"><div class="card-body"> 
  
  <?php _ppt_template('framework/admin/parts/cart/shipping-methods' ); ?>
 
</div>

  <div class="p-4 bg-light text-center mt-4">
    <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
  </div>
</div> 

 
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?>


 
<?php


/*
_ppt_template('framework/admin/_form-wrap-bottom' ); 

$settings = array(
	"title" => __("Weight Based Shipping","premiumpress"), 
	"desc" => __("This will check the total cart value at the end of checkout.","premiumpress"), 
);

_ppt_template('framework/admin/_form-wrap-top' );


 ?> 
 
 <div class="card card-admin"><div class="card-body"> 
  
  <?php _ppt_template('framework/admin/parts/cart/shipping-weight' ); ?>
 
</div></div>



 
_ppt_template('framework/admin/_form-wrap-bottom' ); 

$settings = array(
	"title" => __("Country Based Shipping","premiumpress"), 
	"desc" => __("This will be applied when the user selects their country.","premiumpress"), 
);

_ppt_template('framework/admin/_form-wrap-top' );


 ?> 
 
 <div class="card card-admin"><div class="card-body"> 
  
  <?php _ppt_template('framework/admin/parts/cart/shipping-country' );?>
 
</div></div>
 
*/ ?>  