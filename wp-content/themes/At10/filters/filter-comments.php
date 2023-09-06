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

<div class="tax_wrapper commentc">
<?php	
$ratings = array(


	1 => array(
		"name" => __("No Comments","premiumpress"), 
	),
	2 => array(
		"name" => __("1 or more","premiumpress"), 
	),
	3 => array(
		"name" => __("5 or more","premiumpress"), 
	),
	4 => array(
		"name" => __("10 or more","premiumpress"), 
	),
	5 => array(
		"name" => __("20+ Comments","premiumpress"), 
	),
); 

foreach($ratings as $s => $r){
?>
<div onclick="updatecommentfilter(<?php echo $s; ?>); jQuery('.commentc .on').removeClass('on'); jQuery(this).toggleClass('on');">
<?php echo $r['name']; ?>
</div>
<?php } ?>
</div> 
      
<script>
function updatecommentfilter(g){	 
	jQuery('#comments').val(g).addClass('customfilter');
	_filter_update();
}
</script>

<input type="hidden" id="comments" class="hidden" name="comments" data-formatted-text="<?php echo __("Reviews","premiumpress"); ?>" data-type="text" data-key="comments" value="">