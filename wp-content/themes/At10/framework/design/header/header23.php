<?php
 
 
add_filter( 'ppt_blocks_args', 	array('block_header23',  'data') );
add_action( 'header23',  		array('block_header23', 'output' ) );
add_action( 'header23-css',  	array('block_header23', 'css' ) );
add_action( 'header23-js',  	array('block_header23', 'js' ) );

class block_header23 {

	function __construct(){}		

	public static function data($a){ 
  
		$a['header23'] = array(
			"name" 	=> "Style 23",
			"image"	=> "header23.jpg",
			"cat"	=> "header",
			"desc" 	=> "", 
			"data" 	=> array( ),
			"order" 	=> 23,
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $userdata, $new_settings, $settings;
	
		
		// ADD ON SYSTEM DEFAULTS
		$settings = array();
		$settings = $CORE->LAYOUT("get_block_settings_defaults", array("header23", "header", $settings ) );
 
		  
		 // UPDATE DATA FROM ELEMENTOR OR CHILD THEMES
		 if(is_array($new_settings)){
			 foreach($settings as $h => $j){
				if(isset($new_settings[$h]) && $new_settings[$h] != ""){
					$settings[$h] = $new_settings[$h];
				}
			 }
		 }
		 
		ob_start();
		
		?><header class="elementor_header header23 b-bottom logo-lg position-relative">
        
        <div class=" logotop">
        <div class="bg-overlay-secondary bg-primary"></div>
        <div class="logoarea">
     <?php  
	 
	 $settings['topmenu_bg'] = "";
	 _ppt_template( 'framework/design/header/parts/header-topmenu' ); ?>
        
   <nav class="elementor_mainmenu navbar navbar-dark navbar-expand-lg">
    
      <div class="container">
      
         <a class="navbar-brand" href="<?php echo home_url(); ?>"> 
         <?php echo $CORE->LAYOUT("get_logo","light");  ?>
         <?php echo $CORE->LAYOUT("get_logo","dark");  ?>
         </a>
        
        
         <div class="bannerarea">
            <?php _ppt_template( 'framework/design/header/parts/header-advertising' ); ?> 
            </div> 
         
        </div>  
      </div>
       </div>
   </nav> 
 
   <?php 
   
   $settings['submenu_css'] = "";
   
   $settings['submenu_bg'] = "navbar-dark bg-primary z-10";
   
   _ppt_template( 'framework/design/header/parts/header-submenu' ); ?> 
   
</header>
<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////



		$output = ob_get_contents();
		ob_end_clean();
		echo $output;	
	
		}
		
		public static function js(){ 
		return "";
		}
		
		public static function css(){ 
		
		$headerbg =  stripslashes(_ppt(array('design','header_bg')));
		 
		ob_start(); ?>
<style>

.header23 .elementor_topmenu {border-bottom: 1px solid #000; background: #000000cf; }
.header23 { z-index:11; border: 0px !important; }
.header23 .navbar-dark .navbar-brand-light {    text-shadow: 1px 1px #000; }
.header23 .logotop{ <?php if(strlen($headerbg) > 1){ ?>background: #000 url('<?php echo $headerbg; ?>') no-repeat; <?php } ?> background-size:cover; }
.bannerarea { width: 468px; }
@media (max-width: 575.98px) { 
.bannerarea { width:auto; }
}
.header23 .elementor_submenu {border-top: 1px solid #000;border-bottom:1px solid #000;padding: 0px;  } 
.header23 .navbar-nav { border-left:1px solid #000; }
.header23 .elementor_mainmenu .navbar-nav .nav-link {    line-height: 45px;    border-right: 1px solid #000; border-left: 1px solid #ffffff17; font-size: 14px; }
.header23 .elementor_mainmenu .navbar-nav .nav-link:hover { background:#000; }
.header23 .elementor_mainmenu .navbar-nav li.active > a { background:#000; }
.header23 .elementor_header .dropdown-menu {    border: 1px solid #000; border-bottom: 0px;    border-radius: 0px !important;  }
.header23 .elementor_mainmenu .navbar-collapse .dropdown-item { border-radius:0px; border-bottom:1px solid #000; }
 
.header23 .navbar .dropdown-menu { padding:0px;     border: 1px solid #000;    border-radius: 0px; }

.header23 .bg-overlay-secondary { opacity:0.8; z-index:0; } 
.header23 .logoarea { z-index: 1; }

.header23 .sellspace_banner {
    display: inline-block;
    background: #00000059;
    border: 0px solid #ebebeb;
    position: relative;
    text-shadow: 0px 0px 0 #fff;
    color: #fff;
}
.header23 .sellspace_banner .title {   color: #fff;}
.header23 .sellspace_banner .pricing {    background: #00000054;}
</style>
<?php 
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;
		}	
		
}

?>
