<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text155',  'data') );
add_action( 'text155',  		array('block_text155', 'output' ) );
add_action( 'text155-css',  	array('block_text155', 'css' ) );
add_action( 'text155-js',  	array('block_text155', 'js' ) );

class block_text155 {

	function __construct(){}		

	public static function data($a){  global $CORE;
	
	
  
		$a['text155'] = array(
			"name" 		=> "Style 155",
			"image"		=> "text155.jpg",
			"cat"		=> array("text","faq"),
			"desc" 		=> "", 
			"order" 	=> 0, 
			"widget" => "ppt-text",	
			"data" 	=> array( ),	
			
			"defaults" => array( ), 
			
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $text_settings;
	 	
		 // ALL DEFAULT FIELDS
		 $df = ppt_theme_blocks_defaults("text"); 
		  
		$cc = array(	  
		
		
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
 
	ob_start();
	
	?>

<section class="section-60 ppt-block-text text155">
  <div class="container py-14 py-md-16">
    <div class="row">
      <div class="col-lg-6 mb-0">
        <div class="ppt-show-hide mb-4" ppt-border1>
          <div class="card-header py-4">
            <div class="d-flex justify-content-between">
              <div class="text-600" data-ppt-f1a>
                Can I cancel my subscription?
              </div>
              <span class="fa fa-plus hide-show btn-show">&nbsp;</span> <span class="fa fa-minus show-hide btn-show">&nbsp;</span>
            </div>
          </div>
          <div class="hide">
            <div class="card-body py-4">
              <p  data-ppt-f1b>Fusce dapibus, tellus ac cursus commodo, tortor
                mauris condimentum nibh, ut fermentum massa justo sit amet risus.
                Cras mattis consectetur purus sit amet fermentum. Praesent commodo
                cursus magna, vel scelerisque nisl consectetur et. Cum sociis
                natoque penatibus et magnis dis parturient montes, nascetur ridiculus
                mus. Donec sed odio dui. Cras justo odio, dapibus ac facilisis.</p>
            </div>
          </div>
        </div>
        <div class="ppt-show-hide mb-4" ppt-border1>
          <div class="card-header py-4">
            <div class="d-flex justify-content-between">
              <div class="text-600" data-ppt-f2a>
                Which payment methods do you accept?
              </div>
              <span class="fa fa-plus hide-show btn-show">&nbsp;</span> <span class="fa fa-minus show-hide btn-show">&nbsp;</span>
            </div>
          </div>
          <div class="hide">
            <div class="card-body py-4">
              <p data-ppt-f2b>Fusce dapibus, tellus ac cursus commodo, tortor
                mauris condimentum nibh, ut fermentum massa justo sit amet risus.
                Cras mattis consectetur purus sit amet fermentum. Praesent commodo
                cursus magna, vel scelerisque nisl consectetur et. Cum sociis
                natoque penatibus et magnis dis parturient montes, nascetur ridiculus
                mus. Donec sed odio dui. Cras justo odio, dapibus ac facilisis.</p>
            </div>
          </div>
        </div>
        <div class="ppt-show-hide mb-4" ppt-border1>
          <div class="card-header py-4">
            <div class="d-flex justify-content-between">
              <div class="text-600" data-ppt-f3a>
                How can I manage my Account?
              </div>
              <span class="fa fa-plus hide-show btn-show">&nbsp;</span> <span class="fa fa-minus show-hide btn-show">&nbsp;</span>
            </div>
          </div>
          <div class="hide">
            <div class="card-body py-4">
              <p data-ppt-f3b>Fusce dapibus, tellus ac cursus commodo, tortor
                mauris condimentum nibh, ut fermentum massa justo sit amet risus.
                Cras mattis consectetur purus sit amet fermentum. Praesent commodo
                cursus magna, vel scelerisque nisl consectetur et. Cum sociis
                natoque penatibus et magnis dis parturient montes, nascetur ridiculus
                mus. Donec sed odio dui. Cras justo odio, dapibus ac facilisis.</p>
            </div>
          </div>
        </div>
        <div class="ppt-show-hide mb-4" ppt-border1>
          <div class="card-header py-4">
            <div class="d-flex justify-content-between">
              <div class="text-600" data-ppt-f4a>
                Is my credit card information secure?
              </div>
              <span class="fa fa-plus hide-show btn-show">&nbsp;</span> <span class="fa fa-minus show-hide btn-show">&nbsp;</span>
            </div>
          </div>
          <div class="hide">
            <div class="card-body py-4">
              <p data-ppt-f4b>Fusce dapibus, tellus ac cursus commodo, tortor
                mauris condimentum nibh, ut fermentum massa justo sit amet risus.
                Cras mattis consectetur purus sit amet fermentum. Praesent commodo
                cursus magna, vel scelerisque nisl consectetur et. Cum sociis
                natoque penatibus et magnis dis parturient montes, nascetur ridiculus
                mus. Donec sed odio dui. Cras justo odio, dapibus ac facilisis.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="ppt-show-hide mb-4" ppt-border1>
          <div class="card-header py-4">
            <div class="d-flex justify-content-between">
              <div class="text-600" data-ppt-f5a>
                How do I get my subscription receipt?
              </div>
              <span class="fa fa-plus hide-show btn-show">&nbsp;</span> <span class="fa fa-minus show-hide btn-show">&nbsp;</span>
            </div>
          </div>
          <div class="hide">
            <div class="card-body">
              <p data-ppt-f5b>Fusce dapibus, tellus ac cursus commodo, tortor
                mauris condimentum nibh, ut fermentum massa justo sit amet risus.
                Cras mattis consectetur purus sit amet fermentum. Praesent commodo
                cursus magna, vel scelerisque nisl consectetur et. Cum sociis
                natoque penatibus et magnis dis parturient montes, nascetur ridiculus
                mus. Donec sed odio dui. Cras justo odio, dapibus ac facilisis.</p>
            </div>
          </div>
        </div>
        <div class="ppt-show-hide mb-4" ppt-border1>
          <div class="card-header py-4">
            <div class="d-flex justify-content-between">
              <div class="text-600" data-ppt-f6a>
                Are there any discounts for people in need?
              </div>
              <span class="fa fa-plus hide-show btn-show">&nbsp;</span> <span class="fa fa-minus show-hide btn-show">&nbsp;</span>
            </div>
          </div>
          <div class="hide">
            <div class="card-body">
              <p data-ppt-f6b>Fusce dapibus, tellus ac cursus commodo, tortor
                mauris condimentum nibh, ut fermentum massa justo sit amet risus.
                Cras mattis consectetur purus sit amet fermentum. Praesent commodo
                cursus magna, vel scelerisque nisl consectetur et. Cum sociis
                natoque penatibus et magnis dis parturient montes, nascetur ridiculus
                mus. Donec sed odio dui. Cras justo odio, dapibus ac facilisis.</p>
            </div>
          </div>
        </div>
        <div class="ppt-show-hide mb-4" ppt-border1>
          <div class="card-header py-4">
            <div class="d-flex justify-content-between">
              <div class="text-600" data-ppt-f7a>
                Do you offer a free trial edit?
              </div>
              <span class="fa fa-plus hide-show btn-show">&nbsp;</span> <span class="fa fa-minus show-hide btn-show">&nbsp;</span>
            </div>
          </div>
          <div class="hide">
            <div class="card-body">
              <p data-ppt-f7b>Fusce dapibus, tellus ac cursus commodo, tortor
                mauris condimentum nibh, ut fermentum massa justo sit amet risus.
                Cras mattis consectetur purus sit amet fermentum. Praesent commodo
                cursus magna, vel scelerisque nisl consectetur et. Cum sociis
                natoque penatibus et magnis dis parturient montes, nascetur ridiculus
                mus. Donec sed odio dui. Cras justo odio, dapibus ac facilisis.</p>
            </div>
          </div>
        </div>
        <div class="ppt-show-hide mb-4" ppt-border1>
          <div class="card-header py-4">
            <div class="d-flex justify-content-between">
              <div class="text-600" data-ppt-f8a>
                How do I reset my Account password?
              </div>
              <span class="fa fa-plus hide-show btn-show">&nbsp;</span> <span class="fa fa-minus show-hide btn-show">&nbsp;</span>
            </div>
          </div>
          <div class="hide">
            <div class="card-body">
              <p data-ppt-f8b>Fusce dapibus, tellus ac cursus commodo, tortor
                mauris condimentum nibh, ut fermentum massa justo sit amet risus.
                Cras mattis consectetur purus sit amet fermentum. Praesent commodo
                cursus magna, vel scelerisque nisl consectetur et. Cum sociis
                natoque penatibus et magnis dis parturient montes, nascetur ridiculus
                mus. Donec sed odio dui. Cras justo odio, dapibus ac facilisis.</p>
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
echo ppt_theme_block_output($output, $df, array("text", "text155"));
	
	}
		public static function css(){
		ob_start();
?>
<style>
 
.text155 .card-header {
    margin-bottom: 0;
    background: 0 0;
    border: 0;
    padding: 0.9rem 1.3rem 0.85rem;
	
}
.text155 .card-header .btn { font-size:16px; }
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