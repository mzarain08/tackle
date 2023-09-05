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

global $CORE, $CORE_UI, $userdata;

 

// GET BUYER ID
$job_buyer_id = get_post_meta($_POST['pid'],'buyer_id',true);
if($job_buyer_id == ""){ $job_buyer_id =0;}
                     
$job_seller_id = get_post_meta($_POST['pid'],'seller_id',true);
if($job_seller_id == ""){ $job_seller_id = 0; }

$job_post_id = get_post_meta($_POST['pid'],'post_id',true);	

$job_total = $_POST['total'];
if($job_total == ""){ $job_total = 0; }
 

// GET CASHOUT COUNT
$hasRequest = $CORE->ORDER("get_dispute_pending", array($_POST['pid'],$job_buyer_id, $job_seller_id)); 

// DISPUTE DATA
$dispute_date = "";
$dispute_dispute_by_userid = "";
$dispute_dispute_by_user = "";
$user2_status = 0;
$dispute_id = 0;

if($hasRequest > 0){


	$dispute_id = get_post_meta($_POST['pid'],'dispute_id',true);	
	
	
	$dispute_date = get_post_meta($dispute_id,'dispute_date',true);	
	$dispute_dispute_by_userid = get_post_meta($dispute_id,'dispute_by_userid',true);	
 	
	$dispute_dispute_by_user = $CORE->USER("get_username", $dispute_dispute_by_userid);
	 
	$user2_status = get_post_meta($dispute_id,'user2_status',true);
	  
  
}
  
?>

 

<div class="p-md-3">

<div class="fs-lg text-600"><?php echo __("Resolution Center","premiumpress"); ?></div>

<p class="opacity-5"><?php echo __("Here you can work things out and resolve issues regarding your order.","premiumpress"); ?></p>

<hr />


<div class="step step1" style="display:none;">

<p class="text-600"><?php echo __("What can we help you do?","premiumpress"); ?></p>

    <div>
    
    <div class="mb-3"><input type="radio" value="1" name="1" checked="checked" class="mr-2" /> 
    <?php echo __("The seller is unresponsive - I would like a refund. ","premiumpress"); ?>
    </div>
    
    <div><input type="radio" value="2" name="1" class="mr-2" /> <?php echo __("Ask the seller to cancel the order.","premiumpress"); ?></div>
    
    </div>
    

</div>


<div class="step step2" style="display:none;">

<p class="text-600"><?php echo __("Explain why you would like to cancel this order.","premiumpress"); ?></p>

<textarea class="form-control w-100" style="height:150px;" id="disputnotes"></textarea>

</div>

<div class="step step3" style="display:none;">
<div class="alert alert-success p-3">

    <div class="d-flex">
        <div class="ml-3">
        <div ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['check-circle']; ?></div>
        </div>    
        <div class="ml-3">
        
        <div id="defaultmsg">
        <?php echo str_replace("%s", "<b>".$dispute_dispute_by_user."</b>", str_replace("%d", $dispute_date, __("A request to cancel this order has been submitted by %s on %d.","premiumpress"))); ?>
        </div>
        
        <div id="thankyoumsg" style="display:none">
        <?php echo __("Thank you! Your request has been sent to our support team. We will contact you within 30 days with a discussion.","premiumpress"); ?>
        </div>
        
        </div>    
    </div>

</div>

</div>    

<hr />
<a href="javascript:void(0);" onclick="nextStep();" data-ppt-btn class="btn-primary" id="bnDisC"><?php echo __("Continue","premiumpress"); ?></a>

</div>

<?php if($dispute_dispute_by_userid != $userdata->ID ){ //&& $user2_status == 3 ?>

<div class="p-3 mt-n4">

    <div class="row" id="opps1">
        <div class="col-md-6">
        
        <div class="text-700 mb-2"><?php echo __("Process Refund","premiumpress"); ?></div>
        
        <div><?php echo __("Click accept to issue a full refund or decline to leave the final decision to an administrator.","premiumpress"); ?></div>
       
       
        </div>
        <div class="col-md-6 text-center">
        
         <a href="javascript:void(0);" onclick="ProcessDecline1Step();" data-ppt-btn class="btn-primary"><?php echo __("Accept","premiumpress"); ?></a>
        
        <a href="javascript:void(0);" onclick="ProcessDecline2Step();" data-ppt-btn class="btn-dark"><?php echo __("Decline","premiumpress"); ?></a>
        </div>
    </div>
    
    
    
    
    <div class="step step7" style="display:none;">
    
    <p class="text-600"><?php echo __("Explain why a refund should not be given.","premiumpress"); ?></p>
    
    <textarea class="form-control w-100" style="height:150px;" id="disputnotes1"></textarea>
    
    <a href="javascript:void(0);" onclick="ProcessDecline2();" data-ppt-btn class="btn-primary mt-4" ><?php echo __("Continue","premiumpress"); ?></a>
    
    </div>

</div>

<?php } ?>




<input type="hidden" id="stepme" value="<?php if($hasRequest){ echo 3; }else{ echo 1; } ?>" />
<script>

function nextStep(){
	
	jQuery(".step").hide();
	var step = jQuery("#stepme").val();
	jQuery("#stepme").val(parseFloat(jQuery("#stepme").val())+1);
 
	if(step == 3){
		jQuery("#bnDisC").hide();
		
		<?php if($hasRequest == 0){ ?>
		ProcessUser1();
		<?php } ?>
	}
 
	jQuery(".step"+step).show();
	
}
jQuery(document).ready(function(){

nextStep();

});



function ProcessDecline2Step(){
	jQuery(".step, #opps1").hide();
	jQuery(".step7").show();
}

function ProcessDecline2(){

	jQuery("#defaultmsg").hide();

     jQuery.ajax({
           type: "POST",
           url: '<?php echo home_url(); ?>/',		
   		data: {
			
			disputesid: "<?php echo $dispute_id; ?>",
            action: "dispute_update",
			status: "2",  
			notes:jQuery("#disputnotes1").val(), 
			 
			
           },
           success: function(response) {   			 
			
			jQuery(".step, #opps1").hide();
			jQuery(".step3").show();
			jQuery("#thankyoumsg").show();
   			 		
   			
           },
           error: function(e) {
               alert("error "+e)
           }
       });

}

function ProcessDecline1Step(){


	jQuery("#defaultmsg").hide();

     jQuery.ajax({
           type: "POST",
           url: '<?php echo home_url(); ?>/',		
   		data: {
			
			disputesid: "<?php echo $dispute_id; ?>",
            action: "dispute_update",
			status: "1",   
			 
           },
           success: function(response) {   			 
			
			jQuery(".step, #opps1").hide();
			jQuery(".step3").show();
			jQuery("#thankyoumsg").show();
			
			
				 // REFND
			     jQuery.ajax({
				    type: "POST",
				    url: '<?php echo home_url(); ?>/',		
					data: {
						single_action: "offer_refund",
						job_id: "<?php echo $_POST['pid']; ?>",  
						buyer_id: "<?php echo $job_buyer_id; ?>",    
				   },
				   success: function(response) {   
					
				   } 
			   });
   			 		
   			
           },
           error: function(e) {
               alert("error "+e)
           }
       });

}

function ProcessUser1(){

	jQuery("#defaultmsg").hide();
	jQuery("#thankyoumsg").show();
	
     jQuery.ajax({
           type: "POST",
           url: '<?php echo home_url(); ?>/',		
   		data: {
		
            action: "dispute_new",
			 
			orderid: "<?php echo $_POST['pid']; ?>",
			notes:jQuery("#disputnotes").val(), 
			
			buyer_id: "<?php echo $job_buyer_id; ?>",
			seller_id: "<?php echo $job_seller_id; ?>",
			
			job_post_id: "<?php echo $job_post_id; ?>",
			
			total: "<?php echo $job_total; ?>",
			
           },
           success: function(response) {   			 
			 
			
			
   			 		
   			
           },
           error: function(e) {
               alert("error "+e)
           }
       });

}

</script>