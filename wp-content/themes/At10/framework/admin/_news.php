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
 

// COUPON CODE SETTINGS
if(isset($_POST['popupid']) && is_numeric($_POST['popupid'])){

  		 
		
		// ADD SYSTEM TRANSACTION				
		$my_post = array();				
		$my_post['post_title'] 		= " #".$_POST['popupid']; 
		$my_post['post_type'] 		= "ppt_news"; 
		$my_post['post_status'] 	= "publish";
		$my_post['post_content'] 	= ""; //$_POST['news_message']; 
		
		// UPDATE
		if($_POST['popupid'] == 0){		
			$newid = wp_insert_post( $my_post );		 
		}else{			
			$my_post['ID'] 	= $_POST['popupid'];			
			wp_update_post( $my_post ); 
			$newid = $_POST['popupid'];  
		} 

		// CUSTOM FIELDS
		if(isset($_POST['popup']) && is_array($_POST['popup']) && !empty($_POST['popup']) ){
			foreach($_POST['popup'] as $kk => $vv){
				 update_post_meta($newid, $kk, $vv);
			}
		} 				
		
		// LEAVE MESSAGE
		$GLOBALS['ppt_error'] = array(
			"type" 		=> "success",
			"title" 	=> __("Setting Updated","premiumpress"),
			"message"	=> __("Your settings have been saved.","premiumpress"),
		);
}

}
 

_ppt_template('framework/admin/header' ); 


?>
<div class="tab-content d-flex flex-column h-100">
       
       
       <div class="tab-pane active addjumplink" 
        data-title="<?php echo __("Popup Ads","premiumpress"); ?>" 
        data-icon="fa-comment-alt-lines" 
        id="overview" 
        role="tabpanel" aria-labelledby="overview-tab">            

		<?php _ppt_template('framework/admin/parts/news-overview' ); ?>
        
        
        </div>
         
            
 		<div class="tab-pane addjumplink" 
        data-title="<?php echo __("Settings","premiumpress"); ?>" 
        data-desc="<?php echo __("Stop users from accessing website features until they verify their identify.","premiumpress"); ?>"
        data-icon="fa-rss" 
        id="s" 
        role="tabpanel" aria-labelledby="s-ads">
        <?php _ppt_template('framework/admin/_form-top' ); ?>
        <?php _ppt_template('framework/admin/parts/news-settings' ); ?>
        <?php _ppt_template('framework/admin/_form-bottom' ); ?>           
        </div><!-- end design home tab -->       
        
    
        <div class="tab-pane addjumplink" 
        data-title="<?php echo __("Add New","premiumpress"); ?>" 
        data-icon="fa-plus" 
        id="add" 
        role="tabpanel" aria-labelledby="add-tab">    
		<?php _ppt_template('framework/admin/parts/news-add' ); ?> 
        
        </div> 
         
        <div class="tab-pane addjumplink" 
        data-title="<?php echo __("Manage","premiumpress"); ?>" 
        data-icon="fa-rss" 
        id="m" 
        role="tabpanel" aria-labelledby="m-tab">  
         <?php _ppt_template('framework/admin/parts/news-table' ); ?> 
         </div>      
     

</div>
 
   
<?php  _ppt_template('framework/admin/footer' );  ?>