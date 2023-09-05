<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text8',  'data') );
add_action( 'text8',  		array('block_text8', 'output' ) );
add_action( 'text8-css',  	array('block_text8', 'css' ) );
add_action( 'text8-js',  	array('block_text8', 'js' ) );

class block_text8 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text8'] = array(
			"name" 	=> "Style 8 - Page Top",
			"image"	=> "text8.jpg",
			"order" => 8,
			"cat"	=> "text",
			"desc" 	=> "", 
			"data" 	=> array( ),	
			
							"defaults" => array(
					
					// TEXT
					"section_padding" => "section-60",
					"section_bg"	=>	"bg-light",		
						
					"title_show" 		=> "yes",
					"title_style" 		=> "1",
					"title_heading" 	=> "h1",
					"title_pos" 		=> "left",
					
					
					"title" 			=> $CORE->LAYOUT("get_placeholder_text", array('title', "text") ),					 
					"subtitle"			=> $CORE->LAYOUT("get_placeholder_text", array('subtitle', "text") ),					
					"desc" 				=> "",
					 	
					"title_margin"		=> "",
					"subtitle_margin"	=> "",
					"desc_margin" 		=> "",					
					
					"title_font" 		=> "",
					"subtitle_font" 	=> "",
					"desc_font" 		=> "",
					 
					"title_txtcolor" 	=> "dark",
					"subtitle_txtcolor" => "primary",
					"desc_txtcolor" 	=> "opacity-5",
					
					"title_txtw" 		=> "font-weight-bold",
					"subtitle_txtw" 	=> "",
					 
					
					// BUTTON					
					"btn_show" 			=> "no",						
					"btn_style" 		=> "1",				
					"btn_size" 			=> "",
					"btn_icon" 			=> "",				
					"btn_icon_pos" 		=> "",
					"btn_font" 			=> "",
					"btn_txt" 			=> "",
					"btn_link" 			=> "",
					"btn_bg" 			=> "",
					"btn_bg_txt" 		=> "",					
					"btn_margin" 		=> "mt-4",
					 			
					
					// BUTTON				
					"btn2_show" 		=> "no",						
					"btn2_style" 		=> "2",				
					"btn2_size" 		=> "",
					"btn2_icon" 		=> "",				
					"btn2_icon_pos" 	=> "",
					"btn2_font" 		=> "",
					"btn2_txt" 			=> "",
					"btn2_link" 		=> "",
					"btn2_bg" 			=> "",
					"btn2_bg_txt" 		=> "",					
					"btn2_margin" 		=> "mt-4",
					
					 
			),	
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $new_settings, $settings;
	
	
	$settings = array( );  
	  
	// ADD ON SYSTEM DEFAULTS
	$settings = $CORE->LAYOUT("get_block_settings_defaults", array("text8", "text", $settings ) ); 
	 
  
	// UPDATE DATA FROM ELEMENTOR OR CHILD THEMES
	if(is_array($new_settings)){
		foreach($settings as $h => $j){
			if(isset($new_settings[$h]) && $new_settings[$h] != ""){
					$settings[$h] = $new_settings[$h];
			}
		}
	} 
	
		if($settings['text_image1'] == ""){
		$settings['text_image1'] =  $CORE->LAYOUT("get_placeholder",array(800,600));
		}
	 
 	
	 
	ob_start();
	?>

<section class="position-relative bg-light section-20 border-bottom">
  <div class="container bg-content">
    <div class="row">
      <div class="col-md-6 text-center text-lg-left">
        <h4 class="mb-0 pb-0 font-<?php echo $settings['title_font'];  ?> text-<?php echo $settings['title_txtcolor']; ?> <?php echo $settings['title_txtw']; ?>">
          <?php if(strlen($settings['title']) > 1){ echo $settings['title']; }else{ ?>
          Amazing Block System
          <?php } ?>
        </h4>
      </div>
      <div class="col-md-6 text-center text-lg-right">
        <div class="mb-0 mt-2 mt-sm-1 pb-0 opacity-5 font-<?php echo $settings['subtitle_font'];  ?> text-<?php echo $settings['subtitle_txtcolor']; ?>"><?php echo $settings['subtitle']; ?></div>
      </div>
    </div>
  </div>
</section>
<?php
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;	
	
	}
		public static function css(){
		return "";
		ob_start();
		?>
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
