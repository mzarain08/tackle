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

<div class="tax_wrapper date_lastused">
<?php	
$ratings = array(

	1 => array(
		"name" => __("Today","premiumpress"), 
	),
	2 => array(
		"name" => __("Within 48 Hours","premiumpress"), 
	),
	3 => array(
		"name" => __("Within 7 Week","premiumpress"), 
	),
	4 => array(
		"name" => __("Within 2 Weeks","premiumpress"), 
	),
	5 => array(
		"name" => __("Within 1  Month","premiumpress"), 
	),
); 

foreach($ratings as $s => $r){
?>
<div onclick="updatecommentfilter(<?php echo $s; ?>); jQuery('.date_lastused .on').removeClass('on'); jQuery(this).toggleClass('on');">
<?php echo $r['name']; ?>
</div>
<?php } ?>
</div> 
      
<script>
function updatecommentfilter(g){	 
	jQuery('#date_lastused').val(g).addClass('customfilter');
	_filter_update();
}
</script>

<input type="hidden" id="date_lastused" class="hidden" name="date_lastused" data-formatted-text="<?php echo __("Last Used","premiumpress"); ?>" data-type="text" data-key="lastused" value="">