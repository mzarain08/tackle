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
 
$search_value = "";
$search_placeholder = __("Search by location..","premiumpress");
$admin_countries = _ppt('search_countries');
 
$taxonomySystem = 1;
 

// USER COUNTRY
$selected_country = "";
$selected_city = "";
$selected_state = "";
$allcatids = "";
	$selected_country_tax 	= "";
	$selected_city_tax 		= "";
	$selected_state_tax 	= "";


// ONLY 1 COUNTRY?
$onlyOne = false;
if(!empty($admin_countries) && count($admin_countries) == 1){
$onlyOne = true;
}
 

 
$map_data = array(
	
	"map-location" 	=> array("title" => __("Location","premiumpress"), "data" => "" ),		
	"map-country" 	=> array("title" => __("Country","premiumpress"), "data" => "" ),
	"map-state" 	=> array("title" => __("State/County","premiumpress"), "data" => ""),	
	"map-city" 		=> array("title" => __("City","premiumpress"), "data" => ""),
	
	//"map-area" 		=> array("title" => __("Area","premiumpress"), "data" => ""),
	///"map-route" 	=> array("title" => __("Route/Street","premiumpress"), "data" => ""),
	//"map-neighborhood" => array("title" => __("Neighborhood","premiumpress"), "data" => ""),	
	
	"map-log" 		=> array("title" => __("Longitude","premiumpress"), "data" => ""),
	"map-lat" 		=> array("title" => __("Latitude","premiumpress"), "data" => ""), 
	//"map-zip" 		=> array("title" => __("Zipcode","premiumpress"), "data" => ""), 
	
	"map-country-tax" 	=> array("title" => "", "data" => ""),
	"map-city-tax" 		=> array("title" => "", "data" => ""),
	"map-state-tax" 		=> array("title" => "", "data" => ""),
  
 
  "map-ip-country-code" => array("title" => "", "data" => ""),
  "map-ip" 				=> array("title" => "", "data" => ""),
  "map-ip-country" 		=> array("title" => "", "data" => ""),
  "map-ip-name" 		=> array("title" => "", "data" => ""),
  "map-ip-city" 		=> array("title" => "", "data" => ""),
  
  
);
  
$countrydata = $GLOBALS['core_country_list'];
 
 
	$tax_country = get_terms("country", 'orderby=count&order=desc&hide_empty=0&parent=0');
	if(!is_wp_error( $tax_country )){ 
		$countrydata = array();
		foreach ($tax_country as $term) {
			$countrydata[$term->term_id] = $term->name; 
		}
	}


foreach($map_data as $k => $v){

	if(isset($_POST['eid']) && $_POST['eid'] > 0){
		$map_data[$k]['data'] =  get_post_meta($_POST['eid'], $k, true);
	}
	 
	if($v['title'] == ""){ ?>

    <input type="hidden"  name="custom[<?php echo $k; ?>]" value="<?php echo $map_data[$k]['data']; ?>" class="form-control mb-2 data-map-data data-<?php echo $k; ?> save-<?php echo $k; ?>">
    
    <?php 
	
	}

}

if(isset($_POST['eid']) && $_POST['eid'] > 0){	


	$selected_country 	= $map_data['map-country']['data'];
	$selected_city 		= $map_data['map-city']['data'];
	$selected_state 	= $map_data['map-state']['data']; 

		
	$selected_country_tax 	= $map_data['map-country-tax']['data'];
	$selected_city_tax 		= $map_data['map-city-tax']['data'];
	$selected_state_tax 	= $map_data['map-state-tax']['data']; 

	// GET CATEGORY LIST FROM TERMS OBJEC
	$selected_countries = array();
	$allcatids = "";
	 
	$foundcats 	= wp_get_object_terms( $_GET['eid'], 'country' );	
	
	if(is_array($foundcats) && !empty($foundcats)){
			foreach($foundcats as $cat){
				$selected_countries[] = $cat->term_id;
			}
	}
	
	if(is_array($selected_countries) && !empty($selected_countries) ){
		foreach($selected_countries as $g){
			$allcatids .= $g.",";
		}
	} 
  
}
 
$cats = get_terms( 'country', array( 'hide_empty' => 0, 'parent' => 0  ));

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 

//echo $selected_country." (".$selected_country_tax.") // ".$selected_city." (".$selected_city_tax.") // ".$selected_state." (".$selected_state_tax.") ";
 
 
?>
 
<div class="tabv" id="datatab">

<div class="fs-md text-600 mb-4"><?php echo __("My Location","premiumpress"); ?></div>


<div class="mt-4 text-600 mb-2"><?php echo __("Full Address","premiumpress"); ?>

</div>

<div class="position-relative"> 
<input type="text" name="custom[map-location]"  value="<?php echo $map_data['map-location']['data']; ?>" style="padding: 0.375rem 0.75rem; height:50px;" class="form-control data-map-location save-map-location"/>

<?php if( in_array(_ppt(array("maps","provider")), array("mapbox","google")) && strlen(_ppt(array('maps','apikey'))) > 5 ){ ?>

 
<i class="fa fa-location position-absolute cursor" style="top:17px; right:17px; " onclick="jQuery('.tabv').toggle(); LoadMapBox(); jQuery('.map-back').show();"></i>

<?php } ?>

</div> 



<?php if( in_array(_ppt(array("maps","provider")), array("mapbox","google")) && strlen(_ppt(array('maps','apikey'))) > 5 ){ ?>

<div class="my-2 cursor fs-14" onclick="jQuery('.tabv').toggle(); LoadMapBox(); jQuery('.map-back').show();"><span style="color:blue;border-bottom:1px dotted #ddd;"><?php echo __("Display map view.","premiumpress"); ?></span></div>

<?php } ?>
 
 
<div class="row mt-3">
  
      <div class="col-md-6">
        <div class="mb-2 text-600">
          <?php echo __("Country","premiumpress"); ?>
        </div>
        
         <input type="text" name="custom[map-country]" value="<?php echo $map_data["map-country"]['data']; ?>" class="form-control mb-2 data-map-data data-map-country save-map-country" style="padding: 0.375rem 0.75rem; max-width: 25rem; <?php if(empty($tax_country) || ( !empty($tax_country) && count($tax_country) == 0) ){ }else{  ?>display:none;<?php } ?>">
       
        
        <?php if(empty($tax_country) || ( !empty($tax_country) && count($tax_country) == 0) ){  ?>
        
        
        <?php }else{ ?>

        <select id="parent_country_list" class="form-control mb-3" onchange="UpdateCategoryList()" style="padding: 0.375rem 0.75rem; max-width: 25rem; " >
        
       <?php if($map_data["map-country"]['data'] != "" && ( !is_numeric($map_data["map-country"]['data']) || $map_data["map-country"]['data'] == "0" ) ){ ?>
       <option value="0"><?php echo $map_data["map-country"]['data']; ?></option>
       <?php } ?>
        
        <?php
        $count = 1;
         
        
        if(!empty($cats)){
        
            foreach($cats as $cat){ 
            if($cat->parent != 0){ continue; } 
            
            if( !is_array( $admin_countries ) || (is_array($admin_countries) && $admin_countries[0] == "0" ) || ( is_array($admin_countries) && in_array($cat->term_id , $admin_countries ) ) ){ }else{ continue; }
        
        ?>
        <option value="<?php echo $cat->term_id; ?>" <?php if($cat->term_id == $selected_country_tax ){ echo "selected=selected";  }  ?>>
            <?php echo $CORE->GEO("translation_tax", array($cat->term_id, $cat->name)); ?>
        </option>
        
        <?php $count++; } } ?>
        </select>
        
        <?php } ?>
        
      </div>
     
      <div class="col-md-6">
        <div class="mb-2 text-600">
          <?php echo __("City","premiumpress"); ?>
        </div>
        
         <input type="text" name="custom[map-city]" value="<?php echo $map_data["map-city"]['data']; ?>" class="form-control mb-2 data-map-data data-map-city save-map-city" style="padding: 0.375rem 0.75rem; max-width: 25rem;  <?php if(empty($tax_country) || ( !empty($tax_country) && count($tax_country) == 0) ){  ?>display:none;<?php } ?>">
       
        
        <?php if(empty($tax_country) || ( !empty($tax_country) && count($tax_country) == 0) ){ }else{ ?>
        
        
        <div id="subcategory_list" style="display:none;">
        <select onchange="UpdateCategoryListSub()" class="form-control mb-3"  id="category_subs" style="padding: 0.375rem 0.75rem; max-width: 25rem;" ></select>
        </div>
        
        <div id="sub_subcategory_list" class="mt-3" style="display:none;">
        <select class="form-control mb-3" id="category_subs_sub" style="padding: 0.375rem 0.75rem; max-width: 25rem;"></select>
        </div>

        
        <?php } ?>
        
      </div>
      
      <div class="col-md-6" <?php if(function_exists('current_user_can') && current_user_can('administrator')){ }else{ ?>style="display:none"<?php } ?>>
        <div class="mb-2 text-600">
          <?php echo __("Longitude","premiumpress"); ?>
        </div>
        <input type="text" name="custom[map-log]" value="<?php echo $map_data["map-log"]['data']; ?>" class="form-control mb-2 data-map-data data-map-log save-map-log" style="padding: 0.375rem 0.75rem; max-width: 25rem;">
      </div>
      
      <div class="col-md-6" <?php if(function_exists('current_user_can') && current_user_can('administrator')){ }else{ ?>style="display:none"<?php } ?>>
        <div class="mb-2 text-600">
          <?php echo __("Latitude","premiumpress"); ?>
        </div>
        <input type="text" name="custom[map-lat]" value="<?php echo $map_data["map-lat"]['data']; ?>" class="form-control mb-2 data-map-data data-map-lat save-map-lat" style="padding: 0.375rem 0.75rem; max-width: 25rem;">
      </div>
     
    
</div> 
</div>  

<?php 

 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
?>

<div class="tabv" id="maptab" style="display:none;">

<?php

_ppt_template('framework/design/add/add-map-map' );	

?>


</div>
</div> 

<?php 

 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
?>

<hr />
<div class="d-flex justify-content-between">
<button data-ppt-btn class="btn-primary btn-close" type="button" onclick="UpdatecountryData()"><?php echo __("Continue","premiumpress"); ?></button>

<button data-ppt-btn class="btn-primary map-back" type="button" style="display:none;" onclick="jQuery('.tabv').toggle();"><?php echo __("Back","premiumpress"); ?></button>



</div>
  
 
<input type="hidden" id="callcatidsbox" value="<?php echo substr($allcatids,0,-1); ?>" />
 
         
<script>
jQuery(document).ready(function(){ 

 
 
jQuery("#default_map_data").html('');


<?php if(!isset($_GET['eid']) || isset($_GET['eid']) && $_GET['eid'] == "0"){ ?>
processUserIP();
<?php } ?>

UpdateCategoryList(); 

	setTimeout(function(){
	
		UpdateCategoryListSub();
			
			setTimeout(function(){
			
			<?php if(is_numeric($selected_state_tax)){ ?>
			
			jQuery("#category_subs_sub option[value=<?php echo $selected_state_tax; ?>]").attr('selected','selected');
			
			<?php } ?>
			
			}, 1000);
	
	}, 1000); 
	 
});

function ClearAllCountryData(){

jQuery(".save-map-state").val(''); 
jQuery(".save-map-state-tax").val(''); 
jQuery(".save-map-country").val(''); 
jQuery(".save-map-country-tax").val(''); 
jQuery(".save-map-city").val(''); 
jQuery(".save-map-city-tax").val('');

}
function UpdatecountryData(){

 
var i = jQuery("#parent_country_list"); 
if(jQuery("#parent_country_list").is(":visible") && i.val() != "" && i.val() !== null){
 
	jQuery(".save-map-country").val(jQuery.trim(i.find(":selected").text())); 
	jQuery(".save-map-country-tax").val(jQuery.trim(i.val())); 
	 
}else{

	if(jQuery(".save-map-ip-country").val() != "" && jQuery(".save-map-country").val() == "" ){
		jQuery(".save-map-country").val(jQuery(".save-map-ip-country").val());
	}
}
 
var i = jQuery("#category_subs"); 
if(jQuery("#category_subs").is(":visible") && i.val() != "" && i.val() !== null){

	jQuery(".save-map-city").val(jQuery.trim(i.find(":selected").text())); 
	jQuery(".save-map-city-tax").val(jQuery.trim(i.val())); 

}else{

	if(jQuery(".save-map-ip-city").val() != "" && jQuery(".save-map-city").val() == "" ){
		jQuery(".save-map-city").val(jQuery(".save-map-ip-city").val());
	}
}

var i = jQuery("#category_subs_sub"); 
if(jQuery("#category_subs_sub").is(":visible") && i.val() != "" && i.val() !== null){
 
	jQuery(".save-map-state").val(jQuery.trim(i.find(":selected").text())); 
	jQuery(".save-map-state-tax").val(jQuery.trim(i.val())); 

}

changeMapSearch(); 

jQuery('.map-blankbox').hide();
 

}

function UpdateCategoryList() { 
 
	jQuery('#category_subs').html("");
	jQuery('#category_subs_sub').html("");
	
	var catids = "";
	
	jQuery("#parent_country_list > option:selected").each(function() {
		catids = catids + this.value+',';
	});
	
	showsubcategories(catids, '#subcategory_list', '#category_subs', 0);
	
	// sub cats
	 setTimeout( function(){ 							 
		UpdateCategoryListSub();		
	 }  , 1000 );	
    
}
function showsubcategories(catids, sel1, sel2, childof){
  	
	// NOW TRY SHOW SUB CATEGORIES
	if(catids == ""){
	return;
	}
	
	// CHILD OF FOR SUB CATS
	if(childof == 0){
	cc = jQuery("#callcatidsbox").val();
	}else{
	cc  = childof;
	}
	
	
	 
	jQuery.ajax({
		type: "POST",
		url: '<?php echo home_url(); ?>/',	
		dataType: 'json',	
		data: {
				action: "load_taxonomy_list",
				taxonomy1: "country",
				parent:catids,
				child: cc,
				type:"list",
		},
		success: function(response) {
		 
		 	if(response.total > 0){	
				jQuery(sel1).show();			
				jQuery(sel2).html(response.output);	
						
			} else{ 
				jQuery(sel1).hide();							
				jQuery(sel2).val("0");
				
			} 
			 
			
			if(jQuery("#category_subs").is(":visible")){
			jQuery('.save-map-city').hide();
			}else{
			jQuery('.save-map-city').show();
			}
				
		},
		error: function(e) {
			console.log(e)
		}
	});

}
function UpdateCategoryListSub(){ 
	
	// SUB SUB CATS
	var catids = "";
	
	// GET FIRST VALUE IF NON ARE SELECTED
	if(jQuery("#category_subs > option:selected").length == 0){
 
	 setTimeout( function(){ 
							 
		catids = jQuery("#category_subs option:first").val()+',';
				
		showsubcategories(catids, '#sub_subcategory_list', '#category_subs_sub', catids);
		
	  }  , 1000 );
			
		  
	}else{
	
		jQuery("#category_subs > option:selected").each(function() {
			catids = catids + this.value+',';
		});
		
		showsubcategories(catids, '#sub_subcategory_list', '#category_subs_sub', catids);
	
	} 
	
}

function changeMapSearch(){
	SetCountry();
	SetCity();
	SetZip();
}
function SetCountry(){
	
	country = jQuery(".save-map-country").val();
	 
	if(country != ""){	
	jQuery(".data-map-country-wrap").show();
	jQuery(".data-map-country-wrap .cardbox").removeClass("closed");	
		
		if(jQuery(".flagw-"+country).lenght > 0){
		jQuery(".data-map-country").html(jQuery(".flagw-"+country).html()); 
		}else{
		jQuery(".data-map-country").html(country); 
		} 
		 
 	}else{
	jQuery(".data-map-country-wrap .cardbox").addClass("closed");
	}
}

function SetCity(){
	
	city = jQuery(".save-map-city").val();
	
	if(city != ""){
	jQuery(".data-map-city-wrap").show();
	jQuery(".data-map-city-wrap .cardbox").removeClass("closed");
	jQuery(".data-map-city").html(city); 
	}else{
	jQuery(".data-map-city-wrap .cardbox").addClass("closed");
	}
								
}
function SetZip(){
	 
	zip = jQuery(".save-map-state").val();
	if(zip != "" && jQuery(".save-map-state").length > 2){	  
	jQuery(".data-map-zip-wrap").show();
	jQuery(".data-map-zip-wrap .cardbox").removeClass("closed");
	jQuery(".data-map-zip").html(zip);
	}else{
	jQuery(".data-map-zip-wrap .cardbox").addClass("closed");
	} 
	 
} 
</script>
   