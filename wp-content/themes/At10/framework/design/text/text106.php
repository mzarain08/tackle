<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text106',  'data') );
add_action( 'text106',  		array('block_text106', 'output' ) );
add_action( 'text106-css',  	array('block_text106', 'css' ) );
add_action( 'text106-js',  	array('block_text106', 'js' ) );

class block_text106 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text106'] = array(
			"name" 		=> "Style 106",
			"image"		=> "text106.jpg",
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
		 	"image" => DEMO_IMGS."?fw=text106&t=".THEME_KEY,
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
    
<section class="border-top section-60 ppt-block-text">
  <div class="container">
  
    <div class="row d-flex align-items-center">
    
    
        <div class="col-md-7 pr-lg-5 text-center mobile-mb-2">
            <img data-src="<?php echo $df['image']; ?>" class="img-fluid lazy"  alt="image"  data-ppt-image> 
            
      </div>
    
      <div class="col-md-5 pl-xl-5">
                    
       
			
            <h6 class="mb-3 text-uppercase text-primary" data-ppt-desc>Let's talk</h6>
            
		<h2 class="mb-3" data-ppt-title>Got any questions? Don't hesitate to get in touch.</h2>
        
        <p class="lead mb-4" data-ppt-subtitle>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        
          
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
echo ppt_theme_block_output($output, $text_settings, array("text", "text106"));
	
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
