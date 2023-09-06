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

"title" => __("Video Preview","premiumpress"), 
"desc" => __("This feature lets the user watch a video for X seconds before being asked to upgrade.","premiumpress") 
);

   _ppt_template('framework/admin/_form-wrap-top' ); ?>
<div class="card card-admin">
  <div class="card-body">
    <div class="container px-0  border-bottom mb-3">
      <div class="row">
        <div class="col-8">
          <label><?php echo __("Video Preview","premiumpress"); ?></label>
          <p class="text-muted"><?php echo __("Turn on/off this feature.","premiumpress"); ?></p>
        </div>
        <div class="col-3">
          <div class="mt-3">
            <label class="radio off">
            <input type="radio" name="toggle" 
               value="off" onchange="document.getElementById('videopreview_enable').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
               value="on" onchange="document.getElementById('videopreview_enable').value='1'">
            </label>
            <div class="toggle <?php if(_ppt(array('lst', 'videopreview_enable')) == '1'){  ?>on<?php } ?>">
              <div class="yes">ON</div>
              <div class="switch"></div>
              <div class="no">OFF</div>
            </div>
          </div>
          <input type="hidden" id="videopreview_enable" name="admin_values[lst][videopreview_enable]" value="<?php echo _ppt(array('lst', 'videopreview_enable')); ?>">
        </div>
      </div>
    </div>
    <div class="container px-0  border-bottom mb-3">
      <div class="row py-2">
        <div class="col-8">
          <label><?php echo __("Video Preview Length","premiumpress"); ?></label>
          <p class="text-muted"><?php echo __("Enter a value in seconds.","premiumpress"); ?></p>
        </div>
        <div class="col-4">
          <div class="input-group"> <span class="input-group-prepend input-group-text">#</span>
            <input type="text" class="form-control btn-block"  name="admin_values[lst][videopreview_seconds]" value="<?php if(is_numeric(_ppt(array('lst', 'videopreview_seconds')))){ echo _ppt(array('lst', 'videopreview_seconds')); }else{ echo 20; } ?>" style="max-width:100px">
          </div>
        </div>
      </div>
    </div>
    <div class="container px-0  border-bottom mb-3">
      <div class="row py-2">
        <div class="col-12">
          <label><?php echo __("Custom Message","premiumpress"); ?></label>
          <p class="text-muted"><?php echo __("Enter a custom message to display when the timer runs out.","premiumpress"); ?></p>
        </div>
        <div class="col-12">
          <textarea class="form-control"  style="height:200px !important;font-size:11px;" name="admin_values[lst][videopreview_message]"><?php echo stripslashes(_ppt(array('lst', 'videopreview_message'))); ?></textarea>
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