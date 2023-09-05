<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text170',  'data') );
add_action( 'text170',  		array('block_text170', 'output' ) );
add_action( 'text170-css',  	array('block_text170', 'css' ) );
add_action( 'text170-js',  	array('block_text170', 'js' ) );

class block_text170 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text170'] = array(
			"name" 		=> "Style 170",
			"image"		=> "text170.jpg",
			"cat"		=> array("text","icon"),
			"desc" 		=> "", 
			"order" 	=> 170, 
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

<section class="section-60  bg-light">
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
	
	$icon = array(
		1 => "fa-sync",
		2 => "fa-tree",
		3 => "fa-book",
		4 => "fa-mobile",
		5 => "fa-car",
 
	);
	
	$i=1; $img=1; while($i < 9){ 
	
	$e=1;
	if(in_array($i,array(2,4,5,7,9))){ $e=0; }
	
	?>
      <div class="col-lg-3 mb-4 <?php if($e){ }else{ ?>px-0<?php } ?>">
        
        
       <?php if($e){ ?>
       <div class="rounded-lg p-5 y-middle bg-white ">
       <div class="">
              <div class="mb-1 fs-5 text-600" data-ppt-f<?php echo $i; ?>a>
                <?php echo $text[$i]; ?>
              </div>
              <p class="mb-0 opacity-5 mobile-mb-2" data-ppt-f<?php echo $i; ?>b>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sodales lobortis.</p>
            </div>
        </div>
            <?php }else{ ?>
            
            <div class="px-lg-5 text-center">
            
          
          <div data-ppt-f<?php echo $img; ?>image class=" mb-4"><span class="fal <?php echo $icon[$img]; ?> fa-5x hide-mobile" data-ppt-f<?php echo $img; ?>icon>&nbsp;</span></div>
             </div>
            <?php $img++; } ?>
            
      
      </div>
      <?php $i++; } ?>
    </div>
  </div>
</section>
<?php
 

		$output = ob_get_contents();
		ob_end_clean();
echo ppt_theme_block_output($output, $text_settings, array("text", "text170"));
	
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