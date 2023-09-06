<?php
 
add_filter( 'ppt_blocks_args', 	array('block_block_listings',  'data') );
add_action( 'block_listings',  		array('block_block_listings', 'output' ) );
//add_action( 'block_listings-css',  	array('block_block_listings', 'css' ) );
//add_action( 'block_listings-js',  	array('block_block_listings', 'js' ) );

class block_block_listings {

	function __construct(){}		

	public static function data($a){ global $CORE;  
  
		$a['block_listings'] = array(
			"name" 	=> "Listings Block (big)",
			"image"	=> "block_listings.jpg",
			"cat"	=> "block",
			"order" => 0,
			"desc" 	=> "", 
			"data" 	=> array( ),	
			
			"defaults" => array( ),
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $new_settings, $settings;
	
	
		$settings = array( 
					
				"datastring" => "custom=new",
				 
		 );  
	 
		// ADD ON SYSTEM DEFAULTS
		 $settings =  $CORE->LAYOUT("get_block_settings_defaults_new", array("listings", "listings102" ) );
 
		// UPDATE DATA FROM ELEMENTOR OR CHILD THEMES
		if(is_array($new_settings)){
			 foreach($settings as $h => $j){
				if(isset($new_settings[$h]) && $new_settings[$h] != ""){
					$settings[$h] = $new_settings[$h];
				}
			 }
		} 
		 
	
		if($settings['perrow'] == ""){ $settings['perrow'] = 3; }		
		if($settings['card'] == ""){ $settings['card'] = "list"; }
		if($settings['show'] == ""){ $settings['show'] = "10"; }  
		 
 
$output = do_shortcode('[LISTINGS nav=0 small=1 show="'.$settings['show'].'" order="'.$settings['order'].'" custom="'.$settings['custom'].'" orderby="'.$settings['orderby'].'" card="'.$settings['card'].'" perrow="'.$settings['perrow'].'"  ]');		
	
 
		echo $output;	
	
	}
	
		public static function js(){
		return "";
		ob_start();
		?>
<?php	
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;
		 }	
}

?>