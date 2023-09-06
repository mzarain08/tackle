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
   
   global $wpdb, $CORE, $settings;
   
 
 
  $settings = array(
  
  "title" => __("Global Settings","premiumpress"), 
  
  "desc" => str_replace("%s", strtolower($CORE->LAYOUT("captions","1")), __("These global %s settings apply to the entire website.","premiumpress") ) ,
   
  "back" => "overview",
  
  );
   _ppt_template('framework/admin/_form-wrap-top' ); 
   
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
  
?>

<div class="card card-admin">
  <div class="card-body">
  
  
  
 
    <div class="container px-0 border-bottom mb-3">
      <div class="row py-2">
        <div class="col-md-8 pr-lg-5">
          <label><?php echo __("Disable Buy Now","premiumpress"); ?></label>
          <p class="text-muted"><?php echo __("Turn OFF the hide the buy now option on your product pages.","premiumpress"); ?></p>
        </div>
        <div class="col-md-2">
          <div class="mt-4 formrow">
            <label class="radio off">
            <input type="radio" name="toggle" 
                        value="off" onchange="document.getElementById('sp_buynow').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
                        value="on" onchange="document.getElementById('sp_buynow').value='1'">
            </label>
            <div class="toggle <?php if(_ppt(array('lst', 'sp_buynow' )) == '1'){  ?>on<?php } ?>">
              <div class="yes">ON</div>
              <div class="switch"></div>
              <div class="no">OFF</div>
            </div>
          </div>
          <input type="hidden" id="sp_buynow" name="admin_values[lst][sp_buynow]" value="<?php echo _ppt(array('lst', 'sp_buynow' )); ?>">
        </div>
      </div>
    </div>
    
  <div class="p-4 bg-light text-center mt-4">
      <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
    </div>
    
    

 </div> </div>
 
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?>
