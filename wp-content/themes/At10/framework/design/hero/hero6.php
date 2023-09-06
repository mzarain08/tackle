<?php
 
add_filter( 'ppt_blocks_args',  array('block_hero6',  'data') );
add_action( 'hero6',  			array('block_hero6', 'output' ) );
add_action( 'hero6-css',  		array('block_hero6', 'css' ) );
add_action( 'hero6-js',  		array('block_hero6', 'js' ) );

class block_hero6 {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['hero6'] = array(
			"name" 	=> "Hero 6",
			"image"	=> "hero6.jpg",
			"cat"	=> "hero",
			"widget" => "ppt-hero",			
			"order" => 1.5,
			"desc" 	=> "", 
			"data" 	=> array( ),
			"defaults" => array(),
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $settings, $hero_settings;	
	    
		 $df = array(
		 	"image" => DEMO_IMGS."?fw=hero6&t=".THEME_KEY,
			"btn_show" => 1,
			"btn2_show" => 0,		 
		 );
		 
		 $blockdata = array();
		 if(is_array($hero_settings) && !empty($hero_settings)){		 	
			 if(strlen($hero_settings['image']) > 1){
			 $image = $hero_settings['image'];
			 }
			 $df['btn_show'] = $hero_settings['btn_show'];
			 $df['btn2_show'] = $hero_settings['btn2_show'];
		 } 
		ob_start();
		
		?>


 
 
<section class="pt-5 bg-secondary">

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-7 text-center mt-md-4">
     
      <h1 class="mb-3 text-light" data-ppt-title>We're here to help.</h1>
        
        <p class="lead text-light" data-ppt-subtitle>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue.</p>
     
    </div>
    <div class="col-md-10 mx-auto text-center my-5">
      <div class="bg-white p-4 rounded shadow">
        <?php _ppt_template( 'framework/design/parts/search-inline' ); ?>
      </div>
    </div>
  </div>
</div>

</section>
 
<?php
$output = ob_get_contents();
ob_end_clean();
echo ppt_theme_block_output($output, $hero_settings, array("hero", "hero6"));
	
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