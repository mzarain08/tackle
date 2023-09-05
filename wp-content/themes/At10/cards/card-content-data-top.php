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

global $CORE, $post, $userdata, $new_settings; 

$elementor = 0;

$fieldsData = ppt_theme_card_data('defaults');

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 
if(isset($new_settings['card_top_style'])){

	$elementor = 1;

}
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 
foreach($fieldsData as $k => $f){
	
	if($elementor == 1 || ( $elementor == 0 && isset($f['show']) && in_array("grid_top", $f['show'] ) ) ){
	
	$value = $f['data'];
	if($elementor == "1" && $value == ""){
		if(isset($f['example'])){
		$value = $f['example'];
		}else{
		$value = "{user data}";
		}
	}
	if($value == ""){ continue; }
	?>
    
    <span class="<?php if(isset($f['type']) && $f['type'] == "price"){ echo $CORE->GEO("price_formatting",array()); } ?>"> <?php if(isset($f['label'])){ echo $f['label']; } ?> <?php echo $value; ?> </span>
    <?php
	 
	} 
}

if(in_array(THEME_KEY, array("at","pj"))){ ?>

<div class="show-mobile-inline"><div class=" style="display: inline-block!important;""><i class="fal fa-clock ml-2"></i> <?php echo do_shortcode("[TIMELEFT]"); ?></div></div>

<?php }


?>