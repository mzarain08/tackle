<?php
 
 
add_filter( 'ppt_blocks_args', 	array('block_header7',  'data') );
add_action( 'header7',  		array('block_header7', 'output' ) );
add_action( 'header7-css',  	array('block_header7', 'css' ) );
add_action( 'header7-js',  	array('block_header7', 'js' ) );

class block_header7 {

	function __construct(){}		

	public static function data($a){ 
  
		$a['header7'] = array(
			"name" 	=> "Style 7 (white)",
			"image"	=> "header7.jpg",
			"cat"	=> "header",
			"desc" 	=> "", 
			"data" 	=> array( ),
			"order" 	=> 7,
			"defaults" => array( 
			
			 
				/* header7 */    
				"section_padding"  => "",     
				"section_bg"  => "bg-white",     
				"section_pos"  => "",     
				"section_w"  => "container",     
				"section_pattern"  => "",     
				"btn_show"  => "yes",     
				"btn_link"  => "[link-add]",     
				"btn_txt"  => "Add New",     
				"btn_bg"  => "primary",     
				"btn_bg_txt"  => "text-light",     
				"btn_icon"  => "",     
				"btn_icon_pos"  => "before",     
				"btn_size"  => "btn-md",     
				"btn_margin"  => "mt-0",     
				"btn_style"  => "1",     
				"btn_font"  => "",     
				"btn_txtw"  => "font-weight-bold",     
				"topmenu_show"  => "yes",     
				"extra_show"  => "yes",     
				"extra_type"  => "",  
			
			
			
			),
			
			
			
			
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $userdata, $new_settings, $settings;
	
		
		// ADD ON SYSTEM DEFAULTS
		$settings = array();
		$settings = $CORE->LAYOUT("get_block_settings_defaults", array("header7", "header", $settings ) );
 
		  
		 // UPDATE DATA FROM ELEMENTOR OR CHILD THEMES
		 if(is_array($new_settings)){
			 foreach($settings as $h => $j){
				if(isset($new_settings[$h]) && $new_settings[$h] != ""){
					$settings[$h] = $new_settings[$h];
				}
			 }
		 }
		 
		 //$settings['btn'] = "yes";
		 //$settings['btn_show'] = "no";
		 $settings['topmenu_bg'] = "bg-white text-dark border-bottom";
		    
 
		ob_start();
		
		?><header class="elementor_header header7a bg-white border-bottom outline-white">
  <?php _ppt_template( 'framework/design/header/parts/header-topmenu' ); ?>
  
  <nav class="elementor_mainmenu navbar navbar-light navbar-expand-lg">
    <div class="container"> 
    
    <a class="navbar-brand" href="<?php echo home_url(); ?>"> <?php echo $CORE->LAYOUT("get_logo","light");  ?> <?php echo $CORE->LAYOUT("get_logo","dark");  ?> </a>
    
    
      <div class="collapse navbar-collapse main-menu justify-content-end" id="header1_buttonmenubar"> 
	  <?php echo do_shortcode('[MAINMENU class="navbar-nav" style=1]');  ?>
      </div>
      <?php if($settings['btn_show'] == "yes"){ ?>
      
      <div class="align-items-center">
        <?php _ppt_template( 'framework/design/header/parts/header-button' ); ?>
      </div> 
      <?php }else{ ?>


 	<?php _ppt_template( 'framework/design/header/parts/header-languages' ); ?>
 
      <?php } ?>
      
    </div>
  </nav>
</header><?php

		$output = ob_get_contents();
		ob_end_clean();
		echo $output;	
	
		}
		
		public static function js(){ 
		return "";
		}
			
		public static function css(){ 
		return "";
		}	
}

?>