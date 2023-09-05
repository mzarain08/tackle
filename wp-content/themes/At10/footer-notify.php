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
if (!defined('THEME_VERSION')) {	footer('HTTP/1.0 403 Forbidden'); exit; }

global $CORE, $userdata, $CORE; 
 
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
?>

<div id="ppt-notice-new-custom" style="display:none;">
<?php _ppt_template( 'framework/design/widgets/alert-popup' );  ?> 
</div>

<div id="ppt-notice-new-notifications" style="display:none;">
<?php _ppt_template( 'framework/design/widgets/alert-notify' );  ?> 
</div>

<div id="ppt-notice-new-message" style="display:none;">
<?php _ppt_template( 'framework/design/widgets/alert-message' );  ?> 
</div>

<div id="ppt-notice-new-login" style="display:none;">
<?php _ppt_template( 'framework/design/widgets/alert-login' );  ?> 
</div>
 
<?php
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if((is_admin() && isset($_POST['submitted'])) || isset($GLOBALS['error_ok']) ){
 
?>  
<div id="ppt-notice-new-admin" style="display:none;">
<?php _ppt_template( 'framework/design/widgets/alert-admin' );  ?> 
</div>
<script>
setTimeout(function(){	 

var r = jQuery("#ppt-notice-new-admin").html();
pptModal("admin-saved", r, "modal-bottom-right", "ppt-animate-bouncein w-700", 1);	


	setTimeout(function(){	 
	
	var r = jQuery("#ppt-notice-new-admin").html();
	pptModal("admin-saved", r, "modal-bottom-right", "ppt-animate-bouncein w-700", 1);	
	
		jQuery(".modal-admin-saved").removeClass("show");												 
	},2000);
										 
},1000);
</script> 
<?php }



///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
if(!is_admin() && !isset($_GET['ppt_live_preview']) ){

if(!in_array(_ppt(array('user','notify')), array("","1")) || (defined("THEME_KEY") &&  in_array(THEME_KEY,array("sp")) )  ){ ?>

<input type="hidden" name="notify-stop" class="notify-stop" id="notify-stop" value="1" />

<?php }elseif($userdata->ID && !isset($GLOBALS['flag-home-demo']) && !ppt_check_preview_mode() && !isset($GLOBALS['COMCHATSET']) && !isset($GLOBALS['flag-register']) && !isset($GLOBALS['flag-login'])&& !isset($GLOBALS['flag-no-admin-helper']) && _ppt(array('user','account_messages')) != "0" ){ ?>

 
<div class="notify-footer hide-mobile">
  <div class="chat-handle text-white p-2">
    <div class="d-md-flex justify-content-between">
      <div class="m_count  btn-block" onClick="jQuery('#userListBox').slideToggle(); ProcessUserMsgList(<?php echo $userdata->ID; ?>); ">
       <strong>&nbsp;</strong>  <span><div class="fa fa-circle"></div> <small class="text-truncate preload-hide"><?php echo $CORE->USER("get_username", $userdata->ID); ?></small>  </span>
      </div>
      <div class="position-relative">
        <div class="n_count">
          <div class="single-page-edit-button" style="display:none; top: -17px; left: -29px;">
            <i class="fa fa-bell text-white"></i> <span class="ripple"></span><span class="ripple"></span><span class="ripple"></span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="userListBox" class="bg-white" style="display: none;">
    <div style="min-height:150px;" id="ajax_msg_list" data-link="<?php echo _ppt(array('links','myaccount')); ?>/?showtab=messages" data-title="<?php echo __("No Messages","premiumpress"); ?>"></div>
  </div>
</div>
</div> 
<?php } } ?>