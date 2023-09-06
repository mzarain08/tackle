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

global $CORE, $userdata;

if(isset($_GET['post'])){ $_GET['eid'] = $_GET['post']; }
 
 
?>
 

 
<div class="row video-extras" <?php if(THEME_KEY != "vt"){ ?>style="display:none;"<?php } ?>>

 
<div class="col-md-6 mt-4">
   
 <div class="position-relative">
   <input type="text" placeholder="<?php echo __("Youtube Video ID","premiumpress") ?>" class="form-control btn-block mb-3" name="custom[youtube_id]" onchange="ProcessyouTubeVieo();"  id="youtube_videid" value="<?php if(isset($_GET['eid'])){ echo get_post_meta($_GET['eid'], "youtube_id",true ); } ?>" />
    
  <i class="fab fa-youtube position-absolute" style="right:10px;top:14px;"></i>
   		
</div> 
</div>
  <?php if(isset($_GET['eid']) && get_post_meta($_GET['eid'], "youtube_id",true ) != ""){ ?>
 <div class="col-md-6">
        <iframe width="100%" height="200px" src="https://www.youtube.com/embed/<?php echo get_post_meta($_GET['eid'], "youtube_id",true ); ?>"></iframe>
</div>
 
<?php } ?> 



</div>
 
<script>

function ProcessyouTubeVieo(){
   
    
   var videoID = jQuery('#youtube_videid').val();
  
   	if(videoID.length != 11){
   	
   		var videoid = videoID.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/);
   		if(videoid != null) {
   		   videoID = videoid[1];
   		   jQuery('#youtube_videid').val(videoID);
   		} 		
   	}
}

</script>