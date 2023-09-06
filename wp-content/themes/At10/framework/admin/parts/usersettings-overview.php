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
 
 
global $settings;

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 $settings = array(
  
  "title" => __("User Settings","premiumpress"), 
  "desc" => __("Set default user preferences, custom user fields, registration details and more.","premiumpress"),
  
  "doclink" => "https://www.premiumpress.com/docs/users/",
  
  "video" => "",
  );
   _ppt_template('framework/admin/_form-wrap-top' ); 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
?>

<style>
#overview-box, #reg-box, #f-box, #login-box, #s-box, #t-box, #rating-box, #ads-box, #n-box, #m-box, #favs-box {
	display:none;
}
</style>



<div class="card p-3">

<a href="javascript:void(0);" class="_admin_iconbox icon-box" onclick="jQuery('#reg-tab').trigger('click');window.scrollTo({ top: 0, behavior: 'smooth' });">
<i class="fal fa-users-medical"></i><strong><?php echo __("Registration","premiumpress"); ?></strong>
<p><?php echo __("Manage user signups and registration options here.","premiumpress"); ?></p></a>

<a href="javascript:void(0);" class="_admin_iconbox icon-box" onclick="jQuery('#f-tab').trigger('click');window.scrollTo({ top: 0, behavior: 'smooth' });">
<i class="fal fa-align-left"></i><strong><?php echo __("Registration &amp; Account Fields","premiumpress"); ?></strong>
<p><?php echo __("Create your own fields for users to enter more details.","premiumpress"); ?></p></a>

<a href="javascript:void(0);" class="_admin_iconbox icon-box" style="border-bottom:0px;" onclick="jQuery('#t-tab').trigger('click');window.scrollTo({ top: 0, behavior: 'smooth' });">
<i class="fal fa-user-secret"></i><strong><?php echo __("User Types","premiumpress"); ?></strong>
<p><?php echo __("Manage user types and display options.","premiumpress"); ?></p></a>


</div>

 

<div class="card p-3">

 
<a href="javascript:void(0);" class="_admin_iconbox icon-box" onclick="jQuery('#login-tab').trigger('click');window.scrollTo({ top: 0, behavior: 'smooth' });">
<i class="fal fa-lock"></i><strong><?php echo __("Login Page","premiumpress"); ?></strong>
<p><?php echo __("Customize the login page design.","premiumpress"); ?></p></a>


<a href="javascript:void(0);" class="_admin_iconbox icon-box" style="border-bottom:0px;" onclick="jQuery('#s-tab').trigger('click');window.scrollTo({ top: 0, behavior: 'smooth' });">
<i class="fab fa-facebook"></i><strong><?php echo __("Social Login","premiumpress"); ?></strong>
<p><?php echo __("Let users to login via Twitter, Facebook, Google etc","premiumpress"); ?></p></a>



</div>



<div class="card p-3">

<a href="javascript:void(0);" class="_admin_iconbox icon-box" onclick="jQuery('#rating-tab').trigger('click');window.scrollTo({ top: 0, behavior: 'smooth' });">
<i class="fal fa-star"></i><strong><?php echo __("Rating &amp; Comments","premiumpress"); ?></strong>
<p><?php echo __("Turn on/off the user rating and comments system.","premiumpress"); ?></p></a>

<a href="javascript:void(0);" class="_admin_iconbox icon-box" onclick="jQuery('#favs-tab').trigger('click');window.scrollTo({ top: 0, behavior: 'smooth' });">
<i class="fal fa-heart"></i><strong><?php echo __("Favorites &amp; Likes","premiumpress"); ?></strong>
<p><?php echo __("Turn on/off the user favorites &amp; like system.","premiumpress"); ?></p></a>



<a href="javascript:void(0);" class="_admin_iconbox icon-box" onclick="jQuery('#m-tab').trigger('click');window.scrollTo({ top: 0, behavior: 'smooth' });">
<i class="fal fa-comments-alt"></i><strong><?php echo __("Message System","premiumpress"); ?></strong>
<p><?php echo __("Turn on/off the entire website message system.","premiumpress"); ?></p></a>


<a href="javascript:void(0);" class="_admin_iconbox icon-box" style="border-bottom:0px;" onclick="jQuery('#n-tab').trigger('click');window.scrollTo({ top: 0, behavior: 'smooth' });">
<i class="fal fa-bell"></i><strong><?php echo __("Notification System","premiumpress"); ?></strong>
<p><?php echo __("Turn on/off the entire website notification system.","premiumpress"); ?></p></a>


 
</div>
 
<div class="card p-3">

<div id="overviewlist"></div>   
 
</div>





<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?>