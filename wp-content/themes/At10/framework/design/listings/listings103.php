<?php
 
add_filter( 'ppt_blocks_args', 	array('block_listings103',  'data') );
add_action( 'listings103',  		array('block_listings103', 'output' ) );
add_action( 'listings103-css',  		array('block_listings103', 'css' ) );
add_action( 'listings103-js',  		array('block_listings103', 'js' ) );

class block_listings103 {

	function __construct(){}		

	public static function data($a){ global $CORE; 
  
		$a['listings103'] = array(
			"name" 	=> "Style 103",
			"image"	=> "listings103.jpg",
			"cat"	=> "listings",
			"order" => 103,
			"desc" 	=> "", 
			"widget"	=> "ppt-listings",
			"data" 	=> array( ),	
			
			"defaults" => array( ),
			
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $listing_settings, $settings; 
	
		 $GLOBALS['flag-show-sidebar'] = 1; 
		 $GLOBALS['flag-show-sidebar-search'] = 1;
		 $GLOBALS['flag-hide-search-top'] = 1;
		 
		unset($GLOBALS['flag-home']);
		$GLOBALS['flag-search'] = 1;
 	    $GLOBALS['flag-elementor'] = 1;
		 
		_ppt_template( 'search' );
		 
	
	}
	
		public static function js(){
		return "";
		}	
		 
		public static function css(){
		return "";
		 }	
}

?>