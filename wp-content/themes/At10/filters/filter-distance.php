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

global $CORE, $CORE_UI, $LAYOUT, $wpdb, $wp_query;

$GLOBALS['flag-filter-btn-set'] = 1;
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
$sidebar = 0;
if(isset($_POST['sidebar'])){
$sidebar = 1;
}
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
?>
        
<input type="hidden" class="customfilter save-map-log" data-type="text" data-key="map-log" id="location-mylog" value="" />
<input type="hidden" class="customfilter save-map-lat"  data-type="text" data-key="map-lat" id="location-mylat" value="" />
<input type="hidden" class="customfilter save-map-ip-city" data-type="text" data-key="map-city" id="location-city" value=""   />
<input type="hidden" id="location-address" value="" />
 
     

<?php
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
<div class="<?php if(!$sidebar){ ?>container mb-4 mt-2<?php } ?>">


<div class="filter-keyword">
<input type="text" class="form-control customfilter" data-type="text" data-key="zipcode" placeholder="<?php echo __("Enter town or city...","premiumpress"); ?>" />
</div>
 
<button data-ppt-btn class="btn-primary mt-1 mb-4 overflow-hidden" type="button" onclick="updateradiusfilter(500);"><?php echo __("Update Results","premiumpress"); ?></button>
 
<?php /*
<div class="p-2 text-center bg-light rounded-lg mb-4">
<div class="ipdataout"><i class="fa fa-sync fa-spin"></i></div>
</div>
*/ ?>

 
<div class="tax_wrapper search_radius">
<?php	



	//foreach(array("0.25","0.5","1","3","5","10","15","20","30","40","50","75","100") as $v){
		  		
		 
	

$ratings = array(

 	0 => array(
		"name" => __("Any Distance","premiumpress"), 
	),
	10 => array(
		"name" => __("Within 10 %s","premiumpress"), 
	),
	50 => array(
		"name" => __("Within 50 %s","premiumpress"), 
	),
	100 => array(
		"name" => __("Within 100 %s","premiumpress"), 
	),
	500 => array(
		"name" => __("Within 500 %s","premiumpress"), 
	),
 
); 

foreach($ratings as $s => $r){
?>
<div onclick="updateradiusfilter(<?php echo $s; ?>);" class="rds-<?php echo $s; ?> cursor <?php if($s == 0){ ?>on<?php } ?>" data-radius-text-<?php echo $s; ?>>
<?php

if( _ppt(array('maps','mapmetric')) == "1"){

echo str_replace("%s", __("KM","premiumpress"), $r['name'] );

}else{

echo str_replace("%s",__("miles","premiumpress"), $r['name'] );

}

 ?>
</div>
<?php } ?>
</div> 
      
<script>
function updateradiusfilter(g){	

	jQuery('.search_radius .on').removeClass('on');
	jQuery(".rds-"+g).toggleClass('on'); 
	
	if(jQuery("#location-mylog").val() == ""){
		
		jQuery('#search_radius').val(g);
		_filter_update();
	
	}else{
	
		jQuery('#search_radius').val(g);
		_filter_update();
	
	} 

}

</script>

<input type="hidden" id="search_radius" class="hidden customfilter" data-type="text"  value=""  name="radius" data-formatted-text="<?php echo __("Radius","premiumpress"); ?>"  data-key="radius">
 
 
</div>
 
<?php 
 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?> 