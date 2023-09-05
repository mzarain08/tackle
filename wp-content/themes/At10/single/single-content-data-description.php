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

$descTitle = 0;

if(isset($new_settings['block_title'])){
	$descTitle  = $new_settings["block_title"];
}

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
?> 	
<div class="ppt-single-desc _style1">

<div class="addeditmenu" data-key="content"></div>

<?php if($descTitle){ ?>
	<h4 class="mt-4 mt-sm-0"><?php echo ppt_title_description(); ?></h4> 
<?php } ?>

<div>
        
        <?php if(is_admin() || !isset($post->ID) ){ ?>
       
       <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
       
       <p> It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
       
        <?php }elseif(defined('WLT_DEMOMODE') && THEME_KEY == "jb"){ ?>
        
        
        
       <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
      
     <div class="card-title mb-3 text-600"><?php echo __("Responsibilities","premiumpress") ?></div>
   
    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
      
    
      
      
      <div class="card-title mb-3 text-600"><?php echo __("Qualifications","premiumpress") ?></div>
    
     <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
      
    
  	
        
        
        <?php }else{ ?>
		 
		<div class="overflow-hidden">
		<?php echo do_shortcode('[CONTENT]'); ?>
        </div>
         
        
        <?php
	 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
if(defined('THEME_KEY')){
	switch(THEME_KEY){
	
		case "cp": {
		 
		
		} break;
		case "ll": {
		
		 if(strlen(get_post_meta($post->ID,'req',true)) > 5){ ?>
		 
		<h6 class="my-4 text-700"><?php echo __("Course Requirments","premiumpress"); ?></h6>
		 
		<div class="card-text">
		<?php echo str_replace("/n/n","<br><br>",wpautop(get_post_meta($post->ID,'req',true))); ?>
		</div>
		<?php } 
		
		
		} break;
	  
	}
}
}	 		
 
?>
</div>


</div>
  

<?php 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
// MUSIC SETUP

if(_ppt("audioupload_enable") == "1" && isset($post->ID) ){ //
	
	if(defined('WLT_DEMOMODE') && user_can($post->post_author, 'administrator') && in_array(THEME_KEY, array("dtxxx")) ){
		
		$music = array(
		
			"name" => "Example Audio Upload",			
			"thumbnail" => DEMO_IMG_PATH."audio/audioimage.jpg",
			"src" => DEMO_IMG_PATH."audio/sample.mp3",
		);
		
		
	
	}else{
	
		$musicfiles = $CORE->MEDIA("get_all_music", $post->ID);
		if( is_array($musicfiles) && !empty($musicfiles) ){ 
			$music =  $musicfiles[0];
		}
	
	}
}	
if(isset($music) && isset($music['src']) ){ 

 
	$un = $CORE->USER("get_username", $post->post_author);
	$hl = explode("@",$un);
	$un = $hl[0];

// MUST LOGIN TO ACCESS PHOTOS
if(!$userdata->ID && in_array(_ppt(array('design', 'display_musiclogin')), array("", "1"))  ){ ?>

<?php if(!$showAccessBox){ ?>
<div class="text-center bg-light rounded py-5 my-4">

    <i class="fal fa-music-slash text-primary mb-4 fa-4x"></i>
    
    <h4 class="mb-4 opacity-5"><?php echo __("Please login to access audio files.","premiumpress"); ?></h4>
    
    <a href="javascript:void(0);" onclick="processLogin(1);" class="btn btn-lg btn-system font-weight-bold"> <?php echo __("Login or Register","premiumpress"); ?> </a>

</div>
<?php } ?>

<?php 

// CHECK IF WE HAVE ACCESS TO THEMSE
}elseif(!$CORE->USER("membership_hasaccess", "view_music")){ ?>

<div class="text-center bg-light rounded py-5 my-4">

    <i class="fal fa-music-slash text-primary mb-4 fa-4x"></i>
    
    <h5 class="mb-4 opacity-5"><?php echo __("Please upgrade your account to access audio files.","premiumpress"); ?></h5>
    
    <a href="javascript:void(0);" onclick="processUpgrade();" class="btn btn-lg btn-system font-weight-bold"> <?php echo __("Upgrade Now","premiumpress"); ?> </a>

</div>

<?php }else{  ?>

 

<div class="row">
<?php 
 
$i=1; $showMusic =0; foreach($musicfiles as $f){

	if(!isset($f['published']) || isset($f['published']) && $f['published'] == "1"){

	$array = explode('.', $f['thumbnail']);
	$extension = end($array);

	if( substr($f['thumbnail'],0,4) != "http" || !in_array($extension, array("jpg","jpeg","png","gif"))) {	
		if(strlen(_ppt('fallback_image_video')) > 5 ){
			$f['thumbnail'] = _ppt('fallback_image_video');					
		}else{				
			$f['thumbnail'] = CDN_PATH."images/novideo.jpg";					
		}
	} 
 $showMusic++;
 
?>
 
<div class="col-md-4 col-4 mb-4">

 	<div id="audioplayer<?php echo $f['id']; ?>" class="ppt-audio" data-thumbnail="<?php echo $f['thumbnail']; ?>" data-src="<?php echo $f['src']; ?>" data-color="<?php echo _ppt(array('design','color_primary')); ?>"></div> 
 
		 
</div> 

<?php } } ?>
</div>
<?php if($showMusic  == 0){ ?>
<script>
jQuery(document).ready(function(){  jQuery("#mymusic").hide(); });
</script> 
<?php } ?>
<?php } ?>
<?php } ?>