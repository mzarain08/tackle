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

global $CORE, $userdata, $post, $settings, $CORE_UI; 

?>
<div class="tax_wrapper">
<?php	
$ratings = array(


	1 => array(
		"name" => __("1 Star","premiumpress"), 
	),
	2 => array(
		"name" => __("2 Stars","premiumpress"), 
	),
	3 => array(
		"name" => __("3 Stars","premiumpress"), 
	),
	4 => array(
		"name" => __("4 Stars","premiumpress"), 
	),
	5 => array(
		"name" => __("5 Stars","premiumpress"), 
	),
); 

foreach($ratings as $s => $r){
?>
<div onclick="updaterating(<?php echo $s; ?>); jQuery(this).toggleClass('on');">
<?php echo $CORE_UI->RATING("stars", array("css" => "", "total" => $s, "result" => $s, "size" => "lg")); ?>
</div>
<?php } ?>
</div>


 
      
      <script>
function updaterating(g){	 
	jQuery('.ratingswitch label').removeClass('active');	 
	jQuery('#rating-filter').val(g).addClass('customfilter');
	_filter_update();
}
</script>

<input type="hidden" id="rating-filter" class="hidden" data-formatted-text="<?php echo __("Rating","premiumpress"); ?>" name="rating" data-type="text" data-key="rating" value="0">
