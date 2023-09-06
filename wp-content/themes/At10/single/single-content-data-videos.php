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

global $CORE, $userdata, $post;
 

   // ADMIN PREVIEW
    if(!isset($post->ID)){
		$post = new stdClass();
		$post->ID 			= 1;
		$post->post_title 	= "This is a sample title."; 
		$post->post_author 	= 1; 
		$post->post_excerpt = "";
		$post->post_content = "";
		$post->comment_count = 0;
		$post->thistheme = THEME_KEY;
	}
	
	$videos = $CORE->MEDIA("get_all_videos", $post->ID); 
	
	$youtubeid = get_post_meta($post->ID,'youtube_id',true); 	 
	if($youtubeid != ""){		 
	$foundvideo =1;	
		
				$i = count($videos)+1;
				$videos[$i] = array(
					"name" 		=> "",
					"thumbnail" => "https://i.ytimg.com/vi/".$youtubeid."/hqdefault.jpg", 
					"src" 		=> "https://i.ytimg.com/vi/".$youtubeid."/hqdefault.jpg",
					"id" 		=> "youtube",
				);
		
	}
		
	$videid = get_post_meta($post->ID,'vimeo_id',true);
	if($videid != ""){		
	$foundvideo =1;	
	
		  		$vimg = CDN_PATH."images/nophoto.jpg";
				$i = count($videos)+1;
				$videos[$i] = array(
					"name" 		=> "",
					"thumbnail" => $vimg, 
					"src" 		=> $vimg,
					"id" 		=> "vimeo",
				);
		
	}
	 
	// 
	if(defined('WLT_DEMOMODE') && empty($videos) ){
	
	
		$videos[0] = array(
			"name" 		=> "",
			"thumbnail" => DEMO_IMGS."?video=1&t=".THEME_KEY, 
			"src" 		=> DEMO_IMGS."?video=1&t=".THEME_KEY,
			"id" 		=> "youtube",
		);
	
	} 
	
	$showVids = 0; 
	
	

?> 

<div class="addeditmenu" data-key="video" style="margin-right:100px;"></div>
<?php if(!empty($videos)){ ?>
<div class="row">
<?php 


foreach($videos as $f){
 

if(!isset($f['published']) || isset($f['published']) && $f['published'] == "1"){

	$array = explode('.', $f['thumbnail']);
	$extension = end($array);
	
	if(defined('WLT_DEMOMODE')){
		 
	}elseif( substr($f['thumbnail'],0,4) != "http" || !in_array($extension, array("jpg","jpeg","png","gif"))) {	
		if(strlen(_ppt('fallback_image_video')) > 5 ){
			$f['thumbnail'] = _ppt('fallback_image_video');					
		}else{ 
			$f['thumbnail'] = CDN_PATH."images/novideo.jpg";					
		}
	} 
	$showVids ++;

  ?> 
<div class="<?php if($showVids == 1){ ?>col-12<?php }else{ ?>col-md-4 col-4 mt-3<?php } ?>">

<div class="single-video rounded-lg overflow-hidden">
 <figure>
<a href="javascript:void(0);" onclick="processVideoOpen('<?php echo $post->ID; ?>', '<?php echo $f['id']; ?>');"> 
 
<img data-src="<?php echo $f['thumbnail']; ?>" src="data:image/svg+xml,%3Csvg xmlns='https://www.w3.org/2000/svg' viewBox='0 0 3 2'%3E%3C/svg%3E" class="img-fluid lazy" alt="user video" <?php if($showVids == 1){ ?>style="min-height:220px;"<?php }else{ ?><?php } ?>>

<?php if($showVids == 1){ ?><i class="fa fa-play-circle opacity-8" style="font-size:80px; left:45%;"></i><?php } ?>
     
</a>
        
 </figure>
		 
</div></div>
<?php } } ?>
</div>
<?php } ?>