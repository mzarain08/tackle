<?php
 
add_filter( 'ppt_blocks_args',  array('block_hero2',  'data') );
add_action( 'hero2',  			array('block_hero2', 'output' ) );
add_action( 'hero2-css',  		array('block_hero2', 'css' ) );
add_action( 'hero2-js',  		array('block_hero2', 'js' ) );

class block_hero2 {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['hero2'] = array(
			"name" 	=> "Hero 2",
			"image"	=> "hero2.jpg",
			"cat"	=> "hero",
			"widget" => "ppt-hero",			
			"order" => 1.2,
			"desc" 	=> "", 
			"data" 	=> array( ),
			"defaults" => array(),
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $settings, $hero_settings, $df;	
	    
		
		$df = ppt_theme_blocks_defaults("hero"); 
		
		 $cc = array(
		 	"image" => DEMO_IMGS."?fw=hero2&t=".THEME_KEY,
			"image1" => DEMO_IMGS."?fw=hero5&t=".THEME_KEY,
			"btn_show" => 1,
			"btn2_show" => 1,	
			"searchbox" => 0,				
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
		 	$settings =  $CORE->LAYOUT("get_block_settings_defaults_new", array("hero", "hero2" ) );
		 	foreach($df as $h => $j){
				if(isset($settings[$h]) && $settings[$h] != ""){
					$df[$h] = $settings[$h];
				}
			 } 
		} 
		 
		 
		 
		ob_start();
		
		?> 


<header class="elementor_header header7 bg-white b-bottom ppt-fixed-header" >
  <?php _ppt_template( 'framework/design/header/parts/header-topmenu' ); ?>  
  <nav class="elementor_mainmenu navbar navbar-light navbar-expand-lg logo-lg">
    <div class="container">
    
    <a class="navbar-brand" href="<?php echo home_url(); ?>"> <?php echo $CORE->LAYOUT("get_logo","light");  ?> <?php echo $CORE->LAYOUT("get_logo","dark");  ?> </a>
      
      
        <nav ppt-nav ppt-flex-end class="seperator spacing hide-mobile hide-ipad text-600">  
    
    <?php echo do_shortcode('[MAINMENU style=1]');  ?>   
    
    </nav> 
      
      
      <button class="navbar-toggler menu-toggle tm border-0"><span class="fal fa-bars">&nbsp;</span></button>  
    </div>
  </nav>
</header>

<section class="position-relative section-60  mobile-pt-4" <?php if($df['section_overlay'] == ""){ ?>data-overlay="gradient-left"<?php } ?> data-fullpage="1">

 
<?php  _ppt_template( 'framework/design/hero/parts/hero1_content' ); ?>
 
</section>
<?php
$output = ob_get_contents();
ob_end_clean();
echo ppt_theme_block_output($output, $hero_settings, array("hero", "hero2"));
	
	}
	public static function css(){ global $CORE;
ob_start();?>
<style>
  
[data-fullpage]{background-position:center;background-size:cover;background-repeat:no-repeat;margin:0;overflow:hidden}
@media (min-width:600px){
[data-fullpage]{height:100vh;}
}
@media (min-width: 600px){
	[data-fullpage] ._contents {
		top: 25%;
	}
}
</style>
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