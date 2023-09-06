<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text176',  'data') );
add_action( 'text176',  		array('block_text176', 'output' ) );
add_action( 'text176-css',  	array('block_text176', 'css' ) );
add_action( 'text176-js',  	array('block_text176', 'js' ) );

class block_text176 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text176'] = array(
			"name" 		=> "Style 176",
			"image"		=> "text176.jpg",
			"cat"		=> array("text","icon"),
			"desc" 		=> "", 
			"order" 	=> 0, 
			"widget" => "ppt-icon",	
			"data" 	=> array( ),	
			
			"defaults" => array( ), 
			
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $text_settings;
	 	
		 
		 // ALL DEFAULT FIELDS
		 $df = ppt_theme_blocks_defaults("text"); 
		  
		$cc = array(
		 
		 	"image1" =>  DEMO_IMG_PATH."icons/a1.jpg",
			"image2" => DEMO_IMG_PATH."icons/a2.jpg",
			"image3" => DEMO_IMG_PATH."icons/a3.jpg",
			"image4" => DEMO_IMG_PATH."icons/a4.jpg",
			
			"btn1" => 1,
			"btn2" => 0,		 
		 );		
		$df = array_merge($df, $cc);
		 
		// APPLY ELEMENTOR
		if(!empty($text_settings)){
			foreach($df as $k => $v){				
				if(isset($text_settings[$k]) && $text_settings[$k] != "" ){
					$df[$k] = $text_settings[$k];
				}
			}		
		}   
		 
		 
 
	ob_start();
	
	?>

<section class="section-60">
  <div class="container-slim">
 
 
        
<div class="row">

 <div class="col-12">
        <div class="row">
         
        
          <div class="col-md-4 mb-4">
          
            <div class="p-4 shadow bg-white">
            	
                
                <div ppt-flex-between>
                
                <div data-ppt-f1image class=" mb-4"><span class="fal fa-life-ring fa-4x hide-mobile text-primary" data-ppt-f1icon>&nbsp;</span></div>
                
                <div class="fs-xl text-700 text-light">01</div>
                
                </div>
                
                <h5 class="mb-4" data-ppt-f1a>24/7 Support</h5>
                <p class="mb-0" data-ppt-f1b>Nulla vitae elit libero, a pharetra augue. Donec id elit non mi porta gravida at eget.</p>
             
            </div>
           
          </div>
      
          <div class="col-md-4 mb-4">
            <div class="p-4 shadow bg-white">
            
            	<div ppt-flex-between>
          
                 <div data-ppt-f2image class=" mb-4"><span class="fal fa-lock fa-4x hide-mobile text-primary" data-ppt-f2icon>&nbsp;</span></div>
                 
                  <div class="fs-xl text-700 text-light">02</div>
                
                </div>
                 
                <h5 class="mb-4" data-ppt-f2a>Secure Payments</h5>
                <p class="mb-0" data-ppt-f2b>Nulla vitae elit libero, a pharetra augue. Donec id elit non mi porta gravida at eget.</p>
         
            </div>
         
          </div>
    
          <div class="col-md-4 mb-4">
            <div class="p-4 shadow bg-white">
            
            	<div ppt-flex-between>
            
                 <div data-ppt-f3image class=" mb-4"><span class="fal fa-sync fa-4x hide-mobile text-primary" data-ppt-f3icon>&nbsp;</span></div>
                 
                  <div class="fs-xl text-700 text-light">03</div>
                
                </div>
                 
                <h5 class="mb-4" data-ppt-f3a>Monthly Updates</h5>
                <p class="mb-0" data-ppt-f3b>Nulla vitae elit libero, a pharetra augue. Donec id elit non mi porta gravida at eget.</p>
           
            </div>
     
          </div>
    
           
 
        </div>
      
      </div> 

</div>
 
 
 
  </div>
</section>
<?php
 

		$output = ob_get_contents();
		ob_end_clean();
echo ppt_theme_block_output($output, $text_settings, array("text", "text176"));
	
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