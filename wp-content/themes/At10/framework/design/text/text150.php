<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text150',  'data') );
add_action( 'text150',  		array('block_text150', 'output' ) );
add_action( 'text150-css',  	array('block_text150', 'css' ) );
add_action( 'text150-js',  	array('block_text150', 'js' ) );

class block_text150 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text150'] = array(
			"name" 		=> "Style 122",
			"image"		=> "text150.jpg",
			"cat"		=> "text",
			"desc" 		=> "", 
			"order" 	=> 0, 
			"widget" => "ppt-text",	
			"data" 	=> array( ),	
			
			"defaults" => array( ), 
			
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $text_settings;
	 	
		 
		 $df = array(
		 	"image" => DEMO_IMGS."?fw=text150&t=".THEME_KEY,
			"btn1" => 1,
			"btn2" => 0,		 
		 );
		 if(is_array($text_settings) && !empty($text_settings)){		 	
			 if(strlen($text_settings['image']) > 1){
			 $df['image'] = $text_settings['image'];			
			 }
			 $df['btn1'] = $text_settings['btn_show'];
			 $df['btn2'] = $text_settings['btn2_show'];
		 }
	 
 
	ob_start();
	
	?>
<section class="section-60">
  <div class="container">
     
    
    <h1 data-ppt-title>Privacy and Legal</h1>
    
    <div class="fs-md text-600 mb-4"  data-ppt-subtitle>General</div>
    
    <p  data-ppt-desc>Please read these Terms carefully before using this Website. By accessing, browsing, or using this Website, you acknowledge that you have read, understood, and agree to be bound by these Terms of Use. If you do not accept these Terms of Use, do not use the Website.</p>

 
    
    
    
  
  </div>
</section>
<?php

$output = ob_get_contents();
ob_end_clean();
echo ppt_theme_block_output($output, $text_settings, array("text", "text150"));
	
	}
		public static function css(){
return "";
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