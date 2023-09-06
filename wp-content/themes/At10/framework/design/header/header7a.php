<?php
 
 
add_filter( 'ppt_blocks_args', 	array('block_header7a',  'data') );
add_action( 'header7a',  		array('block_header7a', 'output' ) );
add_action( 'header7a-css',  	array('block_header7a', 'css' ) );
add_action( 'header7a-js',  	array('block_header7a', 'js' ) );

class block_header7a {

	function __construct(){}		

	public static function data($a){ 
  
		$a['header7a'] = array(
			"name" 	=> "Style 7 (black)",
			"image"	=> "header7.jpg",
			"cat"	=> "header",
			"desc" 	=> "", 
			"data" 	=> array( ),
			"order" 	=> 7,
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $userdata, $new_settings, $settings;
	
		
		// ADD ON SYSTEM DEFAULTS
		$settings = array();
		$settings = $CORE->LAYOUT("get_block_settings_defaults", array("header7a", "header", $settings ) );
 
		  
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
		 $settings['topmenu_bg'] = "text-light bb-light bg-black";
		    
 
		ob_start();
		
		?><header class="elementor_header header7a bg-black border-bottom outline-white">
  <?php _ppt_template( 'framework/design/header/parts/header-topmenu' ); ?>
  
  <nav class="elementor_mainmenu navbar navbar-dark navbar-expand-lg">
    <div class="container"> <a class="navbar-brand" href="<?php echo home_url(); ?>"> <?php echo $CORE->LAYOUT("get_logo","light");  ?> <?php echo $CORE->LAYOUT("get_logo","dark");  ?> </a>
      <div class="collapse navbar-collapse main-menu justify-content-end" id="header1_buttonmenubar"> <?php echo do_shortcode('[MAINMENU class="navbar-nav" style=1]');  ?> </div>
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
