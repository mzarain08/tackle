<?php
 
add_filter( 'ppt_blocks_args',  array('block_hero18',  'data') );
add_action( 'hero18',  			array('block_hero18', 'output' ) );
add_action( 'hero18-css',  		array('block_hero18', 'css' ) );
add_action( 'hero18-js',  		array('block_hero18', 'js' ) );

class block_hero18 {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['hero18'] = array(
			"name" 	=> "Hero 18",
			"image"	=> "hero18.jpg",
			"cat"	=> "hero",
			"widget" => "ppt-hero",			
			"order" => 1.2,
			"desc" 	=> "", 
			"data" 	=> array( ),
			"defaults" => array(),
			"copy" => 1,
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $CORE_UI, $settings, $hero_settings, $df;	
	    
		
		$df = ppt_theme_blocks_defaults("hero"); 
		
		 $cc = array(
		 	"image" => "https://premiumpress1063.b-cdn.net/_demoimagesv10/icons/bg12.svg",
			"image1" => "http://localhost/demo-at.png",
			"btn_show" => 1,
			"btn2_show" => 0,	
			"searchbox" => 0,				
			"image1_show" => 1,
			"video_show" => 0, 
			
			"title" 	=> "Build {[awesome,totally cool,amazing]} <br /> websites today!",
			
			"title_color" => "#081c27",
			
			
			"title_animated" => 2,
			
			"title_underline" => 2,
			"title_underline_color" => "#ffd5d1",
			
			"subtitle" 	=> "Lorem ipsum dolor sit amet, consectetur adipiscing elit <br /> Praesent tempus eleifend risus ut congue.",
			"desc" 		=> "*No credit card required",
			
			"btn_txt" => "Video Demos",
			"btn2_txt" => "Watch Video",
			
			
			"btn_link" => "#demos",
			"btn2_link" => "#demos",
			
			"image1_css" => "", 
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
		
		 	$settings =  $CORE->LAYOUT("get_block_settings_defaults_new", array("hero", "hero18" ) );			 
		 	foreach($df as $h => $j){
				if(isset($settings[$h]) && $settings[$h] != ""){
					$df[$h] = $settings[$h];
				}
			 }  
			 
		} 
		
		
		 
		 
		ob_start();
		
		?>
<?php if(isset($GLOBALS['home-demo'])){ ?>
<?php }else{ ?>
<header class="elementor_header header7 b-bottom ppt-fixed-header navbar-light" >
  <?php _ppt_template( 'framework/design/header/parts/header-topmenu' ); ?>
  
  <nav class="navbar navbar-expand-lg logo-lg">
    <div class="container">
      <a class="navbar-brand" href="<?php echo home_url(); ?>"> <?php echo $CORE->LAYOUT("get_logo","light");  ?> <?php echo $CORE->LAYOUT("get_logo","dark");  ?> </a>
      <nav ppt-nav ppt-flex-end class="spacing seperator hide-mobile hide-ipad text-600"> <?php echo do_shortcode('[MAINMENU style=1]');  ?> </nav>
      <button class="navbar-toggler menu-toggle tm border-0"><span class="fal fa-bars">&nbsp;</span></button>
    </div>
  </nav>
  </header>
  <?php } ?>
  <section class="position-relative">
    <div class="container position-relative z-10 hero-padding-top-140" >
      <div class="row align-items-center mobile-text-center">
        <div class="col-lg-6">
        
          <h1 class="text-700 mb-3  lh-90" data-ppt-title><?php echo $df['title']; ?></h1>
          
          <div class="text-500 lh-40 opacity-5 fs-6" data-ppt-subtitle>
            <?php echo $df['subtitle']; ?>
          </div>
          
          <div class="text-500 lh-40 fs-14 mt-3 mobile-mb-4" >
            <span class="bg-light rounded-20 p-lg-3 mt-3" data-ppt-desc><?php echo $df['desc']; ?></span>
          </div>
          
          
         
          
          <div class="mt-5 mb-4 mobile-mb-2">
            <a href="<?php echo $df['btn_link']; ?>" class="btn-lg btn-primary text-600 list mb-4"  data-ppt-btn data-ppt-btn-txt><?php echo $df['btn_txt']; ?></a> <a href="<?php echo $df['btn2_link']; ?>" class="btn-lg btn-primary text-600 list mb-4 shadow-0 ml-md-4"  data-ppt-btn data-ppt-btn2-txt><?php echo $df['btn2_txt']; ?></a>
          </div>
          
          
        </div>
        <?php if($df['image1_show'] == "1"){ ?>
        <div class="col-lg-6">
          <div class="position-relative">
            <a href="#" data-ppt-image1-link>
            <?php if($df['video_show'] == "1"){ ?>
            <div class="videoplaybutton_wrap" style="position: absolute;top: 40%;left: 40%;">
              <div class="videoplaybutton bg-white" style="line-height: 110px;">
                <span class="fa fa-play fa-2x text-primary" style="position: absolute;    top: 35px;    left: 38px;">&nbsp;</span><span class="ripple_playbtn bg-white">&nbsp;</span><span class="ripple_playbtn bg-white">&nbsp;</span><span class="ripple_playbtn bg-white">&nbsp;</span>
              </div>
            </div>
            <?php } ?>
            <img data-src="<?php echo $df['image1']; ?>" class="img-fluid lazy img1" alt="image" data-ppt-image1> </a>
          </div>
        </div>
        <?php } ?>
      </div>
      <div class="container my-5 px-0">
        <div class="d-flex justify-content-lg-between shadow-lg hide-mobile" ppt-border1>
          <div  class=" w-100  mb-lg-0 ">
            <div class="d-flex flex-row p-3 ">
              <div  class="mr-3 text-primary">
                <div ppt-icon-size="64" data-ppt-icon>
                  <?php echo $CORE_UI->icons_svg['verified']; ?>
                </div>
              </div>
              <div>
                <div class="opacity-5" data-ppt-f1a>
                  Components
                </div>
                <div class="fs-lg text-700" >
                  <span class="ppt-countup" data-ppt-f1b>1000</span>+
                </div>
              </div>
            </div>
          </div>
          <div  class="mx-lg-3 border-left border-right w-100  mb-2 mb-lg-0">
            <div class="d-flex flex-row p-3">
              <div  class="mr-3 text-primary">
                <div ppt-icon-size="64" data-ppt-icon2>
                  <?php echo $CORE_UI->icons_svg['pages']; ?>
                </div>
              </div>
              <div>
                <div class="opacity-5" data-ppt-f2a>
                  Page Sections
                </div>
                <div class="fs-lg text-700" >
                  <span class="ppt-countup" data-ppt-f2b>250</span>+
                </div>
              </div>
            </div>
          </div>
          <div  class="mr-lg-3 border-right w-100 mb-lg-0 hide-ipad">
            <div class="d-flex flex-row p-3">
              <div  class="mr-3 text-primary">
                <div ppt-icon-size="64" data-ppt-icon3>
                  <?php echo $CORE_UI->icons_svg['desktop']; ?>
                </div>
              </div>
              <div>
                <div class="opacity-5" data-ppt-f3a>
                  Pre-built Designs
                </div>
                <div class="fs-lg text-700" >
                  <span class="ppt-countup" data-ppt-f3b>35</span>+
                </div>
              </div>
            </div>
          </div>
          <div class=" w-100 hide-ipad hide-mobile">
            <div class="d-flex flex-row p-3">
              <div  class="mr-3 text-primary">
                <div ppt-icon-size="64" data-ppt-icon4>
                  <?php echo $CORE_UI->icons_svg['smile']; ?>
                </div>
              </div>
              <div>
                <div class="opacity-5" data-ppt-f4a>
                  Admin Options
                </div>
                <div class="fs-lg text-700" >
                  <span class="ppt-countup" data-ppt-f4b>300</span>+
                </div>
              </div>
            </div>
          </div>
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
echo ppt_theme_block_output($output, $df, array("hero", "hero18"));
}
	public static function css(){ global $CORE;
ob_start();?>
<style> 

 
@media (min-width: 1200px){
.img1 { max-width:120%!important;     margin-left: -70px; } 
}
[data-ppt-blockid="hero18"] [data-ppt-desc] strong { padding: 5px 10px;    background: #fac106;    border-radius: 20px; margin-right: 20px; }
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