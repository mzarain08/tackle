<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text172',  'data') );
add_action( 'text172',  		array('block_text172', 'output' ) );
add_action( 'text172-css',  	array('block_text172', 'css' ) );
add_action( 'text172-js',  	array('block_text172', 'js' ) );

class block_text172 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text172'] = array(
			"name" 		=> "Style 172",
			"image"		=> "text172.jpg",
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
 
        
        
<div class="row">

 <div class="col-12">
        <div class="row">
         
        
          <div class="col-md-3 mb-4">
          
            <div class="p-4 text-center js-bg-primary" ppt-border1>
            
                <div data-ppt-f1image class=" my-4"><span class="fal fa-life-ring fa-4x hide-mobile text-primary" data-ppt-f1icon>&nbsp;</span></div>
                <h5 class="mb-4" data-ppt-f1a>24/7 Support</h5>
                
            </div>
            <!--/.card -->
          </div>
          <!--/column -->
          <div class="col-md-3 mb-4">
            <div class="p-4 text-center js-bg-primary" ppt-border1>
          
                <div data-ppt-f2image class=" my-4"> <span class="fal fa-lock fa-4x hide-mobile text-primary" data-ppt-f2icon>&nbsp;</span></div>
                <h5 class="mb-4" data-ppt-f2a>Secure Payments</h5>
                
            </div>
            <!--/.card -->
          </div>
          <!--/column -->
          <div class="col-md-3 mb-4">
            <div class="p-4 text-center js-bg-primary" ppt-border1>
            
               <div data-ppt-f3image class=" my-4"><span class="fal fa-sync fa-4x hide-mobile text-primary" data-ppt-f3icon>&nbsp;</span></div>
                <h5 class="mb-4" data-ppt-f3a>Monthly Updates</h5>
                
            </div>
            <!--/.card -->
          </div>
          <!--/column -->
          
                  <div class="col-md-3 mb-4">
       <div class="p-4 text-center js-bg-primary" ppt-border1>
          
                <div data-ppt-f4image class=" my-4"><span class="fal fa-envelope fa-4x hide-mobile text-primary" data-ppt-f4icon>&nbsp;</span></div>
                <h5 class="mb-4" data-ppt-f4a>Email Us Anytime</h5>
                
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
echo ppt_theme_block_output($output, $text_settings, array("text", "text172") );
	
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
