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

 
?>

<div class="ppt-tabs-listing">
<ul class="bg-primary">
<li class="is-active" data-id="tab1"><span><?php echo __("Details","premiumpress"); ?></span></li>
<li data-id="tab2"><span><?php echo __("Share","premiumpress"); ?></span></li>
</ul>
<div id="tab1" class="_contents">  
 
 
      <div class="text-right mt-n3">
        <i class="fal fa-3x fa-camera text-primary float-left ml-3 hide-ipad hide-mobile  mt-2"></i>
        
        <div class="h6 text-dark p-3 hide-ipad hide-mobile mb-4">
          <div class="tiny">
            <?php echo __("Author","premiumpress") ?>
          </div> 
          
          
          <span style="width:25px; display:inline-block;">
          
          <a href="<?php if(_ppt(array('user','allow_profile')) == 1){  echo get_author_posts_url( $post->post_author );  }else{ echo "#"; }?>" class="userphoto position-relative text-dark"> <?php echo str_replace("userphoto","rounded-circle",get_avatar( $post->post_author, 80 )); ?></a> </span> <span class="ml-2 ">
          <?php if(_ppt(array('user','allow_profile')) == 1){ ?>
          <a href="<?php echo get_author_posts_url( $post->post_author ); ?>" class="text-dark">
          <?php } ?>
          <?php echo $CORE->USER("get_username", $post->post_author); ?>
          <?php if(_ppt(array('user','allow_profile')) == 1){ ?>
          </a>
          <?php } ?>
          </span>
        </div>
      </div>
   
      <?php _ppt_template( 'single/sidebar/sidebar_ph_download' );  ?>
      
      
        <?php if(in_array(_ppt(array('design', 'display_comments')), array("","1"))){ ?>
      <a href="javascript:void(0)"  <?php if(!$userdata->ID){ ?> onclick="processLogin();" <?php }else{ ?>onclick="processCommentPop();"<?php } ?>  class="btn btn-block btn-secondary opacity-5 mt-4"><?php echo __("Say Thank You!","premiumpress") ?></a>
      <?php } ?>
      <?php 
	

	
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 	
?>
    </div>
    <div id="tab2" class="_contents" style="display: none;">
      <div class="mt-4">
        <?php _ppt_template( 'single/sidebar/sidebar_offers_count' );  ?>
      </div>
    </div>
  </div>
  
<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 theme_sidebar_buttons("membershipaccess", "" );
 
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 theme_sidebar_buttons("awards", "" );
 
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>