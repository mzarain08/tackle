<?php
 
add_filter( 'ppt_blocks_args', 	array('block_icon178',  'data') );
add_action( 'icon178',  		array('block_icon178', 'output' ) );
add_action( 'icon178-css',  	array('block_icon178', 'css' ) );
add_action( 'icon178-js',  	array('block_icon178', 'js' ) );

class block_icon178 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['icon178'] = array(
			"name" 		=> "Style 178",
			"image"		=> "icon178.jpg",
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
  <div class="container-slim">
 
 
        
<div class="row">


<?php if($df['title_show'] != "0"){ ?>
<div class="col-12 text-center mb-4">

<div class="text-600 mb-3 fs-lg" data-ppt-title>Our Featured Services</div>
 
<div data-ppt-subtitle class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>

</div>
<?php } ?>

 <div class="col-12">
        <div class="row">
         
         <?php  $i=1; while($i < 7){ ?>
          <div class="col-md-4 mb-4">
          
            <div class="p-4 shadow-sm bg-white rounded-lg">
            	
                
                <div ppt-flex-between>
                
                <div data-ppt-f1image class=" mb-4"><span class="fal <?php echo $icons[$i]; ?> fa-4x text-primary" data-ppt-f1icon>&nbsp;</span></div>
                
                <div class="fs-xl text-700 text-light">0<?php echo $i; ?></div>
                
                </div>
                
                <h5 class="mb-4" data-ppt-f1a><?php echo $text[$i]; ?></h5>
                <p class="mb-0" data-ppt-f1b>Nulla vitae elit libero, a pharetra augue. Donec id elit non mi porta gravida at eget.</p>
             
            </div>
           
          </div>
      <?php $i++; } ?>
           
           
 
        </div>
      
      </div> 

</div>
 
 
 
  </div>
</section>
<?php
 

		$output = ob_get_contents();
		ob_end_clean();
echo ppt_theme_block_output($output, $text_settings, array("text", "icon178"));
	
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