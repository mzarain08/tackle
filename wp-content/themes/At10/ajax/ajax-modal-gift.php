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

global $post, $CORE, $userdata;

$pid = $_POST['pid']; 
$uid = $_POST['uid'];


?>

      <div class="alert p-3 my-4 text-success m-4" id="giftsent" style="display:none;">
        <i class="float-left pb-2 fa-3x fa fa-check mr-3"></i>
        <div class="lead font-weight-bold">
          <?php echo __("Gift Sent!","premiumpress"); ?>
        </div>
        <p class="mb-0 pb-0"><?php echo __("Your gift is on it's way, the user will be notified shortly.","premiumpress"); ?></p>
       
      </div>
      
      <div class="alert p-3 my-4 text-danger m-4" id="toomnaygifts" style="display:none;">
        <i class="float-left pb-2 fa-3x fa fa-heart-broken mr-3"></i>
        <div class="lead font-weight-bold">
          <?php echo __("Too Many Gifts","premiumpress"); ?>
        </div>
        <p class="mb-0 pb-0"><?php echo __("It looks like you've already sent this user a gift.","premiumpress"); ?></p>
       
      </div>

<div class="card-body p-0" id="giftselect">
<div class="p-3">

<div class="container p-md-5">
  <div class="row" id="gifticons">
    <?php $i=1; while($i < 9){ 			
			
			// DEFAULT IMAGE
			if(defined('THEME_KEY') && in_array(THEME_KEY, array("es")) ){
			$defaultimg = get_template_directory_uri()."/_escort/icons/".$i.".png";
			}else{
			$defaultimg = get_template_directory_uri()."/_dating/icons/".$i.".png";
			}
			
			if( strlen(_ppt(array('giftimg', $i))) > 2 ){			
			 		
				$defaultimg = _ppt(array('giftimg', $i));				
			}
			
			// PRICE
			$price = _ppt(array('giftprice', $i));
			if(!is_numeric($price)){
			$price = 0;
			}
			
			// PRICE TAG
			if($price == 0){
			$price_tag = __("free","premiumpress");
			}else{
			$price_tag = hook_price(array($price,0));
			}
		 	
			
			?>
    <div class="col-4 col-md-3 gifti<?php echo $i; ?> pb-4 mt-4">
      <a href="javascript:void(0);" <?php if($userdata->ID == $uid){ ?>onclick="alert('<?php echo __("You cannot send yourself a gift.","premiumpress") ?>');"<?php }else{ ?>onclick="SendGiftItem('<?php echo $i; ?>');"<?php } ?>> <img src="<?php echo $defaultimg; ?>" alt="gif" class="img-fluid" /></a>
      
<span class="price-tag-wrap">
    <span class="price-tag text-uppercase"><a href="javascript:void(0)" class="<?php if($price_tag != "free"){ echo $CORE->GEO("price_formatting",array()); } ?>"><?php echo $price_tag; ?></a></span>
</span>
      
    </div>
    
    <?php if($price > 0){ 
	
	$orderID = "GIFT-".$uid."-".$pid."-".$userdata->ID."-".$i."-".rand(0,1000000);
	?>
    <input type="hidden" id="giftprice<?php echo $i; ?>" value="<?php
   
   echo $CORE->order_encode(array(   
   	"uid" 			=> $userdata->ID, 
   	"amount" 		=> $price,    	
   	"order_id" 		=> $orderID,   	 
   	"description" 	=> __("Gift Purchase","premiumpress"),   	
   	"recurring" 	=> 0,  
   	"couponcode" 	=> 0,
	//"hidecouponbox" => 1,   								
   ) ); 
    		
   ?>" />
   <?php }else{ ?>
   <input type="hidden" id="giftprice<?php echo $i; ?>" value="0" />
   <?php } ?>
    
    
    <?php $i++; } ?>
  </div>
</div>


<div class="pt-3 text-center border-top">

<div class="text-600"><?php echo  __("Show them you really care and send them a gift.","premiumpress"); ?></div>

</div>
 

<script>
function SendGiftItem(tid){

 
 
if(jQuery("#giftprice"+tid).val().length > 10){

       jQuery.ajax({
           type: "POST",
           url: '<?php echo home_url(); ?>/',		
   		data: {
               action: "load_new_payment_form",
   			details:jQuery("#giftprice"+tid).val(),
           },
           success: function(response) {
		    	  
			pptModal("gifts1", response, "modal-bottomxxxx", "ppt-animate-bouncein bg-white ppt-modal-shadow w-500", 0);	
   			
           },
           error: function(e) {
               console.log(e)
           }
       });


}else{

jQuery('#gifticons').html("<div class='col-12 text-center'><i class='fas fa-spinner fa-spin fa-3x'></i></div>");


jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',	
		dataType: 'json',	
		data: {
            action: "add_gift",
			pid: <?php echo $pid; ?>,
			uid: <?php echo $userdata->ID; ?>,
			rid: <?php echo $uid; ?>,
			gift: tid,			 			
        },
        success: function(response) {
 
			if(response.status == "ok"){ 
			
			
				jQuery.ajax({
						type: "POST",
						url: '<?php echo home_url(); ?>/',	
						dataType: 'json',	
						data: {
							action: "send_chat_msg",
							uid: <?php echo $userdata->ID; ?>,
							rid: <?php echo $uid; ?>,
							gift: tid,
							msg: 'gift',			
						},
						success: function(response) {
				 
							if(response.status == "ok"){
							
									jQuery("#giftsent").show();
									jQuery("#giftselect").hide();
									
									
									setTimeout( function(){ 									
										jQuery(".ppt-modal-wrap-overlay").trigger('click');									
									}, 2000);
									
							
							}else{			
								
										
							}			
						},
						error: function(e) {
							console.log(e)
						}
				});
							
			
			}else if(response.status == "found"){ 	 		 
  		 	
			jQuery("#toomnaygifts").show();
			jQuery("#giftselect").hide();
			
			setTimeout( function(){ 									
				jQuery(".ppt-modal-wrap-overlay").trigger('click');									
			}, 2000);
			
			}else{			
				 		
			}			
        },
        error: function(e) {
            console.log(e)
        }
});

}

}
</script>
<style> 
.price-tag a{-moz-border-radius-bottomright:4px;-webkit-border-bottom-right-radius:4px;border-bottom-right-radius:4px;-moz-border-radius-topright:4px;-webkit-border-top-right-radius:4px;border-top-right-radius:4px}.price-tag a:before{left:-15px;border-color:transparent #ce171e transparent transparent;border-width:15px 15px 15px 0}.price-tag a:after{left:-2px}.price-tag-wrap a{width:auto;height:30px;margin-left:20px;padding:0 12px;line-height:30px;background:#ce171e;color:#fff;font-size:14px;font-weight:600;text-decoration:none;position:absolute;bottom:20px;right:5%;z-index:100}.price-tag-wrap a:before{content:"";position:absolute;top:0;width:0;height:0;border-style:solid}.price-tag-wrap a:after{content:"";position:absolute;top:13px;width:4px;height:4px;-moz-border-radius:2px;-webkit-border-radius:2px;border-radius:2px;background:#fff;-moz-box-shadow:-1px -1px 2px #004977;-webkit-box-shadow:-1px -1px 2px #004977;box-shadow:-1px -1px 2px #004977}
</style>