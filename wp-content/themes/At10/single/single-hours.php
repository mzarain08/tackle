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

global $CORE, $userdata, $CORE_UI, $post;

if(in_array(THEME_KEY,array("es","rt","dl","dt","jb")) && in_array(_ppt(array('design', 'display_openinghours')), array("","1")) ){
 
?>
<div ppt-box class="rounded">

<?php if(!in_array(THEME_KEY,array("dt"))){ ?>
<div class="_header d-flex">
<div class="_title w-100">
  <?php echo ppt_title_hours(); ?>
</div> 
</div>
<?php } ?>
<div class="_content p-3">

<?php if(in_array(THEME_KEY,array("dt","jb"))){ ?>

<div class="mb-4">
	<?php
		$GLOBALS['single-data-block'] = "map-big";
		echo _ppt_template( 'single/single-content-data-block' ); 
		unset($GLOBALS['single-data-block']);
		?>
</div>
<?php
		$GLOBALS['single-data-button'] = "phone"; 
		echo _ppt_template( 'single/single-content-data-buttons' ); 
		unset($GLOBALS['single-data-button']); 
?>
<?php } ?>

	<?php
		$GLOBALS['single-data-block'] = "hours";
		echo _ppt_template( 'single/single-content-data-block' ); 
		unset($GLOBALS['single-data-block']);
		?>
</div>
</div>
<?php } ?>