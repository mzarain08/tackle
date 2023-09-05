<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text159',  'data') );
add_action( 'text159',  		array('block_text159', 'output' ) );
add_action( 'text159-css',  	array('block_text159', 'css' ) );
add_action( 'text159-js',  	array('block_text159', 'js' ) );

class block_text159 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text159'] = array(
			"name" 		=> "Style 159",
			"image"		=> "text159.jpg",
			"cat"		=> array("text","contact"),
			"desc" 		=> "", 
			"order" 	=> 0, 
			"widget" => "ppt-text",	
			"data" 	=> array( ),	
			
			"defaults" => array( ), 
			
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $text_settings;
	 	
		 
		 // ALL DEFAULT FIELDS
		 $df = ppt_theme_blocks_defaults("text"); 
		  
		$cc = array( );
		
		$df = array_merge($df, $cc);
		
		// APPLY ELEMENTOR
		if(!empty($text_settings)){
			foreach($df as $k => $v){				
				if(isset($text_settings[$k]) && $text_settings[$k] != "" ){
					$df[$k] = $text_settings[$k];
				}
			}		
		}   
 

 
// LOGO
ob_start();
_ppt_template( 'framework/design/parts/contactform' );
$cc = ob_get_contents();
ob_end_clean();

 
ob_start();
?> 
<section class="section-60">
  <div class="container">
    <div class="row d-flex align-items-center">
      <div class="col-md-7 pl-lg-5 text-center mobile-mb-2">
      
      %cc%
         </div>
      </div>
      <div class="col-md-5 pl-xl-5">
      
        <h6 class="mb-3 text-uppercase text-primary" data-ppt-desc>Let's talk</h6>
        
        <h2 class="mb-3" data-ppt-title>Got any questions? Don't hesitate to
          get in touch.</h2>
          
        <p class="lead mb-4" data-ppt-subtitle>Lorem ipsum dolor sit amet, consectetur
          adipiscing elit.</p>
          
        <div class="d-flex flex-row">
          <div>
            <span class="fa fa-map-marker text-primary mr-4"></span>
          </div>
          <div>
            <h5 class="mb-1" data-ppt-f1a>Address</h5>
            <p data-ppt-f1b>Buckingham Palace, London.</p>
          </div>
        </div>
        <div class="d-flex flex-row">
          <div>
            <span class="fa fa-phone-alt text-primary mr-4"></span>
          </div>
          <div>
            <h5 class="mb-1" data-ppt-f2a>Phone</h5>
            <p data-ppt-f2b>+44 (123) 456 78 90</p>
          </div>
        </div>
        <div class="d-flex flex-row">
          <div>
            <span class="fa fa-envelope text-primary mr-4"></span>
          </div>
          <div>
            <h5 class="mb-1" data-ppt-f3a>Email</h5>
            <p data-ppt-f3b>email@mywebsite.com</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php
$output = ob_get_contents();
ob_end_clean();
 
echo str_replace("%cc%", $cc, ppt_theme_block_output($output, $text_settings, array("text", "text159")));


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