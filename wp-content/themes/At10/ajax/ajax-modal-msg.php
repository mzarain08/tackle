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
 
global $CORE, $userdata, $CORE_UI;
	
$randomnum = rand(0,100000);
	 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$canShow = true;
if($CORE->USER("membership_featured_enabled", "max_msg")){ 
 	 
	 
	// CHECK USER CREDIT
	if($CORE->USER("get_user_free_membership_addon", array("max_msg", $userdata->ID)) > 0){
			
	}else{			
	$canShow = false;
	}
	
	if(!$CORE->USER("membership_featured_enabled", "msg_send") && !$CORE->USER("membership_featured_enabled", "max_msg")){
	  		
		 $canShow = false;	
		
	 }
	  
}
 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$photo1			= $CORE->USER("get_avatar",$userdata->ID);
$photo2 		= "";

if(isset($_POST['uid'])){
$photo2 		= $CORE->USER("get_avatar",$_POST['uid']);
}
$link1 			= "#";
$link2 			= "#"; 
 
if(_ppt(array('user','allow_profile')) == 1 ){
$link1 			= $CORE->USER("get_user_profile_link", $userdata->ID);
$link2 			= $CORE->USER("get_user_profile_link", $_POST['uid']);
}    
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>

<div ppt-box class="rounded messenger">

<div class="_header d-flex">


    <div class="_icon">
        <div ppt-icon-24 data-ppt-icon-size="24">
            <?php echo $CORE_UI->icons_svg['chat']; ?>
          </div>
    </div>
    <div class="_title w-100">


 <?php echo __("Messenger","premiumpress"); ?> 
 


    </div>  
 
    <?php /*if( !in_array(THEME_KEY, array("dt","sp","cm","cp","vt","jb","rt","so","cp","ph","es"))  && _ppt(array('user','friends')) == 1 && isset($_POST['uid']) && is_numeric($_POST['uid']) ){ ?>
      
    <div class="_close">
        <?php echo do_shortcode('[SUBSCRIBE class="" icon=1 count=0 text=1 uid="'.$_POST['uid'].'"]'); ?>
    </div>  
   <?php } */ ?> 
   
   <div class="_close">
    
    
    <div class="mt-2 mb-n4"><?php echo $CORE_UI->AVATAR("user", array("size" => "sm", "uid" => $userdata->ID, "css" => "rounded", "online" => 0)); ?></div> 
        
    </div> 
   
   <div class="_close">
    
    
    <div class="mt-2 mb-n4"><?php if(isset($_POST['uid'])){ echo $CORE_UI->AVATAR("user", array("size" => "sm", "uid" => $_POST['uid'], "css" => "rounded", "online" => 0)); } ?></div> 
        
    </div>  
    
    
    <div class="_close btn-close">
        <div ppt-icon-24 data-ppt-icon-size="24">
            <?php echo $CORE_UI->icons_svg['close']; ?>
          </div>
    </div>
    
</div> 

<?php

if(!$canShow){ ?>

<div style="min-height:300px;" class="bg-white y-middle">
  <div class="p-4 text-center">
    <h4><i class="fal fa-lock mr-2"></i> <?php echo __("No Access","premiumpress"); ?></h4>
    <div class="mt-4 small"><?php echo __("Please upgrade your membership to access this feature.","premiumpress"); ?></div>
    <a href="<?php echo _ppt(array('links','myaccount')); ?>?showtab=membership" class="btn btn-system btn-md mt-4"><?php echo __("View My Membership","premiumpress"); ?></a> </div>
</div>

<?php
	
	}elseif(isset($_POST['uid']) && is_numeric($_POST['uid']) && $userdata->ID ) {
	
	$settings = array();
	$settings['job_seller_id'] = $userdata->ID;
	$settings['job_buyer_id'] = $_POST['uid'];
	$settings['pid']=1;
	
	$chat_div_id = "#chatbetween_".$settings['job_seller_id']."_".$settings['job_buyer_id'];



?>
 

<div class="_content my-3"> 
   
  <div class="ppt-scroll ppt-messenger-window" data-target="#<?php echo str_replace("#","",$chat_div_id); ?>" id="<?php echo str_replace("#","",$chat_div_id); ?>"></div>   
  
  <div class="smilesbox" style="display:none;min-height: 300px;">
    <div class="row">
      <?php $smiles = $CORE->USER("smiles",0); $si=0; foreach($smiles as $smile){ ?>
      <div class="col-2"> <a href="javascript:void(0);" onclick="addSmile(<?php echo $si; ?>)"><i class='ppt-smile-icon icon-size-chatwindow icon-<?php echo $smile; ?>'></i></a> </div>
      <?php $si++; } ?>
    </div>
  </div>
  
  
  <div class="note row mb-3" style="display:none;">
  <div class="col-4">
    <?php echo do_shortcode('[BUTTON_USER type="subscribe" class="btn-success btn-block list" text=1 uid="'.$_POST['uid'].'"]'); ?> 
  
  </div>
  <div class="col-4">
    <?php echo do_shortcode('[BUTTON_USER type="block" class="btn-success btn-block list" text=1 uid="'.$_POST['uid'].'"]'); ?>
  
  </div>
  <div class="col-4">
    <a href="<?php echo _ppt(array('links','contact')); ?>/?report=<?php echo $_POST['uid']; ?>" class="btn-danger btn-block list" data-ppt-btn>       
        <span><?php echo __("Report","premiumpress") ?></span>        
        </a>
  </div>
 
  </div>
   
    
<?php
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
?>  

<div class="clearfix"></div>
<div class="position-relative">
<input type="text" class="form-control chattextbox border shadow-sm" style="height:50px; padding-right:60px;" id="ppt_chat_send_<?php echo $settings['pid']; ?>_chat_msg">

 
  <div ppt-icon-24 data-ppt-icon-size="24" style="position:absolute; right:102px; top:12px;" class="cursor opacity-5" onclick="jQuery('.note').toggle();" >
                <?php echo $CORE_UI->icons_svg['bell']; ?>
    </div>
    
    
<?php if(in_array(_ppt(array('user','account_messages_attachments')),array("","1")) && !$CORE->isMobileDevice() ){  ?>
     <div ppt-icon-24 data-ppt-icon-size="24" style="position:absolute; right:60px; top:12px;" class="cursor opacity-5" onclick="jQuery('.fileupload-buttonbar').toggle();jQuery('._uploadtime').hide();jQuery('._uploadform').show();" >
                <?php echo $CORE_UI->icons_svg['attachment']; ?>
    </div>
<?php } ?>
    
    <div ppt-icon-24 data-ppt-icon-size="24" style="position:absolute; right:20px; top:12px;" class="cursor opacity-5" onclick="jQuery('.smilesbox').toggle(); jQuery('.ppt-messenger-window').toggle();" >
                <?php echo $CORE_UI->icons_svg['smile']; ?>
    </div>

</div>  
 
<?php
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if(in_array(_ppt(array('user','account_messages_attachments')),array("","1")) ){ 
?>
  <div class="fileupload-buttonbar" style="display:none;">
  
   <div class="_uploadtime mt-2" style="display:none;">
   <span class="_upok"><i class="fa fa-sync fa-spin mr-2"></i> <?php echo __("Uploading please wait...","premiumpress") ?> </span> 
   <span class="_uperror text-danger" style="display:none"><i class="fa fa-exclamation-triangle mr-2"></i> <?php echo __("Upload failed - try a smaller file.","premiumpress") ?> </span> 
   </div>
  
    <div class="d-flex justify-content-between align-items-center mt-2">
      <div class="custom-file _uploadform">
      
        <form id="ppt_chat_send_<?php echo $settings['pid']; ?>_file_form"  name="ppt_chat_send_<?php echo $settings['pid']; ?>_file_form" method="post" action="<?php echo home_url(); ?>" enctype="multipart/form-data">
          <input type="file" id="ppt_chat_send_<?php echo $settings['pid']; ?>_file" name="file" class="custom-file-input">
          <input type="hidden" action="chat_upload" value="1" />
        </form> 
<script>

// The Javascript
var UploadSuccess = 0;
var form = document.getElementById('ppt_chat_send_<?php echo $settings['pid']; ?>_file_form');

form.onsubmit = function() {

jQuery("._uploadtime").show();
jQuery("._uploadform").hide();
jQuery("._upok").show();
jQuery("._uperror").hide();
 

jQuery("._upok").show().delay(10000).queue(function(n) {

	if(UploadSuccess == 0){
	
	 jQuery("._upok").hide();
	 jQuery("._uperror").show();
	 
	} 
	UploadSuccess = 0;
 
});


		var fd = new FormData(form);
        fd.append("action", "chat_upload");
		 
        jQuery.ajax({
            url: '<?php echo home_url(); ?>/',
			enctype: 'multipart/form-data',
            type: 'POST',
			dataType: 'json',	
            data: fd,
            success: function(response) {
 
				if(response.status == "ok"){
					
					jQuery("#ppt_chat_send_<?php echo $settings['pid']; ?>_chat_msg").hide().val("[aid"+response.aid+"]");
					ppt_chat_send_<?php echo $settings['pid']; ?>();
					jQuery("#ppt_chat_send_<?php echo $settings['pid']; ?>_chat_msg").show();
					
					UploadSuccess = 1;
			
				}else{
				
				alert(response.msg);
				
				}
			   
			   // CLOSE BOX
			   jQuery('.fileupload-buttonbar').toggle();
            },
			
            cache: false,
            contentType: false,
            processData: false
        });


  jQuery(form).trigger("reset");
  return false; // To avoid actual submission of the form
}



jQuery(document).ready(function(){
        jQuery("#ppt_chat_send_<?php echo $settings['pid']; ?>_file").change(function(){		
		jQuery("#ppt_chat_send_<?php echo $settings['pid']; ?>_file_form").submit(); 
        });
});
</script>
        <label class="custom-file-label" for="gallery"><?php echo __(".zip, .pdf, .doc, .txt, .jpg or .png files only.","premiumpress"); ?></label>
      </div>
    </div>
  </div>
 <?php  } ?>
</div>





<div class="_footer text-center bg-light py-2" <?php if($CORE->isMobileDevice() ){ ?>style="display:none"<?php } ?>>
<?php if($canShow){ ?>
  <button type="button"  onclick="ppt_chat_send_<?php echo $settings['pid']; ?>();" data-ppt-btn  class="btn btn-system shadow-sm btn-lg"> <span><?php echo __("Send Message","premiumpress") ?></span></button>
  <?php }else{ ?>
  <a href="<?php echo _ppt(array('links','myaccount'))."?noaccess=1&showtab=membership&op=max_msg"; ?>" data-ppt-btn class="btn-system shadow-sm btn-lg"> <span><?php echo __("Send Message","premiumpress") ?></span></a>
  <?php } ?>
</div>

</div>
<script>

<?php if($CORE->isMobileDevice() ){ ?>
jQuery(document).on('keypress',function(e) {
    if(e.which == 13) {
        ppt_chat_send_<?php echo $settings['pid']; ?>();
    }
});
<?php } ?>

var isSubmitted = false;
  
function ppt_chat_send_<?php echo $settings['pid']; ?>(){
								   
										   
var msg = jQuery("#ppt_chat_send_<?php echo $settings['pid']; ?>_chat_msg").val();
var msgcheck 	= document.getElementById("ppt_chat_send_<?php echo $settings['pid']; ?>_chat_msg"); 

 
if(msgcheck.value == '')
{
      		alert('<?php echo __("Please enter a message.","premiumpress") ?>');
      		msgcheck.focus();
      		msgcheck.style.border = 'thin solid red';
      		return false;
}


 if(!isSubmitted){
     isSubmitted = true;
   }else{
     return false;
   }
 


jQuery("#chat_msg").val('');
	
jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',	
		dataType: 'json',	
		data: {
            action: "send_chat_msg",
			
			<?php if(isset($_POST['pid']) && is_numeric($_POST['pid'])){ ?>
			pid: "<?php echo $_POST['pid']; ?>",
			<?php } ?>
			 
			
			<?php  if( $settings['job_seller_id'] == $userdata->ID  ){ ?>
			
			uid: <?php echo $userdata->ID; ?>,
			rid: <?php echo $settings['job_buyer_id']; ?>,
			
			<?php  }else{ ?>
			
			uid: <?php echo $userdata->ID; ?>,
			rid: <?php echo $settings['job_seller_id']; ?>,
			
			<?php } ?> 
			
			msg: msg,			
        },
        success: function(response) {
 			
			if(response.status == "noupdate"){	
			
			}else if(response.status == "max_msg_limit"){	
					
			window.location.href='<?php echo _ppt(array('links','myaccount')); ?>/?showtab=membership&noaccess=1&max_messages=1';
  
			}else if(response.status == "ok"){
			
				// RELOAD CHAT WINDOW
				ajax_chat_logs_<?php echo $settings['pid']; ?>();	
				
				// SCROL TO BOTTOM				 	  
				jQuery('<?php echo $chat_div_id; ?>').stop().animate({ scrollTop: jQuery('<?php echo $chat_div_id; ?>').get(0).scrollHeight}, "slow");				 
					
				jQuery(".chattextbox").val('');	
				
				isSubmitted = false;	 	 
			 			 
  		 	
			}else{			
				jQuery('#ajax_chat_list').html("Could not get message data - try again later.");			
			}			
        },
        error: function(e) {
            console.log(e)
        }
    });
	
 		
}

var firstloat = 1;

function ajax_chat_logs_<?php echo $settings['pid']; ?>(){

 
jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',	
		dataType: 'json',	
		data: {
            action: "load_chat_data",
			fullaccess: 1,
			forceload: firstloat,
			limit: 15,
			hideimage: 1,
			
			
			<?php  if( $settings['job_seller_id'] == $userdata->ID  ){ ?>
			
			uid: <?php echo $userdata->ID; ?>,
			rid: <?php echo $settings['job_buyer_id']; ?>,
			
			<?php  }else{ ?>
			
			uid: <?php echo $userdata->ID; ?>,
			rid: <?php echo $settings['job_seller_id']; ?>,
			
			<?php } ?>
			
		 
        },
        success: function(response) {
		
			firstloat = 2;
		
			if(response.status == "noupdate"){
			
			
  
			}else if(response.status == "ok"){
			
				jQuery('<?php echo $chat_div_id; ?>').html('<div class="text-center pt-5 col-12"><i class="fa fa-spinner fa-4x text-primary fa-spin"></i></div>');
				
				if(response.output == ""){
				
				jQuery('<?php echo $chat_div_id; ?>').html("<div class='col-12 text-center pt-5 h4'><i class='fal fa-comments fa-4x mb-4 btn-block'></i><?php echo __("You have no chat history.","premiumpress") ?></div>");	
				//jQuery('.discussion-message').hide();		 	 
				
				}else{
				
				 	// SHOW MESSAGE				
					jQuery('<?php echo $chat_div_id; ?>').html(response.output);	
					
					// SCROL TO BOTTOM				 	  
					jQuery('<?php echo $chat_div_id; ?>').stop().animate({ scrollTop: jQuery('<?php echo $chat_div_id; ?>').get(0).scrollHeight}, "slow");
					
					
					/*  CUSTOM ICONS AND AVATARS */
					var a = jQuery(".bg-image");
					a.each(function (a) {
						if (jQuery(this).attr("data-bg")) jQuery(this).css("background-image", "url(" + jQuery(this).data("bg") + ")");
					});

		 		}			   
  		 	
			}else{			
				jQuery('<?php echo $chat_div_id; ?>').html("Could not get message data - try again later 123.");			
			}			
        },
        error: function(e) {
            console.log(e)
        }
    });
	
}// end are you sure

</script>
<?php }else{ ?>
<form id="sendmsgform<?php echo $randomnum; ?>" name="sendmsgform" method="post" action="">
  <div class="modal-header border-0">
    <h5 class="modal-title text-muted"><i class="fal fa-envelope mr-2"></i> <?php echo __("Send Message","premiumpress") ?></h5>
    <?php if(isset($GLOBALS['flag-account'])){ ?>
    <button type="button" class="close msg-modal-close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
    <?php } ?>
  </div>
  <div class="modal-body" >
    <div class="ajax_msgform_output_ok" style="display:none;">
      <div class="alert alert-success text-center small">
        <div class="mb-4 mt-2"><i class="fal fa-smile fa-4x"></i></div>
        <?php echo __("Message Sent Successfully.","premiumpress") ?> </div>
    </div>
    <div class="ajax_msgform_output_error" style="display:none;">
      <div class="alert alert-danger text-center small">
        <div class="mb-4 mt-2"><i class="fal fa-frown fa-4x"></i></div>
        <?php echo __("Error Sending Message.","premiumpress") ?> </div>
    </div>
    <div  class="ajax_msgform_error text-danger font-weight-bold mt-n2"></div>
    <div class="form-group userfieldmsg">
      <label class="font-weight-bold text-uppercase"><?php echo __("Username","premiumpress"); ?> <span class="ajaxMsgUser"></span> </label>
      <div class="input-group">
        <input class="form-control rounded-0 userf" id="usernamefield" name="username" type="text"  value="">
      </div>
    </div>
    <div class="form-group">
      <label class="font-weight-bold text-uppercase"><?php echo __("Message","premiumpress"); ?></label>
      <textarea rows="3" class="form-control rounded-0 msgf" id="newmsgcontent"  style="height:60px;" name="message"></textarea>
    </div>
    
    
    
    
    <script>


  jQuery(document).ready(function(){ 
         jQuery('#sendmsgform<?php echo $randomnum; ?> #usernamefield').change(function() { 
         
             jQuery.ajax({
                 type: "POST",
                 url: '<?php echo home_url(); ?>/',		
         		data: {
                     action: "validateUsername",
         			un: jQuery('#sendmsgform<?php echo $randomnum; ?> #usernamefield').val(), 
                 },
                 success: function(response) {
         		 
         			if(response == "yes"){
         			jQuery('#sendmsgform<?php echo $randomnum; ?> .ajaxMsgUser').html("<span class='badge badge-success'><i class='fa fa-check-circle'></i> <?php echo trim(__("Valid Username","premiumpress")); ?></span>");
         			
					jQuery('#sendmsgform<?php echo $randomnum; ?> button').show();
					
					} else {
         			jQuery('#sendmsgform<?php echo $randomnum; ?> .ajaxMsgUser').html("<span class='badge badge-danger'><i class='fa fa-close'></i> <?php echo trim(__("Invalid Username","premiumpress")); ?></span>");
         			
					jQuery('#sendmsgform<?php echo $randomnum; ?> button').hide();
					
					}			
                 },
                 error: function(e) {
                     console.log(e)
                 }
             });
         
         });
		 });

function CheckMsgFormData<?php echo $randomnum; ?>()
   { 
   	 
		 
		
		jQuery("#sendmsgform<?php echo $randomnum; ?> .ajax_msgform_error").html('');	
		 
		if( jQuery("#sendmsgform<?php echo $randomnum; ?> .userf").val() == '')
		{
			jQuery("#sendmsgform<?php echo $randomnum; ?> .ajax_msgform_error").html("<?php echo __("Please enter a valid username.","premiumpress") ?>");			  
			jQuery("#sendmsgform<?php echo $randomnum; ?> .userf").css('border', '1px solid red');			  
			return false;
		} 		
	 
	   
		if(jQuery("#sendmsgform<?php echo $randomnum; ?> .msgf").val() == "")
		{
			jQuery("#sendmsgform<?php echo $randomnum; ?> .ajax_msgform_error").html("<?php echo __("Please enter a valid message.","premiumpress") ?>");
			jQuery("#sendmsgform<?php echo $randomnum; ?> .msgf").css('border', '1px solid red');
			return false;
		}  
	 
		if( jQuery("#sendmsgform<?php echo $randomnum; ?> .msgf").val().length < 5)
		{
			jQuery("#sendmsgform<?php echo $randomnum; ?> .ajax_msgform_error").html("<?php echo __("Please enter a longer message.","premiumpress") ?>");
			jQuery("#sendmsgform<?php echo $randomnum; ?> .msgf").css('border', '1px solid red');
			return false;
		}  
	
	
		jQuery.ajax({
				type: "POST",
				url: '<?php echo home_url(); ?>/',	
				dataType: 'json',	
				data: {
					action: "single_msg",
					u: ''+jQuery("#sendmsgform<?php echo $randomnum; ?> .userf").val()+'',
					m: ''+jQuery("#sendmsgform<?php echo $randomnum; ?> .msgf").val()+'',
							
				},
				success: function(response) {
		 
					if(response.status == "ok"){
					 
						jQuery('#sendmsgform<?php echo $randomnum; ?> .ajax_msgform_output_ok').show();	
						jQuery('#sendmsgform<?php echo $randomnum; ?> .form-group, #sendmsgform<?php echo $randomnum; ?> .sendbtn').hide(); 
					
					}else{			
						jQuery('#sendmsgform<?php echo $randomnum; ?> .ajax_msgform_output_error').show();		
						jQuery('#sendmsgform<?php echo $randomnum; ?> .form-group, #sendmsgform<?php echo $randomnum; ?> .sendbtn').hide(); 				
					}			
				},
				error: function(e) {
					console.log(e)
				}
			});
	
	
	 
   }
   
   
  
</script>
  </div>
  <div class="card-footer text-center" <?php if($CORE->isMobileDevice() ){ ?>style="display:none"<?php } ?>>
  <?php 

  
  if( $canShow){ ?>
    
    <button type="button" onclick="CheckMsgFormData<?php echo $randomnum; ?>();" class="btn-system btn-lg" data-ppt-btn> 
   
   <span><?php echo __("Send Message","premiumpress") ?></span>
    
    </button>
   
   
    <?php }else{ ?>
     <a href="<?php echo _ppt(array('links','myaccount'))."?noaccess=1&showtab=membership&op=max_msg"; ?>" class="btn-system btn-lg" data-ppt-btn> 
	 
	 <span><?php echo __("Send Message","premiumpress") ?></span>
     
     </a>
     
    
    <?php } ?>
    
  </div>
  
  
  
  
</form>
<?php  } ?>


<?php if(isset($settings)){ ?>
<script>

var chatRefresh = 0;

if (typeof count === "undefined") {
var count = 0;
}

function addSmile(sid){

jQuery("#ppt_chat_send_<?php echo $settings['pid']; ?>_chat_msg").val("[smile:"+sid+"]");
ppt_chat_send_<?php echo $settings['pid']; ?>();

jQuery('.smilesbox').toggle();
jQuery('.ppt-messenger-window').toggle();

}

jQuery(document).ready(function(){  

	ajax_chat_logs_<?php echo $settings['pid']; ?>();
 
 	if(count == 0){
	WindowRefresh();
	}

});


function WindowRefresh() {
  
         if(count == 10) {
		 
             ajax_chat_logs_<?php echo $settings['pid']; ?>();
			 
			 count  = 0;
			 
			  setTimeout(WindowRefresh, 1000);
			 
         } else { 
		 
             setTimeout(WindowRefresh, 1000);
			 
		}
		
		count ++;
}  
 
</script>
 
<?php } ?> 

</div>

<style>
@media (max-width: 575.98px){
[ppt-box].messenger ._content { height:82%!important; }
}
</style>