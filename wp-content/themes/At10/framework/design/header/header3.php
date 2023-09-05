<?php



   /*
    ALL HEADERS HAVE
	
	1. elementor_header
	2. elementor_topmenu
	3. elementor_mainmenu
	
   
   */
 
add_filter( 'ppt_blocks_args', 	array('block_header3',  'data') );
add_action( 'header3',  		array('block_header3', 'output' ) );
add_action( 'header3-css',  	array('block_header3', 'css' ) );

class block_header3 {

	function __construct(){}		

	public static function data($a){ 
  
		$a['header3'] = array(
			"name" 	=> "Style 3",
			"image"	=> "header3.jpg",
			"cat"	=> "header",
			"desc" 	=> "", 
			"data" 	=> array( ),
			"order" 	=> 3,
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $userdata, $new_settings, $settings;
	
		
		// ADD ON SYSTEM DEFAULTS
		$settings = array();
		$settings = $CORE->LAYOUT("get_block_settings_defaults", array("header3", "header", $settings ) );
 
		  
		 // UPDATE DATA FROM ELEMENTOR OR CHILD THEMES
		 if(is_array($new_settings)){
			 foreach($settings as $h => $j){
				if(isset($new_settings[$h]) && $new_settings[$h] != ""){
					$settings[$h] = $new_settings[$h];
				}
			 }
		 }
		    
 
		ob_start();
		
		?><header class="elementor_header header3 bg-white  b-bottom">
        
         <?php _ppt_template( 'framework/design/header/parts/header-topmenu' ); ?>
        
   <nav class="elementor_mainmenu navbar navbar-light navbar-expand-lg has-sticky py-2">
   
      <div class="container">
      
         <a class="navbar-brand" href="<?php echo home_url(); ?>"> 
         <?php echo $CORE->LAYOUT("get_logo","light");  ?>
         <?php echo $CORE->LAYOUT("get_logo","dark");  ?>
         </a>
         
         <div class="collapse navbar-collapse main-menu <?php if($settings['btn_show'] == "yes"){ ?>justify-content-center<?php }else{ ?>justify-content-end<?php } ?>">
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
	
		public static function css(){ 
		ob_start();?>

        <?php
		
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;
		}	
}

?>