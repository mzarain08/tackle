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


  <div class="row d-flex flex-row-reverse">
    <div class="col-lg-5 col-xl-4 mb-4">
      
     <?php  _ppt_template( 'single/single-title' );  ?>     
      
      <?php  _ppt_template( 'single/single-subtitle' );  ?>  
      
      <?php  _ppt_template( 'single/single-sidebar-content' );  ?>
       <?php  _ppt_template( 'single/single-content-data-button-block' );  ?>
      
      <?php  _ppt_template( 'single/single-hours' );  ?>
      <?php  _ppt_template( 'single/single-rates' );  ?>
      <?php  _ppt_template( 'single/single-claim' );  ?>
       <?php _ppt_template( 'single/single-projectbids' );  ?>
      <?php  _ppt_template( 'single/single-sharebox' );  ?> 
    </div>
    <div class="col-lg-7 col-xl-8 maincontent pr-lg-5">
      <?php $GLOBALS['flag-gallery-inline']=1; _ppt_template( 'single/single-gallery' );  ?>
      <?php  _ppt_template( 'single/single-content' );  ?>
      <?php  _ppt_template( 'single/single-files' );  ?>
      <?php  _ppt_template( 'single/single-fields' );  ?>
      <?php  _ppt_template( 'single/single-author' );  ?>
      <?php  _ppt_template( 'single/single-faq' );  ?>
      <?php  _ppt_template( 'single/single-reviews' );  ?>
    </div>
  </div>
</div>

<?php _ppt_template( 'single/single-related' );  ?>
