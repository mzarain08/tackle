<?php
/* =============================================================================
   USER ACTIONS
   ========================================================================== */
// CHECK THE PAGE IS NOT BEING LOADED DIRECTLY
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }

// SETUP GLOBALS
global $wpdb, $CORE, $CORE_ADMIN;
 
// LOAD IN MAIN DEFAULTS
if(function_exists('current_user_can') && current_user_can('administrator')){
   
  

}  
 

_ppt_template('framework/admin/header' ); 

_ppt_template('framework/admin/_form-top' ); ?>

 
<div class="tab-content <?php if(isset($_GET['defaultdesign'])){ ?>d-flex flex-column h-100<?php } ?>">
        
        
  <div class="tab-pane addjumplink active" 
        data-title="<?php echo __("Memberships","premiumpress"); ?>" 
        data-desc="<?php echo __("Here you can configure membership options.","premiumpress"); ?>"
        data-icon="fa-users-class" 
        id="overview" 
        role="tabpanel" aria-labelledby="overview-tab"> 
        
        <?php _ppt_template('framework/admin/parts/membership-overview' ); ?>
        
		 
        </div>     
        
    
        
        
        <div class="tab-pane addjumplink" 
        data-title="<?php echo __("Membership Comparison Table","premiumpress"); ?>" 
        data-desc="<?php echo __("Here you can compare features for each membership.","premiumpress"); ?>"
        data-icon="fa-chart-line" 
        id="t" 
        role="tabpanel" aria-labelledby="t-tab">
		 <?php _ppt_template('framework/admin/parts/membership-table' ); ?>
        
        </div>  
          
        
         <div class="tab-pane addjumplink" 
        data-title="<?php echo __("Default Memberships","premiumpress"); ?>" 
        data-desc="<?php echo __("Setup a default membership for new users.","premiumpress"); ?>"
        data-icon="fa-users-class" 
        id="d" 
        role="tabpanel" aria-labelledby="d-tab">
		 <?php _ppt_template('framework/admin/parts/membership-default' ); ?>
        </div>     
                       
         
        <div class="tab-pane addjumplink" 
        data-title="<?php echo __("Settings","premiumpress"); ?>" 
        data-desc="<?php echo __("Here you can manage your membership settings.","premiumpress"); ?>"
        data-icon="fa-cog" 
        id="s" 
        role="tabpanel" aria-labelledby="s-tab">
		 <?php _ppt_template('framework/admin/parts/membership-settings' ); ?>
        </div>     
        
	
 

</div>

<?php _ppt_template('framework/admin/_form-bottom' ); ?>
<?php  _ppt_template('framework/admin/footer' );  ?>
 
  