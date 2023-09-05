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

global $CORE, $userdata, $post; 


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
?> 


<div class="container my-sm-4">
  <div class="row">
  
  
    <?php if( isset($GLOBALS['error_message']) ){ ?>
    <div class="col-12 mb-2 px-md-4">
      <div class="alert alert-success alert-dismissible fade show text-600">
        <?php echo $GLOBALS['error_message']; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
    </div>
    <?php } ?>
    <?php if(strlen(get_user_meta($userdata->ID,'ppt_customtext', true)) > 1){  ?>
    <div class="col-12 mb-2  px-md-4">
      <div class="alert alert-success">
      <div class="small font-weight-bold opacity-5 mb-2"><?php echo __("Account Notice","premiumpress"); ?></div>
      <div class="font-weight-bold"><?php echo get_user_meta($userdata->ID,'ppt_customtext', true); ?></div>
       
      </div>
    </div>
<?php }

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 

if(isset($ev['enable']) && $ev['enable'] == 1 &&  _ppt(array('register','forcemailverify'))  == '1' && !$CORE->USER("get_verified", $userdata->ID) ){  ?>
    <div class="col-12 mb-2">
      <div class="alert alert-danger">
        <a href="javascript:void(0);" onclick="resendVemail();" data-ppt-btn class="btn-danger float-right mt-1"><?php echo __("resend email","premiumpress"); ?></a>
        <div class="font-weight-bold mb-2">
          <?php echo __("Please verify your email address.","premiumpress"); ?>
        </div>
        <p class="mb-0 small"> <?php echo __("If you have not received the email, please check your account email settings and use the resend button to try again.","premiumpress"); ?> </p>
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
</script>
    <?php } 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>

<div class="col-lg-9" id="left-col">