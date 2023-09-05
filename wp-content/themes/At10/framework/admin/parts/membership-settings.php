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

global $settings, $CORE;
 
 $memnames = array( __("No Membership","premiumpress"), 'Bronze','Silver','Gold','','','','','','','' );

 
  $settings = array(
  
   "title" => __("Memberships","premiumpress"),
  
   "desc" => __("Memberships are applied to a users account and help you manage their website access.","premiumpress"),
   
   "back" => "overview",
   
    );
   
   _ppt_template('framework/admin/_form-wrap-top' ); ?>
 
 

 
      <div class="card card-admin">
        <div class="card-body">
        
        
        
 
          
          <div class="row border-bottom pb-3 mb-3">
            <div class="col-md-8 ">
              <label class="font-weight-bold mb-2"><?php echo __("Force Membership","premiumpress"); ?></label>
              <p class="text-muted"><?php echo __("This will stop users from accessing their members area until they have a valid membership.","premiumpress"); ?></p>
            </div>
            <div class="col-md-2 mt-3 formrow">
              <div class="">
                <label class="radio off">
        <input type="radio" name="toggle" 
               value="off" onchange="document.getElementById('register_memberships').value='0'">
        </label>
        <label class="radio on">
        <input type="radio" name="toggle"
               value="on" onchange="document.getElementById('register_memberships').value='1'">
        </label>
        <div class="toggle <?php if(_ppt(array('mem','register'))  == '1'){  ?>on<?php } ?>">
          <div class="yes">ON</div>
          <div class="switch"></div>
          <div class="no">OFF</div>
        </div>
      </div>
      <input type="hidden" id="register_memberships" name="admin_values[mem][register]" value="<?php if(_ppt(array('mem','register')) == ""){ echo 0; }else{ echo _ppt(array('mem','register')); } ?>">
            </div>
          </div> 
          

<?php /*
          <div class="row border-bottom pb-3 mb-3">
            <div class="col-md-8 ">
              <label class="font-weight-bold mb-2"><?php echo str_replace("%s", $CORE->LAYOUT("captions","2"), __("Force Membership Only To Create %s","premiumpress")); ?></label>
              <p class="text-muted"><?php echo str_replace("%s", strtolower($CORE->LAYOUT("captions","1")), __("Stop users without an active membership from creating new %s.","premiumpress")); ?></p>
            </div>
            <div class="col-md-2 mt-3 formrow">
              <div class="">
                <label class="radio off">
        <input type="radio" name="toggle" 
               value="off" onchange="document.getElementById('membership_required_listing').value='0'">
        </label>
        <label class="radio on">
        <input type="radio" name="toggle"
               value="on" onchange="document.getElementById('membership_required_listing').value='1'">
        </label>
        <div class="toggle <?php if(_ppt(array('mem','membership_required_listing'))  == '1'){  ?>on<?php } ?>">
          <div class="yes">ON</div>
          <div class="switch"></div>
          <div class="no">OFF</div>
        </div>
      </div>
      <input type="hidden" id="membership_required_listing" name="admin_values[mem][membership_required_listing]" value="<?php if(_ppt(array('mem','membership_required_listing')) == ""){ echo 0; }else{ echo _ppt(array('mem','membership_required_listing')); } ?>">
            </div>
          </div> 
          
   */ ?>       
          
<?php if(THEME_KEY == "so"){ ?>

           <div class="row border-bottom pb-3 mb-3">
            <div class="col-md-8 ">
              <label class="font-weight-bold mb-2"><?php echo __("Force Membership To Download","premiumpress"); ?></label>
              <p class="text-muted"><?php echo __("Stop users from downloading free items without a membership.","premiumpress"); ?></p>
            </div>
            <div class="col-md-2 mt-3 formrow">
              <div class="">
                <label class="radio off">
        <input type="radio" name="toggle" 
               value="off" onchange="document.getElementById('download_membership').value='0'">
        </label>
        <label class="radio on">
        <input type="radio" name="toggle"
               value="on" onchange="document.getElementById('download_membership').value='1'">
        </label>
        <div class="toggle <?php if(_ppt(array('mem','download_membership'))  == '1'){  ?>on<?php } ?>">
          <div class="yes">ON</div>
          <div class="switch"></div>
          <div class="no">OFF</div>
        </div>
      </div>
      <input type="hidden" id="download_membership" name="admin_values[mem][download_membership]" value="<?php if(_ppt(array('mem','download_membership')) == ""){ echo 0; }else{ echo _ppt(array('mem','download_membership')); } ?>">
            </div>
          </div>  
          
<?php } ?>   
          
   
          
          
        
          <div class="row border-bottom pb-3 mb-3">
            <div class="col-md-8 ">
              <label class="font-weight-bold mb-2"><?php echo __("Enable Extra Time","premiumpress"); ?></label>
              <p class="text-muted"><?php echo __("Turn ON if you want a users remaining package length to be added to any new purchases.","premiumpress"); ?></p>
            </div>
            <div class="col-md-2 mt-3 formrow">
              <div class="">
                <label class="radio off">
        <input type="radio" name="toggle" 
               value="off" onchange="document.getElementById('mem_paktime').value='0'">
        </label>
        <label class="radio on">
        <input type="radio" name="toggle"
               value="on" onchange="document.getElementById('mem_paktime').value='1'">
        </label>
        <div class="toggle <?php if(in_array(_ppt(array('mem','paktime')), array("","1"))){ ?>on<?php } ?>">
          <div class="yes">ON</div>
          <div class="switch"></div>
          <div class="no">OFF</div>
        </div>
      </div>
      <input type="hidden" id="mem_paktime" name="admin_values[mem][paktime]" value="<?php if(in_array(_ppt(array('mem','paktime')), array("","1"))){ echo 0; }else{ echo 0; } ?>">
            </div>
          </div> 
          
           
          
          
          
          
          
          <!-- ------------------------- -->
            <div class="p-4 bg-light text-center mt-4">
      <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
    </div>
          
           </div>
       
          
          

<?php _ppt_template('framework/admin/_form-wrap-bottom' );?> 


<?php
 
  $settings = array(
  "title" => __("Restrict Page Content","premiumpress"), 
  "desc" => __("You can strict content within your WordPress pages using the [MEMBERSHIP] shortcode.","premiumpress")
  
  );
   _ppt_template('framework/admin/_form-wrap-top' ); ?>
<div class="card card-admin">
  <div class="card-body">
  
   <label><?php echo __("Restricted Content Message","premiumpress"); ?></label>
   
   <p><?php echo __("Enter the text to display to someone who does not have access to the content.","premiumpress"); ?></p>
   
   <textarea name="admin_values[mem][listingaccessmsg]" class="form-control" style="height:100px !important;"><?php echo _ppt(array('mem','listingaccessmsg')); ?></textarea>
  <div class="opacity-5 mt-3 small"><?php echo __("leave blank for default message.","premiumpress"); ?></div>
  
    
      <div class="p-4 bg-light text-center mt-4">
      <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
    </div>
  </div>
</div>

  
<!-- end admin card -->
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?>