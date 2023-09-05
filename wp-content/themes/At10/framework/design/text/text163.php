<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text163',  'data') );
add_action( 'text163',  		array('block_text163', 'output' ) );
add_action( 'text163-css',  	array('block_text163', 'css' ) );
add_action( 'text163-js',  	array('block_text163', 'js' ) );

class block_text163 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text163'] = array(
			"name" 		=> "Style 163",
			"image"		=> "text163.jpg",
			"cat"		=> array("text","icon"),
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
		  
		$cc = array();		
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
	
	// BLOCK WRAP
	 
	?><section class="section-40">
<div class="container">

<div class="row padding-top">

            <div class="col-lg-6">
            
                <div class="text-primary text-700 mb-2" data-ppt-title>About Our Company</div>
                
                <h2 class="pr-lg-5" data-ppt-subtitle>Welcome to intro paragragh for some more info about our comapny. </h2>
                
            </div>
            <div class="col-lg-6 d-flex align-items-center lh-30">
                <div data-ppt-desc>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sodales lobortis vehicula. Aliquam sodales turpis a neque sagittis, condimentum imperdiet risus luctus. Praesent cursus non risus in tempor. Phasellus eu purus sed arcu posuere consequat euismod ac augue. Morbi venenatis dictum consequat. Phasellus eu purus sed arcu posuere consequat euismod ac augue. Morbi venenatis dictum consequat.
                </div>
            </div>
        </div> 
        
        
<div class="row mt-5">

 <div class="col-12">
        <div class="row">
         
        
          <div class="col-md-4">
          
            <div class="p-4 text-center" ppt-border1>
            
                <div data-ppt-f1image class=" mb-4"><span class="fal fa-life-ring fa-4x hide-mobile text-primary" data-ppt-f1icon>&nbsp;</span></div>
                <h5 class="mb-4" data-ppt-f1a>24/7 Support</h5>
                <p class="mb-0" data-ppt-f1b>Nulla vitae elit libero, a pharetra augue. Donec id elit non mi porta.</p>
             
            </div>
            <!--/.card -->
          </div>
          <!--/column -->
          <div class="col-md-4 mb-4">
            <div class="p-4 text-center" ppt-border1>
          
                 <div data-ppt-f2image class=" mb-4"><span class="fal fa-lock fa-4x hide-mobile text-primary" data-ppt-f2icon>&nbsp;</span></div>
                <h5 class="mb-4" data-ppt-f2a>Secure Payments</h5>
                <p class="mb-0" data-ppt-f2b>Nulla vitae elit libero, a pharetra augue. Donec id elit non mi porta.</p>
         
            </div>
            <!--/.card -->
          </div>
          <!--/column -->
          <div class="col-md-4 mb-4">
            <div class="p-4 text-center" ppt-border1>
            
                 <div data-ppt-f3image class=" mb-4"><span class="fal fa-sync fa-4x hide-mobile text-primary" data-ppt-f3icon>&nbsp;</span></div>
                <h5 class="mb-4" data-ppt-f3a>Monthly Updates</h5>
                <p class="mb-0" data-ppt-f3b>Nulla vitae elit libero, a pharetra augue. Donec id elit non mi porta gravida at eget.</p>
           
            </div>
            <!--/.card -->
          </div>
          <!--/column -->
           
 
        </div>
        <!--/.row -->
      </div> 

</div>
        
        
        
        
        
</div>
</section> 
<?php


		$output = ob_get_contents();
		ob_end_clean();
echo ppt_theme_block_output($output, $text_settings, array("text", "text163") );
	
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
