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


 
$post->featured = get_post_meta($post->ID,"featured",true);
 
 
?>

<?php if(THEME_KEY == "es" && $post->featured ){ ?>
<div class="button-featured-new-wrap es">
<div class="button-featured-new"><?php echo __("Featured","premiumpress"); ?></div>
</div>
<?php } ?>

 
<div class="buttons-wrap"> 

<?php if( THEME_KEY != "es" && ( isset($post->boosted) || $post->featured ) ){ ?>
<div class="button-featured"><?php echo __("Featured","premiumpress"); ?></div>
<?php } ?> 
   
<?php if(!isset($post->hasVideo) || isset($post->post_date) && strtotime(date("Y-m-d H:i:s", strtotime($post->post_date . " +1 day"))) > strtotime(date("Y-m-d H:i:s", strtotime( current_time( 'mysql' ) ) )) ){  ?>
<div class="button-new"><?php echo __("new","premiumpress");  ?></div>   
<?php } ?>

<?php  if(THEME_KEY  != "vt" && ( !isset($post->hasVideo) || ( isset($post->hasVideo) && $post->hasVideo)) ){  ?>      
<div class="button-video"><?php echo __("Video","premiumpress"); ?></div>
<?php } ?> 

<?php  if(THEME_KEY  ==  "cb" && get_post_meta($post->ID,'cashback_p', true) > 0){

$cp = get_post_meta($post->ID,'cashback_p', true);

$cbc = "";
if($cp > 5){
$cbc = "button-color-blue";
}

if($cp > 25){
$cbc = "button-color-green";
}

 ?>
<div class="button-vip disc <?php echo $cbc; ?>"><span><?php echo $cp; ?>%</span></div>
<?php } ?>

<?php /*
 

<?php if(1==1 || $post->hasMem){ ?> 
<div class="button-vip disc"><span><?php echo __("vip","premiumpress"); ?></span></div>
<?php } ?>
 
<?php  if(1==1 || THEME_KEY  != "vt" && ( !isset($post->hasVideo) || ( isset($post->hasVideo) && $post->hasVideo)) ){  ?>        
<div class="button-videos disc"><span ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['video-full']; ?></span></div>
<?php } ?>
*/ ?>

</div>