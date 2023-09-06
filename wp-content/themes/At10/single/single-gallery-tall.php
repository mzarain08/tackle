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

global $CORE, $userdata, $CORE_UI;

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

// LIGHTBOX FIX FOR ELMENTOR
$lightbox = 'data-toggle="lightbox"';

if(in_array(_ppt(array('design','elementor_lightbox')), array("1"))){ 
  $lightbox = "";
}

  
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


// GET FILES
$files = $CORE->MEDIA("get_formatted_images_for_header", array(0)); 
 
$GLOBALS['images_set'] = 1;
 
 
$fc = count($files);    
$i=0; 

$showEmpty = 1;
if( _ppt(array('gallery', 'empty')) == "0"){
$showEmpty = 0;
}

if( ( empty($files) && $showEmpty == 1) || !empty($files)){

?>

<div class="addeditmenu" data-key="images"></div>
<div id="mobileGalleryMove" class="hide-mobile">
<div class="row no-gutters mb-4">
  <?php 
while($i < 6){ $endLink = 0; $blur = 0; 
 	
	$imgsrc = "";
	if(isset($files[$i]["thumbnail"])){ 
	
		$imgsrc =  $files[$i]["thumbnail"]; 
		
	}else{
		if(!$showEmpty){
			$i++;
			continue;
		}
	}
	 
?>
  <div class="col-6">
    <?php if(isset($files[$i]["src"]) && strlen($files[$i]["src"]) > 2){ if(!$CORE->USER("membership_hasaccess", "view_photos")){ ?>
    <a onclick="processUpgrade();" href="javascript:void(0);">
    <?php }else{ ?>
    <a href="<?php if(isset($files[$i]["src"])){ echo $files[$i]["src"];  } ?>" <?php echo $lightbox; ?> data-gallery="ppt-full-gallery" data-type="image">
    <?php } } ?>
    <div class="m-sm-1">
      <div class="position-relative rounded overflow-hidden img-wrap border-0"  ppt-border1>
        <div class="bg-image" style="background-image:url('<?php echo $imgsrc; ?>');">
          &nbsp;
        </div>
        <?php if($i == 5 && $fc > 7){ ?>
        <div class="allphotos z-10 h-100 position-absolute w-100 y-middle text-light text-700">
          <?php echo __("All Photos","premiumpress"); ?>
        </div>
        <div class="overlay-inner" style="z-index:1">
        </div>
        <?php } ?>
      </div>
    </div>
    <?php if(isset($files[$i]["src"]) && strlen($files[$i]["src"]) > 2){ ?>
    </a>
    <?php } ?>
  </div>
  <?php $i++; } ?>

<?php if($fc > 0){ $i=1; foreach($files as $f){ if($i > 6 && isset($files[$i]["src"]) && strlen($files[$i]["src"]) > 2){ ?>
  <a href="<?php if(isset($files[$i]["src"])){ echo $files[$i]["src"];  } ?>" <?php echo $lightbox; ?> data-gallery="ppt-full-gallery" data-type="image"></a>
  <?php } $i++; } } ?>
  
</div>
</div>

<style>

.img-wrap  { height:450px; }
@media (max-width: 575.98px) {
.img-wrap  { height:250px; margin:5px; }
}
</style>

<?php } ?>