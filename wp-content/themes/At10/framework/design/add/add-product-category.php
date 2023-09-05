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


$cats = get_terms( 'listing', array( 'hide_empty' => 0 ));
 
if( !empty($cats) ){

?> 

<div class="block-header mt-4">
<h3 class="block-header__title"><?php echo __("Organize","premiumpress"); ?></h3>
<div class="block-header__divider"></div> 
</div> 

 
<?php
  

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 

// GET FIELDS
$cfields = array();

$taxonomies = get_taxonomies();

 
foreach ( $taxonomies as $taxonomy ) {
 
	// SKIP BAD TAX
	if(in_array($taxonomy, array('nav_menu','category','post_tag','post_format','link_category','listing','elementor_library_type','elementor_library_category', 'elementor_font_type', 

'topic-tag', 'product_type', 'product_visibility', 'product_cat', 'product_tag', 'product_shipping_class', 'pa_color', 'pa_size', 'advanced_ads_groups','events_categories','events_tags', 'wpbdp_category','age','make','model')) || 
	strpos($taxonomy,"plugin") !== false || 
	strpos($taxonomy,"yst") !== false || 
	strpos($taxonomy,"forms") !== false ||
	strpos($taxonomy,"-tags") !== false ||
	strpos($taxonomy,"-categories") !== false ||
	strpos($taxonomy,"-category") !== false ||
	
	strpos($taxonomy,"wp_") !== false ||
	
	strpos($taxonomy,"elementor") !== false ){ continue; }  
	
	
	 
	
	// NEW
	if(in_array($taxonomy, array("features","country","city")) ){ 	
	continue;	
	}
	
	// SKIP HIDE TAXONOMIES
	if(is_array(_ppt('hidetax')) && in_array($taxonomy, _ppt('hidetax')) ){
	continue;
	}
	
	// SKIP ALREADY ADDED TAXONOMIES
	if(isset($cfields['taxonomy']) && in_array($taxonomy, $cfields['taxonomy']) ){
	continue;
	} 
	

	// GET DATA
	if(in_array($taxonomy, array("listing"))){	
		$cats = get_terms( array( 'taxonomy' => $taxonomy, 'parent' => 0, 'hide_empty' => 0 )  );	
	}else{	
		$cats = get_terms( array( 'taxonomy' => $taxonomy,  'hide_empty' => 0  )  );	
	}	 

	// IF NOT ADMIN AND IS EMPTY, HIDE
	if(empty($cats) ){ //!is_admin() && 
	continue;
	} 
 

// GET CATEGORY LIST FROM TERMS OBJEC
$selected_categories = array();
if(isset($_GET['eid'])){ 
	$foundcats 	= wp_get_object_terms( $_GET['eid'], $taxonomy );
	if(is_array($foundcats) && !empty($foundcats)){
		foreach($foundcats as $cat){
			$selected_categories[$cat->term_id] = $cat->term_id;
		}
	}	
}


 


$display_caption = $CORE->GEO("translation_tax_key", $taxonomy);
 
if($taxonomy == "color"){
	$txicon = "fa fa-fill-drip";
}elseif($taxonomy == "size"){
	$txicon = "fa fa-swatchbook";
}elseif(_ppt(array('taxicon', $taxonomy)) != ""){ 
	$txicon = str_replace("fa fa ","fa ", _ppt(array('taxicon', $taxonomy))); 
}else{ 
	$txicon = "fa fa-cog";	
} 

?>


<div class="form-group">

  <label class="w-100 mb-2" style="z-index:100;">
  <?php if(is_admin()){ ?>
  
  
  
  <a href="<?php echo home_url(); ?>/wp-admin/edit-tags.php?taxonomy=<?php echo $taxonomy ?>&post_type=listing_type" target="_blank" class="float-right btn-system btn-sm ml-3"><?php echo __("Manage","premiumpress"); ?></a>
 
 
  <?php if(THEME_KEY == "sp" && in_array($taxonomy, array("color","size")) ){ ?>
  
  
  <a class="float-right btn-system btn-sm" href="javascript:void(0);" onClick="StartCopyNew<?php echo $taxonomy ?>(0,0);"><?php echo __("Add Price Change","premiumpress"); ?></a>
  <script>
  
	  function StartCopyNew<?php echo $taxonomy ?>(k, v){
	  
		var newfield = jQuery('#copynew-<?php echo $taxonomy ?>').clone(true).prependTo('#copynew-<?php echo $taxonomy ?>-list').show();
	 
		//addClass('testing123');
		 
		// NOW SET VALUES
		if(k != 0){
				newfield.find('select').attr('name','custom[price_addone_<?php echo $taxonomy; ?>][]').val(k);
				newfield.find('input').attr('name','custom[price_addone_'+k+'_value]').attr('disabled', false).val(v);
		}	
		
		i=1;
		 
	  }
  
    jQuery(document).ready(function(){
		jQuery('.copynewselect').on('change', function() {
			 
			val = jQuery(this).val();
			
			jQuery(this).attr('name','custom[price_addone_'+ jQuery(this).attr("data-tax") +'][]');
			
			jQuery(this).parent().parent().addClass('testing666').find('input').attr('name','custom[price_addone_'+ val +'_value]').attr('disabled', false);
			
		});
	});
  
  </script>
 
   
  <?php
  
  if(isset($_GET['eid']) && is_numeric($_GET['eid']) ){
	  $v = get_post_meta($_GET['eid'], 'price_addone_'.$taxonomy, true );
	  if(is_array($v)){
		foreach($v as $po){
			
			$pv = get_post_meta($_GET['eid'],'price_addone_'.$po.'_value', true);
			 
			if($pv != ""){
			?>        
			<script>                
             jQuery(document).ready(function(){  StartCopyNew<?php echo $taxonomy ?>('<?php echo $po; ?>','<?php echo $pv; ?>');  });               
            </script>
            <?php
			}
		
		}
	  }  
  }
  
  ?>
  
  
  <?php } ?>
 
  <?php }?>
  
  <?php echo $display_caption; ?></label>
  
  
<?php if(THEME_KEY == "dl" && $taxonomy == "make"){ ?>








<?php  }else{ 

 
?>
   
  
  <select 
<?php  if( in_array($taxonomy, array("color","size")) || is_array(_ppt('taxmulti')) && in_array($taxonomy, _ppt('taxmulti'))  ){ ?> 

class="form-control border selectpicker" 
name="tax[<?php echo $taxonomy ?>][]"  
multiple  data-size="5" 

data-show-subtext="true" data-live-search="true"  

title=" " 

<?php }elseif($taxonomy == "features"){ ?>
class="form-control border selectpicker" 
multiple data-size="5" 

data-show-subtext="true" data-live-search="true"  
name="tax[<?php echo $taxonomy ?>][]"
title=" "
<?php }else{ ?>

class="form-control border select-tax-<?php echo $taxonomy ?>"  
name="tax[<?php echo $taxonomy ?>]" <?php } ?>>

<?php

if(!empty($cats)){
foreach($cats as $cat){  
 
?>
  <option <?php if(in_array($cat->term_id, $selected_categories) ){ echo "selected=selected";  }  ?> value="<?php echo $cat->term_id; ?>">
  <?php if($cat->parent != 0){ ?>
  --
  <?php } ?>
 <?php echo $CORE->GEO("translation_tax", array($cat->term_id, $cat->name)); ?></option>
  <?php  } } ?>
  
</select> 





<?php if(THEME_KEY == "sp" && in_array($taxonomy, array("color","size")) ){ ?>



<div id="copynew-<?php echo $taxonomy; ?>-list"></div>

<div class="container px-0 mt-2" id="copynew-<?php echo $taxonomy; ?>" style="display:none;">
<div class="row">
    
    <div class="col-md-6"> 
   
  <select class="form-control border copynewselect" data-tax="<?php echo $taxonomy; ?>" name="">
  <option value=""></option>
  <?php if(!empty($cats)){ foreach($cats as $cat){  
 
?>
  <option  value="<?php echo $cat->term_id; ?>">
  <?php if($cat->parent != 0){ ?>
  --
  <?php } ?>
 <?php echo $CORE->GEO("translation_tax", array($cat->term_id, $cat->name)); ?></option>
  <?php  } } ?>
   </select> 

   
    </div>
    <div class="col-md-6">
    
    <div class="position-relative"> 
    <input type="text" name="" disabled class="form-control numericonly" style="padding-left:30px;"  />
    
    
  
     <div class="position-absolute" style="top: 10px; font-size:12px; right: 10px; cursor:pointer; color:red; z-index:100" onclick="jQuery(this).prev('input').val('').parent().parent().parent().parent().hide();">
     <i class="fa fa-times"></i>
     </div>
     <div class="position-absolute" style="top: 10px; font-size:14px; left: 10px; color:#666"><?php echo hook_currency_symbol(''); ?></div>
    
    
    </div>
    
    </div>
</div>
</div>
 

<?php } ?>

 
</div>
<?php } ?>



<?php }

}


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


if(defined('WLT_CART') && is_admin() && !in_array(THEME_KEY, array("ph")) ){ ?>

<div class="block-header mt-4">
<h3 class="block-header__title"><?php echo __("Tax &amp; Shipping","premiumpress"); ?></h3>
<div class="block-header__divider"></div> 
</div> 
 
<div class="row mb-4">
  <div class="col-6">
    <label><?php echo __("Enable Tax","premiumpress"); ?></label>
    <div class="formrow">
      <label class="radio off">
      <input type="radio" name="toggle" 
               value="off" onchange="document.getElementById('enable_tax').value='0'">
      </label>
      <label class="radio on">
      <input type="radio" name="toggle"
               value="on" onchange="document.getElementById('enable_tax').value='1'">
      </label>
      <div class="toggle <?php if(isset($_GET['eid']) && $CORE->get_edit_data('tax_required', $_GET['eid']) == '1'){  ?>on<?php } ?>">
        <div class="yes">ON</div>
        <div class="switch"></div>
        <div class="no">OFF</div>
      </div>
    </div>
    <input type="hidden" id="enable_tax" class="form-control" name="custom[tax_required]" value="<?php if(isset($_GET['eid'])){  echo $CORE->get_edit_data('tax_required', $_GET['eid']); } ?>">
  </div>
  <div class="col-6">
    <label><?php echo __("Enable Shipping","premiumpress"); ?></label>
    <div class="formrow">
      <label class="radio off">
      <input type="radio" name="toggle" 
               value="off" onchange="document.getElementById('enable_shipping').value='0'">
      </label>
      <label class="radio on">
      <input type="radio" name="toggle"
               value="on" onchange="document.getElementById('enable_shipping').value='1'">
      </label>
      <div class="toggle <?php if(isset($_GET['eid']) &&  $CORE->get_edit_data('ship_required', $_GET['eid']) == '1'){  ?>on<?php } ?>">
        <div class="yes">ON</div>
        <div class="switch"></div>
        <div class="no">OFF</div>
      </div>
    </div>
    <input type="hidden" id="enable_shipping" class="form-control" name="custom[ship_required]" value="<?php if(isset($_GET['eid'])){ echo $CORE->get_edit_data('ship_required', $_GET['eid']); } ?>">
  </div>
</div>
<?php } ?>


<?php if(isset($_GET['tax']) && strlen($_GET['tax']) > 1){ ?>
<script>

jQuery(document).ready(function(){ 
	
	jQuery(".select-tax-<?php echo strip_tags($_GET['tax']); ?> option[value='<?php echo strip_tags($_GET['taxid']); ?>']").prop('selected', true);
	
	jQuery(".select-tax-<?php echo strip_tags($_GET['tax']); ?>").trigger('onchange');
	
});

</script>
<?php } ?>