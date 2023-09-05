<?php
 
add_filter( 'ppt_blocks_args', 	array('block_subscribe1',  'data') );
add_action( 'subscribe1',  		array('block_subscribe1', 'output' ) );
add_action( 'subscribe1-css',  	array('block_subscribe1', 'css' ) );
add_action( 'subscribe1-js',  	array('block_subscribe1', 'js' ) );

class block_subscribe1 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['subscribe1'] = array(
			"name" 		=> "Blank Subscribe Form",
			"image"		=> "subscribe1.jpg",
			"cat"		=> "subscribe",
			"order" 	=> "1", 
			"widget" => "ppt-newsletter",	
			"desc" 		=> "", 
			"data" 		=> array( ),
			
			
			"defaults" => array(),
						
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $new_settings, $settings;
	 
	ob_start();
	_ppt_template( 'widgets/widget-newsletter-form' );
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;	
	
	}
		public static function css(){
		ob_start();	
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