<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text103',  'data') );
add_action( 'text103',  		array('block_text103', 'output' ) );
add_action( 'text103-css',  	array('block_text103', 'css' ) );
add_action( 'text103-js',  	array('block_text103', 'js' ) );

class block_text103 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text103'] = array(
			"name" 		=> "Style 103",
			"image"		=> "text103.jpg",
			"cat"		=> "text",
			"desc" 		=> "", 
			"order" 	=> 0, 
			"widget" => "ppt-text",	
			"data" 	=> array( ),	
			
			"defaults" => array( ), 
			
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $text_settings;
	 	
		 
		 $df = array(
		 	"image" => DEMO_IMGS."?fw=text103&t=".THEME_KEY,
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
<section class="section-60">

 
  <div class="container">
  
    <div class="row align-items-center">
      
      <div class="col-md-8 col-lg-6 position-relative pr-lg-5 mobile-mb-2">
        
        <figure class="rounded"><img data-src="<?php echo $df['image']; ?>" class="img-fluid lazy"  alt="image"  data-ppt-image></figure>
     
      </div>
     
      <div class="col-lg-6 pl-lg-5">
      
        <h2 class="mb-3" data-ppt-title>We love building WordPress themes that save you money.</h2>
        
        <p class="lead" data-ppt-subtitle>Lorem ipsum dolor sit amet.</p>
       
        <p class="mb-6" data-ppt-desc>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</p>
        
        
        
  <div class="row counter-wrapper gy-6">
          <div class="col-4">
            <h2 class="ppt-countup text-primary text-700" data-ppt-f1a>50000</h2>
            <p class="small" data-ppt-f1b>Customers Worldwide</p>
          </div>
           
          <div class="col-4">
            <h2 class="ppt-countup text-primary text-700" data-ppt-f2a>32472</h2>
            <p class="small" data-ppt-f2b>Satisfied Customers</p>
          </div>
           
          <div class="col-4">
            <h2 class="ppt-countup text-primary text-700" data-ppt-f3a>10</h2>
            <p class="small" data-ppt-f3b>Years Experience</p>
          </div>
        
        </div>
        
      </div>
       
     
    </div>
  
  </div>
</section>
<?php
		$output = ob_get_contents();
		ob_end_clean();
echo ppt_theme_block_output($output, $text_settings, array("text", "text103"));
	
	}
		public static function css(){

		ob_start();
		?>
<style>

 
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
