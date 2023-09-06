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

$randID = rand(0,99999);
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?> 
 
<div <?php if(!is_admin() && isset($_POST['action'])){ ?>style="min-height:200px;"<?php } ?>>
<select id="parent_category_list<?php echo $randID; ?>" class="form-control <?php if(!is_admin() && isset($_POST['action'])){ ?>fs-5<?php } ?> mb-3" onchange="UpdateCategoryList<?php echo $randID; ?>()" data-type="text" data-key="taxonomy" name="catid[]">
<option value=""><?php echo __("Any","premiumpress"); ?></option>
<?php
$count = 1;
$selected_categories = array();
$cats = get_terms( 'country', array( 'hide_empty' => 0, 'parent' => 0  ));
if(!empty($cats)){

	foreach($cats as $cat){ 
	if($cat->parent != 0){ continue; } 

?>
<option value="<?php echo $cat->term_id; ?>" <?php if(in_array($cat->term_id, $selected_categories) ){ echo "selected=selected";  }  ?>>
	<?php echo $CORE->GEO("translation_tax", array($cat->term_id, $cat->name)); ?>
</option>

<?php $count++; } } ?>
</select>
 
<div id="subcategory_list<?php echo $randID; ?>" style="display:none;">
<select  onchange="UpdateCategoryListSub<?php echo $randID; ?>()" class="form-control <?php if(!is_admin() && isset($_POST['action'])){ ?>fs-5<?php } ?> mb-3"  id="category_subs<?php echo $randID; ?>" data-type="text" data-key="taxonomy">
<option value=""><?php echo __("Any","premiumpress"); ?></option>
</select>
</div>

<div id="sub_subcategory_list<?php echo $randID; ?>" style="display:none;">
<select class="form-control <?php if(!is_admin() && isset($_POST['action'])){ ?>fs-5<?php } ?> mb-3"  id="category_subs_sub<?php echo $randID; ?>">
<option value=""><?php echo __("Any","premiumpress"); ?></option>
</select>
</div>
</div>
<div <?php if(!is_admin() && isset($_POST['action'])){ ?>class="text-center"<?php } ?>>
<button data-ppt-btn class="btn-primary" type="button" onclick="UpdatecountryData<?php echo $randID; ?>()"><?php echo __("Update Results","premiumpress"); ?></button>
</div>
  
  

  
         
<script>


function UpdatecountryData<?php echo $randID; ?>(){

var i = jQuery("#parent_category_list<?php echo $randID; ?>"); 
if(i.val() != "" && i.val() !== null){

jQuery("body").append('<input type="hidden" name="catid[]" id="lfilter1"  custom-data-value="" class="customfilter" data-key="taxonomy" data-value="" data-custom-text=""  data-type="custom-text" value="">');

jQuery("#lfilter1").val("country-"+i.val());
jQuery("#lfilter1").attr("data-value", "country-"+i.val());
jQuery("#lfilter1").attr("custom-data-value", "country-"+i.val());
jQuery("#lfilter1").attr("data-custom-text", i.find(":selected").text());
jQuery("#lfilter1").attr("value", "country-"+i.val());
jQuery("#lfilter1").addClass("customfilter");
}else{
jQuery("#lfilter1").removeClass("customfilter");
}

var i = jQuery("#category_subs<?php echo $randID; ?>"); 
if(i.val() != "" && i.val() !== null){
jQuery("body").append('<input type="hidden" name="catid[]" id="lfilter2"  custom-data-value="" class="customfilter" data-key="taxonomy" data-value="" data-custom-text=""  data-type="custom-text" value="">');
jQuery("#lfilter2").val("country-"+i.val());
jQuery("#lfilter2").attr("data-value", "country-"+i.val());
jQuery("#lfilter2").attr("custom-data-value", "country-"+i.val());
jQuery("#lfilter2").attr("data-custom-text", i.find(":selected").text());
jQuery("#lfilter2").attr("value", "country-"+i.val());
jQuery("#lfilter2").addClass("customfilter");
}else{
jQuery("#lfilter2").removeClass("customfilter");
}

var i = jQuery("#category_subs_sub<?php echo $randID; ?>"); 
if(i.val() != "" && i.val() !== null){
jQuery("body").append('<input type="hidden" name="catid[]" id="lfilter3"  custom-data-value="" class="customfilter" data-key="taxonomy" data-value="" data-custom-text=""  data-type="custom-text" value="">');
jQuery("#lfilter3").val("country-"+i.val());
jQuery("#lfilter3").attr("data-value", "country-"+i.val());
jQuery("#lfilter3").attr("custom-data-value", "country-"+i.val());
jQuery("#lfilter3").attr("data-custom-text", i.find(":selected").text());
jQuery("#lfilter3").attr("value", "country-"+i.val());
jQuery("#lfilter3").addClass("customfilter");
}else{
jQuery("#lfilter3").removeClass("customfilter");
}



_filter_update();

}

function UpdateCategoryList<?php echo $randID; ?>() { 
 
	jQuery('#category_subs<?php echo $randID; ?>').html("");
	jQuery('#category_subs_sub<?php echo $randID; ?>').html("");
	
	var catids = "";
	
	jQuery("#parent_category_list<?php echo $randID; ?> > option:selected").each(function() {
		catids = catids + this.value+',';
	});
	
	showsubcategories<?php echo $randID; ?>(catids, '#subcategory_list<?php echo $randID; ?>', '#category_subs<?php echo $randID; ?>', 0);
	
	// sub cats
	 setTimeout( function(){ 							 
		UpdateCategoryListSub<?php echo $randID; ?>();		
	 }  , 1000 );	
    
}
function showsubcategories<?php echo $randID; ?>(catids, sel1, sel2, childof){
  	
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
				
		},
		error: function(e) {
			console.log(e)
		}
	});

}
function UpdateCategoryListSub<?php echo $randID; ?>(){ 
	
	// SUB SUB CATS
	var catids = "";
	
	// GET FIRST VALUE IF NON ARE SELECTED
	if(jQuery("#category_subs<?php echo $randID; ?> > option:selected").length == 0){
 
	 setTimeout( function(){ 
							 
		catids = jQuery("#category_subs<?php echo $randID; ?> option:first").val()+',';
				
		showsubcategories<?php echo $randID; ?>(catids, '#sub_subcategory_list<?php echo $randID; ?>', '#category_subs_sub<?php echo $randID; ?>', catids);
		
	  }  , 1000 );
			
		  
	}else{
	
		jQuery("#category_subs<?php echo $randID; ?> > option:selected").each(function() {
			catids = catids + this.value+',';
		});
		
		showsubcategories<?php echo $randID; ?>(catids, '#sub_subcategory_list<?php echo $randID; ?>', '#category_subs_sub<?php echo $randID; ?>', catids);
	
	} 
	
}
</script>