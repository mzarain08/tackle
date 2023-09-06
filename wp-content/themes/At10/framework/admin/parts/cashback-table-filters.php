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

global $CORE;
 
$cashbackFields = $CORE->USER("cashback_fields",array());
 
?>

<div class="py-4">
  <div class="container">
    <div class="row">
      <div class="col-md-3 border-right openfilters">
        <label><?php echo __("Status","premiumpress");  ?></label>
        <select class="form-control customfilter" id="poststatusop" data-type="select" onchange="_filter_update()" data-key="cashbackstatus">
        <option value="">----</option>
          <?php
 

foreach( $cashbackFields['cashback_status']['values'] as $k => $n){
?>
          <option value="<?php echo $n['id']; ?>" <?php  if(isset($_GET['eid']) && is_numeric($_GET['eid']) ){  selected( $orderstatus, $k ); }  ?>><?php echo $n['name']; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
  </div>
</div>
