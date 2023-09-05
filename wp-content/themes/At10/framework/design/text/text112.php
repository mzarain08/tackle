<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text112',  'data') );
add_action( 'text112',  		array('block_text112', 'output' ) );
add_action( 'text112-css',  	array('block_text112', 'css' ) );
add_action( 'text112-js',  	array('block_text112', 'js' ) );

class block_text112 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text112'] = array(
			"name" 		=> "Style 112",
			"image"		=> "text112.jpg",
			"cat"		=> array("text", "testimonials"),
			"desc" 		=> "", 
			"order" 	=> 0, 
			"widget" => "ppt-text",	
			"data" 	=> array( ),	
			
			"defaults" => array( ), 
			
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $text_settings;
	 	
		 
		 $df = array(
		 	"image1" => DEMO_IMGS."?fw=text112&b=1&t=".THEME_KEY,
			"image2" => DEMO_IMGS."?fw=text112&b=2&t=".THEME_KEY,
			"image3" => DEMO_IMGS."?fw=text112&b=3&t=".THEME_KEY,
			"image4" => DEMO_IMGS."?fw=text112&b=4&t=".THEME_KEY,
			"image5" => DEMO_IMGS."?fw=text112&b=5&t=".THEME_KEY,
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


<section class="section-60 ppt-block-text">

  <div class="container">
  
    <h6 class="mb-3 text-uppercase text-primary" data-ppt-desc>Our Clients</h6>
    
    <div class="row mb-10 mobile-mb-2">
      
      <div class="col-lg-6">
       
        <h2 data-ppt-title>We are trusted by over 50,00+ clients worldwide. </h2>
     
      </div>
      
      
      <div class="col-lg-6">
       
        <p class="lead mb-0" data-ppt-subtitle>Donec ullamcorper nulla non metus auctor fringilla. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Lorem ipsum dolor sit amet.</p>
    
      </div>
      
    </div>
    
    
    
    <div class="row row-cols-2 row-cols-md-3 row-cols-xl-5 gx-lg-6 gy-6 justify-content-center mt-5">
      <div class="col">
        <div class="p3 mb-3" ppt-border1>
          <div class="card-body align-items-center d-flex px-3 py-6">
            <figure class="px-md-3 mb-0"><img data-src="<?php echo $df['image1']; ?>" alt="image" class="img-fluid lazy"  data-ppt-image1  /></figure>
          </div>
          
        </div>
        
      </div>
      
      <div class="col">
        <div class="p3 mb-3" ppt-border1>
          <div class="card-body align-items-center d-flex px-3 py-6">
            <figure class="px-md-3 mb-0"><img data-src="<?php echo $df['image2']; ?>" alt="image" class="img-fluid lazy"  data-ppt-image2  /></figure>
          </div>
          
        </div>
        
      </div>
      
      <div class="col">
        <div class="p3 mb-3" ppt-border1>
          <div class="card-body align-items-center d-flex px-3 py-6 ">
            <figure class="px-md-3 mb-0"><img data-src="<?php echo $df['image3']; ?>" alt="image" class="img-fluid lazy"  data-ppt-image3  /></figure>
          </div>
          
        </div>
        
      </div>
      
      <div class="col">
        <div class="p3 mb-3" ppt-border1>
          <div class="card-body align-items-center d-flex px-3 py-6">
            <figure class="px-md-3 mb-0"><img data-src="<?php echo $df['image4']; ?>" alt="image" class="img-fluid lazy" data-ppt-image4 /></figure>
          </div>
          
        </div>
        
      </div>
      
      <div class="col hide-mobile">
        <div class="p3 mb-3" ppt-border1>
          <div class="card-body align-items-center d-flex px-3 py-6 p-md-8">
            <figure class="px-md-3 mb-0"><img data-src="<?php echo $df['image5']; ?>" alt="image" class="img-fluid lazy"  data-ppt-image5  /></figure>
          </div>
          
        </div>
        
      </div>
      
    </div>
    <!--/.row -->
  </div>
  <!-- /.container -->
</section>
<!-- /section -->

  
<?php
 

		$output = ob_get_contents();
		ob_end_clean();
echo ppt_theme_block_output($output, $text_settings, array("text", "text112"));
	
	}
		public static function css(){
		ob_start();
?>
<style>
.text112 .hide {display:none; }
.text112 .card-header {
    margin-bottom: 0;
    background: 0 0;
    border: 0;
    padding: 0.9rem 1.3rem 0.85rem;
	
}
.text112 .card-header .btn { font-size:16px; }
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
