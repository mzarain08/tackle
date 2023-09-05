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
    
   // DISPLAY AMOUNT
   $num = 5;
   if(isset($settings['num']) && is_numeric($settings['num']) && $settings['num'] > 0){
   $num = $settings['num'];
   }
   
   ?>

<div class="card card-new-listings mb-4">

<div class="card-header bg-primary text-light text-600"><span><?php echo  str_replace("%s", $CORE->LAYOUT("captions","2"), __("New %s","premiumpress") ); ?></span></div>
  <div class="card-body py-0">
 
    <ul class="list-unstyled pb-3">
      <?php	
                  $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
                  
                  $args = array(
                      'post_type' 		=> 'listing_type',
                      'posts_per_page' 	=> $num,
					  'orderby' => 'date',
					  'post_status' => 'publish',
					  'order' => 'desc', 
                  
                  );
                  $wp_query = new WP_Query($args);                   
                  if ( $wp_query->have_posts() ) {                                                       
                  while ( $wp_query->have_posts() ) {  $wp_query->the_post();    
				  
	 
				   
// IMAGE
$image = do_shortcode('[IMAGE pathonly=1]');

// LINK	 
$link = get_permalink($post->ID);

// TITLE
$title =  do_shortcode('[TITLE pid="'.$post->ID.'"]');
				   
?>
      <li class="media mt-3">        
      
      <a href="<?php echo $link; ?>"  style="max-width:60px;">     
      
       <div class="image bg-white position-relative rounded overflow-hidden" style="height:40px;width:60px;">
            <div class="bg-image" data-bg="<?php echo $image; ?>"></div>
          </div>
      
         
        </a>
        <div class="media-body ml-3">        
          <h5 class="mt-0 mb-2 small text-600"><a href="<?php echo $link; ?>" class="text-decoration-none text-dark"><?php echo $title; ?></a></h5>
          
          <small class="opacity-5 link-dark">
<?php 
		  
		switch(THEME_KEY){
		 
			case "sp": {
			  ?>
               <span class="fs-sm  <?php echo $CORE->GEO("price_formatting",array()); ?>"><?php echo do_shortcode("[PRICE]"); ?></span>
              <?php
			} break;
			default: {
			  _ppt_template( 'cards/card-content-data-top' ); 
			} break; 
		}    
?>
</small>
          
         
        </div>
      </li>
      <?php } } ?>
      
      <?php wp_reset_query(); ?>
    </ul>
  </div>
</div>