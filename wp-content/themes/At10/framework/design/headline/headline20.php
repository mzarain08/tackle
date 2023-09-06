<?php
 
add_filter( 'ppt_blocks_args', 	array('block_headline20',  'data') );
add_action( 'headline20',  		array('block_headline20', 'output' ) );
add_action( 'headline20-css',  	array('block_headline20', 'css' ) );
add_action( 'headline20-js',  	array('block_headline20', 'js' ) );

class block_headline20 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['headline20'] = array(
			"name" 		=> "Headline 17",
			"image"		=> "headline20.jpg",
			"cat"		=> "headline",
			"desc" 		=> "", 
			"order" 	=> 20, 
			"widget" 	=> "ppt-headline",	
			"data" 		=> array( ),
			"defaults" 	=> array( ), 
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $df, $headline_settings;
	 	
		 // ALL DEFAULT FIELDS
		  $df = ppt_theme_blocks_defaults("headline"); 
		
		 
		// APPLY CUSTOM CHANGES 
		$cc = array(
			 
			"title_tag" 			=> "h2",
			"title_align" 			=> "text-center", 
		 	"title_font" 			=> "",
			"title_font_size" 		=> "fs-xl", 
		 	"title_font_weight" 	=> "text-700", 			
			
			"title_underline" 		=> 1, // number of underline style			
			"title_animated" 		=> "ppt-animate-zoom-in", // typed
		
			"subtitle_show" 		=> 1, // on/off
			
			"subtitle_tag" 			=> "h2",
			"subtitle_align" 		=> "text-center", 
			"subtitle_font_size" 	=> "fs-14", 
		 	"subtitle_font_weight" 	=> "text-600", 
			"subtitle_margin" 		=> "mb-3", 
			
			"subtitle_underline" 		=> "1",
			"subtitle_animated" 		=> "ppt-animate-zoom-in", // typed
			
			"desc_show" 			=> 1, // on/off 
			"desc_align" 			=> "text-center",  
			"desc_margin" 			=> "mt-4",
			
			"desc_font_size" 	=> "fs-md", 
			
			"desc_underline" 		=> "6",
			"desc_underline_color" 		=> "#f9ba0a",
			
			
		);
		
		$df = array_merge($df, $cc);
		
		// APPLY ELEMENTOR
		if(!empty($headline_settings)){
			foreach($df as $k => $v){				
				if(isset($headline_settings[$k]) && $headline_settings[$k] != "" ){
					$df[$k] = $headline_settings[$k];
				}
			}		
		}
	  
	ob_start();
	
	?><section class="section-60" data-ppt-headline>
    
      
  <div class="container">  
  
   <?php if($df['subtitle_show']){ ?>
   
   <div data-ppt-subtitle> Build [Unlimited, Client] Websites Today! </div>  
 
  <?php } ?>
  
   <h1 data-ppt-title>PremiumPress  {[Awesome,Amazing,Cool,Fun]} Themes</h1>
   
  <?php if($df['desc_show']){ ?>  
   
   <div data-ppt-desc> {Get started now.} </div>  
 
  <?php } ?>   
   
   
  </div>
</section><?php

$output = ob_get_contents();
ob_end_clean();
echo  ppt_theme_block_output($output, $df, array("headline", "headline20"));
 
	
	}
		public static function css(){
		return "";
		ob_start();
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;
		}	
		public static function js(){
 		return "";
		ob_start(); 
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;
		}	
}

?>