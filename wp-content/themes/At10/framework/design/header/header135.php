<?php
 
add_filter( 'ppt_blocks_args', 	array('block_header135',  'data') );
add_action( 'header135',  		array('block_header135', 'output' ) );
add_action( 'header135-css',  	array('block_header135', 'css' ) );
add_action( 'header135-js',  	array('block_header135', 'js' ) );

class block_header135 {

	function __construct(){}		

	public static function data($a){ 
  
		$a['header135'] = array(
			"name" 	=> "Style 135",
			"image"	=> "header135.jpg",
			"cat"	=> "header",
			"desc" 	=> "", 
			"data" 	=> array( ),
			"order" 	=> 135,
			
			"widget" => "ppt-header",
			
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $CORE_UI, $userdata, $header_settings, $df;
 
  		// ALL DEFAULT FIELDS
		 $df = ppt_theme_block_default(array("header"), 0);//
		
		// DEFAULTS
		 $cc = array(
			"topmenu_show"	 	=> 0,		 
			"btn_show" 			=> 1,
		 	"btn2_show" 		=> 1,
			"submenu_show" 		=> 1,
			"submenu_style"		=> 15,
			"submenu_bg" 		=> "bg-primary",			
			"header_style" 		=> 15,
			"header_bg" 		=> "bg-light",
 			
			"topmenu_bg_color" 		=> "#000",
			"header_bg_color" 		=> "#fff",
			"submenu_bg_color" 		=> "#fff",
			
			"topmenu_bg" 		=> "bg-dark",
			"topmenu_social" 	=> 1,		
			"topmenu_style" 	=> 1,
		 );	
		 
		 $df = array_merge($df, $cc);
	 
		 
		 if(is_array($header_settings) && !empty($header_settings)){ 
		 
		 	foreach($header_settings as $k => $v){			 			
				if($v != ""){
					$df[$k] = $header_settings[$k];
				}			
			}
 		
		}else{		
		
			$default_settings = $CORE->LAYOUT("get_block_settings_defaults_new", array("header", "header135" ) );	
			 		 
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

echo str_replace("%logo%",$logoCode,str_replace("%topmenu%",$topMenuCode, ppt_theme_block_output($output, $df, array("header", "header135"))));

	
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