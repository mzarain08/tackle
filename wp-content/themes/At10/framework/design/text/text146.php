<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text146',  'data') );
add_action( 'text146',  		array('block_text146', 'output' ) );
add_action( 'text146-css',  	array('block_text146', 'css' ) );
add_action( 'text146-js',  	array('block_text146', 'js' ) );

class block_text146 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text146'] = array(
			"name" 		=> "Style 146",
			"image"		=> "text146.jpg",
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
		 	"image" => DEMO_IMGS."?fw=text116&t=".THEME_KEY,
			"btn1" => 0,
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
	
	// BLOCK WRAP
	 
	?> 


<section id="stats" class="stats bg-light-gray padding-top padding-bottom">
    <div class="container">
    
        <div class="row m-0">
        
            <div class="col-12 col-md-10 offset-md-1 col-lg-7 offset-lg-0 text-left p-0 text-center text-lg-left pr-lg-5 y-middle">
            
                <div>
                
                    <div class="home-text text-black">
                       
                        <span class="text-primary text-700" data-ppt-subtitle>Let us show you some stats</span>
                       
                        <h4 class="mt-3 mb-4 fs-lg text-700" data-ppt-title>We have done great stuff over the past few years.</h4>
                      
                       <p class="lh-30" data-ppt-desc>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat.</p>
                   
                    </div>
                </div>
            </div>
            
            <div class="col-12 col-lg-5 d-flex justify-content-end">
                <div class="plant-img">
                        <img src="<?php echo $df['image']; ?>" class="img-fluid" alt="img" data-ppt-image>
                </div>
            </div>
        </div>

        <div class="row mt-4 hide-mobile">
            <div class="col-12">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="stats-box d-flex">
                          
                                <span class="fa fa-2x fa-users mt-3 text-primary"></span>
                          
                            <div class="stats-box-text ml-4">
                                <div class="ppt-countup fs-lg text-700" data-ppt-f1a>500</div>
                                <p class="stat-sub-heading" data-ppt-f1b>Happy Clients</p>
                            </div>
                           
                        </div>
                    </div>

                    <div class="col-12 col-md-4 mt-4 mt-md-0">
                        <div class="stats-box d-flex">
                           
                                <span class="fa  fa-2x  fa-list color-blue mt-3 text-primary"></span>
                          
                            <div class="stats-box-text ml-4">
                                <div class="ppt-countup fs-lg text-700" data-ppt-f2a>10740</div>
                                <p class="stat-sub-heading" data-ppt-f2b>Lines of Code</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4 mt-4 mt-md-0 wow fadeInUp">
                        <div class="stats-box d-flex">
                           
                                <span class="fa  fa-2x  fa-check mt-3 text-primary"></span>
                          
                            <div class="stats-box-text ml-4">
                                <div class="ppt-countup fs-lg text-700" data-ppt-f3a>200</div>
                                <p class="stat-sub-heading" data-ppt-f3b>Project Completed</p>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>

<?php


		$output = ob_get_contents();
		ob_end_clean();
echo ppt_theme_block_output($output, $text_settings, array("text", "text146") );
	
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
