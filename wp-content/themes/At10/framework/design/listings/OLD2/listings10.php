<?php
 
add_filter( 'ppt_blocks_args',  	array('block_listings10',  'data') );
add_action( 'listings10',  	array('block_listings10', 'output' ) );
add_action( 'listings10-css',  array('block_listings10', 'css' ) );
add_action( 'listings10-js',  	array('block_listings10', 'js' ) );

class block_listings10 {

	function __construct(){}		

	public static function data($a){ global $CORE;  
	
		global $CORE;
  
		$a['listings10'] = array(
			"name" 	=> "Search Results + Sidebar",
			"image"	=> "listings10.jpg",
			"cat"	=> "listings",
			"desc" 	=> "",
			"order" => 10, 
			"data" 	=> array( ),
			
			// HIDE VALUES
			"hide-title" 	=> true,
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $settings, $new_settings;
	
	
        $settings = array( );
		  
		// ADD ON SYSTEM DEFAULTS
		$settings = $CORE->LAYOUT("get_block_settings_defaults", array("listings10", "listings", $settings ) );
 	  
		 // UPDATE DATA FROM ELEMENTOR OR CHILD THEMES
		 if(is_array($new_settings)){
			 foreach($settings as $h => $j){
				if(isset($new_settings[$h]) && $new_settings[$h] != ""){
					$settings[$h] = $new_settings[$h];
				}
			 }
		 }  
  
 		
		ob_start();
		
		
		$GLOBALS['flag-show-sidebar'] = 1;
		
		?>
<?php  _ppt_template( 'search' ); ?>

 

<?php $output = ob_get_contents();
		ob_end_clean();
		echo $output;	
	
	}
	public static function js(){ global $CORE;
	
		ob_start();
		?>
 
<?php
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;	
	
	}		
	public static function css(){ global $CORE;
		ob_start();
		?>
<?php
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;	
	
	}	
	
}

?>
