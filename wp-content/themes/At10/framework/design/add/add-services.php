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

global $CORE, $CORE_UI, $userdata;
 
if( in_array(_ppt(array('design', 'display_services' )),array("","1"))){

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
$current_data = get_post_meta($_GET['eid'],'customextras', true); 
}

?>

 
 

<?php
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
?>
 

<div class="block-header mt-4">
<h3 class="block-header__title"><?php echo __("Services","premiumpress"); ?></h3>
<div class="block-header__divider"></div> 
</div>

 

<?php
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
?>
<div id="servicesbc">

 
    <div class="clearfix"> <a href="javascript:void(0);" onClick="jQuery('#wlt_customextras_list_fields').clone().insertBefore('#wlt_customextras_list');jQuery('.ff999').show();" class="btn btn-system btn-md"><i class="fa fa-plus"></i> <?php echo __("Add Service","premiumpress") ?></a> </div>
    
    <div <?php if(isset($_POST['ajaxedit'])){ ?>style="max-height:500px; overflow-y:scroll;"<?php } ?>>
    <div id="wlt_customextras_list" class="list-group">
      <?php 



if( !empty($current_data) ){ $i=0; foreach($current_data['name'] as $data){ if($current_data['name'][$i] !=""){ ?>
      <div   id="ff<?php echo $i; ?>">
        <div class="p-4 my-4" ppt-border1>
          <div class="row">
            <div class="col-md-8">
              <p class="text-uppercase font-weight-bold text-dark small"><?php echo __("Name","premiumpress") ?></p>
              <input type="text" name="customextras[name][]" id="ff<?php echo $i; ?>_title" value="<?php echo $current_data['name'][$i]; ?>" class="form-control rounded-0"  />
            </div>
            <div class="col-md-4">
              <p class="text-uppercase font-weight-bold text-dark small"><?php echo __("Price","premiumpress") ?></p>
              <div class="field_wrapper">
                <div class="input-group" style="max-width:200px;"><span class="input-group-text rounded-0 border-right-0"><?php echo hook_currency_symbol(''); ?></span>
                  <input type="text" name="customextras[price][]" maxlength="255" class="form-control rounded-0" value="<?php if(!isset($_GET['eid'])){ echo 0; }else{ echo $current_data['price'][$i]; } ?>" >
                </div>
              </div>
            </div>
            <div class="col-12 mt-4">
              <p class="text-uppercase font-weight-bold text-dark small"><?php echo __("Description","premiumpress") ?></p>
              <textarea name="customextras[value][]" class="form-control rounded-0" style="width:100%;height:100px;"><?php echo trim($current_data['value'][$i]); ?></textarea>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="text-right">
          <a href="javascript:void(0);" onClick="jQuery('#ff<?php echo $i; ?>_title').val('');jQuery('#ff<?php echo $i; ?>').hide();" class="btn btn-system btn-md mt-2">
          
          <div class="d-flex">
          <div ppt-icon-16 data-ppt-icon-size="16"><?php echo $CORE_UI->icons_svg['trash']; ?></div>
          
          <span class="ml-2"><?php echo __("Delete","premiumpress") ?></span>
          </div>
          
          
          </a> </div></div>
      </div>
      <?php } $i++; } } ?>
    </div>
    <div style="display:none">
      <div id="wlt_customextras_list_fields">
      
      <div class="ff999">
        <div class="p-4 mb-4  border mt-4">
          <div class="row">
            <div class="col-md-8">
              <p class="text-uppercase font-weight-bold text-dark small"><?php echo __("Name","premiumpress") ?></p>
              <input type="text" name="customextras[name][]" value="" class="form-control rounded-0"  />
            </div>
            <div class="col-md-4">
              <p class="text-uppercase font-weight-bold text-dark small"><?php echo __("Price","premiumpress") ?></p>
              <div class="field_wrapper">
                <div class="input-group" style="max-width:200px;"><span class="input-group-text rounded-0 border-right-0"><?php echo hook_currency_symbol(''); ?></span>
                  <input type="text" name="customextras[price][]" maxlength="255" class="form-control rounded-0" value="100" >
                </div>
              </div>
            </div>
            <div class="col-12 mt-4">
              <p class="text-uppercase font-weight-bold text-dark small"><?php echo __("Description","premiumpress") ?></p>
              <textarea name="customextras[value][]" class="form-control rounded-0" style="width:100%;height:100px;"></textarea>
            </div>
          </div>
          <div class="clearfix"></div>
          <a href="javascript:void(0);" onClick="jQuery('.ff999').hide();" class="btn btn-system btn-md mt-2"><i class="fa fa-trash"></i> <?php echo __("Delete","premiumpress") ?></a> </div>
      </div>
      
       </div>
</div>
    </div>
  </div>
<?php } ?>