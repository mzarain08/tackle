<?php
 
add_filter( 'ppt_blocks_args', 	array('block_block_subscribe',  'data') );
add_action( 'block_subscribe',  		array('block_block_subscribe', 'output' ) );
add_action( 'block_subscribe-css',  	array('block_block_subscribe', 'css' ) );
add_action( 'block_subscribe-js',  	array('block_block_subscribe', 'js' ) );

class block_block_subscribe {

	function __construct(){ }
 
	public static function data($a){ 
 
		$a['block_subscribe'] = array(
			"name" 	=> "Newsletter Form",
			"image"	=> "block_subscribe.jpg",
			"cat"	=> "block",
			"desc" 	=> "", 
			"data" 	=> array( ),
			"order" => 4,	
			
			"defaults" => array(  ),
			
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $new_settings, $settings;
	
	
		$settings = array( );  
	  
		// ADD ON SYSTEM DEFAULTS
		$settings = $CORE->LAYOUT("get_block_settings_defaults", array("block_subscribe", "block", $settings ) ); 

		// UPDATE DATA FROM ELEMENTOR OR CHILD THEMES
		if(is_array($new_settings)){
			 foreach($settings as $h => $j){
				if(isset($new_settings[$h]) && $new_settings[$h] != ""){
					$settings[$h] = $new_settings[$h];
				}
			 }
		}  
	 
	ob_start();
	
	
?>
<div class="subscribe-form">
<?php _ppt_template( 'widgets/widget-newsletter-form' ); ?> 
</div>
<?php
	 
	 
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