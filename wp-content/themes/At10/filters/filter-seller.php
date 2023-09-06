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



?>
<div style="min-height:400px;">
<h5 class="mb-4"><?php echo __("Seller Location","premiumpress");  ?></h5>

<select name="country" class="form-control selectpicker border loaded" data-live-search="true" data-size="10" tabindex="6" id="seller_location">
<option value="0"><?php echo __("Any Location","premiumpress");  ?></option>
<?php 
$admin_countries = _ppt('checkout_countries');
foreach($GLOBALS['core_country_list'] as $key=>$value){
	if( !is_array( $admin_countries ) || is_array($admin_countries) && in_array("0", $admin_countries ) ){						
	}else{
		if( is_array( $admin_countries ) && $admin_countries[0] != ""){		
			if(!in_array( $key, $admin_countries )  ){
			continue;
			}
		}
	}
	
$sel ="";
 echo "<option ".$sel." value='".$key."'>".$value."</option>";} ?>
</select>
 
<script>


jQuery(document).ready(function(){ 

 jQuery("#seller_location").selectpicker('destroy');
jQuery("#seller_location").selectpicker("refresh");

jQuery('#seller_location').on('change', function (e) {

	 jQuery("#seller-location").val(jQuery(this).val());
	_filter_update();
});

});
</script>
<input type="hidden" id="seller-location" class="hidden customfilter" name="seller_country" data-type="text" data-key="seller_country" value="0">

</div>