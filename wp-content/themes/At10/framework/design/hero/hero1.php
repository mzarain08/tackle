<?php
 
add_filter( 'ppt_blocks_args',  array('block_hero1',  'data') );
add_action( 'hero1',  			array('block_hero1', 'output' ) );
add_action( 'hero1-css',  		array('block_hero1', 'css' ) );
add_action( 'hero1-js',  		array('block_hero1', 'js' ) );

class block_hero1 {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['hero1'] = array(
			"name" 	=> "Hero 1",
			"image"	=> "hero1.jpg",
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
		 	"image" => DEMO_IMGS."?fw=hero1&t=".THEME_KEY,
			"image1" => DEMO_IMGS."?fw=hero5&t=".THEME_KEY,
			"image1_offset" => 1,
			"btn_show" => 1,
			"btn2_show" => 1,	
			"searchbox" => 0,	
			"searchboxmap" => 0,			
			"image1_show" => 0,
			"video_show" => 0, 		 
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
		 	$settings =  $CORE->LAYOUT("get_block_settings_defaults_new", array("hero", "hero1" ) );
		 	foreach($df as $h => $j){
				if(isset($settings[$h]) && $settings[$h] != ""){
					$df[$h] = $settings[$h];
				}
			 } 
		} 
		
		
ob_start();		
?>
 

<section class="hero1 py-5 position-relative">
<?php  _ppt_template( 'framework/design/hero/parts/hero1_content' ); ?>
</section>
<?php
$output = ob_get_contents();
ob_end_clean();
echo ppt_theme_block_output($output, $df, array("hero", "hero1"));
	
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