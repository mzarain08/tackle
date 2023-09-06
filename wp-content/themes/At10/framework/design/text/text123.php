<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text123',  'data') );
add_action( 'text123',  		array('block_text123', 'output' ) );
add_action( 'text123-css',  	array('block_text123', 'css' ) );
add_action( 'text123-js',  	array('block_text123', 'js' ) );

class block_text123 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text123'] = array(
			"name" 		=> "Style 123",
			"image"		=> "text123.jpg",
			"cat"		=> array("text","icons"),
			"desc" 		=> "", 
			"order" 	=> 0, 
			"widget" => "ppt-text",	
			"data" 	=> array( ),	
			
			"defaults" => array( ), 
			
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $text_settings;
	 	
		 
		 $df = array(
		 	"image" => DEMO_IMGS."?fw=text100&t=".THEME_KEY,
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

<section class="section-60 ">
  <div class="container">
    <div class="row">
      <div class="container">
        <div class="row">
          
          
          <div class="col-lg-7 align-middle text-left pr-lg-5">
          
            <div class="text-md-left">
            
              <h2 data-ppt-title>Why Choose Us</h2>
              
              <p data-ppt-subtitle>Here's why lots of people choose our website.</p>
              
            </div>
            
            <div class="mt-5">
              <div class="mb-4 clearfix w-100 d-flex">
                <div class="numtxt mr-5">
                  01
                </div>
                <div>
                <h4 data-ppt-f1a> Create Profile </h4>
                <p class="opacity-5 faq-subtxt mt-2" data-ppt-f1b>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique.</p>
             </div>
              </div>
              <div class="mb-4 clearfix w-100 d-flex">
                <div class="numtxt mr-5"> 02 </div>
                <div>
                <h4 data-ppt-f2a> Find Match </h4>
                <p class="opacity-5 faq-subtxt mt-2" data-ppt-f2b>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique.</p>
             	</div>
              </div>
              <div class="mb-4 clearfix w-100 d-flex">
                <div class="numtxt mr-5">03 </div>
                <div>
                <div>
                <h4 data-ppt-f3a>Make Connection </h4>
                <p class="opacity-5 faq-subtxt mt-2" data-ppt-f3b>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique.</p>
              	</div>
                </div>
              </div>
            </div>
          </div>
          
          
             <div class="col-lg-5 text-center m-b-md mobile-mb-4">
          
           <figure><img data-src="<?php echo $df['image']; ?>" class="lazy text123img rounded-lg"  alt="image" data-ppt-image></figure>
     
          </div>
          
        </div>
        
        
        
        
      </div>
    </div>
  </div>
</section>
<?php

$output = ob_get_contents();
ob_end_clean();
echo ppt_theme_block_output($output, $text_settings, array("text", "text123"));
	
	}
		public static function css(){
		ob_start();
?>
<style>
.numtxt {
    font-weight: 700;
    font-style: italic;
    font-family: Lora, serif;
    opacity: 0.8;
    font-size: 60px;
    line-height: 1;
    letter-spacing: 1px;
    padding-bottom: 80px;
}
 @media (max-width: 575.98px){
.numtxt {   font-size: 40px !important;   }
.faq-subtxt { font-size:12px; }   
.text123img { max-width:100%; }
}
 
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