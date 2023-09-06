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

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


if(isset($filter_data['tax'])){

	$taxonomy = $filter_data['tax'];
	
	register_taxonomy( $taxonomy, THEME_TAXONOMY.'_type', array( 'hierarchical' => true, 'labels' => array('name' => $taxonomy) , 
	'query_var' => true, 'rewrite' => true, 'rewrite' => array('slug' => $taxonomy) ) ); 
 	
	$parent = 0;
	if(isset($GLOBALS['flag-parent-id'])){
	$parent = $GLOBALS['flag-parent-id'];
	}
	 
	$count = 1;
	
	// HIDE EMPTY
	$hideempty = 1;
	if($filter_data['nav'] == 1){
	$hideempty = 0;
	}
	
	// GET TERMS
	$cats = get_terms( $taxonomy, array( 'hide_empty' => $hideempty, 'parent' => $parent  ));
	 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if(empty($cats)){
?>
<div class="tax_wrapper">
<div class="tax-div text-center">
<?php echo __("All","premiumpress"); ?>
</div>
</div>
<?php


}elseif(!empty($cats) && $taxonomy == "listing" && (THEME_KEY == "dl" || _ppt(array('lst','makemodels')) == '1') ){ 

$GLOBALS['ncats']= $cats;
if(!isset($_POST['action'])){
$GLOBALS['flag-inside-sidebar'] = 1;
}
_ppt_template( 'filters/filter-tax-listing-dropdown' );  


}elseif(!empty($cats) && $taxonomy == "listing" && (is_admin() || !isset($_POST['action']) ) ){   

$GLOBALS['ncats']= $cats;

_ppt_template( 'filters/filter-tax-listing' ); 


}elseif(!empty($cats) && $taxonomy == "listing"){ 

$GLOBALS['ncats']= $cats;

_ppt_template( 'filters/filter-tax-listing-dropdown' );  
 
}elseif(!empty($cats)){
 

?>


<div class="tax_wrapper <?php echo $filter_data['wrap_css']; ?> <?php  if($filter_data['nav'] == 1){ ?>max_height_desc<?php echo $taxonomy; ?><?php } ?>">

<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$count = 1; 
foreach($cats as $cat){  
		
			//if($count > 200){ continue; }
			
			// DEFAULT GENDER FOR DATING THEME
			if( in_array(THEME_KEY, array("da")) && $taxonomy == "dagender" && !isset($_GET['tax-dagender']) ){ 
			
				 $_GET['tax-'.$taxonomy] = get_user_meta($userdata->ID,'da-seek2',true);
				 
			}
			
		 ?>

<div class="tax-div tax-val-<?php echo $cat->term_id; ?> <?php echo $filter_data['css']; ?>">

<label class="custom-control custom-checkbox f-<?php echo $taxonomy."-".$cat->term_id; ?>">
	
    <input 
    type="checkbox" <?php if(isset($GLOBALS['flag-taxonomy-id']) && $GLOBALS['flag-taxonomy-id'] == $cat->term_id ){  ?>disabled<?php } ?> 
    value="<?php echo $cat->term_id; ?>" 
    name="catid[]" 
    class="custom-control-input customfilter" 
    data-type="checkbox" 
    onclick="_filter_update()" 
    data-key="taxonomy" 
    data-value="<?php echo $taxonomy; ?>-<?php echo $cat->term_id; ?>"
        <?php if(isset($_GET['tax-'.$taxonomy]) && $_GET['tax-'.$taxonomy] == $cat->term_id){ echo "checked=checked"; } ?>
    >

    <div class="custom-control-label" data-countkey="<?php echo $taxonomy; ?>-<?php echo $cat->term_id; ?>">
      
      <?php if(in_array($taxonomy,array("xxxxxxxxxxxxxxxxxxxxxxxxxx"))){ ?>
      <a href="<?php echo get_term_link( $cat->term_id, $taxonomy); ?>" class="text-dark">
      <?php } ?> 
      
      <div class="d-flex justify-content-between">
      
          <div class="filtertxt"><?php echo $CORE->GEO("translation_tax_value", array($cat->term_id, $cat->name));  ?> </div>
          
          <div class="<?php if($filter_data['count'] != 1){ ?>addcount<?php } ?>" data-countkey="<?php echo $taxonomy; ?>-<?php echo $cat->term_id; ?>"><?php if($filter_data['count'] == 1 && $cat->count > 0){ ?><span class="badge badge-primary text-light"><?php echo $cat->count; ?></span> <?php } ?></div>
          
      </div>      
      
      <?php if(in_array($taxonomy,array("xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"))){ ?>
      </a>
      <?php } ?>
      
    </div>

</label>

</div>
<?php $count++; } ?>
</div>
<?php } 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if($filter_data['nav'] == 1){ ?>

<ul class="nav nav-tabs w-100 mb-4">
  <li class="nav-item mx-auto">
    <a class="nav-link active tiny text-uppercase text-600" href="#" onclick="SetMaxHeightlisting<?php echo $taxonomy; ?>();"><span class="showmoreless<?php echo $taxonomy; ?>"><?php echo __("Show All","premiumpress") ?></span></a>
  </li>
</ul>

<style>
.max_height_desc<?php echo $taxonomy; ?>:not(.showmore<?php echo $taxonomy; ?>) { height:95px; overflow:hidden; }
@media (max-width: 575.98px) { 
.max_height_desc<?php echo $taxonomy; ?>:not(.showmore<?php echo $taxonomy; ?>) { height:85px; overflow:hidden;   }
.max_height_desc<?php echo $taxonomy; ?> { font-size:12px; margin-top:20px; }
}
</style>
<script>

function SetMaxHeightlisting<?php echo $taxonomy; ?>(){
	
	if(jQuery('.showmore<?php echo $taxonomy; ?>').length > 0){	
		jQuery('.max_height_desc<?php echo $taxonomy; ?>').removeClass('showmore<?php echo $taxonomy; ?>');	
		 jQuery('.showmoreless<?php echo $taxonomy; ?>').html("<?php echo __("Show All","premiumpress") ?>");	
	}else{	
		jQuery('.max_height_desc<?php echo $taxonomy; ?>').addClass('showmore<?php echo $taxonomy; ?>');
		jQuery('.showmoreless<?php echo $taxonomy; ?>').html("<?php echo __("Hide","premiumpress") ?>");
	}

}
</script> 

<?php } 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


if(empty($cats)){
?>
<script type="text/javascript"> 
jQuery(document).ready(function(){ 
	jQuery(".wrap_filter_<?php echo $filter_data['key']; ?>").hide();	
});
</script>
<?php 

}
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


}

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 
 ?>