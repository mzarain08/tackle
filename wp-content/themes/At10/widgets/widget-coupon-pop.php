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
   
   global $CORE, $userdata, $settings, $post; 
   
	if(!in_array(THEME_KEY, array("cp")) ){ return ""; }
   
   // DISPLAY AMOUNT
   $num = 5;
   if(isset($settings['num']) && is_numeric($settings['num']) && $settings['num'] > 0){
   $num = $settings['num'];
   }
    
   
   ?>


<div class="mb-4 rounded"  ppt-box>

<div class="_header">

<div class="_title bg-primary text-light"><?php echo __("Popular Coupons","premiumpress"); ?></div>

</div>

<div class="_content pb-3">
 
    <ul class="list-unstyled">
      <?php	
                  $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
                  
                  $args = array(
                      'post_type' 		=> 'listing_type',
                      'posts_per_page' 	=> $num,
					  'order' => 'desc',
					  	'meta_query' => array (
					array (
					  'key' => "lastused",
						'compare' => 'LIKE',
						'value' => date('Y-m-d'),
						'type' => 'DATETIME'
					 
					)
				  )
                  
                  );
                  $wp_query = new WP_Query($args);                   
                  if ( $wp_query->have_posts() ) {                                                       
                  while ( $wp_query->have_posts() ) {  $wp_query->the_post();    
				  
				  
   // USED
   $used = do_shortcode('[USED]');
   if(!is_numeric($used)){
   $used = 0;
   }
   
   
   // IMAGE
   // IMAGE
   $image = "";
	$imgdata = $CORE->MEDIA("get_image_data", $post->ID);
    
	 if(strlen($imgdata['thumbnail']) > 1){
	 $image  = $imgdata['thumbnail']; 	
     } 
	 
	$found 	= wp_get_object_terms( $post->ID, 'store' );
	$s_link = home_url();
	if(is_array($found) && !empty($found)){
		$s_link = get_term_link($found[0]->term_id, "store"); 
		$image = do_shortcode('[STOREIMAGE sid='.$found[0]->term_id.']'); 
	 
	}
	 
	 $link = $s_link."/?__sid=".$post->ID;
				   
?>
      <li class="media mt-3"> 
       
      
      <a href="<?php echo $link; ?>"  style="max-width:60px;" class="store-icon-small">
      
      
    
       <div class="image bg-white position-relative rounded overflow-hidden p-2" style="height:40px;width:60px;" ppt-border1>
            <div class="bg-image" data-bg="<?php echo $image; ?>"></div>
          </div>
    
         
        </a>
        <div class="media-body ml-3">
          <h5 class="mt-0 mb-2 small"><a href="<?php echo $link; ?>" class="text-decoration-none text-dark">
            <?php the_title(); ?>
            </a></h5>
          <div class="text-muted small">
          
           <?php
		   
		   
		   
		    if($used > 0){ ?>
          <i class="fa fa-flame text-danger mr-1"></i> <?php 
		  
		  if($used == 1){
		   echo str_replace("%s", $used , __( 'used once', 'premiumpress' ) ); 
		  }else{
		   echo str_replace("%s", $used , __( 'used %s times', 'premiumpress' ) ); 
		  }
		  
		 ?>   
          <?php } ?>
          
           </div>
        </div>
      </li>
      <?php } } ?>
      <?php wp_reset_query(); ?>
    </ul>
  </div>
</div>