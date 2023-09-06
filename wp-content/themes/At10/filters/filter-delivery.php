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

<div class="tax_wrapper del">
<?php	
$ratings = array(


	1 => array(
		"name" => __("Express 24 Hrs","premiumpress"), 
	),
	2 => array(
		"name" => __("Upto 3 Days","premiumpress"), 
	),
	3 => array(
		"name" => __("Upto 1 Week","premiumpress"), 
	),
	4 => array(
		"name" => __("Upto 1 Month","premiumpress"), 
	),
	0 => array(
		"name" => __("Anytime","premiumpress"), 
	),
); 

foreach($ratings as $s => $r){
?>
<div onclick="updaterating(<?php echo $s; ?>); jQuery('.del .on').removeClass('on'); jQuery(this).toggleClass('on');">
<?php echo $r['name']; ?>
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

<input type="hidden" id="rating-filter" class="hidden" data-formatted-text="<?php echo __("Delivery Time","premiumpress"); ?>"  name="delivery" data-type="text" data-key="delivery" value="0">