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
  
	$audiothumbs = $CORE->MEDIA("get_all_videothumbnails", $_GET['eid']);	 
 
}
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


?>

<div class="block-header mt-4">
<h3 class="block-header__title"><?php echo __("Company Logo","premiumpress"); ?></h3>
<div class="block-header__divider"></div> 
</div>
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


<div class="row"><div class="col-md-3"> <div id="audioimagefile" class="shadow-sm border bg-white"></div> </div></div> 