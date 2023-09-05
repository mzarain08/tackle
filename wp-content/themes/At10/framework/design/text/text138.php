<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text138',  'data') );
add_action( 'text138',  		array('block_text138', 'output' ) );
add_action( 'text138-css',  	array('block_text138', 'css' ) );
add_action( 'text138-js',  	array('block_text138', 'js' ) );

class block_text138 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text138'] = array(
			"name" 		=> "Style 138",
			"image"		=> "text138.jpg",
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
		 	"image" => DEMO_IMGS."?fw=text120&t=".THEME_KEY,
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
  <div class="container" ppt-border1>
    <div class="row d-flex flex-lg-row-reverse align-items-center ">
    
      <div class="col-md-6 text-center text-lg-left">
                    
            <div class="text-md-left mobile-mt-4">
            
            
            <blockquote class="n1"><p data-ppt-title class="fs-md px-5">Lorem ipsum dolor sit amet,
          consectetur adipiscing elit. Praesent tempus eleifend risus ut congue.
          Pellentesque nec lacus elit.</p></blockquote>
		
        
        <div class="pl-5">	
		 <div class="text-700 mt-4 fs-md" data-ppt-subtitle>John Brown</div>
         
         <div class="text-500 opacity-5 mt-1" data-ppt-desc>Web Designer</div>
             </div>
            </div>         
			
		 
          </div>
      <div class="col-md-6  text-center">
            <img data-src="<?php echo $df['image']; ?>" class="img-fluid mobile-mt-4 lazy"  alt="image"  data-ppt-image> 
            
      </div>
    </div>
  </div>
</section>
  
<?php

$output = ob_get_contents();
ob_end_clean();
echo ppt_theme_block_output($output, $text_settings, array("text", "text138"));
	
	}
		public static function css(){
		ob_start();
?>
<style>
blockquote.n1:before {
    color: #777;
    display: block!important;
    left: 10px;
    top: 0;
   
    font-size: 80px;
    font-style: normal;
    line-height: 1;
    position: absolute;
}
@media (min-width: 768px){
blockquote.n1:before {
 content: '"';
}

}
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
