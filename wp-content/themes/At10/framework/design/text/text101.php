<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text101',  'data') );
add_action( 'text101',  		array('block_text101', 'output' ) );
add_action( 'text101-css',  	array('block_text101', 'css' ) );
add_action( 'text101-js',  	array('block_text101', 'js' ) );

class block_text101 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text101'] = array(
			"name" 		=> "Style 101",
			"image"		=> "text101.jpg",
			"cat"		=> array("text","icons"),
			"desc" 		=> "", 
			"order" 	=> 0, 
			"widget" => "ppt-text",	
			"data" 	=> array( ),	
			
			"defaults" => array( ), 
			
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $settings, $text_settings;
	 	
		
		$settings = $CORE->LAYOUT("get_block_settings_defaults", array("text101", "text", $settings ) );
	 
		 
		 $df = array(
		 	"image" => DEMO_IMGS."?fw=text101&t=".THEME_KEY,
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
 
<section class="section-60 ppt-block-text" >

 
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6 pr-lg-5">
        <h2 class="mb-4" data-ppt-title>Build powerful websites quickly with PremiumPress themes.</h2>
          
        <p class="mb-5" data-ppt-subtitle>Lorem ipsum dolor sit amet,
          consectetur adipiscing elit. Praesent tempus eleifend risus ut congue.
          Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra
          eu tristique.</p>
        <div class="d-flex flex-row mb-4">
        <div>
          <div class="img-wrap bg-primary">
            <div>
             <span class="fa fa-check text-light"></span>
            </div>
          </div>
          </div>
          <div>
            <h5 class="mb-2" data-ppt-f1a>Quick and easy to setup.</h5>
            <p class="mb-0 opacity-8" data-ppt-f1b>Lorem ipsum dolorsit amet consectetur.</p>
          </div>
        </div>
        <div class="d-flex flex-row mb-4">
          <div>
            <div class="img-wrap bg-primary">
           <span class="fa fa-check text-light"></span>
            </div>
          </div>
          <div>
            <h5 class="mb-2" data-ppt-f2a>Easy to customize.</h5>
            <p class="mb-0 opacity-8" data-ppt-f2b>Lorem ipsum dolorsit amet consectetur.</p>
          </div>
        </div>
        <div class="d-flex flex-row mb-4">
          <div>
            <div class="img-wrap bg-primary">
              <span class="fa fa-check text-light"></span>
            </div>
          </div>
          <div>
            <h5 class="mb-2" data-ppt-f3a>Easy to manage and scale.</h5>
            <p class="mb-0 opacity-8" data-ppt-f3b>Lorem ipsum dolorsit amet consectetur.</p>
          </div>
        </div>
        
        
       <?php if($df['btn1']){ ?>
        <a href="<?php echo _ppt(array('links','add')); ?>" class="btn-lg btn-primary  mt-4 mobile-mb-4" data-ppt-btn data-ppt-btn-txt><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "addnew" ) ); ?></a>
        <?php } ?>
        <?php if($df['btn2']){ ?>
        <a href="<?php echo home_url(); ?>/?s=" class="btn-lg btn-primary  mt-4 mobile-mb-4" data-ppt-btn data-ppt-btn2-txt><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "start_search" ) ); ?></a>
        <?php } ?>
        
        
        
      </div>
      <div class="col-md-6">
        <figure> <img data-src="<?php echo $df['image']; ?>" class="img-fluid lazy" alt="image"  data-ppt-image /> </figure>
      </div>
    </div>
  </div>
</section>
<?php

		$output = ob_get_contents();
		ob_end_clean();
echo ppt_theme_block_output($output, $text_settings, array("text", "text101"));
	
	}
		public static function css(){

		ob_start();
		?>
<style>
 
.img-wrap {
    width: 50px;
    height: 50px;
    line-height: 55px;
    margin-right: 30px;
	border-radius: 100px;
	text-align: center;	
	font-size: 30px;
}
 
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
