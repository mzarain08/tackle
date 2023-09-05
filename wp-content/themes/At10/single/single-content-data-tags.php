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

global $CORE, $post, $userdata, $new_settings; 
 
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if(in_array(_ppt(array('design','display_tags')), array("","1"))  ){ 

 
$words = $CORE->PACKAGE("get_post_keywords", $post->ID); 
 
if(is_array($words) && !empty($words)){ ?>

<?php foreach($words as $w){ if(strlen(strip_tags($w)) < 2){ continue; } ?>

<a href="<?php echo home_url(); ?>/?s=<?php echo trim(strip_tags($w)); ?>" class="btn-xs btn-system shadow-0" data-ppt-btn><?php echo trim(strip_tags($w)); ?></a> 

<?php } ?>
          
       
<?php } } ?>