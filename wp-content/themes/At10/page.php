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
   
$GLOBALS['flag-page-sidebar'] = 1;
 
get_header();
 
_ppt_template( 'page-before' ); 

if (have_posts()) : while (have_posts()) : the_post();  ?>

<?php echo the_content(); ?>

<?php endwhile; endif;

_ppt_template( 'page-after' );

get_footer(); ?>
