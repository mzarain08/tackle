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

global $CORE, $settings, $CORE_UI;



 

$settings = array(

"title" => __("Dispute Details","premiumpress"), 

"desc" =>__("Here you can add/edit a dispute.","premiumpress"),

);

// USER ID
if(isset($_GET['eid']) && is_numeric($_GET['eid']) ){ $dispute_userid =  get_post_meta($_GET['eid'], "dispute_userid", true); } 

 

_ppt_template('framework/admin/_form-wrap-top' ); ?>

<div class="card card-admin">
  <div class="card-body">
    <div class="card-title mb-4"><?php echo __("Dispute Details","premiumpress"); ?></div>
    
    
    
    
    <form method="post" action="" enctype="multipart/form-data">
      <input type="hidden" name="disputeid" value="<?php if(isset($_GET['eid']) && is_numeric($_GET['eid'])){ echo esc_attr($_GET['eid']); }else{ echo 0; }  ?>" />      
      <div class="row">
	  <?php
	  
	  $eid = "";
	  if(isset($_GET['eid']) && is_numeric($_GET['eid']) ){
	  $eid = $_GET['eid'];
	  }	  
	  
	  $fields = $CORE->ORDER("dispute_fields", array()); 
	  foreach( $fields as $k => $f){ 
	  
	  echo $CORE_UI->FIELD(array("dispute",$k), $f, $eid);
	  
	  } ?> 
      </div>
      
      <div class="p-4 bg-light text-center mt-4">
        <button type="submit" data-ppt-btn class="btn-primary"> <?php echo __("Save Changes","premiumpress"); ?></button>
      </div>
    </form> 
     
 
  </div>
</div>
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?>
