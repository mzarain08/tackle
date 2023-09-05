<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text149',  'data') );
add_action( 'text149',  		array('block_text149', 'output' ) );
add_action( 'text149-css',  	array('block_text149', 'css' ) );
add_action( 'text149-js',  	array('block_text149', 'js' ) );

class block_text149 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text149'] = array(
			"name" 		=> "Style 149",
			"image"		=> "text149.jpg",
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
		 	"image" => DEMO_IMGS."?fw=subscribe&t=".THEME_KEY,
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
    
<section class="position-relative section-60">

  <div class="container py-md-5 position-relative shadow rounded-lg overflow-hidden">
  
    <div class="row d-flex align-items-center position-relative  z-10">
    
      <div class="col-md-5 pl-xl-5 text-center text-lg-left">
                    
            <div class="text-md-left mobile-mt-4 ">
			
	   <h2 class="mb-3" data-ppt-title>Stay Updated</h2>
        <p class="fs-6 mb-5 text-600" data-ppt-subtitle>Join our newsletter today!</p>
           
        %newsletter%
            
            </div>     
		 
          </div>
      <div class="col-md-7 pr-lg-5 text-center">
            
      </div>
    </div>
      <div class="bg-image" style="background-image:url('<?php echo $df['image']; ?>');" data-ppt-image-bg>&nbsp;</div> 
  </div>
  
  

</section>
  
<?php

$output = ob_get_contents();
ob_end_clean();
echo str_replace("%newsletter%", $newsletter, ppt_theme_block_output($output, $text_settings, array("text", "text149")));
	
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
