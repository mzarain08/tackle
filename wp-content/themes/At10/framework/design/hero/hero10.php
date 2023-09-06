<?php
 
add_filter( 'ppt_blocks_args',  array('block_hero10',  'data') );
add_action( 'hero10',  			array('block_hero10', 'output' ) );
add_action( 'hero10-css',  		array('block_hero10', 'css' ) );
add_action( 'hero10-js',  		array('block_hero10', 'js' ) );

class block_hero10 {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['hero10'] = array(
			"name" 	=> "Hero 10",
			"image"	=> "hero10.jpg",
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
		 	$settings =  $CORE->LAYOUT("get_block_settings_defaults_new", array("hero", "hero10" ) );
		 	foreach($df as $h => $j){
				if(isset($settings[$h]) && $settings[$h] != ""){
					$df[$h] = $settings[$h];
				}
			 } 
		 }
		ob_start();
		
		?>

<section class="hero10 bg-black py-5 text-light position-relative">
     
    <div class="container position-relative z-10">
    
      <div class="row align-items-center">
      
        <div class="col-lg-6">     
     
     <h1 data-ppt-title><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("hero1", "t" ) ); ?></h1>
          
     <p class="lead mb-4 mobile-mb-4" data-ppt-subtitle><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("hero1", "s" ) ); ?></p>     

<div class="mt-5 mb-md-4"> 
 
<form method="get" action="<?php echo home_url(); ?>">
<input type="hidden" name="s" value="" />
    <div class="bg-white rounded p-1 d-flex">          
     <?php echo _get_country_search_box_map(); ?> 
    <button class="btn-primary" data-ppt-btn type="submit"><?php echo __("Search","premiumpress"); ?></button>         
    </div>  
</form>    
            

</div>

</div>
 <div class="col-lg-6 col-xl-5 offset-xl-1 hide-mobile">    
 


<div class="card shadow hero-map map-container">
    <div class="card-body p-2">
   	 <div id="map-mainx" style="height:400px;"></div> 
    </div>
        <ul class="mapnavigation bg-primary list-unstyled m-0" style="bottom:20px;z-index:999;">
      <li><a href="#" class="prevmap-nav"><?php echo __("Prev","premiumpress"); ?></a></li>
      <li><a href="#" class="nextmap-nav"><?php echo __("Next","premiumpress"); ?></a></li>
    </ul>
</div>
 
 
    
        </div>
      </div>
</div>

</section>


  <input value="<?php if(is_numeric(_ppt(array('maps','zoom')))){ echo _ppt(array('maps','zoom')); }else{ echo 15; } ?>" class="map-zoom" type="hidden" />
  <input value="grey" class="map-color" type="hidden">
  <textarea id="mapdatabox" class="dynamic_map w-100" style="display:none;">&amp;</textarea> 
<input type="hidden" name="map-zoom" value="15">
<?php
$output = ob_get_contents();
ob_end_clean();
echo ppt_theme_block_output($output, $hero_settings, array("hero", "hero10"));
	
	}
	public static function css(){ global $CORE;
ob_start();?>
<style>
@media (min-width: 1200px){
[data-ppt-blocktype="hero"] h1 {
    font-size: 40px;
}
}
</style>
        <?php
	 
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;	
	
	}		
	public static function js(){ global $CORE;
		ob_start();
?>
<script>jQuery(document).ready(function(){

setTimeout(function(){  jQuery("#map-mainx").attr('id','map-main');}); }, 2000);
</script>
<?php
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;	
	
	}	
	
}

?>