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

global $CORE, $post, $userdata, $new_settings, $CORE_UI; 
 

$title = "";
switch(THEME_KEY){

	
	case "es": {
	$title = __("Services","premiumpress");
	} break;

	case "da": {
	$title = __("My Interests","premiumpress");
	} break;

	case "mj": {
	$title = __("Why Choose Me?","premiumpress");
	} break;	
	
	case "ll": {
	$title = __("Skills you will gain","premiumpress");
	} break;	
		
	case "jb": {
	$title = "";
	} break; 
	
	case "dt": {
	$title = __("Amenities","premiumpress");
	} break; 
	
	default: {	
	$title = __("Features","premiumpress");
	} break;
} 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$descTitle = 1;

if(isset($new_settings['block_title'])){
	$descTitle  = $new_settings["block_title"];
}
if(isset($GLOBALS['flag-featurs-title-set'])){
$descTitle = 0;
}

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$features = array();

if(!isset($post->ID) || is_admin() ){

	$features = array(
		1 => array("name" => "feature 1", "icon" => "fa fa-check"),
		2 => array("name" => "feature 2", "icon" => "fa fa-check"),
		3 => array("name" => "feature 3", "icon" => "fa fa-check"),
		4 => array("name" => "feature 4", "icon" => "fa fa-check"), 
	);
}else{

if(!in_array(THEME_KEY, array("vt","sp","cp")) && in_array(_ppt(array('design', 'display_features')), array("","1")) ){ 

	$selected_array =  wp_get_post_terms($post->ID, "features", true);	
	if(is_array($selected_array) && !empty($selected_array) ){
		
		foreach($selected_array as $val){
			
			//if(isset($val->term_id)
			
			$features[] = array(
				"name" => $CORE->GEO("translation_tax", array($val->term_id,  $val->name)),
				"icon"	=> "fa fa-check",
				
			);
		}
	
	}
	
}

}
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 
?>

<?php if(!empty($features)){ ?>
<div class="addeditmenu" data-key="features"></div>
<?php if($descTitle){ ?>
<div class="my-3 fs-7 text-600"><?php echo $title; ?></div> 
<?php } ?>
 
<div class="row lh-30 fs-sm">
<?php foreach($features as $f){ ?>
<div class="col-md-4">

<div class="d-flex">

    <div ppt-icon-24 data-ppt-icon-size="24" class="text-primary"><?php echo $CORE_UI->icons_svg['check']; ?></div>
    <div class="ml-2 ftxt"><?php echo $f['name'];  ?></div> 
</div>

</div>
<?php	}  ?>
</div>

<?php } ?>