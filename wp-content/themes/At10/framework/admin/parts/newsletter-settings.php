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

global $CORE, $wpdb, $settings;

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$settings = array(
"title" 	=> __("Confirmation Email","premiumpress"), 
"desc" 		=> __("This email is sent to a user when they join your newsletter.","premiumpress"),
"back" 		=> "overview"
);

_ppt_template('framework/admin/_form-wrap-top' ); 
 ///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
?>
 
      <div class="card card-admin">
        <div class="card-body">
          <div class="row border-bottom pb-3 mb-3">
            <div class="col-md-8 ">
              <label class="font-weight-bold mb-2"><?php echo __("Newsletter System","premiumpress"); ?></label>
              <p class="text-muted"><?php echo __("Turn on/off to enable the built-in newsletter system.","premiumpress"); ?></p>
            </div>
            <div class="col-md-2 mt-3 formrow">
              <div class="">
                <label class="radio off">
                <input type="radio" name="toggle" 
                     value="off" onchange="document.getElementById('enablenewsl').value='0'">
                </label>
                <label class="radio on">
                <input type="radio" name="toggle"
                     value="on" onchange="document.getElementById('enablenewsl').value='1'">
                </label>
                <div class="toggle <?php if( _ppt(array('newsletter','enable')) == '1'){  ?>on<?php } ?>">
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
              <input type="hidden" id="enablenewsl" name="admin_values[newsletter][enable]" value="<?php echo _ppt(array('newsletter','enable')); ?>">
            </div>
          </div>
          <div class="row border-bottom pb-3 mb-3">
            <div class="col-md-8 ">
              <label class="font-weight-bold mb-2"><?php echo __("Use Built-in Newsletter System","premiumpress"); ?></label>
              <p class="text-muted"><?php echo __("Turn on/off the built-in newsletter system.","premiumpress"); ?></p>
            </div>
            <div class="col-md-2 mt-3 formrow">
              <div class="">
                <label class="radio off">
                <input type="radio" name="toggle" 
                     value="off" onchange="document.getElementById('newsdefault').value='0'">
                </label>
                <label class="radio on">
                <input type="radio" name="toggle"
                     value="on" onchange="document.getElementById('newsdefault').value='1'">
                </label>
                <div class="toggle <?php if( _ppt(array('newsletter','newsdefault')) == '1'){  ?>on<?php } ?>">
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
              <input type="hidden" id="newsdefault" name="admin_values[newsletter][newsdefault]" value="<?php if(_ppt(array('newsletter','newsdefault')) == ""){ echo 1; }else{ echo _ppt(array('newsletter','newsdefault')); } ?>">
            </div>
          </div>
          
          <div <?php if( _ppt(array('newsletter','newsdefault')) == 1 ){  ?>style="display:none;"<?php } ?>>
          
            <label class="font-weight-bold mb-2"><?php echo __("Custom Form Shortcode.","premiumpress"); ?></label>
            <p class="text-muted"><?php echo __("Here you can enter your own newsletter signup form shortcodes which will replace the default theme display.","premiumpress"); ?></p>
            <textarea class="form-control" style="height:300px !important;" name="admin_values[newsletter][customcode]"><?php echo _ppt(array('newsletter','customcode')); ?></textarea>
          </div>
          <?php if( _ppt(array('newsletter','newsdefault')) == 0 ){ ?>
             <div class="p-4 bg-light text-center mt-4">
            <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
          </div>
          <?php } ?>

          
          <div <?php if( _ppt(array('newsletter','newsdefault')) == 0 ){  ?>style="display:none;"<?php } ?>>
            <label class="txt500"><?php echo __("Email Subject","premiumpress"); ?></label>
            <input type="text" class="form-control"  name="admin_values[newsletter][confirmation_title]" value="<?php 
			 
			 if(stripslashes(_ppt(array('newsletter','confirmation_title'))) == ""){
			 
			 echo __("Please confirm your email!","premiumpress");
			 
			 }else{
			 
			 echo stripslashes(_ppt(array('newsletter','confirmation_title'))); 
			 
			 }
			 
			 ?>">
            <div class="mt-3 mb-3">
              <style>
				.wp-switch-editor, .tmce-active .switch-tmce, .html-active .switch-html { height:27px !important; }
				</style>
              <?php 
			 
			 
			 if(_ppt(array('newsletter','confirmation_message')) == ""){
			 
			 $mdata = __("Thank you for joining our mailing list.

Please click the link below to confirm your email address is valid:

(link)

Kind Regards

Management","premiumpress");

			 }else{
			 $mdata = _ppt(array('newsletter','confirmation_message'));
			 }
			 
			 
			 echo wp_editor( $mdata , 'ppt_email', array( 'textarea_name' => 'admin_values[newsletter][confirmation_message]', 'editor_height' => '200px', 'media_buttons' => FALSE ) );  ?>
           
            
            
            
            <p class="opacity-8 py-3 mt-3"><b><?php echo __("Remember","premiumpress"); ?></b> <?php echo __("Use the short code <code>(link)</code> within your email above where you want the confirmation link to display.","premiumpress"); ?></p>
             </div>
            
            
            
            
          <div class="row border-bottom border-top pt-4 pb-3 mb-3">
            <div class="col-md-6">
              <label class="font-weight-bold mb-2"><?php echo __("Thank You Page","premiumpress"); ?></label>
              <p class="text-muted"><?php echo __("This is the page users are sent to after they click the confirmation link within the email.","premiumpress"); ?></p>
            </div>
            <div class="col-md-6 mt-3">
      <input type="text"  class="form-control" name="admin_values[newsletter][thankyoupage]" placeholder="http://" value="<?php echo _ppt(array('newsletter','thankyoupage')); ?>">
            </div>
          </div>   
            
            
            
           <div class="row border-bottom  pb-3 mb-3">
            <div class="col-md-6">
              <label class="font-weight-bold mb-2"><?php echo __("Unsubscribe Page","premiumpress"); ?></label>
              <p class="text-muted"><?php echo __("This is the page users are sent to after they click the unsubscribe link within an email.","premiumpress"); ?></p>
            </div>
            <div class="col-md-6 mt-3">
    <input type="text"  class="form-control" name="admin_values[newsletter][unsubscribepage]" placeholder="http://" value="<?php echo _ppt(array('newsletter','unsubscribepage'));?>">
            </div>
          </div>             
            
            
            
             
          <div class="p-4 bg-light text-center mt-4">
            <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
          </div>



</div></div> </div> 
<?php _ppt_template('framework/admin/_form-wrap-bottom' );  ?>
