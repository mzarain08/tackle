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

global $CORE, $CORE_UI; 
 

if(isset($_GET['eid']) && is_numeric($_GET['eid']) ){ 

$cstatus = $CORE->PACKAGE("get_status", $_GET['eid']);

 
$selected = "";
$name = "";
if(is_array($cstatus) && isset($cstatus['key'])){
	$selected = $cstatus['key'];
	$name = $cstatus['name'];
}


 ?>

<nav ppt-nav class="sepetator">
<ul> 
<?php  if(in_array(THEME_KEY,array("vt","so","ph"))){ ?>
   
<li>
   
<a href="javascript:void(0);" onclick="jQuery('#memaccess').toggle();"  class="btn-success text-600" data-ppt-btn>
<div class="d-flex">
	<div class="mr-2"><span><?php echo __("Member Access","premiumpress"); ?></span> </div>
	<div ppt-icon-16 data-ppt-icon-size="16"><?php echo $CORE_UI->icons_svg['user']; ?></div>
</div>
</a> 
  
</li>
<?php }else if(THEME_KEY == "at" && isset($_GET['eid']) ){ ?>
   
<li>
   
  <a href="<?php echo home_url(); ?>/wp-admin/admin.php?page=listings&eid=<?php echo esc_attr($_GET['eid']); ?>&resetaction=<?php echo esc_attr($_GET['eid']); ?>" class="text-dark">
  <i class="fa fa-sync mr-2"></i> <?php echo __("Reset Auction","premiumpress"); ?></a>
  
</li>
<?php } ?>

<?php if(in_array(THEME_KEY,array("so"))){ ?>
   
<li>
   
<a href="javascript:void(0);" onclick="jQuery('#pricee').toggle();"  class="btn-success text-600" data-ppt-btn>
<div class="d-flex">
	<div class="mr-2"><span><?php echo __("Pricing","premiumpress"); ?></span> </div>
</div>
</a> 
  
</li>

<?php } ?>
 
 
<li class="ml-auto">
<a href="javascript:void(0);" onclick="jQuery('#adminedit').toggle();"  class="btn-warning text-600" data-ppt-btn>
<div class="d-flex">
	<div class="mr-2"><span><?php echo $name; ?></span> </div>
	<div ppt-icon-16 data-ppt-icon-size="16"><?php echo $CORE_UI->icons_svg['pencil']; ?></div>
</div>
</a> 
</li> 

<li><a href="javascript:void(0);" onclick="ajax_delete_listing();" class="btn-danger text-600" data-ppt-btn><?php echo __("Delete Ad","premiumpress"); ?></a>  </li>
  
<li>
<a href="post.php?post=<?php echo esc_attr($_GET['eid']); ?>&action=edit" class="btn-system text-600" data-ppt-btn target="_blank">
<div ppt-icon-16 data-ppt-icon-size="16"><?php echo $CORE_UI->icons_svg['wordpress']; ?></div>
</a>
</li>
  
</ul>
</nav>


<?php if(in_array(THEME_KEY,array("so"))){ ?>

<div id="pricee" style="display:none;">


  <hr />
    <div class="row">
    <div class="col-md-6">
    
    <div class="block-header">
<h3 class="block-header__title"><?php echo __("Download Pricing","premiumpress"); ?></h3>
<div class="block-header__divider"></div> 
</div> 

<div class="text-600 mb-2"><?php echo __("Add to cart price","premiumpress"); ?></div>
<div class="mb-2 position-relative" style="max-width:150px;">
<input type="text" name="custom[price_cart]" class="form-control"  value="<?php if(isset($_GET['eid']) && is_numeric($_GET['eid']) ){  echo get_post_meta($_GET['eid'],"price_cart",true); } ?>" />
<div class="position-absolute text-muted" style="bottom: 8px;    right: 10px;"><?php echo hook_currency_symbol(''); ?></div>
</div>


<div class="text-600 mt-4 mb-2"><?php echo __("Credit price","premiumpress"); ?></div>
<div class="mb-2 position-relative" style="max-width:150px;">
<input type="text" name="custom[price_credit]" class="form-control"  value="<?php if(isset($_GET['eid']) && is_numeric($_GET['eid']) ){  echo get_post_meta($_GET['eid'],"price_credit",true); } ?>" />
<div class="position-absolute text-muted" style="bottom: 8px;    right: 10px;"><?php echo hook_currency_symbol(''); ?></div>
</div>

</div>


<div class="col-md-6 y-middle">

<button data-ppt-btn class="btn-primary btn-save" onclick="jQuery('#pricee').toggle();"><?php echo __("Update","premiumpress"); ?></button>

 
</div> 
</div>
</div>
<?php } ?>

<?php if(in_array(THEME_KEY,array("vt","so","ph"))){ ?>
<div id="memaccess" style="display:none;">
<?php  

$value = array();
if(isset($_GET['eid'])){
$value = get_post_meta($_GET['eid'],'videoaccess',true);
}

 
	$status = array(
		"" 		=> __("Everyone"),
		"loggedin" 	=> __("Logged In Members"),		
		"subs" 	=> __("Members With Subscriptions"),
	);
	
	
	// GET ALL MEMBERSHIPS
	$all_memberships = $CORE->USER("get_memberships", array());
	 
	foreach($all_memberships  as $key => $m){
			$status[$m['key']] = $m['name'];
				
	} 
	 
 
 
?>
   
    <hr />
    <div class="row">
    <div class="col-md-6">

<div class="block-header">
<h3 class="block-header__title"><?php echo __("Membership Access","premiumpress"); ?></h3>
<div class="block-header__divider"></div> 
</div> 

<?php if(in_array(THEME_KEY,array("so"))){ ?>
<div class="mb-4 opacity-5"><?php echo __("Any member who is included in your selection below will be able to download this file for free.","premiumpress"); ?></div>

<?php } ?>
 
<?php 	$i=1; foreach($status as $key => $club){ 

if(strlen($club) < 2){ continue; }

?>
<div ppt-border1 class="p-3 mb-2">
<label class="custom-control custom-checkbox">
<input type="checkbox" class="form-control custom-control-input membercheck mem-<?php if($key == ""){ echo "all";  }else{ echo $key; } ?>" onchange="Uncheckmembers()" name="custom[videoaccess][]" value="<?php echo $key; ?>" <?php 

if(empty($value) && $i == 1){  echo "checked"; }

elseif(is_array($value) && in_array($key, $value)){  echo "checked";  }

 ?>>
<div class="custom-control-label"><span><?php echo $club; ?></span></div>
</label>
</div> 
<?php $i++; } ?>
</div>

<div class="col-md-6 y-middle">

<button data-ppt-btn class="btn-primary btn-save" onclick="jQuery('#memaccess').toggle();"><?php echo __("Update","premiumpress"); ?></button>

 
</div> 
</div>
</div>
<input type="checkbox" class="form-control membercheck mem-none"  name="custom[videoaccess][]" value="9999" style="display:none;" />

<script>

function Uncheckmembers(){
	if(jQuery(".mem-all").is(':checked')){
		jQuery(".membercheck:not(.mem-all)").prop( "checked", false );
	}
	
	
	var numberNotChecked = jQuery('.membercheck:checked').length;
	if(numberNotChecked == 0){
		jQuery(".mem-none").prop( "checked", true );
	}else{
		jQuery(".mem-none").prop( "checked", false );
	}
}

</script>

<?php }else{ ?>
<input type="hidden" class="form-control" name="custom[videoaccess][]" value="0" />
<?php } ?> 










<?php

if(isset($_GET['eid']) && is_numeric($_GET['eid']) ){ 
 

?>
<div id="adminedit" style="display:none">

    <hr />
    <div class="row">
    <div class="col-md-6">


<?php $i=1; foreach($CORE->PACKAGE("get_status", array() ) as $cat){   ?>
<div ppt-border1 class="p-3 mb-2">

    <div class="d-flex w-100">
    
        <div ppt-flex-middle>
        <input type="radio" onclick="jQuery('#poststt').val('<?php echo $cat['key']; ?>');" name="news" value="<?php echo $cat['key']; ?>" <?php if($selected == $cat['key']){ echo "checked=checked"; } ?> />
        </div>
        
        <div class="fs-6 text-600 ml-3">
        <?php echo $cat['name']; ?> 
        </div>
    
    </div>
    
</div>
<?php $i++; } ?>

<div>
<button data-ppt-btn class="btn-primary btn-save btn-sm" onclick="jQuery('#adminedit').toggle();"><?php echo __("Update","premiumpress"); ?></button>

 
</div>
      
      
   


    </div>
    <div class="col-md-6">
  

	<div class="w-100">
	<div ppt-box class="rounded">
	<div class="_header" ppt-flex-row>
	<div class="_title"><?php echo __("Email User","premiumpress"); ?></div>

	<div class="_close">
<div ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['smile']; ?></div>
</div>
</div>

	<div class="_content py-3 ppt-forms style3" id="pending_message_box">
    
    
<div class="mb-3"><?php echo __("Use this form to send a quick email to the user.","premiumpress"); ?></div>

<input type="text" name="" id="pending_subject" class="form-control mb-2" placeholder="<?php echo __("Email Subject Title","premiumpress"); ?>" value="" />
<textarea style="height:150px;" id="pending_message" name="custom[approval_message]" class="w-100 form-control" placeholder="<?php echo __("Message displayed to the user.","premiumpress"); ?>"><?php echo get_post_meta($_GET['eid'],'approval_message',true); ?></textarea>
 

    
    </div>

	<div class="_footer small border-top py-2 text-center">
    
    <button type="button" onclick="ajax_send_pending()" class="mb-2 btn btn-dark mt-2"><?php echo __("Send Email","premiumpress"); ?></button>
    
    </div>
</div>



 
<script>

function ajax_send_pending(){
 
if(jQuery('#pending_subject').val() == ""){
jQuery('#pending_subject').focus();
alert("<?php echo __("Please enter a valid email subject title.","premiumpress"); ?>");
}else{
jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',	
		dataType: 'json',	
		data: {
            admin_action: "send_pending_msg",
			uid: '<?php echo get_post_field( 'post_author', $_GET['eid']); ?>',
			subj: jQuery('#pending_subject').val(),
			msg: jQuery('#pending_message').val(),
        },
        success: function(response) {
  
			if(response.status == "ok"){
			 
  		 		jQuery("#pending_message_box").html("<div class='alert alert-success text-center'><?php echo __("Message Sent","premiumpress"); ?></div>");
			}else{			
				 		
			}			
        },
        error: function(e) {
            console.log(e)
        }
    });
}	
}// end are you sure

</script>
 


    </div>
    </div> 
</div>
</div>
<hr />
<?php

}
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////

?>




<script>
 
function ajax_delete_listing(){
   
   if(confirm("<?php echo trim(__("Are you sure?","premiumpress")); ?>")){
   	
	
		jQuery('#ppt-add-listing-form').hide();
		jQuery('#ppt-add-listing-save').show(); 
		
       jQuery.ajax({
           type: "POST",
           url: '<?php echo home_url(); ?>/',	
   		dataType: 'json',	
   		data: {
               action: "listing_delete",
   			pid: <?php echo $_GET['eid']; ?>,
           },
           success: function(response) {			
   			if(response.status == "ok"){	
   							
   				window.open('admin.php?page=listings', "_self");			 
     		 	
   			}else{			
   				jQuery('#ajax_response_msg').html("error trying to delete");			
   			}			
           },
           error: function(e) {
               console.log(e)
           }
       });
   }// end are you sure
   
   }
 
</script>
<?php } ?>

<?php _ppt_template('forms/add-listing' );  ?>

<style>
.btn-secondary, .btn-secondary:hover, .btn-secondary:focus, .bg-secondary {
    color: #fff;
    background-color: #ffc300 !important;
    border-color: #ffc300 !important;
}
</style> 