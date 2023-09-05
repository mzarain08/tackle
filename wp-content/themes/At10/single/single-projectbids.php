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

global $CORE, $userdata, $CORE_UI, $post;


if(in_array(THEME_KEY,array("pj"))){ 
 
?>
<div ppt-box class="rounded">

 
<div class="_header d-flex">
    <div class="_title w-100">
     <?php echo __("Project Bids","premiumpress"); ?> 
    </div> 
    <div class="w-100 text-right">
    <div ppt-flex-end class="mr-2  align-items-baseline">
        <span class="opacity-5 fs-xs mr-2"><?php echo __("top bid","premiumpress"); ?></span>
        
        <span class="topbidprice text-600  <?php echo $CORE->GEO("price_formatting",array()); ?>"><?php if(is_admin()){echo "50"; }else{ echo  get_post_meta($post->ID, "price", true); } ?></span>
        
    </div>
    </div>
    
    
</div>
 
<div class="_content p-3">
 
	<?php

$GLOBALS['single-data-block'] = "project-bids";
echo _ppt_template( 'single/single-content-data-block' ); 
unset($GLOBALS['single-data-block']);	

		?>
</div>
</div>
<?php } ?>