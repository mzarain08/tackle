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
$allcatids = "";
$cats = $GLOBALS['allcats'];

$selected_categories = $GLOBALS['allcats_selected'];

if(is_array($selected_categories) && !empty($selected_categories) ){
	foreach($selected_categories as $g){
		$allcatids .= $g.",";
	}
} 

?>

<select id="mobile_catlist" class="form-control mb-3" onchange="UpdateMobileCatList()" style="padding: 0.375rem 0.75rem; max-width: 25rem; " >
        
     
        <?php
        $count = 1;
         
        
        if(!empty($cats)){
        
            foreach($cats as $cat){ 
            if($cat->parent != 0){ continue; } 
            
        ?>
        <option value="<?php echo $cat->term_id; ?>" <?php if(in_array($cat->term_id, $selected_categories)){ echo "selected=selected";  }  ?>>
            <?php echo $CORE->GEO("translation_tax", array($cat->term_id, $cat->name)); ?>
        </option>
        
        <?php $count++; } } ?>
        </select>
        
        
        
  <div id="submobile_category_list" style="display:none;">
        <select onchange="UpdateMobileCatListSub()" class="form-control mb-3"  id="mobile_category_subs" style="padding: 0.375rem 0.75rem; max-width: 25rem;" ></select>
        </div>
        
        <div id="sub_submobile_category_list" class="mt-3" style="display:none;">
        <select class="form-control mb-3" id="mobile_category_subs_sub" style="padding: 0.375rem 0.75rem; max-width: 25rem;"></select>
        </div>    
        
        
        
        
<input type="hidden" id="mobilecallcatidsbox" value="<?php echo substr($allcatids,0,-1); ?>" />


<button class=" btn-primary btn-close" onclick="saveMobileCats()" type="button" data-ppt-btn><?php echo __("Continue","premiumpress"); ?></button>


<script>



function saveMobileCats(){

ClearAllCats();

var i = jQuery("#mobile_catlist"); 
if(i.val() != "" && i.val() !== null){
	
	 
	jQuery('#formcats').append('<input type="hidden" class="form-control" name="form[category][]" value="'+i.val()+'" data-catid="'+i.val()+'">');	
	
		<?php if(THEME_KEY == "dl"  || _ppt(array('lst','makemodels')) == '1' ){ ?>
		jQuery(".data-make-wrap .cardbox").removeClass("closed");
		jQuery(".data-make").html(jQuery.trim(i.find(":selected").text()));  
		<?php }else{ ?>
		jQuery("#cataddnew").after('<div class="usertry checked tempcat" onclick="processEditData(\'category\');"><span><i class="fa fa-check-circle"></i>'+jQuery.trim(i.find(":selected").text())+'</span></div>');
		<?php } ?>
			
}

var i = jQuery("#mobile_category_subs"); 
if(i.val() != "" && i.val() !== null){
	jQuery('#formcats').append('<input type="hidden" class="form-control" name="form[category][]" value="'+i.val()+'" data-catid="'+i.val()+'">');	
	
			<?php if(THEME_KEY == "dl" || _ppt(array('lst','makemodels')) == '1' ){ ?>
			jQuery(".data-model-wrap .cardbox").removeClass("closed");
			jQuery(".data-model").html(jQuery.trim(i.find(":selected").text()));  
			<?php }else{ ?> 
			jQuery("#cataddnew").after('<div class="usertry checked tempcat" onclick="processEditData(\'category\');"><span><i class="fa fa-check-circle"></i>'+jQuery.trim(i.find(":selected").text())+'</span></div>');
			<?php } ?>			
}

var i = jQuery("#mobile_category_subs_sub"); 
if(i.val() != "" && i.val() !== null){
	jQuery('#formcats').append('<input type="hidden" class="form-control" name="form[category][]" value="'+i.val()+'" data-catid="'+i.val()+'">');			

			<?php if(THEME_KEY == "dl" || _ppt(array('lst','makemodels')) == '1' ){ ?>
			jQuery(".data-model-wrap .cardbox").removeClass("closed");
			jQuery(".data-model").html(jQuery.trim(i.find(":selected").text()));  
			<?php }else{ ?> 
			jQuery("#cataddnew").after('<div class="usertry checked tempcat" onclick="processEditData(\'category\');"><span><i class="fa fa-check-circle"></i>'+jQuery.trim(i.find(":selected").text())+'</span></div>');
			<?php } ?>	


}

}

jQuery(document).ready(function(){ 

UpdateMobileCatList(); 

	setTimeout(function(){
	
		UpdateMobileCatListSub();
			 
	
	}, 1000); 
	 
});
 

function UpdateMobileCatList() { 
 
	jQuery('#mobile_category_subs').html("");
	jQuery('#mobile_category_subs_sub').html("");
	
	var catids = "";
	
	jQuery("#mobile_catlist > option:selected").each(function() {
		catids = catids + this.value+',';
	});
	
	mobile_showsubcategories(catids, '#submobile_category_list', '#mobile_category_subs', 0);
	
	// sub cats
	 setTimeout( function(){ 							 
		UpdateMobileCatListSub();		
	 }  , 1000 );	
    
}
function mobile_showsubcategories(catids, sel1, sel2, childof){
  	
	// NOW TRY SHOW SUB CATEGORIES
	if(catids == ""){
	return;
	}
	
	// CHILD OF FOR SUB CATS
	if(childof == 0){
	cc = jQuery("#mobilecallcatidsbox").val();
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
			 
			
			if(jQuery("#mobile_category_subs").is(":visible")){
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
function UpdateMobileCatListSub(){ 
	
	// SUB SUB CATS
	var catids = "";
	
	// GET FIRST VALUE IF NON ARE SELECTED
	if(jQuery("#mobile_category_subs > option:selected").length == 0){
 
	 setTimeout( function(){ 
							 
		catids = jQuery("#mobile_category_subs option:first").val()+',';
				
		mobile_showsubcategories(catids, '#sub_submobile_category_list', '#mobile_category_subs_sub', catids);
		
	  }  , 1000 );
			
		  
	}else{
	
		jQuery("#mobile_category_subs > option:selected").each(function() {
			catids = catids + this.value+',';
		});
		
		mobile_showsubcategories(catids, '#sub_submobile_category_list', '#mobile_category_subs_sub', catids);
	
	} 
	
}

</script>