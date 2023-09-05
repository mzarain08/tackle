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

global $settings, $CORE;
 
 
  $settings = array(
  
   "title" => __("Default Membership","premiumpress"),
  
   "desc" => __("Here you can set a default membership for new users who join your website.","premiumpress"),
   
   "back" => "overview",
   
    );
   
   _ppt_template('framework/admin/_form-wrap-top' ); ?>
   
   
<div class="card card-admin">
  <div class="card-body">
  
           
          <div class="container px-0 border-bottom mb-3">
            <div class="row py-2">
              <div class="col-7">
                <label class="txt500"><?php echo __("Default Membership","premiumpress"); ?></label>
                <p class="text-muted"><?php echo __("Set a default membership for new users.","premiumpress"); ?></p>
              </div>
              <div class="col-5">
                <?php

	$status = array( "" => "None");
	// ADD ON MEMBERSHIPS
	$i=1; 
	while($i < 11){ 	
	
	
		$n =  _ppt('mem'.$i.'_name'); 			
		if($n == ""){ $i++; continue; }
			
		$status['mem'.$i] = $n;
		$i++;
	}
 
	
	?>
                <select name="admin_values[mem][regmembership]"   class="form-control" style="widht:100%;">
                  <?php foreach($status as $key => $club){ ?>
                  <option value="<?php echo $key; ?>" <?php if(_ppt(array('mem','regmembership')) == $key){  echo "selected=selected"; } ?>><?php echo $club; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>
  
<?php


if(THEME_KEY == "da"){

$count = 1;
$cats = get_terms( 'dagender', array( 'hide_empty' => 0, 'parent' => 0  ));
if(!empty($cats)){
foreach($cats as $cat){ 
if($cat->parent != 0){ continue; } 
 
?>
                    
    <!-- ------------------------- -->
    <div class="container px-0 border-bottom mb-3">
      <div class="row py-2">
        <div class="col-md-7">
          <label><?php echo $CORE->GEO("translation_tax", array($cat->term_id, $cat->name)); ?></label>
          <p class="text-muted"><?php echo __("Select membership for this gender type.","premiumpress"); ?></p>
        </div>
        <div class="col-md-5">
 
 <?php

	$status = array( "" => "None");
	// ADD ON MEMBERSHIPS
	$i=1; 
	while($i < 11){ 	
	
	
		 $n =  _ppt('mem'.$i.'_name');		
		if($n == ""){ $i++; continue; }
		$status['mem'.$i] = $n;
		$i++;
	}
 
	
	?>
                <select name="admin_values[mem][regmembership_<?php echo $cat->term_id; ?>]"   class="form-control" style="widht:100%;">
                  <?php foreach($status as $key => $club){ ?>
                  <option value="<?php echo $key; ?>" <?php if(_ppt(array('mem','regmembership_'.$cat->term_id)) == $key){  echo "selected=selected"; } ?>><?php echo $club; ?></option>
                  <?php } ?>
                </select>


        </div>
      </div>
    </div>
    
   <?php $count++; } } ?>
 

<?php  } ?>
 
    
      <div class="p-4 bg-light text-center mt-4">
      <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
    </div>
  </div>
</div>

  
<!-- end admin card -->
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?> 