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


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$settings = array(
"title" => __("Email Settings","premiumpress"),
"desc" => __("These details are applied to all emails sent from this website.","premiumpress"), 
"back" => "overview"
);

_ppt_template('framework/admin/_form-wrap-top' ); 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
?>

 
    <div class="card card-admin">
      <div class="card-body">


       <div class="row">
          <div class="form-group col-6">
            <label class="txt500"><?php echo __("Email From","premiumpress"); ?></label>
            <input type="text"  name="adminArray[admin_email]" class="form-control"  value="<?php echo get_option('admin_email'); ?>">
            <div class="small text-muted mt-3"><?php echo __("This is the email address that will show up on emails sent from this website.","premiumpress"); ?> </div>
          </div>
          <div class="form-group col-6">
            <label class="txt500"><?php echo __("From Name","premiumpress"); ?></label>
            <input type="text"  name="adminArray[emailfrom]" class="form-control"  value="<?php echo get_option('emailfrom'); ?>">
            <div class="small text-muted mt-3"><?php echo __("The name that appears on emails sent from this website.","premiumpress"); ?></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-4 pr-lg-4">
    <h3 class="mt-4"><?php echo __("Welcome Inbox Message","premiumpress"); ?></h3>
    <p class="text-muted lead"> <?php echo __("This is the default inbox message the user will recieve when they join your website.","premiumpress"); ?> </p>
  </div>
  <div class="col-md-8">
    <div class="card card-admin">
      <div class="card-body">
        <div class="row py-2">
          <div class="col-md-12">
           
          <label class="txt500"><?php echo __("Welcome Message","premiumpress"); ?></label>
            <?php


$welcomemsg = stripslashes(get_option('ppt_email_inboxwelcome'));
 
?><textarea name="adminArray[ppt_email_inboxwelcome]" class="form-control w-100" style="min-height:150px !important;"><?php echo $welcomemsg; ?></textarea>
          
          <?php /*
         <div class="col-md-6 px-0 mt-3">
            <label class="txt500"><?php echo __("Admin Display Name","premiumpress"); ?></label>
            <input type="text"  name="adminArray[admin_email_default_name]" class="form-control"  value="<?php echo get_option('admin_email_default_name'); ?>">
            <div class="small text-muted mt-3 mb-3"><?php echo __("This is the name that shows up instead of the admin account name.","premiumpress"); ?> </div>
          </div>
		  */ ?>
          
          </div>
        </div>
        <!-- end row -->
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-4 pr-lg-4">
    <h3 class="mt-4"><?php echo __("Email Header/Footer","premiumpress"); ?></h3>
    <p class="text-muted lead"> <?php echo __("These details are applied to the header/footer for all emails sent from this website.","premiumpress"); ?> </p>
  </div>
  <div class="col-md-8">
    <div class="card card-admin">
      <div class="card-body">
        <div class="row py-2">
          <div class="col-md-12">
            <label class="txt500"><?php echo __("Email Header","premiumpress"); ?> </label>
            <hr />
            <?php echo wp_editor( stripslashes(get_option('ppt_email_header')), 'ppt_email_header2', array( 'textarea_name' => 'adminArray[ppt_email_header]', 'editor_height' => '200px',  'media_buttons' => FALSE ) );  ?> </div>
        </div>
        <!-- end row -->
        <div class="row py-2">
          <hr />
          <div class="col-md-12">
            <label class="txt500"><?php echo __("Email Footer","premiumpress"); ?></label>
            <hr />
            <?php

$ef = get_option('ppt_email_footer');
if($ef == ""){
$ef = '<br><br>Kind Regards<br>Management.<br><br>(website)';
}


 echo wp_editor( stripslashes($ef), 'ppt_email_footer', array( 'textarea_name' => 'adminArray[ppt_email_footer]', 'editor_height' => '200px', 'media_buttons' => FALSE ) );  ?>
          </div>
        </div>
      
      
      
        <div class="p-4 bg-light text-center mt-4">
          <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
        </div>

</div></div> 
<?php _ppt_template('framework/admin/_form-wrap-bottom' );  ?>