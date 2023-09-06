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
   
 
   
   // GET CURRENT PRICE
   $current_price = get_post_meta($post->ID,'price_current',true);
   if(!is_numeric($current_price)){ $current_price = 0; }
   
   // GET RESERVE PRICE
   $price_reserve = get_post_meta($post->ID,'price_reserve',true);
   if(!is_numeric($price_reserve)){ $price_reserve = 0; }
   
   // GET THE BIDING TYPE
   $auction_type_credit = get_post_meta($post->ID,'auction_type_credit',true);
   if($auction_type_credit == ""){ $auction_type_credit = 0; }
   
   // GET BUY NOW PRICE
   $bin_price = get_post_meta($post->ID,'price_bin',true);
   
   // GET SHIPPING OST
   $price_shipping = get_post_meta($post->ID,'price_shipping',true);
   if($price_shipping == "" || !is_numeric($price_shipping)){$price_shipping = 0; }
   
   if($bin_price > 0 && $price_shipping > 0){
   $bin_price = $bin_price+ $price_shipping;   
   }
   
   $bin_price = hook_price(array($bin_price,0));
 

?>





 <script>


function processBidPop(){

 <?php if(_ppt(array('mem','enable'))  == '1' && _ppt(array('mem','register'))  == '1' && $CORE->USER("membership_active", $userdata->ID) == 0){ ?>
   alert("<?php echo __("You need an active membership to use this feature.","premiumpress"); ?>");
   return; 
   <?php } ?>
   
 
	response = jQuery("#at-bidbox").html(); 
 	jQuery("#at-bidbox").remove();
	pptModal("bidnow", response, "modal-bottomxxxx", "mm-wink ppt-animate-bouncein bg-white ppt-modal-shadow w-700", 0);


   
}

</script>
  <!--msg model -->
  <div style="display:none;" id="at-bidbox">
    
        <div class="p-3 py-md-5 ppt-forms style3">
          <div class="container">
            <div class="row">
              <div class="col-md-6 singlebidbox">
                <div class="fs-md text-600 mb-2"><?php echo __("Standard","premiumpress"); ?></div>
                <p class="small"><?php echo __("Enter the amount you wish to bid.","premiumpress"); ?></p>
              </div>
              <div class="col-md-6 singlebidbox">
                <div class="row ">
                  <div class="col-12 mb-2"> <span class="float-right small mt-2 text-muted"><?php echo __("Price Now","premiumpress"); ?></span> <span class="buybox-price-num h2 <?php echo $CORE->GEO("price_formatting",array()); ?>">00</span>
                    <!--<span class="buybox-price-currency"><?php echo hook_currency_code(''); ?></span>   -->
                  </div>
                  <div class="col-12 ">
                    <div class="input-group">
                      <div class="input-group-prepend"> <span class="input-group-text"><?php echo hook_currency_symbol(''); ?></span> </div>
                      <input type="text" class="form-control size16 nob" id="bid_amount"  name="bidamount" maxlength="10" value="<?php if(_ppt(array('lst', 'at_bidinc' )) == ""){ echo $current_price+10; }else{ echo $current_price+_ppt(array('lst', 'at_bidinc' )); }  ?>">
                    </div>
                  </div>
                  <div class="col-12  text-xs-right">
                    <?php if($userdata->ID){ ?>
                    <button  class=" btn-block btn-system mt-2" data-ppt-btn  <?php if($userdata->ID != $post->post_author){ ?>onclick="ajax_load_buybox_bid();"<?php }else{ ?>onclick="alert('<?php echo __("You cannot bid on your own items.","premiumpress"); ?>');"<?php } ?>><?php echo __("Bid Now","premiumpress"); ?></button>
                    <?php }else{ ?>
                    <a class="btn-block btn-system mt-2" data-ppt-btn href="javascript:void(0);" onclick="ProcessLogin();" ><?php echo __("Bid Now","premiumpress"); ?></a>
                    <?php } ?>
                  </div>
                </div>
                <div id="bidding_message"></div>
              </div>
              
              
              <?php if(in_array(_ppt(array('lst', 'at_autobid' )), array("1",""))){ ?>
              <div class="col-md-12 singlebidbox">
                <hr />
              </div>
              <div class="col-md-6">
                <div class="fs-md text-600 mb-2"><?php echo __("Automated","premiumpress"); ?></div>
                <p class="small"><?php echo __("Enter a maximum bid amount and the system will auto bid upto that amount.","premiumpress"); ?></p>
              </div>
              <div class="col-md-6">
                <?php
         $showactive = false;
         $maxbid = get_post_meta($post->ID,'user_maxbid_data',true);
         
         
         if(is_array($maxbid) && isset($maxbid[$userdata->ID]) ){
         $showactive = true;
         $mamount =  $maxbid[$userdata->ID]['max_amount'];
         }else{ 
         $mamount =  "--";
         }
         
         ?>
                <?php if(is_array($maxbid) && isset($maxbid[$userdata->ID]) ){ ?>
                <script>
		   jQuery(document).ready(function(){ 
		   
			// jQuery(".singlebidbox").hide();
		   
		   });
		</script>
                <?php } ?>
                <div class="row">
                  <div class="col-12"> <span class="maxbid-price-symbol h2"><?php echo hook_currency_symbol(''); ?></span> <span class="maxbid-price-num h2"><?php echo $mamount; ?></span> <span class="maxbid-price-currency"><?php echo hook_currency_code(''); ?></span> <span class="float-right small mt-2 text-muted"><?php echo __("Auto bid up to","premiumpress"); ?></span> </div>
                  <div class="col-12">
                    <div class="input-group mb-1">
                      <div class="input-group-prepend"> <span class="input-group-text"><?php echo hook_currency_symbol(''); ?></span> </div>
                      <input type="text" class="form-control nob" id="user_maxbid"  name="user_maxbid" value="<?php if(is_numeric($mamount)){ echo $mamount+100; } ?>" maxlength="10">
                    </div>
                    <div class="clearfix"></div>
                    <?php if($userdata->ID){ ?>
                    <span class="btn btn-block mt-2 btn-system" data-ppt-btn 
               <?php if($userdata->ID != $post->post_author){ ?>onclick="ajax_set_maxbid();" <?php }else{ ?>onclick="alert('<?php echo __("You cannot bid on your own items.","premiumpress"); ?>');"<?php } ?>
               style="cursor:pointer"><?php echo __("Update Auto Bid","premiumpress"); ?></span>
                    <?php }else{ ?>
                    <a class="btn-block mt-2 btn-system" data-ppt-btn href="<?php echo wp_login_url( get_permalink() ); ?>" ><?php echo __("Update Auto Bid","premiumpress"); ?></a>
                    <?php } ?>
                  </div>
                </div>
              </div>
              
              <?php } ?>
            </div>
          </div> 
       </div>
        
  </div>