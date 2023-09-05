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

global $CORE, $post, $userdata; 



   // ADMIN PREVIEW
    if(!isset($post->ID)){


	$current_data = array(	
								"name" => array( 0 => "Example Service 1", 1 => "Example Service 2", 2 => "Example Service 3" ),
								"value" => array( 0 => "Here users can create their own services.", 1 => "Here users can create their own services", 2 => "Here users can create their own services" ),
								"price" => array( 0 => "10", 1 => "50", 2 => "100" ) 
							);	
	}else{
	
$current_data = get_post_meta($post->ID,'customextras', true);
	
	}


 
 

if( !empty($current_data) ){ $i=0;  ?>

<div id="single-display-services" class="mt-n4">
  
  <?php  foreach($current_data['name'] as $data){ if($current_data['name'][$i] !=""){  ?>
  <div class="mt-4 w-100">
    <div class="d-flex justify-content-between">
    
    <div class="fs-6 text-600"><?php echo stripslashes($current_data['name'][$i]); ?></div>
    
      <?php if(strlen($current_data['price'][$i]) > 0){ ?>
      <span><em><?php echo hook_price($current_data['price'][$i]); ?></em></span>
      <?php } ?>
    </div>
    <?php if(strlen($current_data['value'][$i]) > 0){ ?>
    <div class="small mt-2 opacity-5 "> <?php echo stripslashes($current_data['value'][$i]); ?> </div>
    <?php } ?>
  </div>
  <?php } $i++; } ?>
</div>
<?php } 

  ?>