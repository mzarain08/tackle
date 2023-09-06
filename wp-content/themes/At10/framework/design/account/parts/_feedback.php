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

global $settings, $userdata, $CORE, $CORE_UI;

 
if($settings['job_buyer_id'] == $userdata->ID){
	$feedback_date  = get_post_meta($settings['pid'],'feedback_date_buyer',true);
}else{
	$feedback_date  = get_post_meta($settings['pid'],'feedback_date_seller',true);
}


if($feedback_date == ""){
?>

<div class="p-3 my-4" ppt-border1>
  <p><strong><?php echo __("Leave Feedback","premiumpress"); ?></strong></p>
  <?php  get_template_part( 'author', 'feedback-form' ); ?>
</div>
<?php }elseif(isset($feedback_date) && strlen($feedback_date) > 1){ ?>
<div class="alert alert-warning p-3 mt-4">
  <div class="d-flex">
    <div class="ml-3">
      <div ppt-icon-48 data-ppt-icon-size="48" class="float-left mr-4 ml-2 pb-3 mt-2 hide-mobile">
        <?php  echo $CORE_UI->icons_svg['check_circle'];  ?>
      </div>
    </div>
    <div class="ml-3 y-middle">
      <div>
        <?php echo __("Feedback left on","premiumpress"); ?> <?php echo hook_date($feedback_date); ?>
      </div>
    </div>
  </div>
</div>
<?php }  ?>