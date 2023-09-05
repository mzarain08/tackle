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

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


if(!user_can($userdata->ID, 'administrator') ){
die("no access");
}

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$post_id = $_POST['pid']; 

$counter = 1; $media = "";
$media = $CORE->MEDIA("get_all_images", $post_id);	 
	 
?>
<div class="p-4">

<h4><?php echo __("WP Media Upload","premiumpress"); ?></h4><hr />

<p><?php echo __("This is an admin upload tool for adding images directly from the WP media library.","premiumpress"); ?></p>

<a href="javascript:void(0);" id="selectmediafile" class="btn btn-system "><?php echo __("Select WP media file","premiumpress"); ?></a>
 
<form <?php if($userdata->ID ){ ?>id="fileupload" action="<?php echo get_home_url(); ?>/index.php" method="POST" enctype="multipart/form-data"<?php } ?> style="max-height:400px; overflow-y: scroll;">
 
    
 
<div class="mt-4" style="margin-left:-15px;">
<div class="row" id="mediatablelist">
<?php  if(isset($post_id) && is_array($media) && !empty($media)){ 
         foreach($media as $img){
		 
         ?>
    <div class="col-md-4">
  
      <input type="hidden" value="<?php echo $img['order']; ?>" data-pid="<?php if( !isset($img['postID']) || ( isset($img['postID']) && $img['postID'] == "") ){ echo $post_id; }else{ echo $img['postID']; } ?>" data-aid="<?php if( !isset($img['postID']) || ( isset($img['postID']) && $img['postID'] == "") ){ echo "9999"; }else{ echo $img['id']; } ?>" class="dorder" id="media-order-<?php echo $img['id']; ?>"  />
      <div class="uploaditem  border-top pt-3 template-upload clearfix ftype_<?php echo substr($img['type'],0,5); ?> imgshow<?php echo $counter; ?>">
        <div class="row">
          <div class="col-md-12 preview">
            <img src="<?php echo $img['thumbnail']; ?>" class="img-fluid" />
          </div>
          <div class="col-md-12 mt-2">
      
            <input type="text" value="<?php echo get_the_title($img['id']); ?>" 
                  id="media-title-<?php echo $img['id']; ?>" class="form-control w-100 rounded-0" onchange="ajax_media_edit(<?php if(isset($post_id)){ echo $post_id; } ?>,'<?php echo $img['id']; ?>')" />
            <div class="mt-1 extra-small text-uppercase text-muted"> <span class="mt-2">
              <?php if(isset($img['size'])){ echo $CORE->_format_bytes($img['size']); } ?>
              / <?php echo $CORE->_format_type($img['type']); ?>
              <?php if(isset($img['dimentions']) && strlen($img['dimentions']) > 1){ echo "/ ".$img['dimentions']; } ?>
              </span> 
              
              </div>
            <button class="btn btn-sm btn-system btn-md mt-4 btn-block"  type="button" onclick="ajax_media_delete('<?php if( !isset($img['postID']) || ( isset($img['postID']) && $img['postID'] == "") ){ echo $post_id; }else{ echo $img['postID']; } ?>','<?php if( !isset($img['postID']) || ( isset($img['postID']) && $img['postID'] == "") ){ echo "9999"; }else{ echo $img['id']; } ?>','<?php echo $counter; ?>');PreCheckuploadSpace();"> <i class="fa fa-trash m-0 mr-2" id="<?php echo $counter; ?>delbtn"></i> <?php echo __("Delete","premiumpress"); ?> </button> 
       
          </div>
    
        </div>
      </div>
 
    </div>
    <?php $counter++; } } ?>
  </div></div>  
  
</form>

<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


?>
      
 
<form method="post" action="<?php echo get_home_url(); ?>/index.php" target="core_delete_attachment_iframe" name="core_delete_attachment" id="core_delete_attachment">
  <input type="hidden"  name="core_delete_attachment" value="gogo" />
  <input type="hidden" id="attachement_id" name="attachement_id" value="" />
</form>
<iframe frameborder="0" style="display:none;" scrolling="auto" name="core_delete_attachment_iframe" id="core_delete_attachment_iframe"></iframe>

<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


?>
   

<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
{% if (file.error) { %}
<div class="alert alert-danger">{%=file.error%}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button></div> 
{% } else { %}
<div class="uploaditem template-upload notuploaded">
<div class="row">
    <div class="col-lg-3 col-md-6 preview">
        <span class=""></span>
    </div>
    <div class="col-md-6 col-lg-9">  
	<span class="fname">{%=file.name%}</span>  
<progress class="progress progress-success progress-striped active w-100 mr-4 mb-4" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" value="0" max="100" style="height:15px !important;"></progress>
 
{% if (!o.options.autoUpload) { %}
<span class="start"><button class="btn btn-system btn-md shadow-sm btn-sm "><i class="fa fa-check m-0 px-2"></i></button></span>
{% } %}   
{% if (!i) { %}
<span class="cancel"><button class="btn btn-system btn-md shadow-sm btn-sm btndeleteme" onclick="PreCheckuploadSpace();"><i class="fa fa-trash m-0 px-2"></i></button></span>
{% } %}        
</div>
<div class="clearfix"></div>	
</div></div>
{% } %}
{% } %}
</script>


<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
{% if (file.error) { %}
<div class="alert alert-danger"  style="display:none;"><b><?php echo __("Error","premiumpress"); ?>:</b> {%=file.error%}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button></div> 
{% } else { %}
<div class="uploaditem border-top pt-3  template-download  {%=file.aid%}bb" data-aid="{%=file.aid%}">
<div class="row">
<div class="col-md-3 preview">
<a href="{%=file.url%}" title="{%=file.name%}" rel="gallery" download="{%=file.name%}"><img src="{%=file.thumbnail_url%}" class='img-fluid'></a>
</div>
<div class="col-md-7">
<div class="mb-1 text-muted small"><?php echo __("Display Caption","premiumpress"); ?></div>
<input type="text" value="{%=file.name%}" id="media-title-{%=file.aid%}" onchange="ajax_media_edit('<?php if(isset($post_id)){ echo $post_id; } ?>', '{%=file.aid%}');" class="form-input col-md-12" />
</div>
    <div class="col-md-1 text-center">     
    <div class=" bits delete mt-4">	 
	<button class="btn btn-sm rounded-0 p-0  bg-light text-dark btndeleteme " onclick="PreCheckuploadSpace();" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}"{% if (file.delete_with_credentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
	<i class="fa fa-trash m-0 px-2"></i>            
	</button>
	</div>	
</div>
</div></div>
{% } %}
{% } %}
</script>


<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


?>
   
   
<script>
 
jQuery(document).ready(function(){ 

 

var my_original_editor = window.send_to_editor;


 	jQuery('#selectmediafile').click(function() {           
           
		   tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
		   
			window.send_to_editor = function(html) {	
			
			console.log(html);
			 		
				var regex = /src="(.+?)"/;
				var rslt =html.match(regex);
				 
				var imgrex = /wp-image-(.+?)"/;
				var imgid = html.match(imgrex);
			 
				var imgurl = rslt[1];
				var imgaid = imgid[1];
				
				
				jQuery(this).removeClass('btn-icon').html("<i class='fas fa-spinner fa-spin'></i>");
		
				jQuery.ajax({
					type: "POST",
					url: ajax_site_url,	
					dataType: 'json',	
					data: {
						'action': "upload_wpmediafile",
						'aid': imgaid,	
						'aurl': imgurl,
						'pid': <?php if(isset($post_id)){ echo $post_id; }else{ echo 0;} ?>,				 
					},
					success: function(response) {
						 
						if(response.status == "ok"){
							  
jQuery("#mediatablelist").append('<div class="uploaditem border-top pt-3 template-download <?php if(isset($post_id)){ echo $post_id; }else{ echo 0;} ?>bb in"><div class="row"><div class="col-md-3 preview"><a href="'+imgurl+'" title="0.jpg" rel="gallery" download="0.jpg"><img src="'+imgurl+'" class="img-fluid"></a></div><div class="col-md-7"><div class="mb-1 text-muted small">Display Caption</div><input type="text" value="0.jpg" id="media-title-566" onchange="ajax_media_edit(\''+imgaid+'\', \''+imgaid+'\');" class="form-input col-md-12"></div><div class="col-md-1 text-center"><div class=" bits delete mt-4"><button class="btn btn-sm rounded-0 p-0  bg-light text-dark btndeleteme " onclick="PreCheckuploadSpace();" data-type="DELETE" data-url="'+imgaid+'---<?php if(isset($post_id)){ echo $post_id; }else{ echo ""; } ?>">	<i class="fa fa-trash m-0 px-2"></i></button>	</div>	</div></div></div>');
						
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
               		
 
 	// MAKE SORTABLE
 
	setTimeout(function(){
	jQuery( "#mediatablelist" ).sortable({
	
		stop: function( ) {
            //var order = $("#sortable").sortable("serialize", {key:'order[]'});
            //$( "p" ).html( order );
			setorder(1);
			//setorder();
        } 
	});
	}, 1500);  
 
	
	// SET DEFAULT ORDER
 	setorder(0);
 
    jQuery('#fileupload').fileupload({
		 
        url: '<?php echo get_home_url(); ?>/index.php',
		type: 'POST',
		paramName: 'core_attachments',
		//fileTypes: '/^image\/(gif|jpeg|png)$/',
		formData: {  name: 'core_post_id', value: <?php if(isset($post_id)){ echo $post_id; }else{ echo 0; } ?>   },		
	 
		change: function (e, data) {		
			setTimeout(function(){ StartAutoUpload(); }, 500 );                
         }, 
		 
	    success: function(response) {
	  
		  if(typeof response['error'] == "undefined" ){
			   
					<?php if(!isset($post_id)){ ?>
					jQuery('#SUBMISSION_FORM').append('<input type="hidden" value="'+response[0]['pid']+'" name="eid" />');
					<?php } ?>
					
					// UPDATE COUNTER			
					totalM = parseFloat(jQuery('#mediaspaceused').html());
					if(totalM < 0){ totalM = 0; }
					totalM = totalM + 1;
					jQuery('#mediaspaceused').html(totalM);
			
			} else {
			
			alert(response['error']);
			
			}
				
			},
			error: function(e) {
				console.log(e)
			}
		 
	});	
 
	
	// CHECK UPLOAD SPACE
	 setTimeout(function(){ CheckuploadSpace(); }, 2000 );
 
	jQuery('#fileupload').bind('fileuploadadd', function (e, data) {	
	
	 // CHECK WE HAVE ENOUGH SPACE LEFT
	 setTimeout(function(){ CheckuploadSpace(); }, 1000 );
	
	});

	
	jQuery('#fileupload').bind('fileuploaddestroy', function (e, data) {	 
	 
		document.getElementById('attachement_id').value= data.url;
		document.core_delete_attachment.submit();	
	}); 
	
	
 });
  
function StartAutoUpload(){ 

	CheckuploadSpace();
		
	jQuery('#mediatablelist .start').each(function(i, obj) {		
			jQuery(obj).find('button').trigger('click').hide();					  
	});	 
}

function PreCheckuploadSpace(){ 
		 
} 

function CheckuploadSpace(){ 
		 
}
 

</script> 
<script src="<?php echo home_url(); ?>/wp-includes/js/jquery/ui/sortable.js" id="jquery-ui-sortable-js"></script>
<script src="<?php echo home_url(); ?>/wp-includes/js/jquery/ui/droppable.js" id="jquery-ui-droppable-js"></script>