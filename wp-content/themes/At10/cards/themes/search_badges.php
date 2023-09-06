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

global $post, $CORE_UI, $userdata, $CORE;
 
?>

<div ppt-search-badges style="z-index:1" <?php if(in_array(THEME_KEY, array("es","da"))){ ?>class="right"<?php } ?>>
  <?php  
	// CHECK WE HAVE BADHES ENABLED
	if(in_array(_ppt(array('badges', 'enable' )), array("","1"))  && get_post_meta($post->ID,'badges',true) != "" ){ 
	
	$myBadges = get_post_meta($post->ID,'badges',true);
	if(!is_array($myBadges) || is_array($myBadges) && empty($myBadges) ){  }else{
	
	
        
		$current_data = get_option("ppt_badges");      $hasBadge = false;    
        if( !empty($current_data) ){ $show = 0; $i=0; 
		
		foreach($current_data['name'] as $data){ 
        
        if($current_data['name'][$i] == ""){ $i++; continue; } 	
		if($current_data['search'][$i] != 1){ $i++; continue; }			
        if(in_array($current_data['key'][$i], $myBadges)){
        
		$hasBadge = true;
        ?>
  <div class="badge" style="<?php if(isset($current_data['txtcolor'][$i]) && strlen($current_data['txtcolor'][$i]) > 1){ ?>color:<?php echo $current_data['txtcolor'][$i]; ?>;<?php } ?><?php if(isset($current_data['color'][$i]) && strlen($current_data['color'][$i]) > 1){ ?>background-color:<?php echo $current_data['color'][$i]; ?>;<?php } ?>">
    <span class="fal <?php echo $current_data['icon'][$i]; ?>" <?php if(isset($current_data['txtcolor'][$i]) && strlen($current_data['txtcolor'][$i]) > 1){ ?>style="color:<?php echo $current_data['txtcolor'][$i]; ?>"<?php } ?>>&nbsp;</span> <?php echo $current_data['name'][$i]; ?>
  </div>
  <?php $show++; } $i++; } } ?>
  <?php  } } ?>
   
</div> 