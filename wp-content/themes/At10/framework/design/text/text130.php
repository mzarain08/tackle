<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text130',  'data') );
add_action( 'text130',  		array('block_text130', 'output' ) );
add_action( 'text130-css',  	array('block_text130', 'css' ) );
add_action( 'text130-js',  	array('block_text130', 'js' ) );

class block_text130 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text130'] = array(
			"name" 		=> "Style 130",
			"image"		=> "text130.jpg",
			"cat"		=> array("text","icon"),
			"desc" 		=> "", 
			"order" 	=> 0, 
			"widget" => "ppt-text",	
			"data" 	=> array( ),	
			
			"defaults" => array( ), 
			
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE,$CORE_UI, $text_settings;
	 	
		 
		 $df = array(
		 	"image" => DEMO_IMGS."?fw=text130&t=".THEME_KEY,
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
    

    
<section class="section-60 ppt-block-text">

  <div class="container">
  
<div ppt-border1 class="p-4">
<?php _ppt_template( 'framework/design/widgets/icon64_3_text' );  ?>
</div>
 
  </div>
 
</section>
 
  
<?php
 

		$output = ob_get_contents();
		ob_end_clean();
echo ppt_theme_block_output($output, $text_settings, array("text", "text130"));
	
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
