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

global $CORE;

$editID=0;
if(isset($_GET['eid']) && is_numeric($_GET['eid'])){
$editID = $_GET['eid'];
} 

 
$data = array();
$content = "";
$for = "";
$against = "";
$rating = "";

$current_data = array();
if(isset($_GET['eid'])){
$current_data = get_post_meta($_GET['eid'],'customfaq', true); 
}
 


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
?>

<div class="block-header mt-4">
<h3 class="block-header__title"><?php echo __("FAQ","premiumpress"); ?></h3>
<div class="block-header__divider"></div> 
</div>

<?php
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////



?>
     
<script>
var countnew = 0;
function addFAQ(){

	jQuery('#ppt_faq_clone .ff999').clone().insertAfter('#ppt_faq_list .topdiv');
	var countnew = jQuery(".newfaq").length;
	
	jQuery("#ppt_faq_list .ff999").addClass('newfaq new-'+countnew).find('.btn').attr('data-id',countnew).attr('onclick','remFAQ('+ countnew +')');
	jQuery("#ppt_faq_list .ff999").removeClass("ff999");
 
	
}
function remFAQ(id){

jQuery('#ppt_faq_list .new-'+id).html('');
 
}
</script>
   
    <div class="clearfix mb-4"> <a href="javascript:void(0);" onclick="addFAQ()" class="btn btn-system btn-md"><i class="fa fa-plus"></i> <?php echo __("Add FAQ","premiumpress") ?></a> </div>
    <div id="ppt_faq_list" <?php if(isset($_POST['ajaxedit'])){ ?>style="height: 400px;    overflow: auto;  overflow-y: scroll;"<?php } ?>><div class="topdiv"></div>
      <?php 



if( !empty($current_data) ){ $i=0; foreach($current_data['name'] as $data){ if($current_data['name'][$i] !=""){ ?>
      <div id="faq_<?php echo $i; ?>" >
        <div class="p-4 my-4 border bg-light">
          <div class="row">
            <div class="col-md-12">
              <p class="text-uppercase font-weight-bold text-dark small"><?php echo __("Title","premiumpress") ?></p>
              <input type="text" name="customfaq[name][]" id="faq_title_<?php echo $i; ?>" value="<?php echo $current_data['name'][$i]; ?>" class="form-control rounded-0"  />
            </div>
 
            <div class="col-12 mt-4">
              <p class="text-uppercase font-weight-bold text-dark small"><?php echo __("Description","premiumpress") ?></p>
              <textarea name="customfaq[value][]" class="form-control rounded-0" style="width:100%;height:100px;"><?php echo trim($current_data['value'][$i]); ?></textarea>
            </div>
          </div>
          <div class="clearfix"></div>
          <a href="javascript:void(0);" onClick="jQuery('#faq_title_<?php echo $i; ?>').val('');jQuery('#faq_<?php echo $i; ?>').fadeToggle();" class="btn btn-system btn-md mt-2"><i class="fa fa-trash"></i> <?php echo __("Delete","premiumpress") ?></a> </div>
      </div>
      <?php } $i++; } } ?>
    </div>
 
      <div id="ppt_faq_clone" style="display:none">
      
      <div class="ff999">
        <div class="p-4 my-4 border bg-light">
          <div class="row">
            <div class="col-md-12">
              <p class="text-uppercase font-weight-bold text-dark small"><?php echo __("Title","premiumpress") ?></p>
              <input type="text" name="customfaq[name][]" value="" class="form-control rounded-0"  />
            </div>
 
            <div class="col-12 mt-4">
              <p class="text-uppercase font-weight-bold text-dark small"><?php echo __("Description","premiumpress") ?></p>
              <textarea name="customfaq[value][]" class="form-control rounded-0" style="width:100%;height:100px;"></textarea>
            </div>
          </div>
          <div class="clearfix"></div>
          <a href="javascript:void(0);" onclick="remFAQ()" class="btn btn-system btn-md mt-2"><i class="fa fa-trash"></i> <?php echo __("Delete","premiumpress") ?></a> </div>
      </div> 
    </div>
 