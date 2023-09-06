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

$GLOBALS['flag-set-makeoffer'] = 1;


// GET FILES
$files = $CORE->MEDIA("get_formatted_images_for_header", 0);
$fc = count($files);  

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
	$found 	= wp_get_object_terms( $post->ID, 'store' );
	$store_id = "";
	$store_image = "";
	$link = "";
	if(is_array($found) && !empty($found)){
		$link = get_term_link($found[0]->term_id, "store");	 
		$name = strip_tags(do_shortcode('[STORENAME]')); 
		$store_image = do_shortcode('[STOREIMAGE sid='.$found[0]->term_id.']');
		$store_id = $found[0]->term_id;
	}
	
	
	if(defined('WLT_DEMOMODE') && $store_image == ""){
		if(isset($_SESSION['design_preview'])){
			$store_image = DEMO_IMGS."?fw=text160&i=".rand(1,8)."&t=".THEME_KEY."&ct=".$_SESSION['design_preview'];
		}
	}
 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


?>

<div ppt-border1 class="position-relative  mb-4">
  <div class="buttons-wrap">
    <?php if( get_post_meta($post->ID,'featured', true) == "1" ){ ?>
    <div class="button-featured">
      <?php echo __("Featured","premiumpress"); ?>
    </div>
    <?php } ?>
    <?php if( get_post_meta($post->ID,'cashback_p', true) > 0){ ?>
    <?php
$cp = get_post_meta($post->ID,'cashback_p', true);

$cbc = "";
if($cp > 5){
$cbc = "button-color-blue";
}

if($cp > 25){
$cbc = "button-color-green";
}

 ?>
    <div class="button-vip disc <?php echo $cbc; ?>">
      <span><?php echo $cp; ?>%</span>
    </div>
    <?php } ?>
  </div>
  <div class="text-center">
    <img src="<?php echo $files[0]['src']; ?>" alt="<?php echo $post->post_title; ?>" class="img-fluid">
  </div>
  <div class="badge_tooltip z-10" data-direction="top">
    <div class="badge_tooltip__initiator">
      <div ppt-border1 class="position-relative overflow-hidden mb-4 bg-image-centered" style="height:80px;width:80px; position: absolute!important;    bottom: 0px;    left: 20px;">
        <a href="<?php echo $link; ?>">
        <div class="bg-image p-2" data-bg="<?php echo $store_image; ?>">
          &nbsp;
        </div>
        </a>
      </div>
    </div>
    <div class="badge_tooltip__item text-center"  style="width:250px;">
      <?php echo $name; ?>
    </div>
  </div>
</div>
<div ppt-border1 class="p-3 mb-4 text-600 fs-5 text-center">
  <span><?php echo do_shortcode('[CASHBACK]'); ?> <?php echo __("Cashback","premiumpress"); ?></span>
</div>
<?php
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$allGigs = array();
 
$args = array('posts_per_page' => 3,  'orderby' => 'title', 'order' => 'des',  'post_type' => 'listing_type', 'post__not_in' => array($post->ID), 				
'tax_query' => array( array('taxonomy' => "store", 'field' => 'term_id', 'terms' =>  $store_id, 'operator'=> 'IN' ) ),				
);

$wp_query = new WP_Query($args);                   
if ( $wp_query->have_posts() ) {                                                       
	while ( $wp_query->have_posts() ) {  $wp_query->the_post(); 
	 
		$allGigs[$post->ID] = array( "link" => get_permalink($post->ID), "img" => do_shortcode('[IMAGE pathonly=1 pid="'.$post->ID.'"]'), "name" => get_the_title($post->ID), "cashback" => str_replace("%s",do_shortcode('[CASHBACK]'),__("Upto %s cashback!","premiumpress")) );
	
	}
}
 
foreach($allGigs as $key => $gig){
 
if(strlen($gig['name']) < 3){ continue; }
?>
 
    <a href="<?php echo $gig['link']; ?>"  class="mb-3 text-decoration-none text-dark link-dark btn-block p-3 rounded" ppt-border1 style="min-height: 85px;">
    
    
    <div class="w-100">
    
    <div style="width:60px; margin-top: -4px; height:60px;" class="rounded-lg overflow-hidden position-relative float-left">
    <div class="bg-image overflow-hidden" data-bg="<?php echo $gig['img']; ?>">&nbsp;</div>
    </div>
    
      
    <div class="d-flex">
    
      <div class="w-100">
      
        <div class="d-flex justify-content-between ml-3">
          <div class="w-100">
            <div  class="text-700">
              <?php echo $gig['name']; ?>
            </div>
            <div class="small mt-2">
              <ul class="list-inline mb-0">
                <li class="list-inline-item mr-3">
                  <div class="text-700 text-primary prictag h6 mb-0">
                    <?php echo $gig['cashback']; ?>
                  </div>
                </li> 
              </ul>
            </div>
            
          </div>
          <i class="fa fa-chevron-right fa-2x mt-2 mr-2"></i>
        </div>
      </div>
    </div>
     </div>
    </a>
 
<?php } ?>
