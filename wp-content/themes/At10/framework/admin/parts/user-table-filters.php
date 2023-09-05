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

<div class="py-4 ">
  <div class="container">
    <div class="row">
    
 
      <?php if( $CORE->LAYOUT("captions","memberships") && _ppt(array('mem','enable')) == 1 ){ ?>
      <div class="col-md-6 border-right">
        <label><?php echo __("Memberships","premiumpress"); ?></label>
        <hr />
        <label class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input customfilter" data-type="checkbox" data-key="membership" data-value="0" onclick="_filter_update()">
        <span class="custom-control-label"></span> <span class="custom-control-label"></span> <?php echo __("No Membership","premiumpress"); ?> </label>
        <?php 	 
	
	// GET MEMBERSHIPS
	$all_memberships = $CORE->USER("get_memberships", array());
	 
 foreach($all_memberships  as $key => $m){ 
	 ?>
        <label class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input customfilter" data-type="checkbox" data-key="membership" data-value="<?php echo $m['key']; ?>" onclick="_filter_update()" <?php if(isset($_GET['memid']) && $_GET['memid'] == $m['key']){ ?>checked=checked<?php } ?>>
        <span class="custom-control-label"></span> <span class="custom-control-label"></span> <?php echo $m['name']; ?> </label>
        <?php } ?>
      </div>
      <?php } ?>
       
     
      <div class="col-12">
        <h6><?php echo __("User Types","premiumpress"); ?></h6>
        <hr />
        
          <a href="javascript:void(0);" onclick="UpdateUserType('user_type','all');" class="badge badge-primary mr-2"><span><?php echo __("All","premiumpress"); ?></span></a>
          
        <?php $accountTypes = $CORE->USER("get_account_type_all", array());
		  
	if(!empty( $accountTypes ) ){ 
	
	
	?>
      
          <?php foreach($accountTypes as $k => $g){ ?>
          <a href="javascript:void(0);" onclick="UpdateUserType('user_type','<?php echo $k; ?>');" class="badge badge-primary mr-2"><span><?php echo $g['name']; ?></span></a>
          <?php } ?>
        
        <?php } ?>
        
        
        
        
      </div>
    </div>
  </div>
</div>
