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

global $CORE, $post, $userdata, $CORE_UI; 

//if(!isset($GLOBALS['global_gallery_code'])){ 
//return;
//}
//$GLOBALS['global_gallery_code'] = 1;

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
$files = $CORE->MEDIA("get_formatted_images_for_header", 0);
$fc = count($files);   

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 

$blur = BlurImages(1,10,10);
foreach($blur as $bi){
 $blurImageArray[] = DEMO_IMG_PATH."blurimages/".$bi.".jpg";
}
 
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$showEmpty = 1;
if( _ppt(array('gallery', 'empty')) == "0"){
$showEmpty = 0;
}
 
if( ( empty($files) && $showEmpty == 1) || !empty($files)){
  
 
?>
 
<div class="addeditmenu" data-key="images"></div>
<div id="mobileGalleryMove" class="hide-mobile">
<?php if($fc > 1){ ?>

<div class="container <?php if(isset($GLOBALS['fullgal'])){ }else{ ?>px-0 mb-4<?php } ?>" id="full_gallery">

<div class="row no-gutters">
	 
       
    <?php if($fc > 1){ ?>
    
    <div class="col-12">   
    
     
    <div class="row no-gutters">    
    <?php
	
	$i=0;  
	
	while($i < 12){ $endLink = 0; $blur = 0;
	
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
    <div class="col-4 col-md-4 col-lg-3">
    <div class="img-side img-<?php echo $i; ?>">    	
        
		
		<?php if($i == 11 && $fc >  8){ ?>
        
        <div class="allphotos"> 
            <a href="javascript:void(0)" onclick="jQuery('[data-type-first-image]').trigger('click');"> 
			<?php echo __("All Photos","premiumpress"); ?>
        	</a>        
        </div>
        <div class="overlay-inner" style="z-index:1"></div>
        
        <?php } ?> 
         
          
        	<?php if(!$userdata->ID && in_array(_ppt(array('design', 'display_photologin')), array("", "1"))){ $endLink =1; $blur = 1; if(isset($files[0]["src"])){  $imgsrc = $files[0]["src"]; }  ?>
             <a onclick="processLogin(1);" href="javascript:void(0);">
             
             		<?php if($i != 8){ ?><span class="noaccess hide-mobile"><i class="fal fa-camera"></i> <strong><?php echo __("Members Only","premiumpress"); ?></strong></span><?php } ?>
            
			<?php }elseif(!$CORE->USER("membership_hasaccess", "view_photos")){ $endLink =1; $blur = 1; if(isset($files[0]["src"])){  $imgsrc = $files[0]["src"]; }   ?>
            
            <a onclick="processUpgrade();" href="javascript:void(0);">
            	
                
           		<?php if($i != 11){ ?><span class="noaccess hide-mobile"><i class="fa fa-camera"></i> <strong><?php echo __("Upgrade Now","premiumpress"); ?></strong> </span><?php } ?>
            
            <?php }elseif(isset($files[$i]["src"])){ $endLink =1;?>
            
            	<?php if($files[$i]['type'] == "video"){ ?>
                
                <a href="javascript:void(0);" onclick="processVideoOpen('<?php echo $post->ID; ?>', '<?php echo $files[$i]['id']; ?>');">
                
                <?php }else{ if(!isset($fimage)){ $fimage = "data-type-first-image"; }else{ $fimage = ""; } ?>
                
                <a href="<?php echo $files[$i]["src"]; ?>" <?php echo $lightbox; ?> data-gallery="ppt-full-gallery" <?php echo $fimage; ?> data-type="image">
                
                <?php } ?> 
            
            <?php } ?> 
       
        <?php if(strlen($imgsrc) > 1){ ?>
        
        <?php if($blur){ 
		
		// RANDOM BLUR IMAGE
		if(isset($blurImageArray[$i])){
		$imgsrc = $blurImageArray[$i];
		}else{
		$imgsrc = "";
		}
		
		
		?>
         <div class="overlay-inner" style="z-index:1"></div>
        <?php } ?>
        
        
        <?php if(isset($files[$i]) && $files[$i]['type'] == "video"){ ?> 
        
        <div class="vidsmall" style="font-size: 50px; top: 20%;"><i class="fa fa-play-circle"></i></div>
        
        <?php } ?>
        
        
        <div class="bg-image <?php if($blur){ echo "blurme blurme-".$i; } ?>" data-bg="<?php echo $imgsrc; ?>" <?php if(isset($GLOBALS['flag-elementor'])){ ?>style="background-image:url('<?php echo $imgsrc; ?>');"<?php } ?>>&nbsp;</div> 
        <?php } ?>
               
       <?php if($endLink){ ?> </a><?php } ?>
       
    </div>
    </div>
    <?php $i++; } ?> 
    </div>  
    
    </div>
    <?php } // more than 1 image ?>
    
</div>
</div>


<?php }elseif($fc == 1 ){  ?>

<div class="card card-single-image mb-4 mobile-mb-4 text-center">
    <div class="card-body text-center">
        <a href="<?php  echo $files[0]["src"]; ?>" <?php echo $lightbox; ?> data-gallery="ppt-full-gallery" data-type="image">
        <img src="<?php echo $files[0]['thumbnail']; ?>" class="lazy img-fluid" alt="image" <?php if($files[0]['type'] != "screenshot"){ ?>style="max-width:400px;"<?php } ?> />
        </a>
    </div>
</div> 
<?php }else{ ?>
 

<?php } ?>
</div>
<div class="clearfix"></div>
<style>
 
#full_gallery .img-side { <?php if(in_array(THEME_KEY,array("es","da"))){ ?>height:280px; line-height:200px; <?php }else{ ?>height:120px;<?php } ?>  border-radius:10px; background:#fff; margin: 0px 0px 0px 10px; overflow:hidden;     position: relative; margin-bottom:10px;

box-shadow: 0 1px 2px 0 rgb(0 0 0 / 5%);
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid var(--ppt-border-grey);
    border-radius: 0.25rem;
 }
#full_gallery .img-side.img-8, #full_gallery .img-side.img-7 { margin-bottom:0px; }

#full_gallery .img-side .noaccess {     top: 25%;    position: absolute;    text-align: center;    width: 100%; z-index:3;  color: #fff; }
#full_gallery .img-side .noaccess i {font-size: 30px; opacity:0.1;    }
#full_gallery .img-side .noaccess strong { display:block; font-size:11px; margin-top:10px; }
#full_gallery .img-side:hover { opacity:0.7 }

@media (max-width: 575.98px) {
#full_gallery .img-side { margin: 5px 5px 0px 0px; <?php if(in_array(THEME_KEY,array("es","da"))){ ?> height:160px;<?php }else{ ?>height:90px;<?php } ?>  }
#full_gallery  .img-main { min-height:250px; background:none!important; border:0px!important; box-shadow:none!important; margin-top:20px; }
#full_gallery  .img-main.only-one { min-height:300px; }
#full_gallery .allphotos {    top: 35px !important; <?php if(in_array(THEME_KEY,array("es","da"))){ ?> line-height:90px; <?php } ?> }
 
}
@media (min-width: 575.98px) {
#full_gallery .img-2 { border-top-right-radius: 6px; } 
#full_gallery .img-8 { border-bottom-right-radius: 6px; } 
}
#full_gallery .allphotos { z-index:999; position: absolute;    text-align: center;    width: 100%;    top: 50px; }
#full_gallery .allphotos a { color:#FFFFFF; font-weight:700; }

@media (max-width: 575.98px) {
#mobileGallery { min-height:200px; padding-bottom:20px; }
#mobileGallery .img-main .bg-image {  background-size: contain;     background-repeat: no-repeat; }
#mobileGallery .shadow { box-shadow:none!important; }
}
.vidsmall {    position: absolute;    top: 35%;    z-index: 1;    color: #fff;    font-size: 30px;    text-align: center;    width: 100%; }
.blurme { filter: blur(8px);   }
</style>
<?php } ?>