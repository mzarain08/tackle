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
   
  $payment_due = _ppt(array('paywall_'.$GLOBALS['accounttype']['key'], 'price'));
   
  $recurring = _ppt(array('paywall_'.$GLOBALS['accounttype']['key'], 'recurring'));
  
  $days = _ppt(array('paywall_'.$GLOBALS['accounttype']['key'], 'duration'));
  
?>
<div class="text-center">

      <i class="fal fa-lock fa-8x mb-4 text-primary"></i>
     
      <div class="fs-md text-600 mb-3"><?php echo __("Unlock The Website","premiumpress"); ?></div>
      
      <div class=" mb-2 opacity-5"> <?php echo __("Please purchase to unlock member access.","premiumpress"); ?> </div>
       
      <div class="my-4 fs-md text-600"><?php echo hook_price($payment_due); ?> <?php echo str_replace("%s", $days ,__("for %s days","premiumpress")); ?> </div>
      
     <div style="max-width:400px; margin:auto auto;">
   
       
<a href="javascript:void(0);" onclick="processNewPayment('#orderdata');" class="btn btn-primary btn-block btn-lg text-700"><?php echo __("Pay Now","premiumpress"); ?></a>    
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