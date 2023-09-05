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
  <figure class="position-relative overflow-hidden bg-dark search7" style="height:180px;">
    <div class=" z-10">
      <?php _ppt_template( 'cards/themes/search_badges' ); ?>
    </div>
    <div class="bg-image opacity-5" data-ppt-image-bg>
      &nbsp;
    </div>
    <div class="p-sm-3 overflow-hidden position-relative z-1">
      <div class="row position-relative" style="z-index: 2;">
        <div class="col-sm-5 mb-sm-2 mt-sm-3 mx-auto">
          <a href="<?php echo $CORE->USER("get_user_profile_link", $post->post_author); ?>"><?php echo $CORE->USER("get_photo", $post->post_author); ?></a>
        </div>
        <div class="col-md-12 hide-mobile text-center text-light">
          <div class="font-weight-bold  text-bold">
            <?php echo $CORE->USER("get_username",$post->post_author); ?>
          </div>
          <?php if(!empty($mem) && isset($mem['name'])){ ?>
          <div class="tiny mt-0 mb-0 text-600">
            <?php echo $mem['name']; ?>
          </div>
          <?php }else{ ?>
          <div class="tiny mt-0 mb-0">
            <?php if(defined('WLT_DEMOMODE')){ ?>
            <span class="text-600"><?php echo __("Gold Member","premiumpress"); ?></span>
            <?php }else{ ?>
            &nbsp;
            <?php } ?>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </figure>
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
          <div class="opacity-5">
            <?php echo do_shortcode("[TIMELEFT]"); ?>
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
      <?php if(in_array($post->thistheme, array("mj"))){ ?>
      <span class="opacity-5 fa-xs text-uppercase  mr-1"><?php echo __("from","premiumpress"); ?></span>
      <?php }elseif(in_array($post->thistheme, array("at"))){ ?>
      <span class="opacity-5 fa-xs text-uppercase  mr-1"><?php echo __("bid price","premiumpress"); ?></span>
      <?php } ?>
      <span class="fs-5 text-600  <?php echo $CORE->GEO("price_formatting",array()); ?>">%price%</span> </span>
    </div>
  </div>
</div>
<div class="show-mobile">
  <div class="d-flex position-relative mb-3 border-bottom pb-3">
    <a href="%link%">
    <div style="height:65px; width:65px; min-width:65px;">
      <?php echo $CORE_UI->AVATAR("user", array("size" => "md", "uid" => $post->post_author, "css" => "rounded-circle border", "online" => 0))  ?>
    </div>
    </a>
    <div class="w-100 pl-3">
      <div class="d-flex justify-content-between">
        <div class="w-100">
          <div class="fs-6 lh-20 text-700" style="min-height:40px;">
            <a href="%link%" class="text-dark">%title%</a>
          </div>
          <nav ppt-nav class="pl-0 list-f100 text-600 d-flex align-items-baseline"> %bottom% </nav>
        </div>
      </div>
    </div>
  </div>
</div>
