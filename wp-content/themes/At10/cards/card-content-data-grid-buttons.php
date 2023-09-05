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

global $CORE, $CORE_UI, $post, $userdata, $new_settings; 

$ThisTheme = THEME_KEY; 
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
if(in_array($ThisTheme, array("cp"))){ ?>

<?php }else{ ?>
<ul class="btn-list hide-mobile hide-ipad d-flex">
<?php 

if(in_array($ThisTheme, array("dt")) && in_array(_ppt(array('design', "display_openinghours")), array("","1")) && do_shortcode('[OPEN check=1]') == 1){ ?>
      <li data-toggle="tooltip" data-placement="top" title="<?php echo __("Open Today","premiumpress"); ?>">
        <div>
          <i class="fa fa-circle text-success"></i>
        </div>
      </li>
<?php 
} 
 


if(in_array(_ppt(array('user','favs')), array("","1")) ){ ?>
      <li class="list-inline-item btn_favs" data-toggle="tooltip" data-placement="top" title="<?php echo __("Add Favorites","premiumpress"); ?>">
        <div class="bg-primary shadow text-white">
        
        <div ppt-icon-16 data-ppt-icon-size="16"><?php echo $CORE_UI->icons_svg['heart']; ?></div>
        
          
        </div>
      </li>
<?php 
}
 
if(!in_array($ThisTheme, array("sp","cm","vt", "cp")) && in_array(_ppt(array('user','account_messages')), array("","1")) ){
?>
      <li data-toggle="tooltip" data-placement="top" title="<?php echo __("Send Message","premiumpress"); ?>">
        <div>
          <a <?php echo $CORE->USER("get_message_link", $post->post_author); ?>>
          
          <div ppt-icon-16 data-ppt-icon-size="16"><?php echo $CORE_UI->icons_svg['envelope']; ?></div>
          
          </a>
        </div>
      </li>
<?php
}

if(!in_array($ThisTheme, array("sp","cm","vt","cp","pj")) && isset($post->maplat) &&  strlen($post->maplat) > 1 ){ ?>
      <li data-toggle="tooltip" data-placement="top" title="<?php echo __("Load Map","premiumpress"); ?>">
        <div>
          <a href="javascript:void(0);" 
    class="single-map-item opacity-5" 
    data-title="<?php echo strip_tags($post->title); ?>" 
    data-url="<?php echo $post->link; ?>" 
    data-newlatitude="<?php echo $post->maplat; ?>" 
    data-address="<?php echo $post->maplocation; ?>" 
    data-newlongitude="<?php echo $post->maplong; ?>">
    
    <div ppt-icon-16 data-ppt-icon-size="16"><?php echo $CORE_UI->icons_svg['map-marker']; ?></div>
    
    </a>
        </div>
      </li>
<?php
} 


if(in_array($ThisTheme, array("da","pj","mj")) && $CORE->USER("get_online_status", $post->post_author)){ ?>
      <li data-toggle="tooltip" data-placement="top" title="<?php echo __("Online Now","premiumpress"); ?>">
        <div>
          <i class="fa fa-circle text-online"></i>
        </div>
      </li>
      <?php 

}	
 
?>
 <?php if(in_array($ThisTheme, array("vt","mj","at","ct","dl","ll","rt")) && _ppt(array('lst','adminonly')) != 1 && _ppt(array('user','allow_profile')) == "1"){  ?>         
<li data-toggle="tooltip" data-placement="top" title="<?php echo $CORE->USER("get_username", $post->post_author); ?>">
<div class="author-img" >
	<a href="<?php echo $CORE->USER("get_user_profile_link", $post->post_author); ?>">
	<?php echo $CORE->USER("get_photo", $post->post_author); ?>
    </a>
</div>
</li>
<?php } ?> 

</ul>

<?php } ?>

    