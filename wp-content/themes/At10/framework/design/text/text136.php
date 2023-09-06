<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text136',  'data') );
add_action( 'text136',  		array('block_text136', 'output' ) );
add_action( 'text136-css',  	array('block_text136', 'css' ) );
add_action( 'text136-js',  	array('block_text136', 'js' ) );

class block_text136 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text136'] = array(
			"name" 		=> "Style 136",
			"image"		=> "text136.jpg",
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
		 $df = ppt_theme_block_default(array("title","subtitle","btn","section"), 0);//
		
		// APPLY CUSTOM CHANGES 
		$cc = array(			 
			"title_underline" 		=> 6,
			"btn_show" => 1,
			"btn2_show" => 1,
			
			 
		);
		
		$df = array_merge($df, $cc);
		 
		// 1.  ELEMENTOR
		if(!empty($text_settings)){
			foreach($df as $k => $v){				
				if(isset($text_settings[$k]) && $text_settings[$k] != "" ){
					$df[$k] = $text_settings[$k];
				}
			}	
				
		// 2. HOME DESIGNS		
		}else{	
			 
		 	$settings =  $CORE->LAYOUT("get_block_settings_defaults_new", array("text", "text136" ) );
		 	foreach($df as $h => $j){
				if(isset($settings[$h]) && $settings[$h] != ""){
					$df[$h] = $settings[$h];
				}
			 } 
		}
	 	   
		 
	ob_start();
	
	// BLOCK WRAP
	 
	?><section>
    
  <div class="container py-5 text-center bg-primary rounded-lg text-light">
  
    <div class="row">
    
      <div class="col-md-9 col-lg-7 col-xl-7 mx-auto text-center">
        
        <h2 class="fs-lg mb-3" data-ppt-title>Join {Our} Community</h2>
        
        <p class="lead mb-4" data-ppt-subtitle>We are trusted by over 65,000+ user worldwide. Build your next website using our  WordPress themes today.</p>
        
        <?php if($df['btn_show']){ ?>
        <a href="<?php echo home_url(); ?>/?s=" data-ppt-btn class="btn-system rounded"><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "start_search" ) ); ?></a>
        <?php } ?>
        
          <?php if($df['btn2_show']){ ?>
        <a href="<?php echo _ppt(array('links','add')); ?>" data-ppt-btn class="btn-system rounded"><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "signup_now" ) ); ?></a>
        <?php } ?>
        
      </div>
  
    </div>
 
  </div>
 
</section><?php


		$output = ob_get_contents();
		ob_end_clean();
echo ppt_theme_block_output($output, $df, array("text", "text136"));
	
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