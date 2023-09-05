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
 