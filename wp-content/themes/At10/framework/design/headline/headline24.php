<?php
 
add_filter( 'ppt_blocks_args', 	array('block_headline24',  'data') );
add_action( 'headline24',  		array('block_headline24', 'output' ) );
add_action( 'headline24-css',  	array('block_headline24', 'css' ) );
add_action( 'headline24-js',  	array('block_headline24', 'js' ) );

class block_headline24 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['headline24'] = array(
			"name" 		=> "Headline 22",
			"image"		=> "headline24.jpg",
			"cat"		=> "headline",
			"desc" 		=> "", 
			"order" 	=> 23, 
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
			"title_font_size" 		=> "fs-lg", 
		 	"title_font_weight" 	=> "text-700", 			
			
			"title_underline" 		=> 1, // number of underline style			
			"title_animated" 		=> "ppt-animate-zoom-in", // typed
		
			"subtitle_show" 		=> 1, // on/off
			
			"subtitle_tag" 			=> "h2",
			"subtitle_align" 		=> "", 
			"subtitle_font_size" 	=> "", 
		 	"subtitle_font_weight" 	=> "", 
			"subtitle_margin" 		=> "", 
			
			"subtitle_underline" 		=> 2,
			"subtitle_animated" 		=> "ppt-animate-zoom-in", // typed
			
			"desc_show" 			=> 1, // on/off 
			"desc_align" 			=> "text-center",  
			"desc_margin" 			=> "mt-4",
			
			"desc_underline" 		=> "6",
			
			"section_bg" => "",
			"section_padding" => "section-40",
			
			
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
    
      
  <div class="container text-center">  
  
  <div class="landing-count ">50+ </div>
  
  
  <h2 class="fs-lg mb-3" data-ppt-title>Designs {Included}</h2>
        
  <div class="my-4 lh-40" data-ppt-subtitle>We are trusted by over 65,000+ user worldwide.**** Build your next website using our  WordPress themes today.</div>
     
   
   
  </div>
</section><?php

$output = ob_get_contents();
ob_end_clean();
echo  ppt_theme_block_output($output, $df, array("headline", "headline24"));
 
	
	}
		public static function css(){
		ob_start();
?>
<style>

.landing-count {
 
    font-size: 150px;
    font-weight: 700;
    line-height: 1;
	    background: linear-gradient(#d5dde9,rgba(213,221,233,0));
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
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
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;
		}	
}

?>