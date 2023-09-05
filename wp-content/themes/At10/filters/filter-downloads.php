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

<div class="tax_wrapper downloads">
<?php	
$ratings = array(


	1 => array(
		"name" => __("No Downloads","premiumpress"), 
	),
	2 => array(
		"name" => __("More Than 1 Download","premiumpress"), 
	),
	3 => array(
		"name" => __("50+ Downloads","premiumpress"), 
	),
	4 => array(
		"name" => __("100+ Downloads","premiumpress"), 
	),
	5 => array(
		"name" => __("500+ Downloads","premiumpress"), 
	),
); 

foreach($ratings as $s => $r){
?>
<div onclick="updateratingdownloads(<?php echo $s; ?>); jQuery('.downloads .on').removeClass('on'); jQuery(this).toggleClass('on');">
<?php echo $r['name']; ?>
</div>
<?php } ?>
</div> 
      
<script>
function updateratingdownloads(g){	 
	jQuery('#seller-downloads').val(g).addClass('customfilter');
	_filter_update();
}
</script>

<input type="hidden" id="seller-downloads" class="hidden" data-formatted-text="<?php echo __("Downloads","premiumpress"); ?>" name="downloads" data-type="text" data-key="downloads" value="0">