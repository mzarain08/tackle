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
$data = ppt_theme_listing_buttons("all");
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
if(isset($new_settings['buttons']) && !empty($new_settings['buttons']) && count($new_settings['buttons']) > 1 ){
	
	$elementor = 1;
	$oldF = $data;
	$newF = array(); 
 	 
	foreach($new_settings['buttons'] as $k => $d){
		if(isset($oldF[$k])){	 
		$newF[$k] = $oldF[$k];		
		 }
	}
	$data = $newF;
	 
}elseif(isset($GLOBALS['single-data-field'])){
	 
	$newF = array();
	
	foreach($data as $k => $d){	 
		 
		if($d['name'] == $GLOBALS['single-data-field'] || $d['tax'] == $GLOBALS['single-data-field']){
		$newF[$k]  = $data[$k];
		}		
	}
 	$data = $newF;

}else{
	if(!empty($data)){
	$data = $CORE->multisort($data, array('order'));
	}
}

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 

if(!empty($data)){
?>

<div class="ppt-single-button-box">
 

<?php $count = 1; foreach($data as $k => $v){

	if(( isset($GLOBALS['docs-preview']) && $GLOBALS['docs-preview'] != "single_top") || $elementor == 1 || ( $elementor == 0 && isset($v['show']) && in_array("single_top", $v['show'] )  ) ){


		if(isset($GLOBALS['single-data-button-hide']) && is_array($GLOBALS['single-data-button-hide']) && in_array($k, $GLOBALS['single-data-button-hide']) ){
		continue;
		}
	
	
		if($count > 3){
		$GLOBALS['single-data-button-css'] = " hide-mobile";
		}
		 
		$GLOBALS['single-data-button'] = $k;
		echo _ppt_template( 'single/single-content-data-buttons' ); 
		unset($GLOBALS['single-data-button']); 
	
		$count++; }  

}

?>   
</div>
<?php } ?>