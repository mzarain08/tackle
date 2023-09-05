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
 
 
global $settings, $CORE;

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 $settings = array(
  
  "title" => __("Search Settings","premiumpress"), 
  "desc" => __("Here you can manage your website search settings.","premiumpress"),
 
  //"doclink" => "https://www.premiumpress.com/docs/users/",
  
  "video" => "",
  );
   _ppt_template('framework/admin/_form-wrap-top' ); 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


	 
 
?>

<style>
#overview-box, #a-box, #d-box,  #ip-box, #h-box {
	display:none;
}
</style>

  

<div class="card">

<div class="card-body">

 
<label><?php echo __("Search Filters","premiumpress"); ?></label>
<div class="opacity-5 fs-sm mb-2"><?php echo __("Choose the filters you want to be displayed on the search page.","premiumpress"); ?></div>
 
<div class="row no-gutters px-0 mt-2 bg-light rounded p-3 pt-4">
 
<?php
 
foreach(ppt_theme_main_filters() as $k => $f ){ 

$filter = $f['key'];
 
?>


<div class="col-md-3">

<label class="custom-control custom-checkbox">
        
        <input type="checkbox" class="custom-control-input" <?php if( in_array(_ppt(array("searchfilter",$filter)),array("","1"))){ ?>checked=checked<?php } ?> onchange="updateSearchCheck('filter_<?php echo $filter; ?>');"  value="" />
           
        <span class="custom-control-label"> <?php echo $f['name']; ?>
        
        
<?php if(isset($f['info'])){ ?>
        <div class="badge_tooltip text-center float-right mr-3" data-direction="top">
    <div class="badge_tooltip__initiator"> 
   <i class="fal fa fa-info-circle" style="color:#000000"></i></div>
    <div class="badge_tooltip__item"><?php echo $f['info']; ?> </div>
  </div>
  <?php } ?>
        
        
        </span>
</label>

</div>

<input type="hidden" class="stopclean" id="filter_<?php echo $filter; ?>" name="admin_values[searchfilter][<?php echo $filter; ?>]" value="<?php echo _ppt(array("searchfilter",$filter)); ?>">

<script>
<?php if( _ppt(array("searchfilter",$filter)) != 1){ ?>
jQuery(document).ready(function(){ 
jQuery(".orderby-<?php echo $filter; ?>").hide();
});
<?php } ?>
</script>

<?php } ?>

 
 
</div>
 
<script>
 

function updateSearchCheck(div){
 
var hiddenField = jQuery('#'+div), val = hiddenField.val();

hiddenField.val(val === "1" ? "0" : "1");

}

</script>

<?php


 
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
  
$search_order = _ppt('search_order');
 
 
?>
 
<label class="mt-2 opacity-5"><?php echo __("Display Order","premiumpress"); ?></label>
<div class="search_order mt-2 p-2 bg-light position-relative" style="border:1px dashed #efefef;">
<ol class="row no-gutters px-0 pb-0">
 
<?php
foreach(ppt_theme_main_filters() as $k => $f ){ 
 
	$filter = $f['key'];
	$title = $f['name'];
	
	if( in_array(_ppt(array("searchfilter",$filter)),array("","1"))){ 
	
	}else{
	continue;
	}
		
?>
<span class="btn btn-system btn-sm mr-2 mt-2 drag orderby-<?php echo $filter; ?>" data-wid="<?php echo $filter; ?>">
<span class="grab"><i class="fa fa-expand-arrows-alt opacity-5 tiny"></i> <?php echo $title; ?></span>

<input type="hidden" class="stopclean"  name="admin_values[search_order][<?php echo $filter; ?>]" value="<?php echo _ppt(array("search_order",$filter)); ?>">


</span>
<?php } ?> 
</ol> 

 
</div>
<script>
jQuery(document).ready(function(){ 

 	jQuery('.search_order ol').sortable({
			connectWith: ".drag",
			handle: ".grab",
			placeholder: "panel-placeholder",
			
			stop: function( ) { 
				
				searchOrder();
			
			},start: function(event, ui){
			
			var classes = ui.item.attr('class').split(/\s+/);
			for(var x=0; x<classes.length;x++){   
				if (classes[x].indexOf("col")>-1){
				ui.placeholder.addClass(classes[x]);
			  }
			}
			  
			 ui.placeholder.css({      
			  width: ui.item.innerWidth() - 30 + 1,
			  height: ui.item.innerHeight() - 15 + 1,     
			  padding: ui.item.css("padding"),
			  marginTop: 0
			});       
		  }
		}); 
		
		
		jQuery(".search_order .btn").show();
		
});	
function searchOrder(){ 
	 
	var orderdata = "";
	jQuery('.search_order .btn[data-wid]').each(function(i, obj) {
	  
		orderdata = orderdata +  jQuery(this).data('wid')+',';
	
	});
	  	 
	jQuery.ajax({
			type: "POST",
			url: ajax_site_url,			
			data: {
				admin_action: "ajax_search_filter_order",		  
				data: orderdata, 
						 
			},
			success: function(response) {						 
				
			},	 
	});
	 
}
 

</script>
<style>
.panel-placeholder { background:#fff; border: 1px dotted black; padding:15px; height: 50px; margin: 15px; background:#fefefe;   }

</style>
<?php 
 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 /*
?>
<hr />
<label><?php echo __("Sort By","premiumpress"); ?></label>

<div class="row no-gutters px-0 mt-2">
<?php  

 
foreach(ppt_theme_orderby_filters() as $k => $f ){ ?>
        <div class="col-md-3">
        <label class="custom-control custom-checkbox"> 
        
        <input type="checkbox" 
        value="1" 
        class="custom-control-input" 
        id="searchorderby_<?php echo $k; ?>check" 
        onchange="CheckBoxSel('#searchorderby_<?php echo $k; ?>');"
         
		<?php if( in_array(_ppt(array('searchorderby', $k)), array("","1")) ){ ?>checked=checked<?php } ?>> 
        
          <input type="hidden" name="admin_values[searchorderby][<?php echo $k; ?>]" id="searchorderby_<?php echo $k; ?>add" value="<?php if( in_array(_ppt(array('searchorderby', $k)), array("","1")) ){ echo 1; }else{ echo 0; } ?>"> 
       
      	<span class="custom-control-label"><?php echo $f['name']; ?></span>
        </label>
        </div>
<?php  } ?>

</div>

<?php
*/

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$showonly = ppt_theme_checkbox_filters();

if(!empty($showonly)){
?>
<hr />
<label><?php echo __("Toggle Filters","premiumpress"); ?></label>

<div class="row no-gutters px-0 mt-2">
<?php foreach($showonly as $k => $f ){ ?>
        <div class="col-md-3">
        <label class="custom-control custom-checkbox"> 
        
        <input type="checkbox" 
        value="1" 
        class="custom-control-input" 
        id="searchcheckbox_<?php echo $k; ?>check" 
        onchange="CheckBoxSel('#searchcheckbox_<?php echo $k; ?>');"
         
		<?php if( in_array(_ppt(array('searchcheckbox', $k)), array("","1")) ){ ?>checked=checked<?php } ?>> 
        
          <input type="hidden" name="admin_values[searchcheckbox][<?php echo $k; ?>]" id="searchcheckbox_<?php echo $k; ?>add" value="<?php if( in_array(_ppt(array('searchcheckbox', $k)), array("","1")) ){ echo 1; }else{ echo 0; } ?>"> 
       
      	<span class="custom-control-label"><?php echo $f['name']; ?></span>
        </label>
        </div>
<?php  } ?>

</div>
 
<?php  } ?>




<?php if( in_array(THEME_KEY, array("cp")) ){ ?>

 <input type="hidden" name="admin_values[searchcustom][with_images]" value="0" />
 
<?php }else{ ?>  
<hr />
<label><?php echo __("Hidden Filters","premiumpress"); ?></label>
<div class="row no-guttersx px-0 mt-2">
    
<?php 


$filters = array(

	1 => array("key" => "with_images", "name" => str_replace("%s", strtolower($CORE->LAYOUT("captions","2")), __("Only show %s with images","premiumpress")) ),
	2 => array("key" => "login_filters", "name" =>  __("Only members can use search filters.","premiumpress") ),
 
	
);

foreach($filters as $k => $f ){ ?>
        <div class="col-md-6">
        <label class="custom-control custom-checkbox"> 
        
        <input type="checkbox" 
        value="1" 
        class="custom-control-input" 
        id="searchcustom_<?php echo $f['key']; ?>check" 
        onchange="CheckBoxSel('#searchcustom_<?php echo $f['key']; ?>');"
         
		<?php if( _ppt(array('searchcustom', $f['key'])) == 1){ ?>checked=checked<?php } ?>> 
        
          <input type="hidden" name="admin_values[searchcustom][<?php echo $f['key']; ?>]" id="searchcustom_<?php echo $f['key']; ?>add" value="<?php if( (_ppt(array('searchcustom', $f['key'])) == "" && $k < 4 ) || _ppt(array('searchcustom', $f['key'])) == 1){ echo 1; }else{ echo 0; } ?>"> 
       
      	<span class="custom-control-label"><?php echo $f['name']; ?></span>
        </label>
        </div>
<?php  } ?>
</div>

<?php } ?>


<hr />
<div class="">
<div class="row">


<div class="col-md-4">
<label><?php echo __("Default Layout","premiumpress"); ?></label>

<?php

$lay = _ppt(array('design', 'search_layout'));
?>
<select class="form-control" name="admin_values[design][search_layout]" onchange="SearchLayout(this.value)" id="searchLayout">

<option value="full" <?php if( $lay == "full"){ echo "selected=selected"; } ?>>Full Page</option>
<option value="sidebar" <?php if( strtolower($lay) == "sidebar"){ echo "selected=selected"; } ?>>Sidebar</option>

</select>


</div>



<div class="col-md-4 ">
<label><?php echo __("Sponsored Bar","premiumpress"); ?></label>

<?php

$lay = _ppt(array('design', 'search_sponsored'));
?>
<select class="form-control" name="admin_values[design][search_sponsored]">

<option value="1" <?php if( $lay == "1"){ echo "selected=selected"; } ?>><?php echo __("Show","premiumpress"); ?></option>
<option value="0" <?php if( $lay == "0"){ echo "selected=selected"; } ?>><?php echo __("Hide","premiumpress"); ?></option>

</select>


</div>


<div class="col-md-4 ">
<label><?php echo __("Search Filters Boxes","premiumpress"); ?></label>

<?php

$lay = _ppt(array('design', 'search_filters'));
?>
<select class="form-control" name="admin_values[design][search_filters]">

<option value="1" <?php if( $lay == "1"){ echo "selected=selected"; } ?>><?php echo __("Big","premiumpress"); ?></option>
<option value="2" <?php if( $lay == "2"){ echo "selected=selected"; } ?>><?php echo __("Toggle Button","premiumpress"); ?></option>


<option value="0" <?php if( $lay == "0"){ echo "selected=selected"; } ?>><?php echo __("Hide","premiumpress"); ?></option>

</select>


</div>




 
<script> 
function SearchLayout(v){
	if(v == "full"){
		jQuery("#cardlayout").val("grid");
	} 
		 
}
function CardLayout(v){
	if(v == "list"){
		jQuery("#searchLayout").val("sidebar");
	} 
		 
}
</script>  

<div class="col-md-4 mt-3">

<label><?php echo __("Display Style","premiumpress"); ?></label>

<?php

$lay = _ppt(array('searchcustom', 'cardlayout'));
if($lay == ""){

	if(defined('THEME_KEY') && in_array(THEME_KEY, array("cp"))){
		$lay = "list";
	}else{
		$lay = "grid";
	}

}
 
?>
<select class="form-control" name="admin_values[searchcustom][cardlayout]" id="cardlayout" onchange="CardLayout(this.value)">

<option value="grid" <?php if( $lay == "grid"){ echo "selected=selected"; } ?>><?php echo __("Grid","premiumpress"); ?></option>
<option value="list" <?php if( strtolower($lay) == "list"){ echo "selected=selected"; } ?>><?php echo __("List","premiumpress"); ?></option>

</select>

 
</div>

<div class="col-md-4 mt-3">

<label><?php echo __("List Display Style","premiumpress"); ?></label>

<?php

$lay = _ppt(array('searchliststyle', 'cardlayout'));
 
 
?>
<select class="form-control" name="admin_values[searchliststyle][cardlayout]">

<option value="1" <?php if( $lay == "1"){ echo "selected=selected"; } ?>><?php echo __("Single Box","premiumpress"); ?></option>
<option value="2" <?php if( $lay == "2"){ echo "selected=selected"; } ?>><?php echo __("Separated Box","premiumpress"); ?></option>

</select>

 
</div>


<div class="col-md-4 mt-3">
<label><?php echo __("Default Per Row","premiumpress"); ?></label>


<?php

$perrow = _ppt(array('searchcustom', 'perrow'));
if($perrow == ""){
$perrow = 4;
}

?> 
<select class="form-control" name="admin_values[searchcustom][perrow]">

<option name="3" <?php if( $perrow == 3){ echo "selected=selected"; } ?>>3</option>
<option name="4" <?php if( $perrow == 4){ echo "selected=selected"; } ?>>4</option>
<option name="5" <?php if( $perrow == 5){ echo "selected=selected"; } ?>>5</option>

</select>
 

</div>

<div class="col-md-4 mt-3">
<label><?php echo __("Mobile View - Per Row","premiumpress"); ?></label>


<?php

$perrow = _ppt(array('searchcustom', 'mobileperrow'));
if($perrow == ""){
$perrow = 2;
if(in_array(THEME_KEY,array("cp"))){ $perrow = 1;  }
}

?> 
<select class="form-control" name="admin_values[searchcustom][mobileperrow]">

<option name="1" <?php if( $perrow == 1){ echo "selected=selected"; } ?>>1</option>
<option name="2" <?php if( $perrow == 2){ echo "selected=selected"; } ?>>2</option> 

</select>
 

</div>



</div>
</div>



<hr />
<label><?php echo __("Page Access","premiumpress"); ?></label>
 
<div class="row no-guttersx px-0 mt-2">   
<?php 


$filters = array(

	1 => array("key" => "mustlogin", "name" =>  __("Users must be logged in.","premiumpress") ),
	 
	
);

foreach($filters as $k => $f ){ ?>
        <div class="col-md-6">
        <label class="custom-control custom-checkbox"> 
        
        <input type="checkbox" 
        value="1" 
        class="custom-control-input" 
        id="searchcustom_<?php echo $f['key']; ?>check" 
        onchange="CheckBoxSel('#searchcustom_<?php echo $f['key']; ?>');"
         
		<?php if( _ppt(array('search', $f['key'])) == 1){ ?>checked=checked<?php } ?>> 
        
          <input type="hidden" name="admin_values[search][<?php echo $f['key']; ?>]" id="searchcustom_<?php echo $f['key']; ?>add" value="<?php if( _ppt(array('search', $f['key'])) == 1){ echo 1; }else{ echo 0; } ?>"> 
       
      	<span class="custom-control-label"><?php echo $f['name']; ?></span>
        </label>
        </div>
<?php  } ?>
</div>

</div>


 
<script>
function CheckBoxSel(div){
	 
		
			if (jQuery(div+'check').is(':checked')) {			
				jQuery(div+'add').val(1);			
			}else{			
				jQuery(div+'add').val(0);
			}
		
}
</script>  


   <div class="card-footer text-center py-4">
      <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
    </div>


</div>
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?>
 
  
<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


?>
 
 
 
 
 <?php

  $settings = array(
  
  "title" => __("Search Card","premiumpress"), 
  "desc" => "", 

  
  );
  
_ppt_template('framework/admin/_form-wrap-top' ); ?>
   
<div class="card p-3">


<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$card_items = ppt_theme_search_card_items();

if(!empty($card_items)){
?>
 
<label><?php echo __("Display Options","premiumpress"); ?></label>

<div class="row no-gutters px-0 mt-2">
<?php foreach($card_items as $k => $f ){ ?>
        <div class="col-md-3">
        <label class="custom-control custom-checkbox"> 
        
        <input type="checkbox" 
        value="1" 
        class="custom-control-input" 
        id="searchcardvals_<?php echo $k; ?>check" 
        onchange="CheckBoxSel('#searchcardvals_<?php echo $k; ?>');"
         
		<?php if( in_array(_ppt(array('searchcardvals', $k)), array("","1")) ){ ?>checked=checked<?php } ?>> 
        
          <input type="hidden" name="admin_values[searchcardvals][<?php echo $k; ?>]" id="searchcardvals_<?php echo $k; ?>add" value="<?php if( in_array(_ppt(array('searchcardvals', $k)), array("","1")) ){ echo 1; }else{ echo 0; } ?>"> 
       
      	<span class="custom-control-label"><?php echo $f['name']; ?></span>
        </label>
        </div>
<?php  } ?>

</div>
 
<?php  } ?>



</div>
      
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?>


<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


?>
 
 <?php

  $settings = array(
  
  "title" => __("Useful Links","premiumpress"), 
  "desc" => "", 
   
  
  );
  
_ppt_template('framework/admin/_form-wrap-top' ); ?>
   
 
<div class="card p-3">

<a href="admin.php?page=settings&lefttab=taxonomies" class="_admin_iconbox icon-box">
<i class="fal fa-filter"></i><strong><?php echo __("Manage Taxonomies","premiumpress"); ?></strong>
<p><?php echo __("Here you can manage search taxonomies.","premiumpress"); ?></p>
</a>
 
<?php /*
<a href="javascript:void(0);" class="_admin_iconbox icon-box" onclick="jQuery('#a-tab').trigger('click');window.scrollTo({ top: 0, behavior: 'smooth' });">
<i class="fal fa-chart-line"></i><strong><?php echo __("Search Analytics","premiumpress"); ?></strong>
<p><?php echo __("Help understand your website visitors better with search analytics.","premiumpress"); ?></p>
</a>
*/ ?>


<a href="admin.php?page=settings&lefttab=maps" class="_admin_iconbox icon-box">
<i class="fal fa-map-marked-alt"></i><strong><?php echo __("Map Settings","premiumpress"); ?></strong>
<p><?php echo __("Here you can setup your maps.","premiumpress"); ?></p>
</a>

<a href="javascript:void(0);" class="_admin_iconbox icon-box" onclick="jQuery('#h-tab').trigger('click');window.scrollTo({ top: 0, behavior: 'smooth' });">
<i class="fal fa-home"></i><strong><?php echo __("Homepage Search Box","premiumpress"); ?></strong>
<p><?php echo __("If you have a search box on your homepage, edit it here.","premiumpress"); ?></p>
</a>


<div id="overviewlist"></div>   
 
</div>


<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?>