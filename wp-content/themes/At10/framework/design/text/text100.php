<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text100',  'data') );
add_action( 'text100',  		array('block_text100', 'output' ) );
add_action( 'text100-css',  	array('block_text100', 'css' ) );
add_action( 'text100-js',  	array('block_text100', 'js' ) );

class block_text100 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text100'] = array(
			"name" 		=> "Style 100",
			"image"		=> "text100.jpg",
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
		 	"image" => DEMO_IMGS."?fw=text100&t=".THEME_KEY,
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
<section class="section-60">

  <div class="container">
    <div class="row align-items-center">
      
      <div class="col-md-8 col-lg-6 order-lg-2 position-relative pl-lg-5 mobile-mb-2">
         
        <figure class="rounded"><img data-src="<?php echo $df['image']; ?>" class="img-fluid lazy"  alt="image" data-ppt-image></figure>
     
      </div>
     
      <div class="col-lg-6 pr-lg-5">
      
        <h2 class="mb-3" data-ppt-title>Who Are We?</h2>
        
        <p class="lead" data-ppt-subtitle>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique.</p>
       
        <p class="mb-0" data-ppt-desc>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</p>
        
        
         <?php if(THEME_KEY == "sp"){ ?>
        
          <?php if($df['btn1']){ ?>
          <a href="<?php echo home_url(); ?>/?s=" class="btn-lg btn-primary  my-4" data-ppt-btn data-ppt-btn-txt><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "start_search" ) ); ?></a>
          <?php } ?>
         
        <?php }else{ ?>
        
        <?php if($df['btn1']){ ?>
        <a href="<?php echo _ppt(array('links','add')); ?>" class="btn-lg btn-primary  my-4" data-ppt-btn data-ppt-btn-txt><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "addnew" ) ); ?></a>
        <?php } ?>
        <?php if($df['btn2']){ ?>
        <a href="<?php echo home_url(); ?>/?s=" class="btn-lg btn-primary  my-4" data-ppt-btn data-ppt-btn2-txt><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "start_search" ) ); ?></a>
        <?php } ?>
        
        <?php } ?>
        
        
      </div>
     
    </div>
  
  </div>
</section>
<?php
		$output = ob_get_contents();
		ob_end_clean();
echo ppt_theme_block_output($output, $text_settings, array("text", "text100"));
	
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