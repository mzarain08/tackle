<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text110',  'data') );
add_action( 'text110',  		array('block_text110', 'output' ) );
add_action( 'text110-css',  	array('block_text110', 'css' ) );
add_action( 'text110-js',  	array('block_text110', 'js' ) );

class block_text110 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text110'] = array(
			"name" 		=> "Style 110",
			"image"		=> "text110.jpg",
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
		 	"image" => DEMO_IMGS."?fw=text110&t=".THEME_KEY,
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

  <div class="container py-14 py-md-16">
    <div class="row align-items-center">
    
      <div class="col-lg-6 mobile-mb-2">
      
        <h2 class="mb-3" data-ppt-title>24/7 Online Support</h2>
        
        <p class="lead" data-ppt-subtitle>We're here to help whenever you need us.</p>
        
        <p data-ppt-desc>Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
        
      </div>
    
    
      <div class="col-lg-6 order-lg-2 ">
      
      
        <div class="row align-items-center ppt-countup-wrapper">
          <div class="item col-md-6">
            <div class="p-3 mb-4" ppt-border1>
           
                <div class="d-flex d-lg-block d-xl-flex flex-row">
                  <div>
                    <div class="icon-wrap-1 bg-primary text-light"> <span class="fa fa-check"></span>  </div>
                  </div>
                  <div>
                    <h3 class="ppt-countup mb-1" data-ppt-f1a>98643</h3>
                    <p class="mb-0" data-ppt-f1b>Questions Answered</p>
                  </div>
                </div>
             
          
            </div>
         
          </div>
      
          <div class="item col-md-6">
           <div class="p-3 mb-4" ppt-border1>
          
                <div class="d-flex d-lg-block d-xl-flex flex-row">
                  <div>
                    <div class="icon-wrap-1 bg-primary text-light"> <span class="fa fa-check"></span> </div>
                  </div>
                  <div>
                    <h3 class="ppt-countup mb-1" data-ppt-f2a>64234</h3>
                    <p class="mb-0" data-ppt-f2b>Happy Customers</p>
                  </div>
                </div>
          
            
            </div>
       
          </div>
      
          <div class="item col-md-6">
            <div class="p-3 mb-4" ppt-border1>
            
                <div class="d-flex d-lg-block d-xl-flex flex-row">
                  <div>
                    <div class="icon-wrap-1 bg-primary text-light"> <span class="fa fa-check"></span> </div>
                  </div>
                  <div>
                    <h3 class="ppt-countup mb-1" data-ppt-f3a>127</h3>
                    <p class="mb-0" data-ppt-f3b>Expert Employees</p>
                  </div>
               
              </div>
              
            </div>
            
          </div>
          
          <div class="item col-md-6">
          
            <div class="mb-4 p-3" ppt-border1>
             
                <div class="d-flex d-lg-block d-xl-flex flex-row">
                  <div>
                    <div class="icon-wrap-1 bg-primary text-light"> <span class="fa fa-check"></span> </div>
                  </div>
                  <div>
                    <h3 class="ppt-countup mb-1" data-ppt-f4a>21</h3>
                    <p class="mb-0" data-ppt-f4b>Awards Won</p>
                  </div>
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
echo ppt_theme_block_output($output, $text_settings, array("text", "text110"));
	
	}
		public static function css(){
		ob_start();
?>
<style>
.icon-wrap-1 { display: inline-block;    border-radius: 10%;    width: 30px;    height: 30px;    text-align: center;    margin-right: 20px;    line-height: 30px; }
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
