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

<div ppt-box class="hide-mobile rounded shadow-hover-lg mb-4 _sfavs <?php if(isset($post->isFavs) && $post->isFavs){ ?>isFavs<?php } ?>" data-pid='%postid%' <?php if(isset($post->carddata)){ echo $post->carddata; } ?>>
  <?php _ppt_template( 'cards/themes/search_image' ); ?>
  <?php _ppt_template( 'cards/themes/search_distance' ); ?>
  <div class="_content border-top ">
    <?php if(in_array($post->thistheme, array("rt", "mj","dl","ct"))){ ?>
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
            <?php if(in_array($post->thistheme, array("at","pj"))){ ?>
            <span ppt-icon-24 data-ppt-icon-size="24" class="text-warning"><?php echo $CORE_UI->icons_svg['clock']; ?></span> <?php echo do_shortcode("[TIMELEFT]"); ?>
            <?php }elseif(in_array($post->thistheme, array("dl"))){ ?>
            <span ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['cartype']; ?></span> <?php echo do_shortcode("[MAKE]"); ?>
            <?php }elseif(in_array($post->thistheme, array("cm"))){ ?>
            <div class="badge_tooltip text-center" data-direction="top">
              <div class="badge_tooltip__initiator">
                <div ppt-icon-24 data-ppt-icon-size="24">
                  <?php echo $CORE_UI->icons_svg['cursor-click']; ?> <?php echo do_shortcode("[HITS]"); ?>
                </div>
              </div>
              <div class="badge_tooltip__item">
                <?php echo __("Views","premiumpress"); ?>
              </div>
            </div>
           <?php }elseif(in_array($post->thistheme, array("ct"))){  ?>
          <div class="badge_tooltip text-center" data-direction="top">
              <div class="badge_tooltip__initiator">
                <div ppt-icon-24 data-ppt-icon-size="24">
                  <?php echo $CORE_UI->icons_svg['clock']; ?> <?php echo do_shortcode("[TIMESINCE]"); ?>
                </div>
              </div>
              <div class="badge_tooltip__item">
                <?php echo str_replace("%s",do_shortcode("[TIMESINCE]"),__("This Ad was created %s","premiumpress")); ?>
              </div>
            </div>
            <?php }elseif(in_array($post->thistheme, array("mj"))){ 
			
			$sold = do_shortcode("[SALES]");
			
			?>
            <div class="d-flex align-items-baseline">
              <div>
                <?php echo do_shortcode('[RATING bg="" short="1" hide_empty="1"]'); ?>
              </div>
              <?php if($sold> 0){ ?>
              <div>
                <div class="badge_tooltip text-center" data-direction="top">
                  <div class="badge_tooltip__initiator">
                    <span ppt-icon-20 data-ppt-icon-size="20" class="text-success ml-2"><?php echo $CORE_UI->icons_svg['cart']; ?></span>
                  </div>
                  <div class="badge_tooltip__item">
                    <?php echo $sold; ?> <?php echo __("Sold","premiumpress"); ?>
                  </div>
                </div>
              </div>
              <?php } ?>
            </div>
            <?php }else{ ?>
            <?php echo do_shortcode('[RATING bg="" short="1" hide_empty="1"]'); ?>
            <?php } ?>
          </div>
        </div>
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
       
      <span class="opacity-5 fa-xs text-uppercase  mr-1"><?php echo __("price","premiumpress"); ?></span>
      
      <span class="fs-5 text-600  <?php echo $CORE->GEO("price_formatting",array()); ?>"><?php echo do_shortcode('[PRICE]'); ?></span> </span>
    </div>
  </div>
</div>
<?php _ppt_template( 'cards/themes/search_mobile' ); ?>
