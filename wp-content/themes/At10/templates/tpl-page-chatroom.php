<?php
/*
Template Name: [PAGE - CHATROOM]
 
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
 
global  $userdata, $CORE_THEME, $CORE;

// REDIRECT IF NOT LOGGED IN
$CORE->Authorize(); 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
if( current_user_can('editor') || current_user_can('administrator') ) { 
	
	$canView = true;
	
}else{
	
	
		if($CORE->USER("membership_hasaccess", "view_chatroom") == 1){ 
		 
		$canView = true;
		}else{  
		
			header('location: '._ppt(array('links','memberships'))."?noaccess=1" );
			exit();
		
		}
}
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$GLOBALS['flag-chatroom'] = 1;
$GLOBALS['flag-no-admin-helper'] = 1;
$GLOBALS['flag-page-nopadding'] = 1;

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


get_header();

_ppt_template( 'page-before' );

?>
 


<?php if( in_array(_ppt(array("comchat","enable")), array("1")) && _ppt(array('comchat','appid')) != "" && _ppt(array("comchat","authkey")) != "" ){  $GLOBALS['COMCHATSET'] = 1; ?>
	 
    <div class="container py-5">
    <script>
  var chat_appid = '<?php echo _ppt(array("comchat","appid")); ?>';
  var chat_auth = '<?php echo _ppt(array("comchat","authkey")); ?>';
    var chat_id = '<?php echo $userdata->ID; ?>';
    var chat_name = '<?php echo $CORE->USER("get_username", $userdata->ID); ?>';
    var chat_avatar = '<?php echo $CORE->USER("get_avatar", $userdata->ID); ?>';
    var chat_link = '<?php echo $CORE->USER("get_user_profile_link", $userdata->ID); ?>';
 
  var chat_height = '600px';
  var chat_width = '100%'; 

  document.write('<div id="cometchat_embed_synergy_container" style="width:'+chat_width+';height:'+chat_height+';max-width:100%;border:1px solid #CCCCCC;border-radius:5px;overflow:hidden;"></div>');

  var chat_js = document.createElement('script'); chat_js.type = 'text/javascript'; chat_js.src = 'https://fast.cometondemand.net/'+chat_appid+'x_xchatx_xcorex_xembedcode.js';
  chat_js.onload = function() {
    var chat_iframe = {};chat_iframe.module="synergy";chat_iframe.style="min-height:"+chat_height+";min-width:"+chat_width+";";chat_iframe.width=chat_width.replace('px','');chat_iframe.height=chat_height.replace('px','');chat_iframe.src='https://'+chat_appid+'.cometondemand.net/cometchat_embedded.php'; if(typeof(addEmbedIframe)=="function"){addEmbedIframe(chat_iframe);}
  }
  var chat_script = document.getElementsByTagName('script')[0]; chat_script.parentNode.insertBefore(chat_js, chat_script);
</script>
</div>
<?php }else{ ?>


<div <?php if( _ppt(array('design', 'customsidebar')) != 1){ ?>class="p-md-5"<?php } ?> style="max-width:1300px;margin:auto auto;">
<div class="h6 text-center p-2 bg-primary m-0 text-white show-mobile"><?php echo __("Online Members","premiumpress"); ?></div>
<div ppt-border1>
<?php _ppt_template( 'account/account-messages' ); ?>
</div>
</div>

<script>
jQuery(document).ready(function() {

	jQuery('#sidebar').toggleClass('active');
	
	ajax_load_chat_list();

});
</script>

<?php } ?>

<?php

_ppt_template( 'page-after' );

get_footer(); ?>