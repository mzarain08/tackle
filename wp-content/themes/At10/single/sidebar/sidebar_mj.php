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

if(isset($post->ID)){

   // GET PRICE
    
   $price = get_post_meta($post->ID, 'price', true);
   $price = str_replace(",","",hook_price(array($price,0)));
   $name = get_post_meta($post->ID, 'gig', true);
   
   $price2 = get_post_meta($post->ID, 'price-1', true);
   $price2 = str_replace(",","",hook_price(array($price2,0))); 
   $name2 = get_post_meta($post->ID, 'gig-1', true);
   
   $price3 = get_post_meta($post->ID, 'price-2', true);
   $price3 = str_replace(",","",hook_price(array($price3,0)));
   $name3 = get_post_meta($post->ID, 'gig-2', true);
   
   $desc = get_post_meta($post->ID,'desc',true);
   $desc2 = get_post_meta($post->ID,'desc-1',true);
   $desc3 = get_post_meta($post->ID,'desc-2',true);
   
   $days = get_post_meta($post->ID,'days',true);
   $days2 = get_post_meta($post->ID,'days-1',true);
   $days3 = get_post_meta($post->ID,'days-2',true);
    
   
if(is_admin()){

	$allGigs = array(
	
		1 => array( "name" 	=> "Job Title Here", "days" => 5, "desc" => "This is the user description",	"price" => 10.99  ),
		2 => array( "name" 	=> "Job Title Here", "days" => 10, "desc" => "This is the user description",	"price" => 15.99  ),
		3 => array( "name" 	=> "", "days" => 15, "desc" => "This is the user description",	"price" => 20.99   ),
	 
	);

}else{

	$allGigs = array(
	
		1 => array( "name" 	=> $name, 	"days" => $days, "desc" => $desc,	"price" => $price  ),
		2 => array( "name" 	=> $name2, 	"days" => $days2, "desc" => $desc2,	"price" => $price2  ),
		3 => array( "name" 	=> $name3, 	"days" => $days3, "desc" => $desc3,	"price" => $price3  ),
	 
	);

}
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

   
   // GET THE CURRENT SALES AMOUNT
   $sales_count = get_post_meta($post->ID, 'sales_count', true);
   $purchase_type = get_post_meta($post->ID, 'purchase_type', true);   
 
   // LISTING STATUS
   $status = get_post_meta($post->ID, 'status', true);
   
   
	// TURN OFF DAYS
	$showdays = true;
	$el = _ppt(array('design', "element_days"));
	if($el == 0){
	$showdays = false;
	}
	
	// EXTRAS
	$current_data = get_post_meta($post->ID,'customextras', true); 

 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 
foreach($allGigs as $key => $gig){
 
if(strlen($gig['name']) < 3){ continue; }
?>
<?php if(strlen($gig['desc']) > 1){ ?>

<div class="badge_tooltip z-10" data-direction="top">
  <div class="badge_tooltip__initiator">
    <?php } ?>
    <a href="javascript:void(0);" onclick="ProcessBuy('<?php echo $key; ?>','<?php echo $gig['price']; ?>');"  class="mb-3 text-decoration-none text-dark link-dark btn-block p-3 rounded" ppt-border1 style="min-height: 80px;">
    <div class="d-flex">
      <div class="w-100">
        <div class="d-flex justify-content-between">
          <div class="w-100">
            <div  class="text-700">
              <?php echo $gig['name']; ?>
            </div>
            <div class="small mt-2">
            
            <ul class="list-inline mb-0">
            
            <li class="list-inline-item mr-3">
             <div class="text-700 text-primary prictag h6 mb-0 <?php echo $CORE->GEO("price_formatting",array()); ?>" data-price-amount="<?php echo $gig['price']; ?>">
                <?php if(!is_numeric($gig['price']) || $gig['price'] == "0"){ echo __("Free","premiumpress"); }else{ echo $gig['price']; } ?>
              </div> 
            </li>
            <li class="list-inline-item"> 
          		<div class="d-flex">
                <span><i class="fal fa-clock mr-2"></i></span>
                <span><?php if(is_numeric($gig['days']) && $gig['days'] > 0){ echo $gig['days']." ".__("day delivery","premiumpress");  }else{  echo __("no time limit","premiumpress"); } ?></span>
                </div> 
            </li>
            </ul>  
            </div>
          </div>
          <i class="fa fa-chevron-right fa-2x mt-2 mr-2"></i>
        </div>
      </div>
    </div>
    </a>
<?php if(strlen($gig['desc']) > 1){ ?>
  </div>
  <div class="badge_tooltip__item text-center"  style="width:250px;">
    <?php echo $gig['desc']; ?>
  </div>
</div>
<?php } ?>


<?php } ?>
<?php


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$showAddons = 0;
if(is_array($current_data) && !empty($current_data) && $current_data['name'][0] != "" ){ 

$showAddons = 1;

?>
<div id="job_addons" class="clearfix mt-3" style="display:none;" ppt-border1>
  <input type="hidden" value="" id="backcustom">
  <ol id="customextraslist" class="list-group mt-3">
    <?php  $i=0; 
			
            	foreach($current_data['name'] as $key => $data){ 
            	
            		if($current_data['name'][$i] !="" && is_numeric($current_data['price'][$i]) ){
            	  
            			?>
    <li class="list-group-item text-left ronded-0 addon<?php echo $i; ?>" onclick="setactiveaddon('addon<?php echo $i; ?>');" 
                        style="cursor:pointer;" data-id="<?php echo $i; ?>" data-price="<?php echo $current_data['price'][$i]; ?>"> <strong><?php echo $current_data['name'][$i]; ?></strong> <span class="badge badge-success badge-pill float-right <?php echo $CORE->GEO("price_formatting",array()); ?>" data-price-amount="<?php echo $current_data['price'][$i]; ?>"><?php echo $current_data['price'][$i]; ?></span>
      <div class="small mt-1">
        <?php echo trim($current_data['value'][$i]); ?>
      </div>
    </li>
    <?php } 
            
            	$i++; 
            	}
            
			?>
    <li class="list-group-item border-top text-center">
      <button onclick="clearaddon();AdjustPrice();" type="button" data-ppt-btn class="btn-block btn-lg list btn-system clearaddonbutton font-weight-bold"> <i class="fa fa-times m-0 mr-2"></i> <span><?php echo __("Remove Extras","premiumpress"); ?></span> </button>
    </li>
  </ol>
</div>
<?php } 
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
<div class="ppt-single-button-box mt-4">
  <div class="wrap">
   
   <?php if($showAddons){ ?>
    <a href="javascript:void(0);" onclick="jQuery('#job_addons').toggle();jQuery('#bottomcard').toggle();jQuery('.gig-desc').hide();" data-ppt-btn class="btn-block btn-lg list btn-primary text-600"> <?php echo __("View Add-ons","premiumpress") ?></a>
   <?php } ?>
   
   
    <?php
    
    if(in_array(_ppt(array('design','display_offerbtn')), array("","1")) ){ $GLOBALS['flag-set-makeoffer'] =1; ?>
    <a href="javascript:void(0);" <?php if(!$userdata->ID){ ?>onclick="processLogin();"<?php }else{ ?>onclick="processMakeOffer();"<?php } ?> data-ppt-btn class="btn-block btn-lg list btn-block btn-makeoffer btn-primary text-600"> <span><?php echo __("Make Offer","premiumpress"); ?></span></a>
    <?php } 
    
    ?>
  </div>
</div>
<?php
	  
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
<textarea id="hh" style="display:none;"><?php
   $cartdata = array(
   	"uid" => $userdata->ID, 
   	"amount" => $price, 
   	"order_id" => "MJ-".$post->ID."-".$userdata->ID."-1-0-".rand(1, 1000000),
   	"description" => __("Payment for Job ID","premiumpress")." #".$post->ID,	
   	"recurring" => 0,	
   	"credit" => 1,						
   );
    
   $jj = $CORE->order_encode($cartdata); echo $jj; ?>
</textarea>
<input type="hidden" value="0" id="mjaddonsprice" />
<script>


function ProcessBuy(key, price){


  <?php if(!$userdata->ID){ ?>
  
  processLogin(1,0);
  
  <?php //}elseif($userdata->ID == $userdata->ID){ ?>
  
  
  
  <?php }else{ ?>
 
	// PROCESS AND GET ORDER ID
 	addonid = AdjustPrice(); 
 
	// BUILD THE ORDER ID
	neworderid = "MJ-<?php echo $post->ID; ?>-<?php echo $userdata->ID; ?>-" + key + "-"+ addonid+'-'+Math.floor((Math.random() * 10000) + 1);
	
	console.log(neworderid);
	
	// NEW TOTAL
	total = parseFloat(price) + parseFloat(jQuery("#mjaddonsprice").val());
 
   	// RECALCULATE PRICE
   	jQuery.ajax({
            type: "POST",
            url: ajax_site_url,		
      		data: {
            action: "load_new_payment_form_recalculate",
   			details: jQuery('#hh').val(),
   			amount: total,
   			orderid: neworderid,
    },
     success: function(response) {
			   
      			jQuery('#hh').val(response);
			 	
				    // MAKE THE ORDER HAPPEN
					processNewPayment(jQuery('#hh').val()); 
				
						
              },
              error: function(e) {
                  console.log(e)
              }
    }); 
	  
  
  <?php } ?>
  
  

} 

function AdjustPrice(){ 
	 
	 
	 
	// GET ACTOVE ADDON PRICE
	var addonprice = jQuery('#customextraslist').find('.active').data('price');
 
	if(!isNaN(addonprice)) {
			addonprice = parseFloat(addonprice);
			var addonid = jQuery('#customextraslist').find('.active').data('id');
	}else{
		addonprice = 0;
		addonid = "na";
	}
 
	jQuery("#mjaddonsprice").val(addonprice);
	 
	
	var a = jQuery(".prictag");
	a.each(function (a) {		
		cprice = jQuery(this).attr('data-price-amount'); 		
		nprice = parseFloat(cprice) + parseFloat(addonprice);		
		jQuery(this).text(nprice); 
	});
	
	// UPDATE PRICE DISPLAY
	UpdatePrices();  
	 
	return addonid;
} 


function resetstate(){

	
	jQuery('#job_addons').hide('slow');  
	
	jQuery('.gig-desc').show('slow');
	 
} 
function setactiveaddon(a){

	// SET ACTIVE ADD-ON DISPLAY 
	jQuery('#customextraslist li').removeClass('active');
   	jQuery('.'+a).addClass('active');
	
	
	
	if(jQuery(".ppt-tabs-listing > ul li").length == 1){
	
	}else{
	
	jQuery(".btn-makeoffer").hide();
	
	resetstate();
	
	}
	
	// NOW SET BASE
	AdjustPrice();
}
function clearaddon(a){

	// CLEAR ACTIVE ADDONS
	jQuery('#customextraslist li').removeClass('active');
	
	jQuery("#mjaddonsprice").val(0);
	
	jQuery(".btn-makeoffer").show();

 	resetstate();
}
      
function ShowMakeOffer(on){

	jQuery('#listing-page-spinner').html('<div class="text-center mt-5 pt-5"><i class="fa fa-spinner fa-4x text-primary fa-spin"></i></div>');
	
	jQuery('#listing-page-wrapper').hide();
	jQuery('.hero-single').hide();
	if(on == 0){
	jQuery('#makeoffer').hide();
	}

	setTimeout(function(){ 
		
		if(on == 1){		  		
		jQuery('#makeoffer').show();
		}else{		
		jQuery('#listing-page-wrapper').show();
	 
		jQuery(window).trigger('resize'); 
		}
		
		jQuery('#listing-page-spinner').html('');
				
	},1500);

}
 
</script>
<?php } ?>
