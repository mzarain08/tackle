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
  <?php _ppt_template( 'single/single-title' );  ?>
  <div class="row d-flex flex-row-reverse">
    <div class="col-lg-5 col-xl-4 mb-4">
      <?php  _ppt_template( 'single/single-fields' );  ?>
      <?php  if(in_array(_ppt(array('design', 'socialshare')), array("1",""))){ _ppt_template( 'single/single-share' ); }  ?>
    </div>
    <div class="col-lg-7 col-xl-8 maincontent pr-lg-5">
      <?php _ppt_template( 'single/single-gallery' );  ?>
      <?php  _ppt_template( 'single/single-content' );  ?>
      <?php  if(!user_can($post->post_author, 'administrator')){ _ppt_template( 'single/single-author' ); }  ?>
      <?php  if(_ppt(array('user','comments')) != "0"){  _ppt_template( 'single/single-reviews' ); }  ?>
    </div>
  </div>
</div>
<?php _ppt_template( 'single/single-related' );  ?>
