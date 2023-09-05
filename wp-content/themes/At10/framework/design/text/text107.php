<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text107',  'data') );
add_action( 'text107',  		array('block_text107', 'output' ) );
add_action( 'text107-css',  	array('block_text107', 'css' ) );
add_action( 'text107-js',  	array('block_text107', 'js' ) );

class block_text107 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text107'] = array(
			"name" 		=> "Style 107",
			"image"		=> "text107.jpg",
			"cat"		=> array("text","contact"),
			"desc" 		=> "", 
			"order" 	=> 0, 
			"widget" => "ppt-text",	
			"data" 	=> array( ),	
			
			"defaults" => array( ), 
			
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $text_settings;
	 	
		 
		 $df = array(
		 	"image" => DEMO_IMGS."?fw=text107&t=".THEME_KEY,
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
	 
 
// LOGO
ob_start();
_ppt_template( 'framework/design/parts/contactform' );
$contactform = ob_get_contents();
ob_end_clean();

 
	ob_start();
	
	?>
    
<section class="border-top section-100 ppt-block-text">

  <div class="container ">
  <div class="" ppt-border1>
  <div class="card-body">
    <div class="row y-middle">
    
      <div class="col-lg-6 px-xl-5">
                    
        <span class="fal fa-envelope mb-3 fa-3x text-primary">&nbsp;</span>
        
		<h2 class="mb-3" data-ppt-title>If you like what you see, let's work together.</h2>
        
        <p class="lead mb-4" data-ppt-subtitle>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique.</p>
   
          </div>
      <div class="col-lg-6 text-center">%contactform%</div>
    </div>
</div>
</div>    
  </div>
</section>
  
<?php
 

		$output = ob_get_contents();
		ob_end_clean();
echo str_replace("%contactform%", $contactform,ppt_theme_block_output($output, $text_settings, array("text", "text107")));
	
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
