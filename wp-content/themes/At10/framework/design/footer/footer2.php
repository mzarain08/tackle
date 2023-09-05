<?php
 
add_filter( 'ppt_blocks_args', 	array('block_footer2',  'data') );
add_action( 'footer2',  		array('block_footer2', 'output' ) );
add_action( 'footer2-css',  	array('block_footer2', 'css' ) );
add_action( 'footer2-js',  	array('block_footer2', 'js' ) );

class block_footer2 {

	function __construct(){}		

	public static function data($a){ 
  
		$a['footer2'] = array(
			"name" 	=> "Style 2",
			"image"	=> "footer2.jpg",
			"cat"	=> "footer",
			"order" => 2,
			"desc" 	=> "", 
			
			"widget" => "ppt-footer",
			 
			"data" 	=> array( ),	
			
			"defaults" => array(),
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $CORE_UI, $footer_settings, $settings, $df, $footer;
	   
	   
 		// ALL DEFAULT FIELDS
		 $df = ppt_theme_block_default(array("footertop","footermid","footerbot","footer_menu1","footer_menu2","footer_menu3","footer_menu4"), 0); 
		
		 
		// APPLY CUSTOM CHANGES 
		$cc = array(
		
		"footertop_show"		=> "1",
		"footertop_bg_color" 	=> "",
		"footertop_ftop_style"	=> "",
		"footertop_ftop_style"	=> "",
		"footertop_txtbg"		=> "", 
		
		"footermid_show" 		=> "1",
		"footermid_bg_color" 	=> "",
		"footermid_fmid_style"	=> "",
		"footermid_fmid_style"	=> "", 
		"footermid_txtbg"		=> "dark", 
		 
	    "footerbot_show" 		=> "1",
		"footerbot_bg_color" 	=> "",
		"footerbot_fbot_style"	=> "", 
		"footerbot_txtbg"		=> "dark", 
		
		"footermid_show_logo" 	=> "1",
		 
		 	 
		);
		
		$df = array_merge($df, $cc);
		
		// APPLY ELEMENTOR
		if(!empty($footer_settings)){
			foreach($df as $k => $v){				
				if(isset($footer_settings[$k]) && $footer_settings[$k] != ""  ){
					$df[$k] = $footer_settings[$k];
				}
			}		
		}	
 
  		// OUTPUT
		echo ppt_footer_output($df);
 
}

	public static  function css(){
	return "";
	}	
	public static function js(){
	return "";
	ob_start();
	$output = ob_get_contents();
	ob_end_clean();
	echo $output;
	}	

}

?>