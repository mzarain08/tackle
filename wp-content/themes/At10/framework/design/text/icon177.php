<?php
 
add_filter( 'ppt_blocks_args', 	array('block_icon177',  'data') );
add_action( 'icon177',  		array('block_icon177', 'output' ) );
add_action( 'icon177-css',  	array('block_icon177', 'css' ) );
add_action( 'icon177-js',  	array('block_icon177', 'js' ) );

class block_icon177 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['icon177'] = array(
			"name" 		=> "Icons 177",
			"image"		=> "icon177.jpg",
			"cat"		=> array("text","icon"),
			"desc" 		=> "", 
			"order" 	=> 0, 
			"widget" => "ppt-icon",	
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
		 
	$text = array(
		1 => "Data Science",
		2 => "Art & Design",
		3 => "Lifestyle",
		4 => "Marketing",
		5 => "Fun & Challenging",
		6 => "Health & Fitness",
		7 => "Major or Minor",
		8 => "Academics", 
	);
	
	$icons = array(
		1 => "fa-life-ring",
		2 => "fa-star",
		3 => "fa-sync",
		4 => "fa-lock",
		5 => "fa-book",
		6 => "fa-car",
		7 => "fa-tree",
		8 => "fa-cog", 
	);
 
	ob_start();
	
	?>

<section class="section-60">
  <div class="container">
   
    <div class="row">
    
<?php if($df['title_show'] != "0"){ ?>
<div class="col-12 mb-4">

<div class="text-600 mb-3  text-center fs-lg" data-ppt-title>Featured Categories</div>
 
<div data-ppt-subtitle class="mb-4  text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>

</div>
<?php } ?>
    
      <?php  $i=1; while($i < 7){ ?>
      <div class="col-lg-4 mb-4">
        
        <div class="border-3 rounded-lg bg-white">
        
        
        <div class="d-flex p-3">
          <figure class="pl-3">
                <div data-ppt-f<?php echo $i; ?>image>
                  <span class="fal <?php echo $icons[$i]; ?> fa-3x text-primary" data-ppt-f<?php echo $i; ?>icon>&nbsp;</span> 
                </div>
              </figure>
         
            <div class="pl-3">
              <div class="mb-1 fs-5 text-600" data-ppt-f<?php echo $i; ?>a>
                <?php echo $text[$i]; ?>
              </div>
              <p class="mb-0 opacity-5" data-ppt-f<?php echo $i; ?>b>Lorem ipsum dolor sit amet.</p>
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
echo ppt_theme_block_output($output, $text_settings, array("text", "icon177"));
	
	}
		public static function css(){
		ob_start(); 
?>
<style>
.border-3 {  border: 2px solid #f3f3f3;}
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