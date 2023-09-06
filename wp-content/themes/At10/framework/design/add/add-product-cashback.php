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

global $CORE, $userdata; 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$eid = 0 ;
if(isset($_GET['eid']) && $_GET['eid'] > 0){
$eid = $_GET['eid'];
}

$gen1 = "";
$gen2 = "";

if($eid > 0){

	//$angencies = get_terms( 'store', array( 'hide_empty' => 0, 'parent' => 0  ));

	$store = get_the_terms( $eid, 'store');
	$storeid = "";
	if(isset($store[0])){
	$storeid = $store[0]->term_id;		 
	}
 
}
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>

<div class="row">
 
 
   <div class="col-6 mb-3">
    <label><?php echo __("Type","premiumpress"); ?></label>
    <div class="input-group">
      <select name="custom[type]" class="form-control" id="ptypeb" style="width:100%;" onchange="checkaddlink();">
      
        <option value="0" <?php if(isset($_GET['eid']) && get_post_meta($_GET['eid'],'type', true) == 0){ echo "selected=selected"; } ?>><?php echo __("Product","premiumpress"); ?></option>
        <option value="1" <?php if(isset($_GET['eid']) && get_post_meta($_GET['eid'],'type', true) == 1){ echo "selected=selected"; } ?>><?php echo __("Service","premiumpress"); ?></option>
   
       
      </select>
    </div>
   </div>
   <div class="col-6"></div>
   
   
 
  <div class="col-6 types type-0">
    <div class="form-group">
      <label><?php echo __("Price","premiumpress"); ?></label>
      <div class="input-group position-relative">
        <input class="form-control numericonly" placeholder="0" name="custom[price]" value="<?php if( isset($_GET['eid']) ){  echo get_post_meta($_GET['eid'], "price", true); } ?>" style="padding-left:30px !important;"/>
        <div class="position-absolute" style="top:11px; left: 10px; z-index: 100;">
          <?php echo hook_currency_symbol(''); ?>
        </div>
      </div>
    </div>
  </div>
  <div class="col-6 types type-0">
    <div class="form-group">
      <label><?php echo __("Old Price","premiumpress"); ?></label>
      <div class="input-group">
        <input class="form-control numericonly" placeholder="0" name="custom[old_price]" value="<?php if( isset($_GET['eid']) ){  echo get_post_meta($_GET['eid'], "old_price", true); } ?>" style="padding-left:30px !important;"/>
        <div class="position-absolute" style="top:11px; left: 10px; z-index: 100;">
          <?php echo hook_currency_symbol(''); ?>
        </div>
      </div>
    </div>
  </div>
  

 
</div>


<div class="block-header mt-4">
<h3 class="block-header__title"><?php echo __("Cashback Details","premiumpress"); ?></h3>
<div class="block-header__divider"></div> 
</div>

<div class="row mb-4">

  <div class="col-6">
    <div class="form-group">
      <label><?php echo __("Fixed Amount","premiumpress"); ?></label>
      <div class="input-group position-relative">
        <input class="form-control numericonly" placeholder="0" name="custom[cashback]" value="<?php if( isset($_GET['eid']) ){  echo get_post_meta($_GET['eid'], "cashback", true); } ?>" style="padding-left:30px !important;"/>
        <div class="position-absolute" style="top:11px; left: 10px; z-index: 100;">
          <?php echo hook_currency_symbol(''); ?>
        </div>
      </div>
    </div>
  </div>
  <div class="col-6">
    <div class="form-group">
      <label><?php echo __("Percentage","premiumpress"); ?></label>
      <div class="input-group">
        <input class="form-control numericonly" placeholder="0" name="custom[cashback_p]" value="<?php if( isset($_GET['eid']) ){  echo get_post_meta($_GET['eid'], "cashback_p", true); } ?>" style="padding-left:30px !important;"/>
        <div class="position-absolute" style="top:11px; left: 10px; z-index: 100;">
         %
        </div>
      </div>
    </div>
  </div>

  <div class="col-12 mt-3">
    <div class="form-group">
      <label><?php echo __("Custom Affiliate Link","premiumpress"); ?></label>
     
        <input class="form-control" placeholder="0" name="custom[buy_link]" value="<?php if( isset($_GET['eid']) ){  echo get_post_meta($_GET['eid'], "buy_link", true); } ?>" />
        
     
    </div>
  </div>

</div>



<div class="block-header mt-4">
<h3 class="block-header__title"><?php echo __("Store","premiumpress"); ?></h3>
<div class="block-header__divider"></div> 
</div>

<div class="row mb-4">

    <div class="col-md-6">
    <select class="form-control" name="tax[store]" id="storelist"></select>
       
    </div>

</div>




<script>

function checkaddlink(){

	var gg = jQuery('#ptypeb').val();
	
	jQuery(".types").hide();
	
	jQuery(".type-"+gg).show();
	
	
}



function LoadStoreList(){

	jQuery.ajax({
		type: "POST",
		url: '<?php echo home_url(); ?>/',	
		dataType: 'json',	
		data: {
				action: "load_store_list",
				selected: "<?php echo $storeid; ?>", 
		},
		success: function(response) {
		 
		 	if(response.total > 0){				
				 
				jQuery("#storelist").html(response.output);
			  	 
			} 
				
		},
		error: function(e) {
			console.log(e)
		}
	});

}
jQuery(document).ready(function() {

	LoadStoreList(); 
 
	checkaddlink();
}); 

</script>