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
  
  "title" => __("Image Gallery","premiumpress"), 
  "desc" => __("Here are additional settings for the image gallery display.","premiumpress"), 
  "back" => "overview"
  
  );
  
   _ppt_template('framework/admin/_form-wrap-top' );
   
    ?>
<div class="card card-admin">
  <div class="card-body">
   
    <div class="container px-0 border-bottom mb-3">
      <div class="row py-2">
        <div class="col-md-7">
          <label><?php echo __("Show Empty Boxes","premiumpress"); ?></label>
          <p class="text-muted"><?php echo __("Turn on/off the display of empty image boxes.","premiumpress"); ?></p>
        </div>
        <div class="col-md-5">
          <div class="mt-3">
            <label class="radio off">
            <input type="radio" name="toggle" 
               value="off" onchange="document.getElementById('display_gal_empty').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
               value="on" onchange="document.getElementById('display_gal_empty').value='1'">
            </label>
            <div class="toggle <?php if( in_array(_ppt(array('gallery', 'empty')), array("", "1")) ){  ?>on<?php } ?>">
              <div class="yes">ON</div>
              <div class="switch"></div>
              <div class="no">OFF</div>
            </div>
          </div>
          <input type="hidden" id="display_gal_empty" name="admin_values[gallery][empty]" value="<?php if(_ppt(array('gallery', 'empty')) == ""){ echo 1; }else{ echo _ppt(array('gallery', 'empty')); } ?>">
        </div>
      </div>
    </div>
   
    
    <div class="p-4 bg-light text-center mt-4">
      <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
    </div>
    
  </div>
</div>
 
 
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?>