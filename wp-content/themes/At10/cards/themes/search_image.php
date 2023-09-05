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

global $post, $CORE_UI, $userdata, $CORE; //data-ppt-image-bg
 
?>
<?php _ppt_template( 'cards/themes/search_buttons' ); ?>
<figure>
  <?php if(!isset($post->isFavs)){ ?>
  
  <a href="%link%">
  <?php } ?>
  <div class="position-relative overflow-hidden <?php if(THEME_KEY == "vt"){ ?>isVideo<?php } ?>" style="border-radius: 4px; <?php if(THEME_KEY == "vt"){ ?>height:200px;<?php }else{ ?>height:180px;<?php } ?>">
    <?php if(THEME_KEY == "vt"){ ?>
    <i class="fa fa-play-circle opacity-5 vidicon">&nbsp;</i>
    <?php } ?>
    <div class="bg-image " data-bg="%image%">
      &nbsp;
    </div>
    <?php if(isset($post->isFavs)){ ?>
    <div class="icon_wrap hide-mobile">
      <div class="save"  onclick="<?php if(!$userdata->ID){ ?>processLogin(1);<?php }else{ ?>processFavsSwitch('%postid%');<?php } ?>">
        <span ppt-icon-24 data-ppt-icon-size="24" class="text-primary _ok"><?php echo $CORE_UI->icons_svg['heart']; ?></span> <span ppt-icon-24 data-ppt-icon-size="24" class="text-dark _cancel"><?php echo $CORE_UI->icons_svg['close']; ?></span>
      </div>
      <div class="view">
        <a href="%link%"><span ppt-icon-24 data-ppt-icon-size="24" class="text-primary"><?php echo $CORE_UI->icons_svg['search']; ?></span></a>
      </div>
    </div>
    <?php } ?>
    <?php _ppt_template( 'cards/themes/search_badges' ); ?>
  </div>
  <?php if(!isset($post->isFavs)){ ?>
  </a>
  <?php } ?>
</figure>