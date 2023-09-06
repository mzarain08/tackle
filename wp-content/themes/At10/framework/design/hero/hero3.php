<?php
 
add_filter( 'ppt_blocks_args',  array('block_hero3',  'data') );
add_action( 'hero3',  			array('block_hero3', 'output' ) );
add_action( 'hero3-css',  		array('block_hero3', 'css' ) );
add_action( 'hero3-js',  		array('block_hero3', 'js' ) );

class block_hero3 {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['hero3'] = array(
			"name" 	=> "Hero 3",
			"image"	=> "hero3.jpg",
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
		 	"image" => DEMO_IMGS."?fw=hero3&t=".THEME_KEY,
			"image1" => DEMO_IMGS."?fw=hero5&t=".THEME_KEY,
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
		 }else{		 
		 	$settings =  $CORE->LAYOUT("get_block_settings_defaults_new", array("hero", "hero3" ) );
		 	foreach($df as $h => $j){
				if(isset($settings[$h]) && $settings[$h] != ""){
					$df[$h] = $settings[$h];
				}
			 } 
		 }
		 
		ob_start();
		
		?>




<header class="elementor_header bg-white b-bottom ppt-fixed-header">
  <?php _ppt_template( 'framework/design/header/parts/header-topmenu' ); ?>  
  <nav class="elementor_mainmenu navbar navbar-light navbar-expand-lg">
    <div class="container"> 
    
    <a class="navbar-brand" href="<?php echo home_url(); ?>"> <?php echo $CORE->LAYOUT("get_logo","light");  ?> <?php echo $CORE->LAYOUT("get_logo","dark");  ?> </a>
    
  <nav ppt-nav ppt-flex-end class="seperator spacing hide-mobile hide-ipad">  
    
    <?php echo do_shortcode('[MAINMENU style=1]');  ?>   
    
    </nav> 
      
      <button class="navbar-toggler menu-toggle tm border-0"><span class="fal fa-bars">&nbsp;</span></button>  
    </div>
  </nav>
</header>

<section class="position-relative section-100" data-overlay="gradient-left">

 
<?php  _ppt_template( 'framework/design/hero/parts/hero1_content' ); ?>
 
</section>
<?php
$output = ob_get_contents();
ob_end_clean();
echo ppt_theme_block_output($output, $hero_settings, array("hero", "hero3"));
	
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