<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text18',  'data') );
add_action( 'text18',  		array('block_text18', 'output' ) );
add_action( 'text18-css',  	array('block_text18', 'css' ) );
add_action( 'text18-js',  	array('block_text18', 'js' ) );

class block_text18 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text18'] = array(
			"name" 	=> "Style 18",
			"image"	=> "text18.jpg",
			"order" => 1.18,
			"cat"	=> "text",
			"desc" 	=> "", 
			"data" 	=> array( ),
			
			"defaults" => array(
					
				 
 
        /* text18 */    
        "section_padding"  => "",     
        "section_bg"  => "bg-white",     
        "section_pos"  => "",     
        "section_w"  => "container",     
        "section_pattern"  => "",     
        "title_show"  => "yes",     
		"title" 			=> "Get Started Today!",					 
		"subtitle"			=> "",					
				 
        "desc"  => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ",     
        "title_style"  => "1",     
        "title_pos"  => "left",     
        "title_heading"  => "h2",     
        "title_margin"  => "",     
        "subtitle_margin"  => "",     
        "desc_margin"  => "",     
        "title_txtcolor"  => "dark",     
        "subtitle_txtcolor"  => " opacity-8",     
        "desc_txtcolor"  => "opacity-5",     
        "title_font"  => "",     
        "subtitle_font"  => "",     
        "desc_font"  => "",     
        "title_txtw"  => "",     
        "subtitle_txtw"  => "",     
        "btn_show"  => "yes",     
        "btn_link"  => home_url()."/?s=",  
        "btn_txt"  => __("Search Website","premiumpress"),    
        "btn_bg"  => "primary",     
        "btn_bg_txt"  => "text-light",     
        "btn_icon"  => "",     
        "btn_icon_pos"  => "",     
        "btn_size"  => "btn-lg",     
        "btn_margin"  => "mt-4",     
        "btn_style"  => "7",     
        "btn_font"  => "",     
        "btn_txtw"  => "font-weight-bold",     
        "btn2_show"  => "no",     
        "btn2_link"  => wp_login_url(),     
        "btn2_txt"  => __("Join Now!","premiumpress"),   
        "btn2_bg"  => "primary",     
        "btn2_bg_txt"  => "text-light",     
        "btn2_icon"  => "",     
        "btn2_icon_pos"  => "before",     
        "btn2_size"  => "btn-lg",     
        "btn2_margin"  => "mt-4",     
        "btn2_style"  => "1",     
        "btn2_txtw"  => "font-weight-bold",     
        "btn2_font"  => "", 		

					
		"text_image1" => DEMO_IMG_PATH."_bg/text1_800x600a.jpg",
					
					
					 
			),
						
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $new_settings, $settings;	
	
		$settings = array( );  
	 	 
		// ADD ON SYSTEM DEFAULTS
		$settings = $CORE->LAYOUT("get_block_settings_defaults", array("text18", "text", $settings ) );
		 
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
	
	?><section class="<?php echo $settings['section_class']." ".$settings['section_bg']." ".$settings['section_padding']." ".$settings['section_divider']; ?>">
 
 
<div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-5">
                            <div class="block-text18-image rounded-lg" style="background-image: url(<?php echo $settings['text_image1']; ?>);"></div>
                            
                           
                        </div>
                        <div class="col-lg-2"></div>
                        <div class="col-lg-4 mt-3 mt-md-5 mt-lg-0">
                         
                            <?php _ppt_template( 'framework/design/parts/title' ); ?>
                          
                          
                          <?php _ppt_template( 'framework/design/parts/btn' ); ?>
                        </div>
                        <div class="col-lg-1"></div>
                    </div>
                </div>
 
  
</section><?php
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;	
	
	}
		public static function css(){
	 
		ob_start();
		?>
 <style>
 
 .block-text18-image {
    height: 480px;
    background-color: #f7f7f7;
 
    background-size: cover;
    background-position: center center;
    background-repeat: no-repeat;
}
@media screen and (max-width: 767px){
.block-text18-image {
    height: 300px;
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