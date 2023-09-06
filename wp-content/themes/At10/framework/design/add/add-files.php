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


$ThisKey = "";
if(isset($GLOBALS['file_key'])){
$ThisKey =  $GLOBALS['file_key'];
}
 
$isReload = 0;
if(isset($GLOBALS['reload_'.$ThisKey])){
$isReload = 1;
}

$uniqueKey = $ThisKey.rand(0,999999);

$eid = 0;
if(isset($_GET['eid'])){ $eid = $_GET['eid']; }
 

$media = array();

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

switch($ThisKey){
	
	case "video": {
	
		$text_add = __("Add New Video","premiumpress");
	 	$text_live = __("Live Videos","premiumpress");
	 	$text_types = __("Videos are set private until you go live. We support .flv and .mp4 videos only.","premiumpress");
		 
		$title = __("My Videos","premiumpress");
		$desc =  "";
		$icon = "fa-file-video";
		
		
		$formats = "flv|mp4";
		
		// GET FILES
		if(is_numeric($eid) && $eid > 0){
		$media = $CORE->MEDIA("get_all_videos", $eid);	
		}
		
		$ajax_spaceleft = "ajax_get_video_space_used";
		$ajax_slim_type = "image_video";
		
		$wp_type_name = "video";

		
	} break;
	case "audio": {
		
		$text_add = __("Add Music File","premiumpress");
	 	$text_live = __("Live Files","premiumpress");
	 	$text_types = __("Music files are set private until you go live. We support .mp3 and .mpeg files only.","premiumpress");
		
		
		$title = __("My Audio Files","premiumpress");
		$desc =  __("Add your own audio or music tracks to grab visitor attention.","premiumpress");
		$icon = "fa-file-audio";
		
		$formats = "mp3|mpeg";
		

		// GET FILES
		if(is_numeric($eid) && $eid > 0){
		$media = $CORE->MEDIA("get_all_music", $eid);	
		}
		
		$ajax_spaceleft = "ajax_get_music_space_used";
		$ajax_slim_type = "image_music";
		
		$wp_type_name = "audio";
		
	} break;
	case "photo": {
		
		$text_add = __("Add New Photo","premiumpress");
		$text_live = __("Live Photos","premiumpress");
	 	$text_types = __("Photos are set private until you go live. We support .jpg, .jpeg and .png images only.","premiumpress");
		
		
		$title = __("My Photos","premiumpress");
		$desc =  __("Show off your best photos and get more visitors.","premiumpress");	
		$icon = "fa-image-polaroid";
		
		$formats = "jpg|jpeg|png|svg";
		
		// GET FILES
		if(is_numeric($eid) && $eid > 0){
		$media = $CORE->MEDIA("get_all_images", $eid);	
		}
		
		$ajax_spaceleft = "ajax_get_image_space_used";
		$ajax_slim_type = "image";
		
		$wp_type_name = "image";
	
	} break; 


}
 

if($eid == 0 && empty($media) && $ThisKey == "photo" ){ // && $userdata->ID

	if (isset($_SERVER['HTTP_CLIENT_IP'])) {
					$real_ip_adress = $_SERVER['HTTP_CLIENT_IP'];
	}						
	if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
					$real_ip_adress = $_SERVER['HTTP_X_FORWARDED_FOR'];
	}else{
					$real_ip_adress = $_SERVER['REMOTE_ADDR'];
	}			
 		
	$SQL = "SELECT ID FROM ".$wpdb->prefix."posts WHERE post_title = ('temp post - ".$real_ip_adress."') LIMIT 1";	
	$hasid = $wpdb->get_results($SQL, OBJECT);
	if(!empty($hasid)){
		$_GET['eid'] = $hasid[0]->ID;
		$media = $CORE->MEDIA("get_all_images", $hasid[0]->ID);	 
		unset($_GET['eid']);
	} 

}
 

 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
<div id="<?php echo $uniqueKey; ?>-globalWrapper">
 
<div class="block-header mt-4">
<h3 class="block-header__title"><?php echo $title; ?> <span class="position-absolute bg-white px-3" style="right:10px;" id="<?php echo $uniqueKey; ?>-countbox"><span class="_left"></span><span class="opacity-5 text-500">/</span> <span class="_total"></span></span></h3>
<div class="block-header__divider"></div> 
</div>

<?php
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
?>
 <style>
 .custom-file-label::after { 
    background-color: #343a40 !important;
    color: #fff !important;
	}
 </style>




<form id="<?php echo $uniqueKey; ?>-fileupload" action="<?php echo get_home_url(); ?>/index.php" method="POST" enctype="multipart/form-data">

 

<div class="row" >

<?php if(empty($media) && !isset($_POST['ajaxedit']) ){ ?>
    <div class="col-6 col-md-4 col-lg-3 <?php echo $uniqueKey; ?>new" id="addnew-<?php echo $ThisKey; ?>">
    
        <div class="cardbox closed mb-0" <?php if(!$userdata->ID && $ThisKey != "photo"){ ?>onclick="noUserAccess();"<?php }else{ ?> onclick="jQuery('#<?php echo $uniqueKey; ?>add, .<?php echo $ThisKey; ?>-extras, #addnew-<?php echo $ThisKey; ?>').toggle();"<?php } ?>>
        
        <i class="fal <?php echo $icon; ?>"></i>
        
        <div class="small"><?php echo __("add new","premiumpress"); ?></div>
        
    	</div> 
    
    </div>
<?php } ?>

    <div class="col" <?php if(!isset($_POST['ajaxedit']) ){ ?>style="display:none;" id="<?php echo $uniqueKey; ?>add"<?php } ?>> 
    
    <i class="fa fa-times float-right p-3" style="cursor:pointer;" onclick="jQuery('#<?php echo $uniqueKey; ?>add, .<?php echo $ThisKey; ?>-extras, #addnew-<?php echo $ThisKey; ?>').toggle();"></i>
    
        <div class="py-4 p-4 bg-light" id="dropzone<?php echo $uniqueKey; ?>">        
        	
            <div class="d-flex">
            <i class="fa fa-3x hide-mobile text-dark <?php echo $icon; ?>"></i>
            
            <div class="ml-md-5">
           
            
                <div class="custom-file">
            <input type="file" name="files[]" id="<?php echo $uniqueKey; ?>_upload_field" class="custom-file-input" multiple="">
            <label class="custom-file-label"><span class="hide-mobile"><?php echo $text_add; ?></span></label>
          </div>
            
            
            <div class="small mt-3 text-dark"><?php echo $text_types; ?></div>
        	
            </div>
            
            </div>
        
        </div>
        
      <div class="<?php echo $uniqueKey; ?>-fileupload-loading"></div>
      <div class="<?php echo $uniqueKey; ?>-fileupload-buttonbar"></div>

</div>
 
 
<?php 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?> 

 <div class="col-md-12">
    
  <div id="<?php echo $uniqueKey; ?>-mediatablelist" class="files mt-4 row">
  
   
  
<?php if(!empty($media) && !isset($_POST['ajaxedit']) ){ ?>
    <div class="col-6 col-md-4 col-lg-3 <?php echo $uniqueKey; ?>new" id="addnew-<?php echo $ThisKey; ?>">
    
        <div class="cardbox closed" onclick="jQuery('#<?php echo $uniqueKey; ?>add, .<?php echo $ThisKey; ?>-extras, #addnew-<?php echo $ThisKey; ?>').toggle();">
        
        <i class="fal <?php echo $icon; ?>"></i>
        
        <div class="small"><?php echo __("add new","premiumpress"); ?></div>
        
    	</div> 
    
    </div>
<?php } ?>
   
  
  
        <?php $forcePublishLive = array(); if(!empty($media)){  foreach($media as $img){
		 
		
		// FILE ID
		if(!isset($img['id']) || isset($img['id']) && !is_numeric($img['id']) ){
		continue;
		} 
		 
		
		// THUMBANIL DISPLAY 
		$array = explode('.', $img['thumbnail']);
		$extension = end($array);	
		if(substr($img['thumbnail'],0,4) != "http" || !in_array($extension, array("jpg","jpeg","png","gif"))) {	
			if(strlen(_ppt('fallback_image_video')) > 5 ){
				$img['thumbnail'] = _ppt('fallback_image_video');					
			}else{				
				$img['thumbnail'] = CDN_PATH."images/novideo.jpg";					
			}
		}
		   
		
		// THUMBNAIL FOR SLIM EDITING
		if($ThisKey == "photo"){
			$img['thumbnail_aid'] = $img['id'];
			$source_file = $img['src'];
		}else{
		
			if(!isset($img['thumbnail_aid'])){ $img['thumbnail_aid'] = 0; }	 
			$source_file = $img['thumbnail'];
		}
		
		
		// ONCLICK EVENT
		if($ThisKey == "photo"){		
		$onclick = "href='".$img['src']."' data-toggle='lightbox' data-gallery='gallery4' data-type='image'";		
		}else{		
		$onclick = 'href="javascript:void(0);" onclick="processVideoOpen(\''.$eid.'\', \''.$img['id'].'\');"';		
		}
		
		// SET OLD LISTINGS TO LIVE
		if(!isset($img['published'])){
		$img['published'] = 1;
		$forcePublishLive[$img['id']] = array("id" => $img['id']);
		}
		
		 // ORDER
		$order = 99;
		if(isset($img['order']) && is_numeric($img['order'])){
		$order = $img['order'];
		}
		
		
		
		?>        
 
          <input type="hidden" value="<?php echo $order; ?>" data-pid="<?php echo $eid; ?>" data-aid="" class="dorder" id="media-order-<?php echo $img['id']; ?>"  />
 
  <div class="col-6 col-md-4 vidbox-<?php echo $ThisKey; ?> vidbox vidbox-<?php echo $img['id']; ?>" data-published="<?php echo $img['published']; ?>" data-divid="vidbox-<?php echo $img['id']; ?>-img" data-src="<?php echo $source_file; ?>" data-aid="<?php echo $img['thumbnail_aid']; ?>" data-vid="<?php echo $img['id']; ?>">
    <div class="bg-light p-1 rounded border mb-4 shadow-sm">
      <div class="single-video">
      
      
        <div class="loadvideoimage" id="vidbox-<?php echo $img['id']; ?>-img"></div>
        
        <figure>
        
        <a <?php echo $onclick; ?>>
        
        <div style="height:120px;" class="position-relative">
        <div class="bg-image" data-bg="<?php echo $img['thumbnail']; ?>"></div>
        
        </div>
         
        
        <?php if($ThisKey == "video"){ ?>
        <i class="fa fa-play-circle"></i>
        <?php } ?>
        
        </a>
        
        </figure>
        
      </div>

 <div class="row no-gutters my-1 ">   

<div class="col-12 d-inline-flex">
 <div class="col-4xx w-100"> 
    <div class="badge_tooltip" data-direction="top">
    <div class="badge_tooltip__initiator"><a href="javascript:void(0);" data-vid="<?php echo $img['id']; ?>" class="processChange<?php echo $uniqueKey; ?> btn btn-system btn-sm btn-block"><i class="fa fa-pencil"></i></a>  </div>
    <div class="badge_tooltip__item text-center"><?php if($ThisKey == "photo"){ echo __("Edit Photo","premiumpress"); }else{ echo __("Edit Thumbnail","premiumpress"); } ?> </div>
  	</div>
  
</div>
<?php if($eid != 0){ ?>
<div class="col-4xx w-100">
    <div class="badge_tooltip" data-direction="top">
    <div class="badge_tooltip__initiator"><a href="javascript:void(0);" data-id="<?php echo $img['id']; ?>" class="processOrder<?php echo $uniqueKey; ?> btn btn-system btn-sm btn-block m-0"><i class="fa fa-sync"></i></a></div>
    <div class="badge_tooltip__item text-center"><?php echo __("Change Order","premiumpress"); ?></div>
  	</div>
</div>
<?php } ?>

<div class="col-4xx w-100">
    <div class="badge_tooltip" data-direction="top">
    <div class="badge_tooltip__initiator"><a href="javascript:void(0);" data-id="<?php echo $img['id']; ?>" class="processDelete<?php echo $uniqueKey; ?> btn btn-system btn-sm btn-block m-0"><i class="fa fa-times"></i></a></div>
    <div class="badge_tooltip__item text-center"><?php echo __("Delete","premiumpress"); ?></div>
  	</div>
</div>

</div>
<div class="col-12 processOrder<?php echo $uniqueKey; ?>_show" style="display:none;">
 
<select onchange="_image<?php echo $uniqueKey; ?>sort('<?php echo $img['id']; ?>',this.value);" class="w-100 mt-1">

<option value="100"></option>

<?php $o=1;while($o < count($media)+1){ ?>
<option value="<?php echo $o; ?>" <?php if($order != "100" && $order == $o){ echo "selected=selected"; } ?>><?php echo $o; ?> <?php if($o == 1){ ?>- <?php echo __("Featured","premiumpress"); ?><?php } ?></option>
<?php $o++; } ?>

</select>

</div>

<div class="col-12 mt-2">
 
 
 <?php if(isset($img['published']) && $img['published'] == "1"){ ?>
<a href="javascript:void(0);" data-id="<?php echo $img['id']; ?>" class="processPublish<?php echo $uniqueKey; ?> pub-<?php echo $img['id']; ?> btn btn-success btn-block small  border-0"><?php echo __("Live","premiumpress"); ?></a>
 
 <?php }else{ ?>
<a href="javascript:void(0);" data-id="<?php echo $img['id']; ?>" class="processPublish<?php echo $uniqueKey; ?> pub-<?php echo $img['id']; ?> btn btn-dark btn-block small  border-0"><?php echo __("Go Live","premiumpress"); ?></a>
 
 <?php } ?> 

</div>
</div>        
      
      
  
      
    </div>
  </div>
   
        
           
         
        <?php } } ?>
      </div><!-- end media table -->
           
           
           
  <?php 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>          
   
    
    </div> 
</div>

</form>

</div>

<?php 
 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

/*
if($uniqueKey == "photo" && in_array(THEME_KEY, array("da","es"))  ){

?>
 
<hr />
<div class="container mt-4"><div class="row">

<div class="col-md-6">

<h6><?php echo __("Password Protect","premiumpress"); ?></h6>
<p class="opacity-8 small"><?php echo __("Enter a password to protect your images from users who do not know the password.","premiumpress"); ?></p>

</div>
<div class="col-md-6">
<div class="form-group position-relative">
<input type="text" class="form-control" autocomplete="off" name="custom[image_pass]" id="image_pass" value="<?php if(isset($_GET['eid'])){ echo get_post_meta($_GET['eid'], "image_pass", true); } ?>" />
    <i class="fal fa-lock position-absolute" style="<?php if($CORE->GEO("is_right_to_left", array() )){ echo "left:20px;"; }else{ echo "right:20px;";  } ?> top: 15px;"></i>
  </div>
</div>


</div></div> 

<?php }
*/

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


 ?>

<form method="post" action="<?php echo get_home_url(); ?>/index.php" target="core_delete_<?php echo $uniqueKey; ?>_attachment_iframe" name="core_delete_<?php echo $uniqueKey; ?>_attachment" id="core_delete_<?php echo $uniqueKey; ?>_attachment">
      <input type="hidden"  name="core_delete_<?php echo $uniqueKey; ?>_attachment" value="gogo" />
      <input type="hidden" id="attachement_id<?php echo $uniqueKey; ?>" name="attachement_id" value="" />
    </form>
    <iframe frameborder="0" style="display:none;" scrolling="auto" name="core_delete_<?php echo $uniqueKey; ?>_attachment_iframe" id="core_delete_<?php echo $uniqueKey; ?>_attachment_iframe"></iframe>
 
<?php 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
<script id="template-upload-<?php echo $uniqueKey; ?>" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
{% if (file.error) { %}
<div class="alert alert-danger">{%=file.error%}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button></div> 
{% } else { %}
<div class="uploaditem template-upload notuploaded mx-3 w-100"><div class="row"><div class="col-md-9"><span class="fname">{%=file.name%}</span>  
<progress class="progress progress-success progress-striped active w-100 mr-4 mb-4" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" value="0" max="100" style="height:15px !important;"></progress>
</div>
<div class="col-md-3 text-center mt-4"> 
{% if (!o.options.autoUpload) { %}
<span class="start"><button class="btn btn-system btn-md shadow-sm btn-sm "><i class="fa fa-check m-0 px-2"></i></button></span>
{% } %}   
{% if (!i) { %}
<span class="cancel"><button class="btn btn-system btn-md shadow-sm btn-sm btndeleteme"><i class="fa fa-trash m-0 px-2"></i></button></span>
{% } %}        
</div>
<div class="clearfix"></div>	
</div></div>
{% } %}
</div>
{% } %}
</script>
<script id="template-download-<?php echo $uniqueKey; ?>" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
{% if (file.error) { %}
{% } else { %}
{% } %}
{% } %}
</script>

<?php 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
<button style="display:none" class="updatespaceleft" onclick="_spaceLeft<?php echo $uniqueKey; ?>()" /></button>
<script> 


function StartAutoUpload<?php echo $uniqueKey; ?>(){ 
 		
	jQuery('#<?php echo $uniqueKey; ?>-mediatablelist .start').each(function(i, obj) {		
		jQuery(obj).find('button').trigger('click').hide();					  
	});	 
}
 
jQuery(document).ready(function(){  

	 
	// CREATE DROP ZONE	
	   var obj = jQuery("#dropzone<?php echo $uniqueKey; ?>");
        obj.on('dragenter', function (e)
        {
            e.stopPropagation();
            e.preventDefault();
           
        });
        obj.on('dragover', function (e)
        {
            e.stopPropagation();
            e.preventDefault();
        });
        obj.on('drop', function (e)
        { 
            e.stopPropagation();
            e.preventDefault(); 
        });
        obj.on('click', function (e)
        {

           //jQuery('#<?php echo $uniqueKey; ?>_upload_field').trigger('click');
            
        }); 
		
		// SPACE LEFT
		_spaceLeft<?php echo $uniqueKey; ?>(); 


		
	// HANDLE FILE UPLOAD
    jQuery('#<?php echo $uniqueKey; ?>-fileupload').fileupload({
		 
        url: '<?php echo get_home_url(); ?>/index.php',
		type: 'POST',
		paramName: 'core_attachments',
		
		maxNumberOfFiles: 20,
		
		uploadTemplateId: "template-upload-<?php echo $uniqueKey; ?>",
		downloadTemplateId:  "template-download-<?php echo $uniqueKey; ?>",
		
		formData: {  name: 'core_post_id', value: <?php echo $eid; ?>, type: "<?php echo $ThisKey; ?>",    },	
		
		change: function (e, data) {
		
				if (!(/\.(<?php echo $formats; ?>)$/i).test(data.files[0].name)) {
                    alert("<?php echo trim(__("This file format is not supported. Please try a different file.","premiumpress")); ?>");
                    return false;
                }
		
				
			setTimeout(function(){ StartAutoUpload<?php echo $uniqueKey; ?>(); }, 500 );    
			         
         }, 	
	  
	    success: function(response) {
		
		//console.log(response);
	  
		  if(typeof response['error'] == "undefined" ){
			   
					<?php if($eid == 0){ ?>
					jQuery('#SUBMISSION_FORM').append('<input type="hidden" class="form-control neweid" value="'+response[0]['pid']+'" name="eid" />'); 
					<?php } ?> 
					
					jQuery("#error_msg_reload_<?php echo $uniqueKey; ?>").show();
					jQuery("#dropzone<?php echo $uniqueKey; ?>").hide();
					
					
					
						jQuery.ajax({
							type: "POST",
							url: ajax_site_url,		
							data: {
								   action: "load_editlisting_form",		
								   type: "<?php echo $ThisKey; ?>",
								   eid: <?php echo $eid; ?>   
							   },
							   success: function(response) { 
							  		
									<?php //if($eid != 0){ ?>
									 jQuery("#<?php echo $uniqueKey; ?>-globalWrapper").html(response);
									 <?php //} ?>
									 	// avatars
										var a = jQuery(".bg-image");
										a.each(function (a) {
											if (jQuery(this).attr("data-bg")) jQuery(this).css("background-image", "url(" + jQuery(this).data("bg") + ")");
										});
													
							   },
							   error: function(e) {
								   console.log(e)
							   }
						   });
					
					
					
			
			} else {
			
			alert(response['error']);
			
			}
				
			},
			error: function(e) {
				console.log(e)
			}
		 
	});
  
 
	jQuery('#<?php echo $uniqueKey; ?>-fileupload').bind('fileuploadadd', function (e, data) {	
 	
	});

	
	jQuery('#<?php echo $uniqueKey; ?>-fileupload').bind('fileuploaddestroy', function (e, data) {	 
	 
		document.getElementById('attachement_id<?php echo $uniqueKey; ?>').value= data.url;
		document.core_delete_<?php echo $uniqueKey; ?>_attachment.submit();	
	}); 
	
	 
});

 
 

var IsSetEdit = 0; var IsTotalLeft<?php echo $uniqueKey; ?> = 0;
jQuery(document).on("click",".processChange<?php echo $uniqueKey; ?>", function (e) { 	
	
	var vid = jQuery(this).data("vid");	
	var thisBox = jQuery('.vidbox-'+vid);
	
	if(!IsSetEdit){
	IsSetEdit = 1;
	jQuery('.vidbox-'+vid+' figure').hide();	
	_image<?php echo $uniqueKey; ?>(jQuery(thisBox).data("divid"),jQuery(thisBox).data("src"), jQuery(thisBox).data("aid"), jQuery(thisBox).data("vid"));
	
	}else{
	IsSetEdit = 0;
	jQuery("#"+jQuery(thisBox).data("divid")).html('');
	jQuery('.vidbox-'+vid+' figure').show();	
	}
		

});

jQuery(document).on("click",".processOrder<?php echo $uniqueKey; ?>", function (e) { 	
	
jQuery(".processOrder<?php echo $uniqueKey; ?>_show").toggle();

});

jQuery(document).on("click",".processPublish<?php echo $uniqueKey; ?>", function (e) { 
 	
	var thisbo = jQuery(this);
	vid = jQuery(this).data('id');  
	
	// CHECK FIRST
	_spaceLeft<?php echo $uniqueKey; ?>();
	
	if(jQuery('.pub-'+vid).hasClass("btn-dark") && IsTotalLeft<?php echo $uniqueKey; ?> < 1){
	
	alert("<?php echo trim(__("You have reached your limit.","premiumpress")); ?>");
	
	}else{
	
		
		if(jQuery('.pub-'+vid).hasClass("btn-success")){	
			jQuery('.pub-'+vid).addClass("btn-dark").removeClass("btn-success").html("<?php echo trim(__("Go Live","premiumpress")); ?>");  
		}else{
			jQuery('.pub-'+vid).addClass("btn-success").removeClass("btn-dark").html("<?php echo trim(__("Live","premiumpress")); ?>");  
		}
		
		var postid = <?php echo $eid; ?>;
		
		if(postid == 0){
		postid = jQuery(".neweid").val();		
		}
		
		jQuery.ajax({
			type: "POST",
			url: ajax_site_url,	
			 dataType: 'json',			
			data: {
				action: "ajax_media_publish",		  
				pid: postid,
				vid: vid,
				type: "<?php echo $ThisKey; ?>",
			},
			success: function(response) {
			
				_spaceLeft<?php echo $uniqueKey; ?>();
				
			},
			error: function(e) {
				console.log(e)
			}
		}); 
	
	}

});

<?php if(is_array($forcePublishLive) && !empty($forcePublishLive)){ ?>
jQuery(document).ready(function() {
<?php foreach($forcePublishLive as $force){ ?>
ForcePublish<?php echo $uniqueKey; ?>(<?php echo $force['id']; ?>);
<?php } ?>

});
function ForcePublish<?php echo $uniqueKey; ?>(vid){

		jQuery.ajax({
			type: "POST",
			url: ajax_site_url,	
			 dataType: 'json',			
			data: {
				action: "ajax_media_publish",		  
				pid: <?php echo $eid; ?>,
				vid: vid,
				type: "<?php echo $ThisKey; ?>",
			},
			success: function(response) {
			
				//_spaceLeft<?php echo $uniqueKey; ?>();
				//console.log(response+"set live "+vid);
				
			},
			error: function(e) {
				console.log(e)
			}
		}); 
}
<?php } ?>


function _spaceLeft<?php echo $uniqueKey; ?>(){
 

	var eid = "<?php echo $eid; ?>";
	if(jQuery("#neweid").length > 0){
		eid = jQuery("#neweid").val();
	}
	
	pakID = "";
	if(jQuery("#packageID").val() != ""){
	pakID = jQuery("#packageID").val();
	}
	//console.log(pakID+'<--');
	 
   jQuery.ajax({
           type: "POST",
           url: '<?php echo home_url(); ?>/',
		   dataType: 'json',		
   		data: {
            action: "<?php echo $ajax_spaceleft; ?>",
			pid: eid,	
			packageid: pakID,
           },
           success: function(response) {
		   
		   		if(eid == "0"){
				
				var total = jQuery(".vidbox-<?php echo $ThisKey; ?>").length;
				
				//jQuery('#<?php echo $uniqueKey; ?>-countbox ._total').html(response.total);
				jQuery('#<?php echo $uniqueKey; ?>-countbox ._left').html(total);
				jQuery('#<?php echo $uniqueKey; ?>-countbox ._total').html(response.left); 
				IsTotalLeft<?php echo $uniqueKey; ?> = response.left - response.published;	
				
				
				}else{
				
				//jQuery('#<?php echo $uniqueKey; ?>-countbox ._total').html(response.total);
				jQuery('#<?php echo $uniqueKey; ?>-countbox ._left').html(response.published);
				jQuery('#<?php echo $uniqueKey; ?>-countbox ._total').html(response.left); 
				IsTotalLeft<?php echo $uniqueKey; ?> = response.left - response.published;	
				
				}
				 
				if(IsTotalLeft<?php echo $uniqueKey; ?> < 1){ 
					
					jQuery('#dropzone<?php echo $uniqueKey; ?>').remove();
					jQuery('#<?php echo $uniqueKey; ?>add').remove();
					jQuery('.<?php echo $uniqueKey; ?>new').remove();
				}
				
				
			  
				 
           },
           error: function(e) {
		   
		   return 0;
              
           }
       });  
 
}

jQuery(document).on("click",".processDelete<?php echo $uniqueKey; ?>", function (e) {  
	
	vid = jQuery(this).data('id');
	
	if(confirm("<?php echo trim(__("Are you sure?","premiumpress")); ?>")) {
		
			 
		var total = jQuery("#<?php echo $uniqueKey; ?>-countbox ._left").text();			 
		jQuery('#<?php echo $uniqueKey; ?>-countbox ._left').html(parseFloat(total)-1);
			 
			 
		jQuery.ajax({
			type: "POST",
			url: ajax_site_url,			
			data: {
				action: "delete_file",		  
				pid: <?php if(isset($_GET['eid'])){ echo $_GET['eid']; }else{ echo 0; } ?>,
				aid: vid,	
				stopc:1,		 
			},
			success: function(response) { 
				 
				 jQuery(".vidbox-"+vid).html('').removeClass('vidbox');
				 
				 //_spaceVideoLeft();
				
			},
			error: function(e) {
				console.log(e)
			}
		}); 
		
	}

});

function _image<?php echo $uniqueKey; ?>sort(aid, oid){
	  
		if(aid != ""){
				
				jQuery.ajax({
					type: "POST",
					url: ajax_site_url,			
					data: {
						action: "set_media_order",		  
						pid: <?php echo $eid; ?>,
						aid: aid,
						order: oid,
						 
					},
					success: function(response) {
					
				 
					jQuery.ajax({
							type: "POST",
							url: ajax_site_url,		
							data: {
								   action: "load_editlisting_form",		
								   type: "<?php echo $ThisKey; ?>",
								   eid: <?php echo $eid; ?>   
							   },
							   success: function(response) { 
							  
									 jQuery("#<?php echo $uniqueKey; ?>-globalWrapper").html(response);
									 
									 	// avatars
										var a = jQuery(".bg-image");
										a.each(function (a) {
											if (jQuery(this).attr("data-bg")) jQuery(this).css("background-image", "url(" + jQuery(this).data("bg") + ")");
										});
													
							   },
							   error: function(e) {
								   console.log(e)
							   }
						   });
					 
						
					},
					error: function(e) {
						//console.log("error settings order "+e); 
					}
	}); 
	}
}

function _image<?php echo $uniqueKey; ?>(divid, src, aid, vid){ 
  
 
	// Create Image
	if(jQuery('#'+divid).length > 0){
	var cropper = new Slim(document.getElementById(divid), {
				   
				service: '<?php echo home_url(); ?>/index.php',
				download: false,
				remove: false,
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
				
				label: "<i class='fal fa-3x btn-block fa-video opacity-5 mb-3'></i> <span class='small font-weight-bold opacity-5'><?php echo __("Video Cover Image","premiumpress"); ?></span>",
				buttonConfirmLabel: 'Ok',
				meta: {
					eid:'<?php if(isset($_GET['eid']) && is_numeric($_GET['eid'])){ echo $_GET['eid']; }else{ echo 0; } ?>',
					aid: aid,
					type: "<?php echo $ajax_slim_type; ?>",
					vid: vid,
				}
				 
				
			});
			
			// load in image
			if(src != "" && aid != "0"){
				cropper.load(src, { blockPush:true }, function(error, data) {
					// image load done!
				});
				 
			}
			
			jQuery('.slim-btn-remove').hide();
		}

}

</script>

<?php 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if(is_admin()){ ?>

<a href="javascript:void(0)" class="<?php echo $uniqueKey; ?>-selectmediafile btn btn-system shadow-sm font-weight-bold"><i class="fab fa-wordpress mr-2"></i> <?php echo __("Use Media File","premiumpress"); ?></a>
 
 
<script>  
jQuery(document).ready(function() {

	var my_original_editor<?php echo $uniqueKey; ?> = window.send_to_editor; 

 	jQuery('.<?php echo $uniqueKey; ?>-selectmediafile').click(function() { 
          
		   tb_show('', 'media-upload.php?type=<?php echo $wp_type_name; ?>&amp;TB_iframe=true');
		   
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
										'type': '<?php echo $ThisKey; ?>',			 
									},
									success: function(response1) {
										
										if(response1.status == "ok"){ 
											  
												jQuery("#<?php echo $uniqueKey; ?>-fileadded").show();
										
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
				window.send_to_editor = my_original_editor<?php echo $uniqueKey; ?>;
		
		 }
		 
		 return false;
	
	});	
 

}); 
</script>
 
<div id="<?php echo $uniqueKey; ?>-fileadded" style="display:none;">
<div class="p-3 bg-light mt-4 text-600">
<a href="javascript:void(0);" onclick="jQuery('#mainSaveBtn').trigger('click');" class="float-right btn btn-system"><?php echo trim(__("Update","premiumpress")); ?></a>
<i class="fa fa-check text-success mr-2"></i> <?php echo trim(__("File added - save changes to update media list.","premiumpress")); ?>
</div>
</div>
<?php } ?>

<?php if(isset($_POST['ajaxedit'])){ ?>

 
<script>

jQuery(document).ready(function(){ 
// avatars
										var a = jQuery(".bg-image");
										a.each(function (a) {
											if (jQuery(this).attr("data-bg")) jQuery(this).css("background-image", "url(" + jQuery(this).data("bg") + ")");
										});
});

</script>
 
<?php } ?>