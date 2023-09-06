<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text117',  'data') );
add_action( 'text117',  		array('block_text117', 'output' ) );
add_action( 'text117-css',  	array('block_text117', 'css' ) );
add_action( 'text117-js',  	array('block_text117', 'js' ) );

class block_text117 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text117'] = array(
			"name" 		=> "Style 117",
			"image"		=> "text117.jpg",
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
		 	"image" => DEMO_IMGS."?fw=text117&t=".THEME_KEY,
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
    
    
<section class="wrapper image-wrapper bg-auto no-overlay text-center bg-map">
  
  <div class="container py-5 my-5">
   
    <div class="row py-5">
     
      <div class="col-lg-10 col-xl-9 col-xxl-8 mx-auto">
      
        <h6 class="fs-15 text-uppercase text-primary mb-3" data-ppt-title>Join Our Community</h6>
        
        <h3 class="col-10 mx-auto" data-ppt-desc>We are trusted by over 5000+ clients. Join them now and grow your business.</h3>
        
      </div>
 
 
    </div>


    <div class="row pb-md-12">
    
      <div class="col-md-10 col-lg-9 col-xl-7 mx-auto">
      
        <div class="row align-items-center counter-wrapper">
        
          <div class="col-6 col-md-4 text-center">
            <h3 class="ppt-countup counter-lg text-primary" data-ppt-f1a>434</h3>
            <h6 data-ppt-f1b>Completed Projects</h6>
          </div>
 
          <div class="col-6  col-md-4 text-center">
            <h3 class="ppt-countup counter-lg text-primary" data-ppt-f2a>1212</h3>
            <h6 data-ppt-f2b>Happy Customers</h6>
          </div>
    
          <div class="col-md-4 text-center hide-mobile">
            <h3 class="ppt-countup counter-lg text-primary" data-ppt-f3a>443</h3>
            <h6 data-ppt-f3b>Expert Employees</h6>
          </div>
      
        </div>
 
      </div>
 
    </div>
 
  </div>
 
</section>
 
    <?php


		$output = ob_get_contents();
		ob_end_clean();
echo ppt_theme_block_output($output, $text_settings, array("text", "text117") );
	
	}
		public static function css(){

		ob_start();
		?>
 <style>
 
 .bg-map { background-image:url('https://premiumpress1063.b-cdn.net/_demoimagesv10/demo/map.png'); }
 
.image-wrapper.bg-auto {
    background-size: auto;
    background-position: center center;
    background-repeat: no-repeat;
    background-attachment: scroll!important;
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