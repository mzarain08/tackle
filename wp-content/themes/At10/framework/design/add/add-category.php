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
 
// GET CATEGORY LIST FROM TERMS OBJEC
$selected_categories = array();
$allcatids = "";
if(isset($_GET['eid'])){ 
	$foundcats 	= wp_get_object_terms( $_GET['eid'], 'listing' );	

	if(is_array($foundcats) && !empty($foundcats)){
		foreach($foundcats as $cat){
			$selected_categories[] = $cat->term_id;
		}
	}	
}

if(is_array($selected_categories) && !empty($selected_categories) ){
	foreach($selected_categories as $g){
		$allcatids .= $g.",";
	}
} 

// MULTIPLE CATEGORIES
$multiCat = false;

if(_ppt(array('lst','default_multiplecats')) != ""){
$multiCat = _ppt(array('lst','default_multiplecats'));
}

if(isset($_GET['eid']) && is_numeric($_GET['eid']) && in_array(_ppt(array('lst','displaypricing')),array("","1")) ){ 
   $MyPackageId = -1; // default
   $MyPackageId = get_post_meta($_GET['eid'],'packageID',true); 
	if(_ppt('pak'.$MyPackageId.'_category')){
		$multiCat = true;
	}
} 

$selected_categories = array_reverse($selected_categories);	
 
$count = 1;
$cats = get_terms( 'listing', array( 'hide_empty' => 0, 'parent' => 0  ));



 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$GLOBALS['allcats'] = $cats;
$GLOBALS['allcats_selected'] = $selected_categories; ?>
<div class="show-mobile mobile-mt-4">
<?php _ppt_template('framework/design/add/add-category-mobile' ); ?>
</div>
<?php
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?> 
 

<div class="border hide-mobile" id="category_selection">
<div class="row no-gutters">


    <div class="col-md-4">
     
    
    <div class="ppt-scroll ppt-scroll1">
        <div class="catlist" style="max-height:400px;" id="parent_category_list">
        
        <?php foreach($cats as $cat){ 
		
		$extra = 0;
		$price = _ppt("price_".$cat->term_id);
		if(is_numeric($price)){
			$extra = $price;
		}
				
		?>
        <div class="_cat <?php if(in_array($cat->term_id, $selected_categories)){ ?>active<?php } ?>" <?php if($extra > 0){ ?>data-price="<?php echo $extra; ?>"<?php } ?>  data-id="<?php echo $cat->term_id; ?>">
        <?php echo $CORE->GEO("translation_tax", array($cat->term_id, $cat->name )); ?>
        
		<?php if($extra > 0){ ?>
        
        <div class="small opacity-5"><?php echo __("Extra Fee","premiumpress"); ?> +<span class="<?php echo $CORE->GEO("price_formatting",array()); ?>"><?php echo hook_price($extra); ?></span> </div>
		
		<?php } ?>
        </div>
        <?php } ?>
        
   </div>
   </div>
   </div>
   
    
	<div class="col-md-4">
   <div class="ppt-scroll ppt-scroll2">
     <div class="catlist" style="max-height:400px;" id="subcategory_list"></div>
    </div>
	</div>
    
	<div class="col-md-4">
    <div class="ppt-scroll ppt-scroll3">
    <div class="catlist" style="max-height:400px;" id="sub_subcategory_list"></div>
    </div>
	</div>
    
</div>
</div>
</div>

<hr class="hide-mobile" />
<div class="d-flex justify-content-between card-footer-nav ">

<button class=" btn-system" type="button" onclick="ClearAllCats();" data-ppt-btn><?php echo __("Clear All","premiumpress"); ?></button>


<button class=" btn-primary btn-close hide-mobile btn-close" type="button" data-ppt-btn><?php echo __("Continue","premiumpress"); ?></button>


</div>

<input type="hidden" id="callcatidsbox" value="<?php echo substr($allcatids,0,-1); ?>" />

<div id="formcats">

</div> 


<script>
jQuery(document).ready(function(){ 
 
const qs = new PerfectScrollbar('.ppt-scroll1');
const qs1 = new PerfectScrollbar('.ppt-scroll2');
const qs2 = new PerfectScrollbar('.ppt-scroll3');
UpdateCategoryList('');
setCatTriggers();

jQuery(".catlist .active").addClass('check'); 
setTimeout(function(){ 
	 
	UpdateCategoryList('');	
		
	setTimeout(function(){
		jQuery(".catlist .active").addClass('check'); 	
	}, 1000); 
	
}, 1000); 

UpdatePrices();


});

function setCatTriggers(){

	<?php if(!$multiCat){ ?>
	var a = jQuery("#parent_category_list.catlist > div:not(.hasTrigger)");
	a.each(function (a) {		 		
		jQuery(this).on("click", function (e) {	
			
			jQuery("#subcategory_list").html('');			
			jQuery("#sub_subcategory_list").html('');
			jQuery(".maintempcat").hide();
		
			if(jQuery("#parent_category_list .active").length > 0){			
				jQuery("#parent_category_list .active").removeClass('active'); 
			} 		
		});	
	});	
	
	var a = jQuery("#subcategory_list.catlist > div:not(.hasTrigger)");
	a.each(function (a) {		 	
		jQuery(this).on("click", function (e) {		
			if(jQuery("#subcategory_list .active").length > 0){			
				jQuery("#subcategory_list .active").removeClass('active');			
			} 		
		});	
	});	
	
	var a = jQuery("#sub_subcategory_list.catlist > div:not(.hasTrigger)");
	a.each(function (a) {		 	
		jQuery(this).on("click", function (e) {		
			if(jQuery("#sub_subcategory_list .active").length > 0){			
				jQuery("#sub_subcategory_list .active").removeClass('active');			
			} 		
		});	
	});	
	<?php } ?>
		
 
	var a = jQuery(".catlist > div:not(.hasTrigger)");
	a.each(function (a) {
		jQuery(this).addClass('hasTrigger');		
		jQuery(this).on("click", function (e) {
			 			
			jQuery(this).toggleClass('active');			
			jQuery(this).addClass('check');  
			
			
			var attr = jQuery(this).attr('data-parent'); 
			if (typeof attr !== 'undefined' && attr !== false) { 
			
				var attr = jQuery(this).attr('data-subcat');	 
				if (typeof attr !== 'undefined' && attr !== false) {
				UpdateCategoryList('subsubcat');
				}else{
				UpdateCategoryList('sub');
				}
				
			 	
			}else{
				UpdateCategoryList('');
			}
			
		});				
	});  
	

}

function ClearAllCats(){

<?php if(THEME_KEY == "dl" || _ppt(array('lst','makemodels')) == '1' ){ ?>
jQuery(".data-make-wrap .cardbox").addClass("closed");
jQuery(".data-model-wrap .cardbox").addClass("closed");
<?php } ?>

	jQuery('#formcats').html('');
	jQuery('#subcategory_list').html('');
	jQuery('.tempcat').html('').hide();
	jQuery('.maintempcat').html('').hide(); 
	jQuery("#category_selection .active").removeClass("active"); 
	updateTotal();
}
 
function UpdateCategoryList(div) { 
  
	var p_catids = ""; 
	jQuery('#formcats').html('');
	jQuery(".maintempcat").html('').hide();
	jQuery('.tempcat').html('').hide();
	
	jQuery("#parent_category_list .active").each(function() {
		p_catids = p_catids + jQuery(this).attr('data-id')+',';
		 
		
		var price = jQuery(this).attr('data-price'); 
		if (typeof price !== 'undefined' && price !== false) { 			
			jQuery('#formcats').append('<input type="hidden" value="1" data-amount="'+ price +'">');			
		}
		
		
		jQuery('#formcats').append('<input type="hidden" class="form-control" name="form[category][]" value="'+jQuery(this).attr('data-id')+'" data-catid="'+jQuery(this).attr('data-id')+'">');	
		
		if(jQuery(".tempcat-"+jQuery(this).attr('data-id')).length == 0){
		
		<?php if(THEME_KEY == "dl"  || _ppt(array('lst','makemodels')) == '1' ){ ?>
		jQuery(".data-make-wrap .cardbox").removeClass("closed");
		jQuery(".data-make").html(jQuery(this).text());  
		<?php }else{ ?>
		jQuery("#cataddnew").after('<div class="usertry checked tempcat" onclick="processEditData(\'category\');"><span><i class="fa fa-check-circle"></i>'+jQuery(this).text()+'</span></div>');
		<?php } ?>

		}
		
	});
	
	s_catids = "";
	jQuery("#subcategory_list .active").each(function() {
			s_catids = s_catids + jQuery(this).attr('data-id')+',';
			
		var price = jQuery(this).attr('data-price'); 
		if (typeof price !== 'undefined' && price !== false) { 			
			jQuery('#formcats').append('<input type="hidden" value="1" data-amount="'+ price +'">');			
		}
			
			jQuery('#formcats').append('<input type="hidden" class="form-control" name="form[category][]" value="'+jQuery(this).attr('data-id')+'" data-catid="'+jQuery(this).attr('data-id')+'">');
			
			if(jQuery(".tempcat-"+jQuery(this).attr('data-id')).length == 0){
			
			<?php if(THEME_KEY == "dl" || _ppt(array('lst','makemodels')) == '1' ){ ?>
			jQuery(".data-model-wrap .cardbox").removeClass("closed");
			jQuery(".data-model").html(jQuery(this).text());  
			<?php }else{ ?> 
			jQuery("#cataddnew").after('<div class="usertry checked tempcat" onclick="processEditData(\'category\');"><span><i class="fa fa-check-circle"></i>'+jQuery(this).text()+'</span></div>');
			<?php } ?>
			}
			
	});	
	
	ss_catids = "";
	jQuery("#sub_subcategory_list .active").each(function() {
			s_catids = s_catids + jQuery(this).attr('data-id')+',';
			
		var price = jQuery(this).attr('data-price'); 
		if (typeof price !== 'undefined' && price !== false) { 			
			jQuery('#formcats').append('<input type="hidden" value="1" data-amount="'+ price +'">');			
		}
			
			jQuery('#formcats').append('<input type="hidden" class="form-control" name="form[category][]" value="'+jQuery(this).attr('data-id')+'" data-catid="'+jQuery(this).attr('data-id')+'">');
			
			jQuery("#cataddnew").after('<div class="usertry checked tempcat" onclick="processEditData(\'category\');"><span><i class="fa fa-check-circle"></i>'+jQuery(this).text()+'</span></div>');
			

	});	
 
	if(p_catids != "" && div != "sub" && div != "subsubcat"){ 
		showsubcategories(p_catids, '#subcategory_list', 0);
	}else if(p_catids == ""){
		jQuery('#subcategory_list').html("");
	} 
	 
	if(s_catids != "" && div == "sub"){ 
	showsubcategories(s_catids, '#sub_subcategory_list', 1);
	}else if(s_catids == ""){
		jQuery('#sub_subcategory_list').html("");
	} 
 	
	// UPDATE TOTAL INCASE OF PRICES
	updateTotal();
	
	// SHOW CUSTOM FIELDS
	showcustomfields(); 	  
}

 
function showsubcategories(catids, sel1, childof){ 
 	
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
				type:"block",
				child: cc,
		},
		success: function(response) {
		 
		 	if(response.total > 0){				
				 
				jQuery(sel1).html(response.output);
				setCatTriggers();
				 
			}else{
				  
				
				var array = catids.split(",");	
				jQuery.each(array,function(i){
				   jQuery("[data-id='"+array[i]+"']").addClass("check");
				});
			 
			}
			 
				
		},
		error: function(e) {
			console.log(e)
		}
	});

}


</script>
<style>


.catlist > div.active { background:#efefef; }
.catlist > div { border: 1px solid #ddd; padding:10px; margin-top: -1px; font-weight:700; position:relative; cursor:pointer; }
#parent_category_list.catlist > div:after { font-family:"Font Awesome 5 Pro";content:"\f054";position:absolute;color:#ccc;top:10px;right:20px;font-size:16px;font-weight:500; }
.catlist > div.active.check:after { font-family:"Font Awesome 5 Pro"; content:"\f058"!important; color:#006600!important; position:absolute; top:10px;right:20px;font-size:16px;font-weight:700!important; }
 
.ppt-modal-close { color:#fff!important; }
.ppt-scroll  {  position: relative;  width: 100%;  overflow: auto;}
.ps{overflow:hidden!important;overflow-anchor:none;-ms-overflow-style:none;touch-action:auto;-ms-touch-action:auto}.ps__rail-x{display:none;opacity:0;transition:background-color .2s linear,opacity .2s linear;-webkit-transition:background-color .2s linear,opacity .2s linear;height:15px;bottom:0;position:absolute}.ps__rail-y{display:none;opacity:0;transition:background-color .2s linear,opacity .2s linear;-webkit-transition:background-color .2s linear,opacity .2s linear;width:15px;right:0;position:absolute}.ps--active-x>.ps__rail-x,.ps--active-y>.ps__rail-y{display:block;background-color:transparent}.ps--focus>.ps__rail-x,.ps--focus>.ps__rail-y,.ps--scrolling-x>.ps__rail-x,.ps--scrolling-y>.ps__rail-y,.ps:hover>.ps__rail-x,.ps:hover>.ps__rail-y{opacity:.6}.ps .ps__rail-x.ps--clicking,.ps .ps__rail-x:focus,.ps .ps__rail-x:hover,.ps .ps__rail-y.ps--clicking,.ps .ps__rail-y:focus,.ps .ps__rail-y:hover{background-color:#eee;opacity:.9}.ps__thumb-x{background-color:#aaa;border-radius:6px;transition:background-color .2s linear,height .2s ease-in-out;-webkit-transition:background-color .2s linear,height .2s ease-in-out;height:6px;bottom:2px;position:absolute}.ps__thumb-y{background-color:#aaa;border-radius:6px;transition:background-color .2s linear,width .2s ease-in-out;-webkit-transition:background-color .2s linear,width .2s ease-in-out;width:6px;right:2px;position:absolute}.ps__rail-x.ps--clicking .ps__thumb-x,.ps__rail-x:focus>.ps__thumb-x,.ps__rail-x:hover>.ps__thumb-x{background-color:#999;height:11px}.ps__rail-y.ps--clicking .ps__thumb-y,.ps__rail-y:focus>.ps__thumb-y,.ps__rail-y:hover>.ps__thumb-y{background-color:#999;width:11px}@supports (-ms-overflow-style:none){.ps{overflow:auto!important}}@media screen and (-ms-high-contrast:active),(-ms-high-contrast:none){.ps{overflow:auto!important}}
</style>
