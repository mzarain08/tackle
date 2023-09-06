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

$qty = get_post_meta($post->ID, "qty", true );
if($qty == ""){ $qty = 10; }
$qty_min = 1;
 
// GET PRODUCT TYPE
$product_type = get_post_meta($post->ID,'type',true);
 
?>

<div ppt-border1 class="p-3 ppt-forms style3">
 
<?php if($qty > 0){ ?>


<div class="mb-2">
<?php

		 $GLOBALS['single-data-field'] = "price";
		 echo _ppt_template( 'single/single-content-data-fields-single' );
		 unset($GLOBALS['single-data-field']); 

?>
</div>


<div class="row">
  <?php if($qty == 1){ ?>
  <input type="hidden" id="qtyvalue" value="1">
  <?php }elseif($qty > 1){ ?>
  <div class="col-12 col-lg-6 mb-3 mb-md-0"  id="qtybox">
    <label class="small text-muted btn-block font-weight-bold"><?php echo __("Quantity","premiumpress"); ?></label>
    <div id="qtyvaluewrapper">
      <select class="form-control" id="qtyvalue" onchange="updateqtyfield(this.value);">
        <?php $i=1;  while($i < ($qty+1) ){ if($i > 5){ $i++; continue; } ?>
        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
        <?php $i++; } ?>
        <?php if($qty > 5){ ?>
        <option value="custom">5+</option>
        <?php } ?>
      </select>
    </div>
  </div>
  <?php } ?>




<?php if(is_array(_ppt('listingtax')) && in_array("size", _ppt('listingtax'))){ 

// SIZE
$cats = get_terms( "size", array( 'hide_empty' => 0, 'parent' => 0  ));

$foundcats 	= wp_get_object_terms( $post->ID, "size" );

if(is_array($foundcats) && !empty($foundcats)){

$ordered_list = array_column($foundcats, 'term_order');

if(!empty($ordered_list)){ 
array_multisort( $ordered_list, SORT_ASC, $foundcats);
}

?>
  <div class="col-lg-6 mb-2 mb-md-0">
 
    <label class="small text-muted btn-block font-weight-bold"><?php echo $CORE->GEO("translation_tax_key", "size"); ?> </label>
    <select class="form-control field-attribute-select">
      <?php

$i=0; 
foreach($foundcats as $cat){

$selected_categories[$cat->term_id] = $cat->term_id;

$customprice = get_post_meta($post->ID, 'price_addone_' . $cat->term_id . '_value', true );
if($customprice == "" || !is_numeric($customprice)){
$customprice = 0;
}


?>
      <option <?php if($i == 0){ echo 'selected=selected'; } ?>
        
         name="size" 
         value="<?php echo $cat->name; ?>" 
         data-key='size'
         data-value='0'
         data-amount='<?php echo $customprice; ?>' 
         data-stock='100'
         data-tokens='0'        
        > <?php echo $cat->name; ?>
      <?php /*if($customprice != 0){ ?>
      (+<?php echo hook_price($customprice); ?>)
      <?php }*/ ?>
      </option>
      <?php $i++; } ?>
    </select>
  </div>
  <?php } ?>
  <?php 
	
}
		  

if(is_array(_ppt('listingtax')) && in_array("color", _ppt('listingtax'))){ 

// SIZE
$cats = get_terms( "color", array( 'hide_empty' => 0, 'parent' => 0,  'orderby' => 'term_order' ));

$foundcats 	= wp_get_object_terms( $post->ID, "color");
 
if(is_array($foundcats) && !empty($foundcats)){

$ordered_list = array_column($foundcats, 'term_order'); 

if(!empty($ordered_list)){ 
array_multisort( $ordered_list, SORT_ASC, $foundcats);
}
 

?>
  <div class="col-12 mt-2 my-3">
    <label class="small text-muted btn-block font-weight-bold"><?php echo $CORE->GEO("translation_tax_key", "color"); ?></label>
    <select class="form-control field-attribute-select" >
      <?php 

$i = 0;
foreach($foundcats as $cat){

$selected_categories[$cat->term_id] = $cat->term_id;

$customprice = get_post_meta($post->ID, 'price_addone_' . $cat->term_id . '_value', true );
if($customprice == "" || !is_numeric($customprice)){
$customprice = 0;
}
?>
      <option name="color" <?php if($i == 0){ echo 'selected=selected'; } ?>  
         value="<?php echo $cat->name; ?>" 
         data-key='color'
         data-value='0'
         data-amount='<?php echo $customprice; ?>' 
         data-stock='100'
         data-tokens='0'
        ><?php echo $cat->name; ?>
      <?php /*if($customprice != 0){ ?>
      (+<?php echo hook_price($customprice); ?>)
      <?php }*/ ?>
      </option>
      <?php $i++; } ?>
    </select>
  </div>
  <?php } ?>
  <?php } ?>
  <?php 


$tax = get_option('custom_taxonomy');  

 
if(is_array($tax)){
foreach ( $tax as $taxonomy ) {  


if(is_array(_ppt('listingtax')) && in_array($taxonomy, _ppt('listingtax')) && !in_array($taxonomy, array('size','color'))){ 


	// GET DATA
	$cats = get_terms( array( 'taxonomy' => $taxonomy, 'parent' => 0, 'hide_empty' => 0 )  );
if(!empty($cats)){
?>
  <div class="mt-2">
    <label class="small text-muted btn-block font-weight-bold"><?php echo $CORE->GEO("translation_tax_key", $taxonomy); ?></label>
    <select class="form-control field-attribute-select price-<?php echo $taxonomy; ?>">
      <?php 
foreach($cats as $cat){

 
$customprice = 0;
?>
      <option name="<?php echo $taxonomy; ?>" 
         value="<?php echo $cat->name; ?>" 
         data-key='<?php echo $taxonomy; ?>'
         data-value='0'
         data-amount='<?php echo $customprice; ?>' 
         data-stock='100'
         data-tokens='0'
        ><?php echo $cat->name; ?></option>
      <?php } ?>
    </select>
  </div>
  <?php } } ?>
  <?php } } ?>
</div>


<?php if($product_type == 2){ ?>

<a href="<?php echo get_post_meta($post->ID,'buy_link',true); ?>" rel="nofollow" target="_blank" data-ppt-btn class=" btn-block btn-xl btn-primary mb-3"> <i class="fal fa-shopping-basket"></i> <span><?php echo __("Buy Now","premiumpress"); ?></span></a>

<?php }else{ ?>


<div class="row mt-3">
  <div class="col-12">
    <button type="button" id="single_addcart_btn" data-ppt-btn class="btn-block btn-lg btn-primary mb-3"><?php echo __("Add to cart","premiumpress"); ?></button>
  </div>
    
</div>

     <?php
        $GLOBALS['single-data-button-new-css'] = "btn-primary btn-block btn-lg list mb-3";
        $GLOBALS['single-data-button'] = "favs"; 
        echo _ppt_template( 'single/single-content-data-buttons' ); 
        unset($GLOBALS['single-data-button']); 
        ?>

<?php }



///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

}else{ 


$dd = get_post_meta($post->ID,'stock_outofmsg', true); ?>


<div class="py-4 text-center text-600">

<?php  if($dd == ""){ echo __("Out of stock","premiumpress"); }else{ echo $dd; } ?>

</div>
 
<?php }

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 ?>
 
 
<div id="ppt-cart-data-check" data-max="<?php echo $qty; ?>" data-pid="<?php echo $post->ID; ?>" data-random="<?php echo rand(1, 1000000); ?>"></div> 

<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>    

<div class="price-addon" data-amount="<?php echo get_post_meta($post->ID, 'price', true); ?>"></div>
   <input id="totalpricedue" value="0" type="hidden" />
    <textarea id="hh" style="display:none;"><?php
   $cartdata = array(
   	"uid" 			=> $userdata->ID, 
   	"amount" 		=> get_post_meta($post->ID, 'price', true), 
   	"order_id" 		=> "CART-".$post->ID."-".$userdata->ID."-".rand(1, 1000000),
   	"description" 	=> esc_attr($post->post_title),	
   	"recurring" 	=> 0,	
   	"credit" 		=> 1,						
   );
    
   $jj = $CORE->order_encode($cartdata); echo $jj; ?>
</textarea>
</div>


<div id="priceAdded">
 
</div>
<script>
jQuery(document).ready(function(){
 	
	setTimeout(function(){ 
	
		jQuery('.field-attribute-select').each(function(i, obj) {
		
			jQuery(this).change(function(e) { 
						
				checkPricechange(this);				
				checkPriceUpdateTotal();
			
			});
			 
			checkPricechange(this);
			checkPriceUpdateTotal();					  
		});	  
					
	}, 3000);
	 
	
});	

function checkPricechange(t){

	input = jQuery(t).find(':selected');		 
	newprice = parseFloat(input.data( "amount" )); 	
	newkey = input.data( "key" ); 
	jQuery('.kk-'+newkey).remove();	
	jQuery("#priceAdded").append('<div class="padd amm-'+newprice+' kk-'+newkey+'" data-amount="'+newprice+'"></div>');	
 
}

function checkPriceUpdateTotal(){

	price = "<?php echo get_post_meta($post->ID,'price',true); ?>";
	total = 0;
	
	jQuery('.padd').each(function(i, obj) {
		total = total + parseFloat(jQuery(this).data('amount'));
	}); 
	
	newp = parseFloat(price) + parseFloat( total );	
	//console.log(parseFloat( total ) + ' + ' + parseFloat(price) + ' ='+newp);	
	jQuery(".data-fields-single").html(newp );

	UpdatePrices(); 
 
}

</script>