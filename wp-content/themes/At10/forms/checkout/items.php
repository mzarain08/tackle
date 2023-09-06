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

global $userdata, $CORE, $CORE_CART, $CORE_UI;

$cart_data = $CORE_CART->cart_getitems();
 
?>

<div ppt-box class="rounded">
  <div class="_header" ppt-flex-between>
  
    <div class="_title"><?php echo __("My Basket","premiumpress") ?></div>
    
    <div class="_close">
      <div ppt-icon-24 data-ppt-icon-size="24">
        <?php echo $CORE_UI->icons_svg['bag']; ?>
      </div>
    </div>
    
  </div>
  <div class="_content no-hide p-0 py-3" style="min-height:200px;">
    <?php  $counter = 1; $tokens = 0;
 
foreach($cart_data['items'] as $key => $inner_item){  foreach($inner_item as $innerkey => $item){
 
?>
    <div ppt-list-item>
      <div class="d-flex flex-row">
        <div class="bg-light p-3 rounded overflow-hidden position-relative" style="width:80px;">
          <a href="<?php echo get_permalink($key); ?>" class="text-dark">
          <div class="bg-image" data-bg="<?php echo $item['image-path']; ?>">
          </div>
          </a>
        </div>
        <div class="w-100 ml-3">
          <div class="text-600 mb-2">
           
           
           <div class="d-flex justify-content-between"> 
		   
		   <div><?php echo $item['name']; ?></div>
           
           <div>
           
             <a href="javascript:void(0);" onclick="jQuery('#table_row_<?php echo $counter; ?>').hide(); ajax_cart('remove', 1000, '<?php echo $key ?>','<?php echo $innerkey; ?>','refresh');" 
        class="btn btn-sm ml-3 btn-secondary btn-remove-item margin-left1"> <i class="fas fa-times nomargin"></i> </a>
           
           </div>
           
           </div>
            
            
          </div>
          <div class="opacity-5 text-400 small">
            <nav ppt-nav class="pl-0">
              <ul>
                <?php if(isset($cart_data['items']['order_data']) && substr($cart_data['items']['order_data'],0,5) == "addon" ){ ?>
                <li class="list-inline-item">
                  <?php
			   $thisVal = substr($cart_data['items']['order_data'],5,100);			   
				$current_data = get_post_meta($key, 'customextras', true); 
				if(is_array($current_data) && !empty($current_data) && $current_data['name'][0] != "" ){ $i=0; 				 
					foreach($current_data['name'] as $key => $data){ 
					if($current_data['name'][$i] !="" && is_numeric($current_data['price'][$i]) ){						
							if($i == $thisVal){
							?>
                  <div class="bg-light p-3 border mt-4">
                    <span class="float-right badge badge-primary"><?php echo ($current_data['price'][$i]); ?></span>
                    <h6><?php echo $current_data['name'][$i]; ?></h6>
                    <p><?php echo trim($current_data['value'][$i]); ?></p>
                  </div>
                  <?php						
							} 
						}						
						$i++; 
					}
				} 
			   
			   ?>
                </li>
                <?php } ?>
                <?php
		
		if(isset($item['custom_data']) && is_array($item['custom_data']) ){
		  
		foreach($item['custom_data'] as $f){ 
		
		switch($f['key']){
			/*
			case "color": {
			?>
            <?php echo $CORE->GEO("translation_tax_key", "color"); ?>: <?php echo $f['text']; ?>  
            <?php			
			} break;
			
			case "size": {
			?>
            <?php echo $CORE->GEO("translation_tax_key", "size"); ?>: <?php echo $f['text']; ?>  
            <?php			
			} break;
			*/
			
			default: {
			?>
                <li> <?php echo $CORE->GEO("translation_tax_key", $f['key']); ?>: <?php echo $f['text']; ?> </li>
                <?php			
			} break;
			
			} }
		}		
		
		?>
                <li> <?php echo __("QTY","premiumpress"); ?> X<?php echo $item['qty']; ?> </li>
                <li class="text-600"> <span class="pricetag <?php echo $CORE->GEO("price_formatting",array()); ?>"> <?php echo hook_price(array($item['amount'],0)); ?> </span> </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
    <?php } } ?>
  </div>
  <?php if($cart_data['subtotal'] != 0  ){ ?>
  <div class="_footer py-3 fs-14 text-muted">
    <div class="row">
      <div class="col-lg-8 col-6 text-sm-right">
        <?php echo __("SubTotal","premiumpress"); ?>
      </div>
      <div class="col-lg-4 col-6 text-right">
        <span class="pricetag <?php echo $CORE->GEO("price_formatting",array()); ?>"> <?php echo hook_price(array($cart_data['subtotal'],0)); ?> </span>
      </div>
    </div>
  </div>
  <?php } ?>
  <?php if($cart_data['weight'] != 0 ){ ?>
  <div class="_footer py-3 fs-14 text-muted">
    <div class="row">
      <div class="col-lg-8 col-6 text-sm-right">
        <?php echo __("Weight","premiumpress"); ?>
      </div>
      <div class="col-lg-4 col-6 text-right">
        <?php echo $cart_data['weight']." ".$CORE_CART->cart_weightclass($cart_data['weight_class']); ?>
      </div>
    </div>
  </div>
  <?php } ?>
  <?php if(defined('WLT_CART')){ ?>
  <?php if(!isset($GLOBALS['flag-cart'])){  ?>
  <div class="_footer py-3 fs-14 text-muted">
    <div class="row">
      <div class="col-lg-8 col-6 text-sm-right">
        <?php echo __("Shipping","premiumpress"); ?>
      </div>
      <div class="col-lg-4 col-6 text-right">
        <?php if($cart_data['shipping'] != 0 ){ ?>
        <span class="pricetag <?php echo $CORE->GEO("price_formatting",array()); ?>"><?php echo hook_price(array($cart_data['shipping'],0)); ?></span>
        <?php }else{ ?>
        <span class="text-uppercase"><?php echo __("Free","premiumpress"); ?></span>
        <?php } ?>
      </div>
    </div>
  </div>
  <?php }  ?>
  <?php }else{ ?>
  <?php if($cart_data['shipping'] != 0 ){ ?>
  <div class="_footer py-3 fs-14 text-muted">
    <div class="row">
      <div class="col-lg-8 col-6 text-sm-right">
        <?php echo __("Shipping","premiumpress"); ?>
      </div>
      <div class="col-lg-4 col-6 text-right">
        <span class="pricetag <?php echo $CORE->GEO("price_formatting",array()); ?>"><?php echo hook_price(array($cart_data['shipping'],0)); ?></span>
      </div>
    </div>
  </div>
  <?php } ?>
  <?php } ?>
  <?php if($cart_data['tax'] != 0 ){ ?>
  <div class="_footer py-3 fs-14 text-muted">
    <div class="row">
      <div class="col-lg-8 col-6 text-sm-right">
        <?php echo __("Tax","premiumpress"); ?>
      </div>
      <div class="col-lg-4 col-6 text-right">
        <span class="pricetag <?php echo $CORE->GEO("price_formatting",array()); ?>"><?php echo hook_price(array($cart_data['tax'],0)); ?></span>
      </div>
    </div>
  </div>
  <?php } ?>
  <?php if($cart_data['discount'] != 0 ){ ?>
  <div class="_footer py-3 fs-14 text-muted">
    <div class="row">
      <div class="col-lg-8 col-6 text-sm-right">
        <?php echo __("Discount","premiumpress"); ?>
      </div>
      <div class="col-lg-4 col-6 text-right">
        <?php if(isset($_SESSION['discount_code_value'])){ ?>
        <a href="javascript:void(0);" onclick="RemoveCoupon();" id="removeCouponBtn" title="remove coupon"><i class="fal fa-times text-danger mr-2"></i></a>
        <?php } ?>
        <span class="pricetag <?php echo $CORE->GEO("price_formatting",array()); ?>"><?php echo hook_price(array($cart_data['discount'],0)); ?></span>
      </div>
    </div>
  </div>
  <?php } ?>
  <?php if($cart_data['total'] != 0 ){  ?>
  <div class="_footer py-3 text-600">
    <div class="row">
      <div class="col-lg-8 col-6 text-sm-right">
        <?php echo __("Total","premiumpress"); ?>
      </div>
      <div class="col-lg-4 col-6 text-right">
        <span class="pricetag text-800 <?php echo $CORE->GEO("price_formatting",array()); ?>"> <?php echo hook_price(array($cart_data['total'],0)); ?> </span>
      </div>
    </div>
  </div>
  <?php } ?>
</div>
<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


?>

 
<div class="row my-4">
<div class="col-md-12 col-xl-6">
<a href="<?php echo get_home_url(); ?>/?emptycart=1" data-ppt-btn class="btn-dark btn-block"><?php echo __("Empty Basket","premiumpress"); ?></a> 
</div>
</div>
 