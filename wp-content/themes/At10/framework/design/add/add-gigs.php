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
if(isset($_GET['eid'])){



}
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
?>

 
<label><?php echo __("Create custom pricing plans for this job.","premiumpress"); ?> <span class="text-danger">*</span> </label>

  
<div class="row mt-2">
 
    <div class="col-4 col-xl-3 gig-box gig-box-1 active">
    
        <div class="cardbox" onclick="showGigBox(1)">
        
        <i class="fal fa-award"></i>
        
        <div class="small"><?php echo __("Basic","premiumpress"); ?></div>
        
    	</div> 
    
    </div>
    
    <div class="col-4 col-xl-3 gig-box gig-box-2">
    
        <div class="cardbox" onclick="showGigBox(2)">
        
        <i class="fal fa-trophy"></i>
        
        <div class="small"><?php echo __("Standard","premiumpress"); ?></div>
        
    	</div> 
    
    </div>
    
    <div class="col-4 col-xl-3 gig-box gig-box-3">
    
        <div class="cardbox" onclick="showGigBox(3)">
        
        <i class="fal fa-star"></i>
        
        <div class="small"><?php echo __("Premium","premiumpress"); ?></div>
        
    	</div> 
    
    </div>
    
</div>

<script>

function showGigBox(id){

jQuery('.giginfo').hide();
jQuery('.gig-box').removeClass('active');
jQuery('.gig-'+id).toggle();
jQuery('.gig-box-'+id).toggleClass('active');

}

</script> 

 
    
<div class="row">
<?php $a=1; while($a < 4){ 

$name = "gig";
$price = "price";
$days = "days";
$desc = "desc";
$icon = "fal fa-award";

$title = __("Basic","premiumpress");

if($a ==2){
$name = "gig-1";
$price = "price-1";
$days = "days-1";
$desc = "desc-1";

$icon = "fal fa-trophy";

$title = __("Standard","premiumpress");


}elseif($a ==3){

$name = "gig-2";
$price = "price-2";
$days = "days-2";
$desc = "desc-2";

$icon = "fal fa-star";

$title =  __("Premium","premiumpress");
 

}

 // TURN OFF DAYS
$showdays = true;
/*
$el = _ppt(array('design', "element_days"));
if($el == 0){
$showdays = false;
}
*/
	 

?>
<div class="col-12 giginfo gig-<?php echo $a; ?>" <?php if($a != 1){ ?>style="display:none"<?php } ?>>
<div class="p-4 my-4 border bg-light shadow-sm rounded">

<div class="row">

    <div class="col-md-6">
    
    <label><i class="<?php echo $icon; ?> mr-2"></i> <?php echo __("Title","premiumpress"); ?></label>
    <input type="text" class="form-control mb-2" name="custom[<?php echo $name; ?>]" value="<?php echo $CORE->get_edit_data($name, $editID); ?>" />     


    <div class="row">
    <div class="col-md-6">
       <label><?php echo __("Price","premiumpress"); ?></label>
        
        <div class="position-relative">
   
                    <input type="text" name="custom[<?php echo $price; ?>]" maxlength="10" placeholder="0" class="form-control mb-2" value="<?php 
            
            if(!isset($_GET['eid'])){ echo 0; }else{ $g = $CORE->get_edit_data($price, $_GET['eid']); if($g == ""){ echo 0; }else{ echo $g; } } ?>">
            
            <span class="position-absolute" style="top:8px; right:10px;"><?php if(strpos( _ppt(array('currency','symbol')), "fal") === false){ echo hook_currency_symbol('');  }else{ echo '<i class="'._ppt(array('currency','symbol')).'"></i>'; } ?></span>
            
            
        </div>
    </div>
    <div class="col-md-6">
    
    <div <?php if(!$showdays){ ?>style="display:none"<?php } ?>>
    <label><?php echo __("Complete in","premiumpress"); ?> </label>
       
                      <select name="custom[<?php echo $days; ?>]" class="form-control mb-2 mb-md-0">
                      <option value="1" <?php selected( $CORE->get_edit_data($days, $editID), 1 ); ?>>1 <?php echo __("day","premiumpress"); ?></option>
                      <?php
            $i=2;
            while($i< 31){
            ?>
                      <option value="<?php echo $i; ?>" <?php selected( $CORE->get_edit_data($days, $editID), $i ); ?>><?php echo $i; ?> <?php echo __("days","premiumpress"); ?></option>
                      <?php $i++; } ?>
                    </select>
    
    </div>
    </div>
 

</div></div>

<div class="col-md-6">
    
<label> <?php echo __("Description","premiumpress"); ?> </label>
<textarea name="custom[<?php echo $desc; ?>]" class="form-control mb-2" style="min-height:120px;"><?php echo $CORE->get_edit_data($desc, $editID); ?></textarea>



 </div>
</div>
</div>
</div>
      <?php $a++; } ?>
    </div>
  
    
    
<div class="block-header mt-4">
<h3 class="block-header__title"><?php echo __("Add-ons","premiumpress"); ?></h3>
<div class="block-header__divider"></div> 
</div>
 
    <div class="clearfix mb-4"> <a href="javascript:void(0);" onClick="gigAdd();" class="btn btn-system btn-md"><i class="fa fa-plus"></i> <?php echo __("Add Add-on","premiumpress") ?></a> </div>
    <div id="wlt_customextras_list" class="list-group">
      <?php 

$current_data = array();
if(isset($_GET['eid'])){
$current_data = get_post_meta($_GET['eid'],'customextras', true); 
}

if( !empty($current_data) ){ $i=0; foreach($current_data['name'] as $data){ if($current_data['name'][$i] !=""){ ?>
      <div id="ff<?php echo $i; ?>">
        <div class="p-4 my-4 border bg-light">
          <div class="row">
            <div class="col-md-8">
              <p class="text-uppercase font-weight-bold text-dark small"><?php echo __("Add-on","premiumpress") ?> <?php echo __("Title","premiumpress") ?></p>
              <input type="text" name="customextras[name][]" id="ff<?php echo $i; ?>_title" value="<?php echo $current_data['name'][$i]; ?>" class="form-control rounded-0"  />
            </div>
            <div class="col-md-4">
              <p class="text-uppercase font-weight-bold text-dark small"><?php echo __("Price","premiumpress") ?></p>
              <div class="field_wrapper">
                <div class="input-group" style="max-width:200px;"><span class="input-group-text rounded-0 border-right-0"><?php if(strpos( _ppt(array('currency','symbol')), "fal") === false){ echo hook_currency_symbol('');  }else{ echo '<i class="'._ppt(array('currency','symbol')).'"></i>'; } ?></span>
                  <input type="text" name="customextras[price][]" maxlength="255" class="form-control rounded-0 val-numeric" value="<?php if(!isset($_GET['eid'])){ echo 0; }else{ echo $current_data['price'][$i]; } ?>" >
                </div>
              </div>
            </div>
            <div class="col-12 mt-4">
              <p class="text-uppercase font-weight-bold text-dark small"><?php echo __("Description","premiumpress") ?></p>
              <textarea name="customextras[value][]" class="form-control rounded-0" style="width:100%;height:100px;"><?php echo trim($current_data['value'][$i]); ?></textarea>
            </div>
          </div>
          <div class="clearfix"></div>
          <a href="javascript:void(0);" onClick="jQuery('#ff<?php echo $i; ?>_title').val('');jQuery('#ff<?php echo $i; ?>').hide();" class="btn btn-system btn-md mt-2"><i class="fa fa-trash"></i> <?php echo __("Delete","premiumpress") ?></a> </div>
      </div>
      <?php } $i++; } } ?>
    </div>
    <div style="display:none">
      <div id="wlt_customextras_list_fields">
      
      <div id="randomnumme">
        <div class="p-4 my-4 border bg-light">
          <div class="row">
            <div class="col-md-8">
              <p class="text-uppercase font-weight-bold text-dark small"><?php echo __("Add-on","premiumpress") ?> <?php echo __("Title","premiumpress") ?></p>
              <input type="text" name="customextras[name][]" value="" class="form-control rounded-0"  />
            </div>
            <div class="col-md-4">
              <p class="text-uppercase font-weight-bold text-dark small"><?php echo __("Price","premiumpress") ?></p>
              <div class="field_wrapper">
                <div class="input-group" style="max-width:200px;"><span class="input-group-text rounded-0 border-right-0"><?php if(strpos( _ppt(array('currency','symbol')), "fa") === false){ echo hook_currency_symbol('');  }else{ echo '<i class="'._ppt(array('currency','symbol')).'"></i>'; } ?></span>
                  <input type="text" name="customextras[price][]" maxlength="255" class="form-control rounded-0 val-numeric" value="100" >
                </div>
              </div>
            </div>
            <div class="col-12 mt-4">
              <p class="text-uppercase font-weight-bold text-dark small"><?php echo __("Description","premiumpress") ?></p>
              <textarea name="customextras[value][]" class="form-control rounded-0" style="width:100%;height:100px;"></textarea>
            </div>
          </div>
          <div class="clearfix"></div>
          <a href="javascript:void(0);" class="btn btn-system btn-md mt-2"><i class="fa fa-trash"></i> <?php echo __("Delete","premiumpress") ?></a> </div>
      </div>
      
       </div>
      
      
        
        
        
   
    </div>
 
 
<script>



function gigAdd(){

	var num = Math.floor((Math.random() * 100) + 1);	
	 
	jQuery("#randomnumme").addClass('gig-'+num);
	
	jQuery('#wlt_customextras_list_fields').clone().insertBefore('#wlt_customextras_list').removeAttr('id');	
	
	jQuery("#wlt_customextras_list_fields #randomnumme").removeClass('gig-'+num);	
	
	jQuery('.gig-' + num).find(".btn-system").attr('onClick', 'randomnumme_delete('+num+');');
	
	jQuery('.gig-' + num).removeAttr('id');
	
}


function randomnumme_delete(id){
 
	jQuery(".gig-"+id).html('');

}

</script>
