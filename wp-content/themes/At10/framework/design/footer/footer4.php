<?php
 
add_filter( 'ppt_blocks_args', 	array('block_footer4',  'data') );
add_action( 'footer4',  		array('block_footer4', 'output' ) );
add_action( 'footer4-css',  	array('block_footer4', 'css' ) );
add_action( 'footer4-js',  	array('block_footer4', 'js' ) );

class block_footer4 {

	function __construct(){}		

	public static function data($a){ 
  
		$a['footer4'] = array(
			"name" 	=> "Style 4",
			"image"	=> "footer4.jpg",
			"cat"	=> "footer",
			"order" => 4,
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
		"footertop_ftop_style"	=> "2",
		"footertop_txtbg"		=> "", 
		
		"footermid_show" 		=> "1",
		"footermid_bg_color" 	=> "#000",
		"footermid_fmid_style"	=> "",
		"footermid_txtbg"		=> "light", 
		 
	    "footerbot_show" 		=> "1",
		"footerbot_bg_color" 	=> "#000",
		"footerbot_fbot_style"	=> "4", 
		"footerbot_txtbg"		=> "light", 
		
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