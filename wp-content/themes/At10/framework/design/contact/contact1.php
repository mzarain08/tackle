<?php
 
add_filter( 'ppt_blocks_args', 	array('block_contact1',  'data') );
add_action( 'contact1',  		array('block_contact1', 'output' ) );
add_action( 'contact1-css',  	array('block_contact1', 'css' ) );
add_action( 'contact1-js',  	array('block_contact1', 'js' ) );

class block_contact1 {

	function __construct(){ }
 
	public static function data($a){ 
 
		$a['contact1'] = array(
			"name" 	=> "Unstyled Contact Form",
			"image"	=> "contact1.jpg",
			"cat"	=> "contact",
			"desc" 	=> "", 
			"widget" => "ppt-contact",	
			"data" 	=> array( ),
			"order" => 1,	
			"defaults" => array( ),
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $new_settings, $settings;
	
	
		$settings = array( );   
 

	ob_start();
	_ppt_template( 'framework/design/parts/contactform' );
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