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


//$post->distance = 100; $post->distance_text = "100 miles away";
 
?>


<?php  if(isset($post->distance) && $post->distance > 0 && _ppt(array('maps','enable'))  == "1" ){  ?>
<div class="_content border-top py-2 fs-sm " ppt-flex-between>

<div class="text-600">
<?php echo __("Distance","premiumpress"); ?>
</div>

<div>
<?php  echo $post->distance_text; ?>
</div>

</div>
<?php } ?>


 

