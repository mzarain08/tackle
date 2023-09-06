<?php
   /* 
   * Theme: PREMIUMPRESS CORE FRAMEWORK FILE
   * Url: www.premiumpress.com
   * Author: Mark Fail
   *
   * THIS FILE WILL BE UPDATED WITH EVERY UPDATE
   * IF YOU WANT TO MODIFY THIS FILE, CREATE A CHILD THEME
   *
   * http://codex.wordpress.org/Child_Themes
   */
   if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
   
   global $CORE, $userdata, $STRING;
   
   $currentimg = get_user_meta($userdata->ID, "ppt_verifyfile", true);


?> 
 
    <div class="text-center">
    
        
      <i class="fal fa-address-card fa-8x mb-4 text-primary"></i>
      <div class="fs-md text-600 mb-2"><?php echo __("Please verify your identity.","premiumpress"); ?></div>
      <p class="lead mb-0"> <?php echo __("Please upload a CNIC, Passport Photo, NIN or SSN Photo.","premiumpress"); ?> </p>
     	
        
        <div style="max-width:500px; margin:auto auto;">
      <?php if(is_array($currentimg) && !empty($currentimg)){ ?>
      <div class="my-4 alert alert-success"><i class="fa fa-check mr-2"></i><?php echo __("Thank You. We will email you when the checks are complete.","premiumpress"); ?></div>
      <?php }else{ ?>
      
  
        <form action="" method="post" id="userdetailsform" enctype="multipart/form-data">
       <div class="bg-light my-4 col-lg-8 border p-3 mx-auto">
    
  		 <input type="hidden" name="action" value="upload_user_verify_photo" />
         <input type="file" name="ppt_verifyfile" tabindex="12" />
        
         </div>
         <button type="submit" data-ppt-btn class="btn-primary btn-lg shadow-sm mx-auto" style="max-width:200px;"><?php echo __("Upload","premiumpress"); ?></button>
          </form>
       <?php } ?>
      
      <?php if(is_array($currentimg) && !empty($currentimg)){ ?>
      <div class="col-lg-8 mx-auto">
        <a href="javascript:void(0);" onclick="delete_verifyfile();" data-ppt-btn class="btn-light btn-lg btn-block mt-1"><i class="fa fa-trash mr-2"></i><?php echo __("Choose New File","premiumpress"); ?></a>
      </div>
      <?php } ?>
      
      
      </div>
      
    </div>
 
 
 
<script>
function delete_verifyfile(){
 										   
 	
jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',	
		dataType: 'json',	
		data: {
            action: "delete_verifyfile",
			 		
        },
        success: function(response) {
 
			if(response.status == "ok"){
			
			window.location.href='<?php echo _ppt(array('links','myaccount')); ?>';
			 			 
  		 	
			}else{			
		 			
			}			
        },
        error: function(e) {
            console.log(e)
        }
    });	
 		
}
</script>