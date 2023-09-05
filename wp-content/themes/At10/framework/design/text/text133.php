<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text133',  'data') );
add_action( 'text133',  		array('block_text133', 'output' ) );
add_action( 'text133-css',  	array('block_text133', 'css' ) );
add_action( 'text133-js',  	array('block_text133', 'js' ) );

class block_text133 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text133'] = array(
			"name" 		=> "Style 133",
			"image"		=> "text133.jpg",
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
		 	"image" => DEMO_IMGS."?fw=text133&t=".THEME_KEY,
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
	
	// BLOCK WRAP
	 
	?><section> 
    
  <div class="container"> 
  
    <div class="row d-flex align-items-center text-center text-lg-left"> 
      
      <div class="col-lg-6 pr-xl-5 col-xl-5 "> 
        
      
        <h1 class="mb-4 fs-xl" data-ppt-title>Ideal for beginners and experts.</h1>
        
        <p class="fs-md opacity-5" data-ppt-subtitle>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue.</p>
        
        <p class="opacity-5 fs-sm" data-ppt-desc>Lorem ipsum dolor sit amet.</p>
        
        <?php if($df['btn1']){ ?>
        <div class="mt-4 d-flex">
        <div class="w-100 mr-2"><a href="#demos" data-ppt-btn class="btn-lg btn-primary  mt-2 <?php if($df['btn2']){ ?>btn-block<?php } ?>" data-ppt-btn-txt>View Demos</a></div> 
       
        
        <?php if($df['btn2']){ ?>
        <div class="w-100 ml-2"><a href="#" data-ppt-btn  class="btn-lg btn-secondary  mt-2 btn-block" data-ppt-btn-txt>Buy Now</a></div>
        <?php } ?>
    	
		</div>
		<?php } ?>
        
      </div> 
      
      <div class="col-lg-6 pl-lg-5 col-xl-7 text-sm-center ">
    
      <img data-src="<?php echo $df['image']; ?>" class="img-fluid mt-3 pt-3 pt-md-0 mt-lg-0 lazy" alt="image"  data-ppt-image />
       
      </div>
      
    </div> 
     
  </div> 
  
</section><?php


		$output = ob_get_contents();
		ob_end_clean();
echo ppt_theme_block_output($output, $text_settings, array("text", "text133"));
	
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