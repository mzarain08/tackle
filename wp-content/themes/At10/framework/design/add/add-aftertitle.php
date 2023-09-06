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
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$eid = 0 ;
if(isset($_GET['eid']) && $_GET['eid'] > 0){
$eid = $_GET['eid'];
}


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
  
 
if( in_array(THEME_KEY,array("es","da")) ){

$cats = get_terms( 'dagender', array( 'hide_empty' => 0, 'parent' => 0  ));

$gen1 = "";
$gen2 = "";

if($eid > 0){

	$mygen = get_the_terms( $eid, 'dagender');
	if(isset($mygen[0])){
	$gen1 = $mygen[0]->term_id;		 
	}
	
	$gen2 = get_post_meta($eid, 'lookinggen', true); 
}
 
?>
<div class="row mb-2">

<div class="col-md-6">

    <label><?php echo __("I'm a","premiumpress"); ?> <span class="text-danger">*</span> </label>
    
    <div class="mt-2">
    
    <?php $i=1; foreach($cats as $cat){ ?>
    <div class="usertry gender <?php if( ( $eid == 0 && $i == 1) || $gen1 == $cat->term_id ){ $gen1 = $cat->term_id; ?>checked<?php } ?> gender-<?php echo $cat->term_id; ?>" onclick="processGender('<?php echo $cat->term_id; ?>');">
    
        <div><i class="fa fa-check-circle"></i> <?php echo $CORE->GEO("translation_tax", array($cat->term_id, $cat->name)); ?></div>
            
    </div> 
    <?php $i++; } ?>
    </div>

</div>
<?php if( in_array(THEME_KEY,array("da")) ){ ?>
<div class="col-md-6">

    <label><?php echo __("Looking for a","premiumpress"); ?> <span class="text-danger">*</span> </label>
    
    <div class="mt-2">
    
    <?php $i=1; foreach($cats as $cat){ ?>
    <div class="usertry ingender1 <?php if( ( $eid == 0 && $i == 2) || $gen2 == $cat->term_id ){ $gen2 = $cat->term_id;  ?>checked<?php } ?> ingender1-<?php echo $cat->term_id; ?>" onclick="processInterested('<?php echo $cat->term_id; ?>');">
    
        <div><i class="fa fa-check-circle"></i> <?php echo $CORE->GEO("translation_tax", array($cat->term_id, $cat->name)); ?></div>
            
    </div> 
    <?php $i++; } ?>
    </div>
    
</div>

<input type="hidden" class="form-control" name="custom[lookinggen]" id="ingender" value="<?php echo $gen2; ?>" />

<?php } ?>
 


<?php if( in_array(THEME_KEY,array("es")) ){ 
	
	
	$angencies = get_terms( 'store', array( 'hide_empty' => 0, 'parent' => 0  ));

	$store = get_the_terms( $eid, 'store');
	$storeid = "";
	if(isset($store[0])){
	$storeid = $store[0]->term_id;		 
	}
	
	 

if(empty($angencies)){
?>
<input type="hidden" class="form-control" name="custom[lookinggen]" id="switchVal" value="1" />
<?php
}else{
?>


<div class="col-md-6">

    <label><?php echo __("I work for","premiumpress");  ?> <span class="text-danger">*</span> </label>
    
    <div class="mt-2">
    
    <?php $i=1; 
	
	 
	$cats = array(
		"1" => __("Myself (Independent)","premiumpress"),
		"2" => __("Agency","premiumpress"),		
	);
	 
	
	foreach($cats as $k => $v){ ?>
    <div class="usertry ingender <?php if($gen2 == "" && $k == 1 ||  $gen2 == $k ){ ?>checked<?php } ?> ingender-<?php echo $k; ?>" onclick="processSwitch('<?php echo $k; ?>');">
    
        <div><i class="fa fa-check-circle"></i> <?php echo $v; ?></div>
            
    </div> 
    <?php $i++; } ?>
    </div>
    
    <div class="switchValDiv" style="display:none;">
    <select class="form-control mb-4" name="tax[store]" id="storelist" onchange="CheckNewStore(this.value)"></select>
    
    </div>
    
    <div style="display:none;" id="switchNewStore">
    <label><?php echo __("Agency Name","premiumpress");  ?></label>
    <input type="text"  name="custom[storename]" value="" />
	</div>
    
</div>
<?php } ?>

<input type="hidden" class="form-control" name="custom[lookinggen]" id="switchVal" value="<?php echo $gen2; ?>" />

<?php } ?>

 
<input type="hidden" class="form-control" name="tax[dagender]" id="gender" value="<?php echo $gen1; ?>" />


<script>

function CheckNewStore(val){

if(val == "-1"){
jQuery('#switchNewStore').show();
jQuery('#switchNewStore').find('input').addClass('form-control');
}

}

function processGender(id){
	jQuery('.gender').removeClass('checked');
	jQuery('.gender-'+id).addClass('checked');
	jQuery("#gender").val(id);
	jQuery("#reg_field_tax_dagender").val(id); 
}
function processSwitch(id){
	
	jQuery(".switchValDiv").hide()
	if(id == 2){	
		jQuery(".switchValDiv").show();	
		LoadStoreList();	
	}
	jQuery('.ingender').removeClass('checked');
	jQuery('.ingender-'+id).addClass('checked');
	jQuery("#switchVal").val(id);
	 
}
function processInterested(id){
	jQuery('.ingender1').removeClass('checked');
	jQuery('.ingender1-'+id).addClass('checked');
	jQuery("#ingender").val(id);
 
}

jQuery(document).ready(function() {
	jQuery('#reg_field_tax_dagender').on('change', function () {
		processGender(jQuery("#reg_field_tax_dagender").val());
	});
});

<?php if( in_array(THEME_KEY,array("es")) ){ ?>
jQuery(document).ready(function() {
	processSwitch(<?php echo $gen2; ?>);
});



function LoadStoreList(){

	jQuery.ajax({
		type: "POST",
		url: '<?php echo home_url(); ?>/',	
		dataType: 'json',	
		data: {
				action: "load_store_list",
				selected: "<?php echo $storeid; ?>", 
		},
		success: function(response) {
		 
		 	if(response.total > 0){				
				 
				jQuery("#storelist").html(response.output);
			  	 
			} 
				
		},
		error: function(e) {
			console.log(e)
		}
	});

}
<?php } ?>

</script>
</div>

<?php

}



 



 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////




if( in_array(THEME_KEY,array("so","jb","cm")) ){ 
	
	
	$angencies = get_terms( 'store', array( 'hide_empty' => 0, 'parent' => 0  ));

	$store = get_the_terms( $eid, 'store');
	$storeid = "";
	if(isset($store[0])){
	$storeid = $store[0]->term_id;		 
	}
	$gen2 = "";
	
	if($eid > 0){
	  $gen2 = get_post_meta($eid, 'lookinggen', true); 
	}
 
if(empty($angencies)){
?>
<input type="hidden" class="form-control" name="custom[lookinggen]" id="switchVal" value="1" />
<?php
}else{	 
?>

<label><?php if(THEME_KEY == "cm"){ echo __("This product is","premiumpress"); }elseif(THEME_KEY == "jb"){ echo __("This job is for","premiumpress"); }else{ echo __("This download is","premiumpress"); }  ?> <span class="text-danger">*</span> </label>
  

   
    <div class="mt-2">
    
    <?php $i=1; 
	
	if(THEME_KEY == "jb"){ 
	
		$cats = array(
			"1" => __("My own company","premiumpress"),
			"2" => __("On behalf of another company.","premiumpress"),		
		);
	 
	}else{
	 
	 
		$cats = array(
			"1" => __("My Own","premiumpress"),
			"2" => __("From a brand.","premiumpress"),		
		);
	
	}

	
	foreach($cats as $k => $v){ ?>
    <div class="usertry ingender <?php if($gen2 == "" && $k == 1 ||  $gen2 == $k ){ ?>checked<?php } ?> ingender-<?php echo $k; ?>" onclick="processSwitch('<?php echo $k; ?>');">
    
        <div><i class="fa fa-check-circle"></i> <?php echo $v; ?></div>
            
    </div> 
    <?php $i++; } ?>
    </div>
    
    <div class="switchValDiv" style="display:none;">
    <select class="form-control mb-4" name="tax[store]" id="storelist"></select>
    
    </div>
 
  
<input type="hidden" class="form-control" name="custom[lookinggen]" id="switchVal" value="<?php echo $gen2; ?>" />
<script>

function processSwitch(id){
	
	jQuery(".switchValDiv").hide()
	if(id == 2){	
		jQuery(".switchValDiv").show();	
		LoadStoreList();	
	}
	jQuery('.ingender').removeClass('checked');
	jQuery('.ingender-'+id).addClass('checked');
	jQuery("#switchVal").val(id);
	 
}
function processInterested(id){
	jQuery('.ingender').removeClass('checked');
	jQuery('.ingender-'+id).addClass('checked');
	jQuery("#ingender").val(id);
 
}

jQuery(document).ready(function() {
	jQuery('#reg_field_tax_dagender').on('change', function () {
		processGender(jQuery("#reg_field_tax_dagender").val());
	});
});

 
jQuery(document).ready(function() {
	processSwitch(<?php echo $gen2; ?>);
});

 
function LoadStoreList(){

	jQuery.ajax({
		type: "POST",
		url: '<?php echo home_url(); ?>/',	
		dataType: 'json',	
		data: {
				action: "load_store_list",
				selected: "<?php echo $storeid; ?>", 
		},
		success: function(response) {
		 
		 	if(response.total > 0){				
				 
				jQuery("#storelist").html(response.output);
			  	 
			} 
				
		},
		error: function(e) {
			console.log(e)
		}
	});

}
</script>
<?php

}  

}



///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


if(THEME_KEY == "dl" || _ppt(array('lst','makemodels')) == '1'){

$make = "";
$model = "";
$num = "";
$type = "";
if(isset($_GET['eid'])){ 
$make 	= "";
$model 	= "";
$type 	= get_post_meta($_GET['eid'],"type", true);

	$cats = get_terms( 'listing', array( 'hide_empty' => 0, 'parent' => 0  ));
	if(!empty($cats)){	
	 
			$foundcats 	= wp_get_object_terms( $_GET['eid'], 'listing' );
	 
			if(is_array($foundcats) && !empty($foundcats)){
				foreach($foundcats as $cat){
					if($model == ""){
						$model = $cat->name;
					}else{
						$make = $cat->name;
					}
				}
			}		
	} 
} 



$data = array(
	
	"car" => array(
		"name" => __("Car","premiumpress"), 
		"icon" => "fal fa-car"
	),
	"truck" => array(
		"name" => __("Truck","premiumpress"), 
		"icon" => "fal fa-truck"
	),
 
	"van" => array(
		"name" =>  __("Van","premiumpress"), 
		"icon" => "fal fa-shuttle-van"
	),
 
	"caravan" => array(
		"name" =>  __("Caravan","premiumpress"), 
		"icon" => "fal fa-caravan"
	),
	
	"bus" => array(
		"name" =>  __("Bus","premiumpress"), 
		"icon" => "fa fa-bus"
	),
	"motorcycle" => array(
		"name" => __("Motorcycle","premiumpress"), 
		"icon" => "fal fa-motorcycle"
	),
	
	"bicycle" => array(
		"name" => __("Bicycle","premiumpress"), 
		"icon" => "fal fa-bicycle"
	),
	
	"parts" => array(
		"name" =>  __("Car Parts","premiumpress"), 
		"icon" => "fal fa-car-battery"
	), 
	
);

?>

 
<label class="mt-2"><?php echo __("Tell us about your vehicle.","premiumpress"); ?> </label>

<div class="row mt-2">
 
<?php if( _ppt(array('lst','makemodels_type')) != '1'){ ?>

<div class="col-4 col-md-4 col-xl-3 data-type-wrap">

	<div class="cardbox <?php if($type == ""){ echo "closed"; } ?>" onclick="processEditData('type');">
         
        <i class="<?php if(isset($data[$type])){ echo $data[$type]['icon']; }else{ ?>fal fa-car-bus<?php } ?>"></i>
         
        <div class="small data-type"><?php if($type == ""){ echo __("Type","premiumpress"); }else{ echo $type; } ?></div>
         
        
	</div>  

</div>
<?php } ?>
<div class="col-4 col-md-4 col-xl-3 data-make-wrap">

	<div class="cardbox <?php if($make == ""){ echo "closed"; } ?>" onclick="processEditData('category');">
         
        <i class="fal fa-car"></i>
         
        <div class="small data-make"><?php if($make == ""){ echo __("Make","premiumpress"); }else{ echo $make; } ?></div>
         
        
	</div>  

</div>

<div class="col-4 col-md-4 col-xl-3 data-model-wrap">

	<div class="cardbox <?php if($model == ""){ echo "closed"; } ?>" onclick="processEditData('category');">
        
        <i class="fal fa-car-side"></i>
        
        <div class="small data-model"><?php if($model == ""){ echo __("Model","premiumpress"); }else{ echo $model; } ?></div>
        
	</div>  

</div>

</div> 
 

<?php


}


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if( !in_array(THEME_KEY,array("da","dl")) && _ppt(array('lst','makemodels')) != '1' ){

$cats = get_terms( 'listing', array( 'hide_empty' => 0, 'parent' => 0  ));
if(!empty($cats)){	

	// GET CATEGORY LIST FROM TERMS OBJEC
	$selected_categories = array();
	if(isset($_GET['eid'])){ 
		$foundcats 	= wp_get_object_terms( $_GET['eid'], 'listing' );	
		if(is_array($foundcats) && !empty($foundcats)){
			foreach($foundcats as $cat){
				$selected_categories[] = $cat;
			}
		}	
	} 
	 
?>  
 
<label><?php 

if( in_array(THEME_KEY,array("sp","cm")) ){
echo __("Where do you want your product displayed?","premiumpress");
}else{
echo __("Where do you want your ad displayed?","premiumpress");
}
 ?> <span class="text-danger">*</span> </label>

  
<div class="my-2">

  <div class="usertry checked dashed" onclick="processEditData('category');" id="cataddnew">
         
        
        <span> <i class="fa fa-plus text-dark"></i> <?php echo SearchFilterCaptions("category", __("Category","premiumpress") ); ?></span>
        
    	</div> 

<?php foreach($selected_categories as $cat){ 

$icon =  _ppt('category_icon_small_'.$cat->term_id);
if($icon == ""){
$icon = "fa  fa-check-circle";
}
?>
<div class="maintempcat " style="display:inline-block;">

	<div class="usertry usercat tempcat-<?php echo $cat->term_id; ?> checked" data-id="<?php echo $cat->term_id; ?>" onclick="processEditData('category');">
        
        <span> <i class="<?php echo $icon; ?>"></i>  <?php echo $CORE->GEO("translation_tax", array($cat->term_id, $cat->name)); ?></span>
        
    </div> 
    
</div>
<?php } ?> 
    
</div> 
 
 
<?php

}

}


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


if( in_array(THEME_KEY,array("cp")) ){ 

	$store = get_the_terms( $eid, 'store');
	$storeid = "";
	if(isset($store[0])){
	$storeid = $store[0]->term_id;		 
	}
$gen2 = "";

if($eid > 0){
  $gen2 = get_post_meta($eid, 'lookinggen', true); 
}
?>


<div>

    <label>
	
     
	<?php echo __("This coupon belongs to","premiumpress"); ?> 
   
    
    <span class="text-danger">*</span> </label>
    
    <div class="mt-2">
    
    <?php $i=1; 
	
	$cats = array(
		"1" => __("My website","premiumpress"),
		"2" => __("From a store","premiumpress"),		
	);
	
	foreach($cats as $k => $v){ ?>
    <div class="usertry ingender <?php if($gen2 == "" && $k == 1 ||  $gen2 == $k ){ ?>checked<?php } ?> ingender-<?php echo $k; ?>" onclick="processSwitch('<?php echo $k; ?>');">
    
        <div><i class="fa fa-check-circle"></i> <?php echo $v; ?></div>
            
    </div> 
    <?php $i++; } ?>
    </div>
    
    <div class="switchValDiv" style="display:none;">
    <select class="form-control" name="tax[store]" id="storelist"></select>
    
    </div>
    
</div>

<input type="hidden" class="form-control" name="custom[lookinggen]" id="switchVal" value="<?php echo $gen2; ?>" />
<script>

function processSwitch(id){
	
	jQuery(".switchValDiv").hide()
	if(id == 2){	
		jQuery(".switchValDiv").show();	
		LoadStoreList();	
	}
	jQuery('.ingender').removeClass('checked');
	jQuery('.ingender-'+id).addClass('checked');
	jQuery("#switchVal").val(id);
	 
}
 

 
jQuery(document).ready(function() {
	processSwitch(<?php echo $gen2; ?>);
});
 

function LoadStoreList(){

	jQuery.ajax({
		type: "POST",
		url: '<?php echo home_url(); ?>/',	
		dataType: 'json',	
		data: {
				action: "load_store_list",
				selected: "<?php echo $storeid; ?>", 
		},
		success: function(response) {
		 
		 	if(response.total > 0){				
				 
				jQuery("#storelist").html(response.output);
			  	 
			} 
				
		},
		error: function(e) {
			console.log(e)
		}
	});

}

</script>
<?php

}

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
if( !in_array(THEME_KEY,array("sp","cm")) && _ppt(array('lst','default_location')) != '0' ){

$country 	= "";
$city 		= "";
$zip 		= "";
$formextra = "";


if($eid > 0){
	$country = get_post_meta($eid, 'map-country', true);
	$city = get_post_meta($eid, 'map-city', true);
	$zip = get_post_meta($eid, 'map-state', true);	
}else{

 
	if(isset($GLOBALS['userIP']) && isset($GLOBALS['userIP']->country_name)  ){
	
		$country = $GLOBALS['userIP']->country_name;
		$city = $GLOBALS['userIP']->city;
		$long =  $GLOBALS['userIP']->lng;
		$lat =  $GLOBALS['userIP']->lat;
		
		$formextra = '<input type="hidden" name="custom[map-country]" value="'.$city.'"><input type="hidden" name="custom[map-city]" value="'.$country.'">
		<input type="hidden" name="custom[map-log]" value="'.$long.'"><input type="hidden" name="custom[map-lat]" value="'.$lat.'">';
	}
 
	 
}

$countrydata = $GLOBALS['core_country_list'];

?> 

<div id="default_map_data">
<?php echo $formextra; ?>
</div>

<label class="mt-2"><?php echo __("Where are you located?","premiumpress"); ?> </label>

<div class="row mt-2">

<div class="col-6 col-md-4 col-xl-3 data-map-country-wrap" <?php if($country == ""){ ?>style="display:none;"<?php } ?>>

	<div class="cardbox" onclick="processEditData('map');">
        
        <i class="fal fa-flag"></i>
        
        <div class="small data-map-country"><?php if(isset($countrydata[strtoupper($country)])){ echo $countrydata[strtoupper($country)]; }else{ echo $country; } ?></div>
        
	</div>  

</div>

<div class="col-6 col-md-4 col-xl-3 data-map-city-wrap" <?php if($city == ""){ ?>style="display:none;"<?php } ?>>
    
        <div class="cardbox" onclick="processEditData('map');">
        
        <i class="fal fa-map-marker"></i>
        
        <div class="small data-map-city"><?php echo $city; ?></div>
        
    </div> 
    
</div>  
<div class="col-6 col-md-4 col-xl-3 data-map-zip-wrap" <?php if($zip == ""){ ?>style="display:none;"<?php } ?>>
    
        <div class="cardbox" onclick="processEditData('map');">
        
        <i class="fal fa-map-pin"></i>
        
        <div class="small data-map-zip"><?php echo $zip; ?></div>
        
    </div> 
    
</div>   


<div class="col-6 col-md-4 col-xl-3 map-blankbox" >
    
        <div class="cardbox closed ppt-js-map-trigger filterbox-distance" onclick="processEditData('map');">
        
        <i class="fal fa-map-marker-plus"></i>
        
        <div class="small"><?php echo __("Change","premiumpress"); ?></div>
        
    </div> 

</div>
<?php if($country == "" && $city == "" && $zip == ""){  ?><?php } ?>

</div>

<?php } ?>