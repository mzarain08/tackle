<?php
 
add_filter( 'ppt_blocks_args',  array('block_hero105',  'data') );
add_action( 'hero105',  			array('block_hero105', 'output' ) );
add_action( 'hero105-css',  		array('block_hero105', 'css' ) );
add_action( 'hero105-js',  		array('block_hero105', 'js' ) );

class block_hero105 {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['hero105'] = array(
			"name" 	=> "Hero 105",
			"image"	=> "hero105.jpg",
			"cat"	=> "hero",
			"widget" => "ppt-hero",			
			"order" => 1.3,
			"desc" 	=> "", 
			"data" 	=> array( ),
			"defaults" => array(),
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $settings, $hero_settings, $df;	
	    
		 // ALL DEFAULT FIELDS
		 $df = ppt_theme_blocks_defaults("hero"); 
 		 
		 $cc = array(
		 
		 	"image1" => DEMO_IMG_PATH."icons/3.png",
			
			"image1_show" => "1",
			 
			"btn_show" => 1,
			"btn2_show" => 1,	
			"searchbox" => 0,	
			"searchboxmap" => 0,			
	 
			"video_show" => 0, 	
			
			"title_color" => "text-light",
			"subtitle_color" => "text-light",
			"desc_color" => "text-light",	
			
			"title" => "Amazing {Headline}",
			"title_underline" => 1,
			"title_underline_color" => "#fce16a",			
			
			"title_margin" => "mb-4",
			"subtitle_margin" => "mb-4",
			
			"subtitle_font_weight" => "text-700",
			
			"subtitle" => "Save Time  Money - Get Started Today",			
			"desc" => "Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.  ",
 			 
			 
			 "section_padding" => "section-0",
			 "section_bg" => "ppt-gradient4",
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
echo ppt_theme_block_output($output, $df, array("hero", "hero105"));
	
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