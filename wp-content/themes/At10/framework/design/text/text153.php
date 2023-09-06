<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text153',  'data') );
add_action( 'text153',  		array('block_text153', 'output' ) );
add_action( 'text153-css',  	array('block_text153', 'css' ) );
add_action( 'text153-js',  	array('block_text153', 'js' ) );

class block_text153 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text153'] = array(
			"name" 		=> "Style 153",
			"image"		=> "text153.jpg",
			"cat"		=> array("text","icon"),
			"desc" 		=> "", 
			"order" 	=> 153, 
			"widget" => "ppt-text",	
			"data" 	=> array( ),	
			
			"defaults" => array( ), 
			
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $text_settings;
	 	
		 
		 $df = array(
		 	"image" => DEMO_IMGS."?fw=text104&t=",
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
_ppt_template( 'widgets/widget-newsletter-form' );
$newsletter = ob_get_contents();
ob_end_clean();

ob_start();
	
?><section class="block-cat-icon block-icon_n4 bg-light section-100 ">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="text-center mb-5">
          <h2 class="mb-3" data-ppt-title>Build your website in minutes!</h2>
          <p data-ppt-subtitle>Save time and money - get started now!</p>
        </div>
      </div>
      <div class="col-12">
        <div class="row">
          <div class="col-md-3">
            <div class="card  mb-4 mb-md-0" style="border-top:3px solid #1274e7">
              <a href="#" class="text-decoration-none text-dark" data-ppt-f1-link>
              <div class="card-body py-lg-4">
                <div class="row">
                  <div class="col-12 px-4">
                    <h5 class="mb-3" data-ppt-f1a>Straightforward</h5>
                    <p data-ppt-f1b>Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.</p>
                  </div>
                </div>
              </div>
              </a>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card  mb-4 mb-md-0" style="border-top:3px solid #00c853">
              <a href="#" class="text-decoration-none text-dark" data-ppt-f2-link>
              <div class="card-body py-lg-4">
                <div class="row">
                  <div class="col-12 px-4">
                    <h5 class="mb-3" data-ppt-f2a> Awesome Features</h5>
                    <p class="" data-ppt-f2b>Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.</p>
                  </div>
                </div>
              </div>
              </a>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card  mb-4 mb-md-0" style="border-top:3px solid #ff9800">
              <a href="#" class="text-decoration-none text-dark" data-ppt-f3-link>
              <div class="card-body py-lg-4">
                <div class="row">
                  <div class="col-12 px-4">
                    <h5 class="mb-3" data-ppt-f3a>High Quality</h5>
                    <p data-ppt-f3b>Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.</p>
                  </div>
                </div>
              </div>
              </a>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card  mb-4 mb-md-0" style="border-top:3px solid #ff1700">
              <a href="#" class="text-decoration-none text-dark" data-ppt-f4-link>
              <div class="card-body py-lg-4">
                <div class="row">
                  <div class="col-12 px-4">
                    <h5 class="mb-3" data-ppt-f4a> Make Money </h5>
                    <p data-ppt-f4b>Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.</p>
                  </div>
                </div>
              </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php

$output = ob_get_contents();
ob_end_clean();
echo str_replace("%newsletter%", $newsletter , ppt_theme_block_output($output, $text_settings, array("text", "text153")));
	
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
