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

global $CORE, $userdata, $filter_data; 

$taxonomy = $filter_data['tax'];

$cats = $GLOBALS['ncats'];

?>



<div <?php if(!isset($GLOBALS['flag-inside-sidebar'])){ ?>style="min-height:200px;"<?php } ?>>
<select id="parent_category_list" class="form-control fs-5" onchange="TaxListingCatList()" data-type="text" data-key="taxonomy" name="catid[]">
<option value=""><?php echo __("Any","premiumpress"); ?></option>
<?php
$count = 1;
$selected_categories = array();

if(isset($_GET['tax-listing'])){
$selected_categories[$_GET['tax-listing']] = $_GET['tax-listing'];
}

$cats = get_terms( 'listing', array( 'hide_empty' => 0, 'parent' => 0  ));
if(!empty($cats)){

	foreach($cats as $cat){ 
	if($cat->parent != 0){ continue; } 

?>
<option value="<?php echo $cat->term_id; ?>" <?php if(in_array($cat->term_id, $selected_categories) ){ echo "selected=selected";  }  ?>>
	<?php echo $CORE->GEO("translation_tax", array($cat->term_id, $cat->name)); ?>
</option>

<?php $count++; } } ?>
</select>



<div id="subcategory_list" class="<?php if(isset($GLOBALS['flag-inside-sidebar'])){ ?>my-2<?php }else{ ?>mt-4<?php } ?>" style="display:none;">
<select  onchange="UpdateCategoryListSub()" class="form-control fs-5"  id="category_subs" data-type="text" data-key="taxonomy">
<option value=""><?php echo __("Any","premiumpress"); ?></option>
</select>
</div>

<div id="sub_subcategory_list" class="mt-4" style="display:none;">
<select class="form-control fs-5"  id="category_subs_sub">
<option value=""><?php echo __("Any","premiumpress"); ?></option>
</select>
</div>
</div>




<button data-ppt-btn class="btn-primary mt-2" type="button" onclick="UpdateListingData()"><?php echo __("Update Results","premiumpress"); ?></button>

  
         
<script>


function UpdateListingData(){

var i = jQuery("#parent_category_list"); 
if(i.val() != "" && i.val() !== null){

jQuery("body").append('<input type="hidden" name="catid[]" id="lfilter1"  custom-data-value="" class="customfilter" data-key="taxonomy" data-value="" data-custom-text=""  data-type="custom-text" value="">');

jQuery("#lfilter1").val("listing-"+i.val());
jQuery("#lfilter1").attr("data-value", "listing-"+i.val());
jQuery("#lfilter1").attr("custom-data-value", "listing-"+i.val());
jQuery("#lfilter1").attr("data-custom-text", i.find(":selected").text());
jQuery("#lfilter1").attr("value", "listing-"+i.val());
jQuery("#lfilter1").addClass("customfilter");
}else{
jQuery("#lfilter1").removeClass("customfilter");
}

var i = jQuery("#category_subs"); 
if(i.val() != "" && i.val() !== null){
jQuery("body").append('<input type="hidden" name="catid[]" id="lfilter2"  custom-data-value="" class="customfilter" data-key="taxonomy" data-value="" data-custom-text=""  data-type="custom-text" value="">');
jQuery("#lfilter2").val("listing-"+i.val());
jQuery("#lfilter2").attr("data-value", "listing-"+i.val());
jQuery("#lfilter2").attr("custom-data-value", "listing-"+i.val());
jQuery("#lfilter2").attr("data-custom-text", i.find(":selected").text());
jQuery("#lfilter2").attr("value", "listing-"+i.val());
jQuery("#lfilter2").addClass("customfilter");
}else{
jQuery("#lfilter2").removeClass("customfilter");
}

var i = jQuery("#category_subs_sub"); 
if(i.val() != "" && i.val() !== null){
jQuery("body").append('<input type="hidden" name="catid[]" id="lfilter3"  custom-data-value="" class="customfilter" data-key="taxonomy" data-value="" data-custom-text=""  data-type="custom-text" value="">');
jQuery("#lfilter3").val("listing-"+i.val());
jQuery("#lfilter3").attr("data-value", "listing-"+i.val());
jQuery("#lfilter3").attr("custom-data-value", "listing-"+i.val());
jQuery("#lfilter3").attr("data-custom-text", i.find(":selected").text());
jQuery("#lfilter3").attr("value", "listing-"+i.val());
jQuery("#lfilter3").addClass("customfilter");
}else{
jQuery("#lfilter3").removeClass("customfilter");
}



_filter_update();

}

function TaxListingCatList() { 
 
	jQuery('#category_subs').html("");
	jQuery('#category_subs_sub').html("");
	
	var catids = "";
	
	jQuery("#parent_category_list > option:selected").each(function() {
		catids = catids + this.value+',';
	});
	
	TaxListingSubCatList(catids, '#subcategory_list', '#category_subs', 0);
	
	// sub cats
	 setTimeout( function(){ 							 
		UpdateCategoryListSub();		
	 }  , 1000 );	
    
}
function TaxListingSubCatList(catids, sel1, sel2, childof){
  	
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
				taxonomy1: "listing",
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
				
		TaxListingSubCatList(catids, '#sub_subcategory_list', '#category_subs_sub', catids);
		
	  }  , 1000 );
			
		  
	}else{
	
		jQuery("#category_subs > option:selected").each(function() {
			catids = catids + this.value+',';
		});
		
		TaxListingSubCatList(catids, '#sub_subcategory_list', '#category_subs_sub', catids);
	
	} 
	
}

<?php if(isset($_GET['tax-listing'])){ ?>

jQuery(document).ready(function(){ 
 
	setTimeout(function(){
	
		TaxListingCatList();			 
	
	}, 2000); 
	 
});
<?php } ?>
</script>