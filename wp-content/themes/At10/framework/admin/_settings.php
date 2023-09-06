<?php
// CHECK THE PAGE IS NOT BEING LOADED DIRECTLY
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
// SETUP GLOBALS
global $wpdb, $CORE, $userdata, $CORE_ADMIN;
 
if( current_user_can('administrator') ){
  

if(isset($_GET['resetlang'])){

update_option("ppt_translations", "");
	 
}
	 
	if(isset($_POST['cfield'])){
	
	
	  update_option("cfields", $_POST['cfield']);
	 
	}
	 

}
 

_ppt_template('framework/admin/header' ); 

_ppt_template('framework/admin/_form-top' ); ?>
<?php _ppt_template('framework/admin/parts/settings-list' ); ?>
<?php _ppt_template('framework/admin/_form-bottom' ); ?>

<div id="UpdateModal" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6><?php echo __("Website Reset","premiumpress"); ?></h6>
      </div>
      <div class="modal-body">
        <p style="font-weight:bold;"><?php echo __("Would you like to reset your website to the default factory settings?","premiumpress"); ?></p>
        <p style="font-size:11px;"><?php echo __("Warning - resetting your website will delete all of your existing listing and admin changes.","premiumpress"); ?></p>
      </div>
      <?php if(function_exists('current_user_can') && current_user_can('administrator')){ ?>
      <form method="post" action="">
        <input type="hidden" name="submitted" value="yes" />
        <input type="hidden" name="core_system_reset" id="core_system_reset" value="new" />
        <div class="modal-footer">
          <a class="btn" data-dismiss="modal" aria-hidden="true">No Thanks!</a>
          <button type="submit" class="btn btn-primary">Yes, Reset Now</button>
        </div>
      </form>
      <?php }else{ ?>
      <div class="font-weight-bold p-3 bg-light">
        Disabled in demo mode
      </div>
      <?php } ?>
    </div>
  </div>
</div>
<div id="ajax_payment_test">
</div>
<?php
_ppt_template('framework/admin/footer' ); 
?>