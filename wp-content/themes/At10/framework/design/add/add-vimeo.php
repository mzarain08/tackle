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


    <div class="col-md-6">
       
       <div class="position-relative">
       <input type="text" placeholder="<?php echo __("Vimeo Video ID","premiumpress") ?>" class="form-control btn-block mb-3" name="custom[vimeo_id]" onchange="ProcessVimeoVideo();" id="vimeo_videid" value="<?php if(isset($_GET['eid'])){ echo get_post_meta($_GET['eid'], "vimeo_id",true ); } ?>" />
     
      <i class="fab fa-vimeo position-absolute" style="right:10px;top:14px;"></i>
   		
        </div>
    </div>
    
    <div class="col-md-6">
    
         
     <?php if(isset($_GET['eid']) && get_post_meta($_GET['eid'], "vimeo_id",true ) != ""){ ?>
      <div id="videoplayer">
        <iframe width="100%" height="240px" src="https://player.vimeo.com/video/<?php echo get_post_meta($_GET['eid'], "vimeo_id",true ); ?>"></iframe>
      </div>
      <?php } ?>
    
    </div>

</div>


  
 
<script>

function ProcessVimeoVideo(){
   
    
   var videoID = jQuery('#vimeo_videid').val();
    
   	canContinue = true;
 
}
</script>
