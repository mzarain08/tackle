<?php
// CHECK THE PAGE IS NOT BEING LOADED DIRECTLY
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
// SETUP GLOBALS
global $wpdb, $CORE, $userdata, $CORE_ADMIN;

_ppt_template('framework/admin/header' ); 

?>

<div class="bg-white p-4">

<a href="admin.php?page=premiumpress" class="btn btn-system mb-4"><?php echo __("go back","premiumpress"); ?></a>

<?php _ppt_template( 'account/account-messages' ); ?>
</div>

<script>
jQuery(document).ready(function() {

	jQuery('#sidebar').toggleClass('active');
	
	ajax_load_chat_list();

});
</script>
<?php

_ppt_template('framework/admin/footer' ); 

?>