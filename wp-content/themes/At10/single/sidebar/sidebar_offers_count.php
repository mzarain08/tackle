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

global $CORE, $userdata, $post;
 
?>

<?php

theme_sidebar_buttons("favs", "" ); 

theme_sidebar_buttons("share", "" ); 
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if(_ppt(array('user','friends')) == 1){ ?>

      <?php echo do_shortcode('[SUBSCRIBE class="btn btn-block btn-system btn-icon icon-before btn-xl  mt-0 mb-3" icon=1 count=0 text=1 uid="'.$post->post_author.'"]'); ?>
      
<?php }

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


theme_sidebar_buttons("report", "" ); 
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>

<div class="small opacity-5 mt-4 text-center"><?php echo str_replace("%s",$CORE->LAYOUT("captions",1),str_replace("%p",do_shortcode("[HITS]"), __("This page has been viewed %p times.","premiumpress"))); ?></div>

<div class="mt-3 text-center">

<span class="inline-flex items-center font-weight-bold order-status-icon status-2 mr-2"> <span class="dot mr-2"></span> <span class="pr-2px leading-relaxed whitespace-no-wrap">ID #<?php echo $post->ID; ?></span> </span>

</div>