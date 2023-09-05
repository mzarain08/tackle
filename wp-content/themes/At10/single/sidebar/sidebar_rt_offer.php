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

global $CORE, $post, $userdata;

 

?>
<div class="p-3">
<div class="stepbox row mt-1 mb-4">
  <div class="col-4 stepbox-step step1 active">
    <div class="text-center stepbox-stepnum"><?php echo __("Submit Request","premiumpress"); ?></div>
    <div class="progress bg-success">
      <div class="progress-bar"></div>
    </div>
    <a href="javascript:void(0);" onclick="ChangeSteps(1);" class="stepbox-dot bg-dark"></a> </div>
  <div class="col-4 stepbox-step step2">
    <div class="text-center stepbox-stepnum"><?php echo __("Wait for Responce","premiumpress"); ?></div>
    <div class="progress">
      <div class="progress-bar"></div>
    </div>
    <a href="javascript:void(0);" class="stepbox-dot bg-dark"></a> </div>
  <div class="col-4 stepbox-step step3">
    <div class="text-center stepbox-stepnum"> <?php echo __("Setup Viewing","premiumpress"); ?> </div>
    <div class="progress">
      <div class="progress-bar"></div>
    </div>
    <a href="javascript:void(0);" class="stepbox-dot bg-dark"></a> </div>
</div>
<div id="waitresponcebox" style="display:none;">
 
  <div class="p-4 bg-light col-12 rounded m-auto">
 
<div class="block-header">
<h2 class="block-header__title"><?php echo __("What happens next?","premiumpress"); ?></h2>
<div class="block-header__divider"></div> 
</div>
    
    
    
    <p><?php echo __("An email has been sent to the agent to notify them of your new request.","premiumpress"); ?></p>
    <p><?php echo __("The agent will contact you ASAP and setup a viewing date and time for you.","premiumpress"); ?></p>
  </div>
  <div class="text-center my-4"> <a href="<?php echo get_permalink($post->ID); ?>" class="btn btn-primary rounded-0 mr-3"><?php echo __("Back to item page","premiumpress"); ?></a> <a href="<?php echo _ppt(array('links','myaccount')); ?>?showtab=offers" class="btn btn-primary rounded-0"><?php echo __("View my viewing","premiumpress"); ?></a> </div>
</div>
<div id="makeofferbox" >
  <div class="col-md-12 m-auto ">
    <div class="row">
      <div class="col-md-12">
        <div class="p-4 bg-light col-12 rounded">
       
    
<div class="block-header">
<h2 class="block-header__title"><?php echo __("How does it work?","premiumpress"); ?></h2>
<div class="block-header__divider"></div> 
</div>
      
    
    
          <p style="line-height:30px;" class="text-muted"> <?php echo __("Tell us when you would like to arrange a viewing and we'll notify the agent. They will then confirm with you and arrange a suitable time.","premiumpress"); ?> </p>
          <form method="post" action="<?php echo _ppt(array('links','offerpage')); ?>"  onsubmit="return ValidateThis();" id="seldate">
            <div>
              <input type="hidden" name="ct_action" value="newoffer">
              <input type="hidden" name="ct_pid" value="<?php echo $post->ID; ?>">
              <input type="hidden" name="ct_aid" value="">
              <input type="hidden" id="offer_price_amount" />
              <div id="datepicker"></div>
              <?php if(!$userdata->ID){ ?>
              <a href="javascript:void(0);" onclick="processLogin(1);" class="btn btn-primary font-weight-bold text-uppercase mt-3 rounded-0"> <?php echo __("Continue","premiumpress") ?></a>
              <?php }else{ ?>
              <button class="btn btn-primary font-weight-bold text-uppercase mt-3 rounded-0" style="cursor:pointer"><?php echo __("Continue","premiumpress"); ?> <i class="fa fa-chevron-right ml-2"></i> </button>
              <?php } ?>
            </div>
            <div class="clearfix">
              <p class="mt-4 ml-2 small float-left"><?php echo __("By clicking continue you agree to our website","premiumpress"); ?> <a href="<?php echo _ppt(array('links','terms')); ?>" style="text-decoration:underline;"><?php echo __("terms and conditions","premiumpress"); ?>.</a></p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- end make offer box -->
</div></div>
<script>
function ValidateThis(){
	var date = jQuery('#offer_price_amount').val();
	
	<?php if($post->post_author == $userdata->ID){ ?>
	alert("<?php echo __("You cannot book a viewing on your own property.","premiumpress"); ?>");
    return false;
	<?php } ?>
                              	  
	if(date == ""){
									alert("<?php echo __("Please select a viewing date.","premiumpress"); ?>");
                              		return false;
								}
								
								ajax_single_offer_make();
								return false;
                              	 
     }
							  
							 
		
							  
function ajax_single_offer_make(){ 
 
	jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',	
		dataType: 'json',	
		data: {
            single_action: "single_offer_make",
			pid: <?php echo $post->ID; ?>,
			aid: <?php echo $post->post_author; ?>,
			price: jQuery('#offer_price_amount').val(),
			 
        },
        success: function(response) {
 
			if(response.status == "ok"){
			 	 
				// UPDATED DISPLAY			
				jQuery('#makeofferbox').hide();	
				jQuery('#waitresponcebox').show();	
				
				//jQuery('.step1').removeClass('active');
				//jQuery('.step1 .process').removeClass('bg-success');
				
				jQuery('.step2').addClass('active');
				jQuery('.step2 .progress').addClass('bg-success');
				 
				 
  		 	
			}else{			
				console.log("Error trying to add.");			
			}			
        },
        error: function(e) {
            alert("error "+e)
        }
    });
	
}// end are you sure
							  
							  
</script>
