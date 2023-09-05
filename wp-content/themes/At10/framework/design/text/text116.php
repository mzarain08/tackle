<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text116',  'data') );
add_action( 'text116',  		array('block_text116', 'output' ) );
add_action( 'text116-css',  	array('block_text116', 'css' ) );
add_action( 'text116-js',  	array('block_text116', 'js' ) );

class block_text116 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text116'] = array(
			"name" 		=> "Style 116",
			"image"		=> "text116.jpg",
			"cat"		=> array("text","icon"),
			"desc" 		=> "", 
			"order" 	=> 0, 
			"widget" => "ppt-text",	
			"data" 	=> array( ),	
			
			"defaults" => array( ), 
			
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $text_settings;
	 	 
		 $df = array(
		 	"image" => DEMO_IMGS."?fw=text116&t=".THEME_KEY,
			"btn1" => 0,
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
	 
	?>
    
    
<section class="section-60">

  <div class="container">
  
    <h2 class="mb-3" data-ppt-title>How does it work?</h2>
    
    <p class="lead mb-5" data-ppt-subtitle>It's quick and easy to get started - learn how.</p>
    
    <div class="row subline line">
      <div class="col-md-6 col-lg-3 mobile-mb-2"> <span class="number-box bg-primary"><span class="number ">01</span></span>
        <h5 class="mb-1 my-sm-3" data-ppt-f1a>Step 1</h5>
        <p class="mb-0" data-ppt-f1b>Nulla vitae elit libero elit non porta gravida eget metus cras. Aenean eu leo quam. Pellentesque ornare.</p>
      </div>
 
      <div class="col-md-6 col-lg-3 mobile-mb-2"> <span class="number-box bg-primary"><span class="number">02</span></span>
        <h5 class="mb-1 my-sm-3" data-ppt-f2a>Step 2</h5>
        <p class="mb-0" data-ppt-f2b>Vestibulum id ligula porta felis euismod semper. Sed posuere consectetur est at lobortis.</p>
      </div>
  
      <div class="col-md-6 col-lg-3 mobile-mb-2"> <span class="number-box bg-primary"><span class="number">03</span></span>
        <h5 class="mb-1 my-sm-3" data-ppt-f3a>Step 3</h5>
        <p class="mb-0" data-ppt-f3b>Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Nulla vitae elit libero.</p>
      </div>
   
      <div class="col-md-6 col-lg-3 mobile-mb-2"> <span class="number-box bg-primary"><span class="number">04</span></span>
        <h5 class="mb-1 my-sm-3" data-ppt-f4a>Step 4</h5>
        <p class="mb-0" data-ppt-f4b>Integer posuere erat, consectetur adipiscing elit. Fusce dapibus, tellus ac cursus commodo.</p>
      </div>
   
    </div>
 
  </div>
 
</section> 
    <?php


		$output = ob_get_contents();
		ob_end_clean();
echo ppt_theme_block_output($output, $text_settings, array("text", "text116") );
	
	}
		public static function css(){

		ob_start();
		?>
 <style>
 @media (min-width: 992px){
.subline.line [class*=col-]:after {
    width: 100%;
    position: absolute;
    content: "";
    height: 1px;
    background: 0 0;
    border-top: 1px solid rgba(164,174,198,.2);
    top: 1.5rem;
    z-index: 0;
    left: 3rem;
}
}
 @media (max-width: 600px){
.number-box { float:left; }
 }
.number-box {
    width: 60px;
    height: 60px;
    font-size: 22px;
    display: inline-block;
    margin-right: 30px;
    border-radius: 100%;
    text-align: center;
    line-height: 60px;
    font-weight: 600;
	color:#fff;
	z-index:2;
	position: relative;
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