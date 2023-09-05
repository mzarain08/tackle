<?php

class framework_media extends framework_layout {

	// SET THE ACCEPTED FILE TYPES
  	public $allowed_image_types = array('image/jpg','image/jpeg','image/png','image/svg+xml','image/svg');	 //'image/gif',	
	public $allowed_video_types = array('video/x-flv', 'video/mp4', 'video/webm', 'video/ogg', 'video/ovg','video/mpeg' );
	public $allowed_music_types = array('audio/mpeg','audio/mp3');
	public $allowed_doc_types = array('application/pdf','application/msword','application/octet-stream','text/plain', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document','application/vnd.openxmlformats-officedocument.wordprocessingml.template','application/vnd.ms-word.document.macroEnabled.12','application/vnd.ms-word.template.macroEnabled.12');
	public $allowed_zip_types = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/x-compressed');
	
	
	
	public $media_set = array(); // STORES ARRAY OF MEDIA FILES ALREADY SET
	
 
 
function democheck($img){
	
	
	if(strpos($img,"catimgid=") !== false){
		$img = DEMO_IMGS.$img."&t=".THEME_KEY;
		if(isset($_SESSION['design_preview'])){
			$img .= "&ct=".$_SESSION['design_preview'];
		}
	
	
	}elseif(strpos($img,"iconimgid=") !== false){
		$img = DEMO_IMGS.$img."&t=".THEME_KEY;
		if(isset($_SESSION['design_preview'])){
			$img .= "&ct=".$_SESSION['design_preview'];
		}
	
	
	}elseif(strpos($img,"imgid=") !== false){
		$img = DEMO_IMGS.$img."&t=".THEME_KEY;
		if(isset($_SESSION['design_preview'])){
			$img .= "&ct=".$_SESSION['design_preview'];
		}
	}


return $img;
}
 
function MEDIA($action='add', $order_data = "123", $data = array()){
 

	global $userdata, $wpdb, $CORE;
 
	switch($action){ 
	
	case "get_formatted_images_for_header": {
		
		
		$includeVideos = 1;
		if(is_array($order_data) && !empty($order_data)){
		
		$postID = $order_data[0];
		$includeVideos = 0;
		
		}else{
		$postID = $order_data;
		}
		
	
		
		// CHECK FOR DEFAULT
		if($postID == "0" && isset($GLOBALS['flag-single-id']) ){
		$postID = $GLOBALS['flag-single-id'];
		}
		
		if(THEME_KEY == "vt"  ){		
		return array();		
		}	
	
		// GET FILES
		$files = $CORE->MEDIA("get_all_images", $postID);			
		 	
		// REMOVED NON-PUBLISHED
		if(!empty($files) && count($files) > 1 ){
			$newarray = array();
			foreach($files as $f){
				if(!isset($f['published']) || isset($f['published']) && $f['published'] == "1"){
				$newarray[] = $f;
				}
			}
			$files = $newarray; 
		} 
		
		// REMOVED FIRST IMAGE
		if( _ppt(array('lst', 'hide_featuredimage')) == "1" && count($files) > 1 ){
			unset($files[0]);
			$flagtopremoved = 1;
		}
		 
			
	
		// RESET INDEX
		$files = array_values($files); 		
		$maxCount = 11;	
		
	 
		// EXTRA FOR DEMO
		if(is_admin() || ($postID == 0 || get_post_meta($postID,"ppt-demo",true) == "1") ){ 
		 
			if( in_array(THEME_KEY,array("pj","ph")) ){			
			
			}elseif( count($files) < $maxCount  ){  
				 
				$custom_image = get_post_meta($postID,"image",true);			 
				// UPDATE DEMO IMAGE DATA
				if(strpos($custom_image,"imgid=") !== false){
					$custom_image = DEMO_IMGS.$custom_image."&t=".THEME_KEY;
					if(isset($_SESSION['design_preview'])){
						$custom_image .= "&ct=".$_SESSION['design_preview'];
					}
				}  
				 
				$i = count($files);
				while($i < $maxCount){
					
					if(isset($flagtopremoved) && $i == 0){
					//$i++; continue;
					}  
				  
					if(strpos($custom_image,"imgid=") !== false){
					$new = $custom_image;
					$new .= "&sub=".$i;
					}else{
					$new = DEMO_IMG_PATH."demo/wall".$i.".jpg";
					}
							
					$files[$i] = array(
							"name" 		=> "Example Image",						 
							"thumbnail" => $new,
							"src" 		=> $new,
							"ID" 		=> 1,
							"type"		=> "image/jpeg",
							);
					$i++; 
				}
				
				// RESET INDEX
				$files = array_values($files);		
			
			}
		}
		
		if(THEME_KEY == "dt" && _ppt(array('lst','default_screenshot')) == "1"){
			$youtube = array(
					"name" 		=> "",						 
					"thumbnail" => $this->screenshot($postID),
					"src" 		=> "",
					"id" 		=> "screenshot",
					"type"		=> "screenshot",
			);
			array_unshift($files, $youtube);
		}
		
		if($includeVideos){
		// ADD ON YOUTUBE
		$youtubeid = get_post_meta($postID,'youtube_id',true);
		if($youtubeid != ""){	
			$youtubevid = 1; 
			$youtube = array(
					"name" 		=> "",						 
					"thumbnail" => "https://i.ytimg.com/vi/".$youtubeid."/hqdefault.jpg",
					"src" 		=> "https://i.ytimg.com/vi/".$youtubeid."/hqdefault.jpg",
					"id" 		=> "youtube",
					"type"		=> "video",
			);
			array_unshift($files, $youtube);			
		}
		
		// ADD VIMEO
		$youtubeid = get_post_meta($postID,'vimeo_id',true);
		if($youtubeid != ""){	
			$youtubevid = 1; 
			$youtube = array(
					"name" 		=> "",						 
					"thumbnail" => CDN_PATH."images/nophoto.jpg",
					"src" 		=> CDN_PATH."images/nophoto.jpg",
					"id" 		=> "vimeo",
					"type"		=> "video",
			);
			array_unshift($files, $youtube);			
		}
		
		
		// ADD ON VIDEOS  
		$videos = $CORE->MEDIA("get_all_videos", $postID);
		if(!empty($videos)){			
			foreach($videos as $vid){
				if(!isset($vid['published']) || isset($vid['published']) && $vid['published'] == "1"){		
					$vid['src_old'] = $vid['src'];
					$vid['src'] 	= $vid['thumbnail'];
					$vid['type']	= "video";
					array_unshift($files, $vid);
				}
			}					
		}
		}
	
		 
		
		//$audio = $CORE->MEDIA("get_all_music", $postID);
	
		
		
		return $files;
		
		
	
	} break;	
	
	case "media_publish": {
		
		$pid = $order_data[0];
		$vid = $order_data[1];
		$type = $order_data[2];	
		$cVal = 0;
		
		switch($type){
			case "photo": {
			$dbkey = "image_array";			
			} break;
			case "video": {			
			$dbkey = "video_array";			
			} break;
			case "music":
			case "audio": {
			$dbkey = "music_array";			
			} break;		
		}		
		
		if(!isset($dbkey)){ die(); }
		 
		$raw_data = get_post_meta($pid, $dbkey, true);
		if(is_array($raw_data)){ 										 
			foreach($raw_data as $k => $bid){											
										
					if($bid['id'] == $vid){						
						
						if(isset($bid['published']) && $bid['published'] == 1){
						$raw_data[$k]['published'] = 0;	
						}else{
						$raw_data[$k]['published'] = 1;	
						}	
						
						$cVal = $raw_data[$k]['published'];						
										
					}										
				} 
										 
			// SAVE
			update_post_meta($pid, $dbkey, $raw_data);
		}
		
		return $cVal; //print_r($raw_data);
	
	} break;
	
	
case "customUploadForm": {


if(is_array($order_data)){
 
 $key1 			= $order_data[0];
 $customname 	= $order_data[1];

}else{

  $customname = $order_data;
}

?>

<?php if(!in_array($customname,array("userphoto", "userbg"))){ ?>

<input type="hidden" 
               id="<?php echo $customname; ?>_aid" 
               name="<?php if(in_array($customname,array("userphoto"))){ echo "custom"; }else{ ?>admin_values<?php } ?><?php if(is_array($order_data)){ echo "[".$order_data[0]."]";  } ?>[<?php echo $customname; ?>_aid]" 
               value="<?php if(is_array($order_data)){ echo _ppt(array($order_data[0],$order_data[1]."_aid")); }else{ echo _ppt($customname."_aid"); }   ?>"  />
<input 
               name="<?php if(in_array($customname,array("userphoto"))){ echo "custom"; }else{ ?>admin_values<?php } ?><?php if(is_array($order_data)){ echo "[".$order_data[0]."]";  } ?>[<?php echo $customname; ?>]" 
               type="hidden" 
               id="<?php echo $customname; ?>_src" 
               value="<?php if(is_array($order_data)){ echo _ppt(array($order_data[0],$customname)); }else{ echo _ppt($customname); }   ?>" />

<?php } ?>

<div id="<?php echo $customname; ?>_upload" class="shadow-sm border " data-aid="<?php echo _ppt($customname."_aid"); ?>"></div>
      
    
<script>

jQuery(document).ready(function(){ 
setTimeout(function() {

<?php if(in_array($customname,array("userphoto", "userbg"))){ 

if(is_admin() && isset($_GET['eid']) && is_numeric($_GET['eid']) ){
$thisUserID = $_GET['eid'];
}else{
$thisUserID = $userdata->ID;
}
 


// GET USER PHOTO
if($customname == "userbg"){
$currentimg = get_user_meta($thisUserID, "userbg", true);
}else{
$currentimg = get_user_meta($thisUserID, "userphoto", true);
}


if(!is_array($currentimg)){
$currentimg = array("img" => "","aid" => "","src" => "");
}

?>

_meidaUploadForm<?php echo $customname; ?>("<?php if(isset($currentimg['src'])){ echo $currentimg['src']; }else{ echo $currentimg['img']; }  ?>", "123");

<?php }else{ ?>
_meidaUploadForm<?php echo $customname; ?>("<?php if(is_array($order_data)){ echo _ppt(array($order_data[0],$order_data[1])); }else{ echo _ppt($customname); }   ?>", <?php if(is_array($order_data)){ echo _ppt(array($order_data[0],$order_data[1]."_aid")); }else{ echo _ppt($customname."_aid"); }   ?>);
<?php } ?>

},5000);


});



function _meidaUploadForm<?php echo $customname; ?>(src, aid){
 

	divid = "<?php echo $customname; ?>_upload";

	var cropper = new Slim(document.getElementById(divid), { 
				<?php if( in_array($customname,array("userphoto")) ){  ?>
				ratio: '1:1',
				<?php } ?>
				  
				service: '<?php echo home_url(); ?>/index.php',
				download: false,
				//instantEdit: true, 
				push: true,
				
				willRemove: function(data, ready) { 
					
					// GET ATTACHMENT ID
					thisaid  = jQuery("#"+divid).attr("data-aid");	
				 	 
					// AJAX
					<?php if(in_array($customname,array("userphoto"))){  ?>
					jQuery.ajax({
						   type: "POST",
						   url: '<?php echo home_url(); ?>/',		
						data: {
							action: "delete_userphoto",
							uid: <?php echo $thisUserID; ?>, 
						   }
					   }); 
					<?php }elseif(in_array($customname,array("userbg"))){  ?>
					jQuery.ajax({
						   type: "POST",
						   url: '<?php echo home_url(); ?>/',		
						data: {
							action: "delete_userbg",
							uid: <?php echo $thisUserID; ?>, 
						   }
					   }); 
					   
					<?php }else{ ?>
					 jQuery.ajax({
						   type: "POST",
						   url: '<?php echo home_url(); ?>/',		
						data: {
							slim: "delete",
							eid: 0,
							aid: thisaid,
							custom:1, 
							
						   }
					   }); 
					     
					    jQuery("#<?php echo $customname; ?>_aid").val('');
						jQuery("#<?php echo $customname; ?>_src").val('');
						
						if(jQuery('#admin_save_form').length > 0){						
						document.admin_save_form.submit();
						}
						
						<?php } ?>
					   
					   ready(data);  
				}, 
				 
				<?php if(!in_array($customname,array("userphoto","userbg"))){  ?>
				didUpload: function(data,t, t2) { 
				 	 
						jQuery("#<?php echo $customname; ?>_aid").val(t2.aid);
						jQuery("#<?php echo $customname; ?>_src").val(t2.src);
						
				},
				<?php } ?>
				 
				
				label: "<i class='fal fa-3x btn-block fa-image-polaroid opacity-5 mb-3'></i> <span class='small font-weight-bold opacity-5'><?php echo __("Select Photo","premiumpress"); ?> " + "</span>",
				buttonConfirmLabel: 'Ok',
				meta: {
					eid:'0',
					aid: aid,
					
					<?php if(in_array($customname,array("userphoto")) ){ ?>
					type: "userphoto",
					uid: <?php echo $thisUserID; ?>, 
					
					<?php }elseif(in_array($customname,array("userbg")) ){ ?>
					type: "userbg",
					
					<?php if(is_admin() && isset($_GET['eid']) ){  ?>
					uid:'<?php echo $_GET['eid']; ?>', 
					<?php } ?>
					
					<?php }else{ ?>
					type: "custom",
					<?php } ?>
					
				}
 				
				
			});
		 
			
			// load in image
			if(src != ""){
				cropper.load(src, { blockPush:true }, function(error, data) {
					// image load done!
				});
				 
			}
}


</script>  

<?php
} break;
	
	
	
	
	
//// 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

case "file_upload_pre": {
	
			// Get posted data, if something is wrong, exit
			try {
				$images = $CORE->MEDIA("parseFormData", $_POST );
			}
			catch (Exception $e) {				
				
				return 0;
			}
			// No image found under the supplied input name
			if ($images === false) { 
			
				return 0;
			}
					 
			// Should always be one image (when posting async), so we'll use the first on in the array (if available)
			$image = array_shift($images);  
			 
			// if we've received output data save as file
			if (isset($image['output']['data'])) {
			  
				// get the name of the file
				$name = $image['output']['name'];
			
				// get the crop data for the output image
				$data = $image['output']['datasource']; 
				
				// IF THIS IS AN EXISTING FILE, DELETE THE OLD ONE FIRST
				// SO WE DONT HAVE DUPLICATES
				if(isset($image['meta']->aid) && is_numeric($image['meta']->aid)  && $image['meta']->aid > 0){
				
					$CORE->UPLOAD_DELETE($image['meta']->eid."---".$image['meta']->aid);
				
				}
				
				// save
				return $CORE->MEDIA("saveFile", array($data, $name, $image['meta']));
			} 
			
			return 0;
	
	} break;

//// 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

    case "parseFormData": {  
		 
        $values =  stripslashes($order_data['slim'][0]);  
	 	
        // test for errors
        if ($values === false) {
            return false;
        }

        // determine if contains multiple input values, if is singular, put in array
        $data = array();
        if (!is_array($values)) {
            $values = array($values);
        }

        // handle all posted fields
        foreach ($values as $value) {
			
            $inputValue = $CORE->MEDIA("parseInput",$value); 
            if ($inputValue) {
                array_push($data, $inputValue);
            }
        }
	 
        // return the data collected from the fields
        return $data;

    }
 
//// 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

	case "get_video_space_used": {
		
			$pid 	= $order_data[0];
			$pakID 	= $order_data[1];
			
			$media = $CORE->MEDIA("get_all_videos", $pid);	
			
			if(is_numeric($pid) && $pid > 0 ){
				$pakID = get_post_meta($pid,'packageID',true);
				if($pakID == ""){
					$pakID = "default";
				}
			}		
			
			$countPublished = 0;
			if(is_array($media) && !empty($media)){ 					
				foreach($media as $vid){
					if(isset($vid['published']) && $vid['published'] == 1){
						$countPublished++;
					}
				}			
			}
			
			if(in_array(THEME_KEY,array("sp"))){ 
				$totalLeft = 100; 
			}else{
				$totalLeft = _ppt(array('lst','default_videos'));
				if(is_numeric($pakID)){
				if(is_numeric(_ppt('pak'.$pakID.'_videos'))){
				$totalLeft = _ppt('pak'.$pakID.'_videos'); 	
				}		
				}
				if(!is_numeric($totalLeft)){ $totalLeft = 10; }
			}
			
			
			 
			return array("total" => count($media), "left" => $totalLeft, "published" => $countPublished); 
		
		} break;
			
//// 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

	case "get_image_space_used": {
			
			$pid 	= $order_data[0];
			$pakID 	= $order_data[1];
			  
			$media = $CORE->MEDIA("get_all_images", $pid);
			
			if(is_numeric($pid) && $pid > 0 ){
				$pakID = get_post_meta($pid,'packageID',true);
				if($pakID == ""){
					$pakID = "default";
				}
			}
			
			$countPublished = 0;	 
			if(is_array($media) && !empty($media)){ 					
				foreach($media as $vid){
					if(isset($vid['published']) && $vid['published'] == 1){
						$countPublished++;
					}
				}			
			}
			if(in_array(THEME_KEY,array("sp"))){ 
				$totalLeft = 100; 
			}else{
				$totalLeft = _ppt(array('lst','default_images'));
				 
				if(is_numeric($pakID)){
					if(is_numeric(_ppt('pak'.$pakID.'_images'))){				
					$totalLeft = _ppt('pak'.$pakID.'_images');
					}				 			
				}
				if(!is_numeric($totalLeft)){ $totalLeft = 10; }
			}
			 
			return array("total" => count($media), "left" => $totalLeft, "published" => $countPublished); 
		
		} break; 
//// 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

	case "get_music_space_used": {
		
			$pid 	= $order_data[0];
			$pakID 	= $order_data[1];
			
			if(is_numeric($pid) && $pid > 0 ){
			$pakID = get_post_meta($pid,'packageID',true);
			}
			
			if(is_numeric($pid) && $pid > 0 ){
				$pakID = get_post_meta($pid,'packageID',true);
				if($pakID == ""){
					$pakID = "default";
				}
			}
			
			$media = $CORE->MEDIA("get_all_music", $pid);
			
			$countPublished = 0; 
			if(is_array($media) && !empty($media)){ 					
				foreach($media as $vid){
					if(isset($vid['published']) && $vid['published'] == 1){
						$countPublished++;
					}
				}			
			}
			
			if(in_array(THEME_KEY,array("sp"))){ 
				$totalLeft = 100; 
			}else{
				$totalLeft = _ppt(array('lst','default_music'));
				if(is_numeric($pakID)){
					if(is_numeric(_ppt('pak'.$pakID.'_music'))){
					$totalLeft = _ppt('pak'.$pakID.'_music'); 	
					}		
				}
				if(!is_numeric($totalLeft)){ $totalLeft = 10; }
			}
			 
			return array("total" => count($media), "left" => $totalLeft, "published" => $countPublished); 
		
		} break; 
////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

		case "get_image_category": {
			
			
			$storedata 	= wp_get_object_terms( $order_data, 'listing' ); 
			 
			if(isset($storedata[0]) && _ppt('category_image_'.$storedata[0]->term_id) != ""){
			
			$image = _ppt('category_image_'.$storedata[0]->term_id);
			
			}else{
			
			$image = CDN_PATH."images/nophoto.jpg";
			
			}
			
			return array("thumbnail" => $image, "h" => "", "w" => "");
		
		
		} break;
//// 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

		case "get_image_data": {
		
		
			$files = $this->MEDIA("get_all_images", $order_data); 
			
			
			if(isset($files[0]) && isset($files[0]['thumbnail']) && $files[0]['thumbnail'] != ""){
			
				return array("thumbnail" => $files[0]['thumbnail'], "h" => "", "w" => "");
			
			}			 
		
			return array("thumbnail" => $this->_FALLBACK($order_data), "h" => "", "w" => "");
		 
			
		
		} break;
//// 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

		case "get_images_all":
		case "get_all_images": {  
		
			$files = $this->media_get($order_data, "images", $data);  
			
			if(empty($files) && THEME_KEY == "vt"){
			
				$files = $CORE->MEDIA("get_all_videothumbnails", $order_data);
			
			}
			   
			if(!is_array($files)){ $files = array(); }			
			  
			return $files;
		
		} break;
//// 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

		case "get_all_videos": {
		
			$files = $this->media_get($order_data, "video"); 
		 
			if(!is_array($files)){ $files = array(); }
			
			return $files;
		
		} break;
//// 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

		case "get_all_music": {
		
			$files = $this->media_get($order_data, "music"); 
			 
			if(!is_array($files)){ $files = array(); }
			
			return $files;		
		
		} break;
//// 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

		case "get_all_musicthumbnails": {
		
			$files = $this->media_get($order_data, "musicthumbnails"); 
		 
			if(!is_array($files)){ $files = array(); }
			
			return $files;
		
		} break;
//// 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

		case "get_all_videothumbnails": {
		
			$files = $this->media_get($order_data, "videothumbnails"); 
		 
			if(!is_array($files)){ $files = array(); }
			
			return $files;
		
		} break;
		
		
		case "get_video_thumbnail": {
		
			$files = $this->media_get($order_data, "videothumbnails"); 
		 
			if(!is_array($files)){ $files = array(); }
			
			return $files;
		
		} break;
		
//// 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

		case "get_single_videothumbnails": {
		
			$pid = $order_data[0];
			$aid = $order_data[1];
			
			$thumbs = $CORE->MEDIA("get_all_videothumbnails", $pid);			 
			if(!is_array($thumbs)){ $thumbs = array(); }
			
			foreach($thumbs as $img){ 
				
				if($img['id'] == $aid){
					 
					return $img;
				}
			
			}
			
			return "";
		
		} break;
		
 
		
		
//// 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

		case "count_files": {
		
			// COUNT THE TOTAL UPLOADS FOR THIS LSITING
			$get_type = array("image_array", "video_array", "doc_array", "music_array"); $COUNT = 0;
			$COUNT = 0;
			
			foreach($get_type as $type){
				$g = get_post_meta($order_data ,$type, true); 
				if(is_array($g) && !empty($g) ){	
				$COUNT += count($g);
				}
			}
			
			if(defined('WLT_DEMOMODE')){
			
			return rand(5,40);
			
			} 
			
			return round($COUNT,0);
		
		
		} break;
//// 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

		case "get_all_comment_images": {
		
		 
			$SQL = "SELECT ".$wpdb->comments.".* FROM ".$wpdb->comments." INNER JOIN ".$wpdb->commentmeta." AS t1 ON ( t1.comment_id = ".$wpdb->comments.".comment_ID AND t1.meta_key = 'photo' )

				WHERE ".$wpdb->comments.".comment_post_ID ='".$order_data."' AND ".$wpdb->comments.".comment_approved=1  ORDER BY RAND() LIMIT 20";	
 

			$images = array();
		
			$posts = $wpdb->get_results($SQL);	 
		
			foreach($posts as $post){ 
			
				 $photo = get_comment_meta( $post->comment_ID, 'photo', true );
				 
				if(is_array($photo) && strlen($photo['src']) > 1){
					$images[] = array(			
						"name" 		=> "",
						"thumbnail" => $photo['thumb'],
						"src" 		=> $photo['src'],
						"ID" 		=> $post->comment_ID,
					);			
				} 
			}
			
			return $images;
   
		
		} break;

//// 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

    case "sanitizeFileName": {
		
		$str = $order_data;
		
        // Basic clean up
        $str = preg_replace('([^\w\s\d\-_~,;\[\]\(\).])', '', $str);
        // Remove any runs of periods
        $str = preg_replace('([\.]{2,})', '', $str);
		
        return $str;
    }
//// 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

   case "getBase64Data": {
   		
		$data = $order_data;
   
        return base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $data));
    }


//// 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

		case "saveFile": {
		 
		
		global $CORE, $userdata, $wpdb; 
		
		$data 		= $order_data[0];
		$name 		= $order_data[1]; 
		$metadata 	= $order_data[2];
	    
	 
		// LOAD IN WORDPRESS FILE UPLOAOD CLASSES
		$dir_path = str_replace("wp-content","",WP_CONTENT_DIR);
		if(!function_exists('get_file_description')){
		
			if(!defined('ABSPATH')){
				require $dir_path . "/wp-load.php";
			}
			
			 
			if(file_exists($dir_path . "/wp-admin/includes/file.php")){
				require $dir_path . "/wp-admin/includes/file.php";
				require $dir_path . "/wp-admin/includes/media.php";	
			}else{
				require_once get_template_directory() .'/framework/new_class/wordpress_file.php';
				require_once get_template_directory() .'/framework/new_class/wordpress_media.php';		
			}
		
		}
		if(!function_exists('wp_generate_attachment_metadata') ){
			
			if(file_exists($dir_path . "/wp-admin/includes/image.php" )){
			require $dir_path . "/wp-admin/includes/image.php";
			}else{
			require_once get_template_directory() .'/framework/new_class/wordpress_image.php';	
			}
		}
		
		// required for wp_handle_upload() to upload the file
		$upload_overrides = array( 'test_form' => FALSE );
	 
		// load up a variable with the upload direcotry
		$uploads = wp_upload_dir();
	  
		// create an array of the $_FILES for each file
		$file_array = array(
		
			'name' 		=> $data['name'],
			'type'		=> $data['type'],
			'tmp_name'	=> $data['tmp_name'],
			'error'		=> $data['error'],
			'size'		=> $data['size'],
			
			'user_id'	=> $userdata->ID,
			'post_id'	=> $metadata->eid,
			'featured'	=> 0, 
		);
		
		
	 
	// MAKE USER ID
	if(isset($userdata->data->ID) && is_numeric($userdata->data->ID)){
		$userID = $userdata->data->ID;
	}elseif(isset($userdata->ID) && is_numeric($userdata->ID)){
		$userID = $userdata->ID;
	} 
	
////// CHECK FOR EDI = 0 FOR NEW LISTINGS
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
	
	if(isset($metadata->type) && in_array($metadata->type, array("custom","userphoto","userbg"))){
 	
	// DO NOTHING
  
	}elseif($file_array['post_id'] == 0 || $file_array['post_id'] == -99){ // ASSUME WERE TRYING TO CREATE A NEW POST FOR THIS IMAGE
	
		/*
		CHECK IF USER HAS ADDED A LISTING WITHIN THE LAST 5 MINUTES
		THEN GRAN THAT ID
		*/
		
		// -99 USED FOR NEW MASS IMPORT OPTIONS
		if($file_array['post_id'] == -99){
		
			$my_post = array();
			$my_post['post_title'] 		= "mass import";
			$my_post['post_type'] 		= "listing_type";
			$my_post['post_content'] 	= "";
			$my_post['post_status'] 	= "publish"; 		
			$postID = wp_insert_post( $my_post );
		
		
		}else{ 
		
			$SQL = "SELECT ID FROM ".$wpdb->prefix."posts WHERE post_title = ('temp post') AND post_author = '".$userdata->ID."' LIMIT 1";						 
			$hasid = $wpdb->get_results($SQL, OBJECT);
			 
			if(!empty($hasid)){
						
			$postID = $hasid[0]->ID;
			
				/*$media = array();
				$media = $CORE->MEDIA("get_all_images", $postID);
				foreach($media as $file){
					$CORE->UPLOAD_DELETE($postID."---".$file['id']);
				}*/	 
			
			}else{
			
			$my_post = array();
			$my_post['post_title'] 		= "temp post";
			$my_post['post_type'] 		= "listing_type";
			$my_post['post_content'] 	= ""; 			
			$postID = wp_insert_post( $my_post );
		
		
			
			}
	
		}	
		
		// update
		$file_array['post_id'] = $postID;
	
	}else{
	
		// VERIFY THIS POST ID BELONGS TO THIS AUTHOR
		$verify_post = get_post($file_array['post_id']);
	 
		if(!isset($userID) || ( $verify_post->post_author != $userID && $userdata->roles[0] != "administrator" )){
			$e = array();
			return $e['error'] = "INVALID USER";
		}
	} 
		
		
////// CHECK FOR EDI = 0 FOR NEW LISTINGS
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
		// check to see if the file name is not empty
		if ( !empty( $file_array['name'] ) ) {
		
				$wp_filetype = wp_check_filetype( basename( $file_array['name'] ), null ); 
			
				// SETUP ALLOWED FILE TYPES	 
				$allowed_file_types = $CORE->allowed_image_types; 
				
				if(!in_array($file_array['type'], $allowed_file_types)) {
				
					return array("error" => __("Sorry, We do not accept this type of file.","premiumpress"));
				}	
				
				
				// CONTINUE 1
				if(in_array($file_array['type'], $allowed_file_types)) {				
				
				
							// upload the file to the server
							$uploaded_file = wp_handle_upload( $file_array, $upload_overrides );
						 
							// CHECK FOR ERRORS
							if(isset($uploaded_file['error']) ){		
								return $uploaded_file;
							}
							
							// set up the array of arguments for "wp_insert_post();"
							$attachment = array(			 
								'post_mime_type' 	=> $wp_filetype['type'],
								'post_title' 		=> preg_replace('/\.[^.]+$/', '', basename( $file_array['name'] ) ),
								'post_content' 		=> '',
								'post_author' 		=> $file_array['user_id'],
								'post_status'		=> 'inherit',
								'post_type' 		=> 'attachment',
								'post_parent' 		=> $file_array['post_id'],
								'guid' 				=> $uploaded_file['url']
							);	
							
							// INCLUDE UPLOAD SCRIPTS
							$dir_path = str_replace("wp-content","",WP_CONTENT_DIR);
							if(!function_exists('wp_handle_upload')){
							require $dir_path . "/wp-admin/includes/file.php";
							}
						
							// insert the attachment post type and get the ID
							$attachment_id = wp_insert_post( $attachment );
					
							// generate the attachment metadata
							$attach_data = wp_generate_attachment_metadata( $attachment_id, $uploaded_file['file'] );
							 
							// update the attachment metadata
							$rr = wp_update_attachment_metadata( $attachment_id,  $attach_data );
							
							// ADD IN MISSING DATABASE TABLE KEY	
							$thumbnail = "";
							if(!empty($attach_data)){	//<-- this is for image uploads			
						
								add_post_meta($attachment_id,'_wp_attached_file',$attach_data['file']);
								 
								
								if(isset($attach_data['sizes']['thumbnail']['file'])){
									$thumbnail = $uploads['baseurl'].$uploads['subdir']."/".$attach_data['sizes']['thumbnail']['file'];
								}else{
									$thumbnail = $uploads['baseurl'].$uploads['subdir']."/".$attach_data['file'];
								}
								
									//die(print_r($save_file_array).print_r($file_array));
								//die(print_r($thumbnail).print_r($attach_data).print_r($uploads));
								
								// GET IMAGE DIMENTIONS AND DPI				
								$image_attributes = wp_get_attachment_image_src( $attachment_id , 'full' );				 
								if(isset($image_attributes[2])){				
									$dimentions = $image_attributes[1]."x".$image_attributes[2];
									$dpi = $CORE->_format_dpi(addslashes($uploaded_file['file']));
								} 
							
							}
							
							
							// BUILD ARRAY TO SAVE IMAGE INTO DATABASE
							// AS THE ATTACHMENT FOR THE POST
							if(!isset($dpi)){ $dpi = 0; }
							if(!isset($dimentions)){ $dimentions = 0; } 
							 
							
							$save_file_array = array(
								'name' 		=> $file_array['name'],
								'type'		=> $file_array['type'],
								'postID'	=> $file_array['post_id'],
								'size'		=> $file_array['size'],
								'src' 		=> $uploaded_file['url'],						
								'thumbnail' => str_replace(" ", "-",addslashes($thumbnail)),						
								'filepath' 	=> addslashes($uploaded_file['file']),
								'id'		=> $attachment_id,
								'default' 	=> $file_array['featured'],
								'order'		=> 100,						
								'dimentions' => $dimentions,						
								'dpi' 		=> $dpi,	
												
							);			

							$setThumbnail = 0;
							
							switch($metadata->type){
								
								case "userbg":
								case "userphoto": {	
								
									$thisUserID = $userdata->ID;
									if(isset($metadata->uid) && is_numeric($metadata->uid) ){
									$thisUserID = $metadata->uid;
									}
									 
									// format responce
									$responce = array();
									$responce["name"] 				= $file_array['name'];
									$responce["size"] 				= $file_array['size'];
									$responce["type"] 				= $file_array['type'];
									$responce["thumbnail_url"] 		= $save_file_array["thumbnail"];
									$responce["src"] 				= $save_file_array["src"];
									$responce["pid"] 				= "blah blah";
									$responce["uid"] 				= $thisUserID;	
									$responce["aid"] 				= $attachment_id;
									
									 
									//UPDATE USER DATA
									update_user_meta($thisUserID, 
											$metadata->type, array(
												'img' => $save_file_array["thumbnail"], 
												'src' => $save_file_array["src"], 
												'path' => $uploaded_file['file'], 
												"aid" => $attachment_id,
											)
									);
								 
									return $responce;
								
								} break;
								case "custom": {
								
								
								// format responce
								$responce = array();
								$responce["name"] 				= $file_array['name'];
								$responce["size"] 				= $file_array['size'];
								$responce["type"] 				= $file_array['type'];
								$responce["thumbnail_url"] 		= $save_file_array["thumbnail"];
								$responce["src"] 				= $save_file_array["src"];
								$responce["pid"] 				= "blah blah";
								$responce["uid"] 				= $userdata->ID;	
								$responce["aid"] 				= $attachment_id;
							 
								return $responce;
								
								} break;
							
								case "image_video": {
								
									$storage_key = "videothumbnails_array";
									 
									
									if(isset($file_array['post_id']) && isset($metadata->vid) ){
									
									$raw_data = get_post_meta($file_array['post_id'],"video_array", true);
									if(is_array($raw_data)){ 										 
										foreach($raw_data as $k => $bid){											
											if($bid['id'] == $metadata->vid){
											
												$raw_data[$k]['thumbnail'] 			= $save_file_array["src"];
												$raw_data[$k]['thumbnail_thumb'] 	= $save_file_array["thumbnail"];					
												$raw_data[$k]['thumbnail_aid'] 		= $attachment_id;												 
												
											}
										
										} 
										 
										// SAVE
										update_post_meta($file_array['post_id'], "video_array", $raw_data);
										}	
									}
								 
								
								} break;
								
								case "image_music": {
								
									$storage_key = "musicthumbnails_array";
								
								} break;
								default: {
									
									$setThumbnail= 1;
									
									$storage_key = "image_array";
									
									// SET THE MEDIA TYPE
									if(THEME_KEY == "ph"){
										update_post_meta($file_array['post_id'],'media_type', 1);
										if($image_attributes[1] > $image_attributes[0]){
										update_post_meta($file_array['post_id'],'orientation', 1);	
										}else{
										update_post_meta($file_array['post_id'],'orientation', 2);	
										}
									}	
									
									
								} break;							
							
							}	 
								
	
							// ADD TO MY IMAGE GALLERY ARRAY
							$my_existing_images = get_post_meta($file_array['post_id'],$storage_key, true);
							if(is_array($my_existing_images)){
									
									$new_array = array();
									$new_array[] = $save_file_array;
									foreach($my_existing_images as $img ){ $new_array[] = $img; }	
														
							}else{				
									$new_array = array();
									$new_array[] = $save_file_array;									
							}				 		
							 	
							// SAVE
							update_post_meta($file_array['post_id'],$storage_key,$new_array);	

 							// CHECK FOR FEATURED
							// DONT SET MUSIC FILE AS IMAGE OPTION
							if($setThumbnail){
							 
								set_post_thumbnail($file_array['post_id'], $attachment_id);
							}  
 
							// format responce
							$responce = array();
							$responce["name"] 				= $file_array['name'];
							$responce["size"] 				= $file_array['size'];
							$responce["type"] 				= $file_array['type'];
							$responce["thumbnail_url"] 		= $save_file_array["thumbnail"];
							$responce["src"] 				= $save_file_array["src"];
							$responce["pid"] 				= $file_array['post_id'];
							$responce["uid"] 				= $userdata->ID;	
							$responce["aid"] 				= $attachment_id;
							
							$responce["sk"] 				= $storage_key;
							$responce["sa"] 				= $new_array;
							
						 
							return $responce;

 				
				
				}// end continue 1	 
			
		
		} // end if has no name 

		 
    }
		 
		
		
////// 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
	
    // will test if the supplied file is an image
    case "isImageFile": {
		
		
		$file_name = $order_data;
		$temp	= explode('.',$file_name);
		$extension = end($temp);
		
		if(in_array($extension, array("jpg","jpeg","png","jpe","jif","jfif"))){
			return 1;
		}
		
		return 0;
		
    }
 
////// 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
	
	
	case "parseInput": {
	
		$value = $order_data;

        // if no json received, exit, don't handle empty input values.
        if (empty($value)) {return null;}
 

        // The data is posted as a JSON String so to be used it needs to be deserialized first
        $data = json_decode($value);
		 
        // shortcut
        $input = null;
        $actions = null;
        $output = null;
        $meta = null;

        if (isset ($data->input)) {

            $inputData = null;
            if (isset($data->input->image)) {
                $inputData = $CORE->MEDIA("getBase64Data", $data->input->image);
            }
            else if (isset($data->input->field)) {
			
                $filename = $_FILES[$data->input->field]['tmp_name'];
                if ($filename) {
                    $inputData = file_get_contents($filename);
                }
            }

            $input = array(
                'data' => $inputData,
				'datasource' => $_FILES[$data->output->field],
                'name' => $data->input->name,
                'type' => $data->input->type,
                'size' => $data->input->size,
                'width' => $data->input->width,
                'height' => $data->input->height,
            );

        }

        if (isset($data->output)) {

            $outputDate = null;
            if (isset($data->output->image)) {
                $outputData = $CORE->MEDIA("getBase64Data", $data->output->image);
            }
            else if (isset ($data->output->field)) {
			
                $filename = $_FILES[$data->output->field]['tmp_name'];
                if ($filename) {
                    $outputData = file_get_contents($filename);
                } 
            }

            $output = array(
                'data' => $outputData,
				'datasource' => $_FILES[$data->output->field],
                'name' => $data->output->name,
                'type' => $data->output->type,
                'width' => $data->output->width,
                'height' => $data->output->height
            );
        }

        if (isset($data->actions)) {
            $actions = array(
                'crop' => $data->actions->crop ? array(
                    'x' => $data->actions->crop->x,
                    'y' => $data->actions->crop->y,
                    'width' => $data->actions->crop->width,
                    'height' => $data->actions->crop->height,
                    'type' => $data->actions->crop->type
                ) : null,
                'size' => $data->actions->size ? array(
                    'width' => $data->actions->size->width,
                    'height' => $data->actions->size->height
                ) : null,
                'rotation' => $data->actions->rotation,
                'filters' => $data->actions->filters ? array(
                    'sharpen' => $data->actions->filters->sharpen
                ) : null
            );
        }

        if (isset($data->meta)) {
            $meta = $data->meta;
        }

        // We've sanitized the base64data and will now return the clean file object
        return array(
            'input' => $input,
            'output' => $output,
            'actions' => $actions,
            'meta' => $meta
        );
    }
		
////// 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
	
	
		
		
	}
	
	
	
	if(!function_exists('MEDIA_SIZES')){
 function MEDIA_SIZES(){
 	
	// DEFAULT LANFSCAPE
	 $size = array(
	 
		 "w" => 800, 
		 "h" => 600, 	 
	 
	 );
	
	// PORTAITE
	 if(defined('THEME_KEY') && in_array(THEME_KEY, array("ex","es","sp"))){
	 
		$size = array(
			
			"w" => 600, 		
			"h" => 800
		
		);
	 
	 }
	
	
	return $size;
 
 }
 }
	
	
	
	
}
	
	 
	
	
	
	



// Remove height/width attributes on avatar img tags.
function avatar_remove_dimensions( $avatar ) {

    $avatar = preg_replace( "/(width|height)=\'\d*\'\s/", "", $avatar );

    return $avatar;

}

function get_the_post_thumbnail_src($img)
{
  return (preg_match('~\bsrc="([^"]++)"~', $img, $matches)) ? $matches[1] : '';
}

 
 
	
/*
This function will get all media item for this listing

*/
 
function media_get($postID, $type = 'all', $data = array() ){ global $post, $wpdb, $CORE; $meida_array = array();
 

// GET THE FILE TYPE STORAGE KEY
if($type == "image" || $type == "images"|| $type == "singleimage" || $type == "gallery" ){

	$get_type = array("image_array");	
	$includeImages = true;	
		
}elseif($type == "video"){ 
	$get_type = array("video_array"); 
	
}elseif($type == "videothumbnails"){
	$get_type = array("videothumbnails_array");
	
}elseif($type == "music"){
	$get_type = array("music_array");	 
	
}elseif($type == "musicthumbnails"){
	$get_type = array("musicthumbnails_array");
	
					
}elseif($type == "doc"){
	$get_type = array("doc_array");		
}elseif($type == "allbutmusic"){
	$get_type = array("image_array", "video_array", "doc_array");	 
	$includeImages = true;	
}else{
	$get_type = array("image_array", "video_array", "doc_array", "music_array");	
	$includeImages = true;			
}
 
 
// DEMO DATA
/*
if(defined('WLT_DEMOMODE') && 1 == 2 && isset($GLOBALS['CORE_THEME']['sampledata']) && isset($post->post_title) && isset($post->post_type) && $post->post_type == "listing_type" && ($type == "image" || $type == "images"|| $type == "singleimage" || $type == "gallery")   ){ 
 
 
  	     
	$did = filter_var($post->post_title, FILTER_SANITIZE_NUMBER_INT);	
	
 
	   
			
	if(isset($GLOBALS['CORE_THEME']['sampledata']) && isset($GLOBALS['CORE_THEME']['sampledata'][$did]) ){				
	 	
		$big = "";
		$thumb = "";	
		
		
	 	if(isset($GLOBALS['CORE_THEME']['sampledata'][$did]['image'])){
			
			$big 	= $GLOBALS['CORE_THEME']['sampledata'][$did]['image'];
			$thumb 	= $GLOBALS['CORE_THEME']['sampledata'][$did]['thumb'];
		
		}
		 
	 	
		if(isset($GLOBALS['CORE_THEME']['sampledata'][$did]['images']) && is_array($GLOBALS['CORE_THEME']['sampledata'][$did]['images']) ){
			 
			 
			
			$i=0;				
			foreach($GLOBALS['CORE_THEME']['sampledata'][$did]['images'] as $img){	
			  
				$meida_array[$i] = array(
					"class" 	=> "img-fluid", 
					"src" 		=> trim($img['image']), 
					"thumbnail" => trim($img['thumb']),
					"order" 	=> 0,
					"type" 		=> "image/jpg",
					"id" 		=> get_post_thumbnail_id($postID),
					
					"width" 	=> 551,
					"height"	=> 340,
					
				 );	
				 $i++;
			}	
			 
			return $meida_array;	
			 	
		
		}else{ 
		
			if($thumb == ""){
			$big = $this->_FALLBACK($postID);
			$thumb =  $this->_FALLBACK($postID);
			}
		 
		 
			$meida_array[0] = array(
				"class" 	=> "img-fluid", 
				"src" 		=> trim($big), 
				"thumbnail" => trim($thumb),
				"order" 	=> 0,
				"type" 		=> "image/jpg",
				"id" 		=> get_post_thumbnail_id($postID),
				
				"width" 	=> 551,
				"height"	=> 340,
					
			 );	
			 
			 return  $meida_array;	
		 
		 } 		 	
	 } 
	  
	
}
*/

// LOOP SELECTED MEDIA AND GET THE DATA
foreach($get_type as $typec){
	$g = get_post_meta($postID,$typec, true);
	if(is_array($g)){		
	$meida_array = array_merge($meida_array, $CORE->multisort( $g , array('order') ) );	
	}
} 

 
// CHECK FOR ADMIN SET FEATURED IMAGE  
if ( empty($meida_array) && ($type == "image" || $type == "images" || $type == "all" || $type == "image_array" || $type == "singleimage" ) && has_post_thumbnail($postID) ) {
	
	if(is_single()){
	$size = "full";
	}else{
	$size = "thumbnail";
	}
	
	$thumb = hook_image_display(get_the_post_thumbnail_url($postID, $size));
 
	$meida_array[] = array(
		"class" => "ppt_thumbnail img-fluid", 
		"src" => trim($thumb), 
		"thumbnail" => trim($thumb),
		"order" => 0,
		"type" => "image/jpg",
		"id" => get_post_thumbnail_id($postID),
	 );
	  
}

 
// CHECK IF ITS EMPTY
if(!is_admin() && empty($meida_array) ){

	// GET POST CONTENT
	$SQL = "SELECT DISTINCT post_content FROM ".$wpdb->prefix."posts WHERE ".$wpdb->prefix."posts.ID = '".$postID."' LIMIT 1";	
	$r = $wpdb->get_results($SQL, ARRAY_A);
	
	if(isset($r[0])){
	$content = $r[0]['post_content'];
	}else{
	$content = "";
	}
	

	// CHECK TO SEE IF THE CONTENT CONTAINS A VIDEO LINK AND USE THIS AS THE VIDEO
	preg_match_all('!http://[a-z0-9\-\.\/]+\.(?:jpe?g|flv)!Ui', $content, $matches);
	if(is_array($matches)){
		foreach($matches as $mm){	
			if(!isset($mm[0]) || ( isset($mm[0]) && $mm[0] == "") ){ continue; }
			$meida_array = array( array("class" => "", "src" => trim($mm[0]), "thumbnail" => str_replace(" ", "-",trim($mm[0])))); 
		}
	} 	
}
 

 
 
// CHECK IF THE LISTING CONTENT CONTAINS IMAGE GALLERIES
if ( ( empty($meida_array) || $type == "gallery" ) && isset($includeImages) && is_numeric($postID) ){
	
	// GET POST CONTENT
	$SQL = "SELECT DISTINCT post_content FROM ".$wpdb->prefix."posts WHERE ".$wpdb->prefix."posts.ID = '".$postID."' LIMIT 1";	
	$r = $wpdb->get_results($SQL, ARRAY_A);
	
	if(isset($r[0])){
	$content = $r[0]['post_content'];
	}else{
	$content = "";
	}
	
	if($content != "" &&
	(
	strpos($content,"gallery ids") != false || 
	strpos($content,"gallery column") != false || 
	strpos($content,"gallery link") != false 
	)
	){
	
 
 		 
		// GET THE ATTACHMENT IDS TO BUILD THE NEW GALLERY
		preg_match('/\[gallery.*ids=.(.*).\]/', get_the_content($postID), $ids);
		$wordpress_default_gallery_ids = explode(",", $ids[1]);
		
		// GET THE CURRENT WP UPLOAD DIR
		$uploads = wp_upload_dir(); 
		$user_attachments = array(); $i=0;
		foreach($wordpress_default_gallery_ids as $img_id){
			if(is_numeric($img_id)){			
				$f = wp_get_attachment_metadata($img_id);	 	
				if(isset($f['file'])){	
					$user_attachments[$i]['src'] 		= $uploads['baseurl']."/".$f['file'];			
					$user_attachments[$i]['thumbnail'] 	= $user_attachments[$i]['src']; //$uploads['url']."/".$f['sizes']['thumbnail']['file'];
					$user_attachments[$i]['name'] 		= $f['image_meta']['title'];
					$user_attachments[$i]['id'] 		= $img_id;
					$user_attachments[$i]['class'] 		= "";
					$user_attachments[$i]['type'] 		= "image/jpeg";
					$user_attachments[$i]['order'] 		= $i;
				}				 
				$i++;
			}
		}
		
		if(!empty($user_attachments)){
		$meida_array = array_merge($meida_array, $user_attachments);
		}
		
	} // end if post content
}

$upload_dir = wp_upload_dir();
 

// CHECK FOR IMAGE CUSTOM FIELDS
if($type == "image" || $type == "images" || $type == "all" || $type == "gallery"){

	$custom_image = get_post_meta($postID,'image', true);
	
	// UPDATE DEMO IMAGE DATA
	if(strpos($custom_image,"imgid=") !== false){
		$custom_image = DEMO_IMGS.$custom_image."&t=".THEME_KEY;
		if(isset($_SESSION['design_preview'])){
			$custom_image .= "&ct=".$_SESSION['design_preview'];
		}
	
	}
	
 
	if($custom_image != "" && get_post_meta($postID,'image_aid', true) == "" ){
	
		$upload_dir = wp_upload_dir();
		 
		$custom_image = str_replace("wpdir-", $upload_dir['baseurl'].'/', $custom_image); 
		$custom_image = str_replace("childdir-", get_stylesheet_directory_uri().'/', $custom_image); 
		
		 
		if(substr($custom_image,0,4) != "http" && file_exists($upload_dir['path']."/thumbs/".$custom_image) ){
		
		$custom_image = $upload_dir['url']."/thumbs/".$custom_image;
		
		}
		 
			
		$meida_array[] = array(
			"class" => "ppt_thumbnail img-fluid", 
			"src" => trim($custom_image), 
			"thumbnail" => trim($custom_image),
			"order" => 0,
			"type" => "image/jpeg",
			"id" => 'none',
		 );
		 
		 
	}

}




// RETURN 1 IMAGE ONLY AND USE CALLBACK IF NON EXIST
if($type == "singleimage"){

	$src = ""; $thumb = "";
	if(empty($meida_array) || ( !isset($meida_array[0]['src']) && $meida_array[0]['src'] != "" ) ){
		$image = $this->_FALLBACK($postID);
		preg_match( '@src="([^"]+)"@' , $image , $match ); 
		$src 	= $match[1];
		$thumb 	=  $match[1];
	}else{	
		$src 	= $meida_array[0]['src'];
		$thumb 	= $meida_array[0]['thumbnail'];
		
	}
	
	return array("src" => $src, "thumbnail" => $thumb);
}


 
 
// UPDATE MEDIA NAME
$ne = array();
if(is_array($meida_array)){
	foreach($meida_array as $k => $m){
	 
	if(!isset($m['type'])){ continue; }
	if($m['src'] == ""){ continue; }
	
	
	// UPDATE DIMENTIONS, SET SRC IF THUMB IS SMALL
	
	$m['width'] = 800;
	$m['height'] = 600;
	
	if(isset($m['dimentions']) && strlen($m['dimentions']) > 1){
		$b = explode("x",$m['dimentions']);
		if($b[0] < 800){
		$m['thumbnail'] = $m['src'];
		}
		
		$m['width'] = $b[0];
		$m['height'] = $b[1];
	}
	
  
	
	// ADDON AUDIO IMAGE 
	if(strpos($m['type'],"audio") !== false){
	
		$vthumbs = get_post_meta($m['postID'], "musicthumbnails_array", true);
		if($vthumbs != "" && is_array($vthumbs) && !empty($vthumbs) && isset($vthumbs[0]['src']) ){
		  
			$m['thumbnail'] = $vthumbs[0]['thumbnail'];			
			if(isset($GLOBALS['flag-single']) && $vthumbs[0]['src'] != ""){			
				$m['thumbnail'] = $vthumbs[0]['src'];			
			} 
			
		}	
	}
	
	// ADDON VIDEO IMAGE 
	
	if(strpos($m['type'],"video") !== false && $m['thumbnail'] == ""){
	
		$vthumbs = get_post_meta($m['postID'], "videothumbnails_array", true);
		if($vthumbs != "" && is_array($vthumbs) && !empty($vthumbs) && isset($vthumbs[0]['src']) ){
		 
		 	// DONT CHANGE THE SRC PATH IF THIS IS LOOING FOR A VIDEO FILE
			if($type != "video"){
			$m['src'] = $vthumbs[0]['src'];
			}
			
			$m['thumbnail'] = $vthumbs[0]['thumbnail'];
			
			if(isset($GLOBALS['flag-single']) && $vthumbs[0]['src'] != ""){
			
			$m['thumbnail'] = $vthumbs[0]['src'];
			
			} 
			
		}	
	}
	
	if(isset($m['name'])){ 	
		$m['name'] = get_the_title($m['id']); 	
	}
	
	// FALLBACK FOR EMPTY
	if($m['thumbnail'] == ""){
	$m['thumbnail'] = $m['src'];
	}
	
	// ALT
	$m['alt'] = get_the_title($m['id']);
	
	
	$ne[$k] = $m;
	
	}

} 
 
 
return $ne;

 
}
	
	
	
	
	
	
	
	
	
	
	
	
	
	 
	
	
	
	
	
	
	

function remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}
 
	function meks_disable_srcset( $sources ) {
		return false;
	}
	
	
function _GETFEATUREDDATA($limit = "5"){ global $wpdb;

	$SQL = "SELECT ".$wpdb->posts.".* FROM ".$wpdb->posts."
				INNER JOIN ".$wpdb->postmeta." AS t1 ON ( t1.post_id = ".$wpdb->posts.".ID AND t1.meta_key = 'featured' AND t1.meta_value = 'yes')
				WHERE ".$wpdb->posts.".post_status= 'publish' AND ".$wpdb->posts.".post_type='listing_type'  ORDER BY RAND() LIMIT ".$limit;	
	 
	$images = array();
	$posts = $wpdb->get_results($SQL);	 
	foreach($posts as $post){ 
	$images[] = array('id' => $post->ID, 'post_title' => $post->post_title, 'post_content' => $post->post_content, 'images' => $this->media_get($post->ID,"images"), 'link' => get_permalink($post->ID)   );
	}
  
	return $images;	
		
}
	


/*
This function handles all images where no featured one is set

*/
function _FALLBACK($postID = 0, $title= "" ){ global $post, $CORE; 
	 
	$type = "";
 
	if(isset($post->post_title)){	
		$title = $post->post_title;
		$type = $post->post_type;
	}elseif($title != ""){		 
		$type = "listing_type";
	} 
	 
	 
	// CHECK FOR SAMPLE DATA
	if(defined('WLT_DEMOMODE') && isset($GLOBALS['CORE_THEME']['sampledata']) && $type == "listing_type"  ){ 
  	   
		$did = filter_var($title, FILTER_SANITIZE_NUMBER_INT);	
			 
		if(isset($GLOBALS['CORE_THEME']['sampledata']) && isset($GLOBALS['CORE_THEME']['sampledata'][$did]) ){				
				
				
				if(isset($GLOBALS['CORE_THEME']['sampledata'][$did]['image'])){
				$fallback_image 	= $GLOBALS['CORE_THEME']['sampledata'][$did]['image'];			 
				}
		}
			
	}// end demo
	
	
	
	
	// CHECK FOR VIDEO
	if(THEME_KEY == "cp"){
	
	}else{
		$videid = get_post_meta($postID,'youtube_id',true);	 
		if($videid != ""){			
			return "https://i.ytimg.com/vi/".$videid."/hqdefault.jpg";	
		} 
	}
	 
		 
		if(strlen(_ppt('fallback_image')) > 5 ){
		
			$fallback_image = _ppt('fallback_image');
		
		}elseif(is_numeric(_ppt(array("lst","fallback_image_aid"))) && strlen(_ppt(array('lst', 'fallback_image'))) > 5 ){
		
			$fallback_image = _ppt(array('lst', 'fallback_image'));
		
		}else{
		
			if(THEME_KEY == "da"  ){
			$fallback_image = CDN_PATH."images/nouser.jpg"; 
			}else{
			$fallback_image = CDN_PATH."images/nophoto.jpg";
			}
		}		
	 
	// SCREENSHOT FOR DT THEME
	if(_ppt(array('lst', 'default_screenshot' )) == '1'){
		
		$fallback_image = $this->screenshot($postID);
			
	}
 	 
	
	return hook_fallback_image_display($fallback_image);
 
}


function screenshot($postID){


	$sk = _ppt(array('lst','default_screenshot_key'));
		if(_ppt(array('lst','default_screenshot_key')) == ""){
		$sk = "website";
		}
		
		$url = get_post_meta($postID, $sk,true);
		if(strlen($url) > 5){
			
			if(substr($url,0,4) != "http"){
				$url = "https://".$url;
			}
		 	
			 
			switch(_ppt(array('lst','default_screenshot_provider'))){
				
				case "thum": {
					
						return "https://image.thum.io/get/auth/"._ppt(array('screenshots','thum_api'))."/width/600/crop/800/".$url;
										
				} break;
				
				case "browshot": {
					
					$in = _ppt(array('screenshots','browshot_in'));
					if($in == "" || !is_numeric($in)){
					$in = 12;
					}
					
					return "https://api.browshot.com/api/v1/simple?url=".$url."&instance_id=".$in."&width=600&height=800&key="._ppt(array('screenshots','browshot_api'));
				
				
				} break;
				
				case "url2png": {				
						
						
					$URL2PNG_APIKEY = _ppt(array('screenshots','url2png_api'));
					$URL2PNG_SECRET = _ppt(array('screenshots','url2png_secret'));
				
					# urlencode request target
					$options = array();
					$options['unique']     = round(time()/60/60,0);      # Limit capture to once per hour
					$options['fullpage']  = 'false';      # [true,false] Default: false
					$options['thumbnail_max_width'] = 'false';      # scaled image width in pixels; Default no-scaling.
					$options['viewport']  = "600x800";  # Max 5000x5000; Default 1280x1024
					$options['url'] = urlencode($url);		  
		
				  # create the query string based on the options
				  foreach($options as $key => $value) { $_parts[] = "$key=$value"; }
				
				  # create a token from the ENTIRE query string
				  $query_string = implode("&", $_parts);
				  $TOKEN = md5($query_string . $URL2PNG_SECRET);
				
				  return "https://api.url2png.com/v6/".$URL2PNG_APIKEY."/".$TOKEN."/png/?".$query_string;
			 
						
				} break;
			
			}
	}	
			
			return  "";
		

}
	

 
	
/* ========================================================================
 UPLOAD OPTIONS
========================================================================== */

function UPLOAD_DELETE($id){
 
	// DATA IS STORED AS POSTid---ATTACHMENTID	
	$bits = explode("---",$id);
	
	// GET EXISTS MEDIA ARRAYS
	$get_type = array("image_array", "video_array", "doc_array", "music_array", "videothumbnails_array", "musicthumbnails_array");			
	// LOOP ARRAYS TO GET ALL MEDIA DATA
	foreach($get_type as $type){		
		// GET THE MEDIA DATA FOR THIS ARRAY
		$data = get_post_meta($bits[0],$type,true);	 
		if(is_array($data)){
		// LOOP THROUGH, CHECK AND DELETE
			$new_array = array();			
			foreach($data as $media){
				if($media['id'] != $bits[1]){
					$new_array[] = $media;
				}else{
					$delsrc 	= $media['filepath'];
					$delthumbsrc = $media['thumbnail'];				
					
				}// end if
			}// end foreach	
			// UPDATE MEDIA FILE ARRAY
			update_post_meta($bits[0],$type,$new_array);	
		}// end if
	} // end foreach
	// LOOP THROUGH AND REMOVE THE ONE WE DONT WANT
	
	// DELETE FILE FROM WORDPRESS MEDIA LIBUARY
	if ( false === wp_delete_attachment($bits[1], true) ){	
		//die("could not delete file");
	} 
	
	// FALLBACK IF SYSTEM IS NOT DELETING IMAGES
	if(isset($delsrc) && strlen($delsrc) > 1 && file_exists($delsrc)){ @unlink($delsrc); } 
	if(isset($delthumbsrc) && strlen($delthumbsrc) > 1){ 	
		$ff = explode("/",$delsrc);
		$fg = explode($ff[count($ff)-1],$delsrc);
		$fd = explode("/",$delthumbsrc);
		$thumbspath = $fg[0].$fd[count($fd)-1]; 
		if(file_exists($thumbspath)){					
		@unlink($thumbspath);
		}
	} 

}

function UPLOAD_DELETEALL($postid){
 
	// GET EXISTS MEDIA ARRAYS
	$get_type = array("image_array", "video_array", "doc_array", "music_array");			
	// LOOP ARRAYS TO GET ALL MEDIA DATA
	foreach($get_type as $type){		
		// GET THE MEDIA DATA FOR THIS ARRAY
		$data = get_post_meta($postid,$type,true);	 
		
		if(is_array($data)){
		// LOOP THROUGH, CHECK AND DELETE		
			foreach($data as $media){
				if(isset($media['filepath'])){
					@unlink($media['filepath']);					
				}
			}// end foreach
		
			// EMPTY THE TYPE DATA
			update_post_meta($postid,$type,'');	
			
		}// end if
	} // end foreach
	// LOOP THROUGH AND REMOVE THE ONE WE DONT WANT
	
	// DELETE FILE FROM WORDPRESS MEDIA LIBUARY
	wp_delete_attachment($postid, true);
 

}
 

 

function UPLOADSPACE($postID, $type =""){
	
	global $wpdb;

	// COUNT THE TOTAL UPLOADS FOR THIS LSITING
	if($type != ""){
	
		$g = get_post_meta($postID,$type, true); 
		
		die(print_r($g));
		
		if(is_array($g) && !empty($g) ){	
			$COUNT = count($g);
		}
		
	}else{
	$get_type = array("image_array", "video_array", "doc_array", "music_array"); $COUNT = 0;
	
		foreach($get_type as $type){
			$g = get_post_meta($postID,$type, true); 
			if(is_array($g) && !empty($g) ){	
			$COUNT += count($g);
			}
		}
	}
	return round($COUNT,0);

}










function UPLOAD($data){
 
	if(!is_array($data)){ return $data; }

	//SPLIT THE DATA	
	$postID 	= $data[0];
	$file 		= $data[1];	
	$type 		= $data[2];
	 
 
	if($file['error'] && $file['error'] == 1){	
	
				
			return array("error" => __("There was an error reading this file. Try making it smaller or resaving in the correct format.","premiumpress"));			
	}

	global $wpdb, $userdata; 
	
	// MAKE USER ID
	if(isset($userdata->data->ID) && is_numeric($userdata->data->ID)){
		$userID = $userdata->data->ID;
	}elseif(isset($userdata->ID) && is_numeric($userdata->ID)){
		$userID = $userdata->ID;
	} 
	
	
	if($postID == 0 || $postID == -99){ // ASSUME WERE TRYING TO CREATE A NEW POST FOR THIS IMAGE
	
		/*
		CHECK IF USER HAS ADDED A LISTING WITHIN THE LAST 5 MINUTES
		THEN GRAN THAT ID
		*/
		
		 
		
		// -99 USED FOR NEW MASS IMPORT OPTIONS
		if($postID == -99){
		
			$my_post = array();
			$my_post['post_title'] 		= "mass import";
			$my_post['post_type'] 		= "listing_type";
			$my_post['post_content'] 	= "";
			$my_post['post_status'] 	= "publish"; 		
			$postID = wp_insert_post( $my_post );
		
		
		}else{
			
			if (isset($_SERVER['HTTP_CLIENT_IP'])) {
					$real_ip_adress = $_SERVER['HTTP_CLIENT_IP'];
			}						
			if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
					$real_ip_adress = $_SERVER['HTTP_X_FORWARDED_FOR'];
			}else{
					$real_ip_adress = $_SERVER['REMOTE_ADDR'];
			}			
			$title = "temp post - ".$real_ip_adress;
		
			$SQL = "SELECT ID FROM ".$wpdb->prefix."posts WHERE post_title = ('".$title."') AND post_author = '".$userdata->ID."' LIMIT 1";						 
			$hasid = $wpdb->get_results($SQL, OBJECT);
			 
			if(!empty($hasid)){
						
			$postID = $hasid[0]->ID;
			
			}else{
			
			$my_post = array();
			$my_post['post_title'] 		= $title;
			$my_post['post_type'] 		= "listing_type";
			$my_post['post_content'] 	= ""; 			
			$postID = wp_insert_post( $my_post );
			
			
			} 
			 
		
			 
		}	
	
	}else{
	
		// VERIFY THIS POST ID BELONGS TO THIS AUTHOR
		$verify_post = get_post($postID);
	 
		if(!isset($userID) || ( $verify_post->post_author != $userID && $userdata->roles[0] != "administrator" )){
			$e = array();
			return $e['error'] = "INVALID USER";
		}
	}
	

	
	// LOAD IN WORDPRESS FILE UPLOAOD CLASSES
	$dir_path = str_replace("wp-content","",WP_CONTENT_DIR);
	if(!function_exists('get_file_description')){
	
		if(!defined('ABSPATH')){
			require $dir_path . "/wp-load.php";
		}
		
		 
		if(file_exists($dir_path . "/wp-admin/includes/file.php")){
			require $dir_path . "/wp-admin/includes/file.php";
			require $dir_path . "/wp-admin/includes/media.php";	
		}else{
			require_once get_template_directory() .'/framework/new_class/wordpress_file.php';
			require_once get_template_directory() .'/framework/new_class/wordpress_media.php';		
		}
	
	}
	if(!function_exists('wp_generate_attachment_metadata') ){
		
		if(file_exists($dir_path . "/wp-admin/includes/image.php" )){
		require $dir_path . "/wp-admin/includes/image.php";
		}else{
		require_once get_template_directory() .'/framework/new_class/wordpress_image.php';	
		}
	}
	// required for wp_handle_upload() to upload the file
	$upload_overrides = array( 'test_form' => FALSE );
 
	// load up a variable with the upload direcotry
	$uploads = wp_upload_dir();
  
	// create an array of the $_FILES for each file
	$file_array = array(
		'name' 		=> $file['name'],
		'type'		=> $file['type'],
		'tmp_name'	=> $file['tmp_name'],
		'error'		=> $file['error'],
		'size'		=> $file['size'],
	);
 	 
	// check to see if the file name is not empty
	if ( !empty( $file_array['name'] ) ) {
		
		 $wp_filetype = wp_check_filetype( basename( $file_array['name'] ), null ); 
		 	 
		// checks the file type and stores in in a variable
		if(in_array($file_array['type'], $this->allowed_image_types)){
		 
		 	if(function_exists('current_user_can') && current_user_can('administrator') ){
			
			}else{
			
				$image_info = getimagesize($file_array["tmp_name"]);	  	
				// MUST HAVE 150PX
				if($image_info[0] < 150 && $image_info[1] < 150){		
				return array("error" => __("Sorry, This image is too small. Please select a bigger image.","premiumpress"));			
				}
				
			} 	
			
		}
  
  		// SETUP ALLOWED FILE TYPES	 
		$allowed_file_types = $this->allowed_image_types;	 
		$allowed_file_types = array_merge($allowed_file_types,$this->allowed_video_types);
		
		if(_ppt("audioupload_enable") == "1"){
		$allowed_file_types = array_merge($allowed_file_types,$this->allowed_music_types);
		}
		
		//if(in_array(THEME_KEY, array("pj","mj"))){		
		//$allowed_file_types = array_merge($allowed_file_types,$this->allowed_doc_types);
		//$allowed_file_types = array_merge($allowed_file_types,$this->allowed_zip_types);		
		//}
		
		if(!in_array($file_array['type'], $allowed_file_types)) {
		
			return array("error" => __("Sorry, We do not accept this type of file.","premiumpress"));
		}
		
		// die(print_r($allowed_file_types));
        // If the uploaded file is the right format
        if(in_array($file_array['type'], $allowed_file_types)) {
			  
			// upload the file to the server
			$uploaded_file = wp_handle_upload( $file_array, $upload_overrides );
	  
			// CHECK FOR ERRORS
			if(isset($uploaded_file['error']) ){		
				return $uploaded_file;
			}
			
			// set up the array of arguments for "wp_insert_post();"
			$attachment = array(			 
				'post_mime_type' => $wp_filetype['type'],
				'post_title' => preg_replace('/\.[^.]+$/', '', basename( $file['name'] ) ),
				'post_content' => '',
				'post_author' => $userID,
				'post_status' => 'inherit',
				'post_type' => 'attachment',
				'post_parent' => $postID,
				'guid' => $uploaded_file['url']
			);	
			
			// INCLUDE UPLOAD SCRIPTS
			$dir_path = str_replace("wp-content","",WP_CONTENT_DIR);
			if(!function_exists('wp_handle_upload')){
			require $dir_path . "/wp-admin/includes/file.php";
			}
			
		
			// insert the attachment post type and get the ID
			$attachment_id = wp_insert_post( $attachment );
	
			// generate the attachment metadata
			$attach_data = wp_generate_attachment_metadata( $attachment_id, $uploaded_file['file'] );
		 	 
			// update the attachment metadata
			$rr = wp_update_attachment_metadata( $attachment_id,  $attach_data );
			
			// ADD IN MISSING DATABASE TABLE KEY	
			$thumbnail = "";
			if(!empty($attach_data)){	//<-- this is for image uploads			
		
				add_post_meta($attachment_id,'_wp_attached_file',$attach_data['file']);
				if(isset($attach_data['sizes']['thumbnail']['file'])){
					$thumbnail = $uploads['url']."/".$attach_data['sizes']['thumbnail']['file'];
				}else{
					$thumbnail = $uploads['url']."/".$file['name'];
				}
				
				// GET IMAGE DIMENTIONS AND DPI				
				$image_attributes = wp_get_attachment_image_src( $attachment_id , 'full' );				 
				if(isset($image_attributes[2])){				
					$dimentions = $image_attributes[1]."x".$image_attributes[2];
					$dpi = $this->_format_dpi(addslashes($uploaded_file['file']));
				} 
			
			
			}else{ //<-- this is for video uploads
			 
				$newmetadata = array(
					'filepath' 	=> addslashes($uploaded_file['file']),  
					'name' 		=> $file['name'], 
					'mime_type'	=> $file['type'], 
					'filesize' 	=> $file['size'], 
					'postID'	=> $postID,  
				);
				
				// CHECK IF IS A VIDEO FILE
				if(function_exists('wp_read_video_metadata')){
					$vd = wp_read_video_metadata(addslashes($uploaded_file['file']));				
					if(is_array($vd) && !empty($vd)){				
						$newmetadata = array_merge($vd, $newmetadata);
					}
				}
			 	
				// SAVE MEDTA DATA
				add_post_meta($attachment_id, '_wp_attachment_metadata', $newmetadata );
				
				// SAVE MISSING FILENAME
				add_post_meta($attachment_id, '_wp_attached_file',  addslashes($uploaded_file['file']) );
 				
			} 
		
				
			// BUILD ARRAY TO SAVE IMAGE INTO DATABASE
			// AS THE ATTACHMENT FOR THE POST
			if(!isset($dpi)){ $dpi = 0; }
			if(!isset($dimentions)){ $dimentions = 0; }
			
			$isFeaturedImage = false;
			if(is_numeric($featured)){
			$isFeaturedImage = true;
			}
			
			$isPublished = 0;
			//if(function_exists('current_user_can') && current_user_can('administrator') ){
			$isPublished = 1;
			//}
			
			$save_file_array = array(
				'name' 		=> $file['name'],
				'type'		=> $file['type'],
				'postID'	=> $postID,
				'size'		=> $file['size'],
				'src' 		=> $uploaded_file['url'],						
				'thumbnail' => str_replace(" ", "-",addslashes($thumbnail)),						
				'filepath' 	=> addslashes($uploaded_file['file']),
				'id'		=> $attachment_id,
				'default' 	=> $isFeaturedImage,
				'order'		=> 100,						
				'dimentions' => $dimentions,						
				'dpi' 		=> $dpi,
				'src' 		=> $uploaded_file['url'],
				'published' => $isPublished,	
				 				
			);	
			
			// $save_file_array			
				
			 
	
			// VIDEO DURATION
		 
			if(function_exists('wp_read_video_metadata') &&  in_array($file['type'], $this->allowed_video_types)  ){
				$vd = wp_read_video_metadata( $uploaded_file['file'] );
				if(isset($vd['length_formatted'])){
					update_post_meta($postID, 'time', $vd['length']);
					$save_file_array['time'] = $vd['length'];
				} 	
			}
			
				 
				// AUTO DETECT FILE TYPE AND ADD TO CORRECT ARRAY
				// WE NEED TO ADD NICER THUMBNAILS FOR NON-IMAGE TYPES (VIDEOS ETC)
				if(in_array($file['type'],$this->allowed_image_types)){ 
 
					if($featured == "videothumbnail"){
					
					$storage_key = "videothumbnails_array";
					
					}elseif($featured == "musicthumbnail"){
					
					$storage_key = "musicthumbnails_array";
					
					}else{
					
					$storage_key = "image_array";
					
					}				
			
					// SET THE MEDIA TYPE
					if(THEME_KEY == "ph"){
						update_post_meta($postID,'media_type', 1);
						if($image_attributes[1] > $image_attributes[0]){
						update_post_meta($postID,'orientation', 1);	
						}else{
						update_post_meta($postID,'orientation', 2);	
						}
					}										
				
				}elseif(in_array($file['type'],$this->allowed_music_types)){
				
					$storage_key = "music_array";
				
				}elseif(in_array($file['type'],$this->allowed_doc_types)){
				
					$storage_key = "doc_array";
					
				}elseif(in_array($file['type'],$this->allowed_zip_types)){
				
					$storage_key = "zip_array"; 
						
				}elseif(in_array($file['type'],$this->allowed_video_types)){
				
					if(strlen(_ppt('fallback_image_video')) > 5 ){
					$save_file_array["thumbnail"] = _ppt('fallback_image_video');					
					}else{				
					$save_file_array["thumbnail"] = CDN_PATH."images/novideo.jpg";					
					}
				
					$storage_key = "video_array";	
				 	if(THEME_KEY == "ph"){
						update_post_meta($postID,'media_type', 2);
						update_post_meta($postID,'orientation', 2);	
					}			
				 	
					// BUILD IN SUPPORT FOR FFMEG AND THUMBNAIL CREATION
					$thumbnail  = $uploads['path']."/".str_replace(".","_",str_replace(" ","",$file['name']))."_ffmpeg.jpg";	
					if(VideoThumbnail::createMovieThumb($uploaded_file['file'], $thumbnail)){ 
					   
						 
						if (file_exists($thumbnail)) { 	
						
							$save_file_array["thumbnail"] =  $thumbnail; 							
							
							// NOW SAVE AND ATTACH THIS IMAGE TO THE
							// WORDPRESS MEDIA SYSTEM FOR BETTER INTEGRATION 
							$wp_filetype = wp_check_filetype( $uploads['path'].$thumbnail, null );				
							// Set attachment data
							$at1 = array(
								'post_mime_type' => $wp_filetype['type'],
								'post_title'     => sanitize_file_name( $thumbnail ),
								'post_content'   => '',
								'post_status'    => 'inherit'
							);
							// Create the attachment
							$attach_id = wp_insert_attachment( $at1, $uploads['path'].$thumbnail, $postID );
							// Define attachment metadata
							$at2 = wp_generate_attachment_metadata( $attach_id, $uploads['path'].$thumbnail );
							// Assign metadata to attachment
							wp_update_attachment_metadata( $attach_id, $at2 );
							// And finally assign featured image to post
							set_post_thumbnail( $attachment_id, $attach_id );	// $attachment_id is from the first upload (above)
	 						
							
						}
						
					}
					
				}else{
					$storage_key = "image_array"; // fallback to image array
				} 
				
				
				
				// ADD TO MY IMAGE GALLERY ARRAY
				$my_existing_images = get_post_meta($postID,$storage_key, true);
				if(is_array($my_existing_images)){
					
					$new_array = array();
					$new_array[] = $save_file_array;
					foreach($my_existing_images as $img ){ $new_array[] = $img; }	
										
				}else{				
					$new_array = array();
					$new_array[] = $save_file_array;									
				}				 		
				// SAVE
				update_post_meta($postID,$storage_key,$new_array);	
				
				// CHECK FOR FEATURED
				// DONT SET MUSIC FILE AS IMAGE OPTION
				if(!in_array($storage_key,array("videothumbnails_array", "musicthumbnails_array")) && $featured && in_array($file_array['type'], $this->allowed_image_types) ){
				 
					set_post_thumbnail($postID, $attachment_id);
				}
				
			
		
			
			// format responce
			$responce = array();
			$responce["name"] 				= $file_array['name'];
			$responce["size"] 				= $file['size'];
			$responce["type"] 				= $file_array['type'];
			if(!empty($attach_data)){
			$responce["url"] 				= $uploads['url']."/".$attach_data['sizes']['thumbnail']['file'];
			}else{
			$responce["url"] 				= "";
			}
			$responce["src"] 				= $save_file_array["src"];
			$responce["thumbnail_url"] 		= $save_file_array["thumbnail"];
			$responce["delete_url"] 		= $postID."---".$attachment_id; // CUSTOM FOR DELETION SCRIPT
			$responce["delete_type"] 		= "DELETE";
			$responce["aid"] 				= $attachment_id;
			$responce["pid"] 				= $postID;
			$responce["link"] 				= get_permalink($postID);	
			$responce["uid"] 				= $userdata->ID;		
		 
		 
			return hook_upload_return(array($responce));
			  
		}else{
		// print_r($file_array);
		return array("error" => __("Sorry, We do not accept this type of file.","premiumpress"));
		
		}
 
	} // end if		 

}

/*
	this function returns the file type
*/
function _format_type($type){

	$g = explode("/", $type); 
	return $g[1];

}


function _format_dpi($filename){

    $a = fopen($filename,'r');
    $string = fread($a,20);
    fclose($a);

    $data = bin2hex(substr($string,14,4));
    $x = substr($data,0,4);
    $y = substr($data,4,4);

    $ff = array(hexdec($x),hexdec($y));
	
	if($ff[0] < 72){
		return 72;
	}else{
		return $ff[1];
	}
}
 
function _format_bytes($a_bytes)
{
    if ($a_bytes < 1024) {
        return $a_bytes .' B';
    } elseif ($a_bytes < 1048576) {
        return round($a_bytes / 1024, 2) .' Kb';
    } elseif ($a_bytes < 1073741824) {
        return round($a_bytes / 1048576, 2) . ' Mb';
    } elseif ($a_bytes < 1099511627776) {
        return round($a_bytes / 1073741824, 2) . ' Gb';
    } elseif ($a_bytes < 1125899906842624) {
        return round($a_bytes / 1099511627776, 2) .' Tb';
    } elseif ($a_bytes < 1152921504606846976) {
        return round($a_bytes / 1125899906842624, 2) .' PiB';
    } elseif ($a_bytes < 1180591620717411303424) {
        return round($a_bytes / 1152921504606846976, 2) .' EiB';
    } elseif ($a_bytes < 1208925819614629174706176) {
        return round($a_bytes / 1180591620717411303424, 2) .' ZiB';
    } else {
        return round($a_bytes / 1208925819614629174706176, 2) .' YiB';
    }
}	
 	
	
function reArrayFiles(&$file_post) {

    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);

    for ($i=0; $i<$file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }

    return $file_ary;
}	
	
	
	
	
/* =============================================================================
	GET IMAGE STANDARD
	========================================================================== */

function FALLBACK_IMAGE($postid){ global $MEDIA;

	return $this->_FALLBACK($postid);
	
}
function GETIMAGE($postID, $link=true, $atrs = array()){ global $wpdb, $post, $CORE; $image = ""; 


if(!is_numeric($postID)){ return; } 
 
 
// CHECK IF WE HAVE A THUMBNAIL
if ( has_post_thumbnail($postID) ) { 					
	if(isset($GLOBALS['flag-single'])){ 
	$image .= hook_image_display(get_the_post_thumbnail($postID, 'full', array('class'=> "ppt_thumbnail")));
	}else{
	if($link){	$permalink = get_permalink($postID); $image .= '<a href="'.$permalink.'" class="frame">'; }
	$image .= hook_image_display(get_the_post_thumbnail($postID, array(183,110), array('class'=> "ppt_thumbnail")));	 	
	if($link){ $image .= '<div class="clearfix"></div></a>'; }	
	} 
// CHECK FOR FALLBACK IMAGE				
}else{
	 
	$fimage = $this->FALLBACK_IMAGE($postID); 
 
	if($fimage != ""){ 
		 
			if($link){ $permalink = get_permalink($postID); $image .= '<a  href="'.$permalink.'" class="frame">'; }
			$image .= $fimage; 
			if($link){ $image .= '<div class="clearfix"></div></a>'; }
		 
	}
}
if(isset($atrs['pathonly'])){ 
$array = array();
preg_match( '/src="([^"]*)"/i', $image, $array ) ;
	if(isset($array[1])){
	return $array[1];
	}else{
	return "";
	}
}
return preg_replace('/\\<(.*?)(width="(.*?)")(.*?)(height="(.*?)")(.*?)\\>/i', '<$1$4$7>', $image);
}

 

	
	 
	
}
	
	
/* =============================================================================
	VIDEO THUMBNAIL
	========================================================================== */

class VideoThumbnail
{
    public static function createMovieThumb($srcFile, $destFile = "test.jpg")
    {
        // Change the path according to your server.
        $ffmpeg_path = '/usr/local/bin/';
		
        $output = array();

        $cmd = sprintf('%sffmpeg -i %s -an -ss 00:00:05 -r 1 -vframes 1 -y %s', 
            $ffmpeg_path, $srcFile, $destFile);

        if (strtoupper(substr(PHP_OS, 0, 3) == 'WIN'))
            $cmd = str_replace('/', DIRECTORY_SEPARATOR, $cmd);
        else
            $cmd = str_replace('\\', DIRECTORY_SEPARATOR, $cmd);

        exec($cmd, $output, $retval);
		
        if ($retval)
            return false;

        return $destFile;
    }
}

?>