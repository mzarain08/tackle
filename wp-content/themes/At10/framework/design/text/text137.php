<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text137',  'data') );
add_action( 'text137',  		array('block_text137', 'output' ) );
add_action( 'text137-css',  	array('block_text137', 'css' ) );
add_action( 'text137-js',  	array('block_text137', 'js' ) );

class block_text137 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text137'] = array(
			"name" 		=> "Style 137",
			"image"		=> "text137.jpg",
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
		 	"image" => DEMO_IMGS."?fw=text137&t=".THEME_KEY,
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
<section class="section-60 ppt-block-text text137">
  <div class="container py-14 py-md-16">
    
   
    <div class="row">
      <div class="col-lg-4 mb-0">
     
       <h2 class="mb-3 fs-xl" data-ppt-title>Frequently Asked Questions</h2>
          
        
    
      </div>
      
      <div class="col-lg-6 offset-md-1">
  
          <div class="ppt-show-hide mb-4" ppt-border1>
            <div class="card-header py-4">
            <div class="d-flex justify-content-between">
            
            
              <div class="text-600" data-ppt-f1a>How do I get my subscription receipt?</div>
              
               <span class="fa fa-plus hide-show btn-show">&nbsp;</span> <span class="fa fa-minus show-hide btn-show">&nbsp;</span>
               </div>
              
            </div>
            
            <div class="hide">
              <div class="card-body">
                <p data-ppt-f1b>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Cras mattis consectetur purus sit amet fermentum. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec sed odio dui. Cras justo odio, dapibus ac facilisis.</p>
              </div>
              
            </div>
            
          </div>
          
          <div class="ppt-show-hide mb-4" ppt-border1>
            <div class="card-header py-4">
            
            <div class="d-flex justify-content-between">
              <div class="text-600" data-ppt-f2a>Are there any discounts for people in need?</div>
              
              <span class="fa fa-plus hide-show btn-show">&nbsp;</span> <span class="fa fa-minus show-hide btn-show">&nbsp;</span>
              </div>
              
            </div>
            
            <div class="hide">
              <div class="card-body">
                <p data-ppt-f2b>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Cras mattis consectetur purus sit amet fermentum. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec sed odio dui. Cras justo odio, dapibus ac facilisis.</p>
              </div>
              
            </div>
            
          </div>
          
          <div class="ppt-show-hide mb-4" ppt-border1>
            <div class="card-header py-4">
             
             <div class="d-flex justify-content-between">
              <div class="text-600" data-ppt-f3a>Do you offer a free trial edit?</div>
              
               <span class="fa fa-plus hide-show btn-show">&nbsp;</span> <span class="fa fa-minus show-hide btn-show">&nbsp;</span>
               </div>
              
            </div>
            
            <div class="hide">
              <div class="card-body">
                <p data-ppt-f3b>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Cras mattis consectetur purus sit amet fermentum. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec sed odio dui. Cras justo odio, dapibus ac facilisis.</p>
              </div>
              
            </div>
            
          </div>
          
          <div class="ppt-show-hide mb-4" ppt-border1>
            <div class="card-header py-4">
              
              <div class="d-flex justify-content-between">
              <div class="text-600" data-ppt-f4a>How do I reset my Account password?</div>
              
               <span class="fa fa-plus hide-show btn-show">&nbsp;</span> <span class="fa fa-minus show-hide btn-show">&nbsp;</span>
               </div>
              
              
            </div>
            
            <div class="hide">
              <div class="card-body">
                <p data-ppt-f4b>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Cras mattis consectetur purus sit amet fermentum. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec sed odio dui. Cras justo odio, dapibus ac facilisis.</p>
              </div>
              
            </div>
            
          </div>
     
        
      </div>
      
    </div>
    
  </div>
 
</section><?php
 

		$output = ob_get_contents();
		ob_end_clean();
echo ppt_theme_block_output($output, $text_settings, array("text", "text137"));
	
	}
		public static function css(){
		ob_start();
?>
<style>
 
.text137 .card-header {
    margin-bottom: 0;
    background: 0 0;
    border: 0;
    padding: 0.9rem 1.3rem 0.85rem;
	
}
.text137 .card-header .btn { font-size:16px; }
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
