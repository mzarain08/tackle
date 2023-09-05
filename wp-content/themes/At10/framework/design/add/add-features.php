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

if(!in_array(THEME_KEY, array("vt","sp","cp")) && in_array(_ppt(array('design', 'display_features')), array("","1")) ){ 

$title = "";
switch(THEME_KEY){


	case "es": {
	$title = __("Services","premiumpress");
	} break;

	case "da": {
	$title = __("My Interests","premiumpress");
	} break;
	
	case "ll": {
	$title = __("Skill You'll Gain","premiumpress");
	} break;

	case "mj": {
	$title = __("Why Choose Me","premiumpress");
	} break;	
	
	case "dt": {
	$title = __("Amenities","premiumpress");
	} break;		
	
	case "jb": {
	$title = "";
	} break; 
	
	default: {	
	$title = __("Features","premiumpress");
	} break;
}

// START BUILDING THE LIST
$terms = get_terms("features",'hide_empty=0&parent=0'); 
if(empty($terms)){	?>

<div class="my-4"></div>
<?php



}else{

$editID=0;
$selected_array = array();

if(isset($_GET['eid']) && is_numeric($_GET['eid'])){
$editID = $_GET['eid'];
$selected_array =  wp_get_post_terms($_GET['eid'], "features", array("fields" => "ids"));	
} 
  
?>

 
    <div class="row">
      <div class="col-12 mb-2">
      
          <?php if(is_admin() && ( function_exists('current_user_can') && current_user_can('administrator')) ){ ?>
    <a href="<?php echo home_url(); ?>/wp-admin/edit-tags.php?taxonomy=features&post_type=listing_type" target="_blank" class="tiny float-right text-uppercase"><?php echo __("manage fields","premiumpress"); ?></a>
    <?php } ?>
      
      <div class="block-header mt-4">
<h3 class="block-header__title"> <?php echo $title; ?></h3>
<div class="block-header__divider"></div> 
</div>
       
      </div>
      <?php



 
if(!empty($terms)){	

foreach($terms as $term){

if( !isset($term->term_id) ){ continue; }

$type = "checkbox";
 
?>
      <div class="<?php if(isset($_POST['eid'])){ ?>col-md-6 small<?php }else{ ?>col-md-4<?php } ?> mb-3">
        <label class="<?php echo $type; ?> custom-control custom-checkbox">
        <input type="<?php echo $type; ?>" class="form-control custom-control-input" data-toggle="<?php echo $type; ?>" name="tax[features][]" value="<?php echo $term->term_id; ?>" <?php if(in_array($term->term_id,$selected_array)){ echo "checked=checked"; } ?>>
        <span class="custom-control-label"></span>  <?php echo $CORE->GEO("translation_tax", array($term->term_id, $term->name)); ?></label>
      </div>
      <?php
}
}

?>
    </div>
 
<?php } ?>

<?php } ?>