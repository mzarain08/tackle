<?php
 
add_filter( 'ppt_blocks_args',  array('block_hero11',  'data') );
add_action( 'hero11',  			array('block_hero11', 'output' ) );
add_action( 'hero11-css',  		array('block_hero11', 'css' ) );
add_action( 'hero11-js',  		array('block_hero11', 'js' ) );

class block_hero11 {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['hero11'] = array(
			"name" 	=> "Hero 11",
			"image"	=> "hero11.jpg",
			"cat"	=> "hero",
			"widget" => "ppt-hero",			
			"order" => 1.10,
			"desc" 	=> "", 
			"data" 	=> array( ),
			"defaults" => array(),
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $settings, $hero_settings;	
	    
		 $df = array(
			"btn_show" => 1,
			"btn2_show" => 0,		 
		 );
		 
		 $blockdata = array();
		 if(is_array($hero_settings) && !empty($hero_settings)){		 	
			
			 $df['btn_show'] = $hero_settings['btn_show'];
			 $df['btn2_show'] = $hero_settings['btn2_show'];
		 }else{		 
		 	$settings =  $CORE->LAYOUT("get_block_settings_defaults_new", array("hero", "hero11" ) );
		 	foreach($df as $h => $j){
				if(isset($settings[$h]) && $settings[$h] != ""){
					$df[$h] = $settings[$h];
				}
			 } 
		 }
	 
	 
	 
ob_start();
_ppt_template( 'framework/design/parts/search-inline' ); 	 
$search = ob_get_contents();	 
ob_end_clean();	 
	 
		ob_start();
		
		?>

<section class="hero-map position-relative hero-default her-search hero-default hero-map ppt-forms">

  <div class="map-container clearfix">
  
    <div id="map-main" class="w-100  mb-0" style="height:650px;">
    <?php
	
	// elementor preview
		if( isset($_REQUEST['preview_id']) || isset($_REQUEST['elementor_library']) ||  ( isset($_REQUEST['action']) && $_REQUEST['action'] == "elementor" ) ){
	 ?>
     <div class=" y-middle text-center text-dark h-100">
     
     <div> <h1>Map Preview</h1> <br />The map will display here in live view only.</div>
      
     </div>
     <?php
		
		} ?>
    
    </div>
 
     
    <div class="mapsearch w-100 py-sm-4" style="bottom:0px; background:#0000004d;">
     
      <div class="container position-relative px-0">
            <ul class="mapnavigation bg-primary list-unstyled m-0 hide-mobile" style="top:-10px;z-index:999;height: 35px;">
      <li><a href="#" class="prevmap-nav"><?php echo __("Prev","premiumpress"); ?></a></li>
      <li><a href="#" class="nextmap-nav"><?php echo __("Next","premiumpress"); ?></a></li>
    </ul>
      <div class="card"><div class="card-body">
      
       <h1 class="title mt-n2 mb-2" data-ppt-title><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("hero1", "t" ) ); ?></h1>
      %search%
       
        </div></div>
        
      </div>
          </div>
    </div>
 
  <input value="<?php if(is_numeric(_ppt(array('maps','zoom')))){ echo _ppt(array('maps','zoom')); }else{ echo 15; } ?>" class="map-zoom" type="hidden" />
  <input value="grey" class="map-color" type="hidden" />
  <textarea id="mapdatabox" class="dynamic_map w-100" style="display:none;">&nbsp;</textarea> 
</section>

 
<?php
$output = ob_get_contents();
ob_end_clean();
echo str_replace("%search%",$search,ppt_theme_block_output($output, $hero_settings, array("hero", "hero11")));
	
	}
	public static function css(){ global $CORE;
ob_start();?>
<style>
 
@media (min-width: 575.98px) { 
h1.title {
    font-size: 16px!important;
}
.mapsearch { position:absolute; }
}
@media (max-width: 575.98px) { 
#map-main { display:none; }
}
</style>
        <?php
	 
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;	
	
	}		
	public static function js(){ global $CORE;
		ob_start();
 
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;	
	
	}	
	
}

?>