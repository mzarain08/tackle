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

global $userdata, $CORE, $CORE_UI, $new_settings;
 
$elementor = 0;

  

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$images = "";
if(isset($GLOBALS['flag-single-id'])){ 
$images = $CORE->MEDIA("get_formatted_images_for_header", $GLOBALS['flag-single-id']);
}

$files = array();

if(defined('WLT_DEMOMODE') || get_post_meta($post->ID,"ppt-demo",true) == "1" || is_admin() ){
$files[] = array("name" => "#434","src" => "#","icon" => "jpg.svg","size" => 3434);
$files[] = array("name" => "#3322","src" => "#","icon" => "png.svg","size" => 4433);
$files[] = array("name" => "#212","src" => "#","icon" => "zip.svg","size" => 5544);
		
}

 

if(is_array($images) && !empty($images)){
	
	foreach($images as $img){	
	
		if(isset($img['id']) && is_numeric($img['id']) && $img['id'] != 0){
	 	
		if($img['type'] == "video"){
		$files[] = array("name" => "#".$img['id'],"src" => $img['src_old'],"icon" => "jpg.svg","size" => $img['size']);
		}else{
		$files[] = array("name" => "#".$img['id'],"src" => $img['src'],"icon" => "jpg.svg","size" => $img['size']);
		}
		
		
		}
	}

}
 

if(!empty($files)){ ?> 
 
<?php $i=1; foreach($files as $file){ ?>
<div class="<?php if( $i < count($files) ){ ?>border-bottom pb-2 mb-2<?php } ?>">

<div class="d-flex">

	<div class="mr-3">
   	 <div ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['image']; ?></div>
    </div>
	<div ppt-flex-between class="w-100">
    	 <div><span class="text-600"><?php echo $file['name']; ?></span> <span class="fs-xs"><?php echo $CORE->_format_bytes($file['size']); ?></span> </div>
    	 <a href="<?php echo $file['src']; ?>" class="btn-xs btn-system" target="_blank" rel="nofollow" data-ppt-btn><?php echo __("Download","premiumpress"); ?></a>
    </div>
    
    
</div>

</div> 
 
<?php  $i++; } ?>
 
<?php } ?>