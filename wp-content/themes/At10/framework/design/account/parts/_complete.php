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

global $settings, $userdata, $CORE, $CORE_UI;

$uid = uniqid();
 

// 2 IMPORTANT VALUES
// 1. offer_complete (3: done  / 2: paid / 1: waiting payment )
// 2. offer_status (1: Pending / 2: Reject Order / 3: Accepted )
 
$types = array(

	// Pending Approval + Waiting
	
	"1-0" => array( 
	
		"name_buyer" 	=> __("Waiting for %s","premiumpress"),
		"desc_buyer" 	=> __("Please wait for the %s to accept this  %c","premiumpress"),		
		"name_seller" 	=> __("Accept %c","premiumpress"),
		"desc_seller" 	=> __("Please accept or decline this %c.","premiumpress"),		
		
		"icon" 			=> "clock",
		"text-color" 	=> "text-primary",
		"user" 			=> "buyer",

	
	),	
	
	//"1-1" => array( ),
	
	
	// Rejected
	"2-0" => array(  ),
	//"2-1" => array(  ),
 
	// Accepted + Pending Payment
	"3-1" => array( 
	
		"name_buyer" 	=> __("Make Payment","premiumpress"),
		"desc_buyer" 	=> __("Please make payment to the %s.","premiumpress"),		
		"name_seller" 	=> __("Pending Payment","premiumpress"),
		"desc_seller" 	=> str_replace("%s","%b",__("Please wait for %s to make payment.","premiumpress")),		
		
		"icon" 			=> "credit-card",
		"text-color" 	=> "text-primary",
		"user" 			=> "buyer",
	),
	
	// Accepted + Completed
	"3-2" => array( 
 	
		"name_buyer" 	=> __("Pending Delivery","premiumpress"),
		"desc_buyer" 	=> __("Please wait for the %s to deliver this %c.","premiumpress"),		
		"name_seller" 	=> __("Please make delivery","premiumpress"),
		"desc_seller" 	=> __("Please deliver this %c to the %b.","premiumpress"), 
 		
		"icon" 			=> "gift",
		"text-color" 	=> "text-primary",
		"user" 			=> "seller",
	),
	
	// Accepted + Approval
	"3-3" => array( 
	
		"name_buyer" 	=> __("Please Approve","premiumpress"),
		"desc_buyer" 	=> __("Please approve or decline the %s's delivery.","premiumpress"),		
		"name_seller" 	=> __("Pending Approval","premiumpress"),
		"desc_seller" 	=> __("Please wait for the %b to approve the delivery.","premiumpress"), 	
		
		"icon" 			=> "check_circle",
		"text-color" 	=> "text-primary",
		"user" 			=> "buyer",
	),
	// Accepted + Finished
	"3-4" => array( 
	
		"name_buyer" 		=> __("Complete Order","premiumpress"),
		"desc_buyer" 		=> __("Click continue to complete order.","premiumpress"),		
		"name_seller" 		=> __("Pending Complete","premiumpress"),
		"desc_seller" 		=> __("Please wait for the %b to mark order as completed.","premiumpress"),
		
		"icon" 				=> "check_circle",
		"text-color" 		=> "text-primary",
		"user" 				=> "buyer",
	),	
	// Accepted + Feedback
	"3-5" => array( 	
	
		"name_buyer" 	=> __("Leave Feedback","premiumpress"),
		"desc_buyer" 	=> __("Please leave feedback for the %s.","premiumpress"),		
		"name_seller" 	=> __("Leave Feedback","premiumpress"),
		"desc_seller" 	=> __("Please leave feedback for the %b.","premiumpress"),	
		 
		"icon" 			=> "star",
		"text-color" 	=> "text-primary",
		"user" 			=> "buyer",
	),	
	
	// Accepted + Feedback
	"3-6" => array( 
	
		"name" 			=> __("Complete","premiumpress"),
		"desc" 			=> __("Please confirm that you've sent payment.","premiumpress"),
		
		"icon" 			=> "cog",
		"text-color" 	=> "text-primary",
	),	

);




// SWITCH TEXT CHANGES
switch(THEME_KEY){

	case "pj": { 
		 		
		$types["3-1"] = array(	 
		
			"name_seller" 	=> __("Make Payment","premiumpress"),
			"desc_seller" 	=> __("Please deposit funds.","premiumpress"),		
			
			"name_buyer" 	=> __("Pending Payment","premiumpress"),
			"desc_buyer" 	=> str_replace("%s","%b",__("Please wait for seller to deposit funds.","premiumpress")),		
			
			"icon" 			=> "credit-card",
			"text-color" 	=> "text-primary",
			"user" 			=> "buyer",
		);
		
		$types["3-2"] = array(	 
		
			"name_seller" 	=> __("Pending Delivery","premiumpress"),
			"desc_seller" 	=> __("Please wait for the %s to finish.","premiumpress"),		
			"name_buyer" 	=> __("Please make delivery","premiumpress"),
			"desc_buyer" 	=> __("Please complete the task set by the %b.","premiumpress"), 
			
			"icon" 			=> "gift",
			"text-color" 	=> "text-primary",
			"user" 			=> "seller",
		);	
		
		
		$types["3-3"] = array(	 
		
			"name_seller" 	=> __("Please Approve","premiumpress"),
			"desc_seller" 	=> __("Please approve or decline the %s's delivery.","premiumpress"),		
			"name_buyer" 	=> __("Pending Approval","premiumpress"),
			"desc_buyer" 	=> __("Please wait for the %b to approve the delivery.","premiumpress"), 	
			
			"icon" 			=> "check",
			"text-color" 	=> "text-primary",
			"user" 			=> "buyer",
		);	
		

		$buyer_text = __("employer","premiumpress");
		$seller_text = __("applicant","premiumpress");
		
	} break;

	case "at": { 
	 
	
		// CUSTOM
		if(get_post_meta($settings['job_post_id'],'listing_expiry_date', true) != ""  ){  
				
			$types["1-0"] = array( 
				
					"name_buyer" 		=> __("Waiting for auction to end","premiumpress"),
					"desc_buyer" 		=> __("Please wait for the auction to finish.","premiumpress"),					
					"name_seller" 		=> __("Waiting for auction to end","premiumpress"),
					"desc_seller" 		=> __("Please wait for the auction to finish.","premiumpress"),					
					"icon" 				=> "clock",
					"text-color" 		=> "text-primary",
					"user" 				=> "buyer",	
			
			);			
		}
		
		$buyer_text = __("buyer","premiumpress");
		$seller_text = __("seller","premiumpress");
			
	} break;
	
	case "pj":
	case "jb": {
	
		$buyer_text = __("applicant","premiumpress");
		$seller_text = __("employer","premiumpress");
		
	} break;
	
	case "rt": {
	
		$buyer_text = __("buyer","premiumpress");
		$seller_text = __("agent","premiumpress");
	
	} break;
	
	case "ll": {
	
		$buyer_text = __("student","premiumpress");
		$seller_text = __("teacher","premiumpress");
	
	} break;	 
	
	default: {
	
		$buyer_text = __("buyer","premiumpress");
		$seller_text = __("seller","premiumpress");
	}
}



	// Accepted + Finished
if(_ppt(array('escrow', 'enable_escrow')) == '1'){
	$types["3-4"] = array( 
	
		"name_buyer" 		=> __("Release Funds","premiumpress"),
		"desc_buyer" 		=> __("Please release funds to the %s.","premiumpress"),		
		"name_seller" 		=> __("Pending Funds","premiumpress"),
		"desc_seller" 		=> __("Please wait for the %b to release funds.","premiumpress"),
		
		"icon" 				=> "bag",
		"text-color" 		=> "text-primary",
		"user" 				=> "buyer",
	);	
}



$status_key = $settings['offer_status']."-".$settings['offer_complete'];

 
 
if(isset($types[$status_key])){

$status_types = $types[$status_key];


// CHECK TYPE
$mytype = "seller";
if($settings['job_buyer_id'] == $userdata->ID){
$mytype = "buyer";
}



 


if($status_key == "2-0"){ 

?>
 

	<div class="alert alert-danger p-3 mt-4">
	<div class="d-flex">
	<div class="ml-3">
  <div ppt-icon-48 data-ppt-icon-size="48">
              <?php  echo $CORE_UI->icons_svg['close'];  ?>
            </div>
</div>

	<div class="ml-3">
       <div class="text-700 mb-2 fs-7"><?php echo __("Rejected","premiumpress"); ?></div>
   
   <div class="fs-sm"><?php  echo str_replace("%s", strtolower($CORE->LAYOUT("captions","offer")), __("This %s was rejected.","premiumpress") ) ; ?></div>
   
   
   </div>
</div>
</div>

<?php 

}else{
 
?>

<?php if(THEME_KEY == "ll" &&  $settings['job_seller_id'] != $userdata->ID && $status_key == "3-5"){ ?>

<?php $ddlink = get_post_meta($settings['job_post_id'], "download_path", true); ?>

<div class="card   bg-white p-3 mb-4">
    <div class="row y-middle">
        <div class="col-md-8">
            <i class="fa fa-download fa-3x text-success float-left mr-4 ml-2  mt-2"></i>        
            
            <h3><?php echo __("Download","premiumpress"); ?></h3> 
                  
            <p class="text-muted small"><?php echo __("Download all course materials.","premiumpress"); ?></p>  
            
        </div>
        <div class="col-md-4">
        
         
			 <?php if($ddlink == ""){ ?>
             <p class="text-muted small"><?php echo __("Download link not available - please contact the teacher.","premiumpress"); ?></p>  
             <?php }else{ ?> 
            <a href="<?php echo $ddlink; ?>" target="_blank" rel="nofollow" data-ppt-btn class=" btn-success"><?php echo __("Download","premiumpress"); ?></a>
              <?php } ?>
        </div>
       
    </div>
</div>
<?php } ?>


 

<div class="bg-white p-3 mb-4" <?php if($settings['feedback_date'] != ""){ ?>style="display:none;"<?php } ?> ppt-border1>
    <div class="row y-middle">
        <div class="col-md-8"> 
          
            <div ppt-icon-48 data-ppt-icon-size="48" class="float-left mr-4 ml-2 pb-3 mt-2 hide-mobile <?php echo $status_types['text-color']; ?>">
              <?php if(isset($CORE_UI->icons_svg[$status_types['icon']])){ echo $CORE_UI->icons_svg[$status_types['icon']]; } ?>
            </div>
            
            <div class="fs-5 text-600"><?php echo 
			str_replace("%b", $buyer_text, 
			str_replace("%s", $seller_text,  
			str_replace("%c", strtolower($CORE->LAYOUT("captions","offer")), $status_types['name_'.$mytype]))); ?></div> 
                  
            <div class="text-muted mt-2 fs-7"><?php echo 
			str_replace("%b", $buyer_text, 
			str_replace("%s", $seller_text, 
			str_replace("%c", strtolower($CORE->LAYOUT("captions","offer")), $status_types['desc_'.$mytype]))); ?> </div>  
              
        </div>
        <div class="col-md-4"> 
        
        <?php //echo $status_key."<--"; ?> 
          
        <?php if($status_key == "3-5"){ // feedback ?>
        
        
        <?php }elseif( 
		
		( THEME_KEY == "pj" && in_array($status_key,array("3-1","3-2xx")) &&  $settings['job_seller_id'] == $userdata->ID )  || 
		
		( THEME_KEY == "pj" && in_array($status_key,array("3-2")) &&  $settings['job_buyer_id'] == $userdata->ID )  || 
		
		( THEME_KEY == "pj" && in_array($status_key,array("3-3")) &&  $settings['job_seller_id'] == $userdata->ID )  || 
		
		( THEME_KEY == "pj" && in_array($status_key,array("3-4")) &&  $settings['job_buyer_id'] == $userdata->ID )  || 
		
		(THEME_KEY != "pj" && $settings['job_'.$status_types['user'].'_id'] == $userdata->ID )
		
		 ){ ?>
         
        
        
         <?php if($status_key == "1-0"){  ?> 
         
			 <button data-ppt-btn class=" btn-outline-dark btn-block" type="button"><i class="fa fa-spinner fa-spin text-muted mr-2"></i> 
                <?php  echo __("Waiting","premiumpress"); ?>
                </button>  
                
		 <?php }elseif($status_key == "1-1"){ ?> 
          
         <?php }elseif($status_key == "3-1"){ ?>
          
        
            <?php if(_ppt(array('escrow', 'enable_escrow')) == '1' || user_can($settings['job_seller_id'], 'administrator')    ){ // ?>
       
           <button data-ppt-btn class=" btn-primary btn-block" onclick="processNewPayment('#escrow_<?php echo $settings['pid']; ?>');">
		   <?php echo __("Pay Now","premiumpress"); ?>
           </button>
           
         
            
            <input type="hidden" id="escrow_<?php echo $settings['pid']; ?>" value="<?php 
                      
                      
               if(!isset($data['order_description'])){ $data['order_description'] = ""; }
			   
			 
               
               echo $CORE->order_encode(array(   
                "uid" 			=> $userdata->ID, 
                "amount" 		=> $settings['order_total'],     	
                "order_id" 		=> "ESCROW-".$settings['payment_id']."-".$settings['pid']."-".$settings['job_post_id'],   	 
                "description" 	=> "ESCROW #".$settings['payment_id']."-".$settings['pid']."-".$settings['job_post_id'],   	
                "recurring" 	=> 0,   	
                "couponcode" 	=> 0,   
				"hidecouponbox" => 1, 								
               ) ); 
                        
               ?>" />
              
           
           
           <?php }else{ ?>
            
              
              <button data-ppt-btn class=" btn-primary btn-block confirm list" type="button" onclick="ajax_userpay<?php echo $uid; ?>();">
              <?php  echo __("Continue","premiumpress"); ?>
              </button>             
              
              
            <!--msg model -->
            <div class="extra-modal-wrap shadow hidepage"><div id="extra-modal-wrap-ajax"></div></div>
 
              
              
              
              <?php } ?>
              
         
         
         <?php }elseif($status_key == "3-2"){ ?>
             
            <button data-ppt-btn class=" btn-primary btn-block confirm list" type="button" onclick="ajax_offer<?php echo $uid; ?>(<?php echo ($settings['offer_complete'])+1; ?>); jQuery(this).prop('disabled', true);">
              <?php  echo __("Set Delivered","premiumpress"); ?>
              </button>
              
              <?php if(_ppt(array('escrow', 'enable_escrow')) != 1 && !user_can($settings['job_seller_id'], 'edit_posts')){  ?>
              
              <button data-ppt-btn class=" btn-outline-dark btn-block confirm list" type="button" onclick="ajax_offer<?php echo $uid; ?>(<?php echo ($settings['offer_complete'])-1; ?>); jQuery(this).prop('disabled', true);">
              <?php  echo __("Payment Not Received","premiumpress"); ?>
              </button> 
              <?php } ?>
         
			<?php }elseif($status_key == "3-3"){ ?>
            
            
            <button data-ppt-btn class=" btn-primary btn-block confirm list" type="button" onclick="ajax_offer<?php echo $uid; ?>(<?php echo ($settings['offer_complete'])+1; ?>); jQuery(this).prop('disabled', true);">
              <?php  echo __("Approve","premiumpress"); ?>
              </button>
              
              <button data-ppt-btn class=" btn-outline-dark btn-block confirm list" type="button" onclick="ajax_offer<?php echo $uid; ?>(<?php echo ($settings['offer_complete'])-1; ?>); jQuery(this).prop('disabled', true);">
              <?php  echo __("Decline","premiumpress"); ?>
              </button> 
            
            
            <?php }else{ ?>
        
            
              
              <button data-ppt-btn class=" btn-primary btn-block confirm list" type="button" onclick="ajax_offer<?php echo $uid; ?>(<?php echo ($settings['offer_complete'])+1; ?>); jQuery(this).prop('disabled', true); jQuery(this).prop('onclick', null).off('click');">
              <?php  echo __("Continue","premiumpress"); ?>
              </button>
               
              
              <?php } ?> 
          
          
        
		<?php }else{ ?>
        
        
        
        
        
        <?php if($status_key == "1-0" && $settings['job_seller_id'] == $userdata->ID && THEME_KEY != "at"){ ?>
         
          <select id="<?php echo $uid; ?>_b" class="form-control mb-2">
                      
            <option value="3" <?php echo selected(  $settings['offer_status'], 3); ?>><?php echo __("Accept","premiumpress"); ?></option>
            <option value="2" <?php echo selected(  $settings['offer_status'], 2); ?>><?php echo __("Reject","premiumpress"); ?></option>
            
          </select>
          
          <?php if(in_array(THEME_KEY, array("mj"))){  ?>
          <p class="small mt-3"><?php echo __("Reject order will issue buyer a refund.","premiumpress"); ?></p>
          <?php } ?>
          
            <button data-ppt-btn class=" btn-dark btn-block offerbtnaccept" type="button" onclick="ajax_offer<?php echo $uid; ?>(jQuery('#<?php echo $uid; ?>_b').val()); jQuery(this).prop('disabled', true);"><?php echo __("Update","premiumpress"); ?></button>
         
         <?php }else{ ?>
         
          <button data-ppt-btn class=" btn-outline-dark btn-block" type="button"><i class="fa fa-spinner fa-spin text-muted mr-2"></i> 
                <?php  echo __("Waiting","premiumpress"); ?>
                </button> 
                
                <?php } ?>
        
        
     
        
        <?php } ?>
           
        </div>
        
        <?php if($status_key == "1-0" && THEME_KEY == "mj" && $settings['job_buyer_id'] == $userdata->ID ){  ?>
        
        <div class="col-12">
        
        <hr />
        
        <div class="fs-7">
        
	<div class="alert alert-warning p-3 mt-4">
	<div class="d-flex">
	<div class="ml-3"> 

<div ppt-icon-48 data-ppt-icon-size="48" class="float-left mr-4 ml-2 pb-3 mt-2 hide-mobile">
              <?php  echo $CORE_UI->icons_svg['bell'];  ?>
            </div>

</div>

	<div class="ml-3">
    
    <div><?php echo __("The seller has 5 days to accept/decline this order otherwise the payment will be refunded to your account.","premiumpress"); ?></div>
    
    <div class="mt-2 text-600"> <?php $vv = $CORE->date_timediff(date("Y-m-d H:i:s", strtotime( $settings['order_date'] . " + 5 days") ), date("Y-m-d H:i:s"));
		 
		 echo str_replace("%s",$vv['string'],__(" Time remaining: %s","premiumpress")); ?></div>
          
        </div>
</div> 
        </div>
        
        </div>
        </div>
        <?php } ?>
        
        
        
    </div>
</div>
<?php  } } ?>

<?php if($status_key == "1-0" && $settings['job_seller_id'] == $userdata->ID ){ $cc = get_the_content($settings['pid']); if(strlen($cc) > 2){   ?>

<div class="small mb-3"><?php echo __("Comments","premiumpress"); ?></div>
<div class="border pt-3 pl-3 rounded"><?php echo wpautop($cc); ?></div>

<?php } } ?>
  
  
  
  
  
  
  
  
  
  
  
  
 
<script>

function ajax_userpay<?php echo $uid; ?>(){ 


       jQuery.ajax({
        type: "POST",
        url: ajax_site_url,		
   		data: {
               action: "load_payuser_form",  
			   	job_id: <?php echo $settings['pid']; ?>,
				listing_id: <?php echo $settings['job_post_id']; ?>,					
				seller_id:  <?php echo $settings['job_seller_id']; ?>,
				buyer_id: <?php echo $settings['job_buyer_id']; ?>,
				uid: "<?php echo $uid; ?>",  	
				offer_complete: "<?php echo $settings['offer_complete']; ?>",
				amount:	 "<?php echo $settings['order_total']; ?>", 
				 
           },
           success: function(response) { 
		    	
				jQuery(".extra-modal-wrap").fadeIn(400);
				jQuery(".extra-modal-wrap").addClass('pt-5');
				
   				jQuery('#extra-modal-wrap-ajax').html(response);			
				 
   			
           },
           error: function(e) {
               console.log(e)
           }
       });

	 


}


function ajax_offer<?php echo $uid; ?>(g){ 

 
		if(confirm("<?php echo trim(__("Are you sure?","premiumpress")); ?>"))
		{
		   
		jQuery('.offerbtnaccept').attr('disabled', true);
		
			jQuery.ajax({
				type: "POST",
				url: '<?php echo home_url(); ?>/',	
				dataType: 'json',	
				data: {
					single_action: "<?php echo $settings['ajax']; ?>",
					
					job_id: <?php echo $settings['pid']; ?>,
					listing_id: <?php echo $settings['job_post_id']; ?>,
					
					seller_id:  <?php echo $settings['job_seller_id']; ?>,
					buyer_id: <?php echo $settings['job_buyer_id']; ?>, 
					
					offer_status: g, 
					  
				},
				success: function(response) {
		 
					if(response.status == "ok"){
						 
						 window.location.href = "<?php echo _ppt(array('links','account'))."?showtab=offers"; ?>";
					
					}else{			
						console.log("Error updating offer.");			
					}			
				},
				error: function(e) {
					console.log(e)
				}
			});
			
	
	}
		else
		{		 
			e.preventDefault();
		}
	 
	
}

 
</script>