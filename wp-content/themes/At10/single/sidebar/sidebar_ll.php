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

global $CORE, $userdata, $post;

$canShowDownload = 0;
$count_pending = 0;
if($userdata->ID){ 

	$count_pending = $CORE->USER("count_offers_pending_by_postid", array($post->ID, $userdata->ID) );
	 
	$count_pending_id = $CORE->USER("get_offers_pending_by_postid", array($post->ID, $userdata->ID) );
	$canShowDownload = 0;
	
	if($count_pending_id  != 0 && get_post_meta($count_pending_id, "offer_complete",true) == 5){
	$canShowDownload = 1;
	$ddlink = get_post_meta($post->ID, "download_path", true);
	}

}
 
?>
<div class="data-fields-single _style1 lg <?php echo $CORE->GEO("price_formatting",array()); ?>">
        <?php echo do_shortcode('[PRICE]'); ?>
     </div>
<?php
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if($canShowDownload){ ?>
    <a href="<?php echo $ddlink; ?>" target="_blank" rel="nofollow" data-ppt-btn class="btn-block btn-success mb-3"> <?php echo __("Download Course","premiumpress"); ?> </a>

 <?php } ?>