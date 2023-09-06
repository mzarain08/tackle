<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text102',  'data') );
add_action( 'text102',  		array('block_text102', 'output' ) );
add_action( 'text102-css',  	array('block_text102', 'css' ) );
add_action( 'text102-js',  		array('block_text102', 'js' ) );

class block_text102 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text102'] = array(
			"name" 		=> "Style 102",
			"image"		=> "text102.jpg",
			"cat"		=> "text",
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
			"image" => DEMO_IMGS."?fw=text102&t=".THEME_KEY,
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
		  
	 
	ob_start(); ?><section class="section-60">
  <div class="container">
    <div class="row  y-middle">
      <div class="col-md-6 pr-lg-5">
        <img data-src="<?php echo $df['image']; ?>" class="img-fluid lazy rounded shadow-sm  mobile-mb-2" alt="image"  data-ppt-image />
      </div>
      <div class="col-md-6 pl-xl-5">
      
        <h2 data-ppt-title><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("text102", "title" ) ); ?></h2>
        
        <p class="my-3" data-ppt-subtitle>Lorem ipsum dolor sit amet, consectetur
          adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque
          nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique
          neque consequat.</p>
          
          <?php if(THEME_KEY == "sp"){ ?>
        
          <?php if($df['btn1_show']){ ?>
          <a href="<?php echo home_url(); ?>/?s=" class="btn-lg btn-primary  mt-2" data-ppt-btn data-ppt-btn-txt><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "start_search" ) ); ?></a>
          <?php } ?>
         
        <?php }else{ ?>
        
        <?php if($df['btn_show']){ ?>
        <a href="<?php echo _ppt(array('links','add')); ?>" class="btn-lg btn-primary  mt-2" data-ppt-btn data-ppt-btn-txt><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "addnew" ) ); ?></a>
        <?php } ?>
        <?php if($df['btn2_show']){ ?>
        <a href="<?php echo home_url(); ?>/?s=" class="btn-lg btn-primary  mt-2" data-ppt-btn data-ppt-btn2-txt><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "start_search" ) ); ?></a>
        <?php } ?>
        
        <?php } ?>
        
      </div>
    </div>
  </div>
</section>
<?php
$output = ob_get_contents();
ob_end_clean();
echo ppt_theme_block_output($output, $df, array("text", "text102") );
	
	}
		public static function css(){
return "";
		ob_start();
		?>
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