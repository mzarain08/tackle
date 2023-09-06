<?php
 
add_filter( 'ppt_blocks_args',  array('block_hero106',  'data') );
add_action( 'hero106',  			array('block_hero106', 'output' ) );
add_action( 'hero106-css',  		array('block_hero106', 'css' ) );
add_action( 'hero106-js',  		array('block_hero106', 'js' ) );

class block_hero106 {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['hero106'] = array(
			"name" 	=> "Hero 105",
			"image"	=> "hero106.jpg",
			"cat"	=> "hero",
			"widget" => "ppt-hero",			
			"order" => 1.6,
			"desc" 	=> "", 
			"data" 	=> array( ),
			"defaults" => array(),
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $settings, $hero_settings, $df;	
	    
		 // ALL DEFAULT FIELDS
		 $df = ppt_theme_blocks_defaults("hero"); 
 		 
		 $cc = array(
		 
		 	"image1" => DEMO_IMG_PATH."icons/5.png",
			
			"image1_show" => "1",
			 
			"btn_show" => 1,
			"btn2_show" => 1,	
			"searchbox" => 0,	
			"searchboxmap" => 0,			
	 
			"video_show" => 0, 	
			
			
			"title_color" => "text-dark",
			"subtitle_color" => "",
			"desc_color" => "text-dark",
			"subtitle_color" => "#5b6d8a",
				
			
			"title" => "Amazing {Headline}",
			"title_underline" => 2,
			"title_underline_color" => "#8abb1d",		
			
			"title_margin" => "mb-4",
			"subtitle_margin" => "mb-4",
			
			"subtitle_font_weight" => "text-700",
			
			"subtitle" => "Save Time  Money - Get Started Today",			
			"desc" => "Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.  ",
 			 
			 
			 "section_padding" => "section-0",
			 "section_bg" => "ppt-gradient5",
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
<?php  _ppt_template( 'framework/design/hero/parts/hero1_content' ); ?>
</section>
<?php
$output = ob_get_contents();
ob_end_clean();
echo ppt_theme_block_output($output, $df, array("hero", "hero106"));
	
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