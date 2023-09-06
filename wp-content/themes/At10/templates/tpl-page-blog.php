<?php
/*
   Template Name: [PAGE - BLOG]
*/
   
   global $wpdb, $post, $wp_query;
   
   if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
   
    
   $GLOBALS['flag-blog'] = true;
   $GLOBALS['flag-page-sidebar'] = 1;
   $GLOBALS['flag-page-nopadding'] = 1;
  
$pageLinkingID = _ppt_pagelinking("blog");
 
if( substr($pageLinkingID ,0,9) == "elementor" ){

	get_header(); 

		echo do_shortcode( "[premiumpress_elementor_template id='".substr($pageLinkingID,10,100)."']");

	get_footer();

}else{   

   get_header(); 
   
   _ppt_template( 'page-before' ); 
    
    $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;      
    $args = array(
          'post_type' 			=> 'post',
          'posts_per_page' 		=> get_option('posts_per_page'),
          'paged' 				=> $paged, 
     );	  
  	
	if(isset($wp_query->query['category_name'])){	
		$term = get_term_by('slug', $wp_query->query['category_name'], 'category'); 
		if(isset($term->term_id)){
		$args['cat'] = $term->term_id;	
		}
	}
	if(isset($_GET['keyword'])){	  	  
	  	$args['s'] = $_GET['keyword'];		
	} 	  
    $wp_query = new WP_Query($args); 
      
      // COUNT EXISTING ADVERTISERS	 
      $tt = $wpdb->get_results($wp_query->request, OBJECT);
      
      if(!empty($tt)){
		  foreach($tt as $p){      
		  	$post = get_post($p->ID);      
		 	_ppt_template( 'content', 'post' );	  
		  } 
	  }else{
	  
	   echo __("no results found","premiumpress");	   
	   
	   } 
?>

<div class="my-4 pt-3  mobile-mb-4 mobile-pb-4"><?php echo $CORE->PAGENAV(); ?></div>

<?php wp_reset_query(); ?> 
 
<?php _ppt_template( 'page-after' );

get_footer(); 

} ?>