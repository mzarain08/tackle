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

global $CORE, $userdata, $post, $settings; 

 
?>

<div class="tax_wrapper length">
<?php	
$ratings = array(


	1 => array(
		"name" => __("Any Length","premiumpress"), 
	),
	2 => array(
		"name" => __("Upto 1 Minute","premiumpress"), 
	),
	3 => array(
		"name" => __("Upto 5 Minutes","premiumpress"), 
	),
	4 => array(
		"name" => __("Upto 10 Minutes","premiumpress"), 
	),
	5 => array(
		"name" => __("10+ Minutes","premiumpress"), 
	),
); 

foreach($ratings as $s => $r){
?>
<div onclick="updateratinglength(<?php echo $s; ?>); jQuery('.length .on').removeClass('on'); jQuery(this).toggleClass('on');">
<?php echo $r['name']; ?>
</div>
<?php } ?>
</div> 
      
<script>
function updateratinglength(g){	 	 
	jQuery('#video-length').val(g).addClass('customfilter');
	_filter_update();
}
</script>

<input type="hidden" id="video-length" class="hidden" name="length" data-type="text" data-key="length" value="0">