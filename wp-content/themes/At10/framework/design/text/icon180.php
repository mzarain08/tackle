<?php
 
add_filter( 'ppt_blocks_args', 	array('block_icon180',  'data') );
add_action( 'icon180',  		array('block_icon180', 'output' ) );
add_action( 'icon180-css',  	array('block_icon180', 'css' ) );
add_action( 'icon180-js',  	array('block_icon180', 'js' ) );

class block_icon180 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['icon180'] = array(
			"name" 		=> "Style 179",
			"image"		=> "icon180.jpg",
			"cat"		=> array("text","icon"),
			"desc" 		=> "", 
			"order" 	=> 179, 
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
			"btn2" => 1,		 
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
		1 => "Advanced Variable products with swatches",
		2 => "Art & Design",
		3 => "Lifestyle",
		4 => "Marketing",
		5 => "Fun & Challenging",
		6 => "Health & Fitness",
		7 => "Major or Minor",
		8 => "Academics", 
		
		9 => "Fitness", 
		
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
		
		9 => "fa-leaf",
	);
 
	ob_start();
	
	?>

<section class="section-60 bg-white">
  <div class="container">
 
 
        
<div class="row">

<div class="col-12 mb-4">


<div class="text-700 mb-5 fs-xl text-center" data-ppt-title>Our Featured Services</div>



</div>


 

 <div class="col-md-12">
        <div class="row">
         
         <?php  $i=1; while($i < 10){ ?>
         
          <div class="<?php if(in_array($i,array("1","3","4","5","7","8"))){ ?>col-md-4 text-center<?php }else{ ?>col-md-8<?php } ?> mb-4">
          
          	<?php if(in_array($i,array("1","3","4","5","7","8"))){ ?>
            
            <div class="shadow-sm bg-light rounded-lg h-100">
            	 
                <div data-ppt-f<?php echo $i; ?>image class="mb-4"><span class="fal <?php echo $icons[$i]; ?> fa-6x text-primary" data-ppt-f<?php echo $i; ?>icon> </span></div>
                
                <div class="col-11 mx-auto mb-5">
                
                <div class="mb-2 lh-30 text-700 fs-5" data-ppt-f<?php echo $i; ?>a><?php echo $text[$i]; ?></div>
                
                <div class="opacity-5" data-ppt-f<?php echo $i; ?>b>Nulla vitae elit libero, a pharetra augue. Donec id elit non mi porta gravida.</div>
                
             	</div>
                
            </div>
            
            <?php }elseif(in_array($i,array("2","6","9"))){ ?>
            
            <div class="shadow-sm bg-light rounded-lg h-100 d-flex align-items-end">
            
            
            <div class="row">
            
            <div class="col-md-7 text-center">
            
            <div data-ppt-f<?php echo $i; ?>image class="mobile-mb-4"><span class="fal <?php echo $icons[$i]; ?> fa-6x text-primary" data-ppt-f<?php echo $i; ?>icon> </span></div>
            
            </div>
            
            <div class="col-md-5 y-middle">
            
            <div class="mr-lg-4">
              <div class="mb-4 lh-40 fs-md text-700" data-ppt-f<?php echo $i; ?>a><?php echo $text[$i]; ?></div>
                
                <div class="opacity-5" data-ppt-f<?php echo $i; ?>b>Nulla vitae elit libero, a pharetra augue. Donec id elit non mi porta gravida. Nulla vitae elit libero, a pharetra augue. Donec id elit non mi porta gravida.</div>
            </div>
            
            </div>
            
            </div>
            
            
            </div> 
            
            <?php } ?>
            
           
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
echo ppt_theme_block_output($output, $text_settings, array("text", "icon180"));
	
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