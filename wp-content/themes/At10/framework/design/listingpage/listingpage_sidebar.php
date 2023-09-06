<?php
 
add_filter( 'ppt_blocks_args', 	array('block_listingpage_sidebar',  'data') );
add_action( 'listingpage_sidebar',  		array('block_listingpage_sidebar', 'output' ) );
add_action( 'listingpage_sidebar-css',  	array('block_listingpage_sidebar', 'css' ) );
add_action( 'listingpage_sidebar-js',  	array('block_listingpage_sidebar', 'js' ) );

class block_listingpage_sidebar {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['listingpage_sidebar'] = array(
			"name" 		=> "Sidebar",
			"image"		=> "listingpage_sidebar.jpg",
			"cat"		=> "listingpage",
			"desc" 		=> "", 
			"order" 	=> 1, 			
			"data" 	=> array( ),			
			"defaults" => array( ),
			 					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $new_settings, $settings;
	 	
		$settings = array( );  
		 
		// ADD ON SYSTEM DEFAULTS
		$settings = $CORE->LAYOUT("get_block_settings_defaults", array("listingpage_sidebar", "listingpage", $settings ) );
	 
		// UPDATE DATA FROM ELEMENTOR OR CHILD THEMES
		if(is_array($new_settings)){
			 foreach($settings as $h => $j){
				if(isset($new_settings[$h]) && $new_settings[$h] != ""){
					$settings[$h] = $new_settings[$h];
				}
			 }
		} 
		 
	 
	ob_start();
	
	 
_ppt_template( 'widgets/single-sidebar' );

	
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;	
	
	}
		public static function css(){
		return "";
		ob_start();
		?>
<?php	
		$output = ob_get_contents();
		ob_end_clean();
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