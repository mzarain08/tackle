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

$eid = 0;

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


$counter = 1; $videos = ""; $audiothumbs = "";

if(isset($_GET['eid']) && is_numeric($_GET['eid']) ){

	$eid = $_GET['eid'];
 
	$videos = $CORE->MEDIA("get_all_videos", $_GET['eid']);	
	
	if(is_array($videos) && !empty($videos) ){ 
	
         foreach($videos as $k => $img){
		 
			 if($img['type'] == "image/jpg"){
			 unset($videos[$k]);
			 }
		 
		 }
	}  
	
	$audiothumbs = $CORE->MEDIA("get_all_videothumbnails", $_GET['eid']);	 
 
}
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


?>

 
<p class="text-muted"><?php echo __("Tell us where your video is stored.","premiumpress"); ?></p>



<div class="row mt-2">
 
    <div class="col-4 col-xl-3 gig-box gig-box-1 active">
    
        <div class="cardbox" onclick="showGigBox(1)">
        
        <i class="fal fa-chart-network"></i>
        
        <div class="small"><?php echo __("CDN","premiumpress"); ?></div>
        
    	</div> 
    
    </div>
    
    <div class="col-4 col-xl-3 gig-box gig-box-2">
    
        <div class="cardbox" onclick="showGigBox(2)">
        
        <i class="fal fa-desktop"></i>
        
        <div class="small"><?php echo __("My Computer","premiumpress"); ?></div>
        
    	</div> 
    
    </div>
    
    <div class="col-4 col-xl-3 gig-box gig-box-3">
    
        <div class="cardbox" onclick="showGigBox(3)">
        
        <i class="fab fa-youtube"></i>
        
        <div class="small"><?php echo __("YouTube","premiumpress"); ?></div>
        
    	</div> 
    
    </div>
    
    <div class="col-4 col-xl-3 gig-box gig-box-4">
    
        <div class="cardbox" onclick="showGigBox(4)">
        
        <i class="fab fa-vimeo"></i>
        
        <div class="small"><?php echo __("Vimeo","premiumpress"); ?></div>
        
    	</div> 
    
    </div>
    
</div>

<script>

function showGigBox(id){

jQuery('.vidb').hide();
jQuery('.gig-box').removeClass('active');
jQuery('.vidb-'+id).toggle();
jQuery('.gig-box-'+id).toggleClass('active');

}

</script> 














<div class="vidb vidb-1" style="">
 
<div class="block-header mt-4">
  <h3 class="block-header__title"><?php echo __("CDN Hosted Video","premiumpress"); ?></h3>
  <div class="block-header__divider">
  </div>
</div>
<p class="text-muted"><?php echo __("Enter the full website link for your CDN hosted video.","premiumpress"); ?></p>

<input type="text" name="custom[cdn_video]" class="form-control" value="<?php if($eid > 0){ echo get_post_meta($eid,"cdn_video",true); } ?>"  />

</div>



<div class="vidb vidb-3" style="display:none">


<div class="block-header mt-4">
  <h3 class="block-header__title"><?php echo __("YouTube Video","premiumpress"); ?></h3>
  <div class="block-header__divider">
  </div>
</div>

<p class="text-muted"><?php echo __("Enter the video ID or link to your YouTube video.","premiumpress"); ?></p>

<input type="text" placeholder="<?php echo __("Youtube Video ID","premiumpress") ?>" class="form-control btn-block mb-3" name="custom[youtube_id]" onchange="ProcessyouTubeVieo();"  id="youtube_videid" value="<?php if(isset($_GET['eid'])){ echo get_post_meta($_GET['eid'], "youtube_id",true ); } ?>" />



</div>


<div class="vidb vidb-4" style="display:none">


<div class="block-header mt-4">
  <h3 class="block-header__title"><?php echo __("Vimeo Video","premiumpress"); ?></h3>
  <div class="block-header__divider">
  </div>
</div>

<p class="text-muted"><?php echo __("Enter the video ID or link for your Vimeo video.","premiumpress"); ?></p>

<input type="text" placeholder="<?php echo __("Vimeo Video ID","premiumpress") ?>" class="form-control btn-block mb-3" name="custom[vimeo_id]" onchange="ProcessVimeoVideo();" id="vimeo_videid" value="<?php if(isset($_GET['eid'])){ echo get_post_meta($_GET['eid'], "vimeo_id",true ); } ?>" />


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
 
function ProcessVimeoVideo(){
   
    
   var videoID = jQuery('#vimeo_videid').val();
    
   	canContinue = true;
 
}
</script>


<div class="vidb vidb-2" style="display:none">

<div class="block-header mt-4">
  <h3 class="block-header__title"><?php echo __("My Computer","premiumpress"); ?></h3>
  <div class="block-header__divider">
  </div>
</div>



 
    <div class="bg-light p-4 rounded">
      <div class="font-weight-bold">
        <?php echo __("Upload Video File","premiumpress"); ?>
      </div>
      <hr />
      <div class="small text-muted mb-4">
        <?php echo __(".mp4, .webm, .flv or .ogg formats only.","premiumpress") ?>
      </div>
      <form id="audioupload" action="<?php echo get_home_url(); ?>/index.php" method="POST" enctype="multipart/form-data">
        <div class="audioupload-loading"></div>
        
        <div class="audioupload-buttonbar custom-file" <?php if(isset($_GET['eid']) && is_array($videos) && !empty($videos)){ echo "style='display:none;'"; }?>>
        
        
          <div class="d-flex justify-content-between align-items-center mt-2">
           
              <input type="file"  name="files[]" class="custom-file-input" multiple="">
              <label class="custom-file-label"><?php echo __("Select video","premiumpress") ?></label>
           
          </div>
          
            <?php if( is_admin() ){ ?>
          
          <div class="mt-3 text-center"><?php echo __("or","premiumpress"); ?></div>
          
          <div class="small mt-3 text-center">
            <a href="javascript:void(0);"  <?php if($eid == 0){ ?> onclick="SaveReloadMevideo();"<?php }else{ ?>id="video-selectmediafile"<?php } ?> class="btn btn-system btn-sm border">
			<?php echo __("Select WP Media File","premiumpress"); ?>
            </a>
          </div> 
          
          <?php } ?>
          
        </div> 
      
        
        
        
        <ul id="video-mediatablelist" class="files pl-0 list-unstyled pb-0">
          <?php  $counter = 0; if(isset($_GET['eid']) && is_array($videos) && !empty($videos)){ 
         foreach($videos as $img){  ?>
          <li class="this_item_<?php echo $counter; ?>">
           
            <div class="uploaditem template-upload clearfix ">
            
                <a href="<?php echo $img['src']; ?>" target="_blank" class="float-left text-dark small"><i class="fa fa-play mr-2"></i> <?php echo __("Preview Video","premiumpress"); ?></a>
              
              <button class="btn btn-sm rounded-0 p-0 float-right px-2 bg-light text-dark prev" type="button" data-placement="top" data-original-title="<?php echo __("Delete","premiumpress"); ?>" data-toggle="tooltip" onclick="ajax_media_delete('<?php if( !isset($img['postID']) || ( isset($img['postID']) && $img['postID'] == "") ){ echo esc_attr($_GET['eid']); }else{ echo $img['postID']; } ?>','<?php if( !isset($img['postID']) || ( isset($img['postID']) && $img['postID'] == "") ){ echo "9999"; }else{ echo $img['id']; } ?>','<?php echo $counter; ?>');jQuery('.this_item_<?php echo $counter; ?>').hide(); jQuery('#audioupload .custom-file').show();"> <i class="fa fa-trash m-0 prev" id="<?php echo $counter; ?>delbtn"></i> </button>
            </div>
         
          </li>
          <?php $counter++; } } ?>
        </ul>
        <div class="small mt-4 font-weight-bold opacity-5 text-center">
          <?php  echo __("Max Size:","premiumpress")." ".ini_get('upload_max_filesize');   ?>
        </div>
      
        </form> 
      
      
    </div>
  </div>
 
 
 
 
 
 
 
 
 
 
 
 
 
  
 
 
 <div class="_title mt-5"><span class="title-number bg-secondary">05</span> <?php echo __("Video Cover","premiumpress"); ?></div>
 

<p class="text-muted"><?php echo __("Upload a display image for this video. Size: 800 x 600px recommended.","premiumpress"); ?></p>

 
 
      <script>

jQuery(document).ready(function(){ 
<?php
 

if(isset($_GET['eid']) && is_array($audiothumbs) && !empty($audiothumbs) && is_numeric($audiothumbs[0]['id']) && strlen($audiothumbs[0]['thumbnail']) > 2 ){
	echo '_imageAudioCover("'.$audiothumbs[0]['src'].'", '.$audiothumbs[0]['id'].');';
}else{
 echo '_imageAudioCover("", 0);';
}
?> 


});
function _imageAudioCover(src, aid){

	divid = "audioimagefile"; tcount = 0;

	var cropper = new Slim(document.getElementById('audioimagefile'), {
				
				ratio: 'free',
				minSize: {
					width: 600,
					height: 400,
				}, 
				  
				service: '<?php echo home_url(); ?>/index.php',
				download: false,
				//instantEdit: true, 
				push: true,
				
				willRemove: function(data, ready) { 
					
					// GET ATTACHMENT ID
					thisaid = data.meta.aid;					
					if (typeof jQuery("#"+divid).data('aid') !== 'undefined'){					
					thisaid  = jQuery("#"+divid).attr("data-aid");					
					}
				 	 
					// AJAX
					 jQuery.ajax({
						   type: "POST",
						   url: '<?php echo home_url(); ?>/',		
						data: {
							slim: "delete",
							eid: data.meta.eid,
							aid: thisaid, 
							
						   },
						   success: function(response) {   
							 
						   } 
					   }); 
					   
					   ready(data);  
				}, 
				 
				
				didUpload: function(data,t, t2) { 
				 	
					jQuery("#"+divid).attr("data-aid", t2.aid);
					
					// SET THIS FILE TYPE TO AUDIO TYPE
					
					<?php if(!isset($_GET['eid']) || ( isset($_GET['eid']) && !is_numeric($_GET['eid']) ) ){ ?>
					jQuery('#SUBMISSION_FORM').append('<input type="hidden" value="'+t2.pid+'" name="eid" id="neweid" />');
					<?php } ?>
					  
					
				},
				 
				
				label: "<i class='fal fa-3x btn-block fa-image-polaroid opacity-5 mb-3'></i> <span class='small font-weight-bold opacity-5'><?php echo __("Select Photo","premiumpress"); ?> " + "</span>",
				buttonConfirmLabel: 'Ok',
				meta: {
					eid:'<?php if(isset($_GET['eid']) && is_numeric($_GET['eid'])){ echo $_GET['eid']; }else{ echo 0; } ?>',
					aid: aid,
					type: "image_video",
				}
 				
				
			});
			tcount++;
			
			// load in image
			if(src != ""){
				cropper.load(src, { blockPush:true }, function(error, data) {
					// image load done!
				});
				 
			}
}


</script>
      <div id="audioimagefile" class="shadow-sm border bg-white"></div>
 
<script>
 
 	
function ajax_video_edit(id, attachmentid){

    jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',		
		data: {
            action: "set_media_title",		  
			pid: id,
			aid: attachmentid,
			title: jQuery('#media-title-'+attachmentid).val(),
			order: jQuery('#media-order-'+attachmentid).val(),
			 
        },
        success: function(response) {
			
			jQuery('#ajax_video_msg').html(response);
			jQuery('#editmediabox').show();
			
        },
        error: function(e) {
            //console.log(e)
        }
    });

}


function ajax_video_delete(id, attachmentid, counter){
	
	
	jQuery('#'+counter+'delbtn').removeClass('fa-trash').addClass('fa-spin fa-spinner');
	
    jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',		
		data: {
            action: "delete_file",		  
			pid: id,
			aid: attachmentid,	
			stopc:1,		 
        },
        success: function(response) {
			
			jQuery('.imgshow' + counter).hide();
			jQuery('.imgshow' + counter).html('');
			
			// UPDATE COUNTER			
			totalM = parseFloat(jQuery('#audiopaceused').html());
			if(totalM == 0){ totalM = 1; }
			totalM = totalM - 1;
			jQuery('#audiopaceused').html(totalM)
			
        },
        error: function(e) {
            console.log(e)
        }
    });

}

</script>
<form method="post" action="<?php echo get_home_url(); ?>/index.php" target="core_delete_video_attachment_iframe" name="core_delete_attachment_audio" id="core_delete_attachment_audio">
  <input type="hidden"  name="core_delete_attachment_audio" value="gogo" />
  <input type="hidden" id="video_attachmentid" name="video_attachmentid" value="" />
</form>
<iframe frameborder="0" style="display:none;" scrolling="auto" name="core_delete_video_attachment_iframe" id="core_delete_video_attachment_iframe"></iframe>
<!-- The template to display files available for upload -->
<script id="video-template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
{% if (file.error) { %}
{% } else { %}
<div class="uploaditem template-upload ">
 
<progress class="progress progress-success progress-striped active w-100 mr-4 mb-4" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" value="0" max="100" style="height:15px !important;"></progress>
 
{% if (!o.options.autoUpload) { %}
<span class="start"><button class="btn btn-system btn-sm "><i class="fa fa-check m-0 px-2"></i></button></span>
{% } %}   
{% if (!i) { %}
<span class="cancel"><button class="btn btn-system btndeleteme"><i class="fa fa-trash m-0 px-2"></i></button></span>
{% } %}        
</div>
<div class="clearfix"></div>	
</div></div>
{% } %}
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="video-template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
{% if (file.error) { %}
<div class="alert alert-danger"  style="display:none;"><b><?php echo __("Error","premiumpress"); ?>:</b> {%=file.error%}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button></div> 
{% } else { %}
<div class="uploaditem pt-3 newfile clearfix  template-download  {%=file.aid%}bb">

<div><a href="{%=file.src%}" target="_blank" class="float-left text-dark small"><i class="fa fa-play mr-2"></i> <?php echo __("Preview Video","premiumpress"); ?></a></div>
              
<button type="button" onclick="ajax_media_delete('{%=file.pid%}','{%=file.aid%}','0');jQuery('.newfile').hide();jQuery('#audioupload .custom-file').show();" class="btn btn-sm rounded-0 p-0 float-right px-2 bg-light text-dark prev btndeleteme" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}" {% if (file.delete_with_credentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}><i class="fa fa-trash m-0 px-2"></i></button></div>
{% } %}
{% } %}
</script>
<script>

function StartSingleVideoUpload(){
  
	jQuery('#video-mediatablelist .start').each(function(i, obj) {		
			jQuery(obj).find('button').trigger('click').hide();					  
	});	


}

jQuery(document).ready(function(){ 


jQuery('#audioupload').fileupload({

		dropZone: null,
		
        url: "<?php echo get_home_url(); ?>/index.php",
		type: 'POST',
		maxNumberOfFiles: 1,
	 
		uploadTemplateId: "video-template-upload",
		downloadTemplateId:  "video-template-download",
		paramName: 'core_attachments',
		//fileTypes: '/^image\/(gif|jpeg|png)$/',
		formData: {  name: 'core_post_id', value: <?php if(isset($_GET['eid']) && is_numeric($_GET['eid'])){ echo esc_attr($_GET['eid']); }else{ echo 0; } ?>   },
	  
	  
	  	change: function (e, data) {
		 
				jQuery('.custom-file').hide();
			setTimeout(function(){ StartSingleVideoUpload(); }, 500 );                
         }, 
	  
	    success: function(response) {
		
			jQuery('#audioupload .custom-file').hide();
	  
		  if(typeof response['error'] == "undefined" ){
								  
				jQuery('#SUBMISSION_FORM').append('<input type="hidden" value="'+response[0]['pid']+'" name="eid" />');					 
					 
			} else {
			
				alert(response['error']);
			
			}
			
        },
        error: function(e) {
            console.log(e)
        }
	 
});	


jQuery('#audioupload').bind('fileuploaddestroy', function (e, data) {
	document.getElementById('video_attachmentid').value= data.url;
	document.core_delete_attachment_audio.submit();	
}); 
	


jQuery('#audiothumbnail').fileupload({

 		dropZone: null,
		
        url: "<?php echo get_home_url(); ?>/index.php",
		type: 'POST', 		
		uploadTemplateId: "video-template-upload",
		downloadTemplateId:  "video-template-download",
		paramName: 'core_videosthumb',
		//fileTypes: '/^image\/(gif|jpeg|jpg|png)$/',
		maxNumberOfFiles: 1,
		formData: {  name: 'core_post_id', value: <?php if(isset($_GET['eid']) && is_numeric($_GET['eid'])){ echo esc_attr($_GET['eid']); }else{ echo 0; } ?>   },
	    
		change: function (e, data) {		
			setTimeout(function(){ StartSingleVideoUpload(); }, 1000 );                
         }, 
		 
		success: function(response) {
	   
		   jQuery('#audiothumbnail .custom-file, .previewaudiothumbnail').hide();
			
        },
        error: function(e) {
            console.log(e)
        }
	 
});	
 


}); 
  
</script>
 

<?php if(is_admin()){ ?>

          
<script>
	
function SaveReloadMevideo(){

	alert("<?php echo __("Please save the current changes first before adding attachments.","premiumpress"); ?>");
	
	jQuery("#mainSaveBtn").trigger('click');
}

jQuery(document).ready(function() {

var my_original_editor = window.send_to_editor;


 	jQuery('#video-selectmediafile').click(function() { 
          
		   tb_show('', 'media-upload.php?type=video&amp;TB_iframe=true');
		   
			window.send_to_editor = function(html) {			

           		var data= [];
                if(html.indexOf('a href')>-1){
                   
				    var htmlcontent = jQuery(html).attr("href");
                    var htmtype = "URL";
                
				}else if(html.indexOf('img')>-1){
				
					var regex 	= /src="(.+?)"/;
					var rslt 	= html.match(regex); 
					var imgrex 	= /wp-image-(.+?)"/;
					var imgid 	= html.match(imgrex);
				 
					var imgurl = rslt[1];
					var imgaid = imgid[1];
					
					var htmlcontent = imgaid+'--'+imgurl;
                    var htmtype = "Image";
               
				}else{
                    var htmlcontent = html;
                    var htmtype = "Name";
                }
				
                data[0] = htmlcontent;
                data[1] = htmtype; 
				 
				jQuery.ajax({
					type: "POST",
					url: ajax_site_url,	
					dataType: 'json', 
					data: {
						'admin_action': "get_media_by_name",
						'data': data,	 
					},
					success: function(response) { 
					  	 	 
						if(response.status == "ok"){ 
						 
								jQuery(this).removeClass('btn-icon').html("<i class='fas fa-spinner fa-spin'></i>");
								
								var imgurl = response.data.URL;
								var imgaid = response.data.ID; 
							 
								jQuery.ajax({
									type: "POST",
									url: ajax_site_url,	
									dataType: 'json',	
									data: {
										'action': "upload_wpmediafile",
										'aid': imgaid,	
										'aurl': imgurl,
										'pid': <?php echo $eid; ?>,	
										'type': 'video',			 
									},
									success: function(response1) {
										
										if(response1.status == "ok"){
										  
										jQuery('#audioupload .custom-file').hide(); 
											  
				jQuery("#video-mediatablelist").append('<div class="uploaditem border-top pt-3 template-download clearfix newwpfilea"><a href="'+ imgurl +'" target="_blank" class="float-left text-dark small"><i class="fa fa-play mr-2"></i> <?php echo __("Preview Video","premiumpress"); ?></a><button class="btn btn-sm rounded-0 p-0 float-right px-2 bg-light text-dark prev" type="button"data-placement="top" data-original-title="<?php echo __("Delete","premiumpress"); ?>" data-toggle="tooltip" onclick="ajax_media_delete(\''+response1.pid+'\', \''+imgaid+'\',0);jQuery(\'#audioupload .custom-file\').show(); jQuery(\'.newwpfilea\').hide();"> <i class="fa fa-trash m-0 prev"></i> </button></div>');
										
										} 
													
									},
									error: function(e) {
									   console.log('error getting search results');
									}
								});	
								
						}	 
						 			
					},
					error: function(e) {
					   console.log('error getting search results');
					}
				}); 
				
				
				tb_remove();
				window.send_to_editor = my_original_editor;
		
		 }
		 
		 return false;
	
	});	
 

}); 
</script>

<?php } ?>
<script src="<?php echo CDN_PATH; ?>js/js.plugins-upload.js"></script>