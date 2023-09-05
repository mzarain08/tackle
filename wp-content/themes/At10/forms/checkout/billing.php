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

global $userdata, $CORE, $CORE_CART, $CORE_UI;



///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>

<input type="hidden" id="ppt_orderdata" value="" />

<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
 
<script>
function validate_checkout(){
   
   	result =  js_validate_fields('<?php echo __("Please complete all required fields.","premiumpress") ?>');
	 
	
   	if(result){ 
	  
	  var formdata = {};
 	   
	  jQuery('#checkoutform .form-control').each(function () {  
		 
		  formdata[jQuery(this).attr('name')] = jQuery(this).val();
	   
	  });  
	
	jQuery.ajax({
        type: "POST",
        url: ajax_site_url,	
		dataType: 'json',	
		enctype: 'multipart/form-data',
   		data: {
               cart_action: "new", 
			   data: formdata,		 
           },
           success: function(response) {		   
		   
				if( response.status == "ok"){
				
					jQuery("#ppt_orderdata").val(response.paycode);
				
					processNewPayment('#ppt_orderdata');
				
				}else if( response.status == "error"){
		   			
					alert(response.msg);
				
				}
				console.log(response); 
		   
		    },
           error: function(e) {
               console.log(e); 
           }
		 
	});
	  
	 
	
	}
	
	return false;
}

jQuery(document).ready(function(){ 

	jQuery('#field-country').on('change', function(e){
		 ajax_cart_update_country();
		 
		 setTimeout(function(){ 	
		 ajax_cart_update_country();
		 
		 }, 2000);	
		 
	});
	
	jQuery('#field-town').on('change', function(e){
		 ajax_cart_update_country();
	});
	
	 
	 ajax_cart_update_country();
	 
	 
});

function ajax_cart_update_country(){

	// COUNTRY VALUE
	var countryid = jQuery('#field-country').val();
	if(countryid == ""){
	countryid = jQuery('#field-country option:first').val();
	}
	
	/// UPDATE ORDER WITH NEW LOCATION DATA
    jQuery.ajax({
        type: "POST",
        url: ajax_site_url,	 
		dataType: 'json',		
		data: {
            cart_action: "update_shipping",
			country_id: countryid,
  			state_id: jQuery('#field-town').val(),
        },
        success: function(response) {
		
			if(response.status == "ok"){
			
				jQuery.ajax({
					type: "POST",
					url: ajax_site_url,	 	
					data: {
						cart_action: "update_items",						
					},
					success: function(response) {
					
						jQuery("#checkout-items").html(response);
						
						jQuery(".ppt-js-trigger-search-update").trigger('click');
												
						UpdatePrices();		  			
					}
				});
			 
		
				jQuery.ajax({
					type: "POST",
					url: ajax_site_url,	 	
					data: {
						action: "get_location_states",
						country_id: countryid,
						state_id: jQuery('#field-town').val(),
					},
					success: function(response) {
					  
						jQuery("#field-town").html(response);
					},
					error: function(e) {
						 
					}
				});
			
			
			}else{ 
			
			} 
		
        },
        error: function(e) {
             
        }
    });
 

}

function updateShipMethod(){


	var formdata = {};
	jQuery('.shipmethod').each(function () {  
	
		if(jQuery(this).is(':checked')){
			 formdata[jQuery(this).attr('data-key')] = jQuery(this).val();  
		}
		 
	});
	
	console.log(formdata);

	jQuery.ajax({
		type: "POST",
		dataType: 'json',
		url: ajax_site_url,	 	
		data: {
			cart_action: "update_methods",
			formdata: formdata,				 
		},
		success: function(response) {	
		
			if(response.status == "ok"){
			
				jQuery.ajax({
					type: "POST",
					url: ajax_site_url,	 	
					data: {
						cart_action: "update_items",						
					},
					success: function(response) {
					
						jQuery("#checkout-items").html(response);
						
						jQuery(".ppt-js-trigger-search-update").trigger('click');
												
						UpdatePrices();		  			
					}
				});
			}  
			 
		},
		error: function(e) {
						 
		}
	}); 
 
}

</script>

<form method="post" action="" onsubmit="return validate_checkout();" id="checkoutform">
  <div ppt-box class="rounded">
    <div class="_header" ppt-flex-between>
      <div class="_title">
        <?php echo __("Shipping Information","premiumpress") ?>
      </div>
      <div class="_close">
        <div ppt-icon-24 data-ppt-icon-size="24">
          <?php echo $CORE_UI->icons_svg['cart']; ?>
        </div>
      </div>
    </div>
    <div class="_content no-hide ppt-forms style3 pt-2" style="min-height:200px;">
      <div class="row">
        <?php 
foreach($CORE_CART->shop_user_fields as $key => $field){ ?>
        <?php 
	
		$colsize = "col-12 col-md-6"; $output = "";
		
		switch($field['type']){
		
		case "hidden": {
		
		} break; 
 
		
		case "country": {
		
		// GET VALUE
		$value = "";
		
		if( isset($_POST[$key]) ){
		$value = esc_html($_POST[$key]);
		}elseif($userdata->ID){
		$value = get_user_meta($userdata->ID, $key, true);
		} 
	 
		
		ob_start(); 
		
		$admin_countries = _ppt('checkout_countries');
		 
		?>
        <select class="form-control " id="field-<?php echo $key; ?>" name="<?php echo $key; ?>">
          <?php 
		
		// ADMIN DISPLAY COUNTRIES
		$admin_countries = _ppt('checkout_countries');
 		
		// LOOP
		foreach($GLOBALS['core_country_list'] as $ckey => $cvalue){
		
		
		// HIDE COUNTRIES
		if( !is_array( $admin_countries ) || is_array($admin_countries) && in_array("0", $admin_countries ) ){
		
		
		}else{
		
			if( is_array( $admin_countries ) && $admin_countries[0] != ""){		
				if(!in_array( $ckey, $admin_countries )  ){
				continue;
				}
			}
		
		}
		
		if($value == $ckey){ $sel ="selected=selected"; }else{ $sel =""; }
		
		echo "<option ".$sel." value='".$ckey."'>".$cvalue."</option>";} ?>
        </select>
        <?php
		
		$output = ob_get_clean(); 
		
		} break;
		case "state": {
		
		// GET VALUE
		$value = "";		 
		if( isset($_POST[$key]) ){
		$value = esc_html($_POST[$key]);
		}elseif($userdata->ID){
		$value = get_user_meta($userdata->ID, $key, true);
		}
		
		if($value  == "" && _ppt('checkout_default_state') != ""){
		$value = _ppt('checkout_default_state');
		}
		
		
		
		ob_start(); 
		
		?>
        <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $value; ?>" id="field-hidden-state" />
        <select class="form-control " id="field-<?php echo $key; ?>" name="<?php echo $key; ?>">
        </select>
        <?php
		
		$output = ob_get_clean(); 
		
		} break;
		
		case "textarea": { $colsize = "col-6"; }
		default: { 
		
		//
		
		// GET VALUE
		$value = "";
		 
		if($userdata->ID){
			if($key == "email"){
			$value = $CORE->USER("get_email", $userdata->ID);
			}else{
			$value = get_user_meta($userdata->ID, $key, true);
			}
		}
		
		// DEFAULT FOR CITY FIELD
		if($key == "billing_city" && $value  == "" && _ppt('checkout_default_city') != ""){
		$value = _ppt('checkout_default_city');
		}
		
			
		
		ob_start(); 
		?>
        <?php 
		
		
		
		if($field['type'] == "textarea"){ 
		 
		
		?>
        <textarea class="form-control  <?php if(!isset($field['nr']) && !isset($GLOBALS['flag-account']) ){ ?>required-field<?php } ?>" name="<?php echo $key; ?>" id="field-<?php echo $key; ?>"><?php echo $value; ?></textarea>
        <?php }else{ 
		
		
		
		?>
        <input type="text"  class="form-control  <?php if(!isset($field['nr']) && !isset($GLOBALS['flag-account']) ){ ?>required-field<?php } ?>" name="<?php echo $key; ?>" value="<?php echo $value; ?>" id="field-<?php echo $key; ?>">
        <?php } ?>
        <?php 
		
		$output = ob_get_clean(); 
		} 
		
		
		}// end switch ?>
        <?php if($output != ""){ ?>
        <div class="<?php echo $colsize; ?>">
          <div class="form-group">
            <label class="control-label"><?php echo __($field['caption'],"premiumpress"); ?>
            <?php if(!isset($field['nr']) && !isset($GLOBALS['flag-account'])  ){ ?>
            <span class="red">*</span>
            <?php } ?>
            </label>
            <div class="controls">
              <?php echo $output; ?>
            </div>
          </div>
        </div>
        <?php } ?>
        <?php } ?>
      </div>
      <?php
// GET VALUE
		$value = "";
		if( isset($_POST[$key]) ){
		$value = esc_html($_POST[$key]);
		}elseif($userdata->ID){
		$value = get_user_meta($userdata->ID, $key, true);
		}
?>
      <div class="form-group">
        <label class="control-label"><?php echo __("Order Notes.","premiumpress") ?></label>
        <div class="controls">
          <textarea class="form-control " name="<?php echo $key; ?>" id="field-billing_comments" style="height:80px;" placeholder="<?php echo __("Notes about your order, e.g. special notes for delivery.","premiumpress") ?>"><?php echo $value; ?></textarea>
        </div>
      </div>
      
      
      
      
      
      
      
      
<?php
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 
// GET SHIPPING METHODS
$custommethods 	= _ppt('custommethods');
 
if(is_array($custommethods) && !empty($custommethods['region'])){ $i=0;
	
if(is_array($custommethods['name'])){ 

$hasValue = false;

ob_start();
?>

<div class="mt-4 text-600"><?php echo __("Additional Options","premiumpress") ?></div>

<div class="form-style1 clearfix">
 
        <?php
 

foreach($custommethods['name'] as $cship){

	if($custommethods['name'][$i] == ""){ $i++; continue; } 
	
	$hasValue = true;

?>

<div class="py-2">
         
<div class="d-flex">
    <span class="mr-3">
    <input name="custommethod" class="shipmethod" data-key="<?php echo $custommethods['key'][$i]; ?>" type="checkbox" value="<?php echo $custommethods['price'][$i]; ?>" onclick="updateShipMethod();" />
    </span>
    <span class="mr-3 text-600">
    <?php if(is_numeric($custommethods['price'][$i])){ echo hook_price($custommethods['price'][$i]); }else{ echo $custommethods['price'][$i]; } ?>
    </span>
    <span><?php echo $custommethods['name'][$i]; ?></span>
</div>

</div>
 


<?php $i++; } } ?>

</div>

      <?php 

$SavedContent = ob_get_clean(); ob_flush();

if($hasValue){
	echo $SavedContent;
}


} // end shipping methods 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


?>  
      
 
      
    </div>
    <div class="_footer py-3 text-center">
      <button type="submit" class="btn-primary btn-lg" data-ppt-btn><?php echo __("Continue","premiumpress") ?></button>
    </div>
  </div>
</form>
