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

global $CORE, $post, $userdata, $CORE_UI;

  
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if(in_array(_ppt(array('design','breadcrumbs')), array("","1")) && !isset($GLOBALS['flag-categories']) && !isset($GLOBALS['flag-stores']) ){
?>
<nav class="page-breadcrumbs border-bottom">
 
<div class="container py-4">
 
<h1 class="text-center text-sm-left h3 mb-0 pb-0"><?php echo $post->post_title; ?></h1>
 
</div>
 
</nav>
<?php } ?>