<?php
 
add_filter( 'ppt_blocks_args',  array('block_hero109',  'data') );
add_action( 'hero109',  			array('block_hero109', 'output' ) );
add_action( 'hero109-css',  		array('block_hero109', 'css' ) );
add_action( 'hero109-js',  		array('block_hero109', 'js' ) );

class block_hero109 {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['hero109'] = array(
			"name" 	=> "Hero 109",
			"image"	=> "hero109.jpg",
			"cat"	=> "hero",
			"widget" => "ppt-hero",			
			"order" => 1.9,
			"desc" 	=> "", 
			"data" 	=> array( ),
			"defaults" => array(),
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $settings, $hero_settings, $df;	
	    
		 // ALL DEFAULT FIELDS
		 $df = ppt_theme_blocks_defaults("hero"); 
 		 
		 $cc = array(
		 
		 	"image1" => DEMO_IMG_PATH."icons/user2.png",
			
			"image1_show" => "1",
			 
			"btn_show" => 1,
			"btn2_show" => 1,	
			"searchbox" => 0,	
			"searchboxmap" => 0,			
	 
			"video_show" => 0, 	
			
			
			"title_color" => "text-dark",
			"subtitle_color" => "",
			"desc_color" => "text-dark",
			"subtitle_color" => "#3285b7",
				
			
			"title" => "Amazing {[Headline, Title, Feature]}",
			"title_animated" => 1,
			"title_underline" => 6,
			"title_underline_color" => "#3285b7",		
			
			"title_margin" => "mb-4",
			"subtitle_margin" => "mb-4",
			
			"subtitle_font_weight" => "text-700",
			
			"subtitle" => "Save Time  Money - Get Started Today",			
			"desc" => "Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.  ",
 			 
			 
			 "section_padding" => "section-0",
			 "section_bg" => "ppt-gradient6",
			 "section_bg_color" => "",	
			 
			  
		 );
		 
		 $df = array_merge($df, $cc);
		 
		// APPLY ELEMENTOR
		if(!empty($hero_settings)){
			foreach($df as $k => $v){				
				if(isset($hero_settings[$k]) && $hero_settings[$k] != "" ){
					$df[$k] = $hero_settings[$k];
				}
			}		
		}
		
		
		  	 
		ob_start();
		
		?> 
<section>
<?php  _ppt_template( 'framework/design/hero/parts/hero3_content' ); ?>
</section>
<?php
$output = ob_get_contents();
ob_end_clean();
echo ppt_theme_block_output($output, $df, array("hero", "hero109"));
	
	}
	public static function css(){ global $CORE;
	 return "";
ob_start();?>

        <?php
	 
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;	
	
	}		
	public static function js(){ global $CORE;
		ob_start();
 
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;	
	
	}	
	
}

?>