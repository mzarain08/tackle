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
		
		$post->showupgrades = 1;
	}
	
	if($post->thistheme == "jb"){
 	$post->image = $logoimg = do_shortcode("[COMPANYLOGO pid='".$post->ID."']");
	}
 
?>

<div ppt-box class="hide-mobile rounded mb-4 p-3" data-pid='%postid%'>



<?php  if(THEME_KEY  ==  "cb" && get_post_meta($post->ID,'cashback_p', true) > 0){

$cp = get_post_meta($post->ID,'cashback_p', true);

$cbc = "";
if($cp > 5){
$cbc = "button-color-blue";
}

if($cp > 25){
$cbc = "button-color-green";
}

 ?>
<div class="buttons-wrap"> 
<div class="button-vip disc <?php echo $cbc; ?>"><span><?php echo $cp; ?>%</span></div>
</div>
<?php } ?>


  <div class="d-sm-flex">
    <div style="min-width:150px;" class="mobile-mb-2">
      <a href="%link%">
      <div class="p-2 <?php if($post->thistheme == "jb"){ ?>bg-white<?php }else{ ?>bg-light<?php } ?>" ppt-border1>
        <div class="bg-light position-relative overflow-hidden <?php if($post->thistheme == "jb"){ ?>bg-image-centered<?php } ?>" style="height:120px;">
          <div class="bg-image bg-white" data-ppt-image-bg>
            &nbsp;
          </div>
        </div>
      </div>
      </a>
    </div>
    <div class="position-relative w-100 pl-lg-4">
      <div class="d-sm-flex flex-sm-column">
        <div class="fs-4 text-600 mb-2">
          <a href="%link%" class="text-dark _adtitle">%title%</a>
        </div>
        <div style="min-height:60px;">
          <?php echo do_shortcode("[EXCERPT limit=150]"); ?>...
        </div>
        
        
         
        <nav ppt-nav class="seperator pl-0 text-muted"> <?php  if(in_array(THEME_KEY,array("mj","rt","ct"))){ ?><span class="<?php echo $CORE->GEO("price_formatting",array()); ?>">%price%</span> <?php } ?>  %list_top% </nav>
      </div>
    </div>
  </div>
</div>

<?php if(THEME_KEY == "cb"){ ?>

<div class="show-mobile">
  <div class="position-relative mb-3">
    <a href="%link%">
    <div style="height:150px; width:150px; min-width:65px;" class="position-relative"  ppt-border1 >
      <?php _ppt_template( 'cards/themes/search_badges' ); ?>
      <?php _ppt_template( 'cards/themes/search_buttons' ); ?>
      <div class="h-100 position-relative">
        <div class="bg-image z-0" data-bg="%image%">
          &nbsp;
        </div>
      </div>
    </div>
    </a>
    <div class="lh-20 fs-5 text-600 text-center" style="margin-top:10px;">
      <span class="<?php echo $CORE->GEO("price_formatting",array()); ?>">%price%</span>
      <?php if(is_numeric($oldPrice) && $oldPrice > 0){ ?>
      <span class="fs-sm opacity-5 strike <?php echo $CORE->GEO("price_formatting",array()); ?>"><?php echo $oldPrice; ?></span>
      <?php } ?>
    </div>
  </div>
</div> 

<?php

}else{  

 _ppt_template( 'cards/themes/search_mobile' );


}
 

if(isset($post->showupgrades) && $post->showupgrades == 1){  _ppt_template( 'cards/themes/search_list_upgrade' );  }   ?>
