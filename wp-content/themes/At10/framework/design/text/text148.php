<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text148',  'data') );
add_action( 'text148',  		array('block_text148', 'output' ) );
add_action( 'text148-css',  	array('block_text148', 'css' ) );
add_action( 'text148-js',  	array('block_text148', 'js' ) );

class block_text148 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text148'] = array(
			"name" 		=> "Style 148",
			"image"		=> "text148.jpg",
			"cat"		=> array("text","subscribe"),
			"desc" 		=> "", 
			"order" 	=> 148, 
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
    
<section class="position-relative">

  <div class="container z-10 py-md-5 position-relative">
  
    <div class="row d-flex align-items-center ">
    
      <div class="col-md-5 pl-xl-5 text-center text-lg-left">
                    
            <div class="text-md-left mobile-mt-4 ">
			
	   <h2 class="mb-3t" data-ppt-title>Stay Updated</h2>
        <p class="fs-6 mb-5" data-ppt-subtitle>Join our newsletter today!</p>
           
        %newsletter%
            
            </div>         
			
		 
          </div>
      <div class="col-md-7 pr-lg-5 text-center">
            
      </div>
    </div>
  </div>
  
  
  <div class="bg-image" style="background-image:url('<?php echo $df['image']; ?>');" data-ppt-image-bg>&nbsp;</div> 
</section>
  
<?php

$output = ob_get_contents();
ob_end_clean();
echo str_replace("%newsletter%", $newsletter, ppt_theme_block_output($output, $text_settings, array("text", "text148")));
	
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
