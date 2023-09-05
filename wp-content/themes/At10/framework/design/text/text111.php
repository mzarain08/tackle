<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text111',  'data') );
add_action( 'text111',  		array('block_text111', 'output' ) );
add_action( 'text111-css',  	array('block_text111', 'css' ) );
add_action( 'text111-js',  	array('block_text111', 'js' ) );

class block_text111 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text111'] = array(
			"name" 		=> "Style 111",
			"image"		=> "text111.jpg",
			"cat"		=> array("text","faq"),
			"desc" 		=> "", 
			"order" 	=> 0, 
			"widget" => "ppt-text",	
			"data" 	=> array( ),	
			
			"defaults" => array( ), 
			
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $text_settings;
	 	
		 
		 $df = array(
		 	"image" => DEMO_IMGS."?fw=text111&t=".THEME_KEY,
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
<section class="section-60 ppt-block-text text111">
  <div class="container py-14 py-md-16">
    
    <h2 class="mb-3" data-ppt-title>Common FAQ</h2>
    
    <p class="lead mb-5" data-ppt-subtitle>Contact us if you need any more help.</p>
    
    <div class="row">
      <div class="col-lg-6 mb-0">
     
          <div class="ppt-show-hide mb-4" ppt-border1>
            <div class="card-header">
              <div class="text-600" data-ppt-f1a>Can I cancel my subscription?</div>
            </div>
            
            <div class="hide">
              <div class="card-body">
                <p  data-ppt-f1b>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Cras mattis consectetur purus sit amet fermentum. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec sed odio dui. Cras justo odio, dapibus ac facilisis.</p>
              </div>
              
            </div>
            
          </div>
          
          <div class="ppt-show-hide mb-4" ppt-border1>
            <div class="card-header">
              <div class="text-600" data-ppt-f2a>Which payment methods do you accept?</div>
            </div>
            
            <div class="hide">
              <div class="card-body">
                <p data-ppt-f2b>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Cras mattis consectetur purus sit amet fermentum. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec sed odio dui. Cras justo odio, dapibus ac facilisis.</p>
              </div>
              
            </div>
            
          </div>
          
          <div class="ppt-show-hide mb-4" ppt-border1>
            <div class="card-header">
              <div class="text-600" data-ppt-f3a>How can I manage my Account?</div>
            </div>
            
            <div class="hide">
              <div class="card-body">
                <p data-ppt-f3b>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Cras mattis consectetur purus sit amet fermentum. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec sed odio dui. Cras justo odio, dapibus ac facilisis.</p>
              </div>
              
            </div>
            
          </div>
          
          <div class="ppt-show-hide mb-4" ppt-border1>
            <div class="card-header">
              <div class="text-600" data-ppt-f4a>Is my credit card information secure?</div>
            </div>
            
            <div class="hide">
              <div class="card-body">
                <p data-ppt-f4b>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Cras mattis consectetur purus sit amet fermentum. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec sed odio dui. Cras justo odio, dapibus ac facilisis.</p>
              </div>
              
            </div>
            
          </div>
          
    
      </div>
      
      <div class="col-lg-6">
  
          <div class="ppt-show-hide mb-4" ppt-border1>
            <div class="card-header">
              <div class="text-600" data-ppt-f5a>How do I get my subscription receipt?</div>
            </div>
            
            <div class="hide">
              <div class="card-body">
                <p data-ppt-f5b>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Cras mattis consectetur purus sit amet fermentum. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec sed odio dui. Cras justo odio, dapibus ac facilisis.</p>
              </div>
              
            </div>
            
          </div>
          
          <div class="ppt-show-hide mb-4" ppt-border1>
            <div class="card-header">
              <div class="text-600" data-ppt-f6a>Are there any discounts for people in need?</div>
            </div>
            
            <div class="hide">
              <div class="card-body">
                <p data-ppt-f6b>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Cras mattis consectetur purus sit amet fermentum. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec sed odio dui. Cras justo odio, dapibus ac facilisis.</p>
              </div>
              
            </div>
            
          </div>
          
          <div class="ppt-show-hide mb-4" ppt-border1>
            <div class="card-header">
              <div class="text-600" data-ppt-f7a>Do you offer a free trial edit?</div>
            </div>
            
            <div class="hide">
              <div class="card-body">
                <p data-ppt-f7b>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Cras mattis consectetur purus sit amet fermentum. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec sed odio dui. Cras justo odio, dapibus ac facilisis.</p>
              </div>
              
            </div>
            
          </div>
          
          <div class="ppt-show-hide mb-4" ppt-border1>
            <div class="card-header">
              <div class="text-600" data-ppt-f8a>How do I reset my Account password?</div>
            </div>
            
            <div class="hide">
              <div class="card-body">
                <p data-ppt-f8b>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Cras mattis consectetur purus sit amet fermentum. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec sed odio dui. Cras justo odio, dapibus ac facilisis.</p>
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
echo ppt_theme_block_output($output, $text_settings, array("text", "text111"));
	
	}
		public static function css(){
		ob_start();
?>
<style>
 
.text111 .card-header {
    margin-bottom: 0;
    background: 0 0;
    border: 0;
    padding: 0.9rem 1.3rem 0.85rem;
	
}
.text111 .card-header .btn { font-size:16px; }
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
