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

 
if(defined('THEME_KEY') && in_array(THEME_KEY, array("cp"))){ ?>
        
<h3 class="link-dark text-700 text-md-left mb-2 mb-sm-3"><a href="javascript:void(0);" onclick="jQuery('.coupon-btn-<?php echo $post->ID; ?>').trigger('click');" class="single-link-<?php echo $post->ID; ?>"><?php echo $post->title; ?></a></h3>

<?php }elseif(defined('THEME_KEY') && in_array(THEME_KEY, array("da"))){ ?>

<h3><a href="<?php echo $post->link; ?>" class="single-link-<?php echo $post->ID; ?>"><?php echo $post->title; ?>,<?php echo do_shortcode('[AGE]'); ?></a></h3>
 
<?php }else{ ?>

<h3><a href="<?php echo $post->link; ?>" class="single-link-<?php echo $post->ID; ?>"><?php echo $post->title; ?></a></h3>

<?php } ?>