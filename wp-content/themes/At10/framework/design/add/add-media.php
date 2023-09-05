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


$showToolbar = 1;

$show_photos = 1;
$show_videos = 1;
$show_youtube = 1;
$show_vimeo = 1;
$show_audio = 1;


	switch(THEME_KEY){
		
		case "ph":
		case "cp": {
		
		 	$show_photos = 1;
		 	$showToolbar = 0;
			$show_videos = 0;
			$show_youtube = 0;
			$show_vimeo = 0;
			$show_audio = 0;
			
		} break;
		
		case "cb": {
		
		 	$show_videos = 0;			
			$show_audio = 0;
			
		} break;
		case "vt": {
		
		 	$show_photos = 0;			
			$show_audio = 0;
			
		} break;
		
		case "es": {
		
		 	$show_youtube = 0;
			$show_vimeo = 0;
			
		} break;
		
		case "jb": {
		 
			$show_audio = 0;
			
		} break;
	 
		default: {
		
			 
			 
		} break;
		
	}
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
			
			if(!in_array(_ppt("videoupload_basic"),array("","1"))){
			$show_videos = 0;
			}
			
			if(!in_array(_ppt("videoupload_youtube"),array("","1"))){
			$show_youtube = 0;
			}
			
			if(!in_array(_ppt("videoupload_vimeo"),array("","1"))){
			$show_vimeo = 0;
			}
			
			if(!in_array(_ppt("audioupload_enable"),array("1"))){
			$show_audio = 0;
			}
 			
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 

if(THEME_KEY == "jb"){

	_ppt_template('framework/design/add/add-meida-icon' );  

}


if($show_photos){ 

	$GLOBALS['file_key'] = "photo";
	_ppt_template('framework/design/add/add-files' );
	
} 

 
if($show_videos){
	   
	   if( THEME_KEY == "vt" ){  $show_youtube = 0; $show_vimeo = 0;
	   
	   _ppt_template('framework/design/add/add-video-single' );
	   
	   
	   
	   }else{ ?>
      
    <?php 
	$GLOBALS['file_key'] = "video";
	_ppt_template('framework/design/add/add-files' ); ?>
        
      <?php } ?>
        
 
      <?php } ?>
      
      
      <?php if($show_youtube){ ?>
    
        <?php _ppt_template('framework/design/add/add-youtube' ); ?>
   
      <?php } ?>
      
      
     <?php if($show_vimeo){ ?>
  
        <?php _ppt_template('framework/design/add/add-vimeo' ); ?>
   
      <?php } ?>
      
     <?php if($show_audio){ ?>
  
    <?php 
	$GLOBALS['file_key'] = "audio";
	_ppt_template('framework/design/add/add-files' ); ?>
   
<?php } ?>  