<?php
 
add_filter( 'ppt_blocks_args', 	array('block_listings3',  'data') );
add_action( 'listings3',  		array('block_listings3', 'output' ) );
add_action( 'listings3-css',  		array('block_listings3', 'css' ) );
add_action( 'listings3-js',  		array('block_listings3', 'js' ) );

class block_listings3 {

	function __construct(){}		

	public static function data($a){ global $CORE; 
  
		$a['listings3'] = array(
			"name" 	=> "Unstyled Carousel",
			"image"	=> "listings3.jpg",
			"cat"	=> "listings",
			"order" => 3,
			"desc" 	=> "", 
			"widget"	=> "ppt-listings",
			"data" 	=> array( ), 
			"defaults" => array( ), 
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $listing_settings, $settings; 
	
		 
		// ADD ON SYSTEM DEFAULTS
		$settings = $CORE->LAYOUT("get_block_settings_defaults_new", array("listings", "listings3" ) ); 
	 
		// UPDATE DATA FROM ELEMENTOR OR CHILD THEMES
		if(is_array($listing_settings)){
		
			 foreach($settings as $h => $j){
				if(isset($listing_settings[$h]) && $listing_settings[$h] != ""){
					$settings[$h] = $listing_settings[$h];
				}
			 }
			 
		}
 
 
 

if(isset($settings['perrow']) && $settings['perrow'] =="" || !isset($settings['perrow'])){
$settings['perrow'] = 4;
$settings['show'] = 4;
}


$data = do_shortcode('[LISTINGS nav=0 carousel=1 small=1 show="'.$settings['show'].'" order="'.$settings['order'].'" custom="'.$settings['custom'].'" orderby="'.$settings['orderby'].'" card="'.$settings['card'].'" perrow="'.$settings['perrow'].'"  ]');	

if($settings['show'] < 5){
$data = str_replace("mb-4","",$data);
}

 
ob_start(); ?>
<section class="section-20"><div class="container"><div  class="owl-carousel owl-theme" data-1000="4" data-600="4" data-1200="4">%data%</div> </div></section>
<?php $output = ob_get_contents();
ob_end_clean();
echo str_replace("%data%", $data, ppt_theme_block_output($output, $listing_settings, array("listings", "listings3")));
	
	}
	
		public static function js(){
		return "";
		}	
		 
		public static function css(){
		return "";
		 }	
}

?>