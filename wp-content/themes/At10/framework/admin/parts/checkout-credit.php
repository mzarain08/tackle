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

global $CORE, $CORE_ADMIN, $settings;
  

 


  $settings = array(
  
  "title" => __("Credit System","premiumpress"), 
  "desc" => __("Here you can set an amount of money for users to buy for credit.","premiumpress"),
  "back" => "overview",
  );
   _ppt_template('framework/admin/_form-wrap-top' ); ?>
  
   
<div class="card card-admin">
  <div class="card-body">
  
  
          <div class="row border-bottom pb-3 mb-3">
            <div class="col-md-8 ">
            
              <label class="font-weight-bold mb-2"><?php echo  __("Enable Credit System","premiumpress"); ?></label>
              
              <p class="text-muted"><?php echo __("Enable users to buy credit for use on your website.","premiumpress"); ?></p>
              
            </div>
            <div class="col-md-2 mt-3 formrow">
              <div class="">
                <label class="radio off">
        <input type="radio" name="toggle" 
               value="off" onchange="document.getElementById('creditss').value='0'">
        </label>
        <label class="radio on">
        <input type="radio" name="toggle"
               value="on" onchange="document.getElementById('creditss').value='1'">
        </label>
        <div class="toggle <?php if(_ppt(array('credit','enable'))  == '1'){  ?>on<?php } ?>">
          <div class="yes">ON</div>
          <div class="switch"></div>
          <div class="no">OFF</div>
        </div>
      </div>
      <input type="hidden" id="creditss" name="admin_values[credit][enable]" value="<?php if(_ppt(array('credit','enable')) == ""){ echo 0; }else{ echo _ppt(array('credit','enable')); } ?>">
            </div>
          </div> 
           
  
  
  
  
  <?php $i=1; while($i < 8){ ?>
  <div class="row">
  
   <div class="col-md-4">
   
   </div>
  
  <div class="col-md-4">
  <label><?php echo __("User Pays","premiumpress"); ?></label>
  
    <div class="input-group">   
	<input class="form-control numericonly" placeholder="0" name="admin_values[credit][<?php echo $i; ?>a]" value="<?php echo _ppt(array('credit', $i .'a')); ?>" style="padding-left:30px !important;"/>
     
    
    <div class="position-absolute text-muted" style="bottom: 8px;    right: 10px;"><?php echo hook_currency_code(''); ?></div>

    </div>
  
  
  
  </div>
  <div class="col-md-4">
  <label><?php echo __("Credit Received","premiumpress"); ?></label>

    <div class="input-group">   
	<input class="form-control numericonly" placeholder="0" name="admin_values[credit][<?php echo $i; ?>b]" value="<?php echo _ppt(array('credit', $i .'b')); ?>" style="padding-left:30px !important;"/>
   
    
    <div class="position-absolute text-muted" style="bottom: 8px;    right: 10px;"><?php echo hook_currency_code(''); ?></div>

    </div>

  </div>
  
  <div class="col-12">
  <hr />
  </div>
  
  </div>
  
  <?php $i++;  } ?>
  


    
    <div class="p-4 bg-light text-center mt-4">
      <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
    </div>
    
    
  </div>
</div>
 
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?>