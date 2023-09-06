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


global $settings, $wpdb, $userdata, $CORE;

?>


<p>A listing rating is based on comments left by other users. </p>

 
do_shortcode('[RATING pid='.$post->ID.']');


<hr />
	 
<textarea style="height:400px; width:100%;">


<?php 

$data = $CORE->USER("feedback_score", $userdata->ID); 
	
print_r($data);


?>
</textarea>

<hr />

small user comment shortcode

<?php echo do_shortcode('[RATING_COMMENT pid='.$post->ID.']'); ?>


 RATING_COMMENT pid='.$post->ID.'