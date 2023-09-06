<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text131',  'data') );
add_action( 'text131',  		array('block_text131', 'output' ) );
add_action( 'text131-css',  	array('block_text131', 'css' ) );
add_action( 'text131-js',  	array('block_text131', 'js' ) );

class block_text131 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text131'] = array(
			"name" 		=> "Style 131",
			"image"		=> "text131.jpg",
			"cat"		=> array("text","icon"),
			"desc" 		=> "", 
			"order" 	=> 0, 
			"widget" => "ppt-text",	
			"data" 	=> array( ),	
			
			"defaults" => array( ), 
			
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE,$CORE_UI, $text_settings;
	 	
		 
		 $df = array(
		 	"image" => DEMO_IMGS."?fw=text131&t=".THEME_KEY,
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
    

    
<section class="section-0 ppt-block-text hide-mobile">

  <div class="container mb-3">
  
 
<div class="d-flex justify-content-lg-between shadow-lg" ppt-border1>
  <div  class=" w-100  mb-lg-0 ">
  
    <div class="d-flex flex-row p-3 ">
      <div  class="mr-3 text-primary">
        <div ppt-icon-size="64" data-ppt-icon>
          <?php echo $CORE_UI->icons_svg['verified']; ?>
        </div>
      </div>
      <div>
         <div class="opacity-5" data-ppt-f1a>Components</div>
        <div class="fs-lg text-700" ><span class="ppt-countup" data-ppt-f1b>1000</span>+</div>
      </div>
    </div>
  </div>
  
  <div  class="mx-lg-3 border-left border-right w-100  mb-2 mb-lg-0">
    <div class="d-flex flex-row p-3">
      <div  class="mr-3 text-primary">
        <div ppt-icon-size="64" data-ppt-icon2>
          <?php echo $CORE_UI->icons_svg['pages']; ?>
        </div>
      </div>
      <div>
          <div class="opacity-5" data-ppt-f2a>Page Sections</div>
       <div class="fs-lg text-700" ><span class="ppt-countup" data-ppt-f2b>250</span>+</div>   
      </div>
    </div>
  </div>
  
  <div  class="mr-lg-3 border-right w-100 mb-lg-0 hide-ipad">
    <div class="d-flex flex-row p-3">
      <div  class="mr-3 text-primary">
        <div ppt-icon-size="64" data-ppt-icon3>
          <?php echo $CORE_UI->icons_svg['desktop']; ?>
        </div>
      </div>
      <div>
          <div class="opacity-5" data-ppt-f3a>Pre-built Designs</div>
       <div class="fs-lg text-700" ><span class="ppt-countup" data-ppt-f3b>35</span>+</div>   
      </div>
    </div>
  </div>
  
  <div class=" w-100 hide-ipad hide-mobile">
    <div class="d-flex flex-row p-3">
      <div  class="mr-3 text-primary">
        <div ppt-icon-size="64" data-ppt-icon4>
          <?php echo $CORE_UI->icons_svg['smile']; ?>
        </div>
      </div>
      <div>
      <div class="opacity-5" data-ppt-f4a>Admin Options</div>
        <div class="fs-lg text-700" ><span class="ppt-countup" data-ppt-f4b>300</span>+</div>
      </div>
    </div>
  </div>
</div> 
 
  </div>
 
</section>
 
  
<?php
 

		$output = ob_get_contents();
		ob_end_clean();
echo ppt_theme_block_output($output, $text_settings, array("text", "text131"));
	
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
