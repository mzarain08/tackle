<?php
 
add_filter( 'ppt_blocks_args',  array('block_hero100',  'data') );
add_action( 'hero100',  			array('block_hero100', 'output' ) );
add_action( 'hero100-css',  		array('block_hero100', 'css' ) );
add_action( 'hero100-js',  		array('block_hero100', 'js' ) );

class block_hero100 {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['hero100'] = array(
			"name" 	=> "Hero 100",
			"image"	=> "hero100.jpg",
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
		 $df = ppt_theme_block_default(array("title","subtitle","desc","btn","btn2","image"), 0);//
		 
 
		 $cc = array(
		 	"image" => "https://premiumpress1063.b-cdn.net/_demoimagesv10/hero/hero1.jpg",
			 
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
			
			"subtitle" => "Save Time  Money - Get Started Today",
			
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
 

<section class="hero100 py-5 position-relative">
<?php  _ppt_template( 'framework/design/hero/parts/hero1_content' ); ?>
</section>
<?php
$output = ob_get_contents();
ob_end_clean();
echo ppt_theme_block_output($output, $df, array("hero", "hero100"));
	
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