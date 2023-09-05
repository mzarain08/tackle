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

global $CORE, $userdata, $post, $CORE_UI;

?>

<div class="container py-md-5">
  <div class="row">
    <div class="col-12">
    </div>
    <div class="col-lg-8 col-xl-9 maincontent pr-lg-5">
      <?php  _ppt_template( 'single/single-gallery-video' );  ?>
      <?php  _ppt_template( 'single/single-statsbar' );  ?>
      <?php  _ppt_template( 'single/single-video-series' );  ?>
      <?php  _ppt_template( 'single/single-content' );  ?>
      <?php  if(!user_can($post->post_author, 'administrator')){ _ppt_template( 'single/single-author' ); }  ?>
      <?php  if(_ppt(array('user','comments')) != "0"){ _ppt_template( 'single/single-reviews' ); }  ?>
    </div>
    <div class="col-lg-4 col-xl-3">
      <?php  _ppt_template( 'single/single-sidebar-content' );  ?>
      <?php  _ppt_template( 'single/single-buttons' );  ?>
      <?php  if(in_array(_ppt(array('design', 'socialshare' )), array("1",""))){ _ppt_template( 'single/single-share' ); } ?>
    </div>
  </div>
</div>
<?php _ppt_template( 'single/single-related' );  ?>
