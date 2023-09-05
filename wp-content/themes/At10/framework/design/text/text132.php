<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text132',  'data') );
add_action( 'text132',  		array('block_text132', 'output' ) );
add_action( 'text132-css',  	array('block_text132', 'css' ) );
add_action( 'text132-js',  	array('block_text132', 'js' ) );

class block_text132 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text132'] = array(
			"name" 		=> "Style 132",
			"image"		=> "text132.jpg",
			"cat"		=> array("text"),
			"desc" 		=> "", 
			"order" 	=> 0, 
			"widget" => "ppt-text",	
			"data" 	=> array( ),	
			
			"defaults" => array( ), 
			
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE,$CORE_UI, $text_settings;
	 	
		 
		 $df = array(
		 	"image" => DEMO_IMGS."?fw=text132&t=".THEME_KEY,
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
    

<section>
<div class="container">

<h2 class="fs-lg text-700" data-ppt-title>Ready Made<br> Website Designs</h2>

<div class="text-600"  data-ppt-subtitle> All designs included. </div>

</div>
</section>
<?php
 

$output = ob_get_contents();
ob_end_clean();
echo ppt_theme_block_output($output, $text_settings, array("text", "text132"));
	
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
