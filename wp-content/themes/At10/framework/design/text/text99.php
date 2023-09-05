<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text99',  'data') );
add_action( 'text99',  		array('block_text99', 'output' ) );
add_action( 'text99-css',  	array('block_text99', 'css' ) );
add_action( 'text99-js',  	array('block_text99', 'js' ) );

class block_text99 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text99'] = array(
			"name" 		=> "Style 99",
			"image"		=> "text99.jpg",
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
		 	"image" => DEMO_IMGS."?fw=text99&t=".THEME_KEY,
			"btn1_show" => 1,
			"btn2_show" => 0,		 
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
		 	$settings =  $CORE->LAYOUT("get_block_settings_defaults_new", array("text", "text99" ) );
		 	foreach($df as $h => $j){
				if(isset($settings[$h]) && $settings[$h] != ""){
					$df[$h] = $settings[$h];
				}
			 } 
		 }
 
	ob_start();
	
	?>
<section class="section-60 ppt-block-text">

 
  <div class="container">
    <div class="row align-items-center">
      
      <div class="col-md-8 col-lg-6 position-relative pr-lg-5 mobile-mb-2">
        
        <figure class="rounded"><img data-src="<?php echo $df['image']; ?>" class="img-fluid lazy"  alt="image" data-ppt-image></figure>
     
      </div>
     
      <div class="col-lg-6 pl-lg-5">
      
        <h2 class="mb-3" data-ppt-title>We're here to help.</h2>
        
        <p class="lead" data-ppt-subtitle>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique.</p>
       
        <p class="mb-6" data-ppt-desc>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</p>
        
        
          <?php if(THEME_KEY == "sp"){ ?>
        
          <?php if($df['btn1_show']){ ?>
          <a href="<?php echo home_url(); ?>/?s=" class="btn-lg btn-primary  mt-2" data-ppt-btn data-ppt-btn-txt><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "start_search" ) ); ?></a>
          <?php } ?>
         
        <?php }else{ ?>
        
        <?php if($df['btn1_show']){ ?>
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
echo ppt_theme_block_output($output, $text_settings, array("text", "text99"));
	
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
