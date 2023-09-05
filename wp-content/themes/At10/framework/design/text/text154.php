<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text154',  'data') );
add_action( 'text154',  		array('block_text154', 'output' ) );
add_action( 'text154-css',  	array('block_text154', 'css' ) );
add_action( 'text154-js',  	array('block_text154', 'js' ) );

class block_text154 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text154'] = array(
			"name" 		=> "Style 154",
			"image"		=> "text154.jpg",
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
		 
		 	"image1" =>  DEMO_IMG_PATH."icons/1.png",
			"image2" => DEMO_IMG_PATH."icons/2.png",
			"image3" => DEMO_IMG_PATH."icons/3.png",
			
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

<section class="section-60 bg-white">
  <div class="container">
    <div class="row align-items-center">
      <?php 
	
	$text = array(
		1 => "Save Time &amp; Money",
		2 => "Easy to Customize",
		3 => "Easy Install &amp; Setup",
		
	);
	
	$i=1; while($i < 4){ ?>
      <div class="col-lg-4 text-lg-center">
        <div class="px-lg-5">
          <div class="row">
            <div class="col-6 col-sm-4 col-lg-12">
              <figure class="rounded mb-4">
                <div data-ppt-f<?php echo $i; ?>image>
                  <img data-src="<?php echo $df['image'.$i]; ?>" class="img-fluid lazy"  alt="image" data-ppt-image<?php echo $i; ?>>
                </div>
              </figure>
            </div>
            <div class="col-12 col-sm-8 col-lg-12">
              <div class="mb-3 fs-5 text-600" data-ppt-f<?php echo $i; ?>a>
                <?php echo $text[$i]; ?>
              </div>
              <p class="mb-0 lh-30 mobile-mb-2" data-ppt-f<?php echo $i; ?>b>Consectetur
                adipisicing elit sed do eiusmod tempor incididunt utnale labore
                etdolore</p>
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
echo ppt_theme_block_output($output, $text_settings, array("text", "text154"));
	
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