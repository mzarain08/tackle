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
		$post->carddata = "";
	}

 

 
?>

<div ppt-box class="hide-mobile rounded shadow-hover-lg mb-4 _sfavs <?php if(isset($post->isFavs) && $post->isFavs){ ?>isFavs<?php } ?>" data-pid='%postid%' <?php if(isset($post->carddata)){ echo $post->carddata; } ?>>
  <?php _ppt_template( 'cards/themes/search_image' ); ?>
  <?php _ppt_template( 'cards/themes/search_distance' ); ?>
  <div class="_content border-top ">
    <?php if(in_array($post->thistheme, array("rt", "mj","dl"))){ ?>
    <div class="position-absolute mt-n3" style="right:10px;">
      <?php echo $CORE_UI->AVATAR("user", array("size" => "sm", "uid" => $post->post_author, "css" => "rounded-circle border bg-white", "online" => 0))  ?>
    </div>
    <?php } ?>
    <div class="fs-6 text-600 py-2 pt-3" style="line-height:20px;">
      <a href="%link%" class="text-black _adtitle">%title%</a>
    </div>
    <div class="pb-2  mt-2" ppt-flex-between>
      <div class="text-600">
        <div class="d-flex">
          <div>
      
            <div class="d-flex">
              <div class="badge_tooltip text-center" data-direction="top">
                <div class="badge_tooltip__initiator">
                  <span ppt-icon-20 data-ppt-icon-size="20" class="mr-2 js-text-primary"><?php echo $CORE_UI->icons_svg['bed']; ?></span> <?php echo do_shortcode("[BEDS numonly=1]"); ?>
                </div>
                <div class="badge_tooltip__item">
                  <?php echo do_shortcode("[BEDS]"); ?>
                </div>
              </div>
              <div class="badge_tooltip text-center" data-direction="top">
                <div class="badge_tooltip__initiator">
                  <span ppt-icon-16 data-ppt-icon-size="16" class="mx-2 js-text-primary"><?php echo $CORE_UI->icons_svg['bath']; ?></span> <?php echo do_shortcode("[BATHS numonly=1]"); ?>
                </div>
                <div class="badge_tooltip__item">
                  <?php echo do_shortcode("[BATHS]"); ?>
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
      <div class="badge badge-primary link-light text-truncate" style="max-width: 150px;">
        %category%
      </div>
    </div>
  </div>
  <div class="_footer small" ppt-flex-between>
    <div class="d-flex mt-1">
      <?php _ppt_template( 'cards/themes/search_icons' ); ?>
    </div>
    <div class="text-truncate">
      
 
      <span class="fs-5 text-600  <?php echo $CORE->GEO("price_formatting",array()); ?>">%price%</span> </span>
    </div>
  </div>
</div>

<div class="show-mobile">
  <div class="position-relative mb-3">
    <a href="%link%">
    <div style="height:150px; width:150px; min-width:65px;" class="position-relative"  ppt-border1 >
      <?php _ppt_template( 'cards/themes/search_badges' ); ?>
      <div class="h-100 position-relative">
        <div class="bg-image z-0" data-bg="%image%">
          &nbsp;
        </div>
      </div>
    </div>
    </a>
    <div class="lh-20 text-600" ppt-flex-between style="margin-top:10px;">
      <div class="<?php echo $CORE->GEO("price_formatting",array()); ?>">%price%</div>
    <div class="fs-sm text-dark link-dark text-truncate" style="max-width:150px;">%category%</div>
    </div>
  </div>
</div> 