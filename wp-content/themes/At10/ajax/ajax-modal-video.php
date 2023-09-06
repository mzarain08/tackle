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
    
	global $CORE, $userdata; $youtubevid = 0; $videmovid = 0;
	
if(!isset($_POST['pid'])){ 
return "";
}
 
// VIDEO SIZE
$width = "100%"; $height = "100%";
if(isset($_POST['small'])){
$width = "100%"; $height = "260px";
}

// GET ALL VIDEOS	
$videos = $CORE->MEDIA("get_all_videos", $_POST['pid']);
 
// CHECK FOR SINGLE VIDEO ID
if(isset($_POST['vid']) && is_numeric($_POST['vid']) ){

	foreach($videos as $k => $img){
		if($img['id'] != $_POST['vid']){
			unset($videos[$k]);
		}		 
	}
	// RESET KEYS
	$videos = array_values(array_filter($videos));

}elseif(isset($_POST['vid']) && $_POST['vid'] == "youtube"){
	
	$videos =  array();
	$youtubeid = get_post_meta($_POST['pid'],'youtube_id',true);
	
	if(defined('WLT_DEMOMODE') && $youtubeid == ""){
		$youtubeid = "rsFpnWLyx20";
	}
	 
	
	if($youtubeid != ""){	
		$youtubevid = 1;
	}
	
}elseif(isset($_POST['vid']) && $_POST['vid'] == "vimeo"){
	
	$videos =  array();
	$videid = get_post_meta($_POST['pid'],'vimeo_id',true);
	if($videid != ""){		
		$videmovid = 1;	
	} 
 		
}else{

	if(THEME_KEY == "vt" && is_array($videos) && !empty($videos) ){ 
	
         foreach($videos as $k => $img){		 
			 if($img['type'] == "image/jpg"){
			 	unset($videos[$k]);
			 }		 
		 }
		 // RESET KEYS
		 $videos = array_values(array_filter($videos));
	}

	$youtubevid = 0;
	$videmovid =0;	
	 
	if(isset($videos[0]) && $videos[0]['type'] == "image/jpeg"){
	unset($videos[0]);
	}	 
	
	if( !is_array($videos) || is_array($videos) && empty($videos)){ 
		$youtubeid = get_post_meta($_POST['pid'],'youtube_id',true); 	 
		if($youtubeid != ""){		 
		$youtubevid = 1;	
		}
		
		$videid = get_post_meta($_POST['pid'],'vimeo_id',true);
		if($videid != ""){		
		$videmovid = 1;	
		} 
	}  
} 

///////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////


$author_id = get_post_field( 'post_author', $_POST['pid'] );
 
///////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////

 
 
if( THEME_KEY == "vt" && $CORE->USER("hasaccess_special_vdeoaccess", $_POST['pid']) == "0" && _ppt(array('lst','videopreview_enable')) != "1" ){ // 

?>
 
<div class="card-ppt-search clearfix card-1 ">
   
   
   <div class=" videoplaybutton_wrap" style="position: absolute;top: 40%;left: 40%;"> 
   <a href="javascript:void(0)"  <?php if(!$userdata->ID){ ?> onclick="processLogin();" <?php }else{ ?>onclick="processUpgrade();"<?php } ?> class="videoplaybutton bg-primary"> 
   <i class="fa fa-play text-white"></i> 
   <span class="ripple_playbtn bg-primary"></span> 
   <span class="ripple_playbtn bg-primary"></span> 
   <span class="ripple_playbtn bg-primary"></span> 
   </a>
   </div>
   
   
    <figure><?php echo do_shortcode("[IMAGE link=0]"); ?>
    
  </figure>
    
 
</div>


<?php 

}else{
///////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////
 
?>

<div id="videoplayer" class="position-relative">   

<div id="videoplayerwrapp"></div>
 
<?php 
if( !is_array($videos) || is_array($videos) && empty($videos) && ($youtubevid == 0 && $videmovid ==0 )){  if(!isset($_POST['small'])){ ?>

<div class="bg-light p-5 border text-center y-middle" style="height:300px;">
<div>
  <div class=" opacity-5 mb-4"><i class="fal fa-video fa-4x"></i></div>
  <div class="opacity-5"><?php echo __("video unavailable","premiumpress") ?></div>
</div>
</div>


<?php 
/******************************************************************************************/
/******************************************************************************************/
/******************************************************************************************/
/******************************************************************************************/ 
?>  

<?php  } }elseif( is_array($videos) && !empty($videos) ){ 

	$width = "500px";
	if(isset($_POST['small'])){
	$width = "500px";
	}
	
	if(isset($GLOBALS['top-video'])){
	$width = "900px";
	
	}
	
	// THUMBAIL
	$thumbnail = $videos[0]['thumbnail']; // MULTIPLE VIDEOS USER SETS THUMNAIL
	
	
	if(in_array(THEME_KEY, array("vt"))){ // VIDEO THEME ONLY UPLOADS SEPRATE
		
		$audiothumbs = $CORE->MEDIA("get_all_videothumbnails", $_POST['pid']);	 
		if(is_array($audiothumbs) && !empty($audiothumbs) && is_numeric($audiothumbs[0]['id']) && strlen($audiothumbs[0]['thumbnail']) > 2 ){
		$thumbnail = $audiothumbs[0]['src'];
		}
	
	} 
 

	echo do_shortcode('[video src="'.$videos[0]['src'].'" width="'.$width.'" height="'.$height.'" autoplay="0" poster="'.$thumbnail.'" ][/video]'); ?>
 

<script src="<?php echo home_url(); ?>/wp-includes/js/mediaelement/mediaelement-and-player.js"></script> 

<script>

jQuery(document).ready(function(){ 

var wins = jQuery(window).width(); 



 setTimeout(function(){  jQuery(".wp-video").css("width","100%"); }, 2000);

});
</script>

<style>
 
.mejs__offscreen{border:0;clip:rect(1px,1px,1px,1px);clip-path:inset(50%);height:1px;margin:-1px;overflow:hidden;padding:0;position:absolute;width:1px;word-wrap:normal}.mejs__container{max-width: 570px; max-height: 500px; overflow: hidden; background:#000;box-sizing:border-box;font-family:Helvetica,Arial,serif;position:relative;text-align:left;text-indent:0;vertical-align:top}.mejs__container *{box-sizing:border-box}.mejs__container video::-webkit-media-controls,.mejs__container video::-webkit-media-controls-panel,.mejs__container video::-webkit-media-controls-panel-container,.mejs__container video::-webkit-media-controls-start-playback-button{-webkit-appearance:none;display:none!important}.mejs__fill-container,.mejs__fill-container .mejs__container{height:100%;width:100%}.mejs__fill-container{background:0 0;margin:0 auto;overflow:hidden;position:relative}.mejs__container:focus{outline:0}.mejs__iframe-overlay{height:100%;position:absolute;width:100%; max-height:500px; overflow: hidden; }.mejs__embed,.mejs__embed body{background:#000;height:100%;margin:0;overflow:hidden;padding:0;width:100%}.mejs__fullscreen{overflow:hidden!important}.mejs__container-fullscreen{bottom:0;left:0;overflow:hidden;position:fixed;right:0;top:0;z-index:1000}.mejs__container-fullscreen .mejs__mediaelement,.mejs__container-fullscreen video{height:100%!important;width:100%!important}.mejs__background{left:0;position:absolute;top:0}.mejs__mediaelement{height:100%;left:0;position:absolute;top:0;width:100%;z-index:0}.mejs__poster{background-position:50% 50%;background-repeat:no-repeat;background-size:cover;left:0;position:absolute;top:0;z-index:1}:root .mejs__poster-img{display:none}.mejs__poster-img{border:0;padding:0}.mejs__overlay{align-items:center;display:flex;justify-content:center;left:0;position:absolute;top:0}.mejs__layer{z-index:1}.mejs__overlay-play{cursor:pointer}.mejs__overlay-button{background:url(<?php echo home_url(); ?>/wp-includes/js/mediaelement/mejs-controls.svg) no-repeat;background-position:0 -39px;height:80px;width:80px}.mejs__overlay:hover>.mejs__overlay-button{background-position:-80px -39px}.mejs__overlay-loading{height:80px;width:80px}.mejs__overlay-loading-bg-img{animation:mejs__loading-spinner 1s linear infinite;background:transparent url(<?php echo home_url(); ?>/wp-includes/js/mediaelement/mejs-controls.svg) -160px -40px no-repeat;display:block;height:80px;width:80px;z-index:1}@keyframes mejs__loading-spinner{100%{transform:rotate(360deg)}}.mejs__controls{bottom:0;display:flex;height:40px;left:0;list-style-type:none;margin:0;padding:0 10px;position:absolute;width:100%;z-index:3}.mejs__controls:not([style*='display: none']){background:rgba(255,0,0,.7);background:linear-gradient(transparent,rgba(0,0,0,.35))}.mejs__button,.mejs__time,.mejs__time-rail{font-size:10px;height:40px;line-height:10px;margin:0;width:32px}.mejs__button>button{background:transparent url(<?php echo home_url(); ?>/wp-includes/js/mediaelement/mejs-controls.svg);border:0;cursor:pointer;display:block;font-size:0;height:20px;line-height:0;margin:10px 6px;overflow:hidden;padding:0;position:absolute;text-decoration:none;width:20px}.mejs__button>button:focus{outline:dotted 1px #999}.mejs__container-keyboard-inactive [role=slider],.mejs__container-keyboard-inactive [role=slider]:focus,.mejs__container-keyboard-inactive a,.mejs__container-keyboard-inactive a:focus,.mejs__container-keyboard-inactive button,.mejs__container-keyboard-inactive button:focus{outline:0}.mejs__time{box-sizing:content-box;color:#fff;font-size:11px;font-weight:700;height:24px;overflow:hidden;padding:16px 6px 0;text-align:center;width:auto}.mejs__play>button{background-position:0 0}.mejs__pause>button{background-position:-20px 0}.mejs__replay>button{background-position:-160px 0}.mejs__time-rail{direction:ltr;flex-grow:1;height:40px;margin:0 10px;padding-top:10px;position:relative}.mejs__time-buffering,.mejs__time-current,.mejs__time-float,.mejs__time-float-corner,.mejs__time-float-current,.mejs__time-hovered,.mejs__time-loaded,.mejs__time-marker,.mejs__time-total{border-radius:2px;cursor:pointer;display:block;height:10px;position:absolute}.mejs__time-total{background:rgba(255,255,255,.3);margin:5px 0 0;width:100%}.mejs__time-buffering{animation:buffering-stripes 2s linear infinite;background:linear-gradient(-45deg,rgba(255,255,255,.4) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.4) 50%,rgba(255,255,255,.4) 75%,transparent 75%,transparent);background-size:15px 15px;width:100%}@keyframes buffering-stripes{from{background-position:0 0}to{background-position:30px 0}}.mejs__time-loaded{background:rgba(255,255,255,.3)}.mejs__time-current,.mejs__time-handle-content{background:rgba(255,255,255,.9)}.mejs__time-hovered{background:rgba(255,255,255,.5);z-index:10}.mejs__time-hovered.negative{background:rgba(0,0,0,.2)}.mejs__time-buffering,.mejs__time-current,.mejs__time-hovered,.mejs__time-loaded{left:0;transform:scaleX(0);transform-origin:0 0;transition:.15s ease-in all;width:100%}.mejs__time-buffering{transform:scaleX(1)}.mejs__time-hovered{transition:height .1s cubic-bezier(.44,0,1,1)}.mejs__time-hovered.no-hover{transform:scaleX(0)!important}.mejs__time-handle,.mejs__time-handle-content{border:4px solid transparent;cursor:pointer;left:0;position:absolute;transform:translateX(0);z-index:11}.mejs__time-handle-content{border:4px solid rgba(255,255,255,.9);border-radius:50%;height:10px;left:-7px;top:-4px;transform:scale(0);width:10px}.mejs__time-rail .mejs__time-handle-content:active,.mejs__time-rail .mejs__time-handle-content:focus,.mejs__time-rail:hover .mejs__time-handle-content{transform:scale(1)}.mejs__time-float{background:#eee;border:solid 1px #333;bottom:100%;color:#111;display:none;height:17px;margin-bottom:9px;position:absolute;text-align:center;transform:translateX(-50%);width:36px}.mejs__time-float-current{display:block;left:0;margin:2px;text-align:center;width:30px}.mejs__time-float-corner{border:solid 5px #eee;border-color:#eee transparent transparent;border-radius:0;display:block;height:0;left:50%;line-height:0;position:absolute;top:100%;transform:translateX(-50%);width:0}.mejs__long-video .mejs__time-float{margin-left:-23px;width:64px}.mejs__long-video .mejs__time-float-current{width:60px}.mejs__broadcast{color:#fff;height:10px;position:absolute;top:15px;width:100%}.mejs__fullscreen-button>button{background-position:-80px 0}.mejs__unfullscreen>button{background-position:-100px 0}.mejs__mute>button{background-position:-60px 0}.mejs__unmute>button{background-position:-40px 0}.mejs__volume-button{position:relative}.mejs__volume-button>.mejs__volume-slider{-webkit-backface-visibility:hidden;background:rgba(50,50,50,.7);border-radius:0;bottom:100%;display:none;height:115px;left:50%;margin:0;position:absolute;transform:translateX(-50%);width:25px;z-index:1}.mejs__volume-button:hover{border-radius:0 0 4px 4px}.mejs__volume-total{background:rgba(255,255,255,.5);height:100px;left:50%;margin:0;position:absolute;top:8px;transform:translateX(-50%);width:2px}.mejs__volume-current{background:rgba(255,255,255,.9);left:0;margin:0;position:absolute;width:100%}.mejs__volume-handle{background:rgba(255,255,255,.9);border-radius:1px;cursor:ns-resize;height:6px;left:50%;position:absolute;transform:translateX(-50%);width:16px}.mejs__horizontal-volume-slider{display:block;height:36px;position:relative;vertical-align:middle;width:56px}.mejs__horizontal-volume-total{background:rgba(50,50,50,.8);border-radius:2px;font-size:1px;height:8px;left:0;margin:0;padding:0;position:absolute;top:16px;width:50px}.mejs__horizontal-volume-current{background:rgba(255,255,255,.8);border-radius:2px;font-size:1px;height:100%;left:0;margin:0;padding:0;position:absolute;top:0;width:100%}.mejs__horizontal-volume-handle{display:none}.mejs__captions-button,.mejs__chapters-button{position:relative}.mejs__captions-button>button{background-position:-140px 0}.mejs__chapters-button>button{background-position:-180px 0}.mejs__captions-button>.mejs__captions-selector,.mejs__chapters-button>.mejs__chapters-selector{background:rgba(50,50,50,.7);border:solid 1px transparent;border-radius:0;bottom:100%;margin-right:-43px;overflow:hidden;padding:0;position:absolute;right:50%;visibility:visible;width:86px}.mejs__chapters-button>.mejs__chapters-selector{margin-right:-55px;width:110px}.mejs__captions-selector-list,.mejs__chapters-selector-list{list-style-type:none!important;margin:0;overflow:hidden;padding:0}.mejs__captions-selector-list-item,.mejs__chapters-selector-list-item{color:#fff;cursor:pointer;display:block;list-style-type:none!important;margin:0 0 6px;overflow:hidden;padding:0}.mejs__captions-selector-list-item:hover,.mejs__chapters-selector-list-item:hover{background-color:#c8c8c8!important;background-color:rgba(255,255,255,.4)!important}.mejs__captions-selector-input,.mejs__chapters-selector-input{clear:both;float:left;left:-1000px;margin:3px 3px 0 5px;position:absolute}.mejs__captions-selector-label,.mejs__chapters-selector-label{cursor:pointer;float:left;font-size:10px;line-height:15px;padding:4px 10px 0;width:100%}.mejs__captions-selected,.mejs__chapters-selected{color:#21f8f8}.mejs__captions-translations{font-size:10px;margin:0 0 5px}.mejs__captions-layer{bottom:0;color:#fff;font-size:16px;left:0;line-height:20px;position:absolute;text-align:center}.mejs__captions-layer a{color:#fff;text-decoration:underline}.mejs__captions-layer[lang=ar]{font-size:20px;font-weight:400}.mejs__captions-position{bottom:15px;left:0;position:absolute;width:100%}.mejs__captions-position-hover{bottom:35px}.mejs__captions-text,.mejs__captions-text *{background:rgba(20,20,20,.5);box-shadow:5px 0 0 rgba(20,20,20,.5),-5px 0 0 rgba(20,20,20,.5);padding:0;white-space:pre-wrap}.mejs__container.mejs__hide-cues video::-webkit-media-text-track-container{display:none}.mejs__overlay-error{position:relative}.mejs__overlay-error>img{left:0;max-width:100%;position:absolute;top:0;z-index:-1}.mejs__cannotplay,.mejs__cannotplay a{color:#fff;font-size:.8em}.mejs__cannotplay{position:relative}.mejs__cannotplay a,.mejs__cannotplay p{display:inline-block;padding:0 15px;width:100%}
</style> 


<?php 
/******************************************************************************************/
/******************************************************************************************/
/******************************************************************************************/
/******************************************************************************************/ 
?>  

<?php }elseif($youtubevid == 1){ ?>
  
  
<iframe width="<?php echo $width; ?>" height="<?php echo $height; ?>" src="https://www.youtube.com/embed/<?php echo $youtubeid; ?><?php if(_ppt(array('lst','videoautoplay')) == "1"){ echo "?autoplay=1"; } ?>" frameborder="0" allow="<?php if(_ppt(array('lst','videoautoplay')) == "1"){ echo "autoplay"; } ?>; accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

<?php 
/******************************************************************************************/
/******************************************************************************************/
/******************************************************************************************/
/******************************************************************************************/ 
?>  

<?php }elseif($videmovid  == 1){ ?>

<?php if(isset($_POST['pid']) && !isset($_POST['action']) ){  ?><hr /><?php } ?> 

 
<iframe src="https://player.vimeo.com/video/<?php echo $videid; ?><?php if(_ppt(array('lst','videoautoplay')) == "1"){ echo "?autoplay=1"; } ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" frameborder="0" allow="autoplay; fullscreen; picture-in-picture;" allowfullscreen></iframe>
<?php }else{ ?> 


<?php } ?>

</div>

<?php 
/******************************************************************************************/
/******************************************************************************************/
/******************************************************************************************/
/******************************************************************************************/ 
?>  
<?php if(THEME_KEY == "vt" ){ global $CORE_VIDEO; 
 
 
if($CORE->USER("hasaccess_special_vdeoaccess", $_POST['pid']) == "0" && _ppt(array('lst','videopreview_enable')) == "1"){
 

$vidp = 1;
if(is_numeric(_ppt(array('lst', 'videopreview_seconds')))){
$vidp = _ppt(array('lst', 'videopreview_seconds'));
}
 
$time = $vidp;
?>
    
    
    
      <script> 
 var i = 0;
function makeProgress(){
	  	
	      
	   if(i < 100){
		   i = i + 1;		  
		   jQuery(".videotimeoutbar").css("width", i + "%").text(i + " %");
	   } 
   
   		setTimeout("makeProgress()", <?php echo $vidp*10; ?>);
	
	}
	
   function processVideoOpen1(){	 
   
					 var i = 0;
								 
						makeProgress();
						 jQuery('#upgrademessage').hide();
						jQuery('#freepreviewbar').show();
					
						 
						 setTimeout(function(){  
						 
							jQuery('#videoplayer').html('');
							jQuery('#upgrademessage').show();
							jQuery('#freepreviewbar').hide();
						 
							}, <?php echo $time*1000; ?>);
    
   } 
    
	function addWrapper(){
	
	jQuery('#videoplayerwrapp').html('<div style="height:100%; width:100%; position:absolute; top:0;z-index:10000;" id="videoclickwrap" onclick="removeWrapper();"></div>');
	 
	}
	
	function removeWrapper(){
	
	jQuery('#videoclickwrap').hide();
	 processVideoOpen1();
	}
	
    jQuery(document).ready(function(){ 
	setTimeout(function(){  
	 addWrapper();	 
	 }, 1000);
	 
	});  
   
   </script> 
  
   
    <div class="container p-3 border bg-secondary text-white mb-4" id="freepreviewbar" style="display:none;">
      <div class="row">
        <div class="col-12"> <strong><?php echo __("Free Preview","premiumpress") ?></strong> </div>
        <div class="col-12">
          <div class="progress mt-2" style=" height:40px;">
            <div class="progress-bar progress-bar-striped videotimeoutbar" style="min-width: 20px;"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="container h-100 border px-md-5 bg-secondary text-white mb-4" id="upgrademessage" style="display:none;">
      <div class="row align-items-center h-100 my-md-5 py-5 ">
        <div class="col-10 mx-auto text-center my-lg-3">
          <h3><?php echo __("Video Preview Ended!","premiumpress") ?></h3>
          <p><?php echo wpautop(stripslashes(_ppt(array('lst', 'videopreview_message')))); ?></p>
          <a href="javascript:void(0)"  <?php if(!$userdata->ID){ ?> onclick="processLogin();" <?php }else{ ?>onclick="processUpgrade();"<?php } ?> class="btn btn-primary btn-lg mt-4"><?php echo __("Upgrade Now","premiumpress") ?></a> </div>
      </div>
    </div>
<?php } ?>
<?php } ?>
<?php } ?>