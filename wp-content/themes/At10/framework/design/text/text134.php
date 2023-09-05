<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text134',  'data') );
add_action( 'text134',  		array('block_text134', 'output' ) );
add_action( 'text134-css',  	array('block_text134', 'css' ) );
add_action( 'text134-js',  	array('block_text134', 'js' ) );

class block_text134 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text134'] = array(
			"name" 		=> "Style 134",
			"image"		=> "text134.jpg",
			"cat"		=> array("text","cta"),
			"desc" 		=> "", 
			"order" 	=> 0, 
			"widget" => "ppt-text",	
			"data" 	=> array( ),	
			
			"defaults" => array( ), 
			
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $text_settings;
	 	 
		 $df = array(
		 	"image" => DEMO_IMGS."?fw=text134&t=".THEME_KEY,
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
    
  <div class="container py-5 text-center">
  
    <div class="row">
    
      <div class="col-md-9 col-lg-7 col-xl-7 mx-auto text-center">
        
        <h2 class=" mb-3" data-ppt-title>Join Our Community</h2>
        
        <p class="lead mb-4" data-ppt-subtitle>We are trusted by over 65,000+ user worldwide. Build your next website using our  WordPress themes today.</p>
        
        <?php if($df['btn1']){ ?>
        <a href="#" data-ppt-btn class="btn-primary btn-lg rounded"><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "signup_now" ) ); ?></a>
        <?php } ?>
        
      </div>
  
    </div>
 
  </div>
 
</section><?php


		$output = ob_get_contents();
		ob_end_clean();
echo ppt_theme_block_output($output, $text_settings, array("text", "text134"));
	
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