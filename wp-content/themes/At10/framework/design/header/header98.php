<?php
 
 
add_filter( 'ppt_blocks_args', 	array('block_header98',  'data') );
add_action( 'header98',  		array('block_header98', 'output' ) );
add_action( 'header98-css',  	array('block_header98', 'css' ) );
add_action( 'header98-js',  	array('block_header98', 'js' ) );

class block_header98 {

	function __construct(){}		

	public static function data($a){ 
  
		$a['header98'] = array(
			"name" 	=> "Style 98",
			"image"	=> "header98.jpg",
			"cat"	=> "header",
			"desc" 	=> "", 
			"data" 	=> array( ),
			"order" 	=> 0.9,
			
			"widget" => "ppt-header",
			
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $CORE_UI, $userdata, $header_settings, $df;
 
 
		// DEFAULTS
		 $df = array(
			"topmenu_show" 	=> 0,		 
			"btn_show" 		=> 1,
		 	"btn2_show" 	=> 1,
			"submenu_show" 	=> 0,
			"submenu_bg" 	=> 1,
			"submenu_style" => 0,			
			"header_style" 	=> 0,
			"header_bg" 	=> "bg-white",
			"topmenu_bg" 	=> "bg-white",
			"topmenu_social" => 1,		
			
		 );	
	 
		 
		 if(is_array($header_settings) && !empty($header_settings)){ 
		 
		 	foreach($header_settings as $k => $v){			 			
				if($v != ""){
					$df[$k] = $header_settings[$k];
				}			
			}
 		
		}else{		
		
			$default_settings = $CORE->LAYOUT("get_block_settings_defaults_new", array("header", "header98" ) );	
			 		 
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
$topMenuCode = "";

// HEADER
ob_start();
?>

<header class="<?php echo $df['header_bg']; ?> <?php if(in_array($df['header_bg'],array("bg-light","bg-white","bg-soft"))){ ?>navbar-light<?php }else{ ?>navbar-dark<?php } ?> border-bottom shadow-sm py-3" data-block-id="header">
  <div class="container">
    <div ppt-flex-between>
      %logo%
      <nav ppt-nav class="spacing seperator crumbs d-flex hide-mobile hide-ipad text-600"> <?php echo do_shortcode('[MAINMENU style=1][/MAINMENU]'); ?>
        <ul class="ml-n4">
          <?php if( $df['btn_show'] == "1" && !$userdata->ID ){ ?>
          <li> <a href="" class="border-left pl-3" data-ppt-btn-txt> <?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "sign_in" ) ); ?> <span ppt-icon-16><?php echo $CORE_UI->icons_svg['arrow-long-right']; ?></span> </a> </li>
          <?php }elseif( $df['btn2_show'] == "1" && $userdata->ID){ ?>
          <li> <a href="<?php echo _ppt(array('links','myaccount')); ?>" class="border-left pl-3" data-ppt-btn2-txt> <span ppt-icon-24><?php echo $CORE_UI->icons_svg['user']; ?></span> <?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "my_account" ) ); ?> </a> </li>
          <?php } ?>
        </ul>
      </nav>
      <div class="elementor_mainmenu show-ipad show-mobile">
        <div class="d-flex">
          <?php if($userdata->ID && in_array(_ppt(array('user','notify')), array("","1")) ){ ?>
          <div class="show-mobile show-ipad icon-notify" onclick="processNotificatons();">
            <i class="fa fa-bell">&nbsp;</i>
          </div>
          <?php }elseif(!$userdata->ID && !empty($CORE->GEO("get_languagelist",array()))){  $languages =  $CORE->GEO("get_languagelist",array());  ?>
          <div class="user-languages" onclick="processLanguages();">
            <span class="flag flag-<?php echo $CORE->GEO("get_language_icon",array());  ?>">&nbsp;</span>
          </div>
          <?php } ?>
          <button class="navbar-toggler menu-toggle tm border-0"> <span class="fa fa-bars">&nbsp;</span> </button>
        </div>
      </div>
    </div>
  </div>
</header>
<?php
$headerCode = ob_get_contents();
ob_end_clean();

// SUB MENU
$submenuCode = "";

$output = $headerCode.$submenuCode; 

echo str_replace("%logo%",$logoCode,str_replace("%topmenu%",$topMenuCode, ppt_theme_block_output($output, $df, array("header", "header98"))));

	
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
