<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text119',  'data') );
add_action( 'text119',  		array('block_text119', 'output' ) );
add_action( 'text119-css',  	array('block_text119', 'css' ) );
add_action( 'text119-js',  	array('block_text119', 'js' ) );

class block_text119 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text119'] = array(
			"name" 		=> "Style 119",
			"image"		=> "text119.jpg",
			"cat"		=> array("text","cta"),
			"desc" 		=> "", 
			"order" 	=> 0, 
			"widget" => "ppt-text",	
			"data" 	=> array( ),	
			
			"defaults" => array( ), 
			
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $text_settings;
	 	 
		 $df = array(
		 	"image" => DEMO_IMGS."?fw=text119&t=".THEME_KEY,
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
	 
	?>

<section class="section-60">
 
  <div class="container">
  
    <div class="row py-5 border rounded bg-primary text-light">
    
      <div class="col-xl-10 mx-auto"> 
        
          <div class="p-6 p-md-11 d-lg-flex flex-row align-items-lg-center justify-content-md-between text-center text-lg-left ">
          
          	<div>
            <h2 class="h3 text-light mb-4 mb-lg-0" data-ppt-title>Build your own website using our Premium WordPress themes. Join the PremiumPress family today!</h2>
            </div>
            
            <div style="min-width:150px;">
            
            <a href="<?php echo wp_login_url(); ?>" class="btn-system btn-lg btn-block mobile-mt-4" data-ppt-btn data-ppt-btn-txt>Join Us</a>
            
            </div>
          </div>
      
     
      </div>
 
    </div>
 
  </div> 

</section>
<?php


		$output = ob_get_contents();
		ob_end_clean();
echo ppt_theme_block_output($output, $text_settings, array("text", "text119") );
	
	}
		public static function css(){

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
