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

if($userdata->ID == $post->post_author){
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

// GET STATUS
$status = $CORE->PACKAGE("get_status",  $post->ID );

// SHOW UPGRADES
$showupgrades = $CORE->PACKAGE("show_upgrades", array()); 

$payment_due =  0;
$foundA = get_post_meta($post->ID,'totaldue',true);
if(is_numeric($foundA) && $foundA > 0){ 			
	$payment_due = $foundA;
}
  
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>


<div class="editor_panel_toggle editor_panel" data-rtl="ltr">
<div class="sc-gipzik editor_panel_wrap">

<div class="sc-iRbamj editor_panel_title bg-dark">
<h3 class="componentTitle text-700 text-white"><span><?php echo __("Settings","premiumpress") ?></span></h3>

<a href="javascript:void(0);" onclick="jQuery('.editor_panel_toggle').toggleClass('active');" class="text-light" style="position: absolute;    top: 20px;    right: 20px;"><i class="fa fa-times"></i></a>

</div>


<div class="card-footer <?php echo $status['css-bg']; ?> text-center text-light text-600">

<?php echo $status['name']; ?>

</div>

<div class="card-body">




<?php 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


if($status['key'] == "payment" || $payment_due > 0){

$payFormShown = 1;

?>
 

<div class="text-700 mb-3 text-center"><?php echo __("This ad is not live.","premiumpress"); ?></div>

<div class="ppt-tabs-listing border-0">
<div class="fieldset">
<div class="_title"><?php echo __("Payment Due","premiumpress"); ?></div>
<div class="_price  price-value <?php echo $CORE->GEO("price_formatting",array()); ?>">
          <?php echo $payment_due; ?>
     </div>
</div>
</div>
 
 
 
  <a href="javascript:void(0);" onclick="processNewPayment('#orderdatafor<?php echo $post->ID; ?>');" class="btn btn-system btn-block btn-lg text-700"><?php echo __("Pay Now","premiumpress"); ?></a>    
	<input type="hidden" id="orderdatafor<?php echo $post->ID; ?>" value="<?php 
	 
	$paymentc = array(
			"uid" 			=> $userdata->ID, 
			"amount" 		=> $payment_due, 
			"order_id" 		=> "LST-".$post->ID,
			"description" 	=> __("Ad Payment","premiumpress")." #".$post->ID,	
			"recurring" 	=> 0,	
			"credit" 		=> 1,						
	); 
	 
   echo $CORE->order_encode($paymentc); ?>" /> 
 
<hr />
<script type="text/javascript"> 
jQuery(document).ready(function(){ 
jQuery('.editor_panel_toggle').toggleClass('active');
});
</script>
<?php }   ?>



<?php
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if(in_array($status['key'], array("pending_approval"))){

$msg = get_post_meta($post->ID,'approval_message',true); 

?>

<div>

	<?php if(strlen($msg) > 2){ ?>
    
    <p class="font-weight-bold"><?php echo __("Admin response","premiumpress") ?></p>
    
    <?php echo wpautop($msg); ?>
    
    <?php }else{ ?>
    
    <p class="font-weight-bold"><?php  echo __("This listing is pending approval.","premiumpress"); ?></p>
    <p><?php  echo __("Typically listings are approved within 24 hours, we will notify you via email with any updates.","premiumpress"); ?></p>
    <p><?php  echo __("Thank you for your patience.","premiumpress"); ?></p> 
    
    <?php } ?>

<hr />
</div>

<?php } 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>


<?php if(_ppt(array('links','add')) != ""){ ?>

<a href="<?php echo _ppt(array('links','add')); ?>?eid=<?php echo $post->ID; ?>" class="btn btn-block btn-lg btn-system"><?php echo __("Edit","premiumpress") ?></a>

<?php } ?>
 
<a href="javascript:void(0)" onclick="processStats(<?php echo $post->ID; ?>);" class="btn btn-block btn-lg btn-system"><?php echo __("Statistics","premiumpress") ?></a>


<?php if($showupgrades && !isset($payFormShown) ){ ?>
   
<a href="javascript:void(0)" onclick="processListingUpgrade(<?php echo $post->ID; ?>);" class="btn btn-block btn-lg btn-system"><?php echo __("Upgrade","premiumpress") ?></a>
<?php } ?>   


<?php if(in_array($status['key'], array("expired")) && $payment_due == 0 ){ ?> 

<hr />
        
<a href="javascript:void(0)" onclick="processListingUpgrade(<?php echo $post->ID; ?>);" class="btn btn-block btn-lg btn-system"><?php echo __("Renew","premiumpress"); ?></a>
<hr />
<?php } ?>

<?php

$canDelete = true;

if(THEME_KEY ==  "at" ){ 
		  
	// CHECK FOR BIDDING SO WE CAN DISABLE FIELDS
	$current_bidding_data = get_post_meta($post->ID,'current_bid_data',true); 
	if(is_array($current_bidding_data) && !empty($current_bidding_data) ){ 
	$canDelete = false; 
	}		  
} 

if(in_array(THEME_KEY, array("da") ) ){ 
	$canDelete = false; 
}

if($canDelete){ 
?>

<a href="javascript:void(0);" onclick="ajax_delete_listing();" class="btn btn-block btn-lg btn-system"><?php echo __("Delete","premiumpress") ?></a>
 
<?php } ?>




</div>

<?php /*
<div class="sc-jlyJG editor_panel_footer"><a href="javascript:void(0);" onclick="jQuery('.editor_panel_toggle').toggleClass('active');" class="btn btn-dark btn-lg btn-block text-700"><span><?php echo __("Close Window","premiumpress") ?></span></a></div>
*/ ?>

</div>
</div>


<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


?>
<div id="option_btn">

<div class="heading bg-warning" onclick="jQuery('.editor_panel_toggle').toggleClass('active');"><a href="javascript:void(0);" class="border-0 p-0 m-0 text-white" style="display: inline-block;"><i class="fa fa-cog fa-spin" aria-hidden="true"></i></a></div>

  
<div class="info <?php if($status['key'] == "publish"){ echo $status['css-bg']; }else{ echo "bg-danger"; } ?> text-700"><?php if($status['key'] == "publish"){ ?><span class="text-white"><?php echo $status['name']; ?></span><?php }else{ ?><i class="fa fa-tools text-white"></i> <?php } ?></div>
 
 
</div>
<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


?>
<style>

.editor_panel.active {
    right: 0px;
    left: inherit;
	z-index: 999999;
}
 
.editor_panel {
    background-color: rgb(250, 250, 250);
    width: 340px;
    height: 100%;
    padding: 0px;
    display: flex;
    flex-direction: column;
    flex-shrink: 0;
    position: fixed;
    top: 0px;
    box-sizing: border-box;
    right: -360px;
    left: inherit;
    z-index: 9999;
    transition: all 0.3s cubic-bezier(0.215, 0.61, 0.355, 1) 0s;
    box-shadow: rgb(0 0 0 / 40%) 0px 0px 9px;
}

.editor_panel_wrap {
    height: 100%;
    display: flex;
    flex-direction: column;
    position: relative;
}
.editor_panel_title {
    padding: 25px 15px;
    width: 100%;
 
}
.editor_panel_title .componentTitle {
    font-size: 18px;
    line-height: 1;
    width: 100%;
    margin: 0px;
    text-align: center;
    display: flex;
    -webkit-box-pack: center;
    justify-content: center;
}
.editor_panel_footer {
    width: 100%;
    padding: 25px;
    display: flex;
    -webkit-box-align: center;
    align-items: center;
    -webkit-box-pack: center;
    justify-content: center;
    background-color: rgb(255, 255, 255);
    border-top: 1px solid rgb(238, 238, 238);
}
</style>
<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


?>
<script>
   function ajax_show_enhancements(){
   
       jQuery.ajax({
           type: "POST",
           url: '<?php echo home_url(); ?>/',		
   		data: {
               action: "listing_enhancements",			 
   			pid: <?php echo $post->ID; ?>,			 
           },
           success: function(response) {
   		
   			jQuery('#modal-title').html("Choose an upgrade option");
   			
   			if(response == ""){
   			jQuery('#author-toolbox-payment-options').html("<?php echo __("No upgrades available.","premiumpress"); ?>");
   			}else{
   			jQuery('#author-toolbox-payment-options').html(response);
   			}
   						
   			
   			
           },
           error: function(e) {
               //console.log(e)
           }
       });
   
   }
  
    
      
   function ajax_delete_listing(){
   
   if(confirm("<?php echo trim(__("Are you sure?","premiumpress")); ?>")){
   
       jQuery.ajax({
           type: "POST",
           url: '<?php echo home_url(); ?>/',	
   		dataType: 'json',	
   		data: {
               action: "listing_delete",
   			pid: <?php echo $post->ID; ?>,
           },
           success: function(response) {			
   			if(response.status == "ok"){	
   							
   				window.open('<?php echo _ppt(array('links','myaccount')); ?>', "_self");			 
     		 	
   			}else{			
   				jQuery('#ajax_response_msg').html("error trying to delete");			
   			}			
           },
           error: function(e) {
               console.log(e)
           }
       });
   }// end are you sure
   
   }
</script>
<?php } ?>