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
  
  "title" => __("House Commission","premiumpress"), 
  "video" => "https://www.youtube.com/watch?v=YEfXPOG0sqY",
  
  "back" => "overview",
  
  "desc" => str_replace("%s", strtolower($CORE->LAYOUT("captions","2")),__("Here you can charge users a percentage for %s sold.","premiumpress")) 
 
  );
  
  
  
   _ppt_template('framework/admin/_form-wrap-top' ); ?>
   
   
<div class="card card-admin">
  <div class="card-body">
    <div class="container px-0 border-bottom mb-3">
      <div class="row py-2">
      
      
        <div class="col-md-7">
          <label><?php echo __("Buyer Commission","premiumpress"); ?></label>
          <p class="text-muted"><?php echo __("Set a percentage or a fixed amount.","premiumpress"); ?></p>
        </div>
        <div class="col-md-5"> 
        
          <div class="input-group"> <span class="input-group-prepend input-group-text">%</span>
            <input type="text" class="form-control btn-block"  name="admin_values[hc][house_comission_buyer]" value="<?php if(is_numeric(_ppt(array('hc', 'house_comission_buyer')))){ echo _ppt(array('hc', 'house_comission_buyer')); }else{ echo 0; } ?>" style="max-width:100px">
          </div>
          
                    <div class="input-group mt-3"> <span class="input-group-prepend input-group-text"><?php if(strpos( _ppt(array('currency','symbol')), "fa") === false){ echo hook_currency_symbol('');  }else{ echo '<i class="'._ppt(array('currency','symbol')).'"></i>'; } ?></span>
            <input type="text" class="form-control btn-block"  name="admin_values[hc][house_comission_buyer_fixed]" value="<?php if(is_numeric(_ppt(array('hc', 'house_comission_buyer_fixed')))){ echo _ppt(array('hc', 'house_comission_buyer_fixed')); }else{ echo 0; } ?>" style="max-width:100px">
          </div> 
          
        </div>
      
      <div class="col-md-12"><hr /></div>
      
        <div class="col-md-7">
          <label><?php echo __("Seller Commission","premiumpress"); ?></label>
         <p class="text-muted"><?php echo __("Set a percentage or a fixed amount.","premiumpress"); ?></p>
        </div>
        <div class="col-md-5"> 
        
          <div class="input-group"> <span class="input-group-prepend input-group-text">%</span>
            <input type="text" class="form-control btn-block"  name="admin_values[hc][house_comission]" value="<?php if(is_numeric(_ppt(array('hc', 'house_comission')))){ echo _ppt(array('hc', 'house_comission')); }else{ echo 0; } ?>" style="max-width:100px">
          </div>
          
                    <div class="input-group mt-3"> <span class="input-group-prepend input-group-text"><?php if(strpos( _ppt(array('currency','symbol')), "fa") === false){ echo hook_currency_symbol('');  }else{ echo '<i class="'._ppt(array('currency','symbol')).'"></i>'; } ?></span>
            <input type="text" class="form-control btn-block"  name="admin_values[hc][house_comission_fixed]" value="<?php if(is_numeric(_ppt(array('hc', 'house_comission_fixed')))){ echo _ppt(array('hc', 'house_comission_fixed')); }else{ echo 0; } ?>" style="max-width:100px">
          </div> 
          
        </div>
        
        
        
        
        
        
      </div>
    </div>
    <div class="container px-0  border-bottom mb-3">
    
    
    
      <div class="row">
        <div class="col-8">
          <label><?php echo __("Commission Invoice","premiumpress"); ?></label>
          <p class="text-muted"><?php echo __("Turn on/off the commission invoice.","premiumpress"); ?></p>
        </div>
        <div class="col-3">
          <div class="mt-3">
            <label class="radio off">
            <input type="radio" name="toggle" 
               value="off" onchange="document.getElementById('house_comission_invoice').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
               value="on" onchange="document.getElementById('house_comission_invoice').value='1'">
            </label>
            <div class="toggle <?php if(_ppt(array('hc', 'house_comission_invoice')) == '1'){  ?>on<?php } ?>">
              <div class="yes">ON</div>
              <div class="switch"></div>
              <div class="no">OFF</div>
            </div>
          </div>
          <input type="hidden" id="house_comission_invoice" name="admin_values[hc][house_comission_invoice]" value="<?php echo _ppt(array('hc', 'house_comission_invoice')); ?>">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <h6><?php echo __("Commission Invoice On","premiumpress"); ?></h6>
        <p><?php echo __("After a seller has successfully completed an order, a new invoice with the commission amount is added to the sellers account so they can pay separately.","premiumpress"); ?> </p>
        <ul class="mt-2 small">
          <li><i class="fa fa-check mr-2"></i> <?php echo __("More protection for website owner","premiumpress"); ?></li>
          <li><i class="fa fa-check mr-2"></i> <?php echo __("Easier for accountant","premiumpress"); ?></li>
          <li><i class="fa fa-times mr-2"></i> <?php echo __("One extra step for user","premiumpress"); ?></li>
        </ul>
      </div>
      <div class="col-md-6">
        <h6><?php echo __("Commission Invoice Off","premiumpress"); ?></h6>
        <p><?php echo __("After a seller has successfully completed an order, the sellers account is automatically deducted the house comission. No invoice is added.","premiumpress"); ?> </p>
        <ul class="mt-2 small">
          <li><i class="fa fa-check mr-2"></i> <?php echo __("Easier process","premiumpress"); ?></li>
          <li><i class="fa fa-times mr-2"></i> <?php echo __("Less protection for website owner","premiumpress"); ?></li>
        </ul>
      </div>
    </div>
    <div class="p-4 bg-light text-center mt-4">
      <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
    </div>
  </div>
</div>
<!-- end admin card -->
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?> 