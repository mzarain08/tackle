<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text144',  'data') );
add_action( 'text144',  		array('block_text144', 'output' ) );
add_action( 'text144-css',  	array('block_text144', 'css' ) );
add_action( 'text144-js',  	array('block_text144', 'js' ) );

class block_text144 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text144'] = array(
			"name" 		=> "Style 144",
			"image"		=> "text144.jpg",
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
<div class="row">

<?php $i=1; while($i < 4){ 
 

?>
    
   <div class="col-lg-4 <?php if($i > 1){ ?>hide-mobile hide-ipad<?php } ?>">
      
      <div>
      <blockquote class="p-4 bg-white rounded-lg text-dark" ppt-border1>
        <div class="small" data-ppt-f<?php echo $i; ?>a>
          " Et vim graeco principes. Cu dico nullam pri stet possim quaerendum."
        </div>
        </blockquote>
        <div class="d-flex align-items-baseline">
        
        <div class="d-flex mr-2">
       <figure class="px-3 mb-0">
          <div class="ppt-avatar ppt-avatar-xs  rounded-circle">
            <div class="_wrap bg-image" data-bg="https://premiumpress1063.b-cdn.net/_demoimagesv10/user/<?php echo $i; ?>.jpg" data-ppt-image<?php echo $i; ?>-bg>&nbsp;</div>
          </div>
        </figure>
        
        
          <div class="small text-600" data-ppt-f<?php echo $i; ?>b>
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

<?php $i++; } ?>
    
  </div>
</div>
</section>
<?php


		$output = ob_get_contents();
		ob_end_clean();
echo ppt_theme_block_output($output, $text_settings, array("text", "text144") );
	
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
