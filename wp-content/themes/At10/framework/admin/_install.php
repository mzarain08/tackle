<?php
// CHECK THE PAGE IS NOT BEING LOADED DIRECTLY
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
// SETUP GLOBALS
global $wpdb, $CORE, $CORE_ADMIN, $userdata;
// LOAD IN MAIN DEFAULTS
$core_admin_values = get_option("core_admin_values"); $license = get_option('ppt_license_key');
// UPGRADE SYSTEM
if(isset($_POST['adminArray']['ppt_license_email'])){
	update_option("ppt_license_upgrade",""); // CLEAR
}

// END 9.1.6 UPDATE

if($license == ""){
 
 ?> 
 
<style>
#wpcontent { padding-left:0px; }
.update-nag, #wpfooter { display:none; }
 
</style> 
 
<div class="col-lg-8 col-xl-7 mx-auto mt-5">
<?php _ppt_template('framework/admin/blocks/login' ); ?>
</div>

<form method="post" id="newinstallform">
<input type="hidden" name="submitted" value="yes" />

<?php if(get_option("ppt_reinstall") != ""){ ?>
<input type="hidden" name="reinstall" value="yes" />
<?php }else{ ?>
<input type="hidden" name="firstimeinstall" value="yes" /> 
<?php } ?>

<input type="hidden" name="adminArray[ppt_license_key]" id="licensekeyf" value="" /> 
<input type="hidden" name="admin_values[template]" id="templatef" value="" /> 
 
</form> 

<?php } ?>