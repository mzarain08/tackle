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

global $CORE;  ?>

   
    <h6 class="mt-4"><?php echo __("Date Filter","premiumpress"); ?></h6>
   
   <hr />
   
  
 
      <div class="row">
        <div class="col-md-12">
          <label class="mt-1"><?php echo __("Start Date","premiumpress") ?></label>
        </div>
        <div class="col-md-12">
          <div class="input-group date ppt-datepicker" data-target="#expiry-date" id="expiry-date">
            <input type="text" <?php if(!$CORE->isMobileDevice()){ ?>onchange="_filter_update()" <?php } ?> value="" class="form-control rounded-0 customfilter" data-key="orderdate1"  data-type="text">
            <span class="input-group-addon" style="top: 10px;    right: 10px;    position: absolute;    z-index: 100;"> <span class="fal fa-calendar"></span> </span> </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <label class="mt-1"><?php echo __("End Date","premiumpress") ?></label>
        </div>
        <div class="col-md-12">
          <div class="input-group date ppt-datepicker" data-target="#expiry-date2" id="expiry-date2">
            <input type="text" <?php if(!$CORE->isMobileDevice()){ ?>onchange="_filter_update()" <?php } ?> data-type="text" data-key="orderdate2"  class="form-control rounded-0 customfilter" >
            <span class="input-group-addon" style="top: 10px;    right: 10px;    position: absolute;    z-index: 100;"> <span class="fal fa-calendar"></span> </span> </div>
        </div>
      </div>
  
