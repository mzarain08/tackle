<?php
 
add_filter( 'ppt_blocks_args', 	array('block_block_listings_carousel',  'data') );
add_action( 'block_listings_carousel',  		array('block_block_listings_carousel', 'output' ) );
//add_action( 'block_listings_carousel-css',  		array('block_block_listings_carousel', 'css' ) );
//add_action( 'block_listings_carousel-js',  		array('block_block_listings_carousel', 'js' ) );

class block_block_listings_carousel {

	function __construct(){}		

	public static function data($a){ global $CORE; 
  
		$a['block_listings_carousel'] = array(
			"name" 	=> "Listings Block (carousel)",
			"image"	=> "block_listings_carousel.jpg",
			"cat"	=> "block",
			"order" => 3,
			"desc" 	=> "", 
			"data" 	=> array( ),	
			
			"defaults" => array(
					
 
					/* block_listings_carousel */    
    
					"datastring"  => " dataonly='1' cat='' card='info' perrow='' show='' custom='new' customvalue='' order='desc' orderby='date' debug='0' ",     
					"perrow"  => "",     
					"card"  => "info",     
					"limit"  => "",     
					"custom"  => "new", 		
					 
			),
			
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $new_settings, $settings;
	
	
		$settings = array(
				  
				"datastring" => "custom=new num=12",
				 
		 );  
	 
		// ADD ON SYSTEM DEFAULTS
		$settings = $CORE->LAYOUT("get_block_settings_defaults_new", array("listings", "listings99" ) ); 

		// UPDATE DATA FROM ELEMENTOR OR CHILD THEMES
		if(is_array($new_settings)){
			 foreach($settings as $h => $j){
				if(isset($new_settings[$h]) && $new_settings[$h] != ""){
					$settings[$h] = $new_settings[$h];
				}
			 }
		} 
 
	ob_start();
	
	 
if(isset($settings['perrow']) && $settings['perrow'] =="" || !isset($settings['perrow'])){
$settings['perrow'] = 4;
}
if(isset($settings['show']) && $settings['show'] =="" || !isset($settings['show'])){
$settings['show'] = 4;
}
 
	
	
$data = do_shortcode('[LISTINGS nav=0 small=1 show="'.$settings['show'].'" order="'.$settings['order'].'" custom="'.$settings['custom'].'" orderby="'.$settings['orderby'].'" card="'.$settings['card'].'" perrow="'.$settings['perrow'].'"  ]');	
	
// class="owl-carousel owl-theme"

if(isset($_GET['ppt_live_preview'])){

echo str_replace("data-src","src",$data);

}else{ ?>

<div><?php echo $data; ?></div><?php

} ?></div><?php
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;	
	
	}
	
		public static function js(){
		
		ob_start();
		?>
<?php	
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;
		 }	
}

?>