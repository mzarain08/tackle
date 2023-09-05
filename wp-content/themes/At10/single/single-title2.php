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

$url = get_post_meta($post->ID, "url", true);
if($url == ""){
	$url = get_post_meta($post->ID, "website", true);
}
 
$url_demo = "";
?>
 

<div class="mb-4 pb-3 border-bottom">
<div class="row">
<div class="col-md-8">


<h1 class="fs-lg text-600">
<?php _ppt_template( 'single/single-content-data-title' );  ?>
</h1>


    <div class="mt-3 d-md-flex text-600 link-dark fs-6 mt-3 download-bar mobile-mb-2">
    <?php if(strlen($url) > 1){ ?>
    <a target="_blank" class="mr-3" href="<?php echo $url; ?>" rel="nofollow" target="_blank">
    <i class="fal fa-external-link mr-2 text-primary"></i> <span class="ml-2"><?php echo __("Visit Website","premiumpress"); ?></span>
    </a>
    <?php } ?>
    
  
    <div class="mr-3">
    <i class="fal fa-eye mr-2 text-primary"></i> <span><?php echo do_shortcode('[HITS]'); ?> <?php echo __("Views","premiumpress"); ?></span>
    </div>
     
    
    <div class=" d-inline-flex cursor">
    <div class="mr-2"><i class="fal fa-star mr-2 text-primary"></i></div> <span><?php echo do_shortcode('[BUTTON_USER type="favs" button="0" class="" text=1 uid="'.$userdata->ID.'"]'); ?></span>
    </div>
    
    </div>

</div>
<div class="col-md-4 y-middle">

 <?php
 
$GLOBALS['single-data-button'] = "message";
echo _ppt_template( 'single/single-content-data-buttons' ); 
unset($GLOBALS['single-data-button']); 
 
 ?>

</div>
</div>
</div>