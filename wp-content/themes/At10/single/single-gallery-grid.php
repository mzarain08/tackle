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
	  
    <div class="col-12 <?php if($fc > 1){ ?> col-md-4 <?php if(isset($GLOBALS['fullgal'])){ ?>col-lg-8<?php }else{ ?>col-lg-7<?php } ?> mb-4 mb-md-0<?php } ?> mobile-mb-4">
   
    <div class="img-main <?php if($fc ==1){?>only-one<?php } ?>" ppt-border1>
    
    	<?php if(!$CORE->USER("membership_hasaccess", "view_photos")){ ?>
        
        <a onclick="processUpgrade();" href="javascript:void(0);">
        
        <?php }else{ ?>
        
			 <?php if(isset($files[0]['type']) && $files[0]['type'] == "video"){ ?> 
            <a href="javascript:void(0);" onclick="processVideoOpen('<?php echo $post->ID; ?>', '<?php echo $files[0]['id']; ?>');">
            <?php }elseif(isset($files[0])){ ?>
            <a href="<?php if(isset($files[0]["src"])){ echo $files[0]["src"];  } ?>" <?php echo $lightbox; ?> data-gallery="ppt-full-gallery" data-type="image">
            <?php } ?>
        
        <?php } ?>
       
       
        <?php if(isset($files[0]['type']) && $files[0]['type'] == "video"){ ?> 
        
          <div class="videoplaybutton_wrap" style="position: absolute;top: 40%;left: 40%;"> 
           <div class="videoplaybutton bg-primary"> 
           <i class="fa fa-play text-white"></i> 
           <span class="ripple_playbtn bg-primary"></span> 
           <span class="ripple_playbtn bg-primary"></span> 
           <span class="ripple_playbtn bg-primary"></span> 
           </div>
           </div>
        
        <?php } ?>
       
       
        <div class="bg-image" data-bg="<?php if(isset($files[0]) && isset($files[0]["src"])){ echo $files[0]["src"];  } ?>" <?php if(isset($GLOBALS['flag-elementor']) && isset($files[0]) ){ ?>style="background-image:url('<?php echo $files[0]["src"]; ?>');"<?php } ?>>&nbsp;</div>
        
        </a>
      
    </div>
     
    </div>    
     
    
    <?php if($fc > 1){ ?>
    
    <div class="col-12 <?php if(isset($GLOBALS['fullgal'])){ ?>col-lg-4<?php }else{ ?>col-lg-5<?php } ?>">   
    
     
    <div class="row no-gutters">    
    <?php
	
	$i=1;  
	
	while($i < 9){ $endLink = 0; $blur = 0;
	
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
    <div class="<?php if($i == 8){ ?>col-8<?php }else{ ?>col-4<?php } ?> col-md-4 col-lg-6">
    <div class="img-side img-<?php echo $i; ?>">    	
        
		
		<?php if($i == 8 && $fc > 7){ ?>
        
        <div class="allphotos"> 
            <a href="javascript:void(0)" onclick="jQuery('[data-type-first-image]').trigger('click');"> 
			<?php echo __("All Photos","premiumpress"); ?>
        	</a>        
        </div>
        <div class="overlay-inner" style="z-index:1"></div>
        
        <?php } ?> 
         
         
       
        	<?php if(!$userdata->ID && in_array(_ppt(array('design', 'display_photologin')), array("", "1"))){ 
			
			$endLink =1; $blur = 1; 
			
			
			if(isset($files[0]["src"])){  $imgsrc = $files[0]["src"]; }  ?>
             <a onclick="processLogin(1);" href="javascript:void(0);">
             
             		<?php if($i != 8){ ?><span class="noaccess hide-mobile"><i class="fal fa-camera"></i> <strong><?php echo __("Members Only","premiumpress"); ?></strong></span><?php } ?>
            
			<?php }elseif(!$CORE->USER("membership_hasaccess", "view_photos")){ $endLink =1; $blur = 1; if(isset($files[0]["src"])){  $imgsrc = $files[0]["src"]; }   ?>
            
            <a onclick="processUpgrade();" href="javascript:void(0);"> 
                
           		<?php if($i != 8){ ?><span class="noaccess hide-mobile"><i class="fa fa-camera"></i> <strong><?php echo __("Upgrade Now","premiumpress"); ?></strong> </span><?php } ?>
            
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
		$imgsrc = $blurImageArray[$i];
		
		?>
         <div class="overlay-inner" style="z-index:1"></div>
        <?php } ?>
        
        
        <?php if(isset($files[$i]) && $files[$i]['type'] == "video"){ ?> 
        
        <div class="vidsmall"><i class="fa fa-play-circle"></i></div>
        
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


<?php }elseif($fc == 1 ){ ?>

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


<?php 

// EXTRA IMAGES
if($fc > 8){ $i=1; foreach($files as $f){ if($i > 8 && isset($files[$i]["src"]) && strlen($files[$i]["src"]) > 2){ ?>
  <a href="<?php if(isset($files[$i]["src"])){ echo $files[$i]["src"];  } ?>" <?php echo $lightbox; ?> data-gallery="ppt-full-gallery" data-type="image"></a>
<?php } $i++; } } ?>

<div class="clearfix"></div>
<style>
#full_gallery  .img-main { min-height:400px; border-radius:10px; height:100%; background:#fff; overflow: hidden; position: relative; }
#full_gallery  .img-main.only-one { min-height:500px; }
#full_gallery .img-side { height:120px; border-radius:10px; background:#fff; margin: 0px 0px 0px 10px; overflow:hidden;     position: relative; margin-bottom:10px;

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
#full_gallery .img-side { margin: 5px 5px 0px 0px; height:90px;  }
#full_gallery  .img-main { min-height:250px; background:none!important; border:0px!important; box-shadow:none!important; margin:20px 0px; }
#full_gallery  .img-main.only-one { min-height:300px; }
#full_gallery .allphotos {    top: 35px !important; }
 
 
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