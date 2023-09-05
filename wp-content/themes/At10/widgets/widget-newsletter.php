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

global $CORE, $userdata, $post; 
 
 
if( _ppt(array('newsletter','enable'))  == 1 || defined('WLT_DEMOMODE') ){


$randomID = rand(0,100000);

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if( _ppt(array('newsletter','newsdefault'))  == 0 ){  ?>

<?php echo do_shortcode(_ppt(array('newsletter','customcode')) ); ?>

<?php }else{ ?>

<div class="card-newsletter mb-4 p-3" ppt-border1>

<div class="text-center newsletter-intro<?php echo $randomID; ?>">
						
    <i class="fal fa-envelope-open fa-3x  mb-4"></i>    
    
    <h5 class="mb-3 text-600"><?php echo __("Join Our Newsletter","premiumpress") ?></h5>
    
    <div class="small opacity-5 mb-4">
    <?php echo __("Join our subscribers list to get the latest news, updates and special offers delivered directly in your inbox.","premiumpress") ?>
    </div>

</div>

<script>
var newsletterSent = 0;
function ajax_newsletter_signup<?php echo $randomID; ?>(){

if(newsletterSent != 1){

	newsletterSent = 1;

    jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',		
		dataType: 'json',
		data: {
            action: "newsletter_join",
			email: jQuery('#ppt_newsletter_mailme<?php echo $randomID; ?>').val(),	 
        },
        success: function(r) {
			
			if(r.status == "ok"){
				jQuery('#newsletterthankyou<?php echo $randomID; ?>').show();
				jQuery('#mailinglist-form<?php echo $randomID; ?>').html('');
				jQuery('.newsletter-intro<?php echo $randomID; ?>').hide();
			}else{
				jQuery('#mailinglist-form<?php echo $randomID; ?>').html("<?php echo __("Invalid Email Address","premiumpress") ?>");
			}
			
        },
        error: function(e) {
            //console.log(e)
        }
    });
	
	}

}
</script>

<div id="newsletterthankyou<?php echo $randomID; ?>" style="display:none" class="newsletter-confirmation txt">

	<h5><?php echo __("Thank You!","premiumpress") ?></h5>
	<p><?php echo __("Please check your email for a confirmation email.","premiumpress") ?></p>
	<p class="small"><?php echo __("Only once you've confirmed your email will you be subscribed to our newsletter.","premiumpress") ?></p>
    
</div>

<form id="mailinglist-form<?php echo $randomID; ?>" name="mailinglist-form<?php echo $randomID; ?>" method="post" onSubmit="return IsEmailMailinglist<?php echo $randomID; ?>();" class="footer-newsletter">
    

<div class="input-group">										 
<input type="text" name="ppt_newsletter_mailme<?php echo $randomID; ?>" id="ppt_newsletter_mailme<?php echo $randomID; ?>" value="" placeholder="<?php echo __("Email Address Here..","premiumpress") ?>" style="height:46px; font-size:12px;" class="form-control  rounded-0" /> 
<div class="input-group-append">
<button type="submit" class="btn btn-primary px-3"><?php echo __("Join","premiumpress") ?></button>
</div>	

  					
</div>  

     
        
         
 </form>
 
</div>
 
<script>
		function IsEmailMailinglist<?php echo $randomID; ?>(){
		var pattern = new RegExp(/^(("[\w-+\s]+")|([\w-+]+(?:\.[\w-+]+)*)|("[\w-+\s]+")([\w-+]+(?:\.[\w-+]+)*))(@((?:[\w-+]+\.)*\w[\w-+]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][\d]\.|1[\d]{2}\.|[\d]{1,2}\.))((25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\.){2}(25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\]?$)/i);
			var de4 	= document.getElementById("ppt_newsletter_mailme<?php echo $randomID; ?>");
			
			if(de4.value == ''){
			alert("<?php echo trim(__("Please enter your email.","premiumpress")); ?>");
			de4.style.border = 'thin solid red';
			de4.focus();
			return false;
			}
			if( !pattern.test( de4.value ) ) {	
			alert("<?php echo trim(__("Invalid Email Address","premiumpress")); ?>");
			de4.style.border = 'thin solid blue';
			de4.focus();
			return false;
			}
			ajax_newsletter_signup<?php echo $randomID; ?>();
		 
		  	return false;
		}		
 </script>
 

<?php } ?>
 
<?php }

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


?>