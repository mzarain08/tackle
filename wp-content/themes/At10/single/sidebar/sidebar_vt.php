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

global $CORE, $userdata, $post, $CORE_VIDEO;



///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$args = array('posts_per_page' => 1, 'post_type' => "listing_type", 'orderby' => "rand" );

$NextUserLink = home_url()."/?s=";
$query1 = new WP_Query( $args ); 
if ( $query1->have_posts() ) {
	while ( $query1->have_posts() ) { $query1->the_post();	
		$NextUserLink = get_permalink($post->ID);
	}

}	
wp_reset_query();

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////	
// WHO HAS ACCES
$allAccess 		= $CORE->USER("hasaccess_special_vdeoaccess", array($post->ID, 1));
$pageaccess 	= $CORE->USER("hasaccess_special_vdeoaccess", array($post->ID, 2));
$myAccess		 = $CORE->USER("hasaccess_special_vdeoaccess", array($post->ID, 3));
 
$canShowLikes = 1;
$showVideos = 3;
 

$value = array();
$status = array(
	"" 		=> __("Everyone","premiumpress"),
	"loggedin" 	=> __("Members Only","premiumpress"),		
	"subs" 	=> __("Members With Subscriptions","premiumpress"), 
);

// GET ALL MEMBERSHIPS
$all_memberships = $CORE->USER("get_memberships", array());
foreach($all_memberships  as $key => $m){
	$status[$m['key']] = $m['name'];
} 
				 
                  
$value = get_post_meta($post->ID,'videoaccess',true);
// TESTING
if( _ppt(array('lst', 'requirelogin_videos' )) == '1'){
 $value["loggedin"] = "loggedin";
}

if( $CORE->USER("hasaccess_special_vdeoaccess", $post->ID) == "1"  ){

}else{  
 
?>      
 
      <div class="text-dark p-4 text-center mb-4" ppt-border1>
      	
        <div class="text-center mb-3"><i class="fa fa-users fa-3x"></i></div>
      
        <div class="h4 mb-4 font-weight-bold"><?php echo __("Members Only","premiumpress"); ?></div>
        <?php if(is_array($value) && !empty($value) ){  
		
		$psks = "";
		  foreach($status as $key => $club){
					  if(in_array($key, array("","subs")) ){ continue; } 
                          if(in_array($key,$value) || in_array("mem".$key,$value) ){ 
                             $psks .= "<span class='badge badge-dark'>".$club."</span> "; 
                          }
                      } 
				  
				   echo '<p class="small opacity-5">'.str_replace("%s",$psks,__("This video is available for %s members only.","premiumpress")).'</p>'; 
                       
                  } 
		 ?>
        
        
        <?php if( $CORE->USER("hasaccess_special_vdeoaccess", $post->ID) == "1"  ){ ?>
        
         <a href="javascript:void(0)" data-ppt-btn  class="btn-success font-weight-bold btn-lg">
        <span><?php echo __("Access Granted","premiumpress") ?></span></a>
        
        
        <?php }else{ ?>
        
         <a href="javascript:void(0)"  <?php if(!$userdata->ID){ ?> onclick="processLogin();" <?php }else{ ?>onclick="processUpgrade();"<?php } ?> data-ppt-btn  class="btn-primary font-weight-bold btn-lg">
        <span><?php echo __("Upgrade Now","premiumpress") ?></span></a>
        
        
        <?php } ?>
        
       
        
      </div>

     

<?php

}


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
/*
<textarea style="display:none; font-size:11px; width:100%; height:100px;"><?php print_r($allAccess).print_r($pageaccess).print_r($myAccess); ?></textarea>

*/
			
?>

<div ppt-box class="rounded hide-mobile hide-ipad">
  <div class="_content p-3">
    <div class="mt-3 ppt-category-wrap overflow-hidden">
      <?php	
                  $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
                  
                  $args = array(
                      'post_type' 		=> 'listing_type',
                      'posts_per_page' 	=> 5,
					  "post_status"		=> "publish",
					  "orderby" => "rand"
                  
                  );
                  $wp_query = new WP_Query($args);                   
                  if ( $wp_query->have_posts() ) {                                                       
                  while ( $wp_query->have_posts() ) {  $wp_query->the_post(); 
				   
?>
      <div class="d-flex mb-3">
        <div>
          <a href="<?php the_permalink(); ?>">
          <div class="single-video overflow-hidden rounded-lg">
          <figure>
          <div class="ppt-category-image rounded" style="background-color:black; height:105px; width:150px; background-image: url(<?php echo do_shortcode('[IMAGE pathonly=1]'); ?>);"> </div>
           <i class="fa fa-play-circle opacity-5"></i>
           </figure>
          </div>
        </div>
        </a>
        <div >
          <div class="d-flex align-items-start flex-column ml-4">
            <div class="mb-auto text-600" style="max-height: 65px; overflow: hidden;">
              
                <?php echo do_shortcode('[TITLE]'); ?>
            
            </div>
            
            <div class="mt-2 fs-sm text-uppercase opacity-2">
            
             <?php echo do_shortcode('[HITS]'); ?> <?php echo __("Views","premiumpress"); ?>
            
            </div> 
            
          </div>
        </div>
      </div>
      <?php } } ?>
      <?php wp_reset_query(); ?>
    </div>
  </div>
</div>