<?php
/*
Plugin Name: [PAYMENT GATEWAY] - PayPal Flow
Plugin URI: http://www.premiumpress.com
Description: This plugin will add PayPal flow to your PremiumPress payment gateways list.
Version: 1.2
Author: Mark Fail
Author URI: http://www.premiumpress.com
Updated: 1st Sep  2016
License:
*/

//1. HOOK INTO THE GATEWAY ARRAY
function wlt_gateway_paypal_flow_admin($gateways){
	$nId = count($gateways)+1;
	$gateways[$nId]['name'] 		= "PayPal Flow";
	$gateways[$nId]['logo'] 		= plugins_url()."/wlt_gateway_paypal_flow/img/logo.png";
	$gateways[$nId]['function'] 	= "wlt_gateway_paypal_flow_form";
	$gateways[$nId]['website'] 		= "http://www.paypal.com";
	$gateways[$nId]['callback'] 	= "yes";
	$gateways[$nId]['ownform'] 	= "yes";
	$gateways[$nId]['fields'] 		= array(
	'1' => array('name' => 'Enable Gateway', 'type' => 'listbox','fieldname' => $gateways[$nId]['function'],'list' => array('yes'=>'Enable','no'=>'Disable',) ),	
							
	'2' => array('name' => 'Vendor ID', 'type' => 'text', 'fieldname' => 'paypalflow_vendor' ),
	'3' => array('name' => 'Username', 'type' => 'text', 'fieldname' => 'paypalflow_username' ),
	'4' => array('name' => 'Password', 'type' => 'text', 'fieldname' => 'paypalflow_password' ),
	'5' => array('name' => 'Partner', 'type' => 'text', 'fieldname' => 'paypalflow_partner' ),	
	
	'6' => array('name' => 'Test Gateway', 'type' => 'listbox','fieldname' => 'paypalflow_test','list' => array('yes'=>'Enable','no'=>'Disable',) ),
	

	);
	$gateways[$nId]['notes'] 	= "";
	return $gateways;

}
add_action('hook_payments_gateways','wlt_gateway_paypal_flow_admin');

//2. BUILD THE PAYMENT FORM DATA
function wlt_gateway_paypal_flow_form($data=""){

	global $wpdb;
	
    /* DATA AVAILABLE
   
	$GLOBALS['total'] 	 
	$GLOBALS['subtotal'] 	 
	$GLOBALS['shipping'] 	 
	$GLOBALS['tax'] 		 
	$GLOBALS['discount'] 	 
	$GLOBALS['items'] 		 
	$GLOBALS['orderid'] 	 
	$GLOBALS['description'] 
    
    */
$string = '
<form method="post" action="">
<input type="hidden" value="1" name="payment_gateway_paypal_flow" />
<input type="hidden" value="'.$GLOBALS['total'].'" name="flow[amount]" />
<input type="hidden" value="'.$GLOBALS['orderid'].'" name="flow[orderid]" />

<div class="row-fluid">
<div class="span6 col-md-6">
<input type="text" name="flow[fname]" placeholder="First Name" class="form-control" />
<input type="text" name="flow[lname]" placeholder="Last Name" class="form-control" />
<input type="text" name="flow[address]" placeholder="Billing Address" class="form-control" />



</div>
<div class="span6 col-md-6">
<input type="text" name="flow[cnum]" placeholder="Card Number"  class="form-control" />
<input type="text" name="flow[cvv]" placeholder="CVV" class="form-control" />

<select name="flow[ctype]" class="form-control">
<option value="0">Visa</option>
<option value="1">MasterCard</option>
<option value="2">Discover</option>
<option value="3">AMEX</option>
<option value="4">DinersClub</option>
<option value="5">JCB</option>
<option value="8">Other</option>
</select>
<label>Expiration Date</label>
<div class="row">
    <div class="col-md-5">
		<select name="flow[expm]" class="form-control">
				<option>01</option>
				<option>02</option>
				<option>03</option>
				<option>04</option>
				<option>05</option>
				<option>06</option>
				<option>07</option>
				<option>08</option>
				<option>09</option>
				<option>10</option>
				<option>11</option>
				<option>12</option>
			</select>    
    </div>
    <div class="col-md-6"> 
			<select name="flow[expy]" class="form-control">				 
			 
                <option value=16>2016</option>
                <option value=17>2017</option>
                <option value=18>2018</option>
                <option value=19>2019</option>
				<option value=20>2020</option>
				<option value=21>2021</option>
				<option value=22>2022</option>
				<option value=23>2023</option>
				<option value=24>2024</option>
				<option value=25>2025</option> 
				
			</select>   
    </div>
</div>
</div>
</div>

<button type="submit" class="btn btn-primary">Process Payment</button>

</form>';
return $string;

}

//testing Url
//live Url
function processVerisignRequest($strRequest){

if(get_option('paypalflow_test') == "yes"){
define("PAYPAL_PAYFLOWPRO_URL","https://pilot-payflowpro.paypal.com/transaction:443/");
}else{
define("PAYPAL_PAYFLOWPRO_URL"," https://payflowpro.paypal.com/transaction:443/");
}
 

	//initialise variables
	$headers = array();
	$strResponse = "";
	$strTemp = date("YmdHIsB").rand(11,10000);
	$strRequestId = md5($strTemp.$strRequest);
	// Here's your custom headers; adjust appropriately for your setup:
	$headers[] = "Content-Type: text/namevalue"; //or maybe text/xml
	$headers[] = "X-VPS-Timeout: 45";
	$headers[] = "X-VPS-VIT-OS-Name: Linux";  // Name of your OS
	$headers[] = "X-VPS-VIT-OS-Version: RHEL 5";  // OS Version
	$headers[] = "X-VPS-VIT-Client-Type: PHP/cURL";  // What you are using
	$headers[] = "X-VPS-VIT-Client-Version: 0.01";  // For your info
	$headers[] = "X-VPS-VIT-Client-Architecture: x86";  // For your info
	$headers[] = "X-VPS-VIT-Integration-Product: Hound"; 
	// For your info, would populate with application name
	$headers[] = "X-VPS-VIT-Integration-Version: 0.01"; // Application version
	$headers[] = "X-VPS-Request-ID: " . $strRequestId;
	$user_agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)";
	//set a curl request
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, constant("PAYPAL_PAYFLOWPRO_URL"));
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
	curl_setopt($ch, CURLOPT_HEADER, 0); // tells curl to include headers in response
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // return into a variable
	curl_setopt($ch, CURLOPT_TIMEOUT, 45); // times out after 45 secs
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // this line makes it work under https
	curl_setopt($ch, CURLOPT_POSTFIELDS, $strRequest); //adding POST data
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  2); //verifies ssl certificate
	curl_setopt($ch, CURLOPT_FORBID_REUSE, TRUE);
	//forces closure of connection when done
	curl_setopt($ch, CURLOPT_POST, 1); //data sent as POST
	$strResponse = curl_exec($ch);
 
	$headers = curl_getinfo($ch); //Gets information about the last transfer
	//print_r($headers);
	//die(print_r($strResponse));
	curl_close($ch);
	unset($ch);
	return $strResponse;

}

function makeresultarray($result){
	$arrayresult=array();
	$arrayreturn=array();
	if(strlen($result)>0){
	$arrayresult = explode("&",$result);
	if(is_array($arrayresult) and count($arrayresult)>0)	
		foreach($arrayresult as $row){		
		$row1=explode("=",$row);		
		if(isset($row1[0]) and isset($row1[1]))		
		$arrayreturn[$row1[0]]=$row1[1];		
		}
	}
	return $arrayreturn;
}


function _process_paypal_flow(){ global $CORE, $wpdb, $userdata;
// PROCESS THE PAYMENT
if(isset($_POST['payment_gateway_paypal_flow']) && $_POST['flow']['amount'] > 0){

$site_title = get_bloginfo( 'name' );
$PAYMENTSTRING = "TRXTYPE=S&TENDER=C".
"&ACTION=I".

// LOGIN DETAILS
"&PWD=".get_option('paypalflow_password').
"&USER=".get_option('paypalflow_username').
"&VENDOR=".get_option('paypalflow_vendor').
"&PARTNER=".get_option('paypalflow_partner').

// USER BILLING
"&FIRSTNAME=".strip_tags($_POST['flow']['fname']).
"&LASTNAME=".strip_tags($_POST['flow']['lname']).
"&STREET=".strip_tags($_POST['flow']['address']).

// USER PAYMENT
"&AMT=".$_POST['flow']['amount'].
"&CURRENCY=USD".

// USER CARD DETAILS
"&ACCT=".$_POST['flow']['cnum'].
"&CVV2=".$_POST['flow']['cvv'].
"&EXPDATE=".$_POST['flow']['expm'].$_POST['flow']['expy'].
"&ACCTTYPE=0".

// CUSTOM
"&INVNUM=".$_POST['flow']['orderid'].
"&COMMENT1=".$site_title.
"&COMMENT2=".$_POST['flow']['orderid'];
 
$resultinfo = processVerisignRequest($PAYMENTSTRING);
//create the response array
$reply = makeresultarray($resultinfo);
 

// NOW LETS SWITCH OUT THE RESULT
if(empty($reply)){

	$GLOBALS['error_message'] = "Error - from payment processor: [" . $reply['RESULT'] . " " . $reply['RESPMSG'] . "] ";	
	$GLOBALS['error_type'] = "danger";
}else{

	switch ($reply['RESULT']) {
		case 0: { // SUCCESS
		
		
		core_generic_gateway_callback($_POST['flow']['orderid'], array('description' =>  '', 'email' => $userdata->user_email, 'shipping' => 0, 'shipping_label' => "", 'tax' => 0, 'total' => $_POST['flow']['amount'] ) );
	 	
		// LEAVE USER MESSAGE
		$GLOBALS['error_message'] = "Payment Completed. Thank You";
			
		} break;
		
		case 1: {
		
		$GLOBALS['error_message'] = "There is a payment processor configuration problem. This is usually due to invalid account information or ip restrictions on the account.  
		You can verify ip restriction by logging into Manager.  See Service Settings >> Allowed IP Addresses.";	
		$GLOBALS['error_type'] = "danger";
		
		} break;
		
		case 12: {
		
		$GLOBALS['error_message'] = "Your transaction was declined";	
		$GLOBALS['error_type'] = "danger";
		
		} break;	
	 
		case 13: {
		
		$GLOBALS['error_message'] = "Your Transaction is pending. Contact Customer Service to complete your order.";	
		$GLOBALS['error_type'] = "danger";
		
		} break;		
		
		case 23: {
		
		$GLOBALS['error_message'] = "Invalid credit card information. Please re-enter.";	
		$GLOBALS['error_type'] = "danger";
		
		} break;
		
		case 26: {
		
		$GLOBALS['error_message'] = "You have not configured your payment processor with the correct credentials. Make sure you have provided both the <vendor> and the <user> variables";	
		$GLOBALS['error_type'] = "danger";
		
		} break;
		
		default: {
		
		$GLOBALS['error_message'] = "Error - from payment processor: [" . $reply['RESULT'] . " " . $reply['RESPMSG'] . "] ";	
		$GLOBALS['error_type'] = "danger";
		
		} break;	
					
	}// end switch

}

}
}
add_action('init','_process_paypal_flow');


?>