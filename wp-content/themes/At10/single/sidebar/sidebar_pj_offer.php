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


				  
				  
// CHECK USER HAS ALREADY SUBMITTED AN OFFER
$CANMAKEOFFER = false;
if($CORE->USER("get_offer", $post->ID) == "0"){	
$CANMAKEOFFER = true;	 
}		  
 
?>

 
 
          <div class="stepbox row">
            <div class="col-4 stepbox-step step1 active">
              <div class="text-center stepbox-stepnum"><?php echo __("Submit Offer","premiumpress"); ?></div>
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
              <div class="text-center stepbox-stepnum"> <?php echo __("Start Work","premiumpress"); ?> </div>
              <div class="progress">
                <div class="progress-bar"></div>
              </div>
              <a href="javascript:void(0);" class="stepbox-dot bg-dark"></a> </div>
          </div>
          <div id="waitresponcebox" style="display:none;">
         
            <div class="p-4 bg-light col-12 rounded">
<div class="block-header">
<h2 class="block-header__title"><?php echo __("What happens next?","premiumpress"); ?></h2>
<div class="block-header__divider"></div> 
</div>
              <p><?php echo __("An email has been sent to the user to notify them of your new offer.","premiumpress"); ?></p>
              <p><?php echo __("The employer has up to 30 days (usually allot quicker!) to respond and either accept or decline your offer. Once a response is received you will be emailed and you can view all responses via your members area.","premiumpress"); ?></p>
            </div>
            <div class="text-center my-4"> <a href="<?php echo get_permalink($post->ID); ?>" class="btn btn-primary rounded-0 mr-3"><?php echo __("Back to item page","premiumpress"); ?></a> <a href="<?php echo _ppt(array('links','myaccount')); ?>?showtab=offers" class="btn btn-primary rounded-0"><?php echo __("View my applications","premiumpress"); ?></a> </div>
          </div>
          <div id="makeofferbox" >
            <div class="col-md-12 m-auto ">
              <div class="row ">
                <div class="col-md-12">
                  <div class="p-4 bg-light col-12 rounded">

                    <p style="line-height:30px;" class="text-muted"> <?php echo __("Apply for this job by entering your offer below along with a short description telling the user why they should select you.","premiumpress"); ?> </p>
                    <script>
                              function ValidateThis(){
							  
							    var bidprice = jQuery('#offer_price_amount').val();
                              	
								
								if(<?php echo $userdata->ID; ?> == <?php echo $post->post_author; ?>){
									alert("<?php echo __("You cannot bid on your own items.","premiumpress"); ?>");
                              		return false;
								}
								
								if(!jQuery.isNumeric(bidprice)){
									alert("<?php echo __("Please enter a value offer amount.","premiumpress"); ?>");
                              		return false;
								}
								
                              	if(bidprice < 1){
                              		alert("<?php echo __("Please enter a value greater than 0.","premiumpress"); ?>");
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
			comments: jQuery('#offer_comments').val(),
			 
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
            console.log(e)
        }
    });
	
}// end are you sure
 		  
							  
</script>

<?php if($CANMAKEOFFER){ ?>

                    <form method="post" action="<?php echo _ppt(array('links','offerpage')); ?>" class="mt-2" onsubmit="return ValidateThis();">
                    
                      <div class="">
                      
                          <input type="hidden" name="ct_action" value="newoffer">
                      <input type="hidden" name="ct_pid" value="<?php echo $post->ID; ?>">
                      <input type="hidden" name="ct_aid" value="">
                        
                       
                        <label class="mb-2 small font-weight-bold"> <?php echo __("You should choose me because...","premiumpress") ?></label>
                         <div class="input-group">
                          <textarea style="height:100px;" class="form-control" id="offer_comments"></textarea>
                        </div>
                        
                         <label class="small font-weight-bold mt-2"> <?php echo __("My Offer","premiumpress") ?></label>
                         <div class="input-group"   style="max-width:200px;"> <span class="input-group-prepend"><span class="input-group-text"><?php echo hook_currency_symbol(''); ?></span></span>
                    <input type="text" name="offer_price_amount" id="offer_price_amount" maxlength="255" class="form-control rounded-0 val-numeric"  value="0" >
                  </div>
                        
                        
            <?php if(!$userdata->ID){ ?>
      <a href="javascript:void(0);" onclick="processLogin(1);" class="btn btn-primary font-weight-bold text-uppercase mt-3 rounded-0">  <?php echo __("Continue","premiumpress") ?></a> 
      <?php }else{ ?>
     <button class="btn btn-primary font-weight-bold text-uppercase mt-3 rounded-0" style="cursor:pointer"><?php echo __("Continue","premiumpress"); ?> <i class="fa fa-chevron-right ml-2"></i> </button>
      <?php } ?>
                     </div>
                    </form>
                    
                    
<?php }else{ ?>


<div class="alert alert-danger text-center"><?php echo __("You have already smitted an offer for this project.","premiumpress") ?></div>

<?php } ?>    
                    
               
                </div>
                
               </div>
                
                
              </div>
            </div>
            <!-- end make offer box -->
          </div>
 
