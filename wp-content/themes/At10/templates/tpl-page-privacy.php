<?php
	/*
	Template Name: [PAGE - PRIVACY]
	*/
	 
	if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
	 
	global  $userdata, $CORE;
	
	$GLOBALS['flag-page-sidebar'] = 1;
	
 	 
	if(!_ppt_checkfile("tpl-page-privacy.php")){
	
$pageLinkingID = _ppt_pagelinking("privacy");

if( substr($pageLinkingID ,0,9) == "elementor" ){

	get_header(); 
	
	echo do_shortcode( "[premiumpress_elementor_template id='".substr($pageLinkingID,10,100)."']");
	
	get_footer();

}else{

	   get_header(); 
	   
	   _ppt_template( 'page-before' );
	   
 	   
  		$CORE->LAYOUT("get_innerpage_blocks", array("page_privacy","load"));
		 
	   ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?> 
 
             
				<?php if($post->post_content == ""){ ?>
                
                <h2>Part 1</h2>
				<p>To edit this text, simply enter your own text into the content area when editing this page.</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.</p>
                <h4 class="mt-4">Part 1.a</h4>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.</p>
                <h4 class="mt-4">Part 1.b</h4>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.</p>                
                

<hr class="mt-5" />

                <h3>Part 2</h3>
				<p>To edit this text, simply enter your own text into the content area when editing this page.</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.</p>
                <h3 class="mt-4">Part 2.a</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.</p>
                <h3 class="mt-4">Part 2.b</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.</p>  
                
				<?php }else{ ?>
				<?php the_content(); ?>
<?php }
				
				
endwhile; endif;

_ppt_template( 'page-after' );

get_footer(); 


} } ?>