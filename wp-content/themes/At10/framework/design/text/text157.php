<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text157',  'data') );
add_action( 'text157',  		array('block_text157', 'output' ) );
add_action( 'text157-css',  	array('block_text157', 'css' ) );
add_action( 'text157-js',  	array('block_text157', 'js' ) );

class block_text157 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text157'] = array(
			"name" 		=> "Style 157",
			"image"		=> "text157.jpg",
			"cat"		=> array("text","contact"),
			"desc" 		=> "", 
			"order" 	=> 0, 
			"widget" => "ppt-text",	
			"data" 	=> array( ),	
			
			"defaults" => array( ), 
			
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $CORE_UI, $text_settings;
	 	
		 
		 // ALL DEFAULT FIELDS
		 $df = ppt_theme_blocks_defaults("text"); 
		  
		$cc = array(	  
		
		
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
		  
 
// LOGO
ob_start();
_ppt_template( 'framework/design/parts/contactform' );
$contactform = ob_get_contents();
ob_end_clean();

 
	ob_start();
	
	?>
    
<section class="border-top section-100 ppt-block-text">

  <div class="container ">
  <div class="" ppt-border1>
  <div class="card-body">
    <div class="row y-middle">
    
      <div class="col-lg-6 px-xl-5 order-md-2">
                    
       <div ppt-icon-48 data-ppt-icon-size="48" class="text-primary mb-3 hide-mobile"><?php echo $CORE_UI->icons_svg['envelope']; ?></div>
        
		<h2 class="mb-3" data-ppt-title>If you like what you see, let's work together.</h2>
        
        <p class="lead mb-4" data-ppt-subtitle>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique.</p>
   
          </div>
          
      <div class="col-lg-6 text-center">%contactform%</div>
      
      
      
    </div>
</div>
</div>    
  </div>
</section>
  
<?php
 

		$output = ob_get_contents();
		ob_end_clean();
echo str_replace("%contactform%", $contactform,ppt_theme_block_output($output, $df, array("text", "text157")));
	
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
