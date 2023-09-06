<?php
 
add_filter( 'ppt_blocks_args', 	array('block_header112',  'data') );
add_action( 'header112',  		array('block_header112', 'output' ) );
add_action( 'header112-css',  	array('block_header112', 'css' ) );
add_action( 'header112-js',  	array('block_header112', 'js' ) );

class block_header112 {

	function __construct(){}		

	public static function data($a){ 
  
		$a['header112'] = array(
			"name" 	=> "Style 112",
			"image"	=> "header112.jpg",
			"cat"	=> "header",
			"desc" 	=> "", 
			"data" 	=> array( ),
			"order" 	=> 1,
			
			"widget" => "ppt-header",
			
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $CORE_UI, $userdata, $header_settings, $df;
 
 
		// DEFAULTS
		 $df = array(
			"topmenu_show"	 	=> 1,		 
			"btn_show" 			=> 1,
		 	"btn2_show" 		=> 1,
			"submenu_show" 		=> 0,
			"submenu_style"		=> 7,
			"submenu_bg" 		=> "bg-white",			
			"header_style" 		=> 6,
			"header_bg" 		=> "bg-white",
			"topmenu_bg" 		=> "bg-dark",
			"topmenu_social" 	=> 1,		
			
		 );	
	 
		 
		 if(is_array($header_settings) && !empty($header_settings)){ 
		 
		 	foreach($header_settings as $k => $v){			 			
				if($v != ""){
					$df[$k] = $header_settings[$k];
				}			
			}
 		
		}else{		
		
			$default_settings = $CORE->LAYOUT("get_block_settings_defaults_new", array("header", "header112" ) );	
			 		 
			foreach($default_settings as $k => $v){
				if($v != ""){
					$df[$k] = $v;
				}
			}		
		}



// LOGO
ob_start();
_ppt_template( 'framework/design/header/new/logo' );
$logoCode = ob_get_contents();
ob_end_clean();

//TOP MENU
ob_start();
_ppt_template( 'framework/design/header/new/topmenu' );
$topMenuCode = ob_get_contents();
ob_end_clean();

// HEADER
ob_start();
_ppt_template( 'framework/design/header/new/header' );
$headerCode = ob_get_contents();
ob_end_clean();

// SUB MENU
ob_start();
_ppt_template( 'framework/design/header/new/submenu' );
$submenuCode = ob_get_contents();
ob_end_clean();

$output = $headerCode.$submenuCode; 

echo str_replace("%logo%",$logoCode,str_replace("%topmenu%",$topMenuCode, ppt_theme_block_output($output, $df, array("header", "header112"))));

	
		}
		
		public static function js(){ 
		return "";
		}
		
		public static function css(){ 
		return "";
		ob_start();
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;
		}	
		
}

?>