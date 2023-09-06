<?php
 
add_filter( 'ppt_blocks_args', 	array('block_listings3',  'data') );
add_action( 'listings3',  		array('block_listings3', 'output' ) );
add_action( 'listings3-css',  	array('block_listings3', 'css' ) );
add_action( 'listings3-js',  	array('block_listings3', 'js' ) );

class block_listings3 {

	function __construct(){}		

	public static function data($a){ global $CORE;  
  
		$a['listings3'] = array(
			"name" 	=> "Style 3 - Carousel",
			"image"	=> "listings3.jpg",
			"cat"	=> "listings",
			"order" => 30,
			"desc" 	=> "", 
			"data" 	=> array( ),
			
			"defaults" => array(
					
					// TEXT
						
					"title_show" 		=> "yes",
					"title_style" 		=> "1",
					"title_heading" 	=> "h4",
					"title_pos" 		=> "",
					
					"title" 			=> $CORE->LAYOUT("get_placeholder_text", array('title', "listings") ),					 
					"subtitle"			=> "",					
					"desc" 				=> "",
					 	
					"title_margin"		=> "",
					"subtitle_margin"	=> "mb-4",
					"desc_margin" 		=> "",					
					
					"title_font" 		=> "",
					"subtitle_font" 	=> "",
					"desc_font" 		=> "",
					 
					"title_txtcolor" 	=> "dark",
					"subtitle_txtcolor" => "primary",
					"desc_txtcolor" 	=> "opacity-5",
					
					"title_txtw" 		=> "",
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
	
	
		$settings = array();  
	 
	   // ADD ON SYSTEM DEFAULTS
		$settings = $CORE->LAYOUT("get_block_settings_defaults", array("listings3", "listings", $settings ) );
 		 
		// UPDATE DATA FROM ELEMENTOR OR CHILD THEMES
		if(is_array($new_settings)){
			 foreach($settings as $h => $j){
				if(isset($new_settings[$h]) && $new_settings[$h] != ""){
					$settings[$h] = $new_settings[$h];
				}
			 }
		}  
		 
 
	ob_start();
	
	$randomID = rand(0,9999);
	
	$data  = str_replace("data-srcxx","srcxx", do_shortcode('[LISTINGS dataonly=1 nav=0 small=1 carousel=1 '.$settings['datastring'].' ]'));
	
	if(strlen($data) < 10){
			$data =  str_replace(".00","", do_shortcode('[LISTINGS dataonly=1 nav=0 orderby=rand small=1 carousel=1 custom=new ]')); 
	} 
	
	?><section id="listing3-carousel-<?php echo $randomID; ?>" class="<?php echo $settings['section_class']." ".$settings['section_bg']." ".$settings['section_padding']." ".$settings['section_divider']; ?>">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="clearfix"></div>
        <?php if($settings['title_show'] == "yes"){ ?>
        <div class="d-md-flex mb-4 justify-content-between">
          <div>
             <?php _ppt_template( 'framework/design/parts/title' ); ?>
          </div>
          <div class="hide-mobile"> <a class="btn bg-white btn-sm text-muted prev px-2 mt-md-2 border"><i class="fa fa-angle-left px-1" aria-hidden="true"></i></a> <a class="btn bg-white btn-sm text-muted next px-2 mt-md-2 border"><i class="fa fa-angle-right px-1" aria-hidden="true"></i></a> </div>
        </div>
        <?php } ?>
        <div  class="owl-carousel owl-theme mobile-mt-4"> <?php echo  $data;  ?> </div>
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
