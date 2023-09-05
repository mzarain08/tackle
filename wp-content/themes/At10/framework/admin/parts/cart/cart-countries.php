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

global $settings;
 
// COUNTRY LIST
$country_string1 = "";
foreach($GLOBALS['core_country_list'] as $key=>$value){
	$country_string1 .= "<option value='".$key."'>".$value."</option>";
} // end if 
  
$settings = array(
"title" => __("Display Countries","premiumpress"), 
"desc" => __("Here you can choose which countries to display on your website.","premiumpress"), 
"back" => "overview"
);


$checkoutcountries = _ppt('checkout_countries');
 
_ppt_template('framework/admin/_form-wrap-top' ); ?>  <div class="card card-admin"><div class="card-body">
 
         
 
     
<div class="form-group"> 
<select data-placeholder="Select Countries..."  name="admin_values[checkout_countries][]" class="form-control w-100" style="height:400px !important; max-width: 100%; width:100% !important;" multiple="multiple">
<option value="0" <?php if( !is_array( $checkoutcountries ) || is_array($checkoutcountries) && in_array("0", $checkoutcountries ) ){ echo "selected=selected"; } ?>><?php echo __("All Countries","premiumpress"); ?></option>
<?php
$country_string = $country_string1;

// ADD ON SELECTED ITEMS
if( is_array( $checkoutcountries ) ){
 
	foreach($checkoutcountries as $selected_countries){
	 
		if( strlen($selected_countries) > 1){	
		
			$country_string = str_replace($selected_countries."'",$selected_countries."' selected=selected",$country_string);	
		}
	}
}

echo $country_string;
?>
</select> 

</div> 


<p class="text-muted mt-2"><?php echo __("Press and hold CTRL to select multiple values.","premiumpress"); ?></p>

 

<div class="p-4 bg-light text-center mt-4">
         <button type="submit" data-ppt-btn class="btn-primary"> <?php echo __("Save Settings","premiumpress"); ?></button>
    </div>
    
    
</div></div>  

<?php _ppt_template('framework/admin/_form-wrap-bottom' );


 

 ?>