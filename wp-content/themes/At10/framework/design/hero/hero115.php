<?php
 
add_filter( 'ppt_blocks_args',  array('block_hero115',  'data') );
add_action( 'hero115',  			array('block_hero115', 'output' ) );
add_action( 'hero115-css',  		array('block_hero115', 'css' ) );
add_action( 'hero115-js',  		array('block_hero115', 'js' ) );

class block_hero115 {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['hero115'] = array(
			"name" 	=> "Hero 115",
			"image"	=> "hero115.jpg",
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
		 
		 	"image1" => "https://premiumpress1063.b-cdn.net/_demoimagesv10/icons/hero115.jpg",  
			"image1_show" => "1",
			"image1_offset" => 0,
			 
			"btn_show" => 1,
			"btn2_show" => 1,	
			"searchbox" => 0,	
			"searchboxmap" => 0,			
	 
			"video_show" => 0, 	
			
			"title_color" => "text-dark",
			"subtitle_color" => "text-dark",
			"desc_color" => "text-dark",	
			
			"title" => "Amazing {Headline}",
			"title_underline" => 1,
			"title_underline_color" => "#fce16a",			
			"title_color" => "#000",
			"title_margin" => "mb-4",
			"subtitle_margin" => "mb-4",
			
			"subtitle_font_weight" => "text-700",
			
			"subtitle" => "Save Time  Money - Get Started Today",			
			"desc" => "Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.  ",
 			 
			 
			 "section_padding" => "section-20",
			 "section_bg" => "",
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
				
		// 2. HOME DESIGNS		
		}else{	
			 
		 	$settings =  $CORE->LAYOUT("get_block_settings_defaults_new", array("hero", "hero115" ) );
			 
		 	foreach($df as $h => $j){
				if(isset($settings[$h]) && $settings[$h] != ""){
					$df[$h] = $settings[$h];
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
echo ppt_theme_block_output($output, $df, array("hero", "hero115"));
	
	}
	public static function css(){ global $CORE;
  return "";
ob_start(); 
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