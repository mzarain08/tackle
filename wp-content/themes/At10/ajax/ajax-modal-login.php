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

global $CORE,$userdata;

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
if(_ppt(array("user","wplogin")) == "1"){  ?>

<div class="text-center">
  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
</div>

<script>
jQuery(document).ready(function () {
        setTimeout(function() {
            window.location = "<?php echo home_url()."/wp-login.php?reauth=1&redirect_to="._ppt(array('links','myaccount')); ?>";
        }, 1000);
});
</script>
<?php 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

}else{




?> 

<?php if(isset($_POST['action'])){ ?>
<div class="card-popup midum">
<div class="bg-primary pt-3"> 
    
      <div class="card-popup-content">  
      <div class="">
          <?php if(in_array(_ppt(array('design', 'ppt_emoji')), array("","1"))){  ?><span class="smilecode" style="font-size: 40px;">&#x1F600;</span><?php } ?>
      
       <h5 class="text-white"><?php echo __("Member Login","premiumpress") ?></h5>
       </div>
      </div>
      
</div>
</div>
<?php }else{ ?>
<div class="pb-3">
  <h1><?php echo __("Sign In","premiumpress") ?></h1>
</div>
<?php } ?>

<div class="<?php if(isset($_POST['action'])){ ?>px-4 pb-4<?php } ?>">

<?php 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if(get_option('users_can_register') == 1 ){  ?>
  <p class="mt-0 small"><?php echo __("Don't have an account?","premiumpress"); ?> <a href="<?php 
  
  
  if(THEME_KEY == "da"){
  echo  _ppt(array('links','add'));
  }else{
  echo wp_registration_url();
  }
 
  
   ?>"><u><?php echo __("Sign Up","premiumpress"); ?></u></a> </p>

<?php 

}
  

 if(defined('WLT_DEMOMODE') && strpos($_SERVER['HTTP_HOST'],"premiummod.com") !== false && !isset($_GET['admindemo'])  ){ ?>
<div class="alert alert-success">
  <i class="fa fa-user-circle mr-2"></i> <strong>Username: demo / Password :
  demo</strong>
</div>
<?php } ?>
<div id="login_form_message">
</div>
<?php 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if(isset($_GET['checkemail'])){ ?>
<div class="alert alert-success">
  <i class="fa fa-envelope fa-3x mr-3 float-left"></i> <?php echo __("We have sent password recovery instructions to your email address.","premiumpress") ?>
</div>
<?php } 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
<script>


function login_process(){ 

	var user_login 	= document.getElementById("user_login"); 					
	var user_pass 	= document.getElementById("user_pass");
					
	canContinue = true;
					 					
		if(user_login.value == '')
		{
				jQuery("#login_form_message").addClass('text-danger mb-4').html("<?php echo trim(__("Please complete all required fields.","premiumpress")); ?>");						
				user_login.style.border = 'thin solid red';
				canContinue = false;
		}
							
		if(user_pass.value == '')
		{
				jQuery("#login_form_message").addClass('text-danger mb-4').html("<?php echo trim(__("Please complete all required fields.","premiumpress")); ?>");
				user_pass.focus();
				user_pass.style.border = 'thin solid red';
				canContinue = false;
		}
 
  if(canContinue){
  
   var formd = jQuery("#form_user_login").serialize();
   
  jQuery('#login_form_message').html('<div class="text-center text-primary"><i class="fa fa-spinner fa-3x fa-spin"></i></div>');
  jQuery('#form_user_login').hide();
  jQuery('.loginbottomextras').hide();
 
   jQuery.ajax({
        type: "POST",
        url: ajax_site_url,	
		dataType: 'json',	
   		data: {
               action: "login_process", 
			   formdata: formd,			 
           },
           success: function(response) { 
		    	
				 if(response.status == "error"){				 
				 
				 	jQuery("#login_form_message").addClass('text-danger mb-4').html(response.msg);		
					
					jQuery('#form_user_login').show();
					jQuery('.loginbottomextras').show();	 
				 
				 }else if(response.status == "func_mem"){				 	
					
					jQuery(".ppt-modal-wrap").removeClass('show');	
					processNewPayment(response.link);				 				
				 
				 }else if(response.status == "reload"){
				 
				 	window.location.reload();				 
				 
				 }else if(response.status == "ok"){
					  
					window.location.href= response.link;
				 	
				 } 
   			
           },
           error: function(e) {
               console.log(e)
           }
       });
  
  }
  
} 
</script>


<form id="form_user_login" name="form_login" class="ppt-forms ajax_modal" action="#" onsubmit="login_process(); return false; " method="post" >
  <div class="form-group position-relative">
    <input type="text" class="form-control" placeholder="<?php echo __("Email","premiumpress"); ?>" name="log" id="user_login"  value="<?php if(isset($_GET['admindemo'])){ echo "admindemo"; } elseif (defined('WLT_DEMOMODE') && strpos($_SERVER['HTTP_HOST'],"premiummod.com") !== false){ echo "demo"; } ?>" autocomplete="current-password">
    <i class="fal fa-envelope"></i>
  </div>
  <div class="form-group position-relative">
    <input type="password" placeholder="<?php echo __("Password","premiumpress"); ?>" class="form-control" name="pwd" id="user_pass" value="<?php if(isset($_GET['admindemo'])){ echo "admindemo"; } elseif (defined('WLT_DEMOMODE') && strpos($_SERVER['HTTP_HOST'],"premiummod.com") !== false){ echo "demo"; } ?>" autocomplete="current-password">
   
    <i class="fal fa-lock"></i> 
    
    <i class="fa fa-eye" onclick="TogglePass('user_pass');"></i>
  </div>
  <?php do_action('login_form'); ?>
  <div class="form-group">
    <button type="submit" data-ppt-btn  class=" btn-block btn-primary btn-lg font-weight-bold text-uppercase"><?php echo __("Sign in","premiumpress"); ?></button>
  </div>
  <div class="row small opacity-8">
    <div class="col-md-6">
      <label class="custom-control custom-checkbox">
      <input type="checkbox" name="remember" class="custom-control-input" checked="">
      <div class="custom-control-label">
        <?php echo __("Remember","premiumpress"); ?>
      </div>
      </label>
    </div>
    <div class="col-md-6 text-center text-md-right">
      <a href="<?php echo wp_lostpassword_url(); ?>" rel="nofollow"><u><?php echo __("Lost password?","premiumpress"); ?></u></a>
    </div>
  </div>
  <input type="hidden" name="testcookie" value="1" />
  <input type="hidden"  name="rememberme" id="rememberme"  value="1" />
</form>



<?php 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if(  defined('WLT_DEMOMODE') || _ppt(array('register','sociallogin')) == 1 ){   ?>
<div class="loginbottomextras">
 
  <div class="row mt-4">
    <?php 		 
		 
		 $providers = array( 
		 "Twitter" 		=> array("icon" => "fab fa-twitter"),
		 "Facebook" 	=> array("icon" => "fab fa-facebook-f"),
		 "Google"  		=> array("icon" => "fab fa-google"), 
		 "LinkedIn"  	=> array("icon" => "fab fa-linkedin"),
		 ); 		 
		 
		 foreach($providers as $key => $hh ){ if(defined('WLT_DEMOMODE') || _ppt('social_'.strtolower($key).'') == '1'){   ?>
    <div class="col-6 pr-lg-1 mb-2">
      <a data-ppt-btn class="btn-block btn-<?php echo strtolower($key); ?> text-white" 
            <?php if(defined('WLT_DEMOMODE')){ ?>
            href="javascript:void(0)" onclick="alert('Disabled in demo mode.');"
            <?php }else{ ?>
            href="<?php echo home_url(); ?>/wp-login.php?sociallogin=<?php echo $key; ?>"
            <?php } ?>
            
             rel="nofollow"> <i class="<?php echo $hh['icon']; ?> ">&nbsp;</i> <span><?php echo $key; ?></span></a>
    </div>
<?php }  ?>

<?php } ?> 
</div></div><?php }  ?>

</div>
 
<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if(defined('WLT_DEMOMODE') && isset($_GET['admindemo'])){  ?>
  <script>
   jQuery(document).ready(function () {
       jQuery("#form_user_login").submit();
   });
</script>
  <?php } ?>

<?php } ?>