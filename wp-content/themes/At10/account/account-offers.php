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

global $CORE, $userdata, $post, $settings; 

 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
if(is_admin() && isset($_GET['eid']) && is_numeric($_GET['eid'])){
$thisuserID = $_GET['eid'];
}else{
$thisuserID = $userdata->ID;
}
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$listng_data = $CORE->USER("count_user_listings", $thisuserID);

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
$statusArray = array(

"3" 	=> 0,  //accepted
"2" 	=> 0,  //Rejected
"1" 	=> 0, // Pending
"4" 	=> 0,  // finished
"total" => 0 
);

$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
                     
                     $args = array(
                        'post_type' 		=> 'ppt_offer',
                        'posts_per_page' 	=> 100,
                        'paged' 			=> $paged,
                     	'post_status'		=> 'publish',
						 'meta_query' => array(	
							 'relation'    => 'AND',					
								 array(							
									 'relation'    => 'OR',											 
									 'user1'    => array(
									 'key' => 'buyer_id',
									 'compare' => '=',
									 'value' => $thisuserID,							 			
								),			 
									 'user2'   => array(
									 'key'     => 'seller_id',							
									 'compare' => '=',
									 'value' => $thisuserID,	                     
								 ),						
							 ),	
						 ),
                     );					
$wp_query = new WP_Query($args); 
// COUNT EXISTING ADVERTISERS	 
 
$tt = $wpdb->get_results($wp_query->request, OBJECT);
if(!empty($tt)){
	$i=1; $post_id_array = array();
	foreach($tt as $p){
			
			$offer_status = get_post_meta($p->ID,'offer_status',true);	
			if(in_array($offer_status,array(1,2,3,4))){	
			
					if($offer_status  == 3 ){	
					 	
						$job_buyer_id = get_post_meta($p->ID,'buyer_id',true);
						$feedback_date_buyer = get_post_meta($p->ID,'feedback_date_buyer',true);		
						$feedback_date_seller = get_post_meta($p->ID,'feedback_date_seller',true);	
						
						if($job_buyer_id == $thisuserID){								
								$feedback_date  = $feedback_date_buyer;
						}else{
								$feedback_date  = $feedback_date_seller;
						}
						
						if($feedback_date != ""){
						$statusArray[4]++;
						}else{
						$statusArray[3]++;
						}
						
					}else{
					$statusArray[$offer_status]++;
						
					} 
			
				$statusArray["total"]++;
			}
			
			 
	}
}


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
// DEFAULTS
$txt1 = __("Accepted","premiumpress") ;
$txt2 = __("Pending","premiumpress");
$txt3 = __("Rejected","premiumpress");
$txt4 = __("Finished","premiumpress");

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

// AT
if(THEME_KEY == "at"){ 

	$txt1 = __("Won/Sold","premiumpress") ;
	$txt2 = __("Bidding","premiumpress");
	$txt3 = __("Lost","premiumpress");
}

// MJ
if(THEME_KEY == "mj"){		
	$txt1 = __("In Progress","premiumpress");
}

// RT
if(THEME_KEY == "rt"){		
	$txt1 = __("Confirmed Viewings","premiumpress");
	$txt2 = __("Pending","premiumpress");
	$txt3 = __("Cancelled","premiumpress");
}

// DL
if(THEME_KEY == "dl"){		
	$txt2 = __("Under Offer","premiumpress");
}
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


 
?>


<div class="fs-lg text-600 mb-4"><?php echo str_replace("%d", $CORE->LAYOUT("captions","offers"), __("My %d","premiumpress")); ?></div>
   
<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
?>

<div class="col-md-4 px-0 mb-3">
<select class="form-control mt-4" onchange="showoffers(this.value);">

<option value="all"><?php echo __("All","premiumpress") ?> (<?php echo $statusArray['total']; ?>)</option>

<option value="3"><?php echo $txt1; ?> (<?php echo $statusArray['3']; ?>)</option>
<option value="2"><?php echo $txt3; ?> (<?php echo $statusArray['2']; ?>)</option>
<option value="1"><?php echo $txt2; ?> (<?php echo $statusArray['1']; ?>)</option>
<option value="4"><?php echo $txt4; ?> (<?php echo $statusArray['4']; ?>)</option>
 

</select>
</div>
 
<input type="hidden" id="showhidesolditems" value="0" />

 
<div>
<div>
<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
?>
<div id="accordionOrders">

<?php	

if(!empty($tt)){
	$i=1; $post_id_array = array();
	foreach($tt as $p){
					 
					 
					 
$post = get_post($p->ID);
 
$main_offer_post_id = $post->ID;
					 	
// GET BUYER ID
$job_buyer_id = get_post_meta($p->ID,'buyer_id',true);
if($job_buyer_id == ""){ $job_buyer_id =0;}
                     
$job_seller_id = get_post_meta($p->ID,'seller_id',true);
if($job_seller_id == ""){ $job_seller_id = 0; }
                     
// GET POST ID FOR JOB
$offer_status = get_post_meta($p->ID,'offer_status',true);
  
 					 
// GET POST ID FOR JOB
$job_post_id = get_post_meta($p->ID,'post_id',true);					
if(isset($post_id_array[$job_post_id]) && THEME_KEY == "at" && $offer_status == 1){ continue; }		

if($job_seller_id == $thisuserID && THEME_KEY == "at" && $offer_status == 2){ continue; }				
$post_id_array[$job_post_id] = $job_post_id; 


// CHECK TITLE EXISTS
$job_post_title = get_the_title($job_post_id);
if($job_post_title == ""){
	
	wp_delete_post($p->ID, true);

 }

/*****************************************/
					 
					 
				
                   
// GET POST ID FOR JOB
$order_total = 0; $order_id = "";
if(get_post_meta($p->ID,'order_id',true) != ""){
$order_total = $CORE->ORDER("get_order_total", get_post_meta($p->ID,'order_id',true));

	$payment_data = $CORE->ORDER("get_order", get_post_meta($p->ID,'order_id',true));
	$payment_status = $CORE->ORDER("get_status", $payment_data['order_status']);
	
	$order_id = get_post_meta($p->ID,'order_id',true);
	  
	  
}

if($order_total == "0"){ // THIS IS BECAUSE OF BUY NOW OPTION, NO PAYMENT ORDER IS MADE

$order_total = get_post_meta($main_offer_post_id, 'price', true);
 $settings['payment_status'] 	= __("Pending","premiumpress");
	   
}
 
// CHECK FOR ESCROW SYSTEM
if($order_total == 0 && _ppt(array('cashout', 'enable_escrow')) == '1'){  

 switch(THEME_KEY){
	  
		  case "at": {
		  
		  		$current_price = get_post_meta($job_post_id,'price_current',true);
				if(!is_numeric($current_price)){ $current_price = 0; }
				 
				$order_total = $current_price;
				$payment_status = array( "name" =>  __("Pending","premiumpress") );
		  
		  
		  } break;
		  
		  case "dl":
		  case "ct": {
		  		  
		  		$order_total = get_post_meta($job_post_id, "price", true); 
				$payment_status = array( "name" =>  __("Pending","premiumpress") );
				
				 
		  } break;
		  
		  default:{ 	
		   
		  
			 
		  
		  } break;
	  }

}

 			

// CHECK IF FUNDS PAID
$job_donedate = get_post_meta($p->ID,'jobdone',true);
               
					 
// PAYMENT ID
$payment_id = "";
$offer_complete = 0;
$order_status = "";
if($offer_status == 3 && !in_array(THEME_KEY, array("da"))){ // OFFER ACCEPTED
 
	// ORDER ID
	$job_orderid = get_post_meta($p->ID,'invoice_id',true);
	 
	if($job_orderid == ""){
		
		$job_orderid = get_post_meta($p->ID,'order_id',true);	
		 
		 
		$job_payment_status = get_post_meta($job_orderid,'order_status',true);		
		$offer_complete = get_post_meta($p->ID, "offer_complete", true);		 
		
		// SET JOB COMPLETE IF ESCROW PAYMENT WAS MADE
		if(( $offer_complete == "" || $offer_complete ==1 ) && $job_payment_status == 1){
			$offer_complete =2;
		}elseif($offer_complete == ""){
			$offer_complete = 1;
		}
		  
		 
	}

	$payment_id = get_post_meta($p->ID, "payment_id", true); 
	if($payment_id != ""){
					   
		$odata = $CORE->ORDER("get_order", $payment_id);
	 		 					
		$odata_status = $CORE->ORDER("get_status", $odata['order_status']);
		if(isset($odata_status['name'])){
		$order_status =  $odata_status['name'];
		}
	}
	
	// PAYMENT COMPLETED
	$payment_complete = get_post_meta($p->ID, "payment_complete", true); 

					  
}
 
// FEEDBACK FORM EXTRAS
$feedback_date = "";
if($offer_status  == 3 && !in_array(THEME_KEY, array("da"))){	
	 
	$feedback_date_buyer = get_post_meta($p->ID,'feedback_date_buyer',true);		
	$feedback_date_seller = get_post_meta($p->ID,'feedback_date_seller',true);	
	
	if($job_buyer_id == $thisuserID){
			
			$feedback_date  = $feedback_date_buyer;
	}else{
			$feedback_date  = $feedback_date_seller;
	}
	
	$_GET['pid'] 		= $job_post_id;
	$_GET['extraid'] 	= $p->ID;
	$_GET['buyerid'] 	= $job_buyer_id;
	$_GET['sellerid'] 	= $job_seller_id;
						    
}


if($offer_status  == 3 && in_array(THEME_KEY, array("da"))){

$offer_complete = 3;

}

/*******************************************/

if(THEME_KEY == "at"){ global $CORE_AUCTION;

	// EXPIRY DATE
	$expiry_date = get_post_meta($job_post_id,'listing_expiry_date',true);
	$vv = $CORE->date_timediff($expiry_date);
	if($vv['expired'] == 1){ $expiry_date = ""; }
	
	// HIGHEST BIDDER
	$hbid =  $CORE_AUCTION->get_highest_bidder($job_post_id);
	 
	if($vv['expired'] == 1){
		$hbid = $CORE_AUCTION->_get_winner($job_post_id);
		 
		if( $hbid['reserve_met'] == "no" ){
		
			continue;
		
		}	
	}

}
/*******************************************/


if(in_array(THEME_KEY, array("mj"))){ 

$txt1 = __("You paid for","premiumpress");
$txt2 = __("Item ordered","premiumpress");
 
$txt3 = __("New Order","premiumpress");
$txt4 = __("Wating Responce","premiumpress");
$txt5 = __("Mark Completed","premiumpress");

$txt6 = __("Order Received","premiumpress");
$txt7 = __("Accept/Decline","premiumpress");
$txt8 = __("Receive Payment","premiumpress");

}elseif(in_array(THEME_KEY, array("at"))){ 

$txt1 = __("You bid on","premiumpress");
$txt2 = __("Bidders for item","premiumpress");
 
$txt3 = __("New Bid","premiumpress");
$txt4 = __("Auction Ended","premiumpress");
$txt5 = __("Make Payment","premiumpress");

$txt6 = __("New Bid","premiumpress");
$txt7 = __("Auction Ended","premiumpress");
$txt8 = __("Receive Payment","premiumpress");

}elseif(in_array(THEME_KEY, array("jb"))){ 

$txt1 = "";
$txt2 = __("Job title","premiumpress");
 
$txt3 = __("Application Sent","premiumpress");
$txt4 = __("Wait for Responce","premiumpress");
$txt5 = __("Setup Interview","premiumpress");

$txt6 = __("Application Received","premiumpress");
$txt7 = __("Accept/Decline","premiumpress");
$txt8 = __("Setup Interview","premiumpress");

}elseif(in_array(THEME_KEY, array("rt"))){ 

$txt1 = __("Viewing request for","premiumpress");
$txt2 = __("Viewing request for","premiumpress");
 
$txt3 = __("Submit Request","premiumpress");
$txt4 = __("Wait for Responce","premiumpress");
$txt5 = __("Setup Viewing","premiumpress");

$txt6 = __("Viewing Request","premiumpress");
$txt7 = __("Accept/Decline","premiumpress");
$txt8 = __("Setup Viewing","premiumpress");

}elseif(in_array(THEME_KEY, array("da"))){ 

$txt1 = __("I requested access to","premiumpress");
$txt2 = __("Access request received for","premiumpress");
 
$txt3 = __("Request Sent","premiumpress");
$txt4 = __("Wating Responce","premiumpress");
$txt5 = __("Access Granted","premiumpress");

$txt6 = __("Requested Received","premiumpress");
$txt7 = __("Accept/Decline","premiumpress");
$txt8 = __("Access Granted","premiumpress");


}elseif(in_array(THEME_KEY, array("ll"))){ 

$txt1 = __("You applied for","premiumpress");
$txt2 = __("%user applied for","premiumpress");
 
$txt3 = __("New Applicaton","premiumpress");
$txt4 = __("Course Ended","premiumpress");
$txt5 = __("Make Payment","premiumpress");

$txt6 = __("New Application","premiumpress");
$txt7 = __("Course Ended","premiumpress");
$txt8 = __("Receive Payment","premiumpress");


}else{

$txt1 = __("You bid on","premiumpress");
$txt2 = __("Your item","premiumpress");

$txt3 = __("Offer Sent","premiumpress");
$txt4 = __("Wating Responce","premiumpress");
$txt5 = __("Make Payment","premiumpress");
$txt6 = __("Offer Received","premiumpress");
$txt7 = __("Accept/Decline","premiumpress");
$txt8 = __("Receive Payment","premiumpress");
  
}

// CHECK IF ITS MY OWN JOB
$isownjob = "";
$isownjob_top = "";
if($job_buyer_id == $thisuserID){
$isownjob_top = "item-buy";
}else{
$isownjob = "ownpost";
$isownjob_top = "item-sell";
} 

 

?>


  
    
    <script>
	function ajax_chat_logs_<?php echo $post->ID; ?>_show(){
		
		if(jQuery("#ajax_chat_logs_<?php echo $post->ID; ?>").length > 0){
		 
		ajax_chat_logs_<?php echo $post->ID; ?>();
		}
	}
	
	</script>

<div ppt-border1

onclick="ajax_chat_logs_<?php echo $post->ID; ?>_show();"   data-toggle="collapse" data-target="#collapse<?php echo $post->ID; ?>" aria-controls="collapse<?php echo $post->ID; ?>"

class="cursor bg-white mb-4 p-3 newoffer <?php echo $isownjob_top." "; if($offer_status == 3 && $feedback_date != ""){ echo "card-job-4 card-job-finished"; }else{ ?>card-job-<?php echo $offer_status; ?><?php } ?> card-postid-<?php echo $job_post_id; ?> " id="offer-card-<?php echo $main_offer_post_id; ?>">
  <div class="row" id="heading<?php echo $post->ID; ?>">


<?php
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
    <div class="col-12 col-md-7 col-lg-7">
    
      <div class="float-left img-list mr-3"> <?php echo str_replace("data-","",do_shortcode('[IMAGE pid="'.$job_post_id.'"]'));  ?> </div>
      
     
      <div class="text-600"><?php echo $job_post_title; ?></div>  
    
    </div>
    
<?php
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
    <div class="col-12 col-lg-2">
    
    
        <?php if($offer_status == 1 || $offer_status == ""){ ?>
        
        <?php if(THEME_KEY == "at"){ 
		
		// GET CURRENT PRICE
					  $current_price = get_post_meta($job_post_id,'price_current',true);
					  if(!is_numeric($current_price)){ $current_price = 0; }
		
		?>
        
       <div class="font-weight-bold job-pending <?php echo $CORE->GEO("price_formatting",array()); ?> <?php echo $isownjob; ?>"><?php echo hook_price($current_price); ?></div>
       <div class="small opacity-5"><?php echo __("Current price","premiumpress"); ?></div>
    	
       
        <?php }else{ ?>
        <span class="badge badge-info job-pending <?php echo $isownjob; ?>"><?php echo __("Pending","premiumpress"); ?></span>
        
		<?php } ?>
        
      
     	<?php if($job_buyer_id == $thisuserID ){ ?>       
       <?php if($listng_data['total'] > 0 ){ ?>
       <?php if(in_array(THEME_KEY, array("mj","at","ct","dl"))){ ?>          
        <span class="small badge badge-primary"><?php echo __("buying","premiumpress"); ?></span>        
        <?php }else{ ?>        
         <div class="small opacity-5"><?php echo $txt1; ?></div>
        <?php } ?>  
        <?php } ?>
            
        <?php }else{ ?>        
        
         <?php if(in_array(THEME_KEY, array("mj","at","ct","dl"))){ ?>
        <spa class="small badge badge-success"><?php echo __("selling","premiumpress"); ?></span>
        <?php }else{ ?>
        <div class="small  opacity-5"><?php echo str_replace("%user", $CORE->USER("get_username", $job_buyer_id ),$txt2); ?></div>  
        <?php } ?>        
        <?php } ?>
      
        
        
        
        
        
        
        <?php }elseif($offer_status == 2){ ?>
        
        <span class="badge badge-danger job-rejected <?php echo $isownjob; ?>"><?php if(THEME_KEY == "at"){ echo __("Lost","premiumpress"); }else{ echo __("Rejected","premiumpress"); } ?>
  
        </span>
        
        <?php }elseif($offer_status == 3  && $feedback_date != ""){ 
		
				$cxtag = "";
				if(THEME_KEY == "at"){ 
				
					if($job_buyer_id == $thisuserID){ 
					
						$cxtag = "at-won";
					}else{
					
						
						$cxtag = "at-sold";
					} 
				
				}
		
		?>
        
        <div> <span class="badge badge-dark job-finished <?php echo $isownjob; ?> <?php echo $cxtag; ?>"> <i class="fa fa-heart" aria-hidden="true"></i> <?php echo __("Complete","premiumpress"); ?></span> </div>
        
        <?php }elseif($offer_status == 3){ 
		
		$cxtag = "";
		if(THEME_KEY == "at"){ 
				
				if($job_buyer_id == $thisuserID){ 
					$ctx =  __("Won","premiumpress"); 
					$cxtag = "at-won";
				}else{
				
					$ctx = __("Sold","premiumpress"); 
					$cxtag = "at-sold";
				} 
		
		}else{ $ctx = __("Accepted","premiumpress"); }
		
		?>
        
        <div class=" float-right"> <span class="badge badge-success job-approved <?php echo $cxtag; ?> <?php echo $isownjob; ?>"> <?php echo $ctx; ?> </span> </div>
          
        <?php } ?> 
       
    </div>
   
   
   
   
   
   
<?php
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
   
    <div class="col hide-ipad hide-mobile text-center text-600">
    
    
    
    <?php if(get_post_meta($job_post_id ,'listing_expiry_date', true) != ""){ ?>
    
    
   <div class="font-weight-bold"><?php echo do_shortcode('[TIMELEFT postid="'.$job_post_id .'" layout="1" text_before="" text_ended="Not Set" key="listing_expiry_date"]'); ?></div>
   <div class="small opacity-5"><?php echo __("Time left","premiumpress"); ?></div>
    
      
      
      <?php }else{ ?> 
             
      <?php
	  
	  switch(THEME_KEY){
	  
		  case "at": {
		  
		  		$current_price = get_post_meta($job_post_id,'price_current',true);
				if(!is_numeric($current_price)){ $current_price = 0; }
				
				// GET SHIPPING OST
			   $price_shipping = get_post_meta($job_post_id,'price_shipping',true);
			   if($price_shipping == "" || !is_numeric($price_shipping)){$price_shipping = 0; }
			   
			   if($price_shipping > 0){
			   $current_price = $current_price + $price_shipping;
			   $order_total =  $current_price;
			   }

				 
				echo '<div class="'.$CORE->GEO("price_formatting",array()).'">'.hook_price($current_price).'</div>';
		  
		  
		  } break;
		  case "jb": {
		  
		  } break;
		  
		  default:{ 	
		   
		  
			if(is_numeric($order_total) && $order_total > 0){ 
			
				echo '<div class="'.$CORE->GEO("price_formatting",array()).'">'.hook_price($order_total).'</div>';			 
			}
		  
		  } break;
	  }
	   
	 
	  } ?>
    
    
      
    </div>
 
   
  
  </div>
</div>


 
  
<div id="collapse<?php echo $post->ID; ?>" class="collapse rounded-0 collapse-postid-<?php echo $job_post_id; ?>" data-parent="#accordionOrders">

   
      <div class="container-fluid px-0">
      
      <div class="row">
      
     
      
      <?php if(is_admin()){ ?>
      <div class="col-12 text-right">     
     
        <a href="<?php echo home_url(); ?>/wp-admin/admin.php?page=orders&eid=<?php echo $order_id;?>" data-ppt-btn class=" btn-system bt-md mr-2 float-left" target="_blank"> <i class="fa fa-file"></i>  <?php echo __("Edit Order","premiumpress"); ?></a>
     
       <button type="button" data-ppt-btn class=" btn-system bt-md mr-2" onclick="ajax_single_offer_close_<?php echo $post->ID; ?>()"><i class="fa fa-sync"></i>  <?php echo __("Close","premiumpress"); ?></button>
      
      <?php if(THEME_KEY == "mj"){ ?>
      
        <button type="button" data-ppt-btn class=" btn-system bt-md mr-2" onclick="ajax_single_offer_refund_<?php echo $post->ID; ?>()"><i class="fa fa-sync"></i>  <?php echo __("Refund","premiumpress"); ?></button>
      
      <?php } ?>
       
        
        <button type="button" data-ppt-btn class=" btn-system bt-md" onclick="ajax_single_offer_delete_<?php echo $post->ID; ?>()"><i class="fa fa-trash"></i> <?php echo __("Delete","premiumpress"); ?></button>
      
      
      <script>
	  
	   function ajax_single_offer_close_<?php echo $post->ID; ?>(){ 
 
	jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',	
		dataType: 'json',	
		data: {
            single_action: "offer_close",
			
			job_id: <?php echo $p->ID; ?>,
			listing_id: <?php echo $job_post_id; ?>,
			
			seller_id:  <?php echo $job_seller_id; ?>,
			buyer_id: <?php echo $job_buyer_id; ?>, 
			  
        },
        success: function(response) {
 
			if(response.status == "ok"){
			 	 
				 //jQuery('#offer-card-<?php echo $main_offer_post_id; ?>').hide();
				 
				 jQuery('#collapse<?php echo $post->ID; ?>').hide();
  		 	
			}else{			
				console.log("Error trying to add.");			
			}			
        },
        error: function(e) {
            console.log(e)
        }
    });  
 
  }
	  
	   function ajax_single_offer_refund_<?php echo $post->ID; ?>(){ 
 
	jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',	
		dataType: 'json',	
		data: {
            single_action: "offer_refund",
			
			job_id: <?php echo $p->ID; ?>,
			listing_id: <?php echo $job_post_id; ?>,
			
			seller_id:  <?php echo $job_seller_id; ?>,
			buyer_id: <?php echo $job_buyer_id; ?>, 
			  
        },
        success: function(response) {
 
			if(response.status == "ok"){
			 	 
				 //jQuery('#offer-card-<?php echo $main_offer_post_id; ?>').hide();
				 
				 jQuery('#collapse<?php echo $post->ID; ?>').hide();
  		 	
			}else{			
				console.log("Error trying to add.");			
			}			
        },
        error: function(e) {
            console.log(e)
        }
    });  
 
  }
	  
	  function ajax_single_offer_delete_<?php echo $post->ID; ?>(){ 
 
	jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',	
		dataType: 'json',	
		data: {
            single_action: "offer_delete",
			
			job_id: <?php echo $p->ID; ?>,
			listing_id: <?php echo $job_post_id; ?>,
			
			seller_id:  <?php echo $job_seller_id; ?>,
			buyer_id: <?php echo $job_buyer_id; ?>, 
			  
        },
        success: function(response) {
 
			if(response.status == "ok"){
			 	 
				 jQuery('#offer-card-<?php echo $main_offer_post_id; ?>').hide();
				 
				 jQuery('#collapse<?php echo $post->ID; ?>').hide();
  		 	
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
      
      <hr />
      
      
      </div>
      
      
      
      <?php } ?>
      
  	<div class="col-md-12">
         <?php 
		 		
				 
			   
			  global $settings; 
			  
			  $settings['pid'] 				= $p->ID;
			  $settings['offer_complete'] 	= $offer_complete;
			  $settings['offer_status'] 	= $offer_status;			  
			  $settings['job_post_id'] 		= $job_post_id;
			  $settings['job_seller_id'] 	= $job_seller_id;
			  $settings['job_buyer_id'] 	= $job_buyer_id; 
			  $settings['order_id'] 		= $order_id;			  
			  $settings['order_total'] 		= $order_total;
			  $settings['order_date'] 		= $post->post_date;
			  $settings['payment_id'] 		= $payment_id;			  
			  $settings['feedback_date'] 	= $feedback_date;
			  
			  $settings['offer_id'] = $main_offer_post_id;
			  
			  if(isset($payment_status['name'])){
			  $settings['payment_status'] 	= $payment_status['name'];
			  }
			  
			  // STATUS KEY
			   $status_key = $settings['offer_status']."-".$settings['offer_complete'];
			   
//echo $status_key."<--";
			  
			  // IS THE OFFER ACCEPTED?
			  if($settings['offer_status'] == 3){
			  $settings['ajax'] 			= "offer_complete"; // ajax function name
			  }else{ 
			  $settings['ajax'] 			= "offer_update";
			  }			 
			  
			  // DISPLAY PRGRESS BOX
		  	  _ppt_template( 'framework/design/account/parts/_complete' );
			  
			  // DISPLAY CHAT BOX
			   
			  if($status_key == "3-5"){			  
			  _ppt_template( 'framework/design/account/parts/_feedback' );  			
			  }elseif($settings['offer_status'] == 3){				
			  _ppt_template( 'framework/design/account/parts/_chat' ); 
			  }
			
			 ?> 
        
        
        
        
        </div>
        <div class="col-12">  
		
        
        <?php
		
		  	global $settings;
			  
			  $settings['pid'] 				= $p->ID;
			  $settings['offer_complete'] 	= $offer_complete;
			  $settings['offer_status'] 	= $offer_status;
			  
			  $settings['job_post_id'] 		= $job_post_id;
			  $settings['job_seller_id'] 	= $job_seller_id;
			  $settings['job_buyer_id'] 	= $job_buyer_id;
			  
			  
			  $settings['order_total'] = $order_total;
			  $settings['order_date'] = $post->post_date;
			  $settings['payment_id'] = $payment_id;
			  
			  if(isset($payment_status['name'])){
			  $settings['payment_status'] = $payment_status['name'];
			  }  
			   
		  	  _ppt_template( 'framework/design/account/parts/_details' ); 
			 
			  
			  ?>
     
     </div>
     </div>
      
 
</div>
 
</div><!-- end collapse -->


 

<?php  } ?>

<?php } ?>



</div>

<!-- end accordian -->
 
</div>
</div>

 
 
 
<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
?>
 
<div class="alter-all-box" <?php if(!empty($wp_query->posts)){ ?> style="display:none;"<?php } ?>> 
 
<div class="opacity-5"><?php echo str_replace("%d", strtolower($CORE->LAYOUT("captions","offers")), __("No %d found","premiumpress")); ?></div>

</div>
 
 
 



<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
?>

<script>

function showoffers(type){
				
					 
					//SwitchPage('offers');
					jQuery("#offersTabs .active").removeClass('active');
					jQuery(".showoffers-"+type+"-btn").addClass('active');
					
					
					jQuery('.collapse').removeClass('show');
				 				
					jQuery('.card-job-1').hide();
					jQuery('.card-job-2').hide();
					jQuery('.card-job-3').hide();
					jQuery('.card-job-finished').hide();
					
					jQuery('.card-job-' +type).show();
					jQuery(".alter-all-box").hide();
					
					if(type == "all"){ 
					
						jQuery('.card-job-1').show();
						jQuery('.card-job-2').show();
						jQuery('.card-job-3').show();
						jQuery('.card-job-finished').show();
					
					}else{
					
					 	if(jQuery('.card-job-'+type).length == 0){
							jQuery(".alter-all-box").show();
						} 
					} 
					
					// IF EMPTY
					if(jQuery('.newoffer').length == 0){
						jQuery(".alter-all-box").show();
					} 
				
		 }
			 

</script>

<?php if(isset($_GET['showoid']) && is_numeric($_GET['showoid']) ){ ?>
<script>
jQuery(document).ready(function(){ 

	if(jQuery("#ajax_chat_logs_<?php echo esc_attr($_GET['showoid']); ?>").length > 0){
	ajax_chat_logs_<?php echo esc_attr($_GET['showoid']); ?>_show();
	}
	
	//jQuery("#offer-card-<?php echo esc_attr($_GET['showoid']); ?>").removeClass('collapsed');
	//jQuery("#offer-card-<?php echo esc_attr($_GET['showoid']); ?> .collapse").addClass('show');
	
	
});
</script>
<?php } ?>

<?php if(isset($_GET['showpid']) && is_numeric($_GET['showpid']) ){ ?>
<script>
jQuery(document).ready(function(){ 

 
	var a = jQuery(".collapse-postid-<?php echo $_GET['showpid']; ?>");
    a.each(function (a) {
 
		//jQuery("#"+jQuery(this).attr("id")).show();
		 
		if(jQuery("#ajax_chat_logs_<?php echo esc_attr($_GET['showpid']); ?>").length > 0){
		
		ajax_chat_logs_<?php echo esc_attr($_GET['showpid']); ?>_show();
		
		} 

    }); 

});
</script>
<?php } ?>
