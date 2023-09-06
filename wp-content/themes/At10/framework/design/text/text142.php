<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text142',  'data') );
add_action( 'text142',  		array('block_text142', 'output' ) );
add_action( 'text142-css',  	array('block_text142', 'css' ) );
add_action( 'text142-js',  	array('block_text142', 'js' ) );

class block_text142 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text142'] = array(
			"name" 		=> "Style 142",
			"image"		=> "text142.jpg",
			"cat"		=> array("text","testimonials"),
			"desc" 		=> "", 
			"order" 	=> 0, 
			"widget" => "ppt-text",	
			"data" 	=> array( ),	
			
			"defaults" => array( ), 
			
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $text_settings;
	 	 
		 $df = array(
		 
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

<section class="section-40">
<div class="container">
<div class="row no-gutters">

  <div class="col-lg-6">
    <div class="d-flex d-block flex-row">
      <div>
        <figure class="px-3 mb-0">
          <div class="ppt-avatar ppt-avatar-lg  rounded-circle">
            <div class="_wrap bg-image" data-bg="https://premiumpress1063.b-cdn.net/_demoimagesv10/user/1.jpg" data-ppt-image1-bg>&nbsp;</div>
          </div>
        </figure>
      </div>
      <div>
      <blockquote class="p-4 bg-white rounded-lg text-dark" ppt-border1>
        <div class="small" data-ppt-f1a>
          " Et vim graeco principes. Cu dico nullam pri stet possim quaerendum."
        </div>
        </blockquote>
        <div class="d-flex align-items-baseline">
          <div class="small text-600" data-ppt-f1b>
            John Doe
          </div>
          <div class="tiny ml-3">
            <span class="fa fa-star text-warning">&nbsp;</span>
            <span class="fa fa-star text-warning">&nbsp;</span>
            <span class="fa fa-star text-warning">&nbsp;</span>
            <span class="fa fa-star text-warning">&nbsp;</span>
            <span class="fa fa-star text-warning">&nbsp;</span>
            
          </div>
        </div>
      </div>
    </div>
    </div>
    
   <div class="col-lg-6">
    <div class="d-flex d-block flex-row">
      <div>
        <figure class="px-3 mb-0">
          <div class="ppt-avatar ppt-avatar-lg  rounded-circle">
            <div class="_wrap bg-image" data-bg="https://premiumpress1063.b-cdn.net/_demoimagesv10/user/2.jpg" data-ppt-image1-bg>&nbsp;</div>
          </div>
        </figure>
      </div>
      <div>
      
     <blockquote class="p-4 bg-white rounded-lg text-dark" ppt-border1>
        <div class="small" data-ppt-f2a>
          "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec hendrerit vehicula est, in consequat."
        </div>
        
        </blockquote>
        <div class="d-flex align-items-baseline">
          <div class="small text-600" data-ppt-f2b>
            John Doe
          </div>
          <div class="tiny ml-3">
           <span class="fa fa-star text-warning">&nbsp;</span>
            <span class="fa fa-star text-warning">&nbsp;</span>
            <span class="fa fa-star text-warning">&nbsp;</span>
            <span class="fa fa-star text-warning">&nbsp;</span>
            <span class="fa fa-star text-warning">&nbsp;</span>
            
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
echo ppt_theme_block_output($output, $text_settings, array("text", "text142") );
	
	}
		public static function css(){

		ob_start();
		?>
<style>
blockquote { position:relative; } 
 
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
