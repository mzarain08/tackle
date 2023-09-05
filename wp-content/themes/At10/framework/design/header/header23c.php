<?php
 
 
add_filter( 'ppt_blocks_args', 	array('block_header23c',  'data') );
add_action( 'header23c',  		array('block_header23c', 'output' ) );
add_action( 'header23c-css',  	array('block_header23c', 'css' ) );
add_action( 'header23c-js',  	array('block_header23c', 'js' ) );

class block_header23c {

	function __construct(){}		

	public static function data($a){ 
  
		$a['header23c'] = array(
			"name" 	=> "Style 23",
			"image"	=> "header23c.jpg",
			"cat"	=> "header",
			"desc" 	=> "", 
			"data" 	=> array( ),
			"order" 	=> 23,
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $userdata, $new_settings, $settings;
	
		
		// ADD ON SYSTEM DEFAULTS
		$settings = array();
		$settings = $CORE->LAYOUT("get_block_settings_defaults", array("header23c", "header", $settings ) );
 
		  
		 // UPDATE DATA FROM ELEMENTOR OR CHILD THEMES
		 if(is_array($new_settings)){
			 foreach($settings as $h => $j){
				if(isset($new_settings[$h]) && $new_settings[$h] != ""){
					$settings[$h] = $new_settings[$h];
				}
			 }
		 }
		 
		ob_start();
		
		?><header class="elementor_header header23c b-bottom logo-lg position-relative">
        
        <div class=" logotop">
       
        <div class="logoarea">
     <?php  
	 
	 $settings['topmenu_bg'] = "";
	 _ppt_template( 'framework/design/header/parts/header-topmenu' ); ?>
        
   <nav class="elementor_mainmenu navbar navbar-dark navbar-expand-lg ">
   
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
   
   $settings['submenu_bg'] = "navbar-dark bg-black z-10";
   
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
.header23c .elementor_topmenu {border-bottom: 1px solid #0000002e;   }
.header23c { z-index:11; border: 0px !important; }
.header23c .navbar-dark .navbar-brand-light {    text-shadow: 1px 1px #000; }
.header23c .logotop { <?php if(strlen($headerbg) > 1){ ?>background: #000 url('<?php echo $headerbg; ?>') no-repeat; <?php } ?> background-size:cover; }
.bannerarea { width: 468px; }
@media (max-width: 575.98px) { 
.bannerarea { width:auto; }
}
.header23c .bg-black { 


background: #ffffff; /* Old browsers */
background: -moz-linear-gradient(top,  #ffffff 0%, #e5e5e5 100%); /* FF3.6-15 */
background: -webkit-linear-gradient(top,  #ffffff 0%,#e5e5e5 100%); /* Chrome10-25,Safari5.1-6 */
background: linear-gradient(to bottom,  #ffffff 0%,#e5e5e5 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#e5e5e5',GradientType=0 ); /* IE6-9 */

}
.header23c .elementor_submenu {border: 0px; padding: 0px;  } 
body:not(.home) .header23c .elementor_submenu { border-bottom: 1px solid #d2d2d2;  } 

.header23c .navbar-nav { border-left:1px solid #a1a1a1; }
.header23c .elementor_mainmenu .navbar-nav li.active > a, .header23c .elementor_mainmenu .navbar-nav li a:hover { background:#000; color:#fff!important; text-shadow:none; }
 
.header23c .elementor_mainmenu .navbar-nav .nav-link {    line-height: 45px;    border-right: 1px solid #a1a1a1; border-left: 1px solid #ffffff17; font-size: 14px; text-shadow: 1px 1px #fff;  }
.header23c .elementor_mainmenu .navbar-nav .nav-link span {   text-shadow: 1px 1px #000; }
.header23c .navbar-dark .navbar-nav .nav-link  { color:#000 !important; }
.header23c .elementor_mainmenu .navbar-nav > .nav-link:hover { background:#000; }
.header23c .elementor_header .dropdown-menu {    border: 1px solid #a1a1a1; border-bottom: 0px;    border-radius: 0px !important;  }
.header23c .elementor_mainmenu .navbar-collapse .dropdown-item { border-radius:0px; border-bottom:1px solid #000; }
.header23c .elementor_mainmenu .navbar-collapse .dropdown-item:last { border-bottom:0px; }

.header23c .navbar .dropdown-menu { padding:0px;     border: 1px solid #000;    border-radius: 0px; }
 

.header23c .bg-overlay-secondary { opacity:0.8; z-index:0; } 
.header23c .logoarea { z-index: 1; }

.header23c .sellspace_banner {
    display: inline-block;
    background: #00000059;
    border: 0px solid #ebebeb;
    position: relative;
    text-shadow: 0px 0px 0 #fff;
    color: #fff;
}
.header23c .sellspace_banner .title {   color: #fff;}
.header23c .sellspace_banner .pricing {    background: #00000054;}
</style>
<?php 
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;
		}	
		
}

?>
