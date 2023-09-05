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

global $CORE, $new_settings, $userdata, $CORE_UI; 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////	
 

$count_subscribers = $CORE->USER("get_subscribers_followers_count", $post->post_author);	

$views = do_shortcode("[HITS]"); 

$likes_data 		= $CORE->USER("get_new_likes_data", $post->ID);	 
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
			
?>
 
<div ppt-box class="rounded">
  <div class="_content p-3">
    <div class="row">
      <div class="col-xl-6">
        <div class="d-flex align-items-center">
          <div class="mx-2 mx-lg-4">
            <?php echo $CORE_UI->AVATAR("user", array("size" => "xl", "uid" => $post->post_author, "css" => "rounded-circle border bg-white", "online" => 0))  ?>
          </div>
          <div class="ml-lg-3">
            <div class="fs-sm text-uppercase">
              <a href="<?php echo $CORE->USER("get_user_profile_link", $post->post_author ); ?>" class="link-dark text-dark text-600"> <?php echo $CORE->USER("get_username", $post->post_author ); ?> </a> 
              
              &bull; <?php echo $CORE->USER("count_listings", $post->post_author); ?> <?php echo __("Videos","premiumpress"); ?>
              
              <?php if( !user_can($post->post_author, 'administrator')){ ?>
              &bull;  <span class="d-inline-flex"><?php echo do_shortcode('[BUTTON_USER type="favs" pid="'.$post->ID.'"  button="0" icon=0 text=1 class="cursor"  uid="'.$userdata->ID.'"]'); ?></span>
              <?php  } ?>
              
            </div>
            <div>
            
            <?php if( user_can($post->post_author, 'administrator')){ ?>
            
            <div class="d-inline-flex overflow-hidden mt-3 mr-3 cursor text-600 text-center" ppt-border1>
                <div class="p-1 px-3 text-light bg-primary">
                <?php echo __("Favorites","premiumpress"); ?>
                </div>
                <div class="p-1" style="min-width:50px;">
                    <?php echo do_shortcode('[BUTTON_USER type="favs"   button="0"   class="" icon="1"  uid="'.$post->post_author.'"]'); ?>
                </div>
              </div>
              
            <?php }else{ ?>
            
              <div class="d-inline-flex overflow-hidden mt-3 mr-3 cursor text-600 text-center" ppt-border1>
                <div class="p-1 px-3 text-light bg-primary">
                  <?php echo do_shortcode('[BUTTON_USER type="subscribe" button="0"  class="" text=1 uid="'.$post->post_author.'"]'); ?>
                </div>
                <div class="p-1" style="min-width:50px;">
                  <?php echo $count_subscribers; ?>
                </div>
              </div>
              
              <?php } ?>
              
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 offset-md-2">
        <div class="sv-views">
          <div class="fs-5 text-right text-600">
            <?php echo $views; ?> <?php echo __("Views","premiumpress"); ?>
          </div>
          <div  style="	margin-top: 10px;	margin-bottom: 10px;	height: 3px;	width: 100%;	background-color: <?php if($likes_data['total'] > 0){ echo '#ca0000'; }else{ echo '#ccc'; } ?>;">
            <div  style="height: 3px;	background-color: #28b47e; width:<?php echo $likes_data['up_percentage']; ?>%;">
            </div>
          </div>
          <div class="d-flex justify-content-between likesbar20">
            <span class="text-success d-flex"> <?php echo do_shortcode('[BUTTON_USER type="like" pid="'.$post->ID.'"  button="0" class="cursor" icon=1 uid="'.$userdata->ID.'"]'); ?> <span class="ml-3"><?php echo $likes_data['up']; ?> <?php echo __("Likes","premiumpress"); ?></span> </span> <span class="text-danger d-flex"> <?php echo do_shortcode('[BUTTON_USER type="dislike" pid="'.$post->ID.'"  button="0" class="cursor" icon=1 uid="'.$userdata->ID.'"]'); ?> <span class="ml-3"><?php echo $likes_data['down']; ?> <?php echo __("Dislikes","premiumpress"); ?></span> </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
