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

<div class="tax_wrapper sold">
<?php	
$ratings = array(


	1 => array(
		"name" => __("No Sales","premiumpress"), 
	),
	2 => array(
		"name" => __("Upto 3 Sales","premiumpress"), 
	),
	3 => array(
		"name" => __("Upto 10 Sales","premiumpress"), 
	),
	4 => array(
		"name" => __("Upto 50 Sales","premiumpress"), 
	),
	5 => array(
		"name" => __("100+ Sales","premiumpress"), 
	),
); 

foreach($ratings as $s => $r){
?>
<div onclick="updateratingsold(<?php echo $s; ?>); jQuery('.sold .on').removeClass('on'); jQuery(this).toggleClass('on');" class="cursor">
<?php echo $r['name']; ?>
</div>
<?php } ?>
</div> 
      
<script>
function updateratingsold(g){	 
	jQuery('.ratingswitch label').removeClass('active');	 
	jQuery('#seller-sold').val(g).addClass('customfilter');
	_filter_update();
}
</script>

<input type="hidden" id="seller-sold" data-formatted-text="<?php echo __("Sold","premiumpress"); ?>" class="hidden" name="sold" data-type="text" data-key="sold" value="0">