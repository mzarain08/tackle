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

global $post, $CORE_UI, $userdata, $CORE;

   // ADMIN PREVIEW
    if(!isset($post->ID)){
		$post = new stdClass();
		$post->ID 			= 1;
		$post->post_title 	= "This is a sample title."; 
		$post->post_author 	= 1; 
		$post->post_excerpt = "";
		$post->post_content = "";
		$post->comment_count = 0;
		$post->thistheme = THEME_KEY;
	}
 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>

<div ppt-box class="hide-mobile rounded shadow-hover-lg mb-4 _sfavs <?php if(isset($post->isFavs) && $post->isFavs){ ?>isFavs<?php } ?>" data-pid='%postid%'>
  <?php _ppt_template( 'cards/themes/search_image' ); ?>
  <?php _ppt_template( 'cards/themes/search_distance' ); ?>
  <div class="_content border-top">
    <div class="fs-6 text-600 py-3 lh-30">
      <a href="%link%" class="text-black _adtitle">%title%</a>
    </div>
    <div class="pb-2 overflow-hidden" ppt-flex-between>
      <div class="text-600">
        <?php if(in_array($post->thistheme, array("at"))){ ?>
        <div style="min-width:140px;">
          <span ppt-icon-24 data-ppt-icon-size="24" class="text-warning"><?php echo $CORE_UI->icons_svg['clock']; ?></span> <?php echo do_shortcode("[TIMELEFT]"); ?>
        </div>
        <?php }else{ ?>
        <?php echo do_shortcode('[RATING bg="" short="1" hide_empty="1"]'); ?>
        <?php } ?>
      </div>
      <div class="badge badge-primary link-light text-truncate" style="max-width: 150px;">
        %category%
      </div>
    </div>
  </div>
  <div class="_footer small" ppt-flex-between>
    <div class="d-flex">
      <?php _ppt_template( 'cards/themes/search_icons' ); ?>
    </div>
    <div class="text-truncate">
      <?php if(in_array($post->thistheme, array("mj"))){ ?>
      <span class="opacity-5 fa-xs text-uppercase  mr-1"><?php echo __("from","premiumpress"); ?></span>
      <?php }elseif(in_array($post->thistheme, array("at"))){ ?>
      <span class="opacity-5 fa-xs text-uppercase  mr-1"><?php echo __("bid price","premiumpress"); ?></span>
      <?php } ?>
      <span class="fs-5 text-600  <?php echo $CORE->GEO("price_formatting",array()); ?>">%price%</span> </span>
    </div>
  </div>
  <div class="_footer py-2 border-top ppt-gradiant">
    <nav ppt-nav class="pl-0 list-f100 text-600 baseline fs-sm mt-1"> %bottom% </nav>
  </div>
</div>
<?php _ppt_template( 'cards/themes/search_mobile' ); ?>
