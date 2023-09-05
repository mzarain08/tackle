<?php
/* =============================================================================
   USER ACTIONS
   ========================================================================== */
// CHECK THE PAGE IS NOT BEING LOADED DIRECTLY
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }

// SETUP GLOBALS
global $wpdb, $CORE, $userdata, $CORE_ADMIN;
 
 
// LOAD IN MAIN DEFAULTS
if(function_exists('current_user_can') && current_user_can('administrator')){
 
}
 

_ppt_template('framework/admin/header' ); 


?>
<div class="tab-content d-flex flex-column h-100">
       
        <div class="tab-pane active addjumplink" 
        data-title="<?php echo __("Pay Wall","premiumpress"); ?>" 
        data-icon="fa-shoe-prints" 
        id="orders" 
        role="tabpanel" aria-labelledby="orders-tab">
        
      	 <?php _ppt_template('framework/admin/_form-top' );  ?>
       	 <?php _ppt_template('framework/admin/parts/paywall' ); ?>
         <?php _ppt_template('framework/admin/_form-bottom' );  ?>
          
         </div>        
         
     

</div>
 
   
<?php  _ppt_template('framework/admin/footer' );  ?>