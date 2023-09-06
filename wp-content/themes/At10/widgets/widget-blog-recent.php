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
   
   if(!_ppt_checkfile("widget-blog-recent.php")){
   ?>


<div class="mb-4 rounded card">

<div class="card-header bg-primary text-light text-600">

<?php  echo __("Latest News","premiumpress"); ?>

</div>

<div class="card-body pb-3">
 
   
   
    <ul class="list-unstyled pb-3">
      <?php	
                  $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
                  
                  $args = array(
                      'post_type' 		=> 'post',
                      'posts_per_page' 	=> $num,
					  'post_status' => 'publish',
                  
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
      
      <a href="<?php the_permalink(); ?>" style="max-width:60px;">     
      
      <div class="image bg-white position-relative rounded overflow-hidden" style="height:40px;width:60px;">
            <div class="bg-image" data-bg="<?php echo $image; ?>"></div>
          </div> 
      
        </a>
        <div class="media-body ml-3">
          <h5 class="mt-0 mb-2 small"><a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark">
            <?php echo $title; ?>
            </a></h5>
         
        </div>
      </li>
      <?php } } ?>
      <?php wp_reset_query(); ?>
    </ul>
  </div>
</div>
<?php } ?>
