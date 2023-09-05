<?php
 
add_filter( 'ppt_blocks_args',  array('block_hero9',  'data') );
add_action( 'hero9',  			array('block_hero9', 'output' ) );
add_action( 'hero9-css',  		array('block_hero9', 'css' ) );
add_action( 'hero9-js',  		array('block_hero9', 'js' ) );

class block_hero9 {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['hero9'] = array(
			"name" 	=> "Hero 9",
			"image"	=> "hero9.jpg",
			"cat"	=> "hero",
			"widget" => "ppt-hero",			
			"order" => 1.9,
			"desc" 	=> "", 
			"data" 	=> array( ),
			"defaults" => array(),
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $settings, $hero_settings;	
	    
		 $df = array(
		 	"image" => DEMO_IMGS."?fw=hero9&t=".THEME_KEY,
			"btn_show" => 1,
			"btn2_show" => 0,
			"searchboxmap" => 0,		 
		 );
		 
		 $blockdata = array();
		 if(is_array($hero_settings) && !empty($hero_settings)){		 	
			 if(strlen($hero_settings['image']) > 1){
			 $image = $hero_settings['image'];
			 }
			 $df['btn_show'] = $hero_settings['btn_show'];
			 $df['btn2_show'] = $hero_settings['btn2_show'];
			 $df['searchboxmap'] 	= $hero_settings['searchboxmap']; 
		 }else{		 
		 	$settings =  $CORE->LAYOUT("get_block_settings_defaults_new", array("hero", "hero9" ) );
		 	foreach($df as $h => $j){
				if(isset($settings[$h]) && $settings[$h] != ""){
					$df[$h] = $settings[$h];
				}
			 } 
		 }
		ob_start();
		
		?>

<section class="hero9 bg-black py-5 text-light position-relative">

     
    <div class="container position-relative z-10">
      <div class="row align-items-center">
        <div class="col-lg-12 text-center">     
     
     <h1 data-ppt-title><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("hero1", "t" ) ); ?></h1>
          
     <p class="lead mb-4 mobile-mb-4" data-ppt-subtitle><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("hero1", "s" ) ); ?></p>     

<div class="mt-5 col-md-5 mx-auto"> 

 <?php if(isset($df['searchboxmap']) && $df['searchboxmap'] == "1"){ ?>
    
          <form method="get" action="<?php echo home_url(); ?>" style="max-width:500px;">
          <input type="hidden" name="s" value="" />
            <div class="bg-white rounded-lg p-1 d-flex">
              <?php echo _get_country_search_box_map(); ?>
              <button data-ppt-btn class="btn-secondary" type="submit"><?php echo __("Search","premiumpress"); ?></button>
            </div>
          </form>
    
        <?php }else{ ?>
 
<form method="get" action="<?php echo home_url(); ?>">
    <div class="bg-white rounded-lg p-1 d-flex">          
    <input class="typeahead form-control form-control-lg border-0 mb-0" type="text"  name="s" placeholder="<?php echo __("Start your search here...","premiumpress"); ?>"> 
    <button data-ppt-btn class="btn-primary" type="submit"><?php echo __("Search","premiumpress"); ?></button>         
    </div>  
</form>    

<?php } ?>
            

</div>
    
        </div>
      </div>
</div>
 
</section>
<?php
$output = ob_get_contents();
ob_end_clean();
echo ppt_theme_block_output($output, $hero_settings, array("hero", "hero9"));
	
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
 
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;	
	
	}	
	
}

?>