<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text180',  'data') );
add_action( 'text180',  		array('block_text180', 'output' ) );
add_action( 'text180-css',  	array('block_text180', 'css' ) );
add_action( 'text180-js',  	array('block_text180', 'js' ) );

class block_text180 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text180'] = array(
			"name" 		=> "Style 180",
			"image"		=> "text180.jpg",
			"cat"		=> array("text","icon"),
			"desc" 		=> "", 
			"order" 	=> 180, 
			"widget" => "ppt-text",	
			"data" 	=> array( ),	
			
			"defaults" => array( ), 
			
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $text_settings;
	 	
		 
		 // ALL DEFAULT FIELDS
		 $df = ppt_theme_blocks_defaults("text"); 
		  
		$cc = array(
		
			"image" =>  "https://premiumpress1063.b-cdn.net/_demoimagesv10/icons/phone.png",
		 
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

<section class="section-60">
  <div class="container">
  
<div class="row">

<div class="col-12 mb-5">

<h2 class="text-700 mb-3 fs-lg text-center">Your big idea starts here</h2>

<div class="lead mb-3 text-center opacity-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>

</div>

</div>
  
  
<div class="row flex-column-reverse flex-sm-row justify-content-center align-items-center">

<div class="col-9 col-sm-6 col-md-5 col-lg-4 col-xl-3 text-sm-start">
                
                
<?php

	$text = array(
		1 => "Save Time &amp; Money",
		2 => "Easy to Customize",
		3 => "Easy Install &amp; Setup",
		4 => "Get Started Today",
	
			
	);
	$i=1;
	foreach($text as $t){ ?> 
                
					<div class="mb-4">
						<div class="mb-3 fs-5 text-600" data-ppt-f<?php echo $i; ?>a><?php echo $text[$i]; ?></div>
						  <p class="mb-0 opacity-5 mobile-mb-2" data-ppt-f<?php echo $i; ?>b>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
					</div>

<?php $i++; } ?>
                    
 
				</div>
				<div class="mb-sm-0 mobile-mb-4 col-8 col-sm-6 col-md-7 col-lg-5 col-xl-5 col-xxl-4 text-md-right">
				  <div data-ppt-image>
            <img data-src="<?php echo $df['image']; ?>" class="lazy" alt="phone" style="max-height: 650px;" />
          </div>
				</div>
			</div>
  
   
   
    </div>
  </div>
</section>
<?php
 

		$output = ob_get_contents();
		ob_end_clean();
echo ppt_theme_block_output($output, $df, array("text", "text180"));
	
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