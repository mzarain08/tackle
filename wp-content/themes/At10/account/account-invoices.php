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
   
   $userid = $userdata->ID;
   
   if(is_admin() && isset($_GET['eid'])){   
   $userid = $_GET['eid'];
   }
   
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 

	// 1. GET THE USERS CREDIT
	$user_credit = get_user_meta($userdata->ID,'ppt_usercredit',true);
	$user_credit_bakup = $user_credit;
	if($user_credit == "" || !is_numeric($user_credit) ){ $user_credit = 0; $user_credit_bakup = 0; }
	
	// GET CASHOUT COUNT
	$cashouts = $CORE->USER("get_cashout_pending", $userdata->ID); 
 	 
	
	// MIN CASHOUT
	$mincashout = _ppt(array('cashout', 'min_amount'));
	if(!is_numeric($mincashout)){
	$mincashout = 0;
	}
	
	// 
	$showcashout = true;
	if( !$CORE->LAYOUT("captions","cashout") ){
	$showcashout = false;
	}
    
   // ORDERS
    $args = array(
      	'post_type' 		=> 'ppt_orders',
      	'posts_per_page' 	=> 100,
        'paged' 			=> 1,
		
			'meta_query' => array( 
				'user_id'    => array(
					'key' 			=> 'order_userid',	
					'type' 			=> 'NUMERIC',
					'value' 		=> $userid,
					'compare' 		=> '=',								 					 			
				),					 	
      		), 
		 
			
      );
      $wp_query1 = new WP_Query($args); 
      $orders = $wpdb->get_results($wp_query1->request, OBJECT);
	  
	 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

  // ORDERS
    $args = array(
      	'post_type' 		=> 'ppt_orders',
      	'posts_per_page' 	=> 100,
        'paged' 			=> 1,
		
			 
			
      	'meta_query' => array(
      		'relation'    => 'OR',												 
      									'seller_id'    => array(
      										'key' => 'seller_id',	
      										'type' 			=> 'NUMERIC',
      										'value' 		=> $userid,
      										'compare' 		=> '=',								 					 			
      									),			 
      									'buyer_id'   => array(
      										'key'     => 'buyer_id',							
      										'type' 			=> 'NUMERIC',
      										'value' 		=> $userid,
      										'compare' 		=> '=',															
      									),		
      	),
			
      );
      $wp_query2 = new WP_Query($args); 
      $payments = $wpdb->get_results($wp_query2->request, OBJECT);  
	  
	  $invoicesTotal = 0;
	  $unPaidCount = 0;
	 
	 
	  
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>

<div class="fs-lg text-600 mb-2"><?php echo __("Balance &amp; Invoices","premiumpress"); ?> </div>

<p class="mb-4"><?php echo __("Your account balance is","premiumpress") ?> <span class=" <?php if($user_credit_bakup < 0){ echo "text-danger"; } ?> <?php echo $CORE->GEO("price_formatting",array()); ?>"><?php echo hook_price($user_credit); ?></span>. <?php if($mincashout > 0 ){ echo str_replace(".00","",str_replace("%s",hook_price($mincashout),__("Minimum cashout is %s","premiumpress"))); } ?>  </p>
  
   
   
  <?php if(_ppt(array('credit','enable')) == "1"){ ?>
    
  <a href="javascript:void(0);" class="btn btn-primary mb-4" data-ppt-btn onclick="processCredit();"><?php echo __("Buy Credit","premiumpress"); ?></a>
  
  <?php } ?> 

<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if($user_credit < 0){ 
	
	
	$user_credit = str_replace("-","",$user_credit);
$payment_due = round($user_credit,2);
	
	?>
        <h5><?php echo __("Payment Due","premiumpress"); ?></h5>
        <p><?php echo __("Please make payment as soon as possible.","premiumpress"); ?></p>
        <hr />
        <div id="ajax_overdue_payment"></div>
        <div class="alert alert-danger" id="paymentnotice1x"> <b><span class="label label-danger"><?php echo __("Negative Amount Balance","premiumpress"); ?></span></b>
          <button class="btn btn-danger float-right mt-2" onclick="ajax_load_payment();"><?php echo __("Pay Now","premiumpress"); ?></button>
          <br />
          <small> <?php printf( __( 'Amount due %s. Please make payment as soon as possible.', 'premiumpress' ), '<span>' . hook_price($user_credit) . '</span>' );  ?> </small>
          <div class="clearfix"></div>
        </div>
        <script> 
   
   function ajax_load_payment(){
   
       jQuery.ajax({
           type: "POST",
           url: '<?php echo home_url(); ?>/',		
   		data: {
               action: "load_new_payment_form",
   			details:jQuery('#ppt_orderdata').val(),
           },
           success: function(response) {	
		   jQuery('#paymentnotice1').hide();		
   			jQuery('#ajax_overdue_payment').html(response);
   			
           },
           error: function(e) {
               console.log(e)
           }
       });
   
   }
</script>
        <input type="hidden" id="ppt_orderdata" value="<?php 

	 
   $couponcode = "";
   if(isset($_POST['couponcode'])){
   $couponcode = esc_attr($_POST['couponcode']);
   }
   
   echo $CORE->order_encode(array(
   
   	"uid" => $userdata->ID, 
   	"amount" => $payment_due, 
 
   	"order_id" => "CREDIT-".$userdata->ID."-".rand(),
   	 
   	"description" => __("Account Overdue Payment","premiumpress"),
   	
   	"recurring" => 0,
   	
   	"couponcode" => 0,
	
	"tax" => 0,
   
   								
   ) ); 
    		
   ?>" />

<?php }








// CASHOUT FORM
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if(_ppt(array("cashout","enable")) == "1"){

if(_ppt(array("cashout","cashout_hideform")) != 1 && $user_credit_bakup > 0 ){
	
	 
		
		if(!empty($cashouts)){ ?>
        
        <div class="alert alert-success" >
          <div class="font-weight-bold"><?php echo __("Request Sent","premiumpress"); ?></div>
          <div><?php echo __("Your cashout request has been sent. Please allow 24/48 hours for a responce.","premiumpress"); ?></div>
        </div>
        <?php   
		
}else{  ?> 

<a href="javascript:void(0);" onclick="jQuery('.cashoutformwrap').toggle();" class="btn-system mb-4" data-ppt-btn><?php echo __("Withdraw Funds","premiumpress"); ?></a>

<?php


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
<div class="cashoutformwrap" style="display:none">
<hr />
 
<div ppt-border1 class="p-3 mb-4">
<div class="text-600 fs-md mb-2"><?php echo __("Withdraw Funds","premiumpress"); ?></div>

<div class="cashoutformmsg">

<?php if($user_credit > $mincashout){ ?>

<?php echo __("Please complete the form below and one of our team will contact you back ASAP to arrange payment.","premiumpress"); ?>

<?php }else{ ?>

<?php echo __("You do not have enough funds to cashout just yet.","premiumpress"); ?> 

<?php } ?>
</div>
     
        <div class="alert alert-success" id="cashoutnew" style="display:none">
          <div class="font-weight-bold"><?php echo __("Request Sent","premiumpress"); ?></div>
          <div><?php echo __("Your cashout request has been sent. Please allow 24/48 hours for a responce.","premiumpress"); ?></div>
        </div>
        <div class="alert alert-warning" id="cashoutwaiting" <?php if($cashouts ==0){ ?>style="display:none"<?php } ?>>
          <div class="font-weight-bold"><?php echo __("You have a pending request","premiumpress"); ?></div>
          <div><?php echo __("Please wait for the current request to be completed before submitting a new request.","premiumpress"); ?></div>
        </div>
        <?php if($cashouts ==0 && $user_credit > $mincashout){ 
		
		
		$cashoutMsg =  get_user_meta($userdata->ID,"cashout-msg", true);
		$cashoutMethod = get_user_meta($userdata->ID,"cashout-method", true);
				
		
		?>
        <form  role="form" method="post" action="" onsubmit="return CheckFormData();" class="mt-3 ppt-forms style3" id="cashoutform">
          <input type="hidden" name="action" value="cashoutform" />
          <div class="row">
          
            
              <div class="col-md-6">
              
               <div class="my-3 text-600"><?php echo __("Payment Method","premiumpress"); ?></div>
              
              
              <select class="form-control" name="cashout-method" id="cashout-method" onchange="pdetails()">
              <option></option>
              
              <?php $i=1; while($i < 8){  if(strlen(_ppt(array('cashout', 'method'.$i))) > 1){ ?>
               <option value="<?php echo $i; ?>" <?php if($cashoutMethod == $i){ echo 'selected=selected'; } ?>><?php echo _ppt(array('cashout', 'method'.$i)); ?></option>
              <?php } $i++; } ?>
              
              </select>
              
              </div>
               <div class="col-md-6">
              
              <div class="my-3 text-600"><?php echo __("Amount","premiumpress"); ?></div>
              
              <div class="input-group" style="width:200px;"> <span class="input-group-prepend input-group-text rounded-0"><?php if(strpos( _ppt(array('currency','symbol')), "fa") === false){ echo hook_currency_symbol('');  }else{ echo '<i class="'._ppt(array('currency','symbol')).'"></i>'; } ?></span>
                <input type="text" class="form-control rounded-0" name="cashout-amount" id="cashout-amount"/>
              </div>
            </div>
            
            <div class="col-md-12" <?php if($cashoutMsg == ""){ ?>style="display:none;"<?php } ?> id="pdetails">
              <div class="text-600 my-3"><?php echo __("Payment Details","premiumpress"); ?></div>
              <textarea class="form-control rounded-0" name="cashout-message" id="cashout-message" style="height:150px!important;"><?php echo $cashoutMsg; ?></textarea>
              
              
              </div>
            
            
            
            <div class="col-md-12  my-4">
              <button class="btn-primary" type="submit" data-ppt-btn data-btn-submit><?php echo __("Request Cashout","premiumpress"); ?></button>
            </div>
          </div>
        </form>
        
        <script>
		
		function pdetails(){
			jQuery("#pdetails").show();
		}
		
		</script>
        
        <?php } ?>
</div>        
</div> 
<?php 
 
   } } }






// INVOICES TABLE	  
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>   

      <div id="ajax_makepayment_form"></div>
      <?php if(isset($_GET['paymentid']) ){ ?>
      <script> jQuery(document).ready(function(){   setTimeout(function(){  SwitchPage('orders'); }, 2000); }); </script>
      <?php } ?>
      <div class="card mb-5" id="myinvoicesform">
  
        <div class="card-body p-0">
          <?php
if(!empty($orders) || !empty($payments)){
?>
<div class="overflow-auto"> 
          <table class="table small table-orders">
            <thead>
              <tr>
                <th><?php echo __("Order ID","premiumpress"); ?></th>
                <th class="text-center"><?php echo __("Date","premiumpress"); ?></th>
                <th class="text-center"><?php echo __("Amount","premiumpress"); ?></th>
               
                <th class="text-center"><?php echo __("Status","premiumpress"); ?></th>
                <th class="text-center dashhideme"><?php echo __("Invoice","premiumpress"); ?></th>
              </tr>
            </thead>
            <tbody>
              <?php
		 
		 $mixa = array();
		 $data = array("1" => $orders, "2" => $payments );
		 foreach($data as $h){
		 
		 foreach($h as $order){ 
		 
		 	if(in_array($order->ID, $mixa)){ continue; }
	
				$mixa[$order->ID] = $order->ID;
		 
		  
		 $data = $CORE->ORDER("get_order", $order->ID);
		 
		 // SKIP IF IS FOR HOUSE COMISSION
		if(substr($data['order_id'], 0, 7) == "CREDIT-" && $data['order_userid'] != $userdata->ID){
		
			continue;		
		}
		
		$invoicesTotal ++;
		
		// NAME
		$name = "";
		if(isset($h['name'])){
		$name = $h['name'];
		}
		 
		 
		  // SELLER ID
          $seller_id = get_post_meta($order->ID,'seller_id',true);	  
          $buyer_id = get_post_meta($order->ID,'buyer_id',true);			       
           ?>
              <tr class="row-<?php echo $order->ID; ?>" <?php if(isset($_GET['invoice']) && $_GET['invoice'] == $order->ID){ ?>style="border:5px solid red"<?php } ?>>
                <td><span class="font-weight-bold">
                
                <a href="<?php echo home_url(); ?>/?invoiceid=<?php echo $order->ID; ?>" target="_blank">#<?php echo $CORE->ORDER("format_id", $order->ID ); ?></a>
                
                
                </span> </td>
                <td class="text-center text-muted"><?php echo hook_date($data['order_date']); ?></td>
                <td class="text-center"><?php echo hook_price($data['order_total']); ?></td>
            
                <td class="text-center">
				
				
				<?php $h = $CORE->ORDER("get_status", $data['order_status']); ?>
                
                
                <span class="inline-flex items-center font-weight-bold order-status-icon status-<?php echo $data['order_status']; ?>"> <span class="dot mr-2"></span> 
                <span><?php echo $h['name']; ?></span> </span>
                
                  
                  
                  
                   </td>
                  
                  
                <td class="text-center dashhideme"><a href="<?php echo home_url(); ?>/?invoiceid=<?php echo $order->ID; ?>" class="btn btn-system btn-sm" target="_blank"><?php echo __("Invoice","premiumpress"); ?></a>
                  <?php
				  
	 
			if( ( substr($data['order_id'], 0, 8) == "UPGRADE-" || substr($data['order_id'], 0, 6) == "CUSTOM" || substr($data['order_id'], 0, 7) == "CREDIT-" || substr($data['order_id'], 0, 4) == "LST-" ) &&  $data['order_status'] == 2){ 
			
			$unPaidCount++;
			
			 ?> 
            
            <script>jQuery(document).ready(function(){ jQuery("#dalist-5 i").addClass('text-danger'); }); </script>
            
                  <button class="btn btn-system btn-sm bg-warning " onclick="processNewPayment('#orderdatafor<?php echo $order->ID; ?>');"><?php echo __("Pay Now","premiumpress"); ?></button>
                  <input type="hidden" id="orderdatafor<?php echo $order->ID; ?>" value="<?php 
				  
				  
   if(!isset($data['order_description'])){ $data['order_description'] = ""; }
    
   echo $CORE->order_encode(array(   
   	"uid" => $userid, 
   	"amount" => $data['order_total'],     	
   	"order_id" => $data['order_id'],   	 
   	"description" => $data['order_description'],   	
   	"recurring" => 0,   	
   	//"couponcode" => 0,   	
	//"hidecouponbox" => 1, 							
   ) ); 
    		
   ?>" />
                  <script>
			
			 jQuery(document).ready(function(){ 
			jQuery('#notice-overduepayment').show();
			jQuery('#notice-accountdefault').hide();
			
			});
			
			</script>
                  <?php } ?>
                </td>
              </tr>              
              <?php  } } ?>
            </tbody>
          </table>
          </div>
       
          <?php } ?>
          
    
        </div>
      </div>
      
      
      
          <?php if(empty($orders) && empty($payments)){ ?>
          
          
<div class="my-4 bg-white rounded border p-5 text-center">
   <i class="fal fa-file fa-4x mb-4 text-light"></i>
   <h4><?php echo __("No invoices found","premiumpress"); ?></h4>
</div>
          <script>jQuery(document).ready(function(){ jQuery("#myinvoicesform").hide(); }); </script>
          
         
          <?php } ?>
          
          

<script>


jQuery(document).ready(function(){

jQuery(".count-invoices-total").html('<?php echo $invoicesTotal; ?>'); 
jQuery(".count-invoices-unpaid").html('<?php echo $unPaidCount; ?>'); 
 

jQuery(".count-balance").html("<?php echo hook_price($user_credit); ?>");

});




   function CheckFormData()
   { 
   	 
   	var amount = document.getElementById("cashout-amount");
   	var message = document.getElementById("cashout-message");	
    
   
   	if(message.value == '')
   	{
   		alert("<?php echo __("Please provide payment method details.","premiumpress") ?>");
   		message.focus();
		jQuery("#pdetails").show();
   		message.style.border = 'thin solid red';
   		return false;
   	} 		
   	
   
   	if(amount.value == '')
   	{
   		alert("<?php echo __("Please enter a valid amount.","premiumpress") ?>");
   		amount.focus();
   		amount.style.border = 'thin solid red';
   		return false;
   	} 
	
	  if(amount.value > <?php echo $user_credit; ?>)
   	{
   		alert("<?php echo __("Please enter a valid amount.","premiumpress") ?>");
   		amount.focus();
   		amount.style.border = 'thin solid red';
   		return false;
   	} 
	
	jQuery("[data-btn-submit]").prop('disabled', true);	
	
	
	
     jQuery.ajax({
           type: "POST",
           url: '<?php echo home_url(); ?>/',		
   		data: {
            action: "cashout_new",
			total: 	amount.value,
			msg: 	message.value,
			method: jQuery('#cashout-method').val(),
           },
           success: function(response) {   			 
			
			jQuery('.cashoutformmsg').hide();
   			jQuery('#cashoutform').html('').hide();
   			jQuery('#cashoutnew').show();			
   			
           },
           error: function(e) {
               alert("error "+e)
           }
       });
   	
   	return false;
   }
   
   
</script>
 

  