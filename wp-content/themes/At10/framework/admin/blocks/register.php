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


?>

<div class="col-12 pt-2 px-0">
  <div class="row">
    <div class="col-md-9">
      <label><?php echo __("Allow Registrations","premiumpress"); ?></label>
         <p class="text-muted mb-0"><?php echo __("Turn on/off the user registration system.","premiumpress"); ?></p>
    </div>
    <div class="col-md-3">
      <div class="input-group mb-2">
        <div class="formrow">
          <div class="">
            <label class="radio off" style="display: none;">
            <input type="radio" name="toggle" 
                                      value="off" onchange="document.getElementById('users_can_register').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
                                      value="on" onchange="document.getElementById('users_can_register').value='1'">
            </label>
            <div class="toggle <?php if( get_option('users_can_register') == '1'){  ?>on<?php } ?>">
              <div class="yes">ON</div>
              <div class="switch"></div>
              <div class="no">OFF</div>
            </div>
            <input type="hidden" id="users_can_register" name="adminArray[users_can_register]"  value="<?php echo get_option('users_can_register'); ?>">
          </div>
       
        </div>
      </div>
    </div>
  </div>
</div>

