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
if(isset($_POST['disputeid']) && is_numeric($_POST['disputeid'])){
 		 
		
		// ADD SYSTEM TRANSACTION				
		$my_post = array();				
		$my_post['post_title'] 		= " #".$_POST['disputeid']; 
		$my_post['post_type'] 		= "ppt_dispute"; 
		$my_post['post_status'] 	= "publish";
		$my_post['post_content'] 	= ""; //$_POST['news_message']; 
		
		// UPDATE
		if($_POST['disputeid'] == 0){		
			$newid = wp_insert_post( $my_post );		 
		}else{			
			$my_post['ID'] 	= $_POST['disputeid'];			
			$newid = wp_update_post( $my_post ); 
			$newid = $_POST['disputeid'];  
		} 
		 

		// CUSTOM FIELDS
		if(isset($_POST['dispute']) && is_array($_POST['dispute']) && !empty($_POST['dispute']) ){
			foreach($_POST['dispute'] as $kk => $vv){
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
        data-title="<?php echo __("All Disputes","premiumpress"); ?>" 
        data-icon="fa-receipt" 
        id="orders" 
        role="tabpanel" aria-labelledby="orders-tab">
        
        
         <?php _ppt_template('framework/admin/parts/disputes-table' ); ?>
    
         </div>        
        
        
        <div class="tab-pane addjumplink" 
        data-title="<?php echo __("Add New","premiumpress"); ?>" 
        data-icon="fa-plus" 
        id="add" 
        role="tabpanel" aria-labelledby="add-tab">            

		<?php _ppt_template('framework/admin/parts/disputes-add' ); ?>
        
        
        </div>
         
     

</div>
 
   
<?php  _ppt_template('framework/admin/footer' );  ?>