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
if(isset($_POST['newcomment']) && is_numeric($_POST['newcomment'])){

  		 
		// UPDATE
		if($_POST['newcomment'] == 1){
		
			$data = array(
					'comment_post_ID' 		=> $_POST['commentdata']['ratingpid'],
					'comment_author' 		=> $userdata->ID,
					'comment_author_email' 	=> 'admin@admin.com',
					'comment_author_url' 	=> 'http://',
					'comment_content' 		=> esc_html($_POST['comment']),
					'comment_type' 			=> '',
					'comment_parent' 		=> 0,
					'user_id' 				=> $_POST['commentdata']['feedback_from'],
					'comment_author_IP' 	=> "",
					'comment_agent' 		=> 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.10) Gecko/2009042316 Firefox/3.0.10 (.NET CLR 3.5.30729)',
					'comment_date' 			=> current_time('mysql'),
					'comment_approved' 		=> $_POST['status'],
				);
				 
				$commentid = wp_insert_comment($data);		
		
		}else{
			
			$commentid = $_POST['newcomment'];
			
			$data = array(
					'comment_ID' 		=> intval($_POST['newcomment']),
					'comment_post_ID' 	=> $_POST['commentdata']['ratingpid'],
					'comment_approved' 	=> $_POST['status'], 
					'comment_date' 		=> current_time('mysql'),
					'comment_content' 	=> $_POST['comment'],
					'user_id' 			=> $_POST['commentdata']['feedback_from'],
			);			
			$g = wp_update_comment($data);
			
			 
			
			$SQL = "UPDATE $wpdb->comments SET comment_content = '".strip_tags($_POST['comment'])."' WHERE comment_ID = ".$_POST['newcomment']." LIMIT 1";
			$wpdb->get_results($SQL,ARRAY_A);
			  
			
			update_comment_meta($commentid, 'user_id', $_POST['commentdata']['feedback_from']); 
		 
		
		} 
	 
		// CUSTOM FIELDS
		if(isset($_POST['commentdata']) && is_array($_POST['commentdata']) && !empty($_POST['commentdata']) ){
			foreach($_POST['commentdata'] as $kk => $vv){	
			
				if($_POST['newcomment'] == 1){
				 add_comment_meta($commentid, $kk, $vv); 
				}else{
				 update_comment_meta($commentid, $kk, $vv); 
				}				 
			}
		}
		
		// UPDATE LISTING RATING
		if(is_numeric($_POST['commentdata']['ratingpid'])){
		$CORE->PACKAGE("update_listing_rating", $_POST['commentdata']['ratingpid'] );	
		}
	 
		// LEAVE MESSAGE
		if($_POST['newcomment'] == 1){
		
			//header("location:".home_url()."wp-admin/admin.php?page=comments&eid=".$commentid."&done=1");
			//die();
		
		}
				


}

}
 

_ppt_template('framework/admin/header' ); 


?>
<div class="tab-content d-flex flex-column h-100">       
       
       <div class="tab-pane active addjumplink" 
        data-title="<?php echo __("Comments","premiumpress"); ?>" 
        data-icon="fa-comments" 
        id="overview" 
        role="tabpanel" aria-labelledby="overview-tab"> 
		<?php _ppt_template('framework/admin/parts/comments-overview' ); ?>        
        </div>
         
            
 		<div class="tab-pane addjumplink" 
        data-title="<?php echo __("Settings","premiumpress"); ?>" 
        data-desc="<?php echo __("Stop users from accessing website features until they verify their identify.","premiumpress"); ?>"
        data-icon="fa-rss" 
        id="s" 
        role="tabpanel" aria-labelledby="s-ads">
        <?php _ppt_template('framework/admin/_form-top' ); ?>
        <?php _ppt_template('framework/admin/parts/comments-settings' ); ?>
        <?php _ppt_template('framework/admin/_form-bottom' ); ?>           
        </div><!-- end design home tab -->       
        
    
        <div class="tab-pane addjumplink" 
        data-title="<?php echo __("Add New","premiumpress"); ?>" 
        data-icon="fa-plus" 
        id="add" 
        role="tabpanel" aria-labelledby="add-tab">    
		<?php _ppt_template('framework/admin/parts/comments-add' ); ?> 
        
        </div> 
         
        <div class="tab-pane addjumplink" 
        data-title="<?php echo __("Manage Comments","premiumpress"); ?>" 
        data-icon="fa-comments" 
        id="m" 
        role="tabpanel" aria-labelledby="m-tab">  
         <?php _ppt_template('framework/admin/parts/comments-table' ); ?> 
         </div>      
     

</div>
 
   
<?php  _ppt_template('framework/admin/footer' );  ?>