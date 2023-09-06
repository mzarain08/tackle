<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text122',  'data') );
add_action( 'text122',  		array('block_text122', 'output' ) );
add_action( 'text122-css',  	array('block_text122', 'css' ) );
add_action( 'text122-js',  	array('block_text122', 'js' ) );

class block_text122 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text122'] = array(
			"name" 		=> "Style 122",
			"image"		=> "text122.jpg",
			"cat"		=> array("text","cta"),
			"desc" 		=> "", 
			"order" 	=> 0, 
			"widget" 	=> "ppt-text",	
			"data" 		=> array( ),	
			
			"defaults" => array( ), 
			
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $text_settings;
	 	
		 
		 $df = array(
		 	"image" => DEMO_IMGS."?fw=text122&t=".THEME_KEY,
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
<section class="bg-primary section-40 hide-mobile">
  <div class="container">
    <div class="row align-items-center  text-center text-md-right">
      <div class="col-md-8 mobile-mb-2">
       
        <div class="text-md-left">
          
          <h2 class="text-light m-0" data-ppt-title><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("cta", "1" ) ); ?></h2>
      
       </div>
      </div>
      <div class="col-10 mx-auto col-md-4 text-center text-md-right">
      
        <a href="<?php echo wp_registration_url(); ?>" class="btn-rounded-25  font- btn-xl btn-light  mt-0  btn-icon icon-after" data-ppt-btn data-ppt-btn-link> <span data-ppt-btn-txt><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "signup_now" ) ); ?></span> <i class="fa fa-long-arrow-alt-right">&nbsp;</i> </a>
        
      </div>
    </div>
  </div>
</section>
<?php

$output = ob_get_contents();
ob_end_clean();
echo ppt_theme_block_output($output, $text_settings, array("text", "text122"));
	
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