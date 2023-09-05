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

if(!_ppt_checkfile("payment-thankyou.php")){

global $CORE, $payment_data;

   
?>
<section class="section-60">
      <div class="container">
      <div class="row">
         <div class="col-md-6 offset-md-3">
         
<div class="card-popup rounded overflow-hidden" ppt-border1>
<div class="bg-primary pt-3"> 
    
      <div class="card-popup-content">  
      <div class="">
      <?php if(in_array(_ppt(array('design', 'ppt_emoji')), array("","1"))){  ?><span class="smilecode" style="font-size: 40px;">&#x1F600;</span><?php } ?>
          
       <h5 class="text-white"><?php echo __("Order Complete","premiumpress"); ?></h5>
       </div>
      </div>
</div>
<div class="card-body bg-white text-center">    
         
         
              <?php if(isset($payment_data) && isset($payment_data['IDFORMATTED'])){ ?>
                       <h2 class="mb-3 mt-n4">#<?php echo $payment_data['IDFORMATTED']; ?></h2>
             <?php } ?>
                    
         
          
                  <p class="text-600"><?php echo __("Thank you, your order has been received and is being processed.","premiumpress") ?></p>
                  <p class="margin-top3"><?php echo __("If you have any questions please contact us.","premiumpress") ?></p>
                 
                 
         <!-- RETURN USER TO THE PURCHASED/PAID ITEM --->
                        <?php 
                           /*
                           1. CREDIT OR PAY
                           2. LST
                           3. USERPAYMENT
                           4. MEM
                           5. BAN
                           6. CART		
                           */
						    
						   if(isset($payment_data['order_id']) && ( substr($payment_data['order_id'],0,3) == "LST" || substr($payment_data['order_id'],0,7) == "UPGRADE" ) ){
						   $h = explode("-", $payment_data['order_id']);
						   $_POST['paid_item_id'] = $h[1];						   
						   }
						  
						  if(isset($_POST['paid_item_id']) && is_numeric($_POST['paid_item_id']) ){
						
							$link = get_permalink($_POST['paid_item_id']);
							
							if(substr($payment_data['order_id'],0,7) == "UPGRADE"){
							$link = _ppt(array('links','add'))."?eid=".$_POST['paid_item_id'];
							}						
						
						 ?>
                        <div><a href="<?php echo $link; ?>" data-ppt-btn class="btn-primary btn-lg my-3"><?php echo __("Return to listing","premiumpress") ?></a></div>
                        <?php }else{ ?>
                        <div><a href="<?php echo _ppt(array('links','myaccount')); ?>" data-ppt-btn class="btn-primary btn-lg my-3"><?php echo __("Return to my account","premiumpress") ?></a></div>
                        <?php } ?> 
                     
                     <?php if(isset($payment_data['ID']) && $payment_data['ID'] != "99999999"){ ?>
                       <div>
                       <a href="<?php echo home_url(); ?>/?invoiceid=<?php echo $payment_data['ID']; ?>" target="_blank" data-ppt-btn class=" btn-secondary mt-4">
                        <i class="fa fa-file mr-2"></i> <?php echo __("View Invoice","premiumpress") ?>
                        </a></div>
                        <?php } ?>
                 
                 
             
                
         </div>
      </div> </div></div>
      <?php hook_callback_success(); ?>
</section>
<?php } ?>