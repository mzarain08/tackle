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
	
	$logoimg = do_shortcode("[COMPANYLOGO pid='".$post->ID."']");
 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
?>

<div ppt-box class="hide-mobile rounded shadow-hover-lg mb-4 _sfavs <?php if(isset($post->isFavs) && $post->isFavs){ ?>isFavs<?php } ?>" data-pid='%postid%' <?php if(isset($post->carddata)){ echo $post->carddata; } ?>>

<?php _ppt_template( 'cards/themes/search_buttons' ); ?>
  <figure class="position-relative overflow-hidden bg-dark search7" style="height:180px;">
    <div class=" z-10">
      <?php _ppt_template( 'cards/themes/search_badges' ); ?>
    </div>
    <div class="bg-image opacity-5" data-ppt-image-bg>
      &nbsp;
    </div>
    
    <div class="p-sm-3 overflow-hidden position-relative z-1 y-middle" style="height:180px;">
      <a href="%link%">
      <div style="height:100px; width:100px; min-width:100px; " class="store-icon-small mx-auto">
        <div ppt-border1 class="h-100 position-relative overflow-hidden" style="border-radius: 100%;">
          <div class="bg-image p-2" data-bg="<?php echo $logoimg; ?>" style="background-repeat: no-repeat;padding: 15px!important;background-size: contain;">
            &nbsp;
          </div>
        </div>
      </div>
      </a>
    </div>
   
  </figure>

  <?php _ppt_template( 'cards/themes/search_distance' ); ?>
  <div class="_content border-top ">
 
    <div class="fs-sm  pt-3 link-dark opacity-2 lh-20 mt-n2">
      %category%
    </div>
    <div class="fs-5 text-600 lh-30">
      <a href="%link%" class="text-black _adtitle">%title%</a>
    </div>
    <div class="pb-2  mt-2" ppt-flex-between>
      <div class="text-600">
        
       
       <?php echo do_shortcode("[CITY]"); ?>
       </div>
      
      <div class="badge badge-primary link-light text-truncate" style="max-width: 150px;">
       <?php echo do_shortcode("[JOBTYPE link=1]"); ?>
      </div>
      
    </div>
  </div>
  <div class="_footer small" ppt-flex-between>
    <div class="d-flex">
      <?php _ppt_template( 'cards/themes/search_icons' ); ?>
    </div>
    <div class="text-truncate">
       
      <span class="opacity-5 fa-xs text-uppercase  mr-1"> </span>
     
      <span class="fs-5 text-600  <?php echo $CORE->GEO("price_formatting",array()); ?>">%price%</span> <?php echo do_shortcode("[SALARYTYPE]"); ?></span>
    </div>
  </div>
</div>
<?php _ppt_template( 'cards/themes/search_mobile' ); ?>
