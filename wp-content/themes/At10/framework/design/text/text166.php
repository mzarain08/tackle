<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text166',  'data') );
add_action( 'text166',  		array('block_text166', 'output' ) );
add_action( 'text166-css',  	array('block_text166', 'css' ) );
add_action( 'text166-js',  	array('block_text166', 'js' ) );

class block_text166 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text166'] = array(
			"name" 		=> "Style 166",
			"image"		=> "text166.jpg",
			"cat"		=> array("text","icon"),
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
		  
		$cc = array(
		 
		 	"image1" =>  DEMO_IMG_PATH."icons/a1.jpg",
			"image2" => DEMO_IMG_PATH."icons/a2.jpg",
			"image3" => DEMO_IMG_PATH."icons/a3.jpg",
			"image4" => DEMO_IMG_PATH."icons/a4.jpg",
			"image5" => DEMO_IMG_PATH."icons/a5.jpg",
			"image6" => DEMO_IMG_PATH."icons/a6.jpg",
			"image7" => DEMO_IMG_PATH."icons/a7.jpg",
			"image8" => DEMO_IMG_PATH."icons/a8.jpg",
			
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
		}   
		 
		 
 
	ob_start();
	
	?>

<section class="section-60 bg-white">
  <div class="container">
    <div class="row align-items-center">
      <?php 
	
	$text = array(
		1 => "Save Time &amp; Money",
		2 => "Easy to Customize",
		3 => "Easy Install &amp; Setup",
		4 => "Get Started Today",
		5 => "Get Started Today",
		6 => "Get Started Today",
		7 => "Get Started Today",
		8 => "Get Started Today",
		
		
	);
	
	$i=1; while($i < 7){ ?>
      <div class="col-lg-4 text-lg-center">
        <div class="px-lg-5">
          <div class="row">
            <div class="col-6 col-sm-4 col-lg-12">
              <figure class="rounded mb-4 mx-xl-5">
                <div data-ppt-f<?php echo $i; ?>image>
                  <img data-src="<?php echo $df['image'.$i]; ?>" class="img-fluid lazy"  alt="image" data-ppt-image<?php echo $i; ?>>
                </div>
              </figure>
            </div>
            <div class="col-12 col-sm-8 col-lg-12">
              <div class="mb-3 fs-5 text-600" data-ppt-f<?php echo $i; ?>a>
                <?php echo $text[$i]; ?>
              </div>
              <p class="mb-0 opacity-5 mobile-mb-2" data-ppt-f<?php echo $i; ?>b>Consectetur adipisicing elit sed do eiusmod.</p>
            </div>
          </div>
        </div>
      </div>
      <?php $i++; } ?>
    </div>
  </div>
</section>
<?php
 

		$output = ob_get_contents();
		ob_end_clean();
echo ppt_theme_block_output($output, $text_settings, array("text", "text166"));
	
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