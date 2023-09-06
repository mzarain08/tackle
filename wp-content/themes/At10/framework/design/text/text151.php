<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text151',  'data') );
add_action( 'text151',  		array('block_text151', 'output' ) );
add_action( 'text151-css',  	array('block_text151', 'css' ) );
add_action( 'text151-js',  		array('block_text151', 'js' ) );

class block_text151 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text151'] = array(
			"name" 		=> "Style 151",
			"image"		=> "text151.jpg",
			"cat"		=> "text",
			"desc" 		=> "", 
			"order" 	=> 151, 
			"widget" => "ppt-text",	
			"data" 	=> array( ),				
			"defaults" => array( ), 
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $text_settings;
	 	 
		 $df = array(
		 	"image" => "https://premiumpress1063.b-cdn.net/_demoimagesv10/hero/hero1_image2.jpg",
			"btn1" => 1,
			"btn2" => 1,		 
		 );
		 if(is_array($text_settings) && !empty($text_settings)){		 	
			 if(strlen($text_settings['image']) > 1){
			 $df['image'] = $text_settings['image'];			
			 }
			 $df['btn1'] = $text_settings['btn_show'];
			 $df['btn2'] = $text_settings['btn2_show'];
		 }	 
	
	 
	ob_start(); ?><section class="section-60">
  <div class="container">
    <div class="row  y-middle">
      <div class="col-md-6 pr-lg-5">
        <img data-src="<?php echo $df['image']; ?>" class="img-fluid lazy rounded shadow-sm  mobile-mb-2" alt="image"  data-ppt-image />
      </div>
      <div class="col-md-6 pl-xl-5">
      
        <h2 data-ppt-title>Amazing Headlines</h2>
        
         <p class="my-3 text-600" data-ppt-subtitle>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        
        <p class="my-3" data-ppt-desc>Lorem ipsum dolor sit amet, consectetur
          adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque
          nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique
          neque consequat.</p>
          
          <?php if(THEME_KEY == "sp"){ ?>
        
          <?php if($df['btn1']){ ?>
          <a href="<?php echo home_url(); ?>/?s=" class="btn-lg btn-primary  mt-2" data-ppt-btn data-ppt-btn-txt><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "start_search" ) ); ?></a>
          <?php } ?>
         
        <?php }else{ ?>
        
        <?php if($df['btn1']){ ?>
        <a href="<?php echo _ppt(array('links','add')); ?>" class="btn-lg btn-primary  mt-2" data-ppt-btn data-ppt-btn-txt><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "addnew" ) ); ?></a>
        <?php } ?>
        <?php if($df['btn2']){ ?>
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
echo ppt_theme_block_output($output, $text_settings, array("text", "text151") );
	
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