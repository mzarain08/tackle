<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text139',  'data') );
add_action( 'text139',  		array('block_text139', 'output' ) );
add_action( 'text139-css',  	array('block_text139', 'css' ) );
add_action( 'text139-js',  	array('block_text139', 'js' ) );

class block_text139 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text139'] = array(
			"name" 		=> "Style 139",
			"image"		=> "text139.jpg",
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
		 	"image" => DEMO_IMGS."?fw=text139&t=".THEME_KEY,
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

  <div class="col-lg-4">
    <div class="d-flex d-block flex-row">
      <div>
        <figure class="px-3 mb-0">
          <div class="ppt-avatar ppt-avatar-lg  rounded-circle">
            <div class="_wrap bg-image" data-bg="https://premiumpress1063.b-cdn.net/_demoimagesv10/user/1.jpg" data-ppt-image1-bg>&nbsp;</div>
          </div>
        </figure>
      </div>
      <div>
      <blockquote class="p-4 bg-primary rounded-lg text-light">
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
    
   <div class="col-lg-4 hide-mobile hide-ipad">
    <div class="d-flex d-block flex-row">
      <div>
        <figure class="px-3 mb-0">
          <div class="ppt-avatar ppt-avatar-lg  rounded-circle">
            <div class="_wrap bg-image" data-bg="https://premiumpress1063.b-cdn.net/_demoimagesv10/user/2.jpg" data-ppt-image1-bg>&nbsp;</div>
          </div>
        </figure>
      </div>
      <div>
      
      <blockquote class="p-4 bg-primary rounded-lg text-light">
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
    
   <div class="col-lg-4 hide-mobile hide-ipad">
    <div class="d-flex d-block flex-row">
      <div>
        <figure class="px-3 mb-0">
          <div class="ppt-avatar ppt-avatar-lg  rounded-circle">
            <div class="_wrap bg-image" data-bg="https://premiumpress1063.b-cdn.net/_demoimagesv10/user/3.jpg" data-ppt-image1-bg>&nbsp;</div>
          </div>
        </figure>
      </div>
      <div>
      <blockquote class="p-4 bg-primary rounded-lg text-light">
        <div class="small" data-ppt-f3a>
          " Et vim graeco principes. Cu dico nullam pri stet possim quaerendum."
        </div>
        </blockquote>
        <div class="d-flex align-items-baseline">
          <div class="small text-600" data-ppt-f3b>
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
echo ppt_theme_block_output($output, $text_settings, array("text", "text139") );
	
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
