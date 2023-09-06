<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text109',  'data') );
add_action( 'text109',  		array('block_text109', 'output' ) );
add_action( 'text109-css',  	array('block_text109', 'css' ) );
add_action( 'text109-js',  	array('block_text109', 'js' ) );

class block_text109 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text109'] = array(
			"name" 		=> "Style 109",
			"image"		=> "text109.jpg",
			"cat"		=> array("text","faq"),
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
		 	"image" => DEMO_IMGS."?fw=text109&t=".THEME_KEY,
			"btn1" => 1,
			"btn2" => 0,		 
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
		 	$settings =  $CORE->LAYOUT("get_block_settings_defaults_new", array("text", "text109" ) );
		 	foreach($df as $h => $j){
				if(isset($settings[$h]) && $settings[$h] != ""){
					$df[$h] = $settings[$h];
				}
			 } 
		 } 
 
	ob_start();
	
	?>
<section class="section-80 bg-white border-top ppt-block-text">

  <div class="container py-14 py-md-16">
    <div class="row gx-md-8 gx-xl-12 gy-10">
      <div class="col-lg-6 mb-5">
        <div class="d-flex flex-row">
          <div>
            <span class="bg-primary icon-wrap"><span class="fal fa-comment-alt-lines text-light"></span></span>
          </div>
          <div>
            <h5 class="mb-4" data-ppt-f1a>Can I cancel my subscription?</h5>
            <p class="mb-0" data-ppt-f1b>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod maecenas.</p>
          </div>
        </div>
      </div>
      <!-- /column -->
      <div class="col-lg-6 mb-5">
        <div class="d-flex flex-row">
          <div>
            <span class="bg-primary icon-wrap"><span class="fal fa-comment-alt-lines text-light"></span></span>
          </div>
          <div>
            <h5 class="mb-4" data-ppt-f2a>Which payment methods do you accept?</h5>
            <p class="mb-0" data-ppt-f2b>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod maecenas.</p>
          </div>
        </div>
      </div>
      <!-- /column -->
      <div class="col-lg-6 mb-5">
        <div class="d-flex flex-row">
          <div>
            <span class="bg-primary icon-wrap"><span class="fal fa-comment-alt-lines text-light"></span></span>
          </div>
          <div>
            <h5 class="mb-4" data-ppt-f3a>How can I manage my Account?</h5>
            <p class="mb-0" data-ppt-f3b>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod maecenas.</p>
          </div>
        </div>
      </div>
      <!-- /column -->
      <div class="col-lg-6 mb-5">
        <div class="d-flex flex-row">
          <div>
            <span class="bg-primary icon-wrap"><span class="fal fa-comment-alt-lines text-light"></span></span>
          </div>
          <div>
            <h5 class="mb-4" data-ppt-f4a>Is my credit card information secure?</h5>
            <p class="mb-0" data-ppt-f4b>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod maecenas.</p>
          </div>
        </div>
      </div>
      <!-- /column -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container -->
</section>
<!-- /section -->
    
    
     
 
  
<?php
 

		$output = ob_get_contents();
		ob_end_clean();
echo ppt_theme_block_output($output, $df, array("text", "text109"));
	
	}
		public static function css(){
		ob_start();
?>
<style>
.icon-wrap { display: inline-block;    border-radius: 10%;    width: 30px;    height: 30px;    text-align: center;    margin-right: 20px;    line-height: 30px; }
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
