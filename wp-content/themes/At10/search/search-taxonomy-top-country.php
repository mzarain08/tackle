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

global $CORE, $CORE_UI, $LAYOUT, $wpdb, $wp_query, $userdata;
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$term = get_term_by('slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
 
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$title = $term->name;

if($term->parent != 0){

//$term->parent

$parent  = get_term_by( 'id', $term->parent, "country" );
 
$title = $parent->name;
}

$description = "";
if( strlen($term->description) > 0){
	$description  = $term->description;
}elseif( strlen(_ppt('category_description_'.$term->term_id)) >  5){  
	$description = _ppt('category_description_'.$term->term_id);
}

if(defined('WLT_DEMOMODE') && $description == ""){
$description = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue.";
}
  
	$taxonomy = "country";
	
	register_taxonomy( $taxonomy, THEME_TAXONOMY.'_type', array( 'hierarchical' => true, 'labels' => array('name' => $taxonomy) , 
	'query_var' => true, 'rewrite' => true, 'rewrite' => array('slug' => $taxonomy) ) ); 
	
	$parent = $term->parent;
	if($parent == "0"){
	$parent = $term->term_id;
	}
  
	
	// GET TERMS
	$cats = get_terms( $taxonomy, array( 'hide_empty' => 0, 'parent' => $parent  ));
		 
 
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
<input type="hidden" name="taxonomy"  class="customfilter" data-type="text" data-key="taxonomy" value="<?php echo $GLOBALS['flag-taxonomy-type']."-".$GLOBALS['flag-taxonomy-id']; ?>" >
<?php
 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if(!empty($cats)){


?> 

<div class="container py-3">

<h1 class="text-600 mb-4 fs-md"><?php echo $title; ?></h1>
<div class="max_height_desc<?php echo $taxonomy; ?>">
<div class="row">
<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
foreach($cats as $cat){  


?>

<div class="tax-div tax-val-<?php echo $cat->term_id; ?> col-6 col-md-4 col-xl-3 text-600">

<label class="custom-control custom-checkbox f-<?php echo $taxonomy."-".$cat->term_id; ?> ccl">
	
    <input 
    type="checkbox"
    value="<?php echo $cat->term_id; ?>" 
    name="catid[]" 
    class="custom-control-input customfilter" 
    data-type="checkbox" 
    onclick="_filter_update()" 
    data-key="taxonomy" 
    data-value="<?php echo $taxonomy; ?>-<?php echo $cat->term_id; ?>"
        <?php if(isset($GLOBALS['flag-taxonomy-id']) && $GLOBALS['flag-taxonomy-id'] == $cat->term_id){ echo "checked=checked"; } ?>>

    <div class="custom-control-label" data-countkey="<?php echo $taxonomy; ?>-<?php echo $cat->term_id; ?>">
      
     
      <div class="d-flex ">
      
          <div class="filtertxt"><?php echo $CORE->GEO("translation_tax_value", array($cat->term_id, $cat->name));  ?> </div>
          
          <div class="<?php if($term->parent != 0){ ?>addcount<?php } ?> ml-3" data-countkey="<?php echo $taxonomy; ?>-<?php echo $cat->term_id; ?>"><?php if($cat->count > 0){ ?><span class="badge badge-primary text-light"><?php echo $cat->count; ?></span> <?php } ?></div>
          
      </div>      
       
    
      
    </div>

</label>

</div>
<?php  } ?>
</div>
</div></div>
<?php }     ?>

<?php if(count($cats) > 12){ ?>

<ul class="nav nav-tabs w-100 mb-4">
  <li class="nav-item mx-auto">
    <a class="nav-link active tiny text-uppercase text-600" href="#" onclick="SetMaxHeightlisting<?php echo $taxonomy; ?>();"><span class="showmoreless<?php echo $taxonomy; ?>"><?php echo __("Show All","premiumpress") ?></span></a>
  </li>
</ul>

<style>
.ccl { font-size:18px; }
.ccl .custom-control-label::before { top: 6px; }
.ccl .custom-control-label::after { top:6px;}
.max_height_desc<?php echo $taxonomy; ?>:not(.showmore<?php echo $taxonomy; ?>) { height:105px; overflow:hidden; }
@media (max-width: 575.98px) { 
.ccl { font-size:14px; }
.ccl .custom-control-label::before { top: 3px; }
.ccl .custom-control-label::after { top:3px;}
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
<?php } ?>