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


$fields["first_name"] 	= array( "title" => "<strong>".__("Welcome!","premiumpress")."</strong><br>".__("Let's start with your <span>first name</span>.","premiumpress"), "css" => "", "type" => "text", "required" => 1);

if(_ppt(array('register','username')) == 1){
$fields["username"] 	= array( "title" => __("Pick a username <span></span>","premiumpress"), "css" => "", "type" => "username", "required" => 1);
}
 

if( in_array(THEME_KEY, array("da" )) ){

	$count = 1; $vals = array();
	$cats = get_terms( 'dagender', array( 'hide_empty' => 0, 'parent' => 0  ));
	if(!empty($cats)){
		
		foreach($cats as $cat){ 
		
			if($cat->parent != 0){ continue; } 
			 
			$vals[$cat->term_id] = ppt_theme_text_switch($cat->slug, $CORE->GEO("translation_tax", array($cat->term_id, $cat->name)) ); //$CORE->GEO("translation_tax", array($cat->term_id, $cat->name));
		 
		} 
	
		$fields["user_interest"] = array( "title" => __("What are you looking for?","premiumpress"), "type" => "radio", "required" => 1, "values" => $vals);	
	
	} 
}


/*
$accountTypes = $CORE->USER("get_account_type_all", array());
if(!empty( $accountTypes ) ){
$fields["user_type"] 	= array( "title" => __("Welcome to our website <span></span>.","premiumpress"), "type" => "usertype", "required" => 1);
}
*/

 
	
$fields["user_email"] 	= array( "title" => __("What <span>email address</span> should we use to contact you?","premiumpress"), "type" => "text", "required" => 1);

if( _ppt(array('register','password')) == '1'){
$fields["user_pass"] 	= array( "title" => __("Create a password for your new account.","premiumpress"), "type" => "password", "required" => 1);

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


$fields["privacy"] = array( "title" => "Finally, do you accept our Privacy Policy?", "type" => "radio", "values" => array("yes" => __("Yes","premiumpress"), "no" => __("No","premiumpress") ) );
		

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

//hook_register_top(); 

?>
<div id="ppt-form-loading"></div>

<div class="ppt-reg-form">

	<?php $i=0; foreach($fields as $k => $f){  
	
	$defaultVal = "";
	if(isset($_POST[$k])){ $defaultVal = esc_html(strip_tags($_POST[$k])); };
	
	?>
    <div class="form-block block<?php echo $i; ?> <?php if($i ==0){?>active<?php } ?>" data-id="<?php echo $k; ?>" data-type="<?php echo $f['type']; ?>" data-required="<?php if(isset($f['required'])){ echo $f['required']; }else{ echo 1; } ?>"> 
    
    <div class="form-wrap">
    
    <div class="_title"><?php echo $f['title']; ?></div> <?php /*if(isset($f['required']) && $f['required'] == 1){ ?><strong>*</strong><?php }*/ ?>
 
<?php 

switch($f['type']){


case "input":
case "text": { ?>
<div>
<input autocomplete="off" tabindex="<?php echo ($i)+1; ?>"  data-key="<?php echo $k; ?>" placeholder="<?php echo __("Type your answer here...","premiumpress"); ?>" type="text" class="inputfield" value="<?php echo $defaultVal; ?>"  data-fieldblock="block<?php echo $i; ?>">
</div>

<div id="ajax-<?php echo $k; ?>"></div>

<?php } break; 

case "textarea": { ?>
<div>
<textarea autocomplete="off" tabindex="<?php echo ($i)+1; ?>"  data-key="<?php echo $k; ?>" placeholder="<?php echo __("Type your answer here...","premiumpress"); ?>"  class="inputfield"  data-fieldblock="block<?php echo $i; ?>" value="<?php echo $defaultVal; ?>"></textarea>
</div>
<?php } break; 
case "password": { ?>
<div class="form-group position-relative">
<input autocomplete="off" type="password" name="pass1" value="<?php echo $defaultVal; ?>" data-key="<?php echo $k; ?>" tabindex="<?php echo ($i)+1; ?>" class="inputfield"  data-fieldblock="block<?php echo $i; ?>" placeholder="<?php echo __("Enter a password here...","premiumpress"); ?>">

<i class="fa fa-eye" style="right: 10px!important;    position: absolute;    top: 10px;"  onclick="ShowPass();"></i>               

<ul class="ppt_pas_meter p-0 mt-2" >
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

<select class="inputfield" data-key="<?php echo $k; ?>"  data-fieldblock="block<?php echo $i; ?>" tabindex="<?php echo ($i)+1; ?>" >
<?php if(isset($f['values'])){ $c=0; foreach($f['values'] as $ck => $cv){ ?>
<option value="<?php echo $ck; ?>"><?php echo $cv; ?></option>
<?php $c++; } } ?>
</select>

<i class="fa fa-angle-down"  style="right: 10px!important;    position: absolute;    top: 10px;"></i>
</div>
<?php } 

break;

case "radio": { ?>

<div class="input-control" style="max-height:300px; overflow:hidden; overflow-y:auto;">
 
 <input type="hidden" class="inputfield" data-key="<?php echo $k; ?>" name="<?php echo $k; ?>"  data-fieldblock="block<?php echo $i; ?>" value="<?php echo $defaultVal; ?>" />
 
 <?php if(isset($f['values'])){ $c=0; foreach($f['values'] as $ck => $cv){ ?>
 
 <div class="radiome" data-block="block<?php echo $i; ?>" data-parent="<?php echo $k; ?>" data-value="<?php echo $ck; ?>" <?php if($k == "privacy"){ ?>onclick="register_process('<?php echo $ck; ?>');"<?php } ?>>
 <?php echo $cv; ?>
 </div>
 
 <?php $c++; } } ?>
 
</div>

<div id="ajax-<?php echo $k; ?>"></div>

<?php } break;
 
case "usertype": { 

$shown = 0; 

?>

<input type="hidden" class="inputfield"  data-key="<?php echo $k; ?>" name="<?php echo $k; ?>"  data-fieldblock="block<?php echo $i; ?>" value="<?php echo $defaultVal; ?>" />
 


<h5 class="mb-4 introtxt text-primary" id="whichdesc"><?php  echo __("Pick your account type.","premiumpress"); ?></h5>

<div class="row form-usertype-fields">
<?php foreach($accountTypes as $b => $g){ 

  if( in_array(_ppt(array("usertype",$b)), array("","1")) ){ }else{ continue; } 

  // IMAGE
  $IMAGE = $g['img'];
  if(strlen(_ppt(array("usertype",$b."_image"))) > 5 ){
  $IMAGE =  _ppt(array("usertype",$b."_image"));
  }
  
  $shown++;
?>

<?php if($IMAGE == ""){ ?>
<div class="col-12 mb-4"> 

<a class="text-dark user-type user-type-<?php echo $b; ?>" href="javascript:void(0);" onclick="switchtypedata('<?php echo $b; ?>')">
<h6 class="mt-3 text-left p-3 font-weight-bold text-center rounded bg-light"><span class="opacity-5"><?php if(isset($g['name'])){ echo $g['name']; }else{ echo $g; } ?></span></h6>
</a> 

</div>

<?php }else{ ?>

<div class="col-6 mb-4"> 

<a class="text-dark user-type user-type-<?php echo $b; ?>" href="javascript:void(0);" onclick="switchtypedata('<?php echo $b; ?>')">
<div class="ppt-category-image rounded-lg" style="background-image: url(<?php echo $IMAGE; ?>);"></div>
<h6 class="mt-3 text-center"><?php if(isset($g['name'])){ echo $g['name']; }else{ echo $g; } ?></h6>
</a> 

</div>
<?php } ?>

<?php } ?>

</div>


<?php } break;

case "checkbox": { ?>
<div class="input-control">
 
 <input type="hidden" class="inputfield"  data-key="<?php echo $k; ?>" name="<?php echo $k; ?>" value="<?php echo $defaultVal; ?>"  data-fieldblock="block<?php echo $i; ?>" />
 
 <?php if(isset($f['values'])){ $c=0; foreach($f['values'] as $ck => $cv){ ?>
 
 <div class="checkme" data-block="block<?php echo $i; ?>" data-parent="<?php echo $k; ?>" data-value="<?php echo $ck; ?>">
 <?php echo $cv; ?>
 </div>
 
 <?php $c++; } } ?>
 
</div>
<?php } break;


case "username": { ?>
<div class="form-group position-relative mb-4">
 
 <div class="usernamevalid" data-valid="" /></div>

<input autocomplete="off" tabindex="<?php echo ($i)+1; ?>"  data-key="<?php echo $k; ?>" maxlength="10"  data-fieldblock="block<?php echo $i; ?>" placeholder="<?php echo __("or enter your own here...","premiumpress"); ?>" type="text" class="inputfield" value="<?php echo $defaultVal; ?>">
 
<i class="fa fa-check-circle text-success username-ok" style="display:none;"></i>
<i class="fa fa-exclamation-triangle text-danger username-error" style="display:none;"></i>

</div>
<div id="ajax-username"></div>  
 
 
 
 
<?php } break;

 
 } ?>  
 
<?php if($k != "user_type"){ ?>
    <div style="height:50px;">
    <?php if($k != "privacy"){ ?>
    <a href="javascript:void(0);" onclick="pptFieldMove('up');" class="nextBtn btn btn-system mt-3" style="display:none;"><?php echo __("Next","premiumpress"); ?></a>
    <?php } ?>
    <?php if(isset($f['required']) && $f['required'] == 0){ ?>
    <a href="javascript:void(0);" onclick="pptFieldMove('up');" class="nextBtn btn btn-system mt-3"><?php echo __("Skip","premiumpress"); ?></a>
    <?php } ?>
    </div> 
<?php } ?>

    </div>
    
    
    </div>
    <?php $i++; } ?>
    
    
    

</div>

<?php 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
<div class="ppt-reg-form-nav">
<div class="bg-primary d-inline-flex">
<div class="border-right p-2 px-3"><a href="javascript:void(0)" onclick="pptFieldMove('down');" class="text-white"><i class="fa fa-arrow-up"></i></a></div>
<div class="p-2 px-3"><a  href="javascript:void(0)"  onclick="pptFieldMove('up');" class="text-white"><i class="fa fa-arrow-down"></i></a></div>
</div>
</div>
 
<input type="hidden" name="" id="pptFieldNav" value="0">

<?php 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
?>

<p class="mt-4 opacity-8 small">
  
  <span><?php echo __("Already a member?","premiumpress"); ?></span>
  
  <a href="javascript:void(0)" onclick="processLogin();"><?php echo __("Sign In","premiumpress"); ?></a>
  
 </p> 
 
<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
<script>


var pptFieldOffset = 580;
var pptFieldSavedName = "";
var pptUsernamesSet =0;
var pptFieldValidation = function(fieldblock){
	
	
	if(fieldblock != 0){
	
	var type 		= jQuery('.'+fieldblock).attr('data-type');
	var fid 		= jQuery('.'+fieldblock).attr('data-id');
	var required 	= jQuery('.'+fieldblock).attr('data-required');

	}else{	
	
	var type 		= jQuery('.form-block.active').attr('data-type');
	var fid 		= jQuery('.form-block.active').attr('data-id');
	var required 	= jQuery('.form-block.active').attr('data-required');
	
	}
	
	console.log(fieldblock+ ' -->' + type+' -- '+fid+' -- '+required);
	
	if(typeof type !== 'undefined'){
	
		input = jQuery('.form-block.active').find('input');
		jQuery(input).removeClass('required');
		 
		if(required ==1 && ( type == "text" || fid == "username" ) && input.val().length < 3){		 
		 input.focus();
		 jQuery(input).addClass('required');
		 return false;		
		}
		
		if(required ==1 && type == "radio" && input.val().length == 0){	
		 jQuery('.form-block.active .radiome').addClass('required');		 
		 return false;		
		}
		
		if(required ==1 && type == "checkbox" && input.val().length == 0){	
		 jQuery('.form-block.active .checkme').addClass('required');		 
		 return false;		
		}		
		
		if(fid == "user_email" && !isValidEmail(input.val())){		
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
		
		if(fid == "privacy" && input.val() != "yes"){	 
		 jQuery(".checkme").addClass('required');
		 return false;
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
	
	}	
	
	
	return true;
	
	
}
var pptFieldSpecial = function(){

	var fid = jQuery('.form-block.active').attr('data-id');
	
	if(fid == "user_email" && pptFieldSavedName != ""){	
		//var cc = jQuery("div[data-id='user_email'] ._title span").html();	
		//jQuery("div[data-id='user_email'] ._title span").html(cc + ', '+pptFieldSavedName);		
	}	
	if(fid == "user_type" && pptFieldSavedName != ""){		
		jQuery("div[data-id='user_type'] ._title span").html(pptFieldSavedName);		
	}
	
	if(fid == "username" && pptFieldSavedName != ""){		
		jQuery("div[data-id='username'] ._title span").html(pptFieldSavedName);		
	}
	
	if(fid == "user_interest" && pptFieldSavedName != ""){		
		jQuery("div[data-id='user_interest'] ._title span").html(pptFieldSavedName);		
	}
	
}



var pptFieldMove = function(way){
 	
	// VALIDATION
	if(way == "up" && !pptFieldValidation(0)){
	return;
	}
	
	var cc = jQuery("#pptFieldNav").val();
	if(way == "up"){
		var nn =  parseFloat(cc) +1;
		if(cc < <?php echo count($fields); ?>){ jQuery("#pptFieldNav").val(nn);		}
	}else{
		var nn =  parseFloat(cc) -1;
		if(cc > 0){	jQuery("#pptFieldNav").val(nn);		}
	}
	
	if(jQuery('.block' + nn).length > 0){ 
		jQuery('.form-block').removeClass('active');
		jQuery('.block' + nn).addClass('active');
		
		pptFieldSpecial();
		
		input = jQuery('.form-block.active').find('input,textarea,select');
		input.focus();
		
		jQuery('.ppt-reg-form').animate({  scrollTop:  pptFieldOffset*nn }, 500); 
 	} 
	
}
 

jQuery(document).on('keypress',function(e) {
    if(e.which == 13) {
        pptFieldMove("up");
    }
});

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
			  console.log("tabbed "+blockid);
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
			
			pptFieldMove("up");
			
		
		});
	
	});
	
	jQuery('.radiome').each(function () { 	
	
		jQuery(this).on('click',function(e) {
			
			var blockid = jQuery(this).attr("data-block");			
			jQuery("."+blockid+' .radiome').removeClass('checked');
			jQuery(this).addClass('checked');			
			jQuery("."+blockid).find('input').val(jQuery(this).attr("data-value"));
			
			pptFieldMove("up");
		
		});	
	
	});

});


function switchtypedata(thisid){

	jQuery(".user-type").removeClass('active');
	jQuery(".user-type-"+thisid).addClass('active');
	
	jQuery(".inputfield[data-key='user_type']").val(thisid);
	
	pptFieldMove("up");

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
							
							pptFieldMove("up");						
						
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

function register_process(privcy_value){

 
if(privcy_value != "yes"){

jQuery("#ajax-privacy").addClass('text-danger').html("<?php echo __("You must accept our privacy policy to join our website.","premiumpress") ?>");
return;
}

// CHECK USERNAME
if(jQuery('.usernamevalid').length > 0 && jQuery('.usernamevalid').attr('data-valid') == "0"){

	jQuery("#ppt-form-loading").addClass('text-danger mb-4').html("<?php echo __("Username is already taken.","premiumpress") ?>");
	jQuery('.ppt-reg-form').show();
	jQuery('.ppt-reg-form-nav').show();
	jQuery("#pptFieldNav").val(0);
	pptFieldMove("up");
	
	return;
}


  
  var formdata = {};
  var requiredFields = [];
  
  jQuery('.form-block[data-required="1"]').each(function () {   
		requiredFields.push(jQuery(this).attr('data-id'));	
  });
 
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
  

 
jQuery('#ppt-form-loading').html('<div class="text-center text-primary"><i class="fa fa-spinner fa-3x fa-spin"></i></div>');
jQuery('.ppt-reg-form').hide();
jQuery('.ppt-reg-form-nav').hide();
    
  
  
     
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
					jQuery('.ppt-reg-form-nav').show();
   
					jQuery("#pptFieldNav").val(1);
					pptFieldMove("up");
				 
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


<?php 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if( _ppt(array('register','password')) == '1'){  ?> 
 

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


/*
	  if(_ppt(array('captcha','enable')) == 1 && _ppt(array('captcha','sitekey')) != "" ){ ?>
      
      <div class="g-recaptcha my-3 ml-3" data-sitekey="<?php echo stripslashes(_ppt(array('captcha','sitekey'))); ?>" id="g-recaptcha-id"></div>
      
      <?php }else{ $reg_nr1 = rand("0", "9"); $reg_nr2 = rand("0", "9"); ?>
      <div class="col-xs-12 col-md-12">
     
          <div class="row">
         
            <div class="col-md-12">   <div class="form-group  position-relative">
            
            
            <i class="fa fa-shield"></i>
             
          
                <input type="text" name="reg_val" id="user_code" data-codep="<?php echo ($reg_nr1+$reg_nr2); ?>" tabindex="7" class="form-control required"  placeholder="<?php echo __("What is:","premiumpress") ?>  <?php echo $reg_nr1; ?> + <?php echo $reg_nr2; ?> =">
              
               
               <input type="hidden" name="reg1" value="<?php echo $reg_nr1; ?>" />
                <input type="hidden" name="reg2" value="<?php echo $reg_nr2; ?>" />
             
            </div>
          </div>
        </div>
      </div>
      <?php } 
	  
*/

?>

</script> 

<style>

.ppt-reg-form { height:580px;  overflow:hidden;  }
.ppt-reg-form .form-block {     width: 100%;    min-height: 100%;    display: flex;    flex-direction: column;    -webkit-box-pack: center;    justify-content: center; }
.ppt-reg-form .inputfield {display: block;    width: 100%;    font-family: inherit; color: #000;    padding: 0px 0px 8px; border: none; outline: none;font-size: 26px;-webkit-font-smoothing: antialiased;line-height: unset;   animation: 1ms ease 0s 1 normal none running native-autofill-in;transition: background-color 1e+08s ease 0s, box-shadow 0.1s ease-out 0s;box-shadow: #0000000d 0px 1px !important;    background-color: transparent !important;}

.ppt-forms.dark .ppt-reg-form .inputfield { color:#fff!important; box-shadow: #ffffff78 0px 1px !important;}
.ppt-forms.dark .radiome.checked {
    background-color: #3f3f3f!important;
}
.ppt-reg-form .inputfield::placeholder {  color: #ccc;  opacity: 1;}
.ppt-reg-form .inputfield:-ms-input-placeholder {  color: #ccc;}
.ppt-reg-form .inputfield::-ms-input-placeholder {  color: #ccc;}
.ppt-reg-form {margin-top:-100px; } 
.ppt-reg-form .form-wrap { }
.ppt-reg-form  ._title { display:inline-block; font-size:26px; margin-bottom:20px;  }
.ppt-reg-form  ._title span { font-weight:600; }


.ppt-reg-form-nav { margin-bottom:30px; }
.inputfield.required { box-shadow: red 0px 2px !important; }

.checkme { cursor:pointer; display: inline-flex; border-radius: 0.25rem; border: 1px solid #dee2e6;  font-weight: 700; padding: 1rem; margin-bottom: 20px;  margin-right:10px; }
.checkme.checked { background-color: #fafafb; box-shadow: 0 .125rem .25rem rgba(0,0,0,.035); }
.checkme.required {    border: 1px solid red!important;}


.usertry { cursor:pointer; display: inline-flex; border-radius: 0.25rem; border: 1px solid #dee2e6; font-size:16px; font-weight: 700; padding: 10px; margin-bottom: 20px; margin-right:10px; }
.usertry.checked { background-color: #fafafb; box-shadow: 0 .125rem .25rem rgba(0,0,0,.035); }
 
.radiome { cursor:pointer; border-radius: 0.25rem; border: 1px solid #dee2e6;     font-weight: 700; padding: 1rem; margin-bottom: 20px; }
.radiome.checked { background-color: #fafafb; box-shadow: 0 .125rem .25rem rgba(0,0,0,.035); }
.radiome.required {    border: 1px solid red!important;}

.user-type.active .ppt-category-image { border: 3px solid red!important;}
@media (max-width: 575.98px) { .ppt-reg-form .inputfield {font-size: 18px;} .usertry { padding:10px; } }
</style>