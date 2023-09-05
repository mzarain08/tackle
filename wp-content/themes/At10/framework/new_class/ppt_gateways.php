<?php
$core_gateways = array();
$core_gateways[1]['name'] 		= "Paypal";
$core_gateways[1]['function'] 	= "gateway_paypal";
$core_gateways[1]['website'] 	= "http://www.paypal.com";
$core_gateways[1]['logo'] 		= "https://premiumpress1063.b-cdn.net/_demoimagesv10/gateways/paypal.png";
$core_gateways[1]['callback'] 	= "yes";
 

$core_gateways[1]['fields'] 	= array(
'1' => array('name' => 'Gateway', 'type' => 'listbox', 'fieldname' => 'gateway_paypal','list' => array('yes'=>'Enable','no'=>'Disable')),
'2' => array('name' => 'Use Sandbox', 'type' => 'listbox', 'fieldname' => 'paypal_sandbox','list' => array('yes'=>'Yes (i am testing)','no'=>'No (my website is live)')),					 

'3' => array('name' => 'Paypal Email', 'type' => 'text', 'fieldname' => 'paypal_email'),
'4' => array('name' => 'Currency Code', 'type' => 'text', 'fieldname' => 'paypal_currency'),
'5' => array('name' => 'Display Name -or- Image URL', 'type' => 'text', 'fieldname' => 'gateway_paypal_name', 'default' => 'PayPal') ,
'6' => array('name' => 'Recurring Payments', 'type' => 'listbox', 'fieldname' => 'paypal_recurring','list' => array('yes'=>'Yes (where possible)','no'=>'Disable')),					 
'7' => array('name' => 'Language', 'type' => 'text', 'fieldname' => 'paypal_language', 'default' => 'US'),

 

);
$core_gateways[1]['notes'] 	= "A list of country codes for paypal languages can be <a href='https://developer.paypal.com/webapps/developer/docs/classic/api/country_codes/' style='text-decoration:underline;'>found here.</a>";
$GLOBALS['core_gateways'] = $core_gateways;
// ---------------------------- GATEWAY FIELD CODE ------------------------

 

function MakePayButton($link){
	global $CORE;
	$STRING = '<button class="btn btn-primary btn-block font-weight-bold text-uppercase mt-3" style="cursor:pointer">'.__("Pay Now","premiumpress") .'</button>';
	return $STRING;
}

// ---------------------------- GATEWAY CODE ------------------------
function gateway_paypal($data=""){

	global $CORE, $wpdb;
	 
 	$gatewaycode = "";	
	if(!isset($GLOBALS['pformid'])){	$GLOBALS['pformid'] = 1; }else{ $GLOBALS['pformid']++; }	
	 
	// DECODE DATA
	$data = $CORE->order_decode($data['details']); 
	 
  
	// POST ACTION
	if(get_option('paypal_sandbox') == "yes"){
		$postaction = 'https://sandbox.paypal.com/cgi-bin/webscr';
	}else{
		$postaction = 'https://www.paypal.com/cgi-bin/webscr';
	}
	
	 if($data->description == ""){	 
		 $data->description = $data->order_id;
	 }
	 	
ob_start(); 
?>
 
<form method="post" style="margin:0px !important;" action="<?php echo $postaction; ?>" name="checkout_paypal<?php echo $GLOBALS['pformid']; ?>">
<?php 
// IF SUBSCRIPTION
if(isset($data->recurring) && $data->recurring == 1 && isset($data->recurring_days) && is_numeric($data->recurring_days) ){ 

 
	if($data->recurring_days < 14){
		$p3 = $data->recurring_days;
		$t3 = "D";
	}elseif($data->recurring_days < 30){
		$p3 = round($data->recurring_days/7);
		$t3 = "W";
	}elseif($data->recurring_days < 365){
		$p3 = round($data->recurring_days/30);
		$t3 = "M";	
	}elseif($data->recurring_days > 364){	
		$p3 = 1;
		$t3 = "Y";	
	} 
	 
?>

    <input type="hidden" name="cmd" value="_xclick-subscriptions">
    <input type="hidden" name="business" value="<?php echo get_option('paypal_email'); ?>">
    <input type="hidden" name="currency_code" value="<?php echo hook_price_currencycode(get_option('paypal_currency')); ?>">
    <input type="hidden" name="no_shipping" value="1">
    <input type="hidden" name="description" value="<?php echo strip_tags($data->description); ?>" />
 
    <input type="hidden" name="a3" value="<?php echo $GLOBALS['total']; ?>">
    <input type="hidden" name="p3" value="<?php echo $p3; ?>"> 
    <input type="hidden" name="t3" value="<?php echo $t3; ?>">
    
    <input type="hidden" name="src" value="1">
    <input type="hidden" name="sra" value="1">
    
<?php }else{ ?>

	<input type="hidden" name="cmd" value="_xclick">
	<input type="hidden" name="business" value="<?php echo get_option('paypal_email'); ?>">
	<input type="hidden" name="currency_code" value="<?php echo hook_price_currencycode(get_option('paypal_currency')); ?>">
    <input type="hidden" name="no_shipping" value="1">
    
    <input type="hidden" name="item_number" value="<?php echo $GLOBALS['orderid']; ?>">
	<input type="hidden" name="item_name" value="<?php echo strip_tags($data->description); ?>" />    
    <input type="hidden" name="amount" value="<?php echo $GLOBALS['total']; ?>" id="paypalAmount">

<?php } ?>

    
<?php echo MakePayButton('javascript:document.checkout_paypal'.$GLOBALS['pformid'].'.submit();'); ?>
<input type="hidden" name="bn" value="PREMIUMPRESSLIMITED_SP">
<input type="hidden" name="charset" value="utf-8">    
<input type="hidden" name="custom" value="<?php echo $GLOBALS['orderid']; ?>" class="paymentcustomfield">
<input type="hidden" name="rm" value="2">
<input type="hidden" name="lc" value="<?php echo get_option('paypal_language'); ?>">
<input type="hidden" name="return" value="<?php echo _ppt(array('links','callback')); ?>?auth=1&cid=<?php echo $GLOBALS['orderid']; ?>">
<input type="hidden" name="cancel_return" value="<?php echo _ppt(array('links','callback')); ?>?cancel=1">
<input type="hidden" name="notify_url" value="<?php echo _ppt(array('links','callback')); ?>">
</form>
<?php
return ob_get_clean();
 

}

/*
	this function processes a new order
	for all payment gateways
	
	returns ORDERID
	
*/
function core_generic_gateway_callback($orderid, $data){ global $wpdb, $CORE, $userdata; $order_data_description = "";
 
	// MUST HAVE AN ORDER ID
	if($orderid == ""){ return; }	
	  
	// BUILD DATA TO SAVE INTO THE DATABASE
	$savadata = array(	
		'user_id'		=> '',
		'order_id'		=> $orderid,
		'order_ip' 		=> $_SERVER['REMOTE_ADDR'],
		'order_date' 	=> date("Y-m-d"),
		'order_time' 	=> date("H:i:s"),
		'order_data' 	=> '',
		'order_items' 	=> '', // USED TO HOLD THE LISTING IDS OR CART SESSION ID
		'order_email' 	=> '',
		'order_shipping' => 0,
		'order_tax' 	=> 0,
		'order_total' 	=> 0,
		'order_status' 	=> 1, // PAID	
		'user_login_name' => '',
		'shipping_label' 	=> '', 	
		'order_description' => '', // SHORT ORDER DESCRIPTION
		'order_gatewayname' => '', // USED FOR THE GATEWAY NAME (PAYPAL ETC)	
		'payment_data' 	=> '',			
	);
	
	// CHECK FOR SUBSCRIPTIONS
	if(isset($data['recurring']) && $data['recurring'] == "1"){
	$savadata['order_process'] = 4; // recurring status
	}
	
	   
	// SAVE ALL ORDER DATA FOR DEBUGGING
	$pstring = "";
	foreach($_POST as $k=>$v){ if(!is_array($k) && !is_array($v)){ $pstring .= $k.":".$v."\n"; } }		
	$data['paydata']		= $pstring;
	
	// FILL IN THE BLANKS FROM DATA PASSED VIA $orderdata	
	if(isset($data['amount']) && is_numeric($data['amount']) ){ $savadata['order_total'] =  $data['amount']; }
	if(isset($data['tax']) && is_numeric($data['tax']) ){ $savadata['order_tax'] =  $data['tax']; }
	if(isset($data['shipping']) && is_numeric($data['shipping']) ){ $savadata['order_shipping'] =  $data['shipping']; } 
	if(isset($data['description']) && strlen($data['description']) > 1 ){ $savadata['order_description'] = $data['description']; }	
	if(isset($data['gateway_name']) ){  $savadata['order_gatewayname'] =  $data['gateway_name']; }	
	if(isset($data['payment_data']) && strlen($data['payment_data']) > 1 ){  $savadata['payment_data'] = $data['payment_data']; }
 
	
	$orderbits = explode("-",$orderid);
	if(isset($orderbits[0]) && in_array($orderbits[0], array("LST","UPGRADE"))){
	$savadata['order_items'] =  $orderbits[1];	
	}
	 	 
	
	// CHECK FOR USER SESSION
	if($userdata->ID){
	
		$savadata['user_id'] 			=  $userdata->ID;
		$savadata['user_login_name'] 	= $userdata->user_login; 
		
		if(isset($data['email'])){
			$savadata['order_email'] 		=  $data['email'];
		}
		
		
	} elseif ( isset($data['email']) && strlen($data['email']) > 1 && email_exists($data['email']) ){
	 				
		$author_id 					= email_exists($data['email']);		
		$savadata['user_id']		= $author_id;		
		$savadata['order_email'] 	= $data['email'];		
		$savadata['user_login_name']= get_the_author_meta('user_login', $author_id);	 
				
	}else{
	
		$savadata['user_id'] 			= 1;
		$savadata['user_login_name'] 	= "Guest";
		
		if(isset($data['email']) && $data['email'] != ""  ){ $savadata['order_email'] =  $data['email']; }else{ $savadata['order_email'] = "no-email-recorded@noone.com"; }
		
	}
	
	// GET USER ID 
	$savadata['user_id'] = $CORE->ORDER('order_id_user_id', $orderid); 
	 
	    
	// ADD NEW ORDER
	$orderadd = $CORE->ORDER('add',$savadata); 
 
	// ADD TO ARRAY
	$savadata['ID'] =  $orderadd['orderid'];
 	$savadata['IDFORMATTED'] =  $CORE->ORDER("format_id",$orderadd['orderid']); 
	  
	// HOOK FOR ALL MAIN THEME ACTIONS
	//if($orderadd['type'] == "new"){
	$savadata = hook_v9_order_process( $savadata );	// KEEP THIS FOR CHILD THEME HOOKS	
		 
	//}  
	 
 	if(defined('THEME_KEY') && THEME_KEY == "pj" && substr($orderadd['orderid'],0,6) == "ESCROW" ){ 
	 
	
	}else{
	
	
	// ADD LOG
	$CORE->FUNC("add_log",
			array(				 
						"type" 		=> "order",	
									
						"postid"	=> $savadata['order_items'],
									
						"to" 			=> $savadata['user_id'], 						
						"post_name" 	=> $savadata['order_description'], 					
									  
						"alert_uid1" 	=>  $savadata['user_id'],
						
						"extra" 		=> $orderadd['orderid'], // SAVE ORDER ID
						"extra2" 		=> $orderid, 			 
									
						"email_data" 	=> array(
							
							"user_id" 		=> $savadata['user_id'],	
																
							"username" 		=> $CORE->USER("get_username", $savadata['user_id']),
							"from_username" => $CORE->USER("get_username", $savadata['user_id']),
							"total" 		=> hook_price($savadata['order_total']), 												
							"first_name" 	=> $CORE->USER("get_firstname", $savadata['user_id']),
							"last_name" 	=> $CORE->USER("get_lastname", $savadata['user_id']),												 
							"email" 		=> $CORE->USER("get_email", $savadata['user_id']),												
							"orderid" 		=> $orderid, 												
							"post_name" 	=> $savadata['order_description'], 		 
					),
			)
		); 
		
		}
						
						
		// SEND EMAIL
		$data1 = array(						
			"from_username" 	=> $CORE->USER("get_username", $savadata['user_id'] ), 
			"total" 			=> hook_price($savadata['order_total']), 
			"post_name" 		=> $savadata['order_description'], 
			"ordernumber"		 => $savadata['IDFORMATTED'],							
		);
		$CORE->email_system("admin", "admin_order_new", $data1);
	
	
	
	 
	// RETURN SAVE DATA
	return $savadata;
	

}

function core_paypal_callback($c){
	 
	global $wpdb, $CORE, $userdata;
 	 
	// CHECK WE HAVE received DATA FROM PAYPAL
	
	if(isset($_GET['st']) && $_GET['st'] == "Completed" ){
	 
			$SQL = "SELECT * FROM ".$wpdb->prefix."posts 
					INNER JOIN ".$wpdb->prefix."postmeta AS mt1 ON (".$wpdb->prefix."posts.ID = mt1.post_id) 					 				
					WHERE 1=1 
					AND ( mt1.meta_key = 'order_id' AND mt1.meta_value = ('".strip_tags($_GET['item_number'])."')   )	 GROUP BY ID LIMIT 1 ";
			 
			$result = $wpdb->get_results($SQL);	
		 	 
		
		if(isset($result[0]->ID)){
		
		update_post_meta($result[0]->ID, "order_status", 1);
		update_post_meta($result[0]->ID, "order_process", 3);
		
		
		}
	
	 
	}
	
	if(isset($_GET['cancel'])){
	
	return "error";	
	
	
	}elseif ( isset($_GET['token']) && isset($_GET['cid']) && isset($_GET['auth']) )  {
	
		
		
		
		
		 $amount = $CORE->ORDER("order_id_amount", $_GET['cid']);	 
		 $order_key_id = $CORE->ORDER("check_exists", $_GET['cid']);
		  
	
			$data = core_generic_gateway_callback(trim($_GET['cid']), 		
					array(
					
						"gateway_name" 	=> "PayPal Payment",
						"amount" 		=> $amount,
						"tax" 			=> 0,
						"shipping" 		=> 0,					
						
						"email" 		=> $CORE->USER("get_email", $CORE->ORDER('order_id_user_id', $_GET['cid']) ),
						'description' 	=> $_GET['cid'],
					) 
			);
			
			return $data;
	
	
	
	
	
	
	
	// PAYPAL IN JAPAN
	}elseif ( isset($_GET['PayerID']) && isset($_GET['cid']) )  {
	
		$amount = 0;
		if(isset($_GET['amt'])){
		
		$amount = $_GET['amt'];
		
		}else{
		 
		 $order_key_id = $CORE->ORDER("check_exists", $_GET['cid']);
		 
		 if( is_numeric($order_key_id) ){	
		 	 
		 $ordercheck = $CORE->ORDER("get_order", $order_key_id);
		 $amount = $ordercheck['order_total'];	 
		 
		 }
		 
		 if($amount < 1){
		 
		 	$obits = explode("-", $_GET['cid']);		 	
			$amount = get_post_meta($obits[1],'price',true);		 
		 }
		
		 
		}
		 
	
			$data = core_generic_gateway_callback(trim($_GET['cid']), 		
					array(
					
						"gateway_name" 	=> "PayPal Payment",
						"amount" 		=> $amount,
						"tax" 			=> 0,
						"shipping" 		=> 0,					
						
						"email" 		=> $CORE->USER("get_email", $userdata->ID),
						'description' 	=> $_GET['cid'],
					) 
			);
			
			return $data;
	
	// PAYPAL IN JAPAN
	}elseif ( isset($_GET['token']) && isset($_GET['cid']) )  {
	
		
		$amount  = $CORE->ORDER("order_id_amount", $_GET['cid']);		
		$userid = $CORE->ORDER('order_id_user_id', $_GET['cid']); 
	
	
			$data = core_generic_gateway_callback(trim($_GET['cid']), 		
					array(
					
						"gateway_name" 	=> "PayPal Payment",
						"amount" 		=> $amount,
						"tax" 			=> 0,
						"shipping" 		=> 0,					
						
						"email" 		=> $CORE->USER("get_email", $userid),
						'description' 	=> $_GET['cid'],
					) 
			);
			
			return $data;
	
	
	}elseif(isset($_POST['custom'])  && ( isset($_POST['payment_status']) || isset( $_POST['txn_type'] ) ) ){
		
		// NOW WE CHECK THE STATUS
		$order_id = trim($_POST['custom']);
		
		if( isset($_POST['txn_type']) && ( $_POST['txn_type'] == "subscr_cancel" || $_POST['txn_type'] == "subscr_eot" ) ) { 
			
			$obits = explode("-",$order_id);
			update_post_meta($obits[1],'subscription','cancelled');
			
			// UPDATE ORDER STATUS
			$SQL = "UPDATE ".$wpdb->prefix."core_orders SET order_status='4' WHERE order_id='".$order_id."' LIMIT 1";		 
			$wpdb->query($SQL);
			
			
			
		}elseif ($_POST['payment_status'] == "Completed" || $_POST['payment_status'] =="Pending"){
					
			// BUILD ORDER DATA FROM PAYPAL CALLBACK DATA
			$order_desc = "";
			if(isset($_POST['item_name'])){		$order_desc .= $_POST['item_name'];	}
			if(isset($_POST['item_name1'])){	$order_desc .= $_POST['item_name1']; }
			if(isset($_POST['item_name_1'])){	$order_desc .= $_POST['item_name_1']; }	
				
			// INFORMATION ABOUT THE BUYER
			$first_name = isset($_POST['first_name']) ? $_POST['first_name'] : "";
			$last_name = isset($_POST['last_name']) ? $_POST['last_name'] : "";
	 
			$address_city 				= isset($_POST['address_city']) ? $_POST['address_city']: "";
			$address_country 			= isset($_POST['address_country']) ? $_POST['address_country']: "";
			$address_country_code 		= isset($_POST['address_country_code']) ? $_POST['address_country_code']: "";
			$address_name 				= isset($_POST['address_name']) ? $_POST['address_name'] : "";
			$address_state 				= isset($_POST['address_state']) ? $_POST['address_state'] : "";
			$address_status 			= isset($_POST['address_status']) ? $_POST['address_status'] : "";
			$address_street 			= isset($_POST['address_street']) ? $_POST['address_street'] : "";
			$address_zip 				= isset($_POST['address_zip']) ? $_POST['address_zip'] : "";	
			
			$tax 				= isset($_POST['tax']) ? $_POST['tax'] : "";
			$mc_shipping 		= isset($_POST['mc_shipping']) ? $_POST['mc_shipping'] : "";
			$mc_gross 			= isset($_POST['mc_gross']) ? $_POST['mc_gross'] : "";	 
			
		
			$data = core_generic_gateway_callback($order_id, 		
					array(
					
						"gateway_name" => "PayPal Payment",
						"amount" => $mc_gross,
						"tax" => $tax,
						"shipping" => $mc_shipping,					
						
						"email" =>  $_POST['payer_email'],
						'description' => $order_desc,
					) 
			);
			
			return $data;
	
		} elseif ( isset($_POST['txn_type']) &&  $_POST['txn_type'] == "subscr_payment"  ){
		 
			return "success"; 
						
		} elseif ( isset($_POST['payment_status']) && ($_POST['payment_status'] == 'Reversed') || ($_POST['payment_status'] == 'Refunded') ) {
							
			return "error";				
		}	
	
	}
  
	
	// ELSE RETURN EXISTING VALUE FROM OTHER GATEWAYS
	return $c;
	 
}


function core_token_callback($c){

	global $wpdb, $CORE, $userdata;
 
	 
	// CHECK WE HAVE received DATA FROM PAYPAL
	if(isset($_POST['tokenpurchase'])  && is_numeric($_POST['tokenpurchase']) && $_POST['tokenpurchase'] > 0  ){
	  	
		$usercredit = get_user_meta($userdata->ID,'ppt_usertokens',true);
		if(isset($usercredit) && is_numeric($usercredit) && $usercredit >= $_POST['total']){ 
		
			update_user_meta($userdata->ID,'ppt_usertokens', get_user_meta($userdata->ID,'ppt_usertokens', true) - $_POST['total'] ); 
			
			$data = core_generic_gateway_callback($_POST['custom'], 		
				array(
				
					"gateway_name" => "Token Payment",
					"amount" => $_POST['total'],
					"email" =>  $userdata->user_email,
					'description' =>  $_POST['item_name'],
				) 
			);
				
			return $data;
		
		}else{ 	
			return "error";			
		}	
	}
		
	// ELSE RETURN EXISTING VALUE FROM OTHER GATEWAYS
	return $c;

}



function core_free_order_callback($c){ global $userdata;
 
 		 
		if(isset($c['free_payment_order']) && $c['amount'] == 0){		
		 
			 return core_generic_gateway_callback($c['custom'], 		
				array(
				
					"gateway_name" => "Free Order",
					"amount" => $c['amount'],
					"email" => $userdata->user_email,
					"description" => $c['description'],
				) 
			);	
					
		}elseif(isset($_POST['free_payment_order']) && $_POST['amount'] == 0){		
		 
			 return core_generic_gateway_callback($_POST['custom'], 		
				array(
				
					"gateway_name" => "Free Order",
					"amount" => $_POST['amount'],
					"email" => $userdata->user_email,
					"description" => $_POST['description'],
				) 
			);			
		}
		
	// ELSE RETURN EXISTING VALUE FROM OTHER GATEWAYS
	return $c;
}


function core_admin_test_callback($c){


 		if(isset($_POST['admin_test_callback'])){	
		 
		 	$data = core_generic_gateway_callback(
			
				$_POST['custom'], // <-- ORDER ID 		
				
				array(
				
					"gateway_name" 	=> "Admin Test",
					"amount" 		=> 	$_POST['amount'],
					"email" 		=> 	$_POST['email'],
					"description" 	=> 	$_POST['description'],
					"recurring" 	=> 	$_POST['subscription'],
				)
				
			);
		 
			return $data;	
			
		}
		
	// ELSE RETURN EXISTING VALUE FROM OTHER GATEWAYS
	return $c;
}

function core_usercredit_callback($c){

	global $wpdb, $CORE, $userdata;
	
 	 
	// CHECK WE HAVE received DATA FROM PAYPAL
	if(isset($_POST['credit_total'])  && is_numeric($_POST['credit_total']) && $_POST['credit_total'] > 0 && isset($_POST['custom'])  ){ //&& $CORE->ORDEREXISTS($_POST['custom']) == false
		 
		$usercredit = get_user_meta($userdata->ID,'ppt_usercredit',true);
		
		if(isset($usercredit) && is_numeric($usercredit) && $usercredit >= $_POST['credit_total']){ 
			
			update_user_meta($userdata->ID,'ppt_usercredit', get_user_meta($userdata->ID,'ppt_usercredit',true) - $_POST['credit_total'] );
			
			// SUCCESS AND PASS IN DATA
			$data = core_generic_gateway_callback(
				$_POST['custom'], 				
				array(
					"gateway_name" 	=> "User Credit",
					'description' 	=>  $_POST['item_name'], 
					'email' 		=> $userdata->user_email, 
					'shipping' 		=> '', 
					'shipping_label' => '', 
					'tax' 			=> 0, 
					'amount' 		=> $_POST['credit_total'],
				)		
			 );
			 
			 
			return $data;	
			
		}
			
	}
	
	// ELSE RETURN EXISTING VALUE FROM OTHER GATEWAYS
	return $c;

}

function core_free_upgrade_callback($c){

	global $wpdb, $CORE, $userdata;
	

 	 
	// CHECK WE HAVE received DATA FROM PAYPAL
	if(isset($_POST['free_upgrade'])  && $_POST['free_upgrade'] == 1 && !isset($GLOBALS['usedcredit'])  ){  
	 
		$GLOBALS['usedcredit'] = 1;
		
			
		if( $CORE->USER("membership_hasaccess", "listings") && $CORE->USER("get_user_free_membership_addon", array("listings", $userdata->ID)) >  0){ 
			
			// UPDATE LISTING TOTAL
			$CORE->USER("update_user_free_membership_addon", array("listings", $userdata->ID) );		
			
			// SUCCESS AND PASS IN DATA
			$data = core_generic_gateway_callback($_POST['orderid'], 
			
					array(
						'description'		 =>  $_POST['description'], 
						'email' 			=> $CORE->USER("get_email", $userdata->ID), 
						'shipping' 			=> '', 
						'shipping_label' 	=> '', 
						'tax' 				=> 0, 
						'amount' 			=> 0,
						"gateway_name" 		=> "user credit",				
					) 
				);
			 
			 
			return $data;	
			
		}	
	}
	
	// ELSE RETURN EXISTING VALUE FROM OTHER GATEWAYS
	return $c;

}


?>