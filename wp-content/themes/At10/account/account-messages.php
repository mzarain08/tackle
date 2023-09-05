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

global $CORE, $userdata, $post, $settings; 

	  $canShow = true;
   	  if($CORE->USER("membership_featured_enabled", "max_msg")){
	  
			// CHECK USER CREDIT
			if($CORE->USER("get_user_free_membership_addon", array("max_msg", $userdata->ID)) > 0){
			
			}else{
			
			$canShow = false;
			}
	  
	  }
	 
	 
?>

<div class="cardxxx">
  <div id="ajax-sql">
  </div>
  <div class="wrapper-chat container-fluid">
    <div class="row">
      <div class="col-lg-3 col-md-4 wrapper-infos">
        <div class="row">
          <?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
  ?>
          <div class="col-lg-12 col-md-12 infos-header hide-mobile">
            <div class="row">
              <div class="col-lg-7 col-md-7 col-7 left">
              </div>
              <div class="col-lg-5 col-md-5 col-5 right">
              </div>
            </div>
          </div>
          <?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
?>
          <div class="col-lg-12 col-md-12 contact-list px-0">
            <div id="ajax_chat_list" class="col-12 px-0">
            </div>
          </div>
          <?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
?>
        </div>
      </div>
      <div class="col-lg-9 col-md-8 col-12 d-none d-lg-block d-md-block wrapper-discussion">
        <div class="row">
          <div class="col-lg-12 col-md-12 discussion-header" style="display:none;">
          
           <a href="<?php if(isset($GLOBALS['flag-chatroom'])){ echo _ppt(array('links','chatroom')); }else{  echo _ppt(array('links','myaccount')); ?>?showtab=messages<?php } ?>" class="btn btn-sm btn-system float-right mt-4 ml-3 backbtn"><i class="fa fa-sign-out-alt"></i></a>
            
            <a href="#" class="btn btn-sm btn-system float-right mt-4 plink" target="_blank"><?php echo __("View Profile","premiumpress") ?></a>
            
           
            <div class="d-flex mt-3">
              <span href="0" class="ppt-avatar ppt-avatar-sm  rounded-circle mr-4  shadow-sm">
              <div class="_wrap bg-image">
              </div>
              </span>
              <div class="_username font-weight-bold">
              </div>
            </div>
          </div>
          <div class="col-lg-12 col-md-12 discussion-list border-left">
            <div class="row" id="discussion-block">
            </div>
          </div>
          <?php
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
          <div class="col-lg-12 col-md-12 discussion-message">
            <?php
 
if(in_array(_ppt(array('user','account_messages_attachments')),array("","1")) ){ 

$chat_upload_id = "ppt_chat_send_".$userdata->ID."_123_".$userdata->ID."_file_form";

?>
            <div class="fileupload-buttonbar" style="display:none;">
              <div class="d-flex justify-content-between align-items-center mt-2 ml-4 mb-3">
                <div class="custom-file">
                  <!-- The HTML -->
                  <form id="<?php echo $chat_upload_id; ?>" name="ppt_chat_send_file_form" method="post" action="<?php echo home_url(); ?>" enctype="multipart/form-data">
                    <input type="file" id="<?php echo $chat_upload_id; ?>_file" name="file" class="custom-file-input">
                    <input type="hidden" action="chat_upload" value="1" />
                  </form>
                  <script>
jQuery(document).ready(function(){
        jQuery("#<?php echo $chat_upload_id; ?>_file").change(function(){				
 
		var form = document.getElementById('<?php echo $chat_upload_id; ?>');
		   
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
													
							jQuery("#chat_msg").val("[aid"+response.aid+"]");
							ppt_chat_send();
					
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
		
		
		  jQuery('#<?php echo $chat_upload_id; ?>').trigger("reset");
		  jQuery(form).trigger("reset");
 		
        });
});
</script>
                  <label class="custom-file-label" for="gallery"><?php echo __(".zip, .pdf, .doc, .txt, .jpg or .png files only.","premiumpress"); ?></label>
                </div>
              </div>
            </div>
            <?php } ?>
            <div class="smilesbox" style="display:none;">
              <ul class="list-inline">
                <?php $smiles = $CORE->USER("smiles",0); $si=0; foreach($smiles as $smile){ ?>
                <li class="list-inline-item"> <a href="javascript:void(0);" onclick="addSmile(<?php echo $si; ?>)"><i class='ppt-smile-icon icon-<?php echo $smile; ?>'></i></a> </li>
                <?php $si++; } ?>
              </ul>
            </div>
            <div class="form-group mb-0 position-relative">
            
            <?php if($canShow){ ?>
            
           <i class="fal fa-smile" onclick="jQuery('.smilesbox').toggle();" style="cursor:pointer;"></i> 
              <input type="text" name="messages" id="chat_msg" style="padding-left:50px;" class="form-control whitebg" placeholder="<?php echo __("Type a message...","premiumpress") ?>">
              <i onclick="jQuery('.fileupload-buttonbar').toggle();" style="cursor:pointer;" class="fa fa-fas fa-paperclip"></i>
            
            <?php }else{ ?>
            <div class="opacity-5 text-center">
            <?php echo __("Please upgrade to use this chat feature.","premiumpress"); ?>
            </div>
            <?php } ?>  
              
            </div>
          </div>
          <?php
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <?php _ppt_template( 'ajax/ajax-modal-msg' ); ?>
    </div>
  </div>
</div>
<div class="clearfix">
</div>
<input name="rid" id="rid" value="" type="hidden" />
<?php
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
<script>
jQuery(document).ready(function(){ 

 

//ajax_load_chat_list();
 <?php if( isset($_GET['u']) && !isset($_POST['username']) ){ ?>
 jQuery('.userf').val('<?php echo strip_tags($_GET['u']); ?>');
  jQuery('.userfieldmsg').hide();
 jQuery('#exampleModal').modal('toggle');
<?php } ?> 


 <?php if( isset($_GET['uid']) && !isset($_POST['username']) && is_numeric($_GET['uid']) ){ ?>
 jQuery('.userf').val('<?php echo $CORE->USER("get_username", $_GET['uid']); ?>');
 jQuery('.userfieldmsg').hide();
 jQuery('#exampleModal').modal('toggle');
<?php } ?> 

<?php if(isset($_POST['username'])){ ?>

notify({
		type: "success", //alert | success | error | warning | info
        title: "<?php echo __("Message Sent","premiumpress"); ?>",
		position: {
         x: "right", //right | left | center
         y: "top" //top | bottom | center
        },
        icon: '<i class="fal fa-check"></i>',
        message: "<?php echo __("Your message has been sent successfully.","premiumpress"); ?>&nbsp;"
	});


<?php } ?>

});


jQuery(document).ready(function(){ 

 
 

	// HIDE MESSAGE FORM 
	jQuery('body').on('click','.contact',function(){
	 
	jQuery('.discussion-message').show();  
	jQuery(".account-mobile-menu").html('').removeClass('show-mobile').hide();
	
	jQuery("#mobile-bottom-bar").addClass('shadow-none');
		 
		 
		var uid = jQuery(this).data('uid');	
		 
		jQuery('#rid').val(uid);				 
		
		ajax_load_chat_data(uid);					 
											 
		jQuery('.contact').removeClass('active-contact');
		jQuery(this).addClass('active-contact');		
		
		jQuery('.wrapper-discussion').removeClass('d-none');
		
		update_discussion_header();

		reloadchatwindow(uid);
	});
	
	
	jQuery('body').on('click','.discussion',function(){
		jQuery('.wrapper-discussion').addClass('d-none');
	});
	 
 
});

function reloadchatwindow(uid){
 
		// RELOAD CHAT
		setTimeout(function(){ 	
		
			ajax_load_chat_data(uid);
						
			reloadchatwindow(uid); 
			
			console.log("chat refreshed");
					
		}, 25000);	

}

function ajax_load_chat_data(id){


jQuery('#discussion-block').html('<div class="text-center mt-5 pt-5 col-12"><i class="fa fa-spinner fa-4x text-primary fa-spin"></i></div>');

 
jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',	
		dataType: 'json',	
		data: {
            action: "load_chat_data",
			uid: id,
			forceload: 1,
			rid: jQuery('#rid').val(),
        },
        success: function(response) {
  
			if(response.status == "noupdate"){
			
				jQuery('#discussion-block').html("<div class='col-12 text-center mt-5 pt-5  h4'><i class='fal fa-comment-alt-slash text-primary fa-6x btn-block mb-4'></i><?php echo __("You have no chat history.","premiumpress") ?></div>");	
			
  
			}else if(response.status == "ok"){
				
				if(response.output == ""){
				
				jQuery('#discussion-block').html("<div class='col-12 text-center mt-5 pt-5  h4'><i class='fal fa-comment-alt-slash text-primary fa-6x btn-block mb-4'></i><?php echo __("You have no chat history.","premiumpress") ?></div>");	
				//jQuery('.discussion-message').hide();		 	 
				
				}else{
					
					// SHOW MESSAGE BOX
					jQuery('.discussion-message').show();
					
				 	// SHOW MESSAGE				
					jQuery('#discussion-block').html(response.output);	
					
					jQuery('#ajax-search-found').html(response.total);
					
					// ADD OVERFLOW TO LIST
						
					if(jQuery('#ajax_chat_list').height() > 600){
					
						jQuery('#ajax_chat_list').css('overflow-y','scroll');
							
					}			
					
					// SCROL TO BOTTOM
					var wtf    = jQuery('.discussion-list');				 
					var height = wtf[0].scrollHeight;				  
					jQuery('.discussion-list').stop().animate({ scrollTop: height}, "slow");				  			
					
					var uid = jQuery('.active-contact').data('uid');							 
					jQuery('#rid').val(uid);
					
					
					// avatars
					var a = jQuery(".bg-image");
					a.each(function (a) {
						if (jQuery(this).attr("data-bg")) jQuery(this).css("background-image", "url(" + jQuery(this).data("bg") + ")");
					}); 
				
				}	 
			 
  		 	
			}else{			
				jQuery('#discussion-block').html("Could not get message data - try again later.");			
			}			
        },
        error: function(e) {
            console.log(e)
        }
    });
	
}// end are you sure
 
function ajax_load_chat_list(){


 
jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',	
		dataType: 'json',	
		data: {
            action: "load_chat_list",
			uid: <?php echo $userdata->ID; ?>,
			<?php if(isset($GLOBALS['flag-chatroom'])){ ?>
			chatroom: "1",
			<?php } ?>
        },
        success: function(response) {
		 
			if(response.status == "noupdate"){			
			
  
			}else if(response.status == "ok"){
			
			jQuery('#discussion-block').html('<div class="col-12 text-center mt-5 pt-5"><i class="fal fa-comments fa-4x mb-4 btn-block"></i> <i class="fa fa-spinner fa-4x text-primary fa-spin"></i></div>');
 
			 	 
			 
					// SHOW MESSAGE				
					jQuery('#ajax_chat_list').html(response.output); 
					
					jQuery('#discussion-block').html('');
					 
					 
					if(response.total == 0){
					 
						jQuery('#discussion-block').html("<div class='col-12 text-center mt-5 pt-5  h4'><i class='fal fa-comment-alt-slash text-primary fa-6x btn-block mb-4'></i><?php echo __("You have no chat history.","premiumpress") ?></div>");	
						//jQuery('.discussion-message').hide();	
					
					}else{						 
						
						jQuery('.user-'+response.last_userid).addClass('active-contact');
						jQuery('#rid').val(response.last_userid);
						
						ajax_load_chat_data(response.last_userid);
					
					}
					 
					
					update_discussion_header();
					
					// avatars
					var a = jQuery(".bg-image");
					a.each(function (a) {
						if (jQuery(this).attr("data-bg")) jQuery(this).css("background-image", "url(" + jQuery(this).data("bg") + ")");
					}); 
				 			 
  		 	
			}else{			
				jQuery('#ajax_chat_list').html("Could not get message data - try again later.");			
			}			
        },
        error: function(e) {
            console.log(e)
        }
    });
	
}// end are you sure


function update_discussion_header(){
	
	var img = jQuery(".active-contact").find('.bg-image').css('background-image','').attr('data-bg'); 
	 
	if (typeof img != "undefined") {
	
		jQuery(".discussion-header").find('.bg-image').css('background-image',' url("' + img + '")'); 
		
		jQuery(".discussion-header ._username").html(jQuery(".active-contact ._name").html());
	
		jQuery(".discussion-header .plink").attr('href',jQuery(".active-contact").data('link'));
	
		var time = jQuery(".active-contact .chat-timing").html();
		jQuery(".discussion-header p").html(time);
		 
		 
		jQuery(".discussion-header").show();
	
	}
	 
	
} 
var isSubmitted = false;
  

function ppt_chat_send(){
 										   
										   
var msg = jQuery("#chat_msg").val();
var msgcheck 	= document.getElementById("chat_msg"); 
if(msgcheck.value == '')
{
      		alert("<?php echo __("Please enter a message.","premiumpress") ?>");
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
			uid: <?php echo $userdata->ID; ?>,
			rid: jQuery('#rid').val(),
			msg: msg,			
        },
        success: function(response) {
 
			if(response.status == "ok"){
			
				// RELOAD CHAT WINDOW
				ajax_load_chat_data(jQuery('#rid').val());	
				
				
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
function addSmile(sid){

jQuery("#chat_msg").val("[smile:"+sid+"]");
ppt_chat_send();

jQuery('.smilesbox').toggle();

}

jQuery(document).ready(function(){ 

jQuery('body').on('keyup','#chat_msg',function(e){
	if (jQuery("#chat_msg").is(":focus") && (e.keyCode == 13) ) {
		var msg = jQuery(this).val();				
		if( msg != "" ){
		
		ppt_chat_send();
		
		}else{
			alert("Please write a message");
		}
	}
});

});
 
</script>
