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
   
   global $CORE, $post, $userdata, $CORE_AUCTION;
   
     
   //1. CURRENT PRICE
   $price_current = get_post_meta($post->ID,'price_current',true);
   if($price_current == "" || !is_numeric($price_current) ){ $price_current = 0; }
   
   //.2 GET SHIPPING PRICE
   $price_shipping = get_post_meta($post->ID,'price_shipping',true);
   if($price_shipping == "" || !is_numeric($price_shipping)){$price_shipping = 0; }
   
   // 3. GET RESERVE PRICE
   $reserve_price = get_post_meta($post->ID,'price_reserve',true);
   if($reserve_price == ""|| !is_numeric($reserve_price)){ $reserve_price = 0; }
   
   // AUCTION TYPE
   $auction_type = get_post_meta($post->ID,'auction_type',true);
    
    
   // 4. GET HIGHEST BIDDER (RETURNS "nowinner" if no winner)
   $hbid = $CORE_AUCTION->_get_winner($post->ID);
   
   
   
   // CHECK FOR USER BUY NOW PAYMENT WITH ITEMS
   // WHICH HAVE MULTIPLE QTY VALUES
   $buynowForm = false;
   if($userdata->ID){
   	$buynowdata = get_post_meta($post->ID,'user_buynow_data',true);	 
   	
   	if(is_array($buynowdata) && isset($buynowdata[$userdata->ID])){
   	$buynowForm = true;
   	}
   }
   
   // CREATE ORDER ID
   $orderID = "AUCTION-".$post->ID."-".$userdata->ID."-".date("Ymds");
   
   /////////////////////////////////
   // WORK OUT THE PRICES FIRST ////
   /////////////////////////////////
   
   if(!$buynowForm){
   $total_price = $price_current+$price_shipping;
   }else{
   $total_price = $buynowdata[$userdata->ID]['price'] * $buynowdata[$userdata->ID]['qty'];
   }
   
    
   ?>
<script>
   jQuery(document).ready(function(){ 
   jQuery('.ppt_shortcode_favs').hide();
   });
</script>


<div ppt-box> 
  
   <div class="_header">
   
   <div class="_title"><?php echo __("Auction Finished","premiumpress") ?></div>
      
   </div>
<div class="_content">

 
         <ul class="payment-right pl-0">
         <?php if($auction_type != 2){ ?>
            <li style="border-top:0px;">
               <div class="left"><?php echo __("Auction Started","premiumpress"); ?>:</div><br />
               <div class="rightxx">
                  <span id="ppexpirydate"><?php echo hook_date($post->post_date); ?></span>
               </div>
               <div class="clearfix"></div>
            </li>
            <li>
               <div class="left"><?php echo __("Auction Ended","premiumpress"); ?>:</div><br />
               <div class="rightxx">
                  <span id="ppexpirydate"><?php echo hook_date(get_post_meta($post->ID,'auction_ended', true)); ?></span>
               </div>
               <div class="clearfix"></div>
            </li>
            
            <li>
               <div class="left"><?php echo __("Total Bidders","premiumpress"); ?>:</div>
               <div class="right">
                  <span id="pptime"><?php echo do_shortcode('[BIDS]'); ?></span>
               </div>
               <div class="clearfix"></div>
            </li>
            <li>
               <div class="left"><?php echo __("Start Price","premiumpress"); ?>:</div>
               <div class="right">
                  <span id="pplistings"><span class="<?php echo $CORE->GEO("price_formatting",array()); ?>"> <?php echo hook_price(get_post_meta($post->ID,'price_starting', true)); ?></span></span>
               </div>
               <div class="clearfix"></div>
            </li>
            <?php } ?>
            
            <?php if($auction_type != 2 &&  get_post_meta($post->ID,'price_reserve', true) > 0){ ?>
            <li>
               <div class="left"><?php echo __("Reserve Price","premiumpress"); ?>:</div>
               <div class="right">
                  <span id="pplistings"><?php echo hook_price(get_post_meta($post->ID,'price_reserve', true)); ?></span>
               </div>
               <div class="clearfix"></div>
            </li>
            <?php } ?>
            <?php if($auction_type != 2 && isset($hbid['amount']) && $hbid['amount'] > 0){ ?>
            <li>
               <div class="left"><?php echo __("Highest Bid","premiumpress"); ?>:</div>
               <div class="right">
                  <span id="pptime"><span class="<?php echo $CORE->GEO("price_formatting",array()); ?>"> <?php echo hook_price($hbid['amount']); ?></span></span>
               </div>
               <div class="clearfix"></div>
            </li>
            <?php } ?>
            <?php if(get_post_meta( $post->ID,'price_current', true) > 0){ ?>
            <li>
               <div class="left"><strong><?php echo __("End Price","premiumpress"); ?>:</strong></div>
               <div class="right">	
                  <span id="ppprice"><span class="<?php echo $CORE->GEO("price_formatting",array()); ?>"> <?php echo hook_price(get_post_meta($post->ID,'price_current', true)); ?></span></span>
               </div>
               <div class="clearfix"></div>
            </li>
            <?php } ?>
            
            <?php if($price_shipping > 0){ ?>
            
              <li>
               <div class="left"><strong><?php echo __("Shipping","premiumpress"); ?>:</strong></div>
               <div class="right">	
                  <span id="ppprice"><span class="<?php echo $CORE->GEO("price_formatting",array()); ?>"> <?php echo hook_price($price_shipping); ?></span></span>
               </div>
               <div class="clearfix"></div>
            </li>
            <?php } ?>
            
         </ul>


         <div id="auction-payment-form">
            <?php if($hbid['user'] == "nobidders" ){ ?>
            <div class="alert alert-info rounded-0" role="alert">
               <h6 class="alert-heading"><?php echo __("No Bidders","premiumpress"); ?></h6>
               <p class="small mb-0"><?php echo __("Aww, this item didn't receive any bidders. Unfortunately the auction has now ended and you've missed your chance.","premiumpress"); ?></p> 
               
               
            </div>
            
            <a href="javascript:void(0)" onclick="processListingUpgrade(<?php echo $post->ID; ?>);" class="btn btn-block btn-lg btn-system mb-3"><?php echo __("Renew","premiumpress"); ?></a>
            
            <?php }elseif($hbid['user'] == "nowinner" && !$buynowForm ){ ?>
            <div class="alert alert-warning rounded-0" role="alert">
               <h6 class="alert-heading"><?php echo __("Auction Ended","premiumpress"); ?></h6>
               <p class="small mb-0"><?php echo __("Aww, this auction has ended but unfortunately there was no winner.","premiumpress"); ?></p>
               
            </div>
            <?php }elseif( $hbid['reserve_met'] == "no" ){ ?>
            <div class="alert alert-warning rounded-0" role="alert">
               <h6 class="alert-heading"><?php echo __("Auction Ended - Reserve Not Met","premiumpress"); ?></h6>
               <p class="small mb-0"><?php echo __("Aww boo!, This auction has ended however the reserve price was not met therefore there was no winner.","premiumpress"); ?></p>
              
            </div>
            <?php }elseif( $hbid['reserve_met'] == "yes" ){ ?>
            <div class="alert alert-success rounded-0" role="alert">
            
               <h6 class="alert-heading"><?php echo __("Item Sold","premiumpress"); ?></h6>
               
               <p class="small mb-0"><?php echo __("This item was successfully sold and the lucky winner was","premiumpress"); ?> <?php echo $hbid['user']; ?>.</p>
              
            </div> 
                   
            <?php } ?>
            
<style>
.ppt-single-button-box { display:none; }
</style>  
<?php 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if($userdata->ID == $hbid['userid']){ ?>

<a href="<?php echo _ppt(array('links','myaccount')); ?>?showtab=offers&showpid=<?php echo $post->ID; ?>" class="btn btn-primary btn-xl icon-before btn-icon btn-block shadow-sm font-weight-bold">

<i class="fal fa-credit-card"></i> <span><?php echo __("Pay Now","premiumpress"); ?></span>

</a>
<?php 

}
 
 ///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if($hbid['user'] == "nobidders" && $userdata->ID == $hbid['userid']  ){ ?>
<a  href="javascript:void(0)" onclick="processListingUpgrade(<?php echo $post->ID; ?>);" class="btn btn-system btn-xl icon-before btn-icon btn-block shadow-sm font-weight-bold"> 

<i class="fal fa-sync"></i> <span><?php echo str_replace("%s", $CORE->LAYOUT("captions","1"),__("Renew %s","premiumpress")); ?></span>
          
</a>
<?php }

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 ?>         
 </div>           
 
   </div>
</div>
<div class="clearfix"></div>