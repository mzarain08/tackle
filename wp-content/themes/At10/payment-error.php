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

if(!_ppt_checkfile("payment-error.php")){

global $CORE, $payment_data; ?>
 

      <div class="container my-5">
         <div class="col-md-6 offset-md-3">
         
         
<div class="card-popup rounded overflow-hidden">
<div class="bg-primary pt-3"> 
    
      <div class="card-popup-content">  
      <div class="">
      <?php if(in_array(_ppt(array('design', 'ppt_emoji')), array("","1"))){  ?><span class="smilecode" style="font-size: 40px;">&#x1F611;</span><?php } ?>
          
       <h5 class="text-white"><?php echo __("Payment Cancelled","premiumpress") ?></h5>
       </div>
      </div>
</div>
<div class="card-body bg-white text-center">  
     
                  <p class="text-600"><?php echo __("Sorry but there was an error during checkout.","premiumpress") ?></p>
                  <p class="margin-top3"><?php echo __("No money has been taken from your account.","premiumpress") ?></p>
               </div>
            </div>
            <?php hook_callback_error(); ?>  
         </div>
      </div>
 
<?php } ?>