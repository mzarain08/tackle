<?php
 
add_filter( 'ppt_blocks_args',  array('block_hero21',  'data') );
add_action( 'hero21',  			array('block_hero21', 'output' ) );
add_action( 'hero21-css',  		array('block_hero21', 'css' ) );
add_action( 'hero21-js',  		array('block_hero21', 'js' ) );

class block_hero21 {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['hero21'] = array(
			"name" 	=> "Hero 21",
			"image"	=> "hero21.jpg",
			"cat"	=> "hero",
			"widget" => "ppt-hero",			
			"order" => 1.2,
			"desc" 	=> "", 
			"data" 	=> array( ),
			"defaults" => array(),
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $settings, $hero_settings, $df;	
	    
		
		$df = ppt_theme_blocks_defaults("hero"); 
		
		 $cc = array(
		 	"image" => "https://premiumpress1063.b-cdn.net/_demoimagesv10/icons/bg2.png",
			"image1" => "https://premiumpress1063.b-cdn.net/_demoimagesv10/icons/screen1.jpg",
			"btn_show" => 1,
			"btn2_show" => 0,	
			"searchbox" => 0,				
			"image1_show" => 1,
			"video_show" => 1, 
			
			"title" 	=> "Build {awesome} websites <br /> with PremiumPress themes.",
			
			"title_underline" => "1",
			"title_underline_color" => "#FF9200",
			
			"subtitle" 	=> "Lorem ipsum dolor sit amet, consectetur adipiscing elit <br /> Praesent tempus eleifend risus ut congue.",
			"desc" 		=> "*No credit card required",
			
			"btn_txt" => "Start 14-Days Free Trail",
			
			"section_bg_color" => "#413c69",
			
			"section_divider" => 2,
			"section_divider_color1_custom" => "#413c69",
			"section_divider_color2" => "light",
			
			
		 
		 );
		 
		  $df = array_merge($df, $cc);
		 
		// APPLY ELEMENTOR
		if(!empty($hero_settings)){
			foreach($df as $k => $v){				
				if(isset($hero_settings[$k]) && $hero_settings[$k] != "" ){
					$df[$k] = $hero_settings[$k];
				}
			}		
		
		// 2. HOME DESIGNS		
		}else{	
		 	$settings =  $CORE->LAYOUT("get_block_settings_defaults_new", array("hero", "hero21" ) );
		 	foreach($df as $h => $j){
				if(isset($settings[$h]) && $settings[$h] != ""){
					$df[$h] = $settings[$h];
				}
			 } 
		} 
		 
		 
		ob_start();
		
		?> 


<header class="elementor_header header7 b-bottom ppt-fixed-header navbar-dark" >
  <?php _ppt_template( 'framework/design/header/parts/header-topmenu' ); ?>  
  <nav class="navbar navbar-expand-lg logo-lg">
    <div class="container">
    
    <a class="navbar-brand" href="<?php echo home_url(); ?>"> <?php echo $CORE->LAYOUT("get_logo","light");  ?> <?php echo $CORE->LAYOUT("get_logo","dark");  ?> </a>
      
      
        <nav ppt-nav ppt-flex-end class="spacing seperator hide-mobile hide-ipad text-600">  
    
    <?php echo do_shortcode('[MAINMENU style=1]');  ?>   
    
    </nav> 
      
      
      <button class="navbar-toggler menu-toggle tm border-0"><span class="fal fa-bars">&nbsp;</span></button>  
    </div>
  </nav>
</header>

<section class="position-relative">
 
<div class="container position-relative z-10 text-center hero-padding-top-140" >


<div class="row">

<div class="col-md-10 mx-auto">

    <h1 class="text-white text-600 mb-4  text-shadow-sm" data-ppt-title><?php echo $df['title']; ?></h1>
    
    <div class="text-500 text-light lh-40  fs-6" data-ppt-subtitle><?php echo $df['subtitle']; ?></div>
    
   
        <div class="my-5 mx-auto col-11 col-lg-8">
          <form method="get" action="<?php echo home_url(); ?>">
            <div class="bg-white rounded-lg p-1 d-flex">
              <input class="typeahead form-control form-control-lg border-0 mb-0" type="text"  name="s" placeholder="<?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "start_search_here" ) ); ?>">
              <button class="btn-primary btn-search" data-ppt-btn type="submit"><span><?php echo __("Search","premiumpress"); ?></span></button>
            </div>
          </form>
        </div>
         
    
    
    
         
        <div class="position-relative mb-lg-n5">
          <a href="#" data-ppt-image1-link>
          <?php if($df['video_show'] == "1"){ ?>
          <div class="videoplaybutton_wrap" style="position: absolute;top: 40%;left: 45%;">
            <div class="videoplaybutton bg-white" style="line-height: 110px;">
              <span class="fa fa-play fa-2x text-primary" style="position: absolute;    top: 35px;    left: 38px;">&nbsp;</span><span class="ripple_playbtn bg-white">&nbsp;</span><span class="ripple_playbtn bg-white">&nbsp;</span><span class="ripple_playbtn bg-white">&nbsp;</span>
            </div>
          </div>
          <?php } ?>
          <img src="<?php echo $df['image1']; ?>" class="img-fluid rounded <?php if(isset($df['image1_shadow'])){ echo $df['image1_shadow']; } ?>" alt="image" data-ppt-image1> </a>
        </div>
     
       
</div>

</div>

</div> 


</section>
 
 
<?php
$output = ob_get_contents();
ob_end_clean();
echo ppt_theme_block_output($output, $df, array("hero", "hero21"));
	
	}
	public static function css(){ global $CORE;

return "";
 
	
	}		
	public static function js(){ global $CORE;
		ob_start();
 
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;	
	
	}	
	
}

?>