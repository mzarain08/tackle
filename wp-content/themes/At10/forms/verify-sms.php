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

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
$selected_country = _ppt(array('user','account_usercountry'));
?>

<div class="card border-0 card-body text-center  mobile-mt-4 card-mobile-transparent">

  <div class="my-4" id="shownum">
    <i class="fal fa-mobile fa-8x mb-4 text-primary"></i>
    <h3><?php echo __("SMS Verification","premiumpress"); ?></h3>
    <p class="mb-4 lead"> <?php echo __("We will send a SMS code to verify it's you.","premiumpress"); ?> </p>
    <div style="max-width:400px; margin:auto auto;">
    <div class="col-xl-10 mx-auto">
      <input name="custom[mobile]" type="text" class="form-control z-10" id="mobilenum-input" value="<?php echo get_user_meta($userdata->ID,'mobile',true); ?>" />
      <a href="javascript:void(0);" style="z-index:0;" onclick="sms_code_send();" data-ppt-btn class="btn-primary btn-lg text-600 btn-block mt-4 text-600"><?php echo __("Send Code","premiumpress"); ?></a>
      <div class="error error1 bg-light mt-4 small py-2" style="display:none;">
        <?php echo __("There was an error with this number. Please check and try again.","premiumpress"); ?>
      </div>
    </div>
  </div>
</div>

<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
  <div class="my-4" id="showcodebox" style="display:none;">
    <i class="fal fa-keyboard fa-8x mb-4 text-primary"></i>
    <h4><?php echo __("Please check your phone.","premiumpress"); ?></h4>
    <p class="mb-4"> <?php echo __("Enter the code in the box below;","premiumpress"); ?> </p>
    
    <div style="max-width:400px; margin:auto auto;">
      <div class="d-flex justify-content-between">
      <input name="num1" class="form-control mb-4 bg-light" id="num1"  maxlength="1" style="width:70px; font-size:50px; text-align:center;">
      <input name="num2" class="form-control mb-4 bg-light" id="num2" maxlength="1" style="width:70px; font-size:50px; text-align:center;">
      <input name="num3" class="form-control mb-4 bg-light" id="num3" maxlength="1" style="width:70px; font-size:50px; text-align:center;">
      <input name="num4" class="form-control mb-4 bg-light" id="num4" maxlength="1" style="width:70px; font-size:50px; text-align:center;">
      
      </div>
     
     <div class="col-xl-10 mx-auto"> 
      
      <a href="javascript:void(0);" onclick="sms_code_validate();" data-ppt-btn class="btn-primary btn-lg text-600 btn-block mt-1 text-600"><?php echo __("Verify Code","premiumpress"); ?></a>
      
      <div class="mt-4">
      <a href="javascript:void(0);" class="text-center small text-dark" onclick="gobackmobile();"><?php echo __("change number","premiumpress"); ?></a>
      </div>
      
      <div class="error error2 bg-light mt-4 small py-2" style="display:none;">
       <?php echo __("Invalid Code. Please check and try again.","premiumpress"); ?>
      </div>
      
    </div>
     </div>
  </div>
  
</div>
</div>
<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
<script>

function sms_code_send(){

jQuery(".error").hide();
 
	if(jQuery("#mobilenum-input").val().length < 8){
		jQuery(".error1").show();
		return;
	}
	
	jQuery.ajax({
            type: "POST",
			dataType: 'json',	
            url: '<?php echo home_url(); ?>/',		
         	data: {
                   action: "sms_code_send",			 
					num: jQuery("#mobilenum-input").val(),
              },
              success: function(response) {
			  
         			if(response.status == "ok"){ 
					
						jQuery("#shownum").hide();
						jQuery("#showcodebox").show(); 
					
					}else{
						
						jQuery(".error1").show();
						return;
					
					}	
					
							
              },
              error: function(e) {
                     alert("error "+e)
               }
	});	 
}

function sms_code_validate(){

	jQuery(".error").hide();
	var code = jQuery("#num1").val()+jQuery("#num2").val()+jQuery("#num3").val()+jQuery("#num4").val();
	
	if(code.length !=  4){
		jQuery(".error2").show();
		return;
	} 
 
	jQuery.ajax({
            type: "POST",
			dataType: 'json',	
            url: '<?php echo home_url(); ?>/',		
         	data: {
                    action: "sms_code_validate",
					num: jQuery("#mobilenum-input").val(),				 
					code: code,
					
              },
              success: function(response) {
         		   
				 
         			if(response.status == "ok"){
						
						<?php if(isset($GLOBALS['flag-account'])){ ?>
						 
						window.location.href='<?php echo _ppt(array('links','myaccount')); ?>'; 
						
						<?php } ?>
						
						jQuery("#smschecked").val("1");
						jQuery(".smsverified").removeClass('closed');
						
						}else{			
		 			 
						jQuery(".error2").show();
						return;
					
					}	
					
							
              },
              error: function(e) {
                     alert("error "+e)
               }
	});	 
}

function gobackmobile(){
	jQuery("#shownum").show();
	jQuery("#showcodebox").hide(); 
}

jQuery(document).ready(function(){ 
 
		jQuery("#account_sidebar .btn-dark.viewp").hide();
		jQuery("#jumplinks li").hide();
		
		jQuery(".dashboard-usertop .dropdown-menu").hide();
		jQuery(".dashboard-usertop .caret").hide();
		 

});
</script>