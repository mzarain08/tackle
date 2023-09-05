<?php



   /*
    ALL HEADERS HAVE
	
	1. elementor_header
	2. elementor_topmenu
	3. elementor_mainmenu
	
   
   */
 
add_filter( 'ppt_blocks_args', 	array('block_header15a',  'data') );
add_action( 'header15a',  		array('block_header15a', 'output' ) );
add_action( 'header15a-css',  	array('block_header15a', 'css' ) );

class block_header15a {

	function __construct(){}		

	public static function data($a){ 
  
		$a['header15a'] = array(
			"name" 	=> "Style 15 - logo only",
			"image"	=> "header15a.jpg",
			"cat"	=> "header",
			"desc" 	=> "", 
			"order" => 15,
			"data" 	=> array( ),
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $userdata, $new_settings, $settings;
	
		
		// ADD ON SYSTEM DEFAULTS
		$settings = array();
		$settings = $CORE->LAYOUT("get_block_settings_defaults", array("header15a", "header", $settings ) );
 
		  
		 // UPDATE DATA FROM ELEMENTOR OR CHILD THEMES
		 if(is_array($new_settings)){
			 foreach($settings as $h => $j){
				if(isset($new_settings[$h]) && $new_settings[$h] != ""){
					$settings[$h] = $new_settings[$h];
				}
			 }
		 }   
 
		ob_start();
		
		?><header class="elementor_headerx header15a border-none py-0 logo-lg">
  <?php _ppt_template( 'framework/design/header/parts/header-topmenu' ); ?>
  
   <nav class="elementor_mainmenu navbar navbar-light navbar-expand-lg py-2"> 
      <div class="container">
      
         <a class="navbar-brand ml-2 ml-md-0" href="<?php echo home_url(); ?>"> 
         <?php echo $CORE->LAYOUT("get_logo","light");  ?>
         <?php echo $CORE->LAYOUT("get_logo","dark");  ?>
         </a> 
        
           <div>
            <?php _ppt_template( 'framework/design/header/parts/header-advertising' ); ?> 
            </div>          
        
      </div>
   </nav> 
  
</header>

<span class="line-1"></span>
<span class="line-2"></span>
 
<?php

		$output = ob_get_contents();
		ob_end_clean();
		echo $output;	
	
		}
	
		public static function css(){ 
		ob_start();?>
        <style>
		
.line-1 {
display: block;
    height: 1px;
    background: #ededed;
}
.line-2 {
display: block;
    height: 1px;
    background: #fff;
}

.line-fade1 {
    display: block;
border: none;
    color: white;
    height: 1px;
    background: #ededed;
    background: -webkit-gradient(radial, 1% 1%, 0, 50% 50%, 150, from(#ededed), to(#fafafb));
}
.line-fade2 {
    display: block;
border: none;
    color: white;
    height: 1px;
    background: #fff;
    background: -webkit-gradient(radial, 1% 1%, 0, 50% 50%, 150, from(#fff), to(#fafafb));
}

		.header15a .sellspace-live { width:468px; }
		</style>
        <?php 
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;
		}	
}

?>
