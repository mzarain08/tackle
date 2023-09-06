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

<div class="tax_wrapper ends">
<?php	
$ratings = array(


	1 => array(
		"name" => __("Within 24 Hours","premiumpress"), 
	),
	2 => array(
		"name" => __("Within 48 Hours","premiumpress"), 
	),
	3 => array(
		"name" => __("This Week","premiumpress"), 
	),
	4 => array(
		"name" => __("This Month","premiumpress"), 
	),
 
); 

foreach($ratings as $s => $r){
?>
<div onclick="updateratingends(<?php echo $s; ?>); jQuery('.ends .on').removeClass('on'); jQuery(this).toggleClass('on');">
<?php echo $r['name']; ?>
</div>
<?php } ?>
</div> 
      
<script>
function updateratingends(g){	  
	jQuery('#dateends').val(g).addClass('customfilter');
	_filter_update();
}
</script>

<input type="hidden" id="dateends" class="hidden" name="ends" data-formatted-text="<?php echo __("Date Ends","premiumpress"); ?>" data-type="text" data-key="dateends" value="">