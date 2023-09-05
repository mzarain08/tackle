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
      <i class="fal fa-envelope fa-8x mb-4 text-primary"></i>
      <h4><?php echo __("Please verify your email address.","premiumpress"); ?></h4>
      <p class="lead mb-0"> <?php echo __("We have sent a verification link to the email below;","premiumpress"); ?> </p>
     <div style="max-width:700px; margin:auto auto;">
      <div class="bg-light my-4 col-lg-8 border p-3 mx-auto">
        <?php echo $CORE->USER("get_email", $userdata->ID ); ?>
      </div>
       
        <a href="javascript:void(0);" onclick="resendVemail();" data-ppt-btn class="btn-primary btn-lg text-600 mt-1"><?php echo __("resend email","premiumpress"); ?></a>
      </div>
    </div>
 
<script>
function resendVemail(){

	jQuery.ajax({
            type: "POST",
			dataType: 'json',	
            url: '<?php echo home_url(); ?>/',		
         	data: {
                    action: "resendvemail",
         			uid: <?php echo $userdata->ID; ?>, 
              },
              success: function(response) {
         		   
				 
         			if(response.status == "sent"){ 
         			 
					alert("<?php echo __("Email Sent!","premiumpress"); ?>");
					}	
					
							
              },
              error: function(e) {
                     alert("error "+e)
               }
	});	 
}
 
	jQuery(document).ready(function(){ 
		
		jQuery("#account_sidebar .btn-dark.viewp").hide();
		jQuery("#jumplinks li").hide();
		
		jQuery(".dashboard-usertop .dropdown-menu").hide();
		jQuery(".dashboard-usertop .caret").hide();
		 
	});
</script>