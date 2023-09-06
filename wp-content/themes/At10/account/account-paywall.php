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

global $CORE, $userdata; 

$g = $CORE->USER("paywall_data", $userdata->ID);


$payment_due = _ppt(array('paywall_'.$GLOBALS['accounttype']['key'], 'price'));
   
$recurring = _ppt(array('paywall_'.$GLOBALS['accounttype']['key'], 'recurring'));
  
$days = _ppt(array('paywall_'.$GLOBALS['accounttype']['key'], 'duration'));
 
?>
<div class="fs-lg text-600 mb-4"><?php echo __("My Membership","premiumpress"); ?></div>

<div>&#x1F55B; <?php echo __("Active until:","premiumpress"); ?> <span class="text-600"><?php echo hook_date($g['date_expires']); ?></span> </div>

<hr />


<div class="p-3 shadow-sm" ppt-border1>

<div class="row">
    <div class="col-md-8">
    
    <div class="text-600 mb-2 fs-md"><?php echo __("Extend Membership","premiumpress"); ?></div>
    
    <div class="text-600"><?php echo hook_price($payment_due); ?> <?php echo str_replace("%s", $days ,__("for %s days","premiumpress")); ?> </div>
      
    
    </div>
    <div class="col-md-4 text-center y-middle">
    
    <a href="javascript:void(0);" onclick="processNewPayment('#orderdata');" class="btn btn-system btn-lg btn-block text-700 shadow-sm"><?php echo __("Pay Now","premiumpress"); ?></a>    
        <input type="hidden" id="orderdata" value="<?php 
         
        $paymentc = array(
                "uid" 			=> $userdata->ID, 
                "amount" 		=> $payment_due, 
                "order_id" 		=> "PAYWALL-".$userdata->ID."-".rand(0,99999),
                "description" 	=> __("Membership Access","premiumpress"),	
                "recurring" 	=> $recurring,	
                "credit" 		=> 0,						
        ); 
         
       echo $CORE->order_encode($paymentc); ?>" /> 
    
    </div>
    </div>
</div>