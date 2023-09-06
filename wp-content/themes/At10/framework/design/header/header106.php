<?php
 
 
add_filter( 'ppt_blocks_args', 	array('block_header106',  'data') );
add_action( 'header106',  		array('block_header106', 'output' ) );
add_action( 'header106-css',  	array('block_header106', 'css' ) );
add_action( 'header106-js',  	array('block_header106', 'js' ) );

class block_header106 {

	function __construct(){}		

	public static function data($a){ 
  
		$a['header106'] = array(
			"name" 	=> "Style 106",
			"image"	=> "header106.jpg",
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
			"submenu_show" 		=> 1,
			"submenu_style" 	=> 0,
			"submenu_bg" 		=> "bg-dark",			
			"header_style" 		=> 1,
			"header_bg" 		=> "bg-secondary",
			"topmenu_bg" 		=> "bg-primary",
			"topmenu_social" 	=> 1,		
			
			"topmenu_bg_color" 		=> "#002c62",
			"header_bg_color" 		=> "#043e85",
			"submenu_bg_color" 		=> "#000",
			
		 );	
	 
		 
		 if(is_array($header_settings) && !empty($header_settings)){ 
		 
		 	foreach($header_settings as $k => $v){			 			
				if($v != ""){
					$df[$k] = $header_settings[$k];
				}			
			}
 		
		}else{		
		
			$default_settings = $CORE->LAYOUT("get_block_settings_defaults_new", array("header", "header106" ) );	
			 		 
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

echo str_replace("%logo%",$logoCode,str_replace("%topmenu%",$topMenuCode, ppt_theme_block_output($output, $df, array("header", "header106"))));

	
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