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

global $CORE, $settings;

 // COUNT CATEGOEIES FOR TURNING OFF OPTIONS
   $cats = get_terms( 'listing', array( 'hide_empty' => 0 )); 
   
  
  $settings = array(
  
  "title" => __("Media Setting","premiumpress"), 
  "desc" => __("Here are additional settings for user media files.","premiumpress") ,
  
  "back" => "overview",
  );
   _ppt_template('framework/admin/_form-wrap-top' ); 
   
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
   
?>
<div class="card card-admin">
  <div class="card-body">
  
    <?php if( THEME_KEY == "vt"  ){ ?>
  
    <?php }else{ ?>
    
    
    
    
    
    
    <?php if( THEME_KEY == "vt"  ){ ?>
    <input type="hidden" name="admin_values[lst][default_listing_require_image]" value="0">
    <?php }else{ ?>

    
    
          <div class="container px-0 border-bottom mb-3">
      <div class="row py-2">
        <div class="col-md-8 pr-lg-5">
          <label><?php echo __("Image Uploads","premiumpress"); ?></label>
          <p class="text-muted"><?php echo __("Turn  on/off the option for users to upload images.","premiumpress"); ?></p>
        </div>
        <div class="col-md-2">
          <div class="mt-4 formrow">
            <label class="radio off">
            <input type="radio" name="toggle" 
                        value="off" onchange="document.getElementById('default_imguploads').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
                        value="on" onchange="document.getElementById('default_imguploads').value='1'">
            </label>
            <div class="toggle <?php if(in_array(_ppt(array('lst', 'default_imguploads')), array("","1"))){  ?>on<?php } ?>">
              <div class="yes">ON</div>
              <div class="switch"></div>
              <div class="no">OFF</div>
            </div>
          </div>
          <input type="hidden" id="default_imguploads" name="admin_values[lst][default_imguploads]" value="<?php if(in_array(_ppt(array('lst', 'default_imguploads')), array("","1"))){ echo 1; }else{ echo 0; } ?>">
        </div>
      </div>
    </div>
    
    <!-- ------------------------- -->
    <div class="container px-0 border-bottom mb-3 ">
      <div class="row py-2">
        <div class="col-md-8">
          <label><?php echo __("Image Required","premiumpress"); ?></label>
          <p class="text-muted"><?php echo __("Turn on to force the user to upload an image.","premiumpress"); ?></p>
        </div>
        <div class="col-md-2">
          <div  class="mt-3 formrow">
            <label class="radio off">
            <input type="radio" name="toggle" 
                        value="off" onchange="document.getElementById('default_listing_require_image').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
                        value="on" onchange="document.getElementById('default_listing_require_image').value='1'">
            </label>
            <div class="toggle <?php if(_ppt(array('lst', 'default_listing_require_image' )) == '1'){  ?>on<?php } ?>">
              <div class="yes">ON</div>
              <div class="switch"></div>
              <div class="no">OFF</div>
            </div>
          </div>
          <input type="hidden" id="default_listing_require_image" name="admin_values[lst][default_listing_require_image]" value="<?php if(_ppt(array('lst', 'default_listing_require_image')) == ""){ echo 0; }else{ echo _ppt(array('lst', 'default_listing_require_image')); } ?>">
        </div>
      </div>
    </div>
    
    <?php } ?>
    
    
    
    
    
    
 
 
 
 <?php if( in_array(THEME_KEY, array("dt","cp"))  ){ ?>
    <!-- ------------------------- -->
    <div class="container px-0 border-bottom mb-3">
      <div class="row py-2">
        <div class="col-md-7 pr-lg-5">
          <label><?php echo __("Screenshot Images","premiumpress"); ?></label>
          <p class="text-muted"><?php echo __("Display a screenshot of the website if no other exists.","premiumpress"); ?></p>
       
       
       
       
        </div>
        <div class="col-md-5">
          <div class="mt-1 formrow">
            <label class="radio off">
            <input type="radio" name="toggle" 
                        value="off" onchange="document.getElementById('default_screenshot').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
                        value="on" onchange="document.getElementById('default_screenshot').value='1'">
            </label>
            <div class="toggle <?php if(_ppt(array('lst', 'default_screenshot' )) == '1'){  ?>on<?php } ?>">
              <div class="yes">ON</div>
              <div class="switch"></div>
              <div class="no">OFF</div>
            </div>
          </div>
          
          <input type="hidden" id="default_screenshot" name="admin_values[lst][default_screenshot]" value="<?php echo _ppt(array('lst', 'default_screenshot' )); ?>">
            
            
           <?php if(THEME_KEY != "cp"){ ?> 
          <?php $cfields = get_option("cfields");   ?>
          <label class="mt-4"><?php echo __("Which field holds the website link?","premiumpress"); ?></label>
          <div>
          <select class="form-control" name="admin_values[lst][default_screenshot_key]" >
          <?php 
		  $i=0;
		  foreach($cfields as $k=>$f){  
		  
		  if(isset($cfields['dbkey'][$i]) && $cfields['dbkey'][$i] !="" && isset($cfields['name'][$i]) && $cfields['name'][$i] != "" ){ ?>
          <option value="<?php  echo $cfields['dbkey'][$i]; ?>" <?php if($cfields['dbkey'][$i] == _ppt(array('lst','default_screenshot_key'))){ echo "selected=selected"; } ?>><?php echo $cfields['name'][$i]; ?></option>
          <?php } $i++; } ?> 
          
          </select>
          </div>
          <?php } ?>
      <?php
	  
	  $providers = array(
	  
	  "thum" => "thum.io",
	  //"url2png" => "url2png",
	  
	  "browshot" => "browshot",
	 //"google" => "Google",
	  
	  );
	    
	  ?>
      
      
        <label class="mt-4"><?php echo __("Which screenshot provider to use?","premiumpress"); ?></label>
          <div>
          <select class="form-control" id="screenshot-sel" name="admin_values[lst][default_screenshot_provider]" onchange="showssss(this.value);">
          
          <?php 
		  $i=0;
		  foreach($providers as $k=>$f){  ?>
          <option value="<?php  echo $k; ?>" <?php if($k == _ppt(array('lst','default_screenshot_provider'))){ echo "selected=selected"; } ?>><?php echo $f; ?></option>
          <?php } ?> 
          
          </select>
          </div>
          
          <script>
		   jQuery(document).ready(function(){		   
		  	 
			 showssss(jQuery("#screenshot-sel").val())
			 
		   });
		   
		   function showssss(id){
		     	
				 	
		   		jQuery(".screenshot-service").hide();
			
				jQuery("#screenshots-"+id).show();
		   
		   }
		  </script>
          
          
          <div class="screenshot-service" id="screenshots-thum" style="display:none;">
          
              <label class="mb-2 mt-3">thum.io Auth Key (xxx-website) </label>
              <input type="text" name="admin_values[screenshots][thum_api]" value="<?php echo _ppt(array('screenshots','thum_api')); ?>" class="form-control">
              
              <p class="small mt-2 opacity-5">Visit Thumb.io <a href="https://www.thum.io/" target="_blank">here</a></p>
          
          </div>
          <?php /*
             <div class="screenshot-service" id="screenshots-url2png" style="display:none;">
          
              <label class="mb-2 mt-3">Auth Key</label>
              <input type="text" name="admin_values[screenshots][url2png_api]" value="<?php echo _ppt(array('screenshots','url2png_api')); ?>" class="form-control">
              
              <label class="mb-2 mt-3">Secret Key </label>
              <input type="text" name="admin_values[screenshots][url2png_secret]" value="<?php echo _ppt(array('screenshots','url2png_secret')); ?>" class="form-control">
             
              
              <p class="small mt-2 opacity-5">Visit url2png.com <a href="https://www.url2png.com/" target="_blank">here</a></p>
          
          </div>*/ ?>
          
             <div class="screenshot-service" id="screenshots-browshot" style="display:none;">
          
              <label class="mb-2 mt-3">API Key </label>
              <input type="text" name="admin_values[screenshots][browshot_api]" value="<?php echo _ppt(array('screenshots','browshot_api')); ?>" class="form-control">
              
              <label class="mb-2 mt-3">Instance ID </label>
              <input type="text" name="admin_values[screenshots][browshot_in]" value="<?php echo _ppt(array('screenshots','browshot_in')); ?>" class="form-control">
             
              
              <p class="small mt-2 opacity-5">Visit browshot.com <a href="https://www.browshot.com/" target="_blank">here</a></p>
          
          </div>
      
      
      </div>
          
          
      </div>
      
      
     
      </div>
      
 
 <?php } ?>
 
 
 
 
 
 
    <!-- ------------------------- -->
    <div class="container px-0 border-bottom mb-3">
      <div class="row py-2">
        <div class="col-md-8 pr-lg-5">
          <label><?php echo __("Max File Uploads","premiumpress"); ?></label>
          <p class="text-muted"><?php echo __("Set the max number of images a member can upload.","premiumpress"); ?></p>
        </div>
        <div class="col-md-3">
          <div class="input-group mb-3">
            <div class="input-group-prepend"> <span class="input-group-text"><i class="fa fa-image"></i></span> </div>
            <input type="text" name="admin_values[lst][default_images]" class="form-control" value="<?php if(_ppt(array('lst','default_images')) == ""){ echo 10; }else{ echo _ppt(array('lst','default_images')); } ?>">
          </div>
        </div>
      </div>
    </div>
    
    
    <!-- ------------------------- -->
    <div class="container px-0 border-bottom mb-3">
      <div class="row py-2">
        <div class="col-md-8 pr-lg-5">
          <label><?php echo __("Max Video Uploads","premiumpress"); ?></label>
          <p class="text-muted"><?php echo __("Set the max number of videos a user can upload.","premiumpress"); ?></p>
        </div>
        <div class="col-md-3">
          <div class="input-group mb-3">
            <div class="input-group-prepend"> <span class="input-group-text"><i class="fa fa-video"></i></span> </div>
            <input type="text" name="admin_values[lst][default_videos]" class="form-control" value="<?php if(_ppt(array('lst','default_videos')) == ""){ echo 10; }else{ echo _ppt(array('lst','default_videos')); } ?>">
          </div>
        </div>
      </div>
    </div>

    <!-- ------------------------- -->
    <div class="container px-0 border-bottom mb-3">
      <div class="row py-2">
        <div class="col-md-8 pr-lg-5">
          <label><?php echo __("Max Audio Uploads","premiumpress"); ?></label>
          <p class="text-muted"><?php echo __("Set the max number of audio files a user can upload.","premiumpress"); ?></p>
        </div>
        <div class="col-md-3">
          <div class="input-group mb-3">
            <div class="input-group-prepend"> <span class="input-group-text"><i class="fa fa-video"></i></span> </div>
            <input type="text" name="admin_values[lst][default_music]" class="form-control" value="<?php if(_ppt(array('lst','default_music')) == ""){ echo 10; }else{ echo _ppt(array('lst','default_music')); } ?>">
          </div>
        </div>
      </div>
    </div>

    <!-- ------------------------- -->
    <div class="container px-0 border-bottom mb-3 ">
      <div class="row py-2">
        <div class="col-md-8">
          <label><?php echo __("Image Ratio","premiumpress"); ?></label>
          <p class="text-muted"><?php echo __("Set the default size for newly uploaded images.","premiumpress"); ?></p>
        </div>
        <div class="col-md-4">
        
  		<?php $g = _ppt(array('lst', 'default_ratio'));   ?> 
        
          <select name="admin_values[lst][default_ratio]" class="mt-2 form-control" style="width:100%">
          <?php foreach(array("free", "16:10", "16:9", "5:3", "5:4", "4:3", "3:2", "1:1") as $r){ ?>
           <option value="<?php echo $r; ?>" <?php if( $g  ==  $r){ echo "selected=selected"; } ?>><?php if($r == ""){ echo __("Any Size","premiumpress"); }else{ echo $r; } ?></option>   
         
          <?php } ?>
            
           
          </select>
          
        </div>
      </div>
    </div>
  
   
  
    <div class="container px-0 border-bottom mb-3">
      <div class="row py-2">
        <div class="col-md-8 pr-lg-5">
          <label><?php echo __("Hide Featured Image","premiumpress"); ?></label>
          <p class="text-muted"><?php echo str_replace("%s", strtolower($CORE->LAYOUT("captions","2")), __("Turn ON to hide the first image from the image gallery on the %s page.","premiumpress")); ?></p>
        </div>
        <div class="col-md-2">
          <div class="mt-4 formrow">
            <label class="radio off">
            <input type="radio" name="toggle" 
                        value="off" onchange="document.getElementById('hide_featuredimage').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
                        value="on" onchange="document.getElementById('hide_featuredimage').value='1'">
            </label>
            <div class="toggle <?php if(_ppt(array('lst', 'hide_featuredimage' )) == '1'){  ?>on<?php } ?>">
              <div class="yes">ON</div>
              <div class="switch"></div>
              <div class="no">OFF</div>
            </div>
          </div>
          <input type="hidden" id="hide_featuredimage" name="admin_values[lst][hide_featuredimage]" value="<?php echo _ppt(array('lst', 'hide_featuredimage' )); ?>">
        </div>
      </div>
    </div>
	 
     
     
     
     <?php if(!in_array(THEME_KEY, array("vt"))){ ?>
 <!-- ------------------------- -->
    <div class="container px-0 border-bottom mb-3 ">
      <div class="row py-2">
        <div class="col-md-5">
          <label><?php echo __("Audio Uploads","premiumpress"); ?></label>
          <p class="text-muted"><?php echo __("User audio file uploads.","premiumpress"); ?></p>
        </div>
        <div class="col-md-7">
          <div class="row px-0">
            <?php 


$videopak = array(

	1 => array("key" => "enable", "name" => "mp3 & mpeg" ),
 
	
);

foreach($videopak as $k => $f ){ ?>
            <div class="col-md-6">
              <label class="custom-control custom-checkbox">
              <input type="checkbox" 
        value="1" 
       
        class="custom-control-input" 
        id="audioupload_<?php echo $f['key']; ?>check" 
        onchange="ChekVidPak('#audioupload_<?php echo $f['key']; ?>');"
         
		<?php if(_ppt("audioupload_".$f['key']) == 1){ ?>checked=checked<?php } ?>>
              <input type="hidden" name="admin_values[audioupload_<?php echo $f['key']; ?>]" id="audioupload_<?php echo $f['key']; ?>add" value="<?php if(_ppt("audioupload_".$f['key']) == "" || _ppt("audioupload_".$f['key']) == 1){ echo 1; }else{ echo 0; } ?>">
              <span class="custom-control-label"><?php echo $f['name']; ?></span> </label>
            </div>
            <?php  } ?>
          </div>
        </div>
      </div>
    </div>
     <?php }else{ ?>
     <input type="hidden" name="admin_values[audioupload_enable]" value="0" />
     <?php } ?>
     
    <?php } ?>
     
     
     
     
     
    <!-- ------------------------- -->
    <div class="container px-0 border-bottom mb-3 ">
      <div class="row py-2">
        <div class="col-md-5">
          <label><?php echo __("Video Uploads","premiumpress"); ?></label>
          <p class="text-muted"><?php echo __("Select which services are available.","premiumpress"); ?></p>
        </div>
        <div class="col-md-7">
          <div class="row px-0">
            <?php 


$videopak = array(

	1 => array("key" => "basic", "name" => "User" ),
	2 => array("key" => "youtube", "name" => "YouTube" ),
	3 => array("key" => "vimeo", "name" => "Vimeo" ),
	
);

foreach($videopak as $k => $f ){ ?>
            <div class="col-md-4">
              <label class="custom-control custom-checkbox">
              <input type="checkbox" 
        value="1" 
       
        class="custom-control-input" 
        id="videoupload_<?php echo $f['key']; ?>check" 
        onchange="ChekVidPak('#videoupload_<?php echo $f['key']; ?>');"
         
		<?php if(_ppt("videoupload_".$f['key']) == 1){ ?>checked=checked<?php } ?>>
              <input type="hidden" name="admin_values[videoupload_<?php echo $f['key']; ?>]" id="videoupload_<?php echo $f['key']; ?>add" value="<?php if(_ppt("videoupload_".$f['key']) == "" || _ppt("videoupload_".$f['key']) == 1){ echo 1; }else{ echo 0; } ?>">
              <span class="custom-control-label"><?php echo $f['name']; ?></span> </label>
            </div>
            <?php  } ?>
          </div>
        </div>
      </div>
    </div>
    
 
    <script>
		function ChekVidPak(div){
		
			if (jQuery(div+'check').is(':checked')) {			
				jQuery(div+'add').val(1);			
			}else{			
				jQuery(div+'add').val(0);
			}
		
		}
		</script>
    <!-- ------------------------- -->
    <div class="container px-0 border-bottom mb-3 ">
      <div class="row py-2">
        <div class="col-md-8">
          <label><?php echo __("Video Auto Play","premiumpress"); ?></label>
          <p class="text-muted"><?php echo __("Turn on/off the video auto play feature.","premiumpress"); ?></p>
        </div>
        <div class="col-md-2">
          <div  class="mt-3 formrow">
            <label class="radio off">
            <input type="radio" name="toggle" 
                        value="off" onchange="document.getElementById('videoautoplay').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
                        value="on" onchange="document.getElementById('videoautoplay').value='1'">
            </label>
            <div class="toggle <?php if(_ppt(array('lst', 'videoautoplay' )) == '1'){  ?>on<?php } ?>">
              <div class="yes">ON</div>
              <div class="switch"></div>
              <div class="no">OFF</div>
            </div>
          </div>
          <input type="hidden" id="videoautoplay" name="admin_values[lst][videoautoplay]" value="<?php if(_ppt(array('lst', 'videoautoplay')) == ""){ echo 0; }else{ echo _ppt(array('lst', 'videoautoplay')); } ?>">
        </div>
      </div>
    </div>
 
    
    <?php if(THEME_KEY == "vt" ){ ?>
    <div class="container px-0 border-bottom mb-3">
      <div class="row py-2">
        <div class="col-md-8 pr-lg-5">
          <label><?php echo __("Login To Watch Videos","premiumpress"); ?></label>
          <p class="text-muted"><?php echo __("Force users to login before they can watch all videos.","premiumpress"); ?></p>
        </div>
        <div class="col-md-2">
          <div class="mt-4 formrow">
            <label class="radio off">
            <input type="radio" name="toggle" 
                        value="off" onchange="document.getElementById('requirelogin_videos').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
                        value="on" onchange="document.getElementById('requirelogin_videos').value='1'">
            </label>
            <div class="toggle <?php if( _ppt(array('lst', 'requirelogin_videos' )) == '1'){  ?>on<?php } ?>">
              <div class="yes">ON</div>
              <div class="switch"></div>
              <div class="no">OFF</div>
            </div>
          </div>
          <input type="hidden" id="requirelogin_videos" name="admin_values[lst][requirelogin_videos]" value="<?php echo _ppt(array('lst', 'requirelogin_videos' )); ?>">
        </div>
      </div>
    </div>
    <?php } ?>
 
      
       
    <div class="p-4 bg-light text-center mt-4">
      <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
    </div>
  </div>
</div>
<!-- end admin card -->
<?php _ppt_template('framework/admin/_form-wrap-bottom' );  


  $settings = array(
  
  "title" => __("Fallback Images","premiumpress"), 
  "desc" => __("A fallback image is an image displayed when no other image is available.","premiumpress") ,
  
  "back" => "overview",
  );
   _ppt_template('framework/admin/_form-wrap-top' ); 
?>

<div class="card card-admin">
  <div class="card-body">

    <div class="row mt-4 border-bottom pb-3">
      <div class="col-lg-6 mb-4 mb-lg-0">
        <label><?php if(!in_array(THEME_KEY,array("vt")) ){ echo $CORE->LAYOUT("captions","2"); } ?> <?php echo __("Fallback Image","premiumpress"); ?></label>
        <p class="text-muted"><?php echo str_replace("%s", strtolower($CORE->LAYOUT("captions","1")), __("This is the image that will be displayed when no other image is assigned to the %s.","premiumpress")); ?></p>
        <p class="text-muted"><?php echo __("Recommended size","premiumpress"); ?>: 800x600</p>
        
        <img data-src="<?php echo CDN_PATH."images/nophoto.jpg"; ?>" class="lazy"  style="max-width:100px; " />
        
      </div>
      <div class="col-lg-6 mb-4 mb-lg-0">
      
       
<?php echo $CORE->MEDIA("customUploadForm", "fallback_image"); ?> 
    </div>  
      </div>
      
      
      
    <div class="row mt-4 border-bottom pb-3">
      <div class="col-lg-6 mb-4 mb-lg-0">
        <label><?php echo __("Video Fallback Image","premiumpress"); ?></label>
        <p class="text-muted"><?php echo  __("This is the image displayed on video thumbnails if the user does not add their own.","premiumpress"); ?></p>
        <p class="text-muted"><?php echo __("Recommended size","premiumpress"); ?>: 800x600</p>
        
        
        
        <img data-src="<?php echo CDN_PATH."images/novideo.jpg"; ?>" class="lazy"  style="max-width:100px; " />
        
      </div>
      <div class="col-lg-6 mb-4 mb-lg-0">
      
       
<?php echo $CORE->MEDIA("customUploadForm", "fallback_image_video"); ?> 
    </div>  
      </div>
      
      
<?php if(!in_array(THEME_KEY,array("vt")) ){ ?>
    <div class="row mt-4 border-bottom pb-3">
      <div class="col-lg-6 mb-4 mb-lg-0">
        <label><?php echo __("Audio Fallback Image","premiumpress"); ?></label>
        <p class="text-muted"><?php echo  __("This is the image displayed on audio thumbnails if the user does not add their own.","premiumpress"); ?></p>
        <p class="text-muted"><?php echo __("Recommended size","premiumpress"); ?>: 800x600</p>
      </div>
      <div class="col-lg-6 mb-4 mb-lg-0">
      
       
<?php echo $CORE->MEDIA("customUploadForm", "fallback_image_audio"); ?> 
    </div>  
      </div>

<?php } ?>           
      
<?php

// GET CATS

if(!empty($cats) && count($cats) > 1){ 

?> 
    <div class="row mt-4 border-bottom pb-3">
      <div class="col-lg-6 mb-4 mb-lg-0">
        <label> <?php echo __("Category Image Fallback","premiumpress"); ?></label>
        <p class="text-muted"><?php echo __("This is the image that will be displayed when no other category image can be found.","premiumpress"); ?></p>
        <p class="text-muted"><?php echo __("Recommended size","premiumpress"); ?>: 800x600</p>
      </div>
      <div class="col-lg-6 mb-4 mb-lg-0">
      
       
<?php echo $CORE->MEDIA("customUploadForm", "fallback_category"); ?> 
    </div>  
      </div>
      
      
      
    <!-- ------------------------- -->
    <div class="container px-0 border-bottom mb-3 pt-3 ">
      <div class="row py-2">
        <div class="col-md-8">
          <label><?php echo __("Hide Sub Category Images","premiumpress"); ?></label>
          <p class="text-muted"><?php echo __("This will hide the large sub category images on parent category pages.","premiumpress"); ?></p>
        </div>
        <div class="col-md-2">
          <div  class="mt-3 formrow">
            <label class="radio off">
            <input type="radio" name="toggle" 
                        value="off" onchange="document.getElementById('hide_sub_cats').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
                        value="on" onchange="document.getElementById('hide_sub_cats').value='1'">
            </label>
            <div class="toggle <?php if( in_array(_ppt(array('lst', 'hide_sub_cats')), array("1"))){  ?>on<?php } ?>">
              <div class="yes">ON</div>
              <div class="switch"></div>
              <div class="no">OFF</div>
            </div>
          </div>
          <input type="hidden" id="hide_sub_cats" name="admin_values[lst][hide_sub_cats]" value="<?php if(in_array(_ppt(array('lst', 'hide_sub_cats')), array("1"))  ){ echo 1; }else{ echo 0; } ?>">
        </div>
      </div>
    </div>

<?php } ?>
      
<?php   if( THEME_KEY == "cp"){ ?>

    <div class="row mt-4">
      <div class="col-lg-6 mb-4 mb-lg-0">
        <label> <?php echo __("Store Image Fallback","premiumpress"); ?></label>
        <p class="text-muted"><?php echo __("This is the image that will be displayed when no other store image can be found.","premiumpress"); ?></p>
        <p class="text-muted"><?php echo __("Recommended size","premiumpress"); ?>: 800x600</p>
      </div>
      <div class="col-lg-6 mb-4 mb-lg-0">
      
       
<?php echo $CORE->MEDIA("customUploadForm", "fallback_store"); ?> 
    </div>  
      </div>

<?php } ?>   

       
    <div class="p-4 bg-light text-center mt-4">
      <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
    </div>
    
  </div>
</div>
<!-- end admin card -->
<?php _ppt_template('framework/admin/_form-wrap-bottom' );  