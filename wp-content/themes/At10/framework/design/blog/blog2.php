<?php
 
add_filter( 'ppt_blocks_args', 	array('block_blog2',  'data') );
add_action( 'blog2',  		array('block_blog2', 'output' ) );
add_action( 'blog2-css',  	array('block_blog2', 'css' ) );
add_action( 'blog2-js',  	array('block_blog2', 'js' ) );

class block_blog2 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['blog2'] = array(
			"name" 	=> "Blog 2",
			"image"	=> "blog2.jpg",
			"cat"	=> "blog",
			"desc" 	=> "", 
			"widget" => "ppt-blog",	
			"data" 	=> array( ),
			"order" => 2,
			"defaults" => array(),
						
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $wpdb, $blog_settings, $settings, $CORE_UI;
 		
		 
		 $df = array(
		 	 
			"show" => 4,
			"cat" => array()
		 		 
		 );
		 
		 if(is_array($blog_settings) && !empty($blog_settings)){		 	
			 
			 $df['show'] = $blog_settings['show'];
			 $df['cat'] = $blog_settings['cat'];
		 }
	 
		
	$args = array(
	'post_type' 		=> 'post',
	'posts_per_page' 	=> $df['show'], 
	'orderby' 			=> 'date',
	"order" 			=> "desc",
	);
	
	if(!empty($df['cat'])){
	$args['tax_query'] = array( array( 'taxonomy' => 'category', 'field' => 'term_id', 'terms' => $df['cat']   )  );		
	}
	
	$wp_query = new WP_Query($args); 
	$tt = $wpdb->get_results($wp_query->request, OBJECT);

 
	ob_start();
	   if(!empty($tt)){
             
?>

<section class="section-60">
  <div class="container">
  
  
    <div class="row">
    
    
    <div class="col-12 mb-4">
        <h2 class="mb-2" data-ppt-title>Latest News</h2>
        <p class="text-500" data-ppt-subtitle>Lorem ipsum dolor sit amet.</p>
    
    </div>
    
      <?php foreach($tt as $p){
         
          global $post;
          
        $post = get_post($p->ID);
		  
		$day 	= date("d", strtotime(get_the_date('Y-m-d',$post->ID)));
		$month 	= date("M", strtotime(get_the_date('Y-m-d',$post->ID)));
		$year 	= date("Y", strtotime(get_the_date('Y-m-d',$post->ID)));
		
		
		switch($df['show']){
			 
			case "1": {
			$rowClass = "col-md-12";
			} break; 
			case "2": {
			$rowClass = "col-md-6";
			} break; 
			case "3": {
			$rowClass = "col-md-4";
			} break;
			case "4": {
			$rowClass = "col-md-3";
			} break;
			default: {
			$rowClass = "col-md-3 mb-4";
			} break;
		
		}
		   
          
    ?>
      <div class="<?php echo $rowClass; ?>">
        <div class="p-3" ppt-border1>
          <figure> <a href="<?php echo get_permalink($post->ID); ?>"> <img src="<?php echo do_shortcode('[IMAGE pathonly=1]'); ?>" alt="<?php echo strip_tags(do_shortcode('[TITLE]')); ?>" class="img-fluid"> </a> </figure>
          <div class="mt-2">
            <a href="<?php echo get_permalink($post->ID); ?>" class="text-dark">
            <div class="fs-6 text-600">
              <?php echo $post->post_title; ?>
            </div>
            </a>
            <div class="mt-2 fs-sm opacity-5 d-flex align-items-baseline">
              <div>
                <div class="d-flex align-items-baseline">
                  <div ppt-icon-16 data-ppt-icon-size="16" class="mr-2">
                    <?php echo $CORE_UI->icons_svg['calendar']; ?>
                  </div>
                  <div>
                    <?php echo $month; ?> <?php echo $day ; ?>
                  </div>
                </div>
              </div>
              <div style="max-width:120px;" class="text-truncate link-dark ml-2">
                <?php the_category(' &bull; '); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php
    }?>
    </div>
  </div>
</section>
<?php
}
		$output = ob_get_contents();
		ob_end_clean();
		
echo ppt_theme_block_output($output, $blog_settings, array("blog", "blog2"));
	 
	
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