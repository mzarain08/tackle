<?php
 
add_filter( 'ppt_blocks_args',  array('block_hero4',  'data') );
add_action( 'hero4',  			array('block_hero4', 'output' ) );
add_action( 'hero4-css',  		array('block_hero4', 'css' ) );
add_action( 'hero4-js',  		array('block_hero4', 'js' ) );

class block_hero4 {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['hero4'] = array(
			"name" 	=> "Hero 4",
			"image"	=> "hero4.jpg",
			"cat"	=> "hero",
			"widget" => "ppt-hero",			
			"order" => 1.2,
			"desc" 	=> "", 
			"data" 	=> array( ),
			"defaults" => array(),
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $settings, $hero_settings, $df;	
	    
		 $df = array(
		 	"image" => DEMO_IMGS."?fw=hero4&t=".THEME_KEY,
			"image1" => "",
			"btn_show" => 1,
			"btn2_show" => 1,	
			"searchbox" => 0,				
			"image1_show" => 0,
			"video_show" => 0, 
		 
		 );
		 
		 if(is_array($hero_settings) && !empty($hero_settings)){		 	
			 if(strlen($hero_settings['image']) > 1){
			 $df['image']		 = $hero_settings['image'];			
			 }elseif(!in_array($hero_settings['section_bg'],array("","none"))){
			 $df['image']		 = "";			
			 }
			 $df['btn_show'] 		= $hero_settings['btn_show'];
			 $df['btn2_show'] 		= $hero_settings['btn2_show'];
			 $df['searchbox'] 	= $hero_settings['searchbox'];
			 $df['video_show'] 	= $hero_settings['video_show'];
			 $df['image1_show'] = $hero_settings['image1_show'];
		 }
		 
		ob_start();
		
		?> 

<div class="container mt-4">
    <div class="rounded-lg text-light overflow-hidden  position-relative">
        <section>
            <div class="container">
                <?php  _ppt_template( 'framework/design/hero/parts/hero1_content' ); ?>
            </div>
        </section>
    </div>
</div>
 
<?php
$output = ob_get_contents();
ob_end_clean();
echo ppt_theme_block_output($output, $hero_settings, array("hero", "hero4"));
	
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