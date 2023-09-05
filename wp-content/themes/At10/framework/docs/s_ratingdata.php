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


<p>A user rating is based on feedback left by other users. Feedback is stored in the comments system.</p>

<hr />

$data = $CORE->USER("feedback_score", $userdata->ID); 

<hr />
do_shortcode('[RATING_USER uid='.$authorID.']');

<?php echo do_shortcode('[RATING_USER uid='.$userdata->ID.']'); ?>
<hr />
	 
<textarea style="height:400px; width:100%;">


<?php 

$data = $CORE->USER("feedback_score", $userdata->ID); 
	
print_r($data);


?>
</textarea>
 