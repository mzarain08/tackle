<?php
 
add_filter( 'ppt_blocks_args', 	array('block_blog6',  'data') );
add_action( 'blog6',  		array('block_blog6', 'output' ) );
add_action( 'blog6-css',  	array('block_blog6', 'css' ) );
add_action( 'blog6-js',  	array('block_blog6', 'js' ) );

class block_blog6 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['blog6'] = array(
			"name" 	=> "Blog 6",
			"image"	=> "blog6.jpg",
			"cat"	=> "blog",
			"desc" 	=> "", 
			"widget" => "ppt-blog",	
			"data" 	=> array( ),
			"order" => 6,
			"defaults" => array(),
						
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $wpdb, $blog_settings, $settings, $CORE_UI;
 		
		 
		 $df = array(
		 	 
			"show" => 3,
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
      <?php foreach($tt as $p){
         
          global $post;
          
        $post = get_post($p->ID);
		  
		$day 	= date("d", strtotime(get_the_date('Y-m-d',$post->ID)));
		$month 	= date("M", strtotime(get_the_date('Y-m-d',$post->ID)));
		$year 	= date("Y", strtotime(get_the_date('Y-m-d',$post->ID)));
		
         
    ?>
      <div class="col-md-4">
      
       <article class="mb-4 mb-sm-0">
      <figure class="mb-4" ppt-border1> <a href="<?php echo get_permalink($post->ID); ?>"> <img src="<?php echo do_shortcode('[IMAGE pathonly=1]'); ?>" alt="<?php echo strip_tags(do_shortcode('[TITLE]')); ?>" class="img-fluid"> </a> </figure>
      
       
          <div class="post-date mr-3"  ppt-border1>
            <span class="day text-700 text-primary"><?php echo $day; ?></span> <span class="month bg-primary"><?php echo $month; ?></span>
          </div>
          <div class="mb-1">
            <a href="<?php echo get_permalink($post->ID); ?>" class="text-dark fs-6 text-600">
          
              <?php echo $post->post_title; ?>
             
            </a>
          </div>
          <div class="opacity-5">
            <?php echo do_shortcode("[EXCERPT limit=100]"); ?>...
          </div>
       
      </div>
       </article>
      <?php }?>
    </div>
  </div>
</section>

<?php
}
		$output = ob_get_contents();
		ob_end_clean();
		
echo ppt_theme_block_output($output, $blog_settings, array("blog", "blog6"));
	 
	
	}
	
		public static function css(){
		ob_start();
		?>
<style>

article .post-date {
    float: left;
    margin-right: 10px;
    text-align: center;
}
article .post-date .day {
  
    border-radius: 2px 2px 0 0;
    color: #ccc;
    display: block;
    font-size: 18px;
    font-weight: 900;
    padding: 10px;
}

article .post-date .month {
    display: block;
 
    border-radius: 0 0 2px 2px;
    color: #fff;
    font-size: .8em;
    line-height: 1.8;
    padding: 1px 10px;
    text-transform: uppercase;
}
</style>
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
