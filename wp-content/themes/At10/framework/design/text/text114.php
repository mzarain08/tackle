<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text114',  'data') );
add_action( 'text114',  		array('block_text114', 'output' ) );
add_action( 'text114-css',  	array('block_text114', 'css' ) );
add_action( 'text114-js',  	array('block_text114', 'js' ) );

class block_text114 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text114'] = array(
			"name" 		=> "Style 114",
			"image"		=> "text114.jpg",
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
		 	"image1" => DEMO_IMGS."?fw=text114&b=1&t=".THEME_KEY,
			"image2" => DEMO_IMGS."?fw=text114&b=2&t=".THEME_KEY,
			"image3" => DEMO_IMGS."?fw=text114&b=3&t=".THEME_KEY,
			"image4" => DEMO_IMGS."?fw=text114&b=4&t=".THEME_KEY,
			"image5" => DEMO_IMGS."?fw=text114&b=5&t=".THEME_KEY,
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

<section class="section-60 ppt-text-block">
  <div class="container py-14 py-md-16">
    <div class="row align-items-center">
    
    
          <div class="col-lg-5">
      
        <h6 class="mb-4 text-primary text-uppercase" data-ppt-desc>Get Started</h6>
       
        <h2 class="mb-5" data-ppt-title>Signup now and get started today - it's quick and easy.</h2>
       
        <p data-ppt-subtitle>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Maecenas sed diam eget risus varius blandit sit amet non magna. Maecenas faucibus mollis interdum. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</p>
       
        
      </div>
    
      <div class="col-lg-7">
        <div class="row">
         
        
          <div class="col-md-5 offset-md-1 align-self-end mb-4">
          
            <div class="p-4" ppt-border1>
            
               <div data-ppt-f1image class="mb-4 hide-mobile"><span class="fal fa-life-ring fa-4x hide-mobile text-primary" data-ppt-f1icon>&nbsp;</span></div>
                <h5 class="mb-4" data-ppt-f1a>24/7 Support</h5>
                <p class="mb-0" data-ppt-f1b>Nulla vitae elit libero, a pharetra augue. Donec id elit non mi porta.</p>
             
            </div>
            <!--/.card -->
          </div>
          <!--/column -->
          <div class="col-md-6 align-self-end mb-4">
            <div class="p-4" ppt-border1>
          
                 <div data-ppt-f2image class=" mb-4 hide-mobile"><span class="fal fa-lock fa-4x hide-mobile text-primary" data-ppt-f2icon>&nbsp;</span></div>
                <h5 class="mb-4" data-ppt-f2a>Secure Payments</h5>
                <p class="mb-0" data-ppt-f2b>Nulla vitae elit libero, a pharetra augue. Donec id elit non mi porta.</p>
         
            </div>
            <!--/.card -->
          </div>
          <!--/column -->
          <div class="col-md-5 mb-4">
            <div class="p-4" ppt-border1>
            
                 <div data-ppt-f3image class="mb-4 hide-mobile"><span class="fal fa-sync fa-4x text-primary" data-ppt-f3icon>&nbsp;</span></div>
                <h5 class="mb-4" data-ppt-f3a>Monthly Updates</h5>
                <p class="mb-0" data-ppt-f3b>Nulla vitae elit libero, a pharetra augue.</p>
           
            </div>
            <!--/.card -->
          </div>
          <!--/column -->
          <div class="col-md-6 align-self-start mb-4">
            <div class="p-4" ppt-border1>
          
                <div data-ppt-f4image class="hide-mobile mb-4"><span class="fal fa-envelope fa-4x text-primary" data-ppt-f4icon>&nbsp;</span></div>
                <h5 class="mb-4" data-ppt-f4a>Email Us Anytime</h5>
                <p class="mb-0" data-ppt-f4b>Nulla vitae elit libero, a pharetra augue. Donec id elit non mi porta gravida at eget.</p>
           
            </div>
            <!--/.card -->
          </div>
          <!--/column -->
        </div>
        <!--/.row -->
      </div>
   
    </div>
    <!--/.row -->
  </div>
 
</section> 
  
<?php
 

		$output = ob_get_contents();
		ob_end_clean();
echo ppt_theme_block_output($output, $text_settings, array("text", "text114"));
	
	}
		public static function css(){
		ob_start();
?>
<style>
.text114 .hide {display:none; }
.text114 .card-header {
    margin-bottom: 0;
    background: 0 0;
    border: 0;
    padding: 0.9rem 1.3rem 0.85rem;
	
}
.text114 .card-header .btn { font-size:16px; }
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
