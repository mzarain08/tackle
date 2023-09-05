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

global $CORE, $settings;

$settings = array(

"title" => __("Order Details","premiumpress"), 

"desc" =>__("Here you can add/edit orders.","premiumpress"),

);


$gatewayname = "";
if(isset($_GET['eid']) && is_numeric($_GET['eid'])  ){ 
$gatewayname = get_post_meta($_GET['eid'], "order_gatewayname", true);
}


_ppt_template('framework/admin/_form-wrap-top' ); ?>

<div class="card card-admin">
  <div class="card-body">
    <div class="card-title"><?php echo __("Order Details","premiumpress"); ?></div>
    <form method="post" action="" enctype="multipart/form-data">
      <input type="hidden" name="neworder" value="<?php if(isset($_GET['eid']) && is_numeric($_GET['eid'])  ){ echo esc_attr($_GET['eid']); }else{ echo 1; }  ?>" />
      <p class="text-muted mt-4"><?php echo __("Who's the order for?","premiumpress"); ?></p>
      <div class="row">
        <div class="form-group col-6">
          <label><?php echo __("User ID","premiumpress"); ?></label>
          <div class="input-group">
            <div class="input-group-prepend"> <span class="input-group-text"> # </span> </div>
            <input name="order[order_userid]" class="form-control"  type="text" value="<?php if(isset($_GET['eid']) && is_numeric($_GET['eid'])  ){ echo get_post_meta($_GET['eid'], "order_userid", true); } ?>">
          </div>
          <!-- input-group.// -->
        </div>
        <div class="form-group col-6">
          <label><?php echo __("Email","premiumpress"); ?></label>
          <div class="input-group">
            <div class="input-group-prepend"> <span class="input-group-text"> @ </span> </div>
            <input name="order[order_email]" class="form-control"  type="text" value="<?php if(isset($_GET['eid']) && is_numeric($_GET['eid']) ){ echo get_post_meta($_GET['eid'], "order_email", true); }?>">
          </div>
          <!-- input-group.// -->
        </div>
      </div>
      <hr />
      <p class="text-muted"><?php echo __("What's the status of the order?","premiumpress"); ?></p>
      <div class="row">
        <div class="form-group col-6">
          <label><?php echo __("Order Status","premiumpress"); ?></label>
          <select name="order[order_status]" class="form-control">
            <?php
// ORDER STATUS
if(isset($_GET['eid']) && is_numeric($_GET['eid'])  ){
$orderstatus = get_post_meta($_GET['eid'], "order_status", true);
}
 
foreach( $CORE->ORDER("get_status", array()) as $k => $n){
?>
            <option value="<?php echo $k; ?>" <?php  if(isset($_GET['eid'])){  selected( $orderstatus, $k ); }  ?>><?php echo $n['name']; ?></option>
            <?php } ?>
          </select>
          <?php

// ORDER STATUS
if(isset($_GET['eid']) && get_post_meta($_GET['eid'], "order_paid", true) != ""){ ?>
          <div class="small text-muted mt-3"> <i class="fa fa-check"></i> <?php echo  __("Paid","premiumpress")." ".get_post_meta($_GET['eid'], "order_paid", true); ?> </div>
          <?php

}
?>
        </div>
        <div class="form-group col-6">
          <label><?php echo __("Processing Status","premiumpress");
		  
		  // ORDER STATUS
if(isset($_GET['eid']) && is_numeric($_GET['eid'])  ){
$orderstatus = get_post_meta($_GET['eid'], "order_process", true);
}
 
		  
		   ?></label>
          <select name="order[order_process]" class="form-control">
            <?php

 
foreach( $CORE->ORDER("get_process", array()) as $k => $n){
?>
            <option value="<?php echo $k; ?>" <?php  if(isset($_GET['eid'])){  selected( $orderstatus, $k ); }  ?>><?php echo $n['name']; ?></option>
            <?php } ?>
          </select>
        </div>
      </div>
      <!-- end row -->
      <hr />
      <p class="text-muted"><?php echo __("What's are the order details?","premiumpress"); ?></p>
      <div class="form-group">
        <label><?php echo __("Item Name","premiumpress"); ?></label>
        <div class="input-group">
          <input name="order[order_description]" class="form-control"  type="text" value="<?php if(isset($_GET['eid'])){ echo get_post_meta($_GET['eid'], "order_description", true); }?>">
        </div>
      </div>
      <div class="row">
        <div class="form-group col-6"> 
        
   <?php if(isset($_GET['eid'])){ $uc = get_post_meta($_GET['eid'], "order_userid", true);  ?>
   
   <div class="bg-light p-4">
    <div><strong><?php echo $CORE->ORDER("user_get_name", $uc); ?></strong></div>
    <div><?php echo $CORE->ORDER("user_get_address", $uc); ?></div>
    <div><?php echo $CORE->ORDER("user_get_phone", $uc); ?></div>
    </div>
    
    <?php } ?>
        
        
        </div>
        <div class="form-group col-6">
          <div class="form-group" <?php if(!isset($_GET['eid'])){ ?>style="display:none;"<?php } ?>>
            <label class="w-100">
			
			<?php echo __("Order ID","premiumpress"); ?>  
            
            <?php if(isset($_GET['eid']) && is_numeric($_GET['eid'])){ ?>
             
             <a href="<?php echo home_url(); ?>/?invoiceid=<?php echo esc_attr($_GET['eid']); ?>"  target="_blank"><?php echo $CORE->ORDER("format_id", $_GET['eid']); ?></a>  
          
             <?php } ?>
             
             </label>
            <input type="text" name="order[order_id]" class="form-control" value="<?php if(isset($_GET['eid'])){ echo get_post_meta($_GET['eid'], "order_id", true); }else{ echo "CUSTOM"; } ?>">
          </div>
          
          <?php if( $CORE->LAYOUT("captions","listings") ){  ?>
          <div class="form-group">
            <label><?php echo __("Post ID","premiumpress"); ?></label>
            <input type="text" name="order[order_postid]" class="form-control" value="<?php if(isset($_GET['eid'])){ echo get_post_meta($_GET['eid'], "order_postid", true); }else{ echo "CUSTOM"; } ?>">
          </div>
          <?php } ?>
          
          
          

          
          
        </div>
      </div>
      
      
      <hr />
      
      <script>
	  
	  function updatetotal(v,p){
	   
		  price = jQuery("#order_total").val();
		   
		  if(v == "sub"){
		    price = 0;		  
		  	price = price + parseFloat(p);		  
		  }
		  
		  if(v == "dis"){ 
		  	price = price - parseFloat(p);		  
		  }
		  
		  if(v == "ship"){ 
		  	price = price - parseFloat(p);		  
		  }
		  
		  if(v == "tax"){ 
		  	price = price - parseFloat(p);		  
		  } 
		  
		  
		  price = parseFloat(jQuery("#order_subtotal").val()) - parseFloat(jQuery("#order_discount").val())  + parseFloat(jQuery("#order_ship").val()) + parseFloat(jQuery("#order_tax").val());
		  
		  jQuery("#order_total").val(price);
	  
	  }
	  
	  <?php if(isset($_GET['eid']) && get_post_meta($_GET['eid'], "order_subtotal", true) == ""){ ?>
	  function updatesubtotal(){
	  
	  	price = jQuery("#order_total").val() - parseFloat(jQuery("#order_discount").val());
		
		price = price + parseFloat(jQuery("#order_ship").val());
		
		price = price + parseFloat(jQuery("#order_tax").val());
		
		jQuery("#order_subtotal").val(price);
	  
	  }
	  jQuery(document).ready(function(){ 
	  
	  updatesubtotal();
	  
	  });
	  
	  <?php } ?>
	  
	  </script>
       
      <div class="row">
      
      <div class="col-md-6">
      
       <label class="mt-3"><?php echo __("Subtotal","premiumpress"); ?></label>
          <div class="input-group">
            <div class="input-group-prepend"> <span class="input-group-text"> <?php if(strpos( _ppt(array('currency','symbol')), "fa") === false){ echo hook_currency_symbol('');  }else{ echo '<i class="'._ppt(array('currency','symbol')).'"></i>'; } ?> </span> </div>
            <input name="order[order_subtotal]" id="order_subtotal" onchange="updatetotal('sub',this.value);" class="form-control numericonly"  type="text" value="<?php if(isset($_GET['eid'])){ echo get_post_meta($_GET['eid'], "order_subtotal", true); }else{ echo 0; } ?>">
          </div>
      
      
      </div>
      
       <div class="col-md-6">
      
           <label class="mt-3"><?php echo __("Discount","premiumpress"); ?></label>
          <div class="input-group">
            <div class="input-group-prepend"> <span class="input-group-text"> <?php if(strpos( _ppt(array('currency','symbol')), "fa") === false){ echo hook_currency_symbol('');  }else{ echo '<i class="'._ppt(array('currency','symbol')).'"></i>'; } ?> </span> </div>
            <input name="order[order_discount]" id="order_discount" class="form-control numericonly" onchange="updatetotal('dis',this.value);"  type="text" value="<?php if(isset($_GET['eid'])){ if(get_post_meta($_GET['eid'], "order_discount", true) == ""){ echo 0; }else{ echo get_post_meta($_GET['eid'], "order_discount", true); } }else{ echo 0; } ?>">
          </div>
      <?php if(isset($_GET['eid'])){  $code = get_post_meta($_GET['eid'], "order_discount_code", true); if(strlen($code) > 1){ ?>
          <div class="small mt-2"> <?php echo __("Discount code used","premiumpress"); ?>: <strong><?php echo $code; ?></strong> </div>
          <?php } } ?>
      
      </div>
      
       <div class="col-md-6">
      
          
          <label class="mt-3"><?php echo __("Shipping","premiumpress"); ?></label>
          <div class="input-group">
            <div class="input-group-prepend"> <span class="input-group-text"> <?php if(strpos( _ppt(array('currency','symbol')), "fa") === false){ echo hook_currency_symbol('');  }else{ echo '<i class="'._ppt(array('currency','symbol')).'"></i>'; } ?> </span> </div>
            <input name="order[order_shipping]" id="order_ship" class="form-control numericonly" onchange="updatetotal('ship',this.value);"  type="text" value="<?php if(isset($_GET['eid'])){ if(get_post_meta($_GET['eid'], "order_shipping", true) == ""){ echo 0 ; }else{ echo get_post_meta($_GET['eid'], "order_shipping", true); } }else{ echo 0; }?>">
          </div>
          
        
        </div>
         <div class="col-md-6">  
          
          
          <label class="mt-3"><?php echo __("Tax","premiumpress"); ?></label>
          <div class="input-group">
            <div class="input-group-prepend"> <span class="input-group-text"> <?php if(strpos( _ppt(array('currency','symbol')), "fa") === false){ echo hook_currency_symbol('');  }else{ echo '<i class="'._ppt(array('currency','symbol')).'"></i>'; } ?> </span> </div>
            <input name="order[order_tax]" id="order_tax" class="form-control numericonly" onchange="updatetotal('tax',this.value);"  type="text" value="<?php if(isset($_GET['eid'])){ if(get_post_meta($_GET['eid'], "order_tax", true) == ""){ echo 0; }else{ echo get_post_meta($_GET['eid'], "order_tax", true); } }else{ echo 0; } ?>">
          </div>
          
          </div>
          
           <div class="col-md-12">
          
          <label class="mt-3 h4 mb-2"><?php echo __("Order Total","premiumpress"); ?></label>
          <div class="input-group">
            <div class="input-group-prepend"> <span class="input-group-text"> <?php if(strpos( _ppt(array('currency','symbol')), "fa") === false){ echo hook_currency_symbol('');  }else{ echo '<i class="'._ppt(array('currency','symbol')).'"></i>'; } ?> </span> </div>
            <input name="order[order_total]" class="form-control numericonly" id="order_total" style="    height: 60px;    font-size: 30px !important;    text-align: right;"  type="text" value="<?php if(isset($_GET['eid'])){ echo get_post_meta($_GET['eid'], "order_total", true); }else{ echo 0; } ?>">
          </div>
          
          </div>
      
      
      </div>
    
      
       <hr />
      
      <!-- end row -->
      <div class="form-group">
        <label><?php echo __("Additional Notes","premiumpress"); ?></label>
        <div class="input-group">
          <textarea name="order[order_notes]" class="form-control" style="height:100px !important;"><?php if(isset($_GET['eid'])){ echo get_post_meta($_GET['eid'], "order_notes", true); }?>
</textarea>
        </div>
      </div>
      
      <?php if(strlen($gatewayname) > 1){ ?>
      <div class="my-3 small"><strong><?php echo __("Payment Method","premiumpress"); ?>:</strong> <?php echo $gatewayname; ?></div>
      <?php } ?>
      
      <?php if(isset($_GET['eid'])){ $cc = get_the_content($_GET['eid']); if(strlen($cc) > 5){  ?>
      <!-- end row -->
      <div class="form-group bg-light p-4">
        <label><?php echo __("Raw Order Data (read only)","premiumpress"); ?></label>
        <div class="input-group">
          <textarea name="order[order_notes]" class="form-control" style="height:100px !important;"><?php echo get_the_content($_GET['eid']); ?></textarea>
        </div>
      </div>    
      <?php } } ?>
      
      <div class="p-4 bg-light text-center mt-4">
        <button type="submit" data-ppt-btn class="btn-primary"> <?php echo __("Update Order","premiumpress"); ?></button>
      </div>
    </form>
  </div>
</div>
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?>
<?php

if(isset($_GET['eid'])){ 
  
  $settings = array("title" => __("INVOICE","premiumpress"), "desc" =>  __("Here is a preview of the invoice.","premiumpress") );
   _ppt_template('framework/admin/_form-wrap-top' ); ?>
<div class="card card-admin">
  <div class="card-body">
    <?php

echo $CORE->ORDER("get_order_items", $_GET['eid'] );
?>
  </div>
</div>
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?>
<?php } ?>
