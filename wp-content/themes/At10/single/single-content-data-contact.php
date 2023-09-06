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

global $CORE, $post, $userdata; 

?>

<input type="hidden" data-error value="<?php echo __("Please complete all the required fields.","premiumpress"); ?>" />
<input type="hidden" data-error-privacy value="<?php echo __("Please accept the privacy policy.","premiumpress"); ?>" />
<input type="hidden" data-form-pid value="<?php if(isset($_POST['pid'])){ echo $_POST['pid']; } ?>" />
<div class="formsContactUser">
<div class="formOk data-form-ok" style="display:none;">
  <div class="alert alert-success text-600">
    <i class="fa fa-check mr-2"></i> <?php echo __("Message Sent","premiumpress") ?>
  </div>
</div>



<div class="formfields data-form-fields">
  <div class="row">
    <div class="col-md-6 mobile-mb-2 mb-3 mb-lg-0">
      <input type="text" class="form-control contact-required" tabindex="1" data-name="name"  placeholder="<?php echo __("Full Name","premiumpress") ?>">
    </div>
    <div class="col-md-6 mobile-mb-2 mb-3 mb-lg-0">
      <input placeholder="<?php echo __("Email","premiumpress") ?>" type="text" class="form-control contact-required" data-name="email" tabindex="2">
    </div>
    <div class="col-12 my-md-4 mobile-mb-2 mb-3">
      <textarea placeholder="<?php echo __("Your message","premiumpress") ?>..." class="form-control contact-required"  data-name="message" tabindex="3" style="min-height:150px;"></textarea>
    </div>
    
</div>
</div>
</div>
<div class="_footer border-top pt-3 data-form-fields">

<div class="row">
 
<div class="col-md-6">
      <label class="custom-control custom-checkbox mb-0">
      <input type="checkbox" class="custom-control-input" id="privacypolicy" value="1" tabindex="4"  onchange="jQuery('#privacypolicy').prop('disabled', true);">
      <div class="custom-control-label mr-2 text-600 mt-1">
        <?php echo __("I accept the","premiumpress") ?> <a href="<?php echo _ppt(array('links','privacy')); ?>" target="_blank"><?php echo __("privacy policy","premiumpress") ?></a>
      </div>
      </label>
      
<?php if(_ppt(array('captcha','enable')) == 1 && _ppt(array('captcha','sitekey')) != "" ){ ?>  
<div data-form-recaptcha class="g-recaptcha my-3" data-sitekey="<?php echo _ppt(array('captcha','sitekey')); ?>" ></div>
 <input type="hidden" data-error-recaptcha value="<?php echo __("Please verify you are not a robot.","premiumpress"); ?>" />
<?php } ?>

</div>

<div class="col-md-6 text-md-right">
<button type="button" onclick="formsContactUser();" data-btn-submit data-ppt-btn class=" btn-primary "><?php echo __("Send","premiumpress") ?></button>

</div>

      
      
</div>

 
