<?php
/* =============================================================================
   USER ACTIONS
   ========================================================================== */
// CHECK THE PAGE IS NOT BEING LOADED DIRECTLY
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }

// SETUP GLOBALS
global $wpdb, $CORE, $settings;


wp_enqueue_script( 'jquery-ui-sortable' );
wp_enqueue_script( 'jquery-ui-draggable' );
wp_enqueue_script( 'jquery-ui-droppable' );


if( current_user_can('administrator') ){

	if(isset($_POST['resetlogs'])){
		update_option('ppt_search_data', "");
	}

 	
	
} 
 
_ppt_template('framework/admin/header' ); 
_ppt_template('framework/admin/_form-top' );

?>
<div class="tab-content d-flex flex-column h-100">
       
      
       
	<div class="tab-pane addjumplink active" 
        data-title="<?php echo __("Search","premiumpress"); ?>" 
        data-desc=""
        data-icon="fa-search" 
        id="overview" 
        role="tabpanel" aria-labelledby="overview-tab">
    	<?php _ppt_template('framework/admin/parts/search-overview' ); ?>     
        </div>   
 
        
	<div class="tab-pane addjumplink" 
        data-title="<?php echo __("Country/City Search","premiumpress"); ?>" 
        data-desc="<?php echo __("Here you can manage country and city search data.","premiumpress"); ?>"
        data-icon="fa-map-marker" 
        id="c" 
        role="tabpanel" aria-labelledby="c-tab">
  		<?php _ppt_template('framework/admin/parts/search-location' ); ?> 
        </div>  
        
        
        
  <div class="tab-pane addjumplink" 
        data-title="<?php echo __("Search Analytics","premiumpress"); ?>" 
        data-desc=""
        data-icon="fa-chart-line" 
        id="a" 
        role="tabpanel" aria-labelledby="a-tab">
		 <?php _ppt_template('framework/admin/parts/search-analytics' ); ?>  
        </div> 
        
        
  <div class="tab-pane addjumplink" 
        data-title="<?php echo __("IP Targeting","premiumpress"); ?>" 
        data-desc="<?php echo __("Detect the user IP addresses to display localized content.","premiumpress")."<br><br><br><span class='badge badge-success'>Beta Test</span> This section is currently under beta testing. More options to come in future updates."; ?>"
        data-icon="fa-map-marker" 
        id="ip" 
        role="tabpanel" aria-labelledby="ip-tab">
		 <?php _ppt_template('framework/admin/parts/search-geo' ); ?>  
        </div> 
        
        
  <div class="tab-pane addjumplink" 
        data-title="<?php echo __("Homepage Search","premiumpress"); ?>" 
        data-desc=""
        data-icon="fa-chart-line" 
        id="h" 
        role="tabpanel" aria-labelledby="h-tab">
		 <?php _ppt_template('framework/admin/parts/search-homepage' ); ?>  
        </div> 
        
         <?php /*
	<div class="tab-pane addjumplink" 
        data-title="<?php echo __("Search Settings","premiumpress"); ?>" 
        data-desc="<?php echo __("Additional search settings for your website.","premiumpress"); ?>"
        data-icon="fa-cog" 
        id="s" 
        role="tabpanel" aria-labelledby="s-tab">
   
  <?php _ppt_template('framework/admin/parts/search-settings' ); ?>  
 
        </div>  
		*/ ?>
 
 
</div> 
  
<?php _ppt_template('framework/admin/_form-bottom' ); _ppt_template('framework/admin/footer' );  ?>