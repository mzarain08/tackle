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

global $CORE, $userdata;

$data = str_replace("data-srcxx","srcxx", do_shortcode('[LISTINGS dataonly=1 nav=0 small=1 carousel=1 custom="new"]'));

 
?>

<div class="hide-mobile" id="related-carousel">

<?php /*
  <div style="position: absolute;  <?php if($CORE->GEO("is_right_to_left", array() )){ echo "left:10px;"; }else{ echo "right:10px;";  } ?> top: -10px; cursor:pointer;"> <a class="btn bg-white btn-sm text-muted prev px-2 mt-2 border"><i class="fa fa-angle-left px-1" aria-hidden="true"></i></a> <a class="btn bg-white btn-sm text-muted next px-2 mt-2 border"><i class="fa fa-angle-right px-1" aria-hidden="true"></i></a> </div>

*/ ?>
  
  <div class=" d-sm-flex d-block">
    <h5 class=" text-black mb-0"><?php echo __("Newly Added","premiumpress"); ?> </h5>
  </div>
  <div class="mt-4">
    <div class="owl-carousel owl-theme"> <?php echo $data;  ?> </div>
   
  </div>
</div>
