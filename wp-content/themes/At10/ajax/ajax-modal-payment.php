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

global $CORE, $userdata, $CORE_UI;

$size = "large";
if(isset($GLOBALS['ajax-size'])){
$size = $GLOBALS['ajax-size'];
}
 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

//print_r($GLOBALS['payment_data']);

$data =  $GLOBALS['payment_data'];


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


if(!isset($_POST['noheader'])){
?>
<div class="card-popup <?php echo $size; ?>">
<div class="bg-primary pt-3">
    <div class="card-popup-content">    
    <div class="text-white mt-3">     
    	<strong class="h1 <?php if(is_numeric($GLOBALS['total']) && $GLOBALS['total'] > 0){ echo $CORE->GEO("price_formatting",array()); } ?>">
		<?php  if(is_numeric($GLOBALS['total']) && $GLOBALS['total'] > 0){ echo $GLOBALS['total']; }else{ echo __("No Payment Due","premiumpress");  } ?>
        </strong>
    	<div class="text-truncate mt-2 opacity-8 text-600"><?php echo $GLOBALS['description']; ?></div>
         
    </div>      
    </div>      
</div>
<?php } ?>

<div class="card-body pop-animate fadeIn delay-200 text-center col-lg-10 mx-auto mb-4">
<?php 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
?>

<div class="text-center" id="spinner" style="display:none;">
    <div class="mb-5"><span class="fa fa-spin fa-3x fa-sync"></span></div>
    <div class="opacity-5"><?php echo __("Redirecting to a secure payment page...","premiumpress"); ?></div>
</div>

<?php 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


?>

<div id="pay_wrap">

<?php if(isset($GLOBALS['tax']) && $GLOBALS['tax'] > 0){ ?>
<div class="mt-n4 pb-3 text-600 opacity-5"><?php echo __("Tax Included","premiumpress"); ?> <?php echo hook_price($GLOBALS['tax']); ?></div>
<?php } ?>

<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


ob_start();
?>
<div class="text-decoration-none text-dark link-dark btn-block border shadow-sm p-3 rounded mb-4">
<div class="d-flex payment-%name%">    
    <div style="width:120px; height:40px;" class="mr-4 rounded overflow-hidden position-relative">
    <div class="bg-image" style="background-image:url('%icon%'); background-size: contain;"></div>
    </div> 
	<div class="w-100"> 
    <div class="d-flex justify-content-between">    
        <div class="text-700 mt-2">

<?php
$payment_form_top = ob_get_clean();
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

ob_start();
?>
</div>     
<i class="fa fa-chevron-right fa-2x mr-2 mt-1"></i> 
</div> 
  
</div> 
   
</div>
</div> 

<?php
$payment_form_bottom = ob_get_clean();







// FREE UPGRADE	
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if($userdata->ID && (substr($GLOBALS['orderid'], 0, 8) == "UPGRADE-" || substr($GLOBALS['orderid'], 0, 4) == "LST-") && _ppt(array('mem','enable')) == 1 && $CORE->USER("membership_hasaccess", "listings") &&  get_user_meta($userdata->ID, "free_listings_count", true) > 0 ){
	
		if(!isset($GLOBALS['uccount'])){ $GLOBALS['uccount'] = 1; }else{ $GLOBALS['uccount']++; }
 
		$listingsLeft = get_user_meta($userdata->ID, "free_listings_count", true);
?>

<form method="post"  action="<?php echo _ppt(array('links','callback')); ?>" name="checkout_usercredit<?php echo $GLOBALS['uccount']; ?>" style="cursor:pointer;"  onclick="togglePay();jQuery(this).submit();">
<input type="hidden" name="free_upgrade" value="1" />
<input type="hidden" name="orderid" value="<?php echo $GLOBALS['orderid']; ?>" class="paymentcustomfield">		
<input type="hidden" name="description" value="<?php echo strip_tags($GLOBALS['description']); ?>"  />
<div class="text-decoration-none text-dark link-dark btn-block border shadow-sm p-3 rounded mb-4">
<div class="d-flex payment-%name%">    
	<?php if(in_array(_ppt(array('design', 'ppt_emoji')), array("","1"))){  ?>
    <div style="width:120px; height:40px; font-size: 30px;" class="mr-4 rounded overflow-hidden position-relative">
   &#x1F60A;
    </div> 
    <?php } ?>
	<div class="w-100"> 
    <div class="d-flex justify-content-between">    
<div class="text-700 text-left">
<?php echo __("Use Free Credit","premiumpress") ; ?>
<div class="tiny">
<?php echo str_replace("%s",$listingsLeft,__("You have %s left.","premiumpress")); ?>
</div>
<?php echo $payment_form_bottom; ?> 
</form>

<hr />
<?php 		 
}	



// ADD ON PAYMENT BY USER CREDIT		
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if($userdata->ID){
	$usercredit = get_user_meta($userdata->ID,'ppt_usercredit',true);
}
if(isset($usercredit) && isset($data->amount) && is_numeric($data->amount) && $data->amount > 0 && $usercredit >= $data->amount && !isset($data->nocredit) ){
 

/*
'.__("Your current balance is","premiumpress").' 
*/			
		 	
if(!isset($GLOBALS['uccount'])){ $GLOBALS['uccount'] = 1; }else{ $GLOBALS['uccount']++; }
				
?>

 

<form method="post"  action="<?php echo _ppt(array('links','callback')); ?>" name="checkout_usercredit<?php echo $GLOBALS['uccount']; ?>" style="cursor:pointer;" onclick="togglePay();jQuery(this).submit();" onsubmit="jQuery(this).find(\'button\').attr(\'disabled\', true);">
<input type="hidden" name="credit_total" id="credit_total" value="<?php echo $GLOBALS['total']; ?>" />
<input type="hidden" name="custom" value="<?php echo $GLOBALS['orderid']; ?>" class="paymentcustomfield">		
<input type="hidden" name="item_name" value="<?php echo strip_tags($GLOBALS['description']); ?>">

<div class="text-decoration-none text-dark link-dark btn-block border shadow-sm p-3 rounded mb-4">
<div class="d-flex payment-%name%">    
<?php if(in_array(_ppt(array('design', 'ppt_emoji')), array("","1"))){  ?>
    <div style="width:120px; height:40px; font-size: 30px;" class="mr-4 rounded overflow-hidden position-relative">
    &#x1F600;
    </div> 
    <?php } ?>
	<div class="w-100"> 
    <div class="d-flex justify-content-between">    
<div class="text-700 text-left">		 
<?php echo __("Use My Credit","premiumpress"); ?>
<div class="tiny">
<span class="opacity-5<?php echo $CORE->GEO("price_formatting",array()); ?>"><?php echo hook_price($usercredit); ?></span>
</div>

 
<?php echo $payment_form_bottom; ?> 
</form>	

<hr />
		 
<?php 
}
 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 
$gatway = hook_payments_gateways($GLOBALS['core_gateways']);
 

if(is_array($gatway) && isset($data->amount) && is_numeric($data->amount) && $data->amount > 0 ){

	foreach($gatway as $Value){
		
		if(get_option($Value['function']) == "yes" ){
		
		
			if( isset($Value['ownform']) && $Value['ownform'] == "yes"){
			
			?>
            
            <div class="text-center p-3 mb-3" ppt-border1>
			<?php echo str_replace("row", "", str_replace("paybutton","paybutton w-100", str_replace("col-","",$Value['function']($_POST)))); ?>
			</div>
            <?php
		
			}elseif( !isset($Value['ownform']) || ( isset($Value['ownform']) && $Value['ownform'] == "no" ) ){
			
				$rannum = rand();
				
				
				 if(strpos(get_option($Value['function'].'_name'), "http") === false){
				  $name = get_option($Value['function']."_name");
				 }else{
				 $name = $Value['name']; 
				 }
				 
				 $name = $Value['name']; 
					   
				 ?>
                       
<?php  echo str_replace("%name%", $Value['function'], str_replace("%icon%", $Value['logo'], $payment_form_top)); ?>

<?php echo str_replace("btn", "btn mt-n2", str_replace("mt-3", "", str_replace("btn-primary","",str_replace("gateway_","gateway_".$rannum."_",$Value['function']($_POST))))); ?>

<?php //echo $name; ?>

<?php echo $payment_form_bottom; ?> 
             
<?php 
					 						
			}// END IF 
		}// end if	 
	} // end foreach	 
}





///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
// ADD ON FOR ADMIN TESTING

if( ( user_can($userdata->ID, 'administrator') || defined('WLT_DEMOMODE') ) && in_array(_ppt('demopay'), array("","1"))  ){ // && isset($data->amount) && is_numeric($data->amount) && $data->amount > 0
		
		if($userdata->ID){		
			$email = get_option('admin_email');
		}else{
			$email = "testuser".rand(0,1000000)."@gmail.com";
		}		
?> 

<form method="post" action="<?php echo _ppt(array('links','callback')); ?>" style="cursor:pointer;" onclick="togglePay();jQuery(this).submit();">
<input type="hidden" name="email" value="<?php echo $email; ?>" />
<input type="hidden" name="admin_test_callback" value="1" />
<input type="hidden" name="amount" value="<?php echo $GLOBALS['total']; ?>" id="admin_test_total" />
<input type="hidden" name="custom" value="<?php echo  $GLOBALS['orderid']; ?>" class="paymentcustomfield" />							
<input type="hidden" name="description" value="<?php echo  strip_tags($GLOBALS['description']); ?>"  /> 
<?php echo $payment_form_top; ?>							
<?php if(isset($data->recurring) && $data->recurring == 1 && isset($data->recurring_days) && is_numeric($data->recurring_days) ){
echo '<input type="hidden" name="subscription" value="1" />';
}else{
echo '<input type="hidden" name="subscription" value="0" />';
}
?>
<?php echo __("Test Payment","premiumpress"); ?>
<?php echo $payment_form_bottom; ?> 
</form>



<?php }





// NO PAYMENT REQUIRED		
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
if( ( isset($data->amount) && is_numeric($data->amount) && $data->amount == 0 )  ){ // || ( isset($data->tokens) && $data->tokens == 0 ) 
?>

<?php
if($userdata->ID){
?>
    <form method="post" action="<?php echo _ppt(array('links','callback')); ?>" style="cursor:pointer;" onclick="togglePay();jQuery(this).submit();">
    <input type="hidden" name="free_payment_order" value="1" />
    <input type="hidden" name="amount" value="0"  />
    <input type="hidden" name="custom" value="<?php echo $GLOBALS['orderid']; ?>" class="paymentcustomfield" />							
    <input type="hidden" name="description" value="<?php echo strip_tags($GLOBALS['description']); ?>" class="paymentcustomfield" />
    <?php echo $payment_form_top; ?>			 
    <?php echo __("Complete Order","premiumpress"); ?>
    <?php echo $payment_form_bottom; ?> 						 
    </form>
    <?php }else{ ?>
    <?php echo $payment_form_top; ?>
    <a href="javascript:void(0);" onclick="processLogin();" class="btn btn-primary btn-block font-weight-bold text-uppercase"><?php echo __("Please login","premiumpress"); ?></a>    
    <?php echo $payment_form_bottom; ?>     
    <?php } ?>
                     
<?php  }





// COUPON ADD-ONS FOR DISCOUNTS
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$canShowCoupnBox = 0;
if(_ppt(array('coupons','enable')) == 1){
			$canShowCoupnBox = 1;
			
			if(isset($data->couponcode) && strlen($data->couponcode) > 1){
				$canShowCoupnBox = 0;
			}
			if(isset($data->hidecouponbox)){
				$canShowCoupnBox = 0;
			}
		}
		
		if($canShowCoupnBox){ // ?>
        
<a href="javascript:void(0);" onclick="jQuery('#couponcodeform').toggle();" class="btn btn-system btn-sm"><?php echo __("Have a coupon code? ","premiumpress"); ?></a> <span id="coupondiscounttext" class="small ml-3"></span>

<form method="post" action="#" id="couponcodeform" style="display:none;" class="mt-2" onsubmit="ajax_apply_coupon(this); return false;"><input type="hidden" name="coupon_orderid" value="<?php echo $data->order_id; ?>" /><input type="text" name="couponcode" id="couponcode" class="form-control form-control-sm" placeholder="<?php echo __("Enter coupon here.. ","premiumpress"); ?>"><button class="btn btn-primary btn-sm btn-block mt-2 btn-coupon" type="submit"><?php echo __("Apply Coupon","premiumpress"); ?></button></form>            
                    
<script>
function ajax_apply_coupon(acode){
  
       jQuery.ajax({
           type: "POST",
           url: '<?php echo home_url(); ?>/',
		   dataType: 'json',		
   		data: {
            action: 	"check_couponcode",
			code: 		acode.couponcode.value,		
			<?php if(isset($data->old_amount) && is_numeric($data->old_amount)){ ?>
			amount: 	"<?php echo $data->old_amount; ?>",
			<?php }else{ ?>
			amount: 	"<?php echo $data->amount; ?>",
			<?php } ?>
			orderid: 	"<?php echo $GLOBALS['orderid']; ?>",
			desc: 		"<?php echo strip_tags($GLOBALS['description']); ?>",
			<?php if(isset($data->recurring) && is_numeric($data->recurring) && isset($data->recurring_days) && is_numeric($data->recurring_days) ){ ?>
			recurring:  <?php echo $data->recurring; ?>,
			recurring_days: <?php echo $data->recurring_days; ?>,
			<?php } ?>
        },
        success: function(response) {
		
		jQuery('#spinner').hide();
		jQuery('#pay_wrap').show();
		  
				if(response.status == "ok"){
								 	
					processNewPayment(response.code);
					
					<?php if( in_array(THEME_KEY, array("sp","so")) ){ ?>
						
						jQuery("#main-userfields").submit();
						 
					<?php } ?> 
				   
				   return false;
				
				}else{
					
					jQuery('#couponcodeform').toggle();
					
					alert("<?php echo __("Invalid Coupon Code","premiumpress"); ?>");
					return false;
				
				}
			   			
           },
           error: function(e) {
               console.log(e);
			   return false;
           }
       });

}
</script>

<?php } ?>

<?php

// COUPON ADD-ONS FOR DISCOUNTS
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
 </div>
<div class="mt-4 opacity-5 small">
<div class=" d-inline-flex mx-auto">
    <div ppt-icon-16 data-ppt-icon-size="16"><?php echo $CORE_UI->icons_svg['lock']; ?></div>
    <div class="ml-2">
    <?php  echo __("All payment pages are secured using SSL","premiumpress"); ?>.</div>
    </div>
</div>
 
 
<script>

function togglePay(){

jQuery('#spinner').show();
jQuery('#pay_wrap').hide();

}


jQuery( "form button, form .btn:not(.btn-sm)" ).click(function() {
  togglePay();
});
</script> 
</div>
</div>