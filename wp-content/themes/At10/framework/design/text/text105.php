<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text105',  'data') );
add_action( 'text105',  		array('block_text105', 'output' ) );
add_action( 'text105-css',  	array('block_text105', 'css' ) );
add_action( 'text105-js',  	array('block_text105', 'js' ) );

class block_text105 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text105'] = array(
			"name" 		=> "Style 105",
			"image"		=> "text105.jpg",
			"cat"		=> "text",
			"desc" 		=> "", 
			"order" 	=> 0, 
			"widget" => "ppt-text",	
			"data" 	=> array( ),	
			
			"defaults" => array( ), 
			
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $text_settings;
	 	
		 $df = ppt_theme_blocks_defaults("text"); 
		 
		 $cc = array(
		 	"image" => DEMO_IMGS."?fw=text105&t=".THEME_KEY,
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
		}else{		 
		 	$settings =  $CORE->LAYOUT("get_block_settings_defaults_new", array("text", "text105" ) );
		 	foreach($df as $h => $j){
				if(isset($settings[$h]) && $settings[$h] != ""){
					$df[$h] = $settings[$h];
				}
			 } 
		 } 
		  
 
	ob_start();
	
	?>
    
<section class="section-60">
  <div class="container">
  
    <div class="row d-flex align-items-center">
    
    
      <div class="col-md-7 pr-lg-5 text-center mobile-mb-2">
            <img data-src="<?php echo $df['image']; ?>" class="img-fluid lazy"  alt="image"  data-ppt-image> 
            
      </div>
    
      <div class="col-md-5 pl-xl-5 align-items-center">
                    
            <div class="text-md-left">
			
            <h6 class="mb-3 text-uppercase text-primary" data-ppt-desc>whats makes us different?</h6>
            
		    <h2 class="mb-5" data-ppt-title>We've been helping customers for 10+ years.</h2>
        <p class="lead mb-5" data-ppt-subtitle>Lorem ipsum dolor sit amet,
          consectetur adipiscing elit. Praesent tempus eleifend risus ut congue.
          Pellentesque nec lacus elit.</p>
          
       <ul class="list-unstyled">
          <li class="mb-2"><span class="fa fa-check-circle text-primary mr-2"> </span> <span class="text-dark" data-ppt-f1a> Aenean eu leo quam. Pellentesque ornare.</span></li>
          <li class="mb-2"><span class="fa fa-check-circle text-primary mr-2"> </span> <span class="text-dark" data-ppt-f2a>Nullam quis risus eget urna mollis ornare.</span></li>
          <li class="mb-2"><span class="fa fa-check-circle text-primary mr-2"> </span> <span class="text-dark" data-ppt-f3a>Donec id elit non mi porta gravida at eget.</span></li>
        </ul>
       
            
            </div>         
			
		 
          </div>
    
    </div>
  </div>
</section>
  
<?php
 

		$output = ob_get_contents();
		ob_end_clean();
echo ppt_theme_block_output($output, $df, array("text", "text105"));
	
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
