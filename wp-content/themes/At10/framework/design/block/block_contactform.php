<?php
 
add_filter( 'ppt_blocks_args', 	array('block_block_contactform',  'data') );
add_action( 'block_contactform',  		array('block_block_contactform', 'output' ) );
add_action( 'block_contactform-css',  	array('block_block_contactform', 'css' ) );
add_action( 'block_contactform-js',  	array('block_block_contactform', 'js' ) );

class block_block_contactform {

	function __construct(){ }
 
	public static function data($a){ 
 
		$a['block_contactform'] = array(
			"name" 	=> "Contact Form",
			"image"	=> "block_contactform.jpg",
			"cat"	=> "block",
			"desc" 	=> "", 
			"data" 	=> array( ),
			"order" => 6,	
			
			"defaults" => array(  ),
			
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $new_settings, $settings;
	
	
		$settings = array( );  
	  
		// ADD ON SYSTEM DEFAULTS
		$settings = $CORE->LAYOUT("get_block_settings_defaults", array("block_contactform", "block", $settings ) ); 

		// UPDATE DATA FROM ELEMENTOR OR CHILD THEMES
		if(is_array($new_settings)){
			 foreach($settings as $h => $j){
				if(isset($new_settings[$h]) && $new_settings[$h] != ""){
					$settings[$h] = $new_settings[$h];
				}
			 }
		}  
	 
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