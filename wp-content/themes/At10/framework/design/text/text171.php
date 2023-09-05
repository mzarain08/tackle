<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text171',  'data') );
add_action( 'text171',  		array('block_text171', 'output' ) );
add_action( 'text171-css',  	array('block_text171', 'css' ) );
add_action( 'text171-js',  	array('block_text171', 'js' ) );

class block_text171 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text171'] = array(
			"name" 		=> "Style 171",
			"image"		=> "text171.jpg",
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
		}else{		 
		 	$settings =  $CORE->LAYOUT("get_block_settings_defaults_new", array("text", "text171" ) );
		 	foreach($df as $h => $j){
				if(isset($settings[$h]) && $settings[$h] != ""){
					$df[$h] = $settings[$h];
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
         
        
          <div class="col-md-6 col-lg-3 mb-4">
          
            <div class="p-4 text-center js-bg-primary" ppt-border1>
            
                <div data-ppt-f1image class=" mb-4"><span class="fal fa-life-ring fa-4x hide-mobile text-primary" data-ppt-f1icon>&nbsp;</span></div>
                <h5 class="mb-4" data-ppt-f1a>24/7 Support</h5>
                <p class="mb-0" data-ppt-f1b>Nulla vitae elit libero, a pharetra augue. Donec id elit non mi porta.</p>
             
            </div>
            <!--/.card -->
          </div>
          <!--/column -->
          <div class="col-md-6 col-lg-3 mb-4">
            <div class="p-4 text-center js-bg-primary" ppt-border1>
          
                <div data-ppt-f2image class=" mb-4"> <span class="fal fa-lock fa-4x hide-mobile text-primary" data-ppt-f2icon>&nbsp;</span></div>
                <h5 class="mb-4" data-ppt-f2a>Secure Payments</h5>
                <p class="mb-0" data-ppt-f2b>Nulla vitae elit libero, a pharetra augue. Donec id elit non mi porta.</p>
         
            </div>
            <!--/.card -->
          </div>
          <!--/column -->
          <div class="col-md-6 col-lg-3 mb-4">
            <div class="p-4 text-center js-bg-primary" ppt-border1>
            
               <div data-ppt-f3image class=" mb-4"><span class="fal fa-sync fa-4x hide-mobile text-primary" data-ppt-f3icon>&nbsp;</span></div>
                <h5 class="mb-4" data-ppt-f3a>Monthly Updates</h5>
                <p class="mb-0" data-ppt-f3b>Nulla vitae elit libero, a pharetra augue. Donec id elit non mi porta.</p>
           
            </div>
            <!--/.card -->
          </div>
          <!--/column -->
          
                  <div class="col-md-6 col-lg-3 mb-4">
       <div class="p-4 text-center js-bg-primary" ppt-border1>
          
                <div data-ppt-f4image class=" mb-4"><span class="fal fa-envelope fa-4x hide-mobile text-primary" data-ppt-f4icon>&nbsp;</span></div>
                <h5 class="mb-4" data-ppt-f4a>Email Us Anytime</h5>
                <p class="mb-0" data-ppt-f4b>Nulla vitae elit libero, a pharetra augue. Donec id elit non mi porta.</p>
           
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
echo ppt_theme_block_output($output, $text_settings, array("text", "text171") );
	
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
