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
 
 
?>

<div class="row">
  <div class="col-md-7"> <a href="javascript:void(0);" class="btn btn-system btn-md hide-mobile  font-weight-bold" onclick="showfilersbar();"> <i class="fa fa-filter"></i> <?php echo __("Show Filters","premiumpress"); ?> </a> </div>
  <div class="col-md-5">
    <div class="row">
      <div class="col-md-6">
        <div class="dropdown filter_sortby_list">
          <button class="btn btn-system btn-md btn-block dropdown-toggle  font-weight-bold" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <?php echo __("Show Status","premiumpress"); ?> </button>
          <div class="dropdown-menu btn-block" aria-labelledby="dropdownMenuButton">
            <?php 


$s =  $CORE->ORDER("get_status",  array() ); 

foreach($s as $k => $status){
?>
            <a href="javascript:void(0);" class="dropdown-item" onclick="UpdateStatusT('<?php echo $status['key']; ?>')"> <span class="inline-flex items-center font-weight-bold order-status-icon <?php echo $status['css']; ?> mr-2"> <span class="dot mr-2"></span> <span class="pr-2px leading-relaxed whitespace-no-wrap"><?php echo $status['name']; ?></span> </span> </a>
            <?php
 
}


?>
          </div>
        </div>
      </div>
      <div class="col-md-6 mb-3">

        <div class="dropdown filter_sortby_list">
          <button class="btn btn-system btn-md btn-block dropdown-toggle  font-weight-bold" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <?php echo __("Sort Results By","premiumpress"); ?> </button>
          <div class="dropdown-menu btn-block" aria-labelledby="dropdownMenuButton"> 
          
          <a href="javascript:void(0);" class="dropdown-item active" data-key="date"><span><?php echo __("Date","premiumpress"); ?><i class="ml-2 fa fa-sort-amount-up-alt"></i></span></a> 
             
			<a href="javascript:void(0);" class="dropdown-item" data-key="order_total"><span><?php echo __("Amount","premiumpress"); ?><i></i></span></a>
              
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

