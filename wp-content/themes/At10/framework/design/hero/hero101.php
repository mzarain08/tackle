<?php
 
add_filter( 'ppt_blocks_args',  array('block_hero101',  'data') );
add_action( 'hero101',  			array('block_hero101', 'output' ) );
add_action( 'hero101-css',  		array('block_hero101', 'css' ) );
add_action( 'hero101-js',  		array('block_hero101', 'js' ) );

class block_hero101 {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['hero101'] = array(
			"name" 	=> "Hero 101",
			"image"	=> "hero101.jpg",
			"cat"	=> "hero",	
			"widget" => "ppt-hero",			
			"order" => 1,
			"desc" 	=> "", 
			"data" 	=> array( ),
			"defaults" => array(),
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $settings, $hero_settings, $df;	
	
		 // ALL DEFAULT FIELDS
		 $df = ppt_theme_blocks_defaults("hero"); 
 		
		 $cc = array(
		 
		 	"image" => "https://premiumpress1063.b-cdn.net/_demoimagesv10/hero/hero2.jpg",
			
			"btn_show" => 1,
			"btn2_show" => 1,	
			"searchbox" => 0,	
			"searchboxmap" => 0,			
			"image1_show" => 0,
			"video_show" => 0, 	
			
			"title_color" => "text-dark",
			"subtitle_color" => "text-dark",
			"desc_color" => "text-dark",	
			
			"title" => "Amazing {Headline}",
			"title_underline" => 1,
			"title_underline_color" => "#555b83",			
			
			"title_margin" => "mb-4",
			"subtitle_margin" => "mb-4",
			
			"subtitle" => "Save Time  Money",
			"subtitle_color" => "#555b83",
			
			"btn_bg" => "btn-dark",
			"btn_bg_color" => "#555b83",
			
			"desc" => "Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.  ",
			 
			 
			 
			 
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
 

<section class="hero101 py-5 position-relative">
<?php  _ppt_template( 'framework/design/hero/parts/hero1_content' ); ?>
</section>
<?php
$output = ob_get_contents();
ob_end_clean();
echo ppt_theme_block_output($output, $df, array("hero", "hero101"));
	
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