<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text104',  'data') );
add_action( 'text104',  		array('block_text104', 'output' ) );
add_action( 'text104-css',  	array('block_text104', 'css' ) );
add_action( 'text104-js',  	array('block_text104', 'js' ) );

class block_text104 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text104'] = array(
			"name" 		=> "Style 104",
			"image"		=> "text104.jpg",
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
		 	"image" => DEMO_IMGS."?fw=text104&t=".THEME_KEY,
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
    
<section class="border-top section-top-60 ppt-block-text bg-white">
  <div class="container">
    <div class="row d-flex flex-lg-row-reverse y-middle">
      <div class="col-md-5 pl-xl-5 text-center text-lg-left">
                    
            <div class="text-md-left mobile-mt-4">
			
		    <h2 class="mb-5" data-ppt-title>Quick to install and setup - get started today!</h2>
        <p class="text-500 mb-5" data-ppt-subtitle>Lorem ipsum dolor sit amet,
          consectetur adipiscing elit. Praesent tempus eleifend risus ut congue.
          Pellentesque nec lacus elit.</p>
          
            <?php if($df['btn1']){ ?>
        <a href="<?php echo wp_login_url(); ?>" class="btn-ppt  font- btn-lg btn-primary  mt-2" data-ppt-btn data-ppt-btn-txt>Get Started Now!</a> 
        <?php } ?>
            
            </div>         
			
		 
          </div>
      <div class="col-md-7 pr-lg-5 text-center">
            <img data-src="<?php echo $df['image']; ?>" class="img-fluid mobile-mt-4 lazy"  alt="image"  data-ppt-image> 
            
      </div>
    </div>
  </div>
</section>
  
<?php

$output = ob_get_contents();
ob_end_clean();
echo ppt_theme_block_output($output, $text_settings, array("text", "text104"));
	
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
