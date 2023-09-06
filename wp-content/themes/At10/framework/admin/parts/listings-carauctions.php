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
  
  	"title" => __("Car Auction Setup","premiumpress"), 
  
  	"desc" => "",  
	
    "back" => "overview",
  
  );
  
  
   _ppt_template('framework/admin/_form-wrap-top' ); ?>
   
<div class="card card-admin">
  <div class="card-body">
  
   
        
          <div class="row border-bottom pb-3 mb-3">
            <div class="col-md-8 ">
              <label class="font-weight-bold mb-2"><?php echo __("Enable Make &amp; Models","premiumpress"); ?></label>
              <p class="text-muted"><?php echo __("This feature will change the auction setup and expect the category system to be used for car makes and models.","premiumpress"); ?></p>
            </div>
            <div class="col-md-2 mt-3 formrow">
              <div class="">
                <label class="radio off">
                <input type="radio" name="toggle" 
                     value="off" onchange="document.getElementById('makemodels').value='0'">
                </label>
                <label class="radio on">
                <input type="radio" name="toggle"
                     value="on" onchange="document.getElementById('makemodels').value='1'">
                </label>
                <div class="toggle <?php if( _ppt(array('lst','makemodels')) == '1'){  ?>on<?php } ?>">
                  <div class="yes">ON</div>
                  <div class="switch"></div>
                  <div class="no">OFF</div>
                </div>
              </div>
              <input type="hidden" id="makemodels" name="admin_values[lst][makemodels]" value="<?php echo _ppt(array('lst','makemodels')); ?>">
            </div>
          </div>
          
          
          
          <div class="row border-bottom pb-3 mb-3">
            <div class="col-md-8 ">
              <label class="font-weight-bold mb-2"><?php echo __("Disable Car Types","premiumpress"); ?></label>
              <p class="text-muted"><?php echo __("This will turn on/off the car types option.","premiumpress"); ?></p>
            </div>
            <div class="col-md-2 mt-3 formrow">
              <div class="">
                <label class="radio off">
                <input type="radio" name="toggle" 
                     value="off" onchange="document.getElementById('makemodels_type').value='0'">
                </label>
                <label class="radio on">
                <input type="radio" name="toggle"
                     value="on" onchange="document.getElementById('makemodels_type').value='1'">
                </label>
                <div class="toggle <?php if( _ppt(array('lst','makemodels_type')) == '1'){  ?>on<?php } ?>">
                  <div class="yes">ON</div>
                  <div class="switch"></div>
                  <div class="no">OFF</div>
                </div>
              </div>
              <input type="hidden" id="makemodels_type" name="admin_values[lst][makemodels_type]" value="<?php echo _ppt(array('lst','makemodels_type')); ?>">
            </div>
          </div>
             
    
    
    <div class="p-4 bg-light text-center mt-4">
      <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
    </div>
    
    
  </div>
</div>
 
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?>