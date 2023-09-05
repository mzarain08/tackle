<?php



   /*
    ALL HEADERS HAVE
	
	1. elementor_header
	2. elementor_topmenu
	3. elementor_mainmenu
	
   
   */
 
add_filter( 'ppt_blocks_args', 	array('block_header13a',  'data') );
add_action( 'header13a',  		array('block_header13a', 'output' ) );
add_action( 'header13a-css',  	array('block_header13a', 'css' ) );

class block_header13a {

	function __construct(){}		

	public static function data($a){ 
  
		$a['header13a'] = array(
			"name" 	=> "Style 13",
			"image"	=> "header13a.jpg",
			"cat"	=> "header",
			"desc" 	=> "", 
			"order" => 12,
			"data" 	=> array( ),
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $userdata, $new_settings, $settings;
	
		
		// ADD ON SYSTEM DEFAULTS
		$settings = array();
		$settings = $CORE->LAYOUT("get_block_settings_defaults", array("header13a", "header", $settings ) );
 
		  
		 // UPDATE DATA FROM ELEMENTOR OR CHILD THEMES
		 if(is_array($new_settings)){
			 foreach($settings as $h => $j){
				if(isset($new_settings[$h]) && $new_settings[$h] != ""){
					$settings[$h] = $new_settings[$h];
				}
			 }
		 }
		 
		 
		    
 
		ob_start();
		
		?><header class="elementor_header header4 bg-dark b-bottom custom">
        
       
   <nav class="elementor_mainmenu navbar navbar-dark navbar-expand-lg py-3 ">
   
      <div class="container">
      
         <a class="navbar-brand" href="<?php echo home_url(); ?>"> 
         <?php echo $CORE->LAYOUT("get_logo","light");  ?>
         <?php echo $CORE->LAYOUT("get_logo","dark");  ?>
         </a>
         
         
          <?php 
		  
		  $settings['btn-class'] = "btn-dark";
		  _ppt_template( 'framework/design/header/parts/header-search-coupon' ); ?> 
         
         
      </div>
   </nav> 
 
   <?php 
    
   $settings['seperator'] = 1;
   $settings['submenu_bg'] = "bg-white shadow-sm navbar-light border-bottom";
   
   _ppt_template( 'framework/design/header/parts/header-submenu' ); ?> 
 
    
</header><?php

		$output = ob_get_contents();
		ob_end_clean();
		echo $output;	
	
		}
	
		public static function css(){ 
		ob_start();?>
        <style>
		 .elementor_mainmenu .nav-item a {    text-transform: lowercase !important; } 
		</style> 
        <?php
		
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;
		}	
}

?>