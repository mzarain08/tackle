<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text115',  'data') );
add_action( 'text115',  		array('block_text115', 'output' ) );
add_action( 'text115-css',  	array('block_text115', 'css' ) );
add_action( 'text115-js',  	array('block_text115', 'js' ) );

class block_text115 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text115'] = array(
			"name" 		=> "Style 115",
			"image"		=> "text115.jpg",
			"cat"		=> "text",
			"desc" 		=> "", 
			"order" 	=> 0, 
			"widget" => "ppt-text",	
			"data" 	=> array( ),	
			
			"defaults" => array( ), 
			
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $text_settings;
	 	 
		 $df = array(
		 	"image" => DEMO_IMGS."?fw=text115&t=".THEME_KEY,
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
	 
	?><section class="section-60"> 
    
  <div class="container"> 
  
    <div class="row d-flex align-items-center"> 
      
      <div class="col-md-6 pr-xl-5"> 
      
        <h2 class="mb-4" data-ppt-title>Ideal for beginners and experts. We have something for everyone.</h2>
        
        <p data-ppt-subtitle>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat.</p>
        
        <?php if($df['btn1']){ ?>
        <a href="<?php echo home_url(); ?>/?s=" class="btn-ppt  font- btn-lg btn-primary  mt-2" data-ppt-btn data-ppt-btn-txt>Get Started Now!</a> 
        <?php } ?>
    
        
      </div> 
      
      <div class="col-md-6 pl-lg-5 text-sm-center ">
    
      <img data-src="<?php echo $df['image']; ?>" class="img-fluid mt-3 pt-3 pt-md-0 mt-lg-0 lazy rounded shadow-sm lazy" alt="image"  data-ppt-image />
       
      </div>
      
    </div> 
     
  </div> 
  
</section><?php


		$output = ob_get_contents();
		ob_end_clean();
echo ppt_theme_block_output($output, $text_settings, array("text", "text115") );
	
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