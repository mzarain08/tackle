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

if(!isset($GLOBALS['flag-modal-offers'])){

$GLOBALS['flag-modal-offers']=1;
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$photo 			= $CORE->USER("get_avatar",$post->post_author);
$username 		= $CORE->USER("get_username",$post->post_author);
//$country 		= $CORE->USER("get_country", $userdata->ID);
$country_flag 	= $CORE->USER("get_country_flag", $post->post_author);


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

// CHECK USER HAS ALREADY SUBMITTED AN OFFER
$CANMAKEOFFER = false;
if($CORE->USER("get_offer", $post->ID) == "0"){	
$CANMAKEOFFER = true;	 
}	

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


?>
<div class="_content py-3">  
<div id="makeoffer">
 
  
    <div class="col-md-12">
      <div class="row">
      
      
<div class="col-md-4">

    <div class="text-center">  
          
        <div class="ppt-avatar bg-white ppt-avatar-xxl bg-image rounded" data-image="<?php echo $photo; ?>"></div>
        
        <div class="text-700"><?php echo $username; ?></div>
        
        <div><?php echo $country_flag; ?></div>
    
    </div>

</div>
<div class="col-md-8">

<div class="p-4 bg-light col-12 rounded border">

<div id="waitresponcebox" style="display:none;">
 
      <h6><?php echo __("Wait for a response","premiumpress"); ?></h6>
      <p style="line-height:30px;" class="text-muted small"><?php echo __("An email has been sent to the user to notify them of your new offer.","premiumpress"); ?></p>
      
 
    <div class="mt-3"><a href="<?php echo _ppt(array('links','myaccount')); ?>?showtab=offers" data-ppt-btn class="btn-system"><?php echo __("View my offers","premiumpress"); ?></a> </div>
</div>

<div id="makeofferbox" >


<?php if(!$CANMAKEOFFER){ ?>
 
<div class="alert alert-danger text-center"><?php echo __("You have already submitted an offer for this item.","premiumpress") ?></div>

<?php }else{ 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


?>

<form method="post" action="<?php echo _ppt(array('links','offerpage')); ?>" onsubmit="return ValidateThis();" id="makeofferform">
<input type="hidden" name="ct_action" value="newoffer">
<input type="hidden" name="ct_pid" value="<?php echo $post->ID; ?>">
<input type="hidden" name="ct_aid" value="">
<input type="hidden" name="" id="offerstep" value="0">


<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


?>


<div id="offer-slide1">

<h6><?php echo __("Make an offer","premiumpress"); ?></h6>

<p style="line-height:30px;" class="text-muted small ">
<?php echo __("Make an offer for this item by entering an amount below. Your offer will be sent to the user for consideration.","premiumpress"); ?> </p>

           <div class="row">
               
                <div class="col-md-6">
                
                  <div class="input-group  mb-4 mb-md-0"> <span class="input-group-prepend">
                  <span class="input-group-text bg-white"><?php if(strpos( _ppt(array('currency','symbol')), "fal") === false){ echo hook_currency_symbol('');  }else{ echo '<i class="'._ppt(array('currency','symbol')).'"></i>'; } ?></span></span>
                    <input type="text" name="offer_amount" id="offer_amount" maxlength="255" class="form-control numericonly"  value="0" >
                  </div>
                  
                </div> 
              </div> 

</div>

<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
<div id="offer-slide2" style="display:none;">

<h6><?php echo __("Quick Message","premiumpress"); ?></h6>

<p style="line-height:30px;" class="text-muted small"><?php echo __("Why should the user accept your offer?","premiumpress"); ?> </p>

<textarea class="form-control w-100 rounded-0" style="height:150px;" id="offer_comments"></textarea>

</div>
<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


?>
</form>


                    
<?php } ?>
</div>
          </div>
        </div>
        
<?php if($CANMAKEOFFER){ ?>
<div class="col-12 text-center small mt-4 terms">
 <?php echo __("By clicking continue you agree to our website","premiumpress"); ?> <a href="<?php echo _ppt(array('links','terms')); ?>" style="text-decoration:underline;" target="_blank"><?php echo __("terms and conditions","premiumpress"); ?>.</a>

</div>
<?php } ?>
        
      </div>
    </div>
  </div>




</div>
<?php 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if($CANMAKEOFFER){ ?>
<div class="_footer border-top text-center py-3 bg-light">


<button type="button" id="cBtn" <?php if(!$userdata->ID){ ?>onclick="processLogin(1);"<?php }else{ ?>onclick="jQuery('#makeofferform').submit();"<?php } ?> data-ppt-btn class="btn-primary"><?php echo __("Continue","premiumpress"); ?></button>

</div>

<?php } 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
 
?>
<script>
function ValidateThis(){

	var bidprice = jQuery('#offer_amount').val();
 
	if(bidprice < 1){
		alert("<?php echo __("Please enter a value greater than 0.","premiumpress"); ?>");
		return false;
	}
	
	if(jQuery("#offerstep").val() == 0){
	
	jQuery("#offer-slide1").hide();
	jQuery("#offer-slide2").show();
	jQuery("#offerstep").val(1);
	return false;
	
	}
	
	if(jQuery('#offer_comments').val().length < 5 ){
		alert("<?php echo __("Please include a message.","premiumpress"); ?>");
		return false;
	}
	
	
	<?php if($post->post_author == $userdata->ID){ ?>
		alert("<?php echo __("You cannot bid on your own items.","premiumpress"); ?>");
		return false;
	<?php } ?>


	
									
	if(!jQuery.isNumeric(bidprice)){
		alert("<?php echo __("Please enter a value offer amount.","premiumpress"); ?>");
		return false;
	}
	


	
	ajax_single_offer_make();
	return false;
                              	 
}							  
							  
function ajax_single_offer_make(){ 

	jQuery("#cBtn").attr('disabled', true);
 
	jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',	
		dataType: 'json',	
		data: {
            single_action: "single_offer_make",
			pid: <?php echo $post->ID; ?>,
			aid: <?php echo $post->post_author; ?>,
			price: jQuery('#offer_amount').val(),
			comments: jQuery('#offer_comments').val(),
        },
        success: function(response) {
 
			if(response.status == "ok"){
			 	 
				// UPDATED DISPLAY			
				jQuery('#makeofferbox').hide();	
				jQuery('#waitresponcebox').show();	
				
				//jQuery('.step1').removeClass('active');
				//jQuery('.step1 .process').removeClass('bg-success');
				jQuery('.extra-modal-container .card-footer').hide();	
				jQuery('.terms').hide();
				
				jQuery('.step2').addClass('active');
				jQuery('.step2 .progress').addClass('bg-success');
				
				 
				 jQuery('#cBtn').text("<?php echo __("Close","premiumpress"); ?>");
				 
				 jQuery('#cBtn').attr("onclick", 'jQuery(".ppt-modal-wrap").removeClass("show")');
				 
				 jQuery("#cBtn").attr('disabled', false);
				 
				 
				 
  		 	
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
<?php } ?>