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

global $CORE, $CORE_UI;

 
 
?>

 

<div class="p-md-3">

<div class="fs-md text-600 mb-4"><?php echo __("Terms of use","premiumpress"); ?></div>

 
<?php

$g = _ppt(array('lst', 'cpterms')); 
				
if($g == 2){
	echo do_shortcode("[CONTENT  pid='".$_POST['pid']."']");				
}else{
	echo get_the_excerpt($_POST['pid'])."&nbsp;"; 
}

?>


</div>

 