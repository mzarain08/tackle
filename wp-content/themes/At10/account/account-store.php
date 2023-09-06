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

global $CORE, $userdata, $STRING, $CORE_UI;
 
 
$storeID = get_user_meta($userdata->ID,'storeid', true);

if(isset($_POST['store']) && $_POST['store']['name'] != ""){
 	 
	wp_update_term( $storeID, 'store', array(
    	'name' => strip_tags($_POST['store']['name']),
	 
	) );
	
	$newdata['storeimage_'.$storeID] = strip_tags($_POST['store']['image']);					 
	$newdata['storelink_'.$storeID] = strip_tags($_POST['store']['link']);
		
	//$newdata['storelinkaff_'.$storeID] = strip_tags($_POST['storelinkaff']);
	//$newdata['storeaddress_'.$storeID] = strip_tags($_POST['storeaddress']);
				
	//$newdata['storefb_'.$storeID] = strip_tags($_POST['storefb']);
	$newdata['storephone_'.$storeID] = strip_tags($_POST['store']['phone']);
	$newdata['storeemail_'.$storeID] = strip_tags($_POST['store']['email']);
	
	$newdata['category_sidebar_description_'.$storeID] = strip_tags($_POST['store']['desc']);
	 
	$existing_values = get_option("core_admin_values");				 
	$new_result = array_merge((array)$existing_values, $newdata);
	update_option( "core_admin_values", $new_result, true);	
	 
	$saved = 1;
 	

}

$storeTerm = get_term_by('id', $storeID, "store" );
 
$storeData = array(

	"id" 	=> $storeID,
	"name" 	=> $storeTerm->name,
	"slug" 	=> $storeTerm->slug,
	"desc" 	=> _ppt('category_sidebar_description_'.$storeID),
	"link" 	=> _ppt('storelink_'.$storeID),
	"email" => _ppt('storeemail_'.$storeID),
	"phone" => _ppt('storephone_'.$storeID),
	"image" =>  _ppt('storeimage_'.$storeID), 
	
);
 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>

<div class="fs-lg text-600 mb-4"><?php echo ppt_title_store(); ?></div>

<p class="mb-4"><?php echo ppt_desc_store(); ?></p>

<?php if(isset($_GET['saved'])){ ?>


<div class="alert alert-success p-3 mb-4">

    <div class="d-flex">
        <div class="ml-3">
        <div ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['check-circle']; ?></div>
        </div>    
        <div class="ml-3">
        <?php echo __("Changes saved successfully.","premiumpress"); ?>
        </div>    
    </div>

</div>
<?php } ?>

<label class="text-600"><?php echo __("Logo Icon","premiumpress"); ?></label>


<form method="post" action="" onsubmit="return ValidateStore();" class="save_store_form" >

<input type="hidden" class="form-control" name="store[image]" value="" id="storeimg" /> 

<div class="row mb-4">

    <div class="col-md-3 mb-4 storeimage">
    <?php echo $CORE->MEDIA("customUploadForm", "storeimage_".$storeID); ?>
    </div>
    <div class="col-md-9"></div>
    
     
    <div class="col-md-6 mb-3">
    <label class="text-600"><?php echo __("Name","premiumpress"); ?> <span class="text-danger">*</span></label>
    <input type="text" class="form-control" name="store[name]" data-required="1" value="<?php echo $storeData['name']; ?>" />
    </div>
    
    <div class="col-md-6 mb-3">
    <label class="text-600"><?php echo __("Email","premiumpress"); ?> <span class="text-danger">*</span></label>
    <input type="text" class="form-control" name="store[email]" data-type="email" data-required="1" value="<?php echo $storeData['email']; ?>" />
    </div>
    
    <div class="col-md-6 mb-3">
    <label class="text-600"><?php echo __("Phone","premiumpress"); ?></label>
    <input type="text" class="form-control" name="store[phone]" value="<?php echo $storeData['phone']; ?>" />
    </div>
    
    <div class="col-md-6 mb-3">
    <label class="text-600"><?php echo __("Website","premiumpress"); ?></label>
    <input type="text" class="form-control" name="store[link]" value="<?php echo $storeData['link']; ?>" />
    </div>


<div class="col-12">

<label class="text-600"><?php echo __("Description","premiumpress"); ?> <span class="text-danger">*</span> </label>

<textarea class="form-control" style="height:150px!important;" data-required="1" name="store[desc]"><?php echo $storeData['desc']; ?></textarea>

<div ppt-flex-between>
<button type="submit" data-ppt-btn class="btn-primary mt-4"><?php echo __("Save Changes","premiumpress"); ?></button>

<a href="<?php echo get_term_link($storeData['slug'], "store"); ?>" target="_blank" class="btn-system" data-ppt-btn><?php echo __("View Page","premiumpress"); ?></a>
</div>

</div>

</div> 
</form>

<script>
 

function ValidateStore(){

	result = ppt_form_validation('.save_store_form');	
	if(result == 0){
	
		return false;
		
	}else{
	
	 
		storimg = jQuery("#storeimage_<?php echo $storeID; ?>_src").val();
		
		if(storimg.length > 0){
		
			jQuery("#storeimg").val(storimg );
		
		}
		
		jQuery(".storeimage").html('');
	
	
		return true;
	
	} 
}

<?php if(isset($saved)){ ?>

window.location.href='<?php echo _ppt(array('links','myaccount')); ?>/?tab=store&saved=1';

<?php } ?>

</script>