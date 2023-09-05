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
   $num = 3;
   if(isset($settings['num']) && is_numeric($settings['num']) && $settings['num'] > 0){
   $num = $settings['num'];
   }
    
?>
<div class="card card-blog">

<div class="card-header bg-primary text-light text-600"><span><?php echo __("Latest Deals","premiumpress") ?></span></div>

  <div class="card-body py-0">
    
    <ul class="storelist nobot">
      <?php
 $args = array(
                   'post_type' 		=> 'listing_type',
                   'posts_per_page' 	=> $num,
				   'meta_query' => array(  array (						 
							'key'		=> 'homepage',
							'value' 	=> "1",
							'compare' 	=> '=',
					), ),
               );
			   
			   
               $wp_query3 = new WP_Query($args);
			    
               if ( $wp_query3->have_posts() ) :
                                                    
               while ( $wp_query3->have_posts() ) :  $wp_query3->the_post(); 
                
               ?>
      <li class="clearfix">
        <div class="store">
          <a href="<?php the_permalink(); ?>" class="text-dark">
          <div class="image bg-white">
            <?php echo do_shortcode('[IMAGE link=0]'); ?>
          </div>
          <div class="content">
            <h6><?php echo do_shortcode('[TITLE]'); ?></h6>
          </div>
          </a>
        </div>
      </li>
      <?php endwhile; endif; ?>
    </ul>
  </div>
</div>
