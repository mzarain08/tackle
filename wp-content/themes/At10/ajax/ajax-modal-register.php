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

$i=1;
$fields = array();


$fields["first_name"] 	= array( "title" => __("Full Name","premiumpress"), "css" => "", "type" => "text", "required" => 1);
//$fields["last_name"] 	= array( "title" => __("Last Name","premiumpress"), "css" => "", "type" => "text", "required" => 1);




$fields["user_email"] 	= array( "title" => __("Email Address","premiumpress"), "type" => "text", "required" => 1); 
//if( _ppt(array('register','password')) == '1'){
$fields["user_pass"] 	= array( "title" => __("Password","premiumpress"), "type" => "password", "required" => 1);
//} 

//if(_ppt(array('register','username')) == 1){
$fields["username"] 	= array( "title" => __("Username","premiumpress"), "css" => "", "type" => "username", "required" => 1);
//}


if( in_array(THEME_KEY, array("da" )) ){

	$count = 1; $vals = array();
	$cats = get_terms( 'dagender', array( 'hide_empty' => 0, 'parent' => 0  ));
	if(!empty($cats)){
		
		foreach($cats as $cat){ 
		
			if($cat->parent != 0){ continue; } 
			 
			$vals[$cat->term_id] = ppt_theme_text_switch($cat->slug, $CORE->GEO("translation_tax", array($cat->term_id, $cat->name)) ); //$CORE->GEO("translation_tax", array($cat->term_id, $cat->name));
		 
		} 
	
		$fields["user_interest"] = array( "title" => __("I'm interested in","premiumpress"), "type" => "select", "required" => 1, "values" => $vals);	
	
	} 
}


if(_ppt(array("user","showaccounttype")) == 1){ 

$accountTypes = $CORE->USER("get_account_type_all", array());
if(!empty( $accountTypes ) ){
$fields["user_type"] 	= array( "title" => __("Welcome to our website <span></span>.","premiumpress"), "type" => "usertype", "required" => 1);
}

}
 
 
$regfields = get_option("regfields"); 
 
 
if(is_array($regfields) && !empty($regfields['name']) ){ $i=0;  
	foreach($regfields['name'] as $data){ 
	
		if( isset($regfields['signup'][$i]) && $regfields['signup'][$i] == "1" ){ }else{ continue; }
		
		if( strlen($regfields['name'][$i]) > 1 ){ 
		
		$req = 0;
		if(isset($regfields['required'][$i]) && $regfields['required'][$i] == '1'){
		$req =1;
		}
		
		$vals = "";
		if(isset($regfields['values'][$i]) && in_array($regfields['type'][$i], array("checkbox","radio","select"))){ 		
			$val = explode(PHP_EOL, stripslashes($regfields['values'][$i]));
			$vals = array();
			foreach($val as $b){
				$vals[$b] = $b;
			}		
		} 
		
		$ft = $regfields['type'][$i];
		if($ft == "input"){
		$ft = "text";
		}
		$fields[trim($regfields['key'][$i])] = array( "title" => stripslashes($regfields['name'][$i]), "type" => $ft, "required" => $req, "values" => $vals  );		
		
		}
		$i++;
	}
}
 

$fields["privacy"] = array( "title" => "Finally, do you accept our Privacy Policy?", "type" => "privacy"  );
		

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

//hook_register_top(); 

?>
<div id="ppt-form-loading"></div>


<?php if(isset($_POST['action'])){ ?>

<div class="card-popup midum m-n4">
<div class="bg-primary pt-3"> 
    
      <div class="card-popup-content">  
      <div class="">
          <?php if(in_array(_ppt(array('design', 'ppt_emoji')), array("","1"))){  ?><span class="smilecode" style="font-size: 40px;">&#x1F600;</span><?php } ?>
      
       <h5 class="text-white"><?php echo __("Signup free now!","premiumpress") ?></h5>
       </div>
      </div>
      
</div>
</div>
<div class="mb-4 mobile-mt-4"></div>
<?php }else{ ?>
<div class="ppt-form-titlebit">
    <div class="pb-3">
      <h1><?php echo __("Sign Up","premiumpress") ?></h1>
    </div> 
    <p class="mb-5 opacity-8 small">  
      <span><?php echo __("Already a member?","premiumpress"); ?></span>  
      <a href="javascript:void(0)" onclick="processLogin();"><?php echo __("Sign In","premiumpress"); ?></a>  
    </p> 
</div>
<?php 
}

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
?>

<div id="ppt-form-error"></div>

<div class="ppt-reg-form">

	<?php $i=0; foreach($fields as $k => $f){  
	
	$defaultVal = "";
	if(isset($_POST[$k])){ $defaultVal = esc_html(strip_tags($_POST[$k])); };
	
	?>
    <div class="form-block block<?php echo $i; ?> <?php if($i ==0){?>active<?php } ?>" data-id="<?php echo $k; ?>" data-type="<?php echo $f['type']; ?>" data-required="<?php if(isset($f['required'])){ echo $f['required']; }else{ echo 1; } ?>"> 
    
<div class="form-wrap">
    
  <?php /*if(isset($f['required']) && $f['required'] == 1){ ?><strong>*</strong><?php }*/ ?>
 
<?php 

switch($f['type']){


case "input":
case "text": { ?>


<div class="form-group position-relative">
<input autocomplete="off" tabindex="<?php echo ($i)+1; ?>"  data-key="<?php echo $k; ?>" placeholder="<?php echo $f['title']; ?>" type="text" class="inputfield" value="<?php echo $defaultVal; ?>" data-fieldblock="block<?php echo $i; ?>">

	<div class="error error-<?php echo $k; ?>" style="right: 10px!important; display:nonex;   position: absolute;    top: 0px;">
    <i class="fa fa-check-circle text-success error error-ok nopos" style="display:none;"></i>
    <i class="fa fa-exclamation-triangle text-danger error error-notok nopos" style="display:none;"></i> <span></span>
	</div>

</div>


<?php } break; 

case "textarea": { ?>
<div>
<textarea autocomplete="off" tabindex="<?php echo ($i)+1; ?>"  data-key="<?php echo $k; ?>" placeholder="<?php echo $f['title']; ?>"  class="inputfield" value="<?php echo $defaultVal; ?>" data-fieldblock="block<?php echo $i; ?>"></textarea>
</div>
<?php } break; 
case "password": { ?>
<div class="form-group position-relative">
<input autocomplete="off" type="password" name="pass1" value="<?php echo $defaultVal; ?>" data-key="<?php echo $k; ?>" tabindex="<?php echo ($i)+1; ?>" class="inputfield" placeholder="<?php echo $f['title']; ?>" data-fieldblock="block<?php echo $i; ?>">

<div class="error error-<?php echo $k; ?>" style="right: 10px!important; display:nonex;   position: absolute;    top: 0px;">

   <i class="fa fa-check-circle text-success error error-ok nopos" style="display:none;"></i>
   <i class="fa fa-exclamation-triangle text-danger error error-notok nopos" style="display:none;"></i> <span></span>

</div>

<ul class="ppt_pas_meter p-0 mt-2"  style="display:none;">
    <li class="strength_meter_block pm1 bg-danger"></li>
    <li class="strength_meter_block pm2 bg-dark"></li>
    <li class="strength_meter_block pm3 bg-dark"></li>
    <li class="strength_meter_block pm4 bg-dark"></li>
    <li class="strength_meter_block pm5 bg-dark"></li>
</ul>

</div>
<?php } 

break;

case "select": { ?>
<div class="form-group position-relative">

<select class="inputfield" data-key="<?php echo $k; ?>" data-fieldblock="block<?php echo $i; ?>">
<option value=""><?php echo $f['title']; ?></option>
<?php if(isset($f['values'])){ $c=0; foreach($f['values'] as $ck => $cv){ ?>
<option value="<?php echo $ck; ?>"><?php echo $cv; ?></option>
<?php $c++; } } ?>
</select>

<i class="fa fa-angle-down"  style="right: 10px!important;    position: absolute;    top: 10px;"></i>
</div>
<?php } 

break;

case "privacy": { ?>





<?php  if(_ppt(array('captcha','enable')) == 1 && _ppt(array('captcha','sitekey')) != "" ){ ?>

<div class="g-recaptcha my-3" data-sitekey="<?php echo _ppt(array('captcha','sitekey')); ?>" ></div>
 
<?php } ?>



<div class="small mt-4 termsbox <?php if(isset($_POST['action'])){ ?>text-center<?php } ?>">
          
<label class="custom-control custom-checkbox mb-0">
          <input type="checkbox" class="custom-control-input" id="privacypolicy" value="1" tabindex="20"  onchange="jQuery('#privacypolicy').prop('disabled', true);" data-fieldblock="block<?php echo $i; ?>">
          <div class="custom-control-label mr-2 font-weight-bold mt-1"> <?php echo __("Accept","premiumpress") ?> <a href="<?php echo _ppt(array('links','terms')); ?>" target="_blank"><?php echo __("Terms &amp; conditions","premiumpress") ?></a> </div>
 </label>
          




 <button type="submit" name="wp-submit" onclick="register_process();" data-ppt-btn class="mt-5 <?php  if( !isset($GLOBALS['blockform']) ){  ?>btn-primary<?php }else{ ?>btn-dark<?php } ?> overflow-hidden">
<?php echo __("Create Account","premiumpress"); ?>
 </button>
        
</div>

<?php }  

case "radio": { ?>

<div class="input-control" style="max-height:300px; overflow:hidden; overflow-y:auto;">
 
 <input type="hidden" class="inputfield" data-key="<?php echo $k; ?>" name="<?php echo $k; ?>" value="<?php echo $defaultVal; ?>" data-fieldblock="block<?php echo $i; ?>" />
 
 <?php if(isset($f['values'])){ $c=0; foreach($f['values'] as $ck => $cv){ ?>
 
 <div class="radiome" data-block="block<?php echo $i; ?>" data-parent="<?php echo $k; ?>" data-value="<?php echo $ck; ?>">
 <?php echo $cv; ?>
 </div>
 
 <?php $c++; } } ?>
 
</div>
 
<?php } break;
 
case "usertype": { 
 

?>
<div class="form-group position-relative"> 
<select class="inputfield" data-key="<?php echo $k; ?>" data-fieldblock="block<?php echo $i; ?>">
<option value=""><?php  echo __("Pick your account type.","premiumpress"); ?></option>
 
<?php foreach($accountTypes as $b => $g){

 
  if( in_array( $b , array("banned","guest","visitor")) ){ continue; } 
  if( THEME_KEY != "es" && in_array( $b , array("agency")) ){ continue; } 
  
  
  
 
?>
<option value="<?php echo $b; ?>"><?php if(isset($g['name'])){ echo $g['name']; }else{ echo $g; } ?></option>
 
<?php } ?>
</select> 
<div class="error error-<?php echo $k; ?>" style="right: 10px!important; display:nonex;   position: absolute;    top: 0px;">

   <i class="fa fa-check-circle text-success error error-ok nopos" style="display:none;"></i>
   <i class="fa fa-exclamation-triangle text-danger error error-notok nopos" style="display:none;"></i> <span></span>

</div>
</div>
<?php } break;

case "checkbox": { ?>
<div class="input-control">
 
 <input type="hidden" class="inputfield" data-key="<?php echo $k; ?>" name="<?php echo $k; ?>" value="<?php echo $defaultVal; ?>" data-fieldblock="block<?php echo $i; ?>" />
 
 <?php if(isset($f['values'])){ $c=0; foreach($f['values'] as $ck => $cv){ ?>
 
 <div class="checkme" data-block="block<?php echo $i; ?>" data-parent="<?php echo $k; ?>" data-value="<?php echo $ck; ?>">
 <?php echo $cv; ?>
 </div>
 
 <?php $c++; } } ?>
 
</div>
<?php } break;


case "username": { 

//$url = parse_url(home_url());
 
?>

<div class="row no-gutters">


<div class="<?php if(defined('THEME_KEY') && !in_array(THEME_KEY,array("sp"))){ ?>col-md-6<?php }else{ ?>col-12<?php } ?>">

    <div class="form-group position-relative">
     
     <div class="usernamevalid" data-valid="" /></div>
    
    <input autocomplete="off" tabindex="<?php echo ($i)+1; ?>"  data-key="<?php echo $k; ?>" placeholder="<?php echo $f['title']; ?>" type="text" maxlength="10" class="inputfield" data-fieldblock="block<?php echo $i; ?>" value="<?php echo $defaultVal; ?>">
     
<div class="error error-<?php echo $k; ?>" style="right: 10px!important; display:nonex;   position: absolute;    top: 0px;">

   <i class="fa fa-check-circle text-success error error-ok nopos" style="display:none;"></i>
   <i class="fa fa-exclamation-triangle text-danger error error-notok nopos" style="display:none;"></i> <span></span>

</div>
    </div>

</div>
<?php if(defined('THEME_KEY') && !in_array(THEME_KEY,array("sp"))){ ?>
<div class="col-md-6 hide-mobile">

<div class="d-flex mt-1">

 
<div class="badge_tooltip text-center float-right" data-direction="top" >
    <div class="badge_tooltip__initiator"> 
   <i class="fal fa fa-info-circle" style="color:#000000"></i></div>
    <div class="badge_tooltip__item" style="width:300px;">
     <?php echo __("Your unique account name. Must be 3 to 10 characters and can include lowercase letters, numbers, and hyphens.","premiumpress"); ?>
     </div>
  </div>
 </div>
</div>
<?php } ?>
</div>

<div id="ajax-username"></div>  
 
 
 
 
<?php } break;

 
 } ?>  
 
 

    </div>
    
    
    </div>
    <?php $i++; } ?>
    
    
    

</div>

<?php 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
 
 
<input type="hidden" name="" id="pptFieldNav" value="0">

 
<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
<script>


var pptFieldOffset = 580;
var pptFieldSavedName = "";
var pptUsernamesSet = 0;
var pptFieldShowError = function(fid){

		jQuery(".error-"+fid).show();
		jQuery(".error-"+fid+' span').html(''); 
		jQuery(".error-"+fid+' .error-notok').show();
		jQuery(".error-"+fid+' .error-ok').hide();
}
var pptFieldShowOk = function(fid){

		jQuery(".error-"+fid).show();
		jQuery(".error-"+fid+' span').html("");
		jQuery(".error-"+fid+' .error-notok').hide();
		jQuery(".error-"+fid+' .error-ok').show();
}

var pptFieldValidation = function(fieldblock){
	
	var type 		= jQuery('.'+fieldblock).attr('data-type');
	var fid 		= jQuery('.'+fieldblock).attr('data-id');
	var required 	= jQuery('.'+fieldblock).attr('data-required');
	
	
	if(typeof type !== 'undefined'){
	
	//console.log(fieldblock+ ' -->' + type+' -- '+fid+' -- '+required);
	
	
		jQuery(".error-"+fid).hide();
		jQuery(".error-"+fid+' span').html('');
		jQuery(".error-"+fid+' .error-notok').hide();
		jQuery(".error-"+fid+' .error-ok').hide();
	
		input = jQuery('.'+fieldblock).find('input');
		jQuery(input).removeClass('required');
		 
		 
		 
		if(required ==1 && ( type == "text" || type == "username" ) && input.val().length < 3){
		 console.log("ppt - form - error - username too short");		 
		 input.focus();
		 jQuery(input).addClass('required');
		 pptFieldShowError(fid);		 
		 return false;		
		}
	
		if(required ==1 && (type == "select" || type == "usertype" ) ){	
		
			input = jQuery('.'+fieldblock+" .inputfield").find(':selected'); 
			if(input.val() == ""){
			 	console.log("ppt - form - error - selection required");	
			 	jQuery('.'+fieldblock+" .inputfield").addClass('required');	
				 pptFieldShowError(fid);	 
			 	return false;
			 }else{
			  pptFieldShowOk(fid);
			 jQuery('.'+fieldblock+" .inputfield").removeClass('required');	
			 }	
		}
		
		if(required ==1 && type == "radio" && input.val().length == 0){	
		  console.log("ppt - form - error - radio required");	
		 jQuery('.form-block.active .radiome').addClass('required');		 
		 return false;		
		}
		
		if(required ==1 && type == "checkbox" && input.val().length == 0){	
		console.log("ppt - form - error - checkedme required");
		 jQuery('.form-block.active .checkme').addClass('required');		 
		 return false;		
		}
				
		if(fid == "user_pass"){
			
			jQuery(".ppt_pas_meter").show();
			
			if(jQuery(".pm5.bg-success").length == 0){
			input.focus();
			 pptFieldShowError(fid);
			 return;
			}else{
			 pptFieldShowOk(fid);
			} 
		
		}
		
		if(fid == "user_email" && !isValidEmail(input.val())){	
		console.log("ppt - form - error - invalid email");	
		 input.focus();
		 jQuery(input).addClass('required');
		 return false;		
		}
		
		if(fid == "username" ){	
		
			jQuery(".username-ok").hide();
			jQuery(".username-error").hide();
			var canContinue = 1;
			jQuery.ajax({
                 type: "POST",
				 dataType: 'json',
                 url: '<?php echo home_url(); ?>/',		
         		data: {
                     action: "validateUsername",
         			 
					un: input.val(),
                 },
                 success: function(response) {         		
         			 
						if( response.status == "ok"){			
						jQuery(".username-ok").show();
						jQuery("#ajax-username").html('');
						jQuery('.usernamevalid').attr('data-valid', 1);
						return true;
												
						}else{						
						 canContinue = 0; 						 
						 console.log("ppt - form - error - invalid username");						
						 jQuery('.usernamevalid').attr('data-valid', 0);						
						 jQuery(".username-error").show();
						 jQuery(input).addClass('required');						 
						 pptFieldShowError(fid);						 
						 return false; 						 
						}					
                 },
                 error: function(e) {
                     alert("error "+e)
                 }
				});			 
		}
		
		 
		
		// SPECIAL
		if(fid == "first_name"){
			
			var str = input.val();
			
			str = str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
			return letter.toUpperCase();
			});
		
			pptFieldSavedName = str;  
			if(pptUsernamesSet ==  0){
				username_generate(pptFieldSavedName);
				pptUsernamesSet=1;
			}
		} 
		
		
		pptFieldShowOk(fid);
	
	}	
	
	
	return true;
	
	
}
 
 


jQuery(document).ready(function(){  
 
	jQuery('.form-block').each(function () {  
	
		jQuery(this).find('input').on('keypress',function(e) {
			jQuery('.nextBtn').show();		
		
		});  
		
	});
	
	jQuery('.inputfield').each(function () {
	
		input = jQuery(this); 
			
		var typingTimer;    
		var doneTypingInterval = 1000; 
			
		jQuery(input).on('keypress',function(e) {
			jQuery(this).focus();		  
		});		
  
		 jQuery(input).on('keyup', function () {
			  clearTimeout(typingTimer);
			  var blockid = jQuery(this).attr('data-fieldblock');
			  typingTimer = setTimeout(function(){ pptFieldValidation(blockid); } , doneTypingInterval);
		});
		   
		jQuery(input).on('keydown', function (e) {
		
		 	var keyCode = e.keyCode || e.which; 
			var blockid = jQuery(this).attr('data-fieldblock');
			
			  if (keyCode == 9) { 
				 
				clearTimeout(typingTimer);
				return pptFieldValidation(blockid);	
				
			  }		
			  clearTimeout(typingTimer);
		}); 
	
	});
	
	jQuery('.checkme').each(function () { 	
	
		jQuery(this).on('click',function(e) {
			
			var blockid = jQuery(this).attr("data-block");
			var input = jQuery("."+blockid).find('input');
			
			if(jQuery(this).hasClass('checked')){
				jQuery(this).removeClass('checked'); 
			 
				input.val(input.val().replace(jQuery(this).attr("data-value")+',',''));
				
			} else {
				jQuery(this).addClass('checked');
				
				input.val(input.val()+jQuery(this).attr("data-value")+',');
			}
			
			 
			
		
		});
	
	});
	
	jQuery('.radiome').each(function () { 	
	
		jQuery(this).on('click',function(e) {
			
			var blockid = jQuery(this).attr("data-block");			
			jQuery("."+blockid+' .radiome').removeClass('checked');
			jQuery(this).addClass('checked');			
			jQuery("."+blockid).find('input').val(jQuery(this).attr("data-value"));
			 
		
		});	
	
	});

});


function switchtypedata(thisid){

	jQuery(".user-type").removeClass('active');
	jQuery(".user-type-"+thisid).addClass('active');
	
	jQuery(".inputfield[data-key='user_type']").val(thisid);
	 

}

<?php 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
?>

function username_generate(name){


	jQuery.ajax({
                type: "POST",
				dataType: 'json',
                url: '<?php echo home_url(); ?>/',		
         	data: {
                     action: "ajax_username_generate",
         			name: name, 
                 },
               success: function(response) {
         		 
         			if(response.status == "ok"){
					
					jQuery(".ajax-username").html('');
					jQuery.each(response.data, function(key, val) {							 
							 
						jQuery("#ajax-username").append('<div class="usertry" data-block="block" data-parent="username" data-value="'+val+'">'+val+'</div>');
						
					});
					
					
					jQuery('.usertry').each(function () { 	
					
						jQuery(this).on('click',function(e) {
						
							var input = jQuery('input[data-key="username"]');
							
							 jQuery(".usertry").removeClass('checked');
							 
							jQuery(this).addClass('checked');
								
							input.val(jQuery(this).attr("data-value")); 	
							 					
						
						});	
					
					});
					
						 
         			
         			} 		
                 },
                 error: function(e) {
                     alert("error "+e)
                 }
	});

}


 
<?php 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
?>

function register_process(){

 

var CanContinue = 1;

jQuery("#ppt-form-error").html('');

// PRIVACY POLCIY
if(!jQuery("#privacypolicy").is(':checked')){
	jQuery("#ppt-form-error").addClass('text-danger mb-4').html("<?php echo __("You must accept our privacy policy to join our website.","premiumpress") ?>");
	CanContinue =0;
	return;
}
 
// LOOP AND VALIDATE
jQuery('.inputfield').each(function () {  
	if(!pptFieldValidation(jQuery(this).attr('data-fieldblock'))){	
		console.log("invalid "+jQuery(this).attr('data-fieldblock'));
		CanContinue =0;
	}
});
 
  
var formdata = {};
var requiredFields = [];

jQuery('.form-block[data-required="1"]').each(function () {   
		requiredFields.push(jQuery(this).attr('data-id'));	
});

 // GOOGLE RECAPTURE
if(jQuery("#g-recaptcha-response").length > 0){
	jQuery("#g-recaptcha-response").attr('data-key','g-recaptcha-response').addClass('inputfield');
}

// INPUT FIELD 
jQuery('.inputfield').each(function () {
 	  //console.log(jQuery(this).attr('data-key') + ' == ' + jQuery(this).val() + ' -- ' + jQuery.inArray(jQuery(this).attr('data-key'), requiredFields) );
  
	  if(jQuery(this).val() == ""){	  	
		if(jQuery.inArray(jQuery(this).attr('data-key'), requiredFields) == -1){		
		}else{		
		//console.log(jQuery(this).attr('data-key')+' <-- missed field');
		return;		
		}	  
	  }	
	  formdata[jQuery(this).attr('data-key')] = jQuery(this).val();   
}); 
 
 
if(CanContinue == "1"){ 

jQuery('#ppt-form-loading').html('<div class="text-center text-primary"><i class="fa fa-spinner fa-3x fa-spin"></i></div>');
jQuery('.ppt-reg-form').hide();
jQuery('.ppt-form-titlebit').hide();
     
   jQuery.ajax({
        type: "POST",
        url: ajax_site_url,	
		dataType: 'json',	
		enctype: 'multipart/form-data',
   		data: {
               action: "register_process", 
			   data: formdata,		 
           },
           success: function(response) {
		    
				 if(response.status == "error"){				 
				 
				 	jQuery("#ppt-form-loading").addClass('text-danger mb-4').html(response.msg);
					 
					jQuery('.ppt-reg-form').show(); 
   
					jQuery("#pptFieldNav").val(1);
				 
				 
				 }else if(response.status == "func_mem"){				 	
					
					jQuery(".ppt-modal-wrap").removeClass('show');	
					
					processNewPayment(response.link);
					
					jQuery("#wp-submit-register").attr("disabled", false);					
					
				 }else if(response.status == "reload"){
				 
				 	window.location.reload();
				 
				 }else if(response.status == "ok"){
				 	
					<?php if(isset($_GET['membership']) && $_GET['membership'] == -1 && _ppt(array('mem','enable')) == 1){ ?>
					
					window.location.href= "<?php echo _ppt(array('links','memberships')); ?>";
					<?php }else{ ?>
					window.location.href= response.link;
					<?php } ?>
				 	
				 } 
   			
           },
           error: function(e) {
               console.log(e); 
           }
       }); 

}

}


<?php 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if(1==1){ // _ppt(array('register','password')) == '1'  ?> 
 

jQuery( document ).ready( function() {
	
	jQuery( 'body' ).on( 'keyup', 'input[name=pass1]', function( event ) {
	
	pass_strenght_meter();
	
	});

	pass_strenght_meter();
	  
});

function ShowPass(){

	if(jQuery('input[name=pass1]').prop('type') == "text"){	
		jQuery('input[name=pass1]').prop('type', 'password');	
	}else{	
		jQuery('input[name=pass1]').prop('type', 'text');	
	}
}
function pass_strenght_meter(){
	
	var PassLen = jQuery('input[name=pass1]').val().length;
 
    // calculate the password strength
	if(PassLen < 5 ){	
		pwdStrength = PassLen;	
	}else if(PassLen == 5 ){
		pwdStrength =  4;
	}else if(PassLen > 5){
		pwdStrength =  5;
	}
   
	 	
	jQuery('.pm1, .pm2, .pm3, .pm4, .pm5').removeClass('bg-dark').removeClass('bg-danger').removeClass('bg-warning').removeClass('bg-success'); 	
	 

	// check the password strength
	switch ( pwdStrength ) {
	
		case 2: {
		
		jQuery('.pm1').addClass('bg-danger');
		jQuery('.pm2').addClass('bg-danger');
		jQuery('.pm3').addClass('bg-dark');
		jQuery('.pm4').addClass('bg-dark');
		jQuery('.pm5').addClass('bg-dark');	
		
		
		} break;
	
		case 3: {
		
		jQuery('.pm1').addClass('bg-warning');
		jQuery('.pm2').addClass('bg-warning');
		jQuery('.pm3').addClass('bg-warning');
		jQuery('.pm4').addClass('bg-dark');
		jQuery('.pm5').addClass('bg-dark');	
		
		
		} break;
	
		case 4: {
		
		jQuery('.pm1').addClass('bg-warning');
		jQuery('.pm2').addClass('bg-warning');
		jQuery('.pm3').addClass('bg-warning');
		jQuery('.pm4').addClass('bg-warning');
		jQuery('.pm5').addClass('bg-dark');	
		
		
		} break;
	
		case 5: {
		
		jQuery('.pm1').addClass('bg-success');
		jQuery('.pm2').addClass('bg-success');
		jQuery('.pm3').addClass('bg-success');
		jQuery('.pm4').addClass('bg-success');
		jQuery('.pm5').addClass('bg-success');	
		 
	
		} break;
	
		default: {
		
		jQuery('.pm1').addClass('bg-danger');
		jQuery('.pm2').addClass('bg-dark');
		jQuery('.pm3').addClass('bg-dark');
		jQuery('.pm4').addClass('bg-dark');
		jQuery('.pm5').addClass('bg-dark');		
		
		
		} break;
	
	}
} 

</script>


<?php } 

 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


?>

</script> 

<style>

select {
  -webkit-appearance: none;
  -moz-appearance: none;
  text-indent: 1px;
  text-overflow: '';
}

.ppt_pas_meter { height:2px; height: 4px;    overflow: hidden; }
 
.ppt-reg-form { max-width: 700px; }
.ppt-reg-form .form-block {  margin-bottom:20px;   }
.ppt-reg-form .inputfield {display: block;    width: 100%;    font-family: inherit; color: #000;    padding: 0px 0px 8px; border: none; outline: none;font-size: 18px;-webkit-font-smoothing: antialiased;line-height: unset;   animation: 1ms ease 0s 1 normal none running native-autofill-in;transition: background-color 1e+08s ease 0s, box-shadow 0.1s ease-out 0s;box-shadow: #0000000d 0px 1px !important;    background-color: transparent !important;}

.ppt-forms.dark .ppt-reg-form .inputfield { color:#fff!important; box-shadow: #ffffff78 0px 1px !important;}
.ppt-forms.dark .radiome.checked {
    background-color: #3f3f3f!important;
}
.ppt-reg-form .inputfield::placeholder {  color: #666;  opacity: 1;}
.ppt-reg-form .inputfield:-ms-input-placeholder {  color: #666;}
.ppt-reg-form .inputfield::-ms-input-placeholder {  color: #666;}
.ppt-reg-form .form-wrap { }
.ppt-reg-form  ._title { display:inline-block; font-size:16px; margin-bottom:10px;  }
.ppt-reg-form  ._title span { font-weight:600; }

 
.inputfield.required { box-shadow: red 0px 2px !important; }

.checkme { cursor:pointer; display: inline-flex; border-radius: 0.25rem; border: 1px solid #dee2e6;     font-weight: 700; padding: 1rem; margin-bottom: 20px;  margin-right:10px; }
.checkme.checked { background-color: #fafafb; box-shadow: 0 .125rem .25rem rgba(0,0,0,.035); }
.checkme.required {    border: 1px solid red!important;}


.usertry { cursor:pointer; display: inline-flex; border-radius: 0.25rem; border: 1px solid #dee2e6; font-weight: 500; font-size:14px; padding: 5px 10px; margin-bottom: 20px; margin-right:10px; }
.usertry.checked { background-color: #fafafb; box-shadow: 0 .125rem .25rem rgba(0,0,0,.035); }
 
.radiome { cursor:pointer; border-radius: 0.25rem; border: 1px solid #dee2e6;     font-weight: 700; padding: 1rem; margin-bottom: 20px; }
.radiome.checked { background-color: #fafafb; box-shadow: 0 .125rem .25rem rgba(0,0,0,.035); }
.radiome.required {    border: 1px solid red!important;}

.user-type.active .ppt-category-image { border: 3px solid red!important;}
@media (max-width: 575.98px) { .ppt-reg-form .inputfield {font-size: 18px;} .usertry { padding:10px; } }


select:first-child {
  color: #666!important;
}

</style>