<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text2b',  'data') );
add_action( 'text2b',  		array('block_text2b', 'output' ) );
add_action( 'text2b-css',  	array('block_text2b', 'css' ) );
add_action( 'text2b-js',  	array('block_text2b', 'js' ) );

class block_text2b {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text2b'] = array(
			"name" 	=> "Style 2b",
			"image"	=> "text2b.jpg",
			"order" => 2,
			"cat"	=> "text",
			"desc" 	=> "", 
			"data" 	=> array( ),
			
			"defaults" => array(
					
				 
 
 
        /* text2b */    
        "section_padding"  => "",     
        "section_bg"  => "bg-white",     
        "section_pos"  => "",     
        "section_w"  => "container",     
        "section_pattern"  => "",     
        "title_show"  => "yes",     
        "title"  => "Welcome to our website!",     
        "subtitle"  => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ",     
        "desc"  => " ",     
        "title_style"  => "1",     
        "title_pos"  => "left",     
        "title_heading"  => "h2",     
        "title_margin"  => "mb-4",     
        "subtitle_margin"  => "",     
        "desc_margin"  => "",     
        "title_txtcolor"  => "black",     
        "subtitle_txtcolor"  => " opacity-8",     
        "desc_txtcolor"  => "opacity-5",     
        "title_font"  => "",     
        "subtitle_font"  => "",     
        "desc_font"  => "",     
        "title_txtw"  => "text-700",     
        "subtitle_txtw"  => "",     
        "btn_show"  => "yes",     
        "btn_link"  => "[link-search]",     
        "btn_txt"  => "Search Website",     
        "btn_bg"  => "primary",     
        "btn_bg_txt"  => "text-light",     
        "btn_icon"  => "",     
        "btn_icon_pos"  => "",     
        "btn_size"  => "btn-lg",     
        "btn_margin"  => "mt-4",     
        "btn_style"  => "1",     
        "btn_font"  => "",     
        "btn_txtw"  => "font-weight-bold",     
        "btn2_show"  => "yes",     
        "btn2_link"  => "[link-login]",     
        "btn2_txt"  => "Join Now!",     
        "btn2_bg"  => "primary",     
        "btn2_bg_txt"  => "text-light",     
        "btn2_icon"  => "",     
        "btn2_icon_pos"  => "before",     
        "btn2_size"  => "btn-lg",     
        "btn2_margin"  => "mt-4",     
        "btn2_style"  => "1",     
        "btn2_txtw"  => "font-weight-bold",     
        "btn2_font"  => "", 				

					
					
					
					
					 
			),
						
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $new_settings, $settings;	
	
		$settings = array( );  
	 	 
		// ADD ON SYSTEM DEFAULTS
		$settings = $CORE->LAYOUT("get_block_settings_defaults", array("text2b", "text", $settings ) );
		 
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
      <div class="row y-middle">        
         <div class="col-lg-6 pr-lg-5 text-sm-center text-lg-left mb-4 mb-md-0 pb-4 pb-md-0">
            
            <?php _ppt_template( 'framework/design/parts/title' ); ?>
            
            <?php  _ppt_template( 'framework/design/parts/btn' ); ?>
         </div>
         
          <div class="col-lg-6 pl-lg-5">
          <?php if(isset($settings['text_image1_link']) && strlen($settings['text_image1_link']) > 1){ ?>
    <a href="<?php echo $settings['text_image1_link']; ?>">
    <?php } ?>
            <img data-src="<?php echo $settings['text_image1']; ?>" class="img-fluid mt-5 mt-lg-0 lazy" alt="<?php echo strip_tags($settings['title']); ?>" />
           <?php if(isset($settings['text_image1_link']) && strlen($settings['text_image1_link']) > 1){ ?>  </a>  <?php } ?>
         </div>
         
      </div>
   </div>
</section><?php
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