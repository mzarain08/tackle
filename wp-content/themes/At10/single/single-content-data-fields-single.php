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

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$elementor = 0;
$showStyle = 1;
$showSize = "lg";

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////



///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if(isset($GLOBALS['single-data-field'])){
	 
	$data = ppt_theme_listing_data_single("all");
	 
	$newF = array();
	foreach($data as $k => $d){	 
		 
		if($k == $GLOBALS['single-data-field'] ){
		$newF[$k]  = $data[$k];
		}		
	}
 	$data = $newF;
	
}elseif(isset($new_settings['fields_single_style']) ){
	
	$data = ppt_theme_listing_data_single("all");
 	$elementor =1;
	$newF = array();
	foreach($data as $k => $d){	 
		 
		if($k == $new_settings['fields_single_data'] ){
		$newF[$k]  = $data[$k];
		}		
	}
 	$data = $newF; 
	
	/*$showEmptyFields 	= $new_settings['fields_single_empty'];*/
	$showStyle 			= $new_settings['fields_single_style'];
	$showSize 			= $new_settings['fields_single_size'];

}
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

switch($showStyle){

	case "1": {
	 
		foreach($data as $k => $d){ 
		
			$value = $d['data'];
			
			if(isset($d['example']) && $elementor == 1){
			$value = $d['example'];
			}
			
			 
		?>
		
			<span class="data-fields-single _style1 <?php if(isset($d['css']) ){ echo $d['css']; } ?> <?php echo $showSize; ?> field-key-<?php echo $k; ?> field-tax-<?php if(isset($d['tax'])){ echo $d['tax']; } ?> <?php if(isset($d['type']) && $d['type'] == "price"){ echo $CORE->GEO("price_formatting",array()); } ?>">
			<?php echo $value; ?>
            </span> 
		
		<?php } 
	
	
	} break;
	
	case "2": {
	?>
   		<div class="data-fields-single _style2 <?php echo $showSize; ?>">
		
        <?php foreach($data as $d){
		
			$value = $d['data'];
		
			if(isset($d['example']) && $elementor == 1){
			$value = $d['example'];
			}
		
		?>
		
		<div class="d-flex justify-content-between">
		
		<span><?php echo $d['label']; ?></span>
		
		<span class="<?php if(isset($d['type']) && $d['type'] == "price"){ echo $CORE->GEO("price_formatting",array()); } ?>"><?php echo $value; ?></span>
		
		</div>
		
		<?php }  ?>
        
        </div>
        <?php
	
	
	} break;

}


?> 