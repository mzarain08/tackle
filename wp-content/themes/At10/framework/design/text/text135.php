<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text135',  'data') );
add_action( 'text135',  		array('block_text135', 'output' ) );
add_action( 'text135-css',  	array('block_text135', 'css' ) );
add_action( 'text135-js',  	array('block_text135', 'js' ) );

class block_text135 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text135'] = array(
			"name" 		=> "Style 135",
			"image"		=> "text135.jpg",
			"cat"		=> array("text","cta"),
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
		
		// APPLY CUSTOM CHANGES 
		$cc = array(			 
			"title_underline" 		=> 6,
			"btn_show" => 1,
			"btn2_show" => 1,
			
			 
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
		   
		 
	ob_start();
	
	// BLOCK WRAP
	 
	?><section>
    
  <div class="container py-5 text-center">
  
    <div class="row">
    
      <div class="col-md-9 col-lg-7 col-xl-7 mx-auto text-center">
        
        <h2 class="fs-lg mb-3" data-ppt-title>Join {Our} Community</h2>
        
        <p class="lead mb-4" data-ppt-subtitle>We are trusted by over 65,000+ user worldwide. Build your next website using our  WordPress themes today.</p>
        
        <?php if($df['btn_show']){ ?>
        <a href="#" data-ppt-btn class="btn-primary rounded"><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "start_search" ) ); ?></a>
        <?php } ?>
        
          <?php if($df['btn2_show']){ ?>
        <a href="#" data-ppt-btn class="btn-primary rounded"><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "signup_now" ) ); ?></a>
        <?php } ?>
        
      </div>
  
    </div>
 
  </div>
 
</section><?php


		$output = ob_get_contents();
		ob_end_clean();
echo ppt_theme_block_output($output, $df, array("text", "text135"));
	
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