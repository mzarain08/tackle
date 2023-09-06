<?php
 
add_filter( 'ppt_blocks_args',  array('block_hero5',  'data') );
add_action( 'hero5',  			array('block_hero5', 'output' ) );
add_action( 'hero5-css',  		array('block_hero5', 'css' ) );
add_action( 'hero5-js',  		array('block_hero5', 'js' ) );

class block_hero5 {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['hero5'] = array(
			"name" 	=> "Hero 5",
			"image"	=> "hero5.jpg",
			"cat"	=> "hero",
			"widget" => "ppt-hero",			
			"order" => 1.2,
			"desc" 	=> "", 
			"data" 	=> array( ),
			"defaults" => array(),
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $settings, $hero_settings, $df;	
	    
		 $df = array(
		 	"image" => DEMO_IMGS."?fw=hero5&t=".THEME_KEY,
			"image1" => "",
			"btn_show" => 1,
			"btn2_show" => 1,	
			"searchbox" => 0,				
			"image1_show" => 0,
			"video_show" => 0, 
		 
		 );
		 
		 if(is_array($hero_settings) && !empty($hero_settings)){
		 		 	
			 if(strlen($hero_settings['image']) > 1){
			 $df['image']		 = $hero_settings['image'];			
			 }elseif(!in_array($hero_settings['section_bg'],array("","none"))){
			 $df['image']		 = "";			
			 }
			 
			 $df['btn_show'] 		= $hero_settings['btn_show'];
			 $df['btn2_show'] 		= $hero_settings['btn2_show'];
			 $df['searchbox'] 		= $hero_settings['searchbox'];
			 $df['video_show'] 		= $hero_settings['video_show'];
			 $df['image1_show'] 	= $hero_settings['image1_show'];
			 
		 }else{		 
		 	$settings =  $CORE->LAYOUT("get_block_settings_defaults_new", array("hero", "hero5" ) );
		 	foreach($df as $h => $j){
				if(isset($settings[$h]) && $settings[$h] != ""){
					$df[$h] = $settings[$h];
				}
			 } 
		 }
		 
		 
 
		 
// LOGO
ob_start();
_ppt_template( 'framework/design/parts/search-list' );	
$searchCode = ob_get_contents();
ob_end_clean(); 
 
ob_start();
?>
<section class="pt-5 border-bottom section-60 position-relative overflow-hidden">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <div class="card  z-1">
          <div class="card-body">
            <h4 class="mb-3 text-600" data-ppt-title>We're here to help.</h4>
            <p class="small " data-ppt-subtitle>Lorem ipsum dolor sit amet.</p>
            
             %search%
          </div>
        </div>
      </div>
      <div class="col-md-8">
       
      </div>
    </div>
  </div>
  <div class="bg-image" style="background-image:url('<?php echo $df['image']; ?>');" data-ppt-image-bg>
    &nbsp;
  </div>
</section>
<?php
$output = ob_get_contents();
ob_end_clean();
echo str_replace("%search%",$searchCode, ppt_theme_block_output($output, $hero_settings, array("hero", "hero5")));
	
	}
	public static function css(){ global $CORE;
ob_start();?>
<style>

[data-ppt-blockid="hero5"] h1 { font-size:40px; }
@media (min-width:990px){

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