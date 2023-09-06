<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text147',  'data') );
add_action( 'text147',  		array('block_text147', 'output' ) );
add_action( 'text147-css',  	array('block_text147', 'css' ) );
add_action( 'text147-js',  	array('block_text147', 'js' ) );

class block_text147 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text147'] = array(
			"name" 		=> "Style 147",
			"image"		=> "text147.jpg",
			"cat"		=> array("text","subscribe"),
			"desc" 		=> "", 
			"order" 	=> 0, 
			"widget" => "ppt-text",	
			"data" 	=> array( ),	
			
			"defaults" => array( ), 
			
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $text_settings;
	 	
		 
		 $df = array(
		 	"image" => DEMO_IMGS."?fw=text104&t=",
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
_ppt_template( 'widgets/widget-newsletter-form' );
$newsletter = ob_get_contents();
ob_end_clean();

ob_start();
	
	?>
    
<section>
  <div class="container">
    <div class="row d-flex flex-lg-row-reverse align-items-center">
    
      <div class="col-md-6 text-center text-lg-left">
                    
            <div class="text-md-left mobile-mt-4">
			
	   <h2 class="mb-3" data-ppt-title>Stay Updated</h2>
        <p class="fs-6 mb-5" data-ppt-subtitle>Join our newsletter today!</p>
           
           <div style="max-width:450px;"> %newsletter% </div>
            
            </div>         
			
		 
          </div>
      <div class="col-md-6 pr-lg-5 text-center">
      
      <img data-src="<?php echo $df['image']; ?>" class="img-fluid mobile-mt-4 lazy"  alt="image"  data-ppt-image> 
            
      </div>
    </div>
  </div>
</section>
  
<?php

$output = ob_get_contents();
ob_end_clean();
echo str_replace("%newsletter%", $newsletter , ppt_theme_block_output($output, $text_settings, array("text", "text147")));
	
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
