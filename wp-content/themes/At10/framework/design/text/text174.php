<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text174',  'data') );
add_action( 'text174',  		array('block_text174', 'output' ) );
add_action( 'text174-css',  	array('block_text174', 'css' ) );
add_action( 'text174-js',  	array('block_text174', 'js' ) );

class block_text174 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text174'] = array(
			"name" 		=> "Style 174",
			"image"		=> "text174.jpg",
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
         
         <div class="col-md-3 col-lg-3 mb-4">
         
          <div class="text-primary text-700 fs-lg" data-ppt-title>Our company was founded in May 2001</div>
            
         
         </div>
        
          <div class="col-md-3 mb-4">
          
            <div class="p-4 text-center" ppt-border1>
            
                <div data-ppt-f1image class=" mb-4"><span class="fal fa-life-ring fa-4x hide-mobile text-primary" data-ppt-f1icon></span></div>
                <h5 class="mb-4" data-ppt-f1a>24/7 Online Support</h5>
                
            </div>
            <!--/.card -->
          </div>
          <!--/column -->
          <div class="col-md-3 mb-4">
            <div class="p-4 text-center" ppt-border1>
          
                <div data-ppt-f2image class=" mb-4"> <span class="fal fa-lock fa-4x hide-mobile text-primary" data-ppt-f2icon></span></div>
                <h5 class="mb-4" data-ppt-f2a>Secure Payments</h5>
                
            </div>
            <!--/.card -->
          </div>
          <!--/column -->
          <div class="col-md-3 mb-4">
            <div class="p-4 text-center" ppt-border1>
            
               <div data-ppt-f3image class=" mb-4"><span class="fal fa-sync fa-4x hide-mobile text-primary" data-ppt-f3icon></span></div>
                <h5 class="mb-4" data-ppt-f3a>Monthly Updates</h5>
                
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
echo ppt_theme_block_output($output, $text_settings, array("text", "text174") );
	
	}
		public static function css(){
return "";
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
