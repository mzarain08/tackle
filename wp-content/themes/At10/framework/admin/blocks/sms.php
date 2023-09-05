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

global $userdata;

?>

<div class="container px-0 border-bottom mb-3 pb-3 ">
  <div class="row">
  
  <div class="col-md-8">
      <label><?php echo __("Enable SMS System","premiumpress"); ?></label>
        <p class="pb-0 btn-block text-muted mb-0"><?php echo __("Turn on/off the SMS integration","premiumpress"); ?></p>
    </div>  

    <div class="col-md-4">
    
      <div class="input-group mb-2">
        <div class="formrow">
          <div class="">
            <label class="radio off" style="display: none;">
            <input type="radio" name="toggle" 
                                      value="off" onchange="document.getElementById('smsenable').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
                                      value="on" onchange="document.getElementById('smsenable').value='1'">
            </label>
            <div class="toggle <?php if( in_array(_ppt(array("sms","enable")), array("1")) ){  ?>on<?php } ?>">
              <div class="yes">ON</div>
              <div class="switch"></div>
              <div class="no">OFF</div>
            </div>
            <input type="hidden" id="smsenable" name="admin_values[sms][enable]"  value="<?php if( in_array(_ppt(array("sms","enable")), array("1")) ){ echo 1; }else{ echo 0; } ?>">
          </div>
        
        </div>
      </div>
    </div>
 </div>

</div>




   


<div class="container px-0 border-bottom mb-3 pb-3 ">
  <div class="row">
  
  <div class="col-md-8">
      <label><?php echo __("Force SMS Verification","premiumpress"); ?></label>
        <p class="pb-0 btn-block text-muted mb-0"><?php echo __("Turn on to stop users accessing their account until they enter a pin code sent to their mobile number.","premiumpress"); ?></p>
    </div>  

    <div class="col-md-4">
    
      <div class="input-group mb-2">
        <div class="formrow">
          <div class="">
            <label class="radio off" style="display: none;">
            <input type="radio" name="toggle" 
                                      value="off" onchange="document.getElementById('force').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
                                      value="on" onchange="document.getElementById('force').value='1'">
            </label>
            <div class="toggle <?php if( in_array(_ppt(array("sms","force")), array("1")) ){  ?>on<?php } ?>">
              <div class="yes">ON</div>
              <div class="switch"></div>
              <div class="no">OFF</div>
            </div>
            <input type="hidden" id="force" name="admin_values[sms][force]"  value="<?php if( in_array(_ppt(array("sms","force")), array("1")) ){ echo 1; }else{ echo 0; } ?>">
          </div>
        
        </div>
      </div>
    </div>
 </div>

</div>





<div class="container px-0 border-bottom mb-3 pb-3 ">
  <div class="row">
  
  <div class="col-md-6">
      <label><?php echo __("SMS Provide","premiumpress"); ?></label>
        <p class="pb-0 btn-block text-muted mb-0"><?php echo __("Here you can choose which service to use for your SMS provider.","premiumpress"); ?></p>
     
    <?php
	
	$g = _ppt(array("sms","provider"));
	
	?>
    
      <select name="admin_values[sms][provider]" class="mt-4 form-control" style="width:100%" onchange="ChangeProvider(this.value)">
         <option></option>
          <?php foreach(array(
		  
		  "nexmo" => array("name" => "Nexom" ),
		   "msg91" => array("name" => "msg91" )
		  
		  ) as $r => $rs){ ?>
          
           <option value="<?php echo $r; ?>" <?php if( $g  ==  $r){ echo "selected=selected"; } ?>><?php echo $rs['name']; ?></option>   
         
          <?php } ?>
            
           
          </select>
          
          
<div>


</div>
          
<script>

function ChangeProvider(p){

	jQuery(".provider").hide();
	
	jQuery(".provider_"+p).show();
	jQuery("#cansendSingle").hide();
	jQuery("#cansendBulk").hide();
	
	if(p == "msg91"){		
		jQuery("#testSMS").show();
 	}
	
	if(p == "nexmo"){
		jQuery("#testSMS").show();
	}
	
	
}
jQuery(document).ready(function(){ 
ChangeProvider('<?php echo $g; ?>');
});
</script>
             
    </div>  

    <div class="col-md-6">

          

<?php if(function_exists('current_user_can') && current_user_can('administrator')){ ?>


 <div class="row mt-3 provider provider_msg91" style="display:none;">
 
<div class="col-12">
 <div class="text-600">Msg91 OTP Integration</div>
 
 <div class="mb-4 small opacity-5"><a href="https://msg91.com" target="_blank" class="text-dark">https://msg91.com</a></div>
 
</div>
	<div class="col-12"> 
    
     <label><?php echo __("API Key","premiumpress"); ?></label>
         <input type="text" name="admin_values[sms][msg91_api]" class="form-control"  value="<?php echo _ppt(array("sms","msg91_api")); ?>">  
     </div>
     
     <div class="col-12 mt-2">
     
      <label> <?php echo __("Sender ID","premiumpress"); ?>   </label>
          <input name="admin_values[sms][msg91_id]" class="form-control" type="text"  value="<?php echo _ppt(array("sms","msg91_id")); ?>">   
     
     </div>
     
     <div class="col-12 mt-2">
     
      <label> <?php echo __("Template ID","premiumpress"); ?>   </label>
          <input name="admin_values[sms][msg91_tid]" class="form-control" type="text"  value="<?php echo _ppt(array("sms","msg91_tid")); ?>">   
     
     </div>


 </div>
 
    <div class="row mt-3 provider provider_nexmo" style="display:none;"> 
   


<div class="col-12">
 <div class="text-600">NEXMO Integration</div>
 
 <div class="mb-4 small opacity-5"><a href="https://www.nexmo.com/" target="_blank" class="text-dark">https://www.nexmo.com</a></div>
 
</div>

    <div class="col-12"> 
         
     <label><?php echo __("NEXMO API Key","premiumpress"); ?></label>
         <input type="text" name="admin_values[sms][nexmo_api]" class="form-control"  value="<?php echo _ppt(array("sms","nexmo_api")); ?>">  
     </div>
     <div class="col-12 mt-2">
     
      <label> <?php echo __("NEXMO Secret Key","premiumpress"); ?>   </label>
          <input name="admin_values[sms][nexmo_key]" class="form-control" type="text"  value="<?php echo _ppt(array("sms","nexmo_key")); ?>">   
     
     </div>
     
     <?php /*
     <div class="col-12 mt-2">
     
      <label> <?php echo __("SMS FROM Name","premiumpress"); ?>   </label>
          <input name="admin_values[sms][nexmo_from]" class="form-control" type="text"  value="<?php echo _ppt(array("sms","nexmo_from")); ?>" placeholder="ALERT" maxlength="10">   
        
        
        </div>*/ ?>
  
  </div>
  
 

<?php } 
 
?>
 
      
      
    </div>
 </div> 
</div>


<div class="container px-0 border-bottom mb-5 pb-3 " style="display:none;" id="testSMS">
<div class="row">

<div class="col-12 mb-4">
<h6>Test SMS System</h6>
</div>

    <div class="col-md-6">
    
    <label><?php echo __("Enter Mobile Number","premiumpress"); ?></label>
    
<script>
  jQuery(document).ready(function(){ 
   
	   var handleChange = function() {    
	   jQuery("#mobilenum-input").val(iti.getNumber());
	   }
	   
		var input = document.querySelector("#mobilenum-test-num");
		var iti = window.intlTelInput(input, { 
		  utilsScript: "<?php echo CDN_PATH.'js/js.mobileprefixU.js'; ?>",
		 // autoHideDialCode: false,
		  nationalMode: false,
		   
		});
	
		input.addEventListener('change', handleChange);
		input.addEventListener('keyup', handleChange);
		 
		jQuery(".iti__country-list li").click(function(e) {				 
			jQuery("#mobilenum-test-num").val( '+' + jQuery(this).data('dial-code') ); 
			
		});
	
	});
	
  </script>
<input name="num" type="text" class="form-control" id="mobilenum-test-num" value="<?php if(isset($_GET['num'])){ echo $_GET['num']; } ?>" />

     <button type="button" onclick="sms_code_send()" data-ppt-btn class="mb-2 btn-system mt-2"><?php echo __("Send Code","premiumpress"); ?></button>
   
    </div>
    <div class="col-md-6">
    <label><?php echo __("Validate Code","premiumpress"); ?></label>


   <input name="mobilenum-test-code" type="text" class="form-control" id="mobilenum-test-code" value="" />
      
     <button type="button" data-ppt-btn onclick="sms_code_validate()" class="mb-2 btn-system mt-2 "><?php echo __("Verify Code","premiumpress"); ?></button>
   

    </div>

</div>
</div>
 

<script>

function sms_code_send(){

var num = jQuery('#mobilenum-test-num').val();
 
if( num == ""){
	alert("<?php echo __("Please enter a valid mobile number.","premiumpress"); ?>");
	return;
}

if(confirm("<?php echo __("The SMS message will be sent to","premiumpress"); ?> "+num)){


<?php if(function_exists('current_user_can') && current_user_can('administrator')){ ?>


jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',	
		dataType: 'json',	
		data: { 
            admin_action: "sms_code_send",  
			num: num,
        },
        success: function(response) {
  
			if(response.status == "ok"){
			 
  		 		alert("<?php echo __("SMS Sent","premiumpress"); ?>");
				
			}else{			
				
				alert(response.msg);	
			}			
        },
        error: function(e) {
            console.log(e)
        }
    });
	
<?php }else{ ?>
alert("Admin only.");
<?php } ?>
	
	}

 

}// end are you sure

function sms_code_validate(){

var code = jQuery('#mobilenum-test-code').val();
var num = jQuery('#mobilenum-test-num').val();

if(code == ""){
alert("<?php echo __("Enter the SMS code.","premiumpress"); ?>");
return;
}

if(num == ""){
alert("<?php echo __("Invalid mobile number.","premiumpress"); ?>");
return;
} 

	jQuery.ajax({
            type: "POST",
			dataType: 'json',	
            url: '<?php echo home_url(); ?>/',		
         	data: {
                    action: "sms_code_validate",
         			num: num,				 
					code:code,
					
              },
              success: function(response) { 
				 
         			if(response.status == "ok"){			
						alert("<?php echo __("Code Accepted. Thank you!","premiumpress"); ?>");						
					}else{					
						alert(response.msg);					
					}					
							
              },
              error: function(e) {
                     alert("error "+e)
               }
	});	
  
}


</script> 





     
<?php if(isset($_GET['num']) && $_GET['num'] == ""){ ?>

<div class="alert alert-danger p-3 small text-wrap">
<i class="fa fa-exclamation-triangle mr-2"></i> <?php echo __("No SMS number provided by the user.","premiumpress"); ?>
</div>

<?php } ?>

<div class="container px-0 border-bottom mb-3 pb-3" id="cansendSingle">
<div class="row"> 
<div class="col-md-4">

<label><?php echo __("Send Single SMS","premiumpress"); ?></label> 



</div>
<div class="col-md-8">

    <div id="pending_message_single_box">
    
    
                      
<script>
  jQuery(document).ready(function(){ 
   
	   var handleChange = function() {    
	   jQuery("#mobilenum-input").val(iti.getNumber());
	   }
	   
		var input = document.querySelector("#mobilenum-input");
		var iti = window.intlTelInput(input, { 
		  utilsScript: "<?php echo CDN_PATH.'js/js.mobileprefixU.js'; ?>",
		 // autoHideDialCode: false,
		  nationalMode: false,
		   
		});
	
		input.addEventListener('change', handleChange);
		input.addEventListener('keyup', handleChange);
		 
		jQuery(".iti__country-list li").click(function(e) {				 
			jQuery("#mobilenum-input").val( '+' + jQuery(this).data('dial-code') ); 
			
		});
	
	});
	
  </script>
<input name="num" type="text" class="form-control" id="mobilenum-input" value="<?php if(isset($_GET['num'])){ echo $_GET['num']; } ?>" />
    
    <textarea style="height:100px;" id="pending_message" class="w-100 mt-2 form-control">Yor message here.</textarea>
   
    <button type="button" onclick="ajax_send_sms_single()" class="mb-2 btn btn-system mt-2 btn-lg "><?php echo __("Send SMS","premiumpress"); ?></button>
   
</div> 

</div></div></div>

 
     
     
  
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
<div class="container px-0 border-bottom mb-3 pb-3 " id="cansendBulk">
<div class="row"> 
<div class="col-md-4">

<label><?php echo __("Send Bulk SMS","premiumpress"); ?></label>
<p class="pb-0 btn-block text-muted mb-0"><?php echo __("Here you can send an SMS to all of your users.","premiumpress"); ?></p>

</div>
<div class="col-md-8">

    <div id="pending_message_box">
    
    <textarea style="height:100px;" id="pending_message" class="w-100 form-control">Your message here.</textarea>
    
    <button type="button" onclick="ajax_send_sms_new()" class="mb-2 btn btn-system mt-2 btn-lg"><?php echo __("Send SMS","premiumpress"); ?></button>
    
</div> 

</div></div></div>


<script>



function ajax_send_sms_single(){

var num = jQuery('#mobilenum-input').val();

 
if(jQuery('#mobilenum-input').val() == ""){
jQuery('#mobilenum-input').focus();
alert("<?php echo __("Please enter a valid mobile number.","premiumpress"); ?>");
}else{
if(confirm("<?php echo __("The SMS message will be sent to","premiumpress"); ?> "+num)){


<?php if(function_exists('current_user_can') && current_user_can('administrator')){ ?>


jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',	
		dataType: 'json',	
		data: { 
            admin_action: "sms_single",  
			msg: jQuery('#pending_message').val(),
			num:jQuery("#mobilenum-input").val(),
        },
        success: function(response) {
  
			if(response.status == "ok"){
			 
  		 		jQuery("#pending_message_single_box").html("<div class='alert alert-success text-center mt-4 p-3'><?php echo __("SMS Sent","premiumpress"); ?></div>");
			}else{			
				
				alert(response.msg);	
			}			
        },
        error: function(e) {
            console.log(e)
        }
    });
	
<?php }else{ ?>
alert("Admin only.");
<?php } ?>
	
	}
}	
 

}// end are you sure


function ajax_send_sms_new(){

 
 
if(jQuery('#pending_subject').val() == ""){

jQuery('#pending_subject').focus();
alert("<?php echo __("Please enter a valid email from value.","premiumpress"); ?>");

}else{

if(confirm("<?php echo __("The SMS message will be sent to all users.","premiumpress"); ?>")){

<?php if(function_exists('current_user_can') && current_user_can('administrator')){ ?>
jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',	
		dataType: 'json',	
		data: {
            admin_action: "sms_bulk",  
			msg: jQuery('#pending_message').val(),
        },
        success: function(response) {
  
			if(response.status == "ok"){
			 
  		 		jQuery("#pending_message_box").html("<div class='alert alert-success text-center mt-4 p-3'><?php echo __("SMS Sent","premiumpress"); ?></div>");
			}else{			
				
				alert(response.msg);	
			}			
        },
        error: function(e) {
            console.log(e)
        }
    });
	
<?php }else{ ?>
alert("Admin only.");
<?php } ?>
	
	
	}
}	
}// end are you sure

</script>
 
<?php /**
<script>
function ajax_test_sms(tnum, tmsg){

    jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',		
		data: {
            action: "sms_test",
			num: tnum,
			msg: tmsg,
 
        },
        success: function(response) {
		alert(response);
			
        },
        error: function(e) {
            alert("error saving session: "+e)
        }
    });

}
</script>
  


<div class="container px-0 border-bottom mb-3 pb-3 ">
<div class="row"> 

<?php $i=1; while($i < 3){ ?>
   
        <div class="col-md-12 mb-2">
          
            
            <div class="row">
            
            <div class="col-md-4">
              <label>Admin Mobile Number  </label>
              <div class="opacity-5 tiny">(user <?php echo $i; ?>)</div>
            </div>
            
            <div class="col-md-7">
            
            
            
            
<script>
  jQuery(document).ready(function(){ 
   
	   var handleChange = function() {    
	   jQuery("#num_<?php echo $i; ?>").val(iti.getNumber());
	   }
	   
		var input = document.querySelector("#num_<?php echo $i; ?>");
		var iti = window.intlTelInput(input, { 
		  utilsScript: "<?php echo CDN_PATH.'js/js.mobileprefixU.js'; ?>",
		 // autoHideDialCode: false,
		  nationalMode: false,
		   
		});
	
		input.addEventListener('change', handleChange);
		input.addEventListener('keyup', handleChange);
		 
		jQuery(".iti__country-list li").click(function(e) {				 
			jQuery("#num_<?php echo $i; ?>").val( '+' + jQuery(this).data('dial-code') ); 
			
		});
	
	});
	
  </script>
<input name="admin_values[sms][num_<?php echo $i; ?>]" id="num_<?php echo $i; ?>" type="text" class="form-control" value="<?php echo _ppt(array("sms","num_".$i)); ?>" />
   
            
       
            
            </div>
            
           
             <div class="col-md-1">
             <?php if(strlen(_ppt(array("sms","num_".$i))) > 5){ ?>
        <button type="button" class="btn btn-primary" onclick="ajax_test_sms('<?php echo _ppt(array("sms","prefix_".$i)); ?><?php echo _ppt(array("sms","num_".$i)); ?>','testing');" data-toggle='tooltip' data-original-title="send a test message" data-placement="top"><i class="fa fa-mobile m-0"></i></button>  
        <?php } ?>    
            </div>
            
            </div>
            
            
        </div>
        
<?php $i++; } ?>    
      
        
    
</div>		
</div>
     

*/ ?>