<?php
/* =============================================================================
   USER ACTIONS
   ========================================================================== */
// CHECK THE PAGE IS NOT BEING LOADED DIRECTLY
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }

// SETUP GLOBALS
global $wpdb, $CORE, $settings;

 
 
_ppt_template('framework/admin/header' ); 

_ppt_template('framework/admin/_form-top' ); 
?>
 
<div class="tab-content d-flex flex-column h-100">
        
        
	<div class="tab-pane addjumplink active" 
        data-title="<?php echo __("SEO","premiumpress"); ?>" 
        data-desc=""
        data-icon="fa-globe" 
        id="overview" 
        role="tabpanel" aria-labelledby="overview-tab">
    <?php _ppt_template('framework/admin/parts/settings-seo' ); ?>     
        </div>    
        
     
</div>
<?php  _ppt_template('framework/admin/footer' );  ?>