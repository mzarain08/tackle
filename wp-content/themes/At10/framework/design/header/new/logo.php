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

global $CORE, $userdata, $settings, $CORE_UI, $df;

 
?>
<a href="<?php echo home_url(); ?>">
<?php echo $CORE->LAYOUT("get_logo","light");  ?><?php echo $CORE->LAYOUT("get_logo","dark");  ?>
</a>