<?php
 
add_filter( 'ppt_blocks_args', 	array('block_headline2',  'data') );
add_action( 'headline2',  		array('block_headline2', 'output' ) );
add_action( 'headline2-css',  	array('block_headline2', 'css' ) );
add_action( 'headline2-js',  	array('block_headline2', 'js' ) );

class block_headline2 {

	function __construct(){}		

	public static function data($a){  global $CORE;
	
  
		$a['headline2'] = array(
			"name" 		=> "Headline 2",
			"image"		=> "headline2.jpg",
			"cat"		=> "headline",
			"desc" 		=> "", 
			"order" 	=> 0, 
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
		 	"title_font_weight" 	=> "text-800", 			
			"title_underline" 		=> "1", // number of underline style			
			
			"subtitle_show" 		=> 1, // on/off
			
			"subtitle_tag" 			=> "h2",
			"subtitle_align" 		=> "text-center", 
			"subtitle_font_size" 	=> "fs-14", 
		 	"subtitle_font_weight" 	=> "text-600", 
			"subtitle_margin" 		=> "mb-3", 
			
			"subtitle_underline" 		=> "1",
			
			"desc_show" 			=> 1, // on/off 
			"desc_align" 			=> "text-center",  
			"desc_margin" 			=> "mt-4",
			
			"desc_underline" 		=> "4",
		
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
	
	?>
    
<section class="section-60" data-ppt-headline>
  <div class="container">
   
  
   <?php if($df['subtitle_show']){ ?>  
   
   <div data-ppt-subtitle> Build Amazing Websites Today! </div>  
 
  <?php } ?>
  
   <h2 data-ppt-title>PremiumPress {Headline} One</h2>
   
  <?php if($df['desc_show']){ ?>  
   
   <div data-ppt-desc> Get started now. </div>  
 
  <?php } ?>   
   
   
  </div>
</section>
 
  
<?php

$output = ob_get_contents();
ob_end_clean();
echo  ppt_theme_block_output($output, $df, array("headline", "headline2"));
 
	
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
