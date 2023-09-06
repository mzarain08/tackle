<?php
// CHECK THE PAGE IS NOT BEING LOADED DIRECTLY
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
// SETUP GLOBALS
 
// LOAD IN MAIN DEFAULTS
if(function_exists('current_user_can') && current_user_can('administrator')){


	// COUPON CODE SETTINGS
	if(isset($_POST['newcampaign']) && is_numeric($_POST['newcampaign'])){
	 
			// ADD SYSTEM TRANSACTION				
			$my_post = array();				
			$my_post['post_title'] 		= "Campaign #".$_POST['newcampaign']; 
			$my_post['post_type'] 		= "ppt_campaign"; 
			$my_post['post_status'] 	= "publish";
			$my_post['post_content'] 	= ""; 			
			
			// UPDATE
			if($_POST['newcampaign'] == 1){
			
				$payment_id = wp_insert_post( $my_post );
			 
				// LEAVE MESSAGE
				$GLOBALS['ppt_error'] = array(
					"type" 		=> "success",
					"title" 	=> __("New Campaign Added","premiumpress"),
					"message"	=> __("You've successfully added a new campaign.","premiumpress"),
				); 
				
			}else{
			
				$my_post['ID'] 	= $_POST['newcampaign'];
				$payment_id = $_POST['newcampaign'];
				wp_update_post( $my_post );
			  	
				
				// LEAVE MESSAGE
				$GLOBALS['ppt_error'] = array(
					"type" 		=> "success",
					"title" 	=> __("Campaign Updated","premiumpress"),
					"message"	=> __("Your campaign changes have been saved.","premiumpress"),
				); 
			
			} 
	
			// CUSTOM FIELDS
			if(isset($_POST['campaign']) && is_array($_POST['campaign']) && !empty($_POST['campaign']) ){
				foreach($_POST['campaign'] as $kk => $vv){
					 update_post_meta($payment_id, $kk, $vv);
				}
			} 
			
			$_GET['eid'] = $payment_id;
			 
	 
	}

}



_ppt_template('framework/admin/header' ); 

?>
       
<div class="tab-content d-flex flex-column h-100">


     <div class="tab-pane active addjumplink" 
        data-title="<?php echo __("Overview","premiumpress"); ?>" 
        data-icon="fa-bullhorn" 
        id="overview" 
        role="tabpanel" aria-labelledby="overview-tab"> 
        <?php _ppt_template('framework/admin/parts/advertising-overview' ); ?> 
           
        </div><!-- end design home tab -->


    
 
       
        <div class="tab-pane addjumplink" 
        data-title="<?php echo __("Advertising Slots","premiumpress"); ?>" 
        data-desc="<?php echo __("Manage default banner spaces on your website.","premiumpress"); ?>" 
        data-icon="fa-ad" 
        id="s" 
        role="tabpanel" aria-labelledby="s-tab">
        <?php _ppt_template('framework/admin/_form-top' ); ?>
        <?php _ppt_template('framework/admin/parts/advertising-sellspace' ); ?>
        <?php _ppt_template('framework/admin/_form-bottom' ); ?>
           
        </div><!-- end design home tab -->


     
    <div class="tab-pane addjumplink" 
        data-title="<?php echo __("Quick Setup","premiumpress"); ?>"
        data-desc=""  
        data-icon="fa-copy" 
        id="q" 
        role="tabpanel" aria-labelledby="q-tab">
        <?php _ppt_template('framework/admin/_form-top' ); ?>
        <?php _ppt_template('framework/admin/parts/advertising-quick' ); ?>
           <?php _ppt_template('framework/admin/_form-bottom' ); ?>        
        </div><!-- end design home tab --> 


    <div class="tab-pane addjumplink" 
        data-title="<?php echo __("Manage Campaigns","premiumpress"); ?>"
        data-desc="<?php echo __("Manage existing advertising campaigns.","premiumpress"); ?>"  
        data-icon="fa-project-diagram" 
        id="c" 
        role="tabpanel" aria-labelledby="c-tab">
        
        <?php _ppt_template('framework/admin/parts/advertising-table' ); ?>
                   
        </div><!-- end design home tab --> 
        
        
    <div class="tab-pane addjumplink" 
        data-title="<?php echo __("Add Campaigns","premiumpress"); ?>"
        data-desc=""  
        data-icon="fa-project-diagram" 
        id="add" 
        role="tabpanel" aria-labelledby="add-tab">
        
        <?php _ppt_template('framework/admin/parts/advertising-add' ); ?>
                   
        </div><!-- end design home tab --> 

        <div class="tab-pane addjumplink" 
        data-title="<?php echo __("Manage Banners","premiumpress"); ?>" 
        data-desc="<?php echo __("Manage admin and user uploaded banner ads.","premiumpress"); ?>" 
        data-icon="fa-clone" 
        id="b" 
        role="tabpanel" aria-labelledby="b-tab">
        
        <?php _ppt_template('framework/admin/parts/advertising-table-banners' ); ?>
        
           
        </div><!-- end design home tab -->
        
        
   
     

</div>  


   



		<div id="UpdateModal" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document"><div class="modal-content">
					  <div class="modal-header">                
						<h6><?php echo __("Upload Banner","premiumpress"); ?></h6>
					  </div>
                          <form action="" method="post" class="p-3 bg-light" enctype="multipart/form-data"  id="bupload">
                 
                 <input type="hidden" name="lefttab" value="banners-tab" />
                 
                        					             
					  <div class="modal-body">                      
					     <input type="hidden" name="action" value="sellspace" />
                  <input type="file" name="ppt_banner[]"  />
                     
					  </div>
                       <div class="modal-footer"> 
                       <button type="submit" class="btn btn-success rounded-0"><?php echo __("Upload Banner","premiumpress"); ?></button>   
               </div>
                  
                      </form>
                      
</div></div></div> 
<?php

_ppt_template('framework/admin/footer' ); 

?>