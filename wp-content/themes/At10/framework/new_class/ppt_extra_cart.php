<?php

 
class framework_cart {

	function __construct(){ global $CORE;
	
		// DEFAULT FIELDS FOR THE SHOP
		$this->shop_user_fields = array(
	
		 	
			"first_name" => array( "type" => "text", "caption" => __("First Name","premiumpress") ),
			"last_name" => array( "type" => "text", "caption" => __("Last Name","premiumpress") ),
			"mobile" => array( "type" => "text", "caption" => __("Telephone","premiumpress") ),
			"email" => array( "type" => "text", "caption" => __("Email","premiumpress") ),
		  
			"address1" => array( "type" => "text", "caption" => __("Address Line 1","premiumpress") ),
			"address2" => array( "type" => "text", "caption" => __("Address Line 2","premiumpress") , "nr" => true  ),
			"country" => array( "type" => "country", "caption" => __("Country","premiumpress") ),
			"city" => array( "type" => "text", "caption" => __("City","premiumpress") ),
			"town" => array( "type" => "state", "caption" => __("State","premiumpress") ),
			"zip" => array( "type" => "text", "caption" => __("Zip/Postal Code","premiumpress") ),
			//"sep3"  => array( "type" => "sep", "caption" => "Delivery Method" ),
			//"billing_method" => array( "type" => "text", "caption" => "Method" ),
	 
			"description" => array( "type" => "hidden", "caption" => __("Comments","premiumpress"), "nr" => true ),			
		);
		
 		 
		add_shortcode( 'ADDCART', array($this,'shortcode_addtocart') );	 
		add_shortcode( 'DOWNLOADS', array($this,'shortcode_downloads') );
	 	 
		
		// LOAD IN JAVASCRIPT
		if(!is_admin()){		
		add_action('wp_footer',array($this,'_shop_footer'));
 		} 
	 		
		// HOOK INTO INIT FOR DOWNLOAD
		add_action('init', array($this, '_downloadproduct' ) );	
	 	
		// APPLY SHIPPING CHARGES
		add_action('hook_cart_data', array( $this, 'shipping_charges') );
		
		
	}
	
function shortcode_downloads( $atts, $content = null ) { global $userdata, $CORE, $post; $STRING = "";  $HIDDENDATA = "";
	 
	
	$downlaods = get_post_meta($post->ID, 'download_count', true);
	if($downlaods == ""){ $downlaods = 0; } 
	
	return number_format($downlaods);
	
}

 

function shipping_charges($cart){ global $userdata;

if(is_admin()){ return $cart; }

// CHECK WE HAVE A POSiTIVE QTY
if($cart['qty'] < 1){ return $cart; }
 

// MAKE A BACKUP OF ORGINAL DATA
$backup = $cart; 

// SET NUMBER OF PRODUCTS EXEMPTY FROM TAX
$tax_exempt_product_count = 0; 


// RCOUNTRY WEIGHT SHIPPING
$countryship 	= _ppt('countryship');

// REGIONS
$regions = _ppt('regions');  

// GET THE USERS DELIVERY COUNTRY
$delivery_country = "";
$delivery_state = "";
$delivery_method = array();

if($userdata->ID){
$delivery_country = get_user_meta($userdata->ID,"country",true);
$delivery_state = get_user_meta($userdata->ID,"city",true);
}

if(isset($_SESSION['checkout-country'])){
$delivery_country = $_SESSION['checkout-country'];
}

if(isset($_SESSION['checkout-city'])){
$delivery_state = $_SESSION['checkout-city'];
}
 
if(isset($_SESSION['checkout-method'])){
$delivery_method = $_SESSION['checkout-method'];
}
  
 
// METHODS
if(isset($delivery_method) && !empty($delivery_method)){
	$custommethods 	= _ppt('custommethods');
	if(is_array($custommethods) && !empty($custommethods['region'])){ $i=0;  
		foreach($custommethods['name'] as $cship){ 
		 
			if(in_array($custommethods['key'][$i], $delivery_method) && is_numeric($custommethods['price'][$i]) ){			
				$cart['shipping'] += $custommethods['price'][$i];
			}
		
			$i++;
		}
	}
}
 

// FLAT RATE SHIPPING  
if(_ppt('basic_shipping_flatrate') == 1){
 	
	// LOOP BASKET ITEMS AND MAKE SURE SHIPPING IS ENABLED
	$canDoFlatShipping = 1;

	if(_ppt('system_shipping') != "1"){
	
		
		if(isset($_SESSION['ppt_cart']) && is_array($_SESSION['ppt_cart'])){
		
			$canDoFlatShipping = 0;
			
			// LOOP ITEMS
			foreach($_SESSION['ppt_cart'] as $key => $items){
				// GET INNER ITEM COUNT
				if(is_array($items)){
				$innerID = 1;
					foreach($items as $item){
					
						if(get_post_meta($key,"ship_required",true) == "1"){
							$canDoFlatShipping = 1;
						}
					
					}
				}
			}
		}
	
	
	}

	
	if($canDoFlatShipping){

		// SHIPPING FLAT RATE
		if( is_numeric(_ppt(array('basic_shipping','flatrate'))) ){ 
			$cart['shipping'] += _ppt(array('basic_shipping','flatrate')); 
		}
				
		// SHIPPING FLAT PERCENTAGE
		if( is_numeric(_ppt(array('basic_shipping','flatrate_percent')))  ){ 		 
			$cart['shipping'] += ( $cart['subtotal'] * _ppt(array('basic_shipping','flatrate_percent')) /100);
		}
	
	}	
}


// FLAT RATE TAX 
if(_ppt('basic_tax_flatrate') == 1){
 
	// LOOP BASKET ITEMS AND MAKE SURE SHIPPING IS ENABLED
	$canDoFlatTax = 1;

	
	if($canDoFlatTax){
	
		// SHIPPING FLAT RATE
		if( is_numeric(_ppt(array('basic_tax','flatrate'))) ){ 
			$cart['tax'] += _ppt(array('basic_tax','flatrate')); 
		}
				
		// SHIPPING FLAT PERCENTAGE
		if( is_numeric(_ppt(array('basic_tax','flatrate_percent')))  ){ 	
			 
			$cart['tax'] += ( $cart['subtotal'] * _ppt(array('basic_tax','flatrate_percent')) /100);
		}
	
	}
	
}




//5. WEIGHT BASED SHIPPING
/*
$wb = _ppt('weightship');
$weight = $cart['weight'];
$regions = _ppt('regions'); 
 
if(is_array($wb) && !empty($wb) && isset($regions['name']) && is_array($regions['name']) && !empty($regions['name'])){ 
 
 	 
	$i=0; $m=0;
	while($i < count($wb['region'])+1){		
	
		//print_r($wb['region']);
		 
		if(isset($wb['region'][$i]) && $wb['region'][$i] != "" && $weight >= $wb['pricea'][$i] && $weight <= $wb['priceb'][$i] ){		
			  
			   	$m=0;
				while($m < count($regions['name'])+1){
				
				  	
					if(isset($regions['key'][$m]) && $regions['key'][$m] == $wb['region'][$i]){ 
					 
						 
						if($delivery_country != "" && $wb['pricec'][$i]!= "" && !empty($regions['country'][$m]) && in_array($delivery_country, $regions['country'][$m]) ){
						 				 
							$cart['shipping'] += $wb['pricec'][$i];
							//$completed_items[$key] = $key;							 	
							
						}
					}					
					$m++;
				}		
		}	
		$i++;
		
		//echo $i." -- ".$wb['region'][$i]."<br>";
	}	
}

*/


// COUNTRY SHIP
if(_ppt('basic_country_ship_ship') == 1 && $delivery_country != "" ){

 
	$regions = _ppt('regions');					
	if(is_array($regions)){ 
		$i=0; 
		while($i < count($regions['name']) ){
			if($regions['name'][$i] !=""){	
			
			
				if( isset($regions['country']) && (!empty($regions['country'][$i]) && in_array($delivery_country, $regions['country'][$i]) ) 
				|| (!empty($regions['state'][$i]) && in_array($delivery_state, $regions['state'][$i]) ) ) { // COUNTRY OR STATE CHECKOUT	
				
			 
					// FLAT RATE 
					if( is_numeric( _ppt(array('ship_country','price_'.$regions['key'][$i])) ) ){ 
						$cart['shipping'] += _ppt(array('ship_country','price_'.$regions['key'][$i])); 
					}
							
					// FLAT PERCENTAGE
					if( is_numeric( _ppt(array('ship_country','percentage_'.$regions['key'][$i])) )  ){ 		 
						$cart['shipping'] += ( $backup['subtotal'] * _ppt(array('ship_country','percentage_'.$regions['key'][$i])) /100);
					}
					   
				} 					
			}
		$i++;
		} 
	}
}

// COUNTRY TAX
if(_ppt('basic_country_tax_tax') == 1 && $delivery_country != "" ){

 
	$regions = _ppt('regions');					
	if(is_array($regions)){ 
		$i=0; 
		while($i < count($regions['name']) ){
			if($regions['name'][$i] !=""){	
			
			
				if( isset($regions['country']) && (!empty($regions['country'][$i]) && in_array($delivery_country, $regions['country'][$i]) ) 
				|| (!empty($regions['state'][$i]) && in_array($delivery_state, $regions['state'][$i]) ) ) { // COUNTRY OR STATE CHECKOUT	
				
			 
					// FLAT RATE 
					if( is_numeric( _ppt(array('tax_country','price_'.$regions['key'][$i])) ) ){ 
						$cart['tax'] += _ppt(array('tax_country','price_'.$regions['key'][$i])); 
					}
							
					// FLAT PERCENTAGE
					if( is_numeric( _ppt(array('tax_country','percentage_'.$regions['key'][$i])) )  ){ 		 
						$cart['tax'] += ( $backup['subtotal'] * _ppt(array('tax_country','percentage_'.$regions['key'][$i])) /100);
					}  
				} 					
			}
		$i++;
		} 
	}
}

 
	
// FREE SHIPPING
if( _ppt('basic_free_shipping') == '1'){  $fs = get_option('ppt_free_shipping_array'); 
 
	// FALLBACK IF NOT ARRAY
	if(!is_array($fs)){ $fs = array(); }	
	
	// LOOP THROUGH ALL REGIONS AND SEE IF WE HAVE A VALUE FOR THIS DELIVERY COUNTRY		 
	if(is_array($regions)){ $i=-1; while($i <= count($regions)){  $i++;
	 	
	if(isset($regions['name'][$i]) && $regions['name'][$i] !=""  ){ 
		
			if( isset($regions['country']) && isset($regions['country'][$i]) && ( is_array($regions['country'][$i]) && in_array($delivery_country, $regions['country'][$i]) ) 
			|| ( isset($regions['state']) && is_array($regions['state'][$i]) && in_array($delivery_country, $regions['state'][$i]) ) ) { // COUNTRY OR STATE CHECKOUT	
							 			 
				$region_name = $regions['name'][$i];
				 
				if(isset($fs[$region_name]) && strlen($fs[$region_name]) > 1 && $backup['subtotal'] > $fs[$region_name] ){
 
				$cart['shipping'] = 0;
	
				}
			}
				
	}}} // end if / foreach / if 
	
	// EXTRA FOR 
	if(isset($fs['default']) && is_numeric($fs['default']) && $fs['default'] > 0){	
		if($backup['subtotal'] > $fs['default'] ){
			$cart['shipping'] = 0;	 
		}
	}
	 
}



return $cart;

}
	
	
 


function shortcode_addtocart( $atts, $content = null ) { global $userdata, $CORE, $post; $STRING = ""; 
	
	   	extract( shortcode_atts( array(  'class' => '', 'btn' => 0 ), $atts ) );
		
		// CATELOG MODE
		if(_ppt('catalog_mode') == 1){ return ""; }
		
		$price = 10;
		$qty = 50;
		
		if(is_numeric($price) && $price != "" && ( $qty == "" || $qty > 0) ){
		
			// GET PRODUCT TYPE
			$product_type = get_post_meta($post->ID,'type',true);
		
		if($product_type  == 2){	
			
			//$buy_link =	hook_affiliate_link( get_post_meta($post->ID, 'buy_link', true ) );		
			$buy_link = get_home_url()."/out/".$post->ID."/buy_link/";	
				
		}else{
		
			$buy_link =	 get_permalink($post->ID);
			
		}
		
		if($btn){
		
		ob_start(); ?>
        
		<button type="button" class="<?php echo $class; ?>" onclick="ajax_cart('add', 1, '<?php echo $post->ID; ?>', '','yes');"><?php echo $content; ?></button>
        
		<?php
		return ob_get_clean();
		
		}else{
		
		
		ob_start(); ?>
        
		<a class="<?php echo $class; ?>"
		<?php if(isset($current_data) && is_array($current_data) && strlen($current_data['name'][0]) > 1 || $product_type  == 2 || get_post_meta($post->ID, 'price-on', true) == 1 ){ ?>
		href="<?php echo $buy_link; ?>"
		<?php }else{ ?>
		href="javascript:void(0);" 
		onclick="ajax_cart('add', 1, '<?php echo $post->ID; ?>', '','yes');" 
		<?php } ?>><?php echo $content; ?></a>
		<?php
		return ob_get_clean();
		
		}
		
		}	
				
 
} 

	
// ADD IN NEW CART JS FILE
function _shop_footer(){ global $CORE, $CORE_CART;


// GET CART DATA
$cart_data = $CORE_CART->cart_getitems(true);  

?>
 
<div>
<input type="hidden" name="ppt_shop_required" value="1" id="ppt_shop_required" />
<input type="hidden" name="ppt_shop_total_items" value="<?php echo $cart_data['total_items']; ?>" id="ppt_shop_total_items" />
<input type="hidden" name="ppt_shop_session" value="<?php echo session_id(); ?>" id="ppt_shop_session" />
<input type="hidden" name="ppt_shop_currency_symbol" value="<?php echo hook_currency_symbol(''); ?>" id="ppt_shop_currency_symbol" />
</div>
 
 
<!-- Modal -->
<div id="addedToCart" class="modal fade addcart hidepage" tabindex="-1" role="dialog" style="margin-top:20%; display:none;">

  <div class="modal-dialog"><div class="modal-wrap ppt-modal-shadow rounded-lg"><div class="modal-content rounded-0">
  
  <div class="modal-body"> 
  
  <div class="h4 my-3">
  
      <i class="fa fa-shopping-basket" aria-hidden="true">&nbsp;</i>
      
      <?php echo __('Basket Updated','premiumpress'); ?>
  
  </div>
  
  <p class="grey margin-bottom2"><?php echo __('Your items have been added to your basket.','premiumpress'); ?></p>
  
  <hr class="dashed margin-top2 margin-bottom2" />
 
  <div class="row">
  
    <div class="col-6">
        <button data-ppt-btn class="btn-block btn-secondary" data-dismiss="modal">
        <?php echo __('Continue','premiumpress'); ?>
        </button>    
    </div>
    <div class="col-6">
        <button data-ppt-btn class=" btn-block btn-primary" onclick="document.location.href='<?php echo _ppt(array('links','cart')); ?>'">
		<?php echo __('Checkout','premiumpress'); ?>
        </button>
    </div>
 
  </div>
  
  </div>

</div></div></div>

</div><!-- end modal -->

 
 
<?php

}	
	
	
	
 
	
	
	

/*
	this function applies the coupon code
	to the basket items
*/
function CODECODES_APPLYLISTING($c){
 
	$c = $c - $GLOBALS['CODECODES_DISCOUNT'];
	if($c < 0){ $c = 0; }
	
	return $c;	
}	
function CODECODES_APPLYCART($c){	
	  
		$GLOBALS['CODECODES_DISCOUNT_IISET'] = 1;	
		$c['discount'] += $GLOBALS['CODECODES_DISCOUNT'];
	 
	return $c;	
}
/*
	this function gets the discount for a
	coupon code entered by a user
*/
function cart_apply_couponcode(){ global $CORE, $CORE_CART;

		// COUPON CODE CHECKER
		if(isset($_POST['couponcode']) && strlen($_POST['couponcode']) > 0 ){			
			// DEFAULT RETURN
		  	$GLOBALS['error_message'] = __("Invalid Coupon Code","premiumpress")."<script>jQuery(document).ready(function() {jQuery('#myPaymentOptions').modal('show'); });</script>";		
			// CHECK THE CODES
			$ppt_coupons = get_option("ppt_coupons");
			 
			
			// CHECK WE HAVE SUCH A CODE
			if(is_array($ppt_coupons) && count($ppt_coupons) > 0 ){
				foreach($ppt_coupons as $key=>$field){
					if($_POST['couponcode'] == $field['code']){					 	
						
						// WORK OUT DISCOUNT AMOUNT
						$discount = $field['discount_percentage'];
						if($discount != ""){
							
							if(defined('WLT_CART')){
						 				
							$cart = $CORE_CART->cart_getitems();
							 	  						
							$GLOBALS['CODECODES_DISCOUNT'] = str_replace(",","",$cart['subtotal'])/100*$discount;	
							
							//die($discount."% of ".str_replace(",","",$cart['total'])." = ".$GLOBALS['CODECODES_DISCOUNT']);
							
							}else{
							
								// MEMBERSHIP PRICES
								if(isset($_POST['membershipID']) && is_numeric($_POST['membershipID']) ){
									$membershipfields 	= get_option("membershipfields");
									$payment_due = $membershipfields[$_POST['membershipID']]['price'];															
									// LISTING PRICES
								}else{
									if(isset($post->ID)){
									$postIDDD = $post->ID;
									}else{
									$postIDDD = $_GET['p'];
									}
									$payment_due = get_post_meta($postIDDD,'listing_price_due',true);									 	
									 					
								}
								$GLOBALS['CODECODES_DISCOUNT'] = $payment_due/100*$discount;
								 
									
							}
							
						}else{
							$GLOBALS['CODECODES_DISCOUNT'] = $field['discount_fixed']; 
						}
						 
						// HOOK INTO CART
						if(defined('WLT_CART') ){
						
							global $CORE_CART; 
							//$_SESSION['discount_code'] 			= strip_tags($_POST['couponcode']);
							//$_SESSION['discount_code_value'] 	= $GLOBALS['CODECODES_DISCOUNT'];
							add_action('hook_cart_data', array( $CORE_CART, 'CODECODES_APPLYCART') );
							
							
						}else{						 
							add_action('hook_payment_package_price', array( $this, 'CODECODES_APPLYLISTING') );
						}
						 						
						// UPDATE THE USAGE COUNTER	
						$ppt_coupons[$key]['used']++;
						
						// LEAVE ERROR MESSAGE
						$GLOBALS['error_message'] = __("Coupon Discount Applied.","premiumpress");
					}			
				} // end foreach
				// UPDATE THE USAGE COUNTER	
				update_option( "ppt_coupons", $ppt_coupons);
			} // end if			
		 }// end if

}

/*

this function calculates the discount for  aproduct
*/
function cart_item_discount(){ global $post;
 
	$oldp = get_post_meta($post->ID,'old_price',true);
	if($oldp != "" ){
		
		$price = get_post_meta($post->ID,'price',true);
		
		$discount = ($price / $oldp ) * 100;
		 
		
		return round($discount,0);
	}
	
	return false;

}

/*
	this function returns items from
	your shopping cart
*/
function cart_getitems(){
		
		global $wpdb, $userdata, $CORE; $total_items = 0; $total_tokens = 0;
	 
		$cart_defaults = array(
			"userid" 		=> 0, 
			"total_items" 	=> 0, 
			"total" 		=> 0, 
			"subtotal" 		=> 0, 
			"qty" 			=> 0, 
			"tax" 			=> 0, 
			"weight_class" 	=> 0,
			"weight" 		=> 0, 			
			"tokens" 		=> 0,  
			"shipping" 		=> 0,
			"comments" 		=> "", 
			"discount" 		=> 0, 
			"discount_code" => "", 
			"method" 		=> "",
			"session" 		=> session_id(), 
			"items" 		=> array()
		);
 		
	   if(isset($_SESSION['checkout-method'])){
	   $cart_defaults['method'] = $_SESSION['checkout-method'];
	   }
		  
		if(isset($_SESSION['ppt_cart']) && is_array($_SESSION['ppt_cart'])){
			// LOOP ITEMS
			foreach($_SESSION['ppt_cart'] as $key => $items){
				// GET INNER ITEM COUNT
				if(is_array($items)){
				$innerID = 1;
					foreach($items as $item){
					 	 
						$total_items += $item['qty'];
					 
						// TOTAL IS THE STORED ITEM PRICE X QTY
						$amount 	= get_post_meta($key,"price",true); 
						  			
						if(!is_numeric($amount)){ 	$amount = 0; }
						// WEGIGHT
						$weight 					= get_post_meta($key,"weight",true); 
						$weight_class				= get_post_meta($key,"weight_class",true);						
						$cart_defaults['weight_class'] = $weight_class;							
						if(!is_numeric($weight)){ 	$weight = 0; }
						$cart_defaults['weight'] 	+= $weight*$item['qty'];						
						// QTY
						$cart_defaults['subtotal'] += $amount*$item['qty'];
						$cart_defaults['qty'] 	+= $item['qty'];
						$custom					= "";
						// CHECK FOR ADDITIONAL PRICE EXTRAS

						if(is_array($item['extra']['ship'])){ 
						$cart_defaults['shipping'] += $item['extra']['ship'];
						}// end if
						
						
						// CHECK FOR CUSTOM AMOUNTS						
					 	$customdata = "";
						if(is_array($item['extra']['custom']) && is_array($item['extra']['custom']) ){ 	
							
							// SAVE FOR LATER
							$customdata = $item['extra']['custom'];
						
						 	// LOOP EXTRAS AND INCREASE PRICE 
							foreach($item['extra']['custom'] as $custom_item){
								
								// CUSTOM FIELD ATTRIBUTES							
								$display = $custom_item['amount'];	
								 
								// IF ITS A NUMERICAL VALUE, ASSUME ITS A PRICE				 
								if(is_numeric($custom_item['amount'])){								
									$cart_defaults['subtotal'] += ($custom_item['amount']*$item['qty']);						
									$amount += $custom_item['amount'];
									 								
									if(isset($display_text)){
									$display = $display_text;
									} 
								}// end if numeric
								
								// BUILD DISPLAYS TRING						
								$custom .= $custom_item['text'];
							} // end if
						}
						
						// ADD ON TOKENS
						if(isset($item['extra']['tokens']) && $item['extra']['tokens'] == 1){ 
						$total_tokens = $amount;						
						}
						 
						// CHECK FOR PRODUCT DISCOUNTS
						$current_discount_data = get_post_meta($key,"ppt_productdiscounts",true); 
						if(is_array($current_discount_data) && !empty($current_discount_data) ){
							$di=0; $num_discounts = count($current_discount_data);
							// LOOP DISCOUNTS
							while($di < $num_discounts){															 
								if(isset($current_discount_data['min'][$di]) && $item['qty'] >= $current_discount_data['min'][$di] && $item['qty'] <= $current_discount_data['max'][$di]){
									$old_item_price = get_post_meta($key,"price",true);
									$new_price_per_product = $current_discount_data['price'][$di];
									$new_discount = ($new_price_per_product*$item['qty']-$old_item_price*$item['qty']);
									if($new_discount < 0){
									$cart_defaults['discount'] += $new_discount;
									}
									//$amount = $new_price_per_product;
								}
							$di++;
							}
							 
							 $cart_defaults['discount'] = str_replace("-","",$cart_defaults['discount']);
						}
						
						
					 
						
											 			
						// IF WE ARE GETTING EVERYTHING, INCLUDE ALL OF THE PRODUCT INFORMATION						 
						$permalink = get_permalink($key);
						$image = "";
						if ( has_post_thumbnail($key) ) { 						
							$image = '<a href="'.$permalink.'" class="frame">';
							$image .= hook_image_display(get_the_post_thumbnail($key,'thumbnail',array('class'=> "img-fluid")));
							$image .= '</a>';	
						}else{
							// CHECK FOR FALLBACK IMAGE
							$fimage = $CORE->FALLBACK_IMAGE($key); 
							if($fimage !=""){ //&& !isset($GLOBALS['flag-single'])
							$image = '<a  href="'.$permalink.'" class="frame">';
							$image .= $fimage; 
							$image .= '</a>';
							}
						}
						  
						
						$cart_defaults['items'][$key][$innerID] = 
						array (
						"innerID" 	=> $innerID,
						"name" 		=> get_the_title($key), 
						"link" 		=> $permalink,
						"amount" 	=> $amount,
						"image" 	=> $image, 
						"image-path" 	=> do_shortcode("[IMAGE pathonly=1 pid='".$key."']"),
						"qty"		=> $item['qty'],
						"tokens"	=> $item['extra']['tokens'], 
						"shipping" 	=> $item['extra']['ship'],
						"custom"	=> $custom, 
						"custom_data" => $customdata,
						);				
						$innerID++;
						 
					} // end foreach
					
				} // end if
				
			} // enf foreach		
		} // end if
		 
		
		// UPDATE COMMENTS
		if(isset($_SESSION['ppt_cart']['comment'])){ $cart_defaults['comments'] = stripslashes(strip_tags($_SESSION['ppt_cart']['comment'])); }
  	
	  
		// CHECK FOR COUPON CODE		
		if(isset($_SESSION['discount_code']) && strlen($_SESSION['discount_code']) > 3 ){		 
		 
			//$cart_defaults['discount_code'] = strip_tags($_SESSION['discount_code']);
			
			$GLOBALS['CODECODES_DISCOUNT'] = $_SESSION['discount_code_value'];
			
			//die($_SESSION['discount_code']."<--".$_SESSION['discount_code_value'].print_r($_SESSION));
			
			add_action('hook_cart_data', array( $this, 'CODECODES_APPLYCART') );
		}
		
		// HOOK INTO THE ARRAY
		$cart_defaults = hook_cart_data($cart_defaults);	
		
		// CALCULATE TOKENS AMOUNT
		$cart_defaults['total_tokens'] = $total_tokens;
		 
		
		if(isset($GLOBALS['flag-cart'])){
			 	 
			$cart_defaults['shipping'] = 0;
							
		}
						
			 	
		// CALCULATE SUBTOTAL		
		$cart_defaults['total'] =  number_format((float)($cart_defaults['subtotal'] + $cart_defaults['shipping'] + $cart_defaults['tax']) - $cart_defaults['discount'], 2);	
		 
		// UPDATE TOTAL ITEMS
		$cart_defaults['total_items'] = $total_items;
		
		if($userdata->ID){
		$cart_defaults['userid'] = $userdata->ID;
		}
		 	
		// RETURN COMPLETE ARRAY	 
		return $cart_defaults;
	}

 

	
	function cart_weightclass($num){
		
		switch($num){
			case "1": {
				return "g";
			} break;
			case "2": {
				return "lb";
			} break;
			case "3": {
				return "oz";
			} break;
			default: { 
				return "KG";
			}
		}
	} 
 
	
	
	function _downloadproduct(){ global $wpdb, $CORE, $userdata;
	 
		if(isset($_POST['downloadproduct']) && isset($_POST['data'])  ){
			 
			$data_array = (array)json_decode(base64_decode($_POST['data']));
			 
			// UPDATE DOWNLOAD COUNTER
			$gg = get_post_meta($data_array['pid'], 'download_count',true);
			if($gg == ""){ $gg = 0; }
			update_post_meta($data_array['pid'], 'download_count', $gg+1);
			  	
		 	
			// START DOWNLOAD
			if(isset($data_array['aid']) && ( in_array($data_array['type'], $CORE->allowed_image_types) || in_array(strtolower($data_array['type']), array('jpeg','png','jpg') ) ) ){
					 
						$image  = wp_get_attachment_image_src( $data_array['aid'], 'full' );
						//$image_data = wp_get_attachment_metadata( $data_array['aid'] );						 		 
						$uploads = wp_upload_dir();			 
						$image_e = wp_get_image_editor( $image[0] );
						$filename = $data_array['width']."x".$data_array['height']."-".$data_array['pid'].".".substr($image[0],-3);
						// MAKE FILENAME
					 
								
						 	
						if ( ! is_wp_error( $image_e ) ) {
							 								
								$image_e->resize( $data_array['width'], $data_array['height'], true );									
								$image_e->set_quality( 100 );
								$image_e->save( $uploads['path'].$filename );								
							
						}
							
						$file = $uploads['path'].$filename;
						 
						
						$deletefile = true;
			
			}elseif(isset($data_array['aid']) && in_array($data_array['type'], $CORE->allowed_video_types) ){
			
				$video  = wp_get_attachment_metadata( $data_array['aid'] );
				 
				$filename =  $video['name'];
				$file = $video['filepath'];
				 	
			}else{
					 
						$file = get_post_meta($data_array['pid'], 'download_path',true);
						
						
						
						// ASSUME THE USER HAS LINKED TO THE FILE
						if(strpos($file,get_home_url()) !== false){			
							$b = explode("/wp-content/",THEME_PATH);		
							$file = str_replace(get_home_url(),$b[0],$file);			
						}
						
						$filename = $file;
						 
			 
			} 
			
			
			// SOFTWARE THEME REMOVE DOWNLOAD FROM LIMITS
			if($userdata->ID && in_array(THEME_KEY,array("so","ph"))){
			$CORE->USER("update_user_free_membership_addon", array("downloads", $userdata->ID, $data_array['pid'] ) );
			}
			
			 
			if(substr($file,0,4) == "http"){			
			
			header("location:".$file);
			die();
			
			} 
		 
			//ini_set('memory_limit','256M');	
			if(file_exists($file)) {
						header('Content-Description: File Transfer');
						header('Content-Type: application/octet-stream');
						header('Content-Disposition: attachment; filename='.basename($filename));
						header('Content-Transfer-Encoding: binary');
						header('Expires: 0');
						header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
						header('Pragma: public');
						header('Content-Length: ' . filesize($file));
						ob_clean();
						flush();
						readfile($file);
						if(isset($deletefile)){ unlink($file); }
						exit;
			}else{
			die("<h1>Download Error</h1><p>The file your looking for has been moved or deleted. Please contact the website owner.</p>");
			}		
		}
	}
	
	
 
 
 
 
	
	/*
		this function displays the extra tax
		percentage set via the admin area
	*/
	function _curreny_extra_tax($p){ global $post;
	
	// DONT INCLUDE DISPLAY TAX ON CHECKOUT
	if(isset($GLOBALS['flag-checkout']) || isset($_GET['invoiceid']) || isset($GLOBALS['flag-callback']) ){ return $p; }
 	if(!isset($GLOBALS['CORE_THEME']['display_percentage']) || !is_numeric($GLOBALS['CORE_THEME']['display_percentage']) ){ return $p; }
	
	
		$p = strip_tags($p); 
		 if($p > 0){ 
			$p = str_replace(",","",$p);
			$p += ($p/100*$GLOBALS['CORE_THEME']['display_percentage']);	
			$p = round($p,2);			
			$seperator = "."; $sep = ","; $digs = 2; 
			if(is_numeric($p)){		
			$p = number_format($p,$digs, $seperator, $sep); 
			}		 
		}
	 
	 
		return $p;
	}
	  
	
	
}

?>