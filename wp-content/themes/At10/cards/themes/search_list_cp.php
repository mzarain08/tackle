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
	
	$title = $post->post_title;
	$store_image = "";
	$link = "#";
	$store_id = "";
	$name = "";
	$used = do_shortcode('[USED]');
	if(!is_numeric($used)){ $used = 0; }
	
	$found 	= wp_get_object_terms( $post->ID, 'store' );
	if(is_array($found) && !empty($found)){
		$link = get_term_link($found[0]->term_id, "store");	 
		$name = strip_tags(do_shortcode('[STORENAME]')); 		
		$store_image = do_shortcode('[STOREIMAGE sid='.$found[0]->term_id.']');		
		$store_id = $found[0]->term_id;
	}

$show_qr = 0;
if(in_array(_ppt(array('searchcardvals','qr')),array("","1"))){
$show_qr = 1;
}


$desc = do_shortcode("[EXCERPT limit=140]");
if(defined('WLT_DEMOMODE')){

$desc = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque"; 

}

	if(defined('WLT_DEMOMODE') && $store_image == ""){
		if(isset($_SESSION['design_preview'])){
			$store_image = DEMO_IMGS."?fw=text160&i=".rand(1,8)."&t=".THEME_KEY."&ct=".$_SESSION['design_preview'];
		}
	}

 
?>

<div ppt-box class="hide-mobile rounded mb-4" data-pid='%postid%'>
  <div class="_content p-3 p-lg-4 py-4">
    <div class="d-lg-flex justify-content-between">
      <div class="position-relative w-100 _left">
        <div class="d-sm-flex flex-sm-column">
          <div class="d-flex align-items-center">
          
           
            <a href="javascript:void(0);" class="btn-gocoupon mr-3" data-nextlink="<?php echo $link; ?>" data-store="1" data-couponid="<?php echo $store_id; ?>">
            <div style="height:40px; width:80px; min-width:80px;" class="store-icon-small">
              <div ppt-border1 class="h-100 position-relative">
                <div class="bg-image" data-bg="<?php echo $store_image; ?>">
                  &nbsp;
                </div>
              </div>
            </div>
            </a>
            
            
            <div class="fs-md text-600 cursor " onclick="jQuery('.coupon-btn-<?php echo $post->ID; ?>').trigger('click');">
              <?php echo $title; ?>
            </div>
            
          </div>
          <div>
            <div class="fs-14 mt-3 pr-lg-4 opacity-5">
              <?php echo $desc; ?> <?php if(strlen($desc) > 10){ ?><a href="javascript:void(0);" onclick="processTerms('<?php echo $post->ID; ?>');">...</a><?php } ?>
            </div>
          </div>
        </div>
      </div>
      <div class="_right w-100 y-middle" style="min-width:250px;max-width:250px;">
        <div class="w-100 text-center">
          <div class=" fs-14 mb-3 <?php if($used > 0){ ?>d-inline-flex<?php } ?>">
            <div class="d-inline-flex verified text-success text-600">
              <div ppt-icon-16 data-ppt-icon-size="16">
                <?php echo $CORE_UI->icons_svg['check_circle']; ?>
              </div>
              <div class="ml-2">
                <?php echo __("Verified","premiumpress"); ?>
              </div>
            </div>
            <?php if($used > 0){ ?>
            <div>
              <div class="dot-sm mx-2">
                &nbsp;
              </div>
            </div>
            <div class="d-flex">
              <div ppt-icon-16 data-ppt-icon-size="16">
                <?php echo $CORE_UI->icons_svg['user']; ?>
              </div>
              <div class="ml-2">
                <span class="text-600"><?php echo $used; ?></span> <?php echo __("uses today","premiumpress"); ?>
              </div>
            </div>
            <?php } ?>
          </div>
          <?php echo do_shortcode('[CBUTTON]'); ?>
        </div>
      </div>
    </div>
  </div>
  <div class="_footer small  pl-3 pl-lg-4 fs-sm bg-light">
  
 
<div class="d-flex w-100">

<div>
<?php if($show_qr){ ?>
<div class="badge_tooltip text-center" data-direction="top">
  <div class="badge_tooltip__initiator">
    <div ppt-icon-24 data-ppt-icon-size="24" style="cursor:pointer" class="qr-hover mr-3" data-qr-img="qrcode-image-%postid%" data-qr-link="<?php echo $link; ?>">
      <?php echo $CORE_UI->icons_svg['qr']; ?>
    </div>
  </div>
  <div class="badge_tooltip__item z-10">
    <div class="qrcode-image-%postid%">
    </div>
    <div class="fs-sm">
      <?php echo __("Scan QR code to view on mobile device.","premiumpress"); ?>
    </div>
  </div>
</div>
<?php } ?>
</div>


    <div class="d-md-flex w-100 justify-content-between">
    
      <div>
        <nav ppt-nav class="seperator pl-0 text-muted " ppt-flex-between> %list_top% </nav>
      </div>
      
      <div class="text-muted y-middle">
        <?php echo do_shortcode('[TIMELEFT textonly=1]'); ?>
      </div>
      
    </div>
</div> 
   

    
  </div>
</div>




<div class="show-mobile">
  <div class="d-flex position-relative mb-3 border-bottom pb-3">
    <div class="w-100">
      <div class="fs-5 lh-30 text-700 cursor"  onclick="jQuery('.coupon-btn-<?php echo $post->ID; ?>').trigger('click');">
        <?php echo $title; ?>
      </div>
      <div class="d-flex mt-2 fs-sm align-items-center">
        <?php if(is_array($found) && !empty($found)){ ?>
        <a href="javascript:void(0);" class="btn-gocoupon" data-nextlink="<?php echo $link; ?>" data-store="1" data-couponid="<?php echo $found[0]->term_id; ?>">
        <div style="height:25px; width:50px; min-width:50px;" class="store-icon-small  mr-3">
          <div ppt-border1 class="h-100 position-relative">
            <div class="bg-image" data-bg="<?php echo $store_image; ?>">
              &nbsp;
            </div>
          </div>
        </div>
        </a>
        <?php } ?>
        <div>
          <div class="d-inline-flex verified text-success text-600 mr-2">
            <div ppt-icon-16 data-ppt-icon-size="16">
              <?php echo $CORE_UI->icons_svg['check_circle']; ?>
            </div>
            <div class="ml-1">
              <?php echo __("Verified","premiumpress"); ?>
            </div>
          </div>
        </div>
        <div class="">
          <?php echo do_shortcode('[TIMELEFT textonly=1]'); ?>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
