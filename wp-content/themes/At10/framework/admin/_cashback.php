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



// COUPON CODE SETTINGS
if(isset($_POST['neworder']) && is_numeric($_POST['neworder'])){
 
		// ADD SYSTEM TRANSACTION				
		$my_post = array();				
		$my_post['post_title'] 		= "Cashback #".$_POST['neworder']; 
		$my_post['post_type'] 		= "ppt_cashback"; 
		$my_post['post_status'] 	= "publish";
		$my_post['post_content'] 	= ""; 
		
		// UPDATE
		if($_POST['neworder'] == 1){
		
			$payment_id = wp_insert_post( $my_post );
		 
		}else{
		
			$my_post['ID'] 	= $_POST['neworder'];
			$payment_id = $_POST['neworder'];
			wp_update_post( $my_post );
			
			
			// CHECK IF OLD TYPE WAS 
			// REMOVE AMOUNT FROM USER ACCOUNT
		 
			if($_POST['order']['cashback_status'] == "4" && isset($_POST['commission']) && $_POST['commission'] > 0 && get_post_meta($payment_id,'cashback_paid', true) == "" ){
			
				$c = get_user_meta($_POST['order']['cashback_userid'],'ppt_usercredit', true);
				if(!is_numeric($c)){ $c = 0; }
				
				$c1  = $c + $_POST['commission'];
				update_user_meta($_POST['order']['cashback_userid'],'ppt_usercredit', $c1);
				update_post_meta($payment_id,'cashback_total', $_POST['commission']);
				
				update_post_meta($payment_id,'cashback_paid', date('Y-m-d H:i:s'));
			
			} 
		
		}
			
		
		if(isset($_FILES['ppt_verifyfile'])){
		 
				
				// LOAD IN WORDPRESS FILE UPLOAOD CLASSES
				$dir_path = str_replace("wp-content","",WP_CONTENT_DIR);
				if(!function_exists('get_file_description')){
				if(!defined('ABSPATH')){
				require $dir_path . "/wp-load.php";
				}
				require $dir_path . "/wp-admin/includes/file.php";
				require $dir_path . "/wp-admin/includes/media.php";	
				}
				if(!function_exists('wp_generate_attachment_metadata') ){
				require $dir_path . "/wp-admin/includes/image.php";
				}				 
				
				// GET WORDPRESS UPLOAD DATA
				$uploads = wp_upload_dir();
				
				// UPLOAD FILE 
				$file_array = array(
					'name' 		=> $_FILES['ppt_verifyfile']['name'], //$userdata->ID."_userphoto",//
					'type'		=> $_FILES['ppt_verifyfile']['type'],
					'tmp_name'	=> $_FILES['ppt_verifyfile']['tmp_name'],
					'error'		=> $_FILES['ppt_verifyfile']['error'],
					'size'		=> $_FILES['ppt_verifyfile']['size'],
				);
				
				$uploaded_file = wp_handle_upload( $file_array, array( 'test_form' => FALSE ));	  
				// CHECK FOR ERRORS
				if(isset($uploaded_file['error']) ){		
					$GLOBALS['error_message'] = $uploaded_file['error'];
				}else{
				
				// set up the array of arguments for "wp_insert_post();"
				$attachment = array(			 
					'post_mime_type' => $_FILES['ppt_verifyfile']['type'],
					'post_title' => $_FILES['ppt_verifyfile']['name'],
					'post_content' => '',
					'post_author' => $userdata->ID,
					'post_status' => 'inherit',
					'post_type' => 'attachment',
					'post_parent' => 0,
					'guid' => $uploaded_file['url']
				);									
				
				// insert the attachment post type and get the ID
				$attachment_id = wp_insert_post( $attachment );
		
				// generate the attachment metadata
				$attach_data = wp_generate_attachment_metadata( $attachment_id, $uploaded_file['file'] );
				 
				// update the attachment metadata
				$rr = wp_update_attachment_metadata( $attachment_id,  $attach_data );
				
				if(isset($attach_data['sizes']['thumbnail']['file'])){
					$thumbnail = $uploads['url']."/".$attach_data['sizes']['thumbnail']['file'];
				}else{
					$thumbnail = $uploaded_file['url'];
				}	
				
				$data = array('img' =>$thumbnail, 'path' => $uploaded_file['file'], "aid" => $attachment_id,  "name" => $attachment['post_title'] );	
			 	 
				
				// NOW LETS SAVE THE NEW ONE	
				update_post_meta($payment_id, "cashback_file", $data );
			 	
				}
 
		}
		
		
	 	

		// CUSTOM FIELDS
		if(isset($_POST['order']) && is_array($_POST['order']) && !empty($_POST['order']) ){
			foreach($_POST['order'] as $kk => $vv){
				 update_post_meta($payment_id, $kk, $vv);
			}
		} 
		 		


}

}
 

_ppt_template('framework/admin/header' ); 


?>
<div class="tab-content d-flex flex-column h-100">
       
        <div class="tab-pane <?php  if(isset($_GET['eid']) && is_numeric($_GET['eid']) || isset($_GET['addnew']) ){ }else{ ?>active<?php } ?> addjumplink" 
        data-title="All Requests" 
        data-icon="fa-receipt" 
        id="orders" 
        role="tabpanel" aria-labelledby="orders-tab">
        
        
         <?php _ppt_template('framework/admin/parts/cashback-table' ); ?>
    
         </div>        
        
        
        <div class="tab-pane <?php if(isset($_GET['eid']) && is_numeric($_GET['eid']) || isset($_GET['addnew']) ){?>active<?php } ?> addjumplink" 
        data-title="Add New" 
        data-icon="fa-plus" 
        id="add" 
        role="tabpanel" aria-labelledby="add-tab">            

		<?php _ppt_template('framework/admin/parts/cashback-add' ); ?>
        
        
        </div>
        
       <div class="tab-pane addjumplink" 
        data-title="<?php echo __("Settings","premiumpress"); ?>" 
        data-icon="fa-cog" 
        id="settings" 
        role="tabpanel" aria-labelledby="settings-tab">            
		<?php _ppt_template('framework/admin/_form-top' );  ?>
		<?php _ppt_template('framework/admin/parts/cashback-settings' ); ?>
        <?php _ppt_template('framework/admin/_form-bottom' );  ?> 
        
        </div>
     

</div>
 
   
<?php  _ppt_template('framework/admin/footer' );  ?>