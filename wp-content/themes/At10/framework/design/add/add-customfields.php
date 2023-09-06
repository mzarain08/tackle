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


	switch(THEME_KEY){
		
		case "da": {
		
			$title = __("About Me","premiumpress");
			$desc  =  __("Tell visitors more about you.","premiumpress"); 
			 
		} break;
		
		default: {
		
			$title =  __("Details","premiumpress"); 
			$desc  =  __("Please fill in the blanks.","premiumpress"); 
		 
		} break;
	
	}




$editID=0;

if(isset($_GET['eid']) && is_numeric($_GET['eid'])){
$editID = $_GET['eid'];
} 

$o=0; 
$field = array();
$canEdit = true;


	if(THEME_KEY ==  "at" && isset($_GET['eid']) && !is_admin() ){ 
		
			// CHECK FOR BIDDING SO WE CAN DISABLE FIELDS
			$current_bidding_data = get_post_meta($_GET['eid'],'current_bid_data',true); 
			if(is_array($current_bidding_data) && !empty($current_bidding_data) ){ $canEdit = false; }
			  
		}



?>
<div class="block-header mt-4">
<h3 class="block-header__title"><?php echo $title; ?></h3>
<div class="block-header__divider"></div> 
</div>
<div class="row" <?php if(isset($_POST['ajaxedit'])){ ?>style="height: 400px;    overflow: auto;  overflow-y: scroll;"<?php } ?>>
<?php

$data = "";

if($canEdit){
 
   
$data .= str_replace("col-md-6","col-md-6",$CORE->BUILD_FIELDS(hook_add_fieldlist($field),''));		


 	
$data .= str_replace("col-md-6","col-md-6",$CORE->SUBMISSION_FIELDS(false,true)); // CUSTOM FIELDS

 
if(in_array(THEME_KEY, array("vt","cm")) && strlen($data) < 60){
?><style>#sec-details { display:none !important; }
</style>
<?php 
}else{

echo $data;

} 
 
}elseif(THEME_KEY == "at"){
?>
<div class="col-12">
<div class="p-3 text-center small">
<div class="alert alert-info">
<i class="fal fa-info-circle"></i> <?php echo __("Auction details cannot be modified once bids have been received.","premiumpress"); ?>
</div>
</div>
</div>
<?php } ?>
</div>

 

<?php if(isset($_POST['ajaxedit'])){ ?>

<script>
 
jQuery(document).ready(function(){
jQuery('.customid-0').show(); 

<?php

// GET CATEGORY LIST FROM TERMS OBJEC
if(isset($_GET['eid'])){ 
	$foundcats 	= wp_get_object_terms( $_GET['eid'], 'listing' );
	if(is_array($foundcats) && !empty($foundcats)){
		foreach($foundcats as $cat){?>
		jQuery('.customid-<?php echo $cat->term_id; ?>').show(); 
		<?php
		}
	}	
}

?>

jQuery('.selectpicker').selectpicker('refresh');


});

</script>
<?php } ?>