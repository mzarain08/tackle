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

if(in_array(_ppt(array('design', 'display_rates')), array("","1")) ){

$editID=0;
if(isset($_GET['eid']) && is_numeric($_GET['eid'])){
$editID = $_GET['eid'];
} 

$rates = array(
1 => __("1 Hour","premiumpress"),
2=> __("2 Hours","premiumpress"),
3 => __("3 Hours","premiumpress"),
4 =>__("6 Hours","premiumpress"),
5 => __("12 Hours","premiumpress"),
);
	

 
 
 
?>

<div class="block-header mt-4">
  <h3 class="block-header__title"><?php echo __("My Rates","premiumpress"); ?></h3>
  <div class="block-header__divider">
  </div>
</div>
<?php if(!isset($_POST['ajaxedit'])){ ?>
<div class="row" id="ratesbit">
  <div class="col-6 col-md-4 col-lg-3">
    <div class="cardbox closed" onclick="jQuery('#ratesbox, #ratesbit').toggle();">
      <i class="fal fa-comments-dollar"></i>
      <div class="small">
        <?php echo __("manage","premiumpress"); ?>
      </div>
    </div>
  </div>
</div>
<div id="ratesbox" style="display:none">
  <i class="fa fa-times float-right" onclick="jQuery('#ratesbox, #ratesbit').toggle();" style="cursor:pointer;"></i>
  <?php } ?>
  <div class="row">
    <?php  foreach($rates as $k => $r){ ?>
    <div class="col-lg-12 border-bottom mb-3 pb-3">
      <div class="row">
        <div class="col-md-4 y-middle">
          <div class="h6">
            <?php echo $r; ?>
          </div>
        </div>
        <div class="col-md-4">
          <label class="small"><?php echo __("Incall","premiumpress"); ?></label>
          <div class="input-group">
            <span class="input-group-text rounded-0 border-right-0"><?php echo hook_currency_symbol(''); ?></span>
            <input type="text" name="custom[rate_incall<?php echo $k; ?>]" maxlength="10" class="form-control rounded-0 val-numeric required" value="<?php 		if(!isset($_GET['eid'])){ echo 0; }else{ $g = $CORE->get_edit_data('rate_incall'.$k, $_GET['eid']); if(!is_numeric($g)){ echo 0; }else{ echo $g; } } ?>">
          </div>
        </div>
        <div class="col-md-4">
          <label class="small"><?php echo __("Outcall","premiumpress"); ?></label>
          <div class="input-group">
            <span class="input-group-text rounded-0 border-right-0"><?php echo hook_currency_symbol(''); ?></span>
            <input type="text" name="custom[rate_outcall<?php echo $k; ?>]" maxlength="10" class="form-control rounded-0 val-numeric required" value="<?php 		if(!isset($_GET['eid'])){ echo 0; }else{ $g = $CORE->get_edit_data('rate_outcall'.$k, $_GET['eid']); if(!is_numeric($g)){ echo 0; }else{ echo $g; } } ?>">
          </div>
        </div>
      </div>
    </div>
    <?php  } ?>
  </div>
  <?php if(!isset($_POST['ajaxedit'])){ ?>
</div>
<?php } ?>
<?php } ?>