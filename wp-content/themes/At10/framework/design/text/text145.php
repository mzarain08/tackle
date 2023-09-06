<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text145',  'data') );
add_action( 'text145',  		array('block_text145', 'output' ) );
add_action( 'text145-css',  	array('block_text145', 'css' ) );
add_action( 'text145-js',  	array('block_text145', 'js' ) );

class block_text145 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text145'] = array(
			"name" 		=> "Style 145",
			"image"		=> "text145.jpg",
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
		 
			"btn1" => 0,
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
	
	// BLOCK WRAP
	 
	?><section class="section-40">
<div class="container">

<div class="row padding-top">

            <div class="col-lg-6">
            
                <div class="text-primary text-700 mb-2" data-ppt-title>About Our Company</div>
                
                <h2 class="pr-lg-5" data-ppt-subtitle>Welcome to intro paragragh for some more info about our comapny. </h2>
                
            </div>
            <div class="col-lg-6 d-flex align-items-center lh-30">
                <div data-ppt-desc>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sodales lobortis vehicula. Aliquam sodales turpis a neque sagittis, condimentum imperdiet risus luctus. Praesent cursus non risus in tempor. Phasellus eu purus sed arcu posuere consequat euismod ac augue. Morbi venenatis dictum consequat. Phasellus eu purus sed arcu posuere consequat euismod ac augue. Morbi venenatis dictum consequat.
                </div>
            </div>
        </div> 
</div>
</section> 
<?php


		$output = ob_get_contents();
		ob_end_clean();
echo ppt_theme_block_output($output, $text_settings, array("text", "text145") );
	
	}
		public static function css(){

		ob_start();
		?>
<style>
 
</style>
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
