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
  
  "title" => __("Escrow System","premiumpress"), 
  //"video" => "https://www.youtube.com/watch?v=YEfXPOG0sqY",
  
  "back" => "overview",
  
  "desc" => __("Here you can configure the built-in Escrow setup.","premiumpress") 
 
  );
  
  
  
   _ppt_template('framework/admin/_form-wrap-top' ); ?>
   
   
<div class="card card-admin">
  <div class="card-body">
  
  
  
 
 
      <div class="container px-0 mb-3">
        <div class="row">
          <div class="col-8">
            <label class="txt500">Escrow System</label>
            <p class="text-muted">By default buyer to seller payments are handled by users themselves. </p>
            
            <p class="text-muted">If you would like to act as the middle man and accept payments on behalf of the seller you can do here.</p>
            
            <p class="text-muted">Once the seller marks the order as completed, the sellers account will be credited with the order amount and can request you pay them directly as anytime.  </p>
          </div>
          <div class="col-3">
            <div class="mt-3">
              <label class="radio off">
              <input type="radio" name="toggle" 
               value="off" onchange="document.getElementById('enable_escrow').value='0'">
              </label>
              <label class="radio on">
              <input type="radio" name="toggle"
               value="on" onchange="document.getElementById('enable_escrow').value='1'">
              </label>
              <div class="toggle <?php if(_ppt(array('escrow', 'enable_escrow')) == '1'){  ?>on<?php } ?>">
                <div class="yes">ON</div>
                <div class="switch"></div>
                <div class="no">OFF</div>
              </div>
            </div>
            <input type="hidden" id="enable_escrow" name="admin_values[escrow][enable_escrow]" value="<?php if(_ppt(array('escrow', 'enable_escrow')) == ""){ echo 1; }else{ echo _ppt(array('escrow', 'enable_escrow')); } ?>">
          </div>
        </div>
      </div>
      
      

 
   
   
    <div class="p-4 bg-light text-center mt-4">
      <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
    </div>
    
  </div>
</div>
<!-- end admin card -->
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?> 