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

$show_views = 1;
if(_ppt(array('searchcardvals','views')) == "0"){
$show_views = 0;
}

$comment = $CORE->PACKAGE("get_new_comments", $post->ID);
 
 
?>

<div ppt-box class="hide-mobile rounded shadow-hover-lg mb-4 _sfavs <?php if(isset($post->isFavs) && $post->isFavs){ ?>isFavs<?php } ?>" data-pid='%postid%'<?php if(isset($post->carddata)){ echo $post->carddata; } ?>>
  <?php _ppt_template( 'cards/themes/search_image' ); ?>
  <?php _ppt_template( 'cards/themes/search_distance' ); ?>
  <div class="_content border-top">
  	
    <?php if(is_array($comment)){ ?>
    <div class="position-absolute mt-n3" style="right:10px;">
    
<div class="badge_tooltip text-center" data-direction="top">
  <div class="badge_tooltip__initiator">
    <div ppt-icon-24 data-ppt-icon-size="24" style="cursor:pointer" class="ml-2 text-success">
       <?php echo $CORE_UI->AVATAR("user", array("size" => "sm", "uid" => $comment['uid'], "css" => "rounded-circle border bg-white", "online" => 0))  ?>
    </div>
  </div>
  <div class="badge_tooltip__item">
 "<?php echo $comment['text']; ?>"
  </div>
</div> 
    </div>
    <?php } ?>
  
    <div class="fs-sm  pt-3 link-dark opacity-2">
      %category% <?php if($show_views){ ?>&bull; %hits% <?php echo __("views","premiumpress"); ?><?php } ?>
    </div>
    <div class="fs-5 text-600 py-2 lh-30">
      <a href="%link%" class="text-black _adtitle">%title%</a>
    </div>
    <div class="d-flex justify-content-between my-2">
      <div>
        <div class="d-flex">
          <?php _ppt_template( 'cards/themes/search_icons' ); ?>
        </div>
      </div>
      <div>
        <?php echo do_shortcode('[RATING bg="" short="1" hide_empty="1" reviews_show="0"]'); ?>
      </div>
    </div>
  </div>
</div>
</div>
<div class="show-mobile">
  <div class="position-relative mb-3">
    <a href="%link%">
    <div style="height:130px; min-width:150px;" class="position-relative"  ppt-border1 >
      <?php _ppt_template( 'cards/themes/search_badges' ); ?>
      <div class="h-100 position-relative">
        <div class="bg-image z-0" data-bg="%image%">
          &nbsp;
        </div>
      </div>
    </div>
    </a>
    <div class="fs-14 text-600" style="margin-top:5px;">
      %title%
    </div>
  </div>
</div>