<?php
 
add_filter( 'ppt_blocks_args', 	array('block_block_blog_carousel',  'data') );
add_action( 'block_blog_carousel',  		array('block_block_blog_carousel', 'output' ) );
add_action( 'block_blog_carousel-css',  	array('block_block_blog_carousel', 'css' ) );
add_action( 'block_blog_carousel-js',  	array('block_block_blog_carousel', 'js' ) );

class block_block_blog_carousel {

	function __construct(){ }
 
	public static function data($a){ 
 
		$a['block_blog_carousel'] = array(
			"name" 	=> "Blog (carousel)",
			"image"	=> "block_blog_carousel.jpg",
			"cat"	=> "block",
			"desc" 	=> "", 
			"data" 	=> array( ),
			"order" => 4,	
			
			"defaults" => array(  ),
			
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $new_settings, $settings, $wpdb;
	
	
		$settings = array( );  
	  
		// ADD ON SYSTEM DEFAULTS
		$settings = $CORE->LAYOUT("get_block_settings_defaults", array("block_blog_carousel", "block", $settings ) ); 

		// UPDATE DATA FROM ELEMENTOR OR CHILD THEMES
		if(is_array($new_settings)){
			 foreach($settings as $h => $j){
				if(isset($new_settings[$h]) && $new_settings[$h] != ""){
					$settings[$h] = $new_settings[$h];
				}
			 }
		}  
	 
	ob_start();
	
	
	///////////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////////

	$limit = 8;
	if(isset($new_settings['limit']) && is_numeric($new_settings['limit'])){
	$limit = $new_settings['limit'];
	}
	
	$perrow = 4;
	if(isset($new_settings['perrow']) && is_numeric($new_settings['perrow'])){
	$perrow = $new_settings['perrow'];
	}
	 
	$orderby = "date";
	if(isset($new_settings['orderby']) && strlen($new_settings['orderby']) > 1){
	$orderby = "date";
	} 
	
	///////////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////////

	$args = array(
	'post_type' 		=> 'post',
	'posts_per_page' 	=> $limit, 
	'paged' 			=> 1,
	'orderby' 			=> $orderby
	);
	
	$wp_query = new WP_Query($args); 
	$tt = $wpdb->get_results($wp_query->request, OBJECT);
	
	$randomID = rand(0,999999);
	
?><div class="blog<?php echo $randomID; ?>-carousel owl-carousel owl-theme">
               <?php
                  if(!empty($tt)){
                  foreach($tt as $p){
                  
                  global $post;
                  
                  $post = get_post($p->ID);
				  
				   $day 	= date("d", strtotime(get_the_date('Y-m-d',$post->ID)));
				   $month 	= date("M", strtotime(get_the_date('Y-m-d',$post->ID)));
				   $year 	= date("Y", strtotime(get_the_date('Y-m-d',$post->ID)));

                  
                  ?>
               <div class="card-ppt-search card blog">
               
               <figure>
							 
							<a href="<?php echo get_permalink($post->ID); ?>">
                            
                            <img src="<?php echo do_shortcode('[IMAGE pathonly=1]'); ?>" alt="<?php echo strip_tags(do_shortcode('[TITLE]')); ?>" class="img-fluid">
                            
                            <div class="read_more"><span><?php echo __("read more","premiumpress"); ?></span></div></a>
							 
						</figure>
               
               
              
                  <div class="card-body pb-0">
                  
                     <a href="<?php echo get_permalink($post->ID); ?>" class="text-dark">
                        <h5><?php echo do_shortcode('[TITLE]'); ?></h5>
                     </a>
                   
                        <?php /*<div class="my-3"><?php the_category(','); ?> </div>*/ ?>
                  
                  <p class="card-text mb-0 mb-lg-4 text-muted small"> <?php echo do_shortcode('[EXCERPT limit=90]'); ?>...</p>
                  
                  <?php /*<hr />
                  <div class="d-flex align-items-center justify-content-between">
                     <div class="post-meta">
                        <a class="text-dark" href="<?php echo get_permalink($post->ID); ?>">
                        <i class="fal fa-comments mr-2"></i><?php echo $post->comment_count; ?></a>
                     </div>
                     <span class="text-italic"> <i class="fal fa-calendar"></i> <?php echo $month; ?> <?php echo $day ; ?></span>
                  </div>
				  */ ?>
            </div>
            </div>
            <?php
               }} ?>
            <?php wp_reset_query();
			
			
			$output = ob_get_contents();
		ob_end_clean();
		echo $output;	
	
	}
		public static function css(){
		return "";
		ob_start();
		?>
<?php	
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;
		}	
		public static function js(){
		return "";
		ob_start();
		?>
<?php	
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;
		}	
}

?>