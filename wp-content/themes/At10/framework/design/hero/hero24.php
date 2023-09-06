<?php
 
add_filter( 'ppt_blocks_args',  array('block_hero24',  'data') );
add_action( 'hero24',  			array('block_hero24', 'output' ) );
add_action( 'hero24-css',  		array('block_hero24', 'css' ) );
add_action( 'hero24-js',  		array('block_hero24', 'js' ) );

class block_hero24 {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['hero24'] = array(
			"name" 	=> "Hero 24",
			"image"	=> "hero24.jpg",
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
		 	"image" => "https://premiumpress1063.b-cdn.net/_demoimagesv10/icons/bg7.png",
			"image1" => "https://premiumpress1063.b-cdn.net/_demoimagesv10/icons/phone.png",
			"btn_show" => 1,
			"btn2_show" => 0,	
			"searchbox" => 0,				
			"image1_show" => 1,
			"video_show" => 0, 
			
			"title" 	=> "Build {[awesome,totally cool,amazing]} websites today!",
			
			"title_color" => "#081c27",
			
			
			"title_animated" => 2,
			
			"title_underline" => 2,
			"title_underline_color" => "#67d2a0",
			
			"subtitle" 	=> "Lorem ipsum dolor sit amet, consectetur adipiscing elit <br /> Praesent tempus eleifend risus ut congue.",
			"desc" 		=> "",
			
			"btn_txt" => "",
			
			//"section_bg_color" => "#fef2d9",
			
			//"section_divider" => 2,
			//"section_divider_color1_custom" => "#413c69",
			//"section_divider_color2" => "light",
			
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
		 	$settings =  $CORE->LAYOUT("get_block_settings_defaults_new", array("hero", "hero24" ) );
		 	foreach($df as $h => $j){
				if(isset($settings[$h]) && $settings[$h] != ""){
					$df[$h] = $settings[$h];
				}
			 } 
		} 
		 
		 
		ob_start();
		
		?> 


<header class="elementor_header header7 b-bottom ppt-fixed-header navbar-light" >
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

<section class="position-relative" >
 
<div class="container position-relative z-10 hero-padding-top-200" >


<div class="row align-items-center mobile-text-center">
<div class="col-lg-5">

 
    <h1 class="text-600 mb-4" data-ppt-title><?php echo $df['title']; ?></h1>
    
    <div class="text-500 lh-40 opacity-5 fs-6" data-ppt-subtitle><?php echo $df['subtitle']; ?></div>
    
   
        <div class="my-5 col-12 col-md-11 px-0">
          <form method="get" action="<?php echo home_url(); ?>">
            <div class="bg-white rounded-lg p-1 d-flex">
              <input class="typeahead form-control form-control-lg border-0 mb-0" type="text"  name="s" placeholder="<?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "start_search_here" ) ); ?>">
              <button class="btn-primary btn-search" data-ppt-btn type="submit"><span><?php echo __("Search","premiumpress"); ?></span></button>
            </div>
          </form>
        </div> 
   
 <div class="text-500 lh-40  fs-6 opacity-5 mb-4" data-ppt-desc>
 
 <?php echo $CORE->LAYOUT("get_placeholder_text_new", array("short", "already" ) ); ?>
  <a href="javascript:void(0);" onclick="processLogin();"><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "sign_in" ) ); ?></a>
  
  </div>
   

</div>

 
      <?php if($df['image1_show'] == "1"){ ?>
      <div class="<?php if(isset($df['image1_offset']) && $df['image1_offset'] == "1"){ ?>col-lg-5 offset-lg-1<?php }elseif(isset($df['image1_offset']) && $df['image1_offset'] == "2"){?>col-lg-4 offset-lg-2<?php }else{ ?>col-lg-7<?php } ?>">
        <div class="position-relative">
          <a href="#" data-ppt-image1-link>
          <?php if($df['video_show'] == "1"){ ?>
          <div class="videoplaybutton_wrap" style="position: absolute;top: 40%;left: 40%;">
            <div class="videoplaybutton bg-white" style="line-height: 110px;">
              <span class="fa fa-play fa-2x text-primary" style="position: absolute;    top: 35px;    left: 38px;">&nbsp;</span><span class="ripple_playbtn bg-white">&nbsp;</span><span class="ripple_playbtn bg-white">&nbsp;</span><span class="ripple_playbtn bg-white">&nbsp;</span>
            </div>
          </div>
          <?php } ?>
          <img src="<?php echo $df['image1']; ?>" class="img-fluid <?php if(isset($df['image1_shadow'])){ echo $df['image1_shadow']; } ?>" alt="image" data-ppt-image1> </a>
        </div>
      </div>
      <?php } ?>

 

</div> 
</div> 


<div class="bg-image" style="background-image:url('<?php echo $df['image']; ?>');" data-ppt-image-bg>&nbsp;</div>

</section>
 
 
<?php
$output = ob_get_contents();
ob_end_clean();
echo ppt_theme_block_output($output, $df, array("hero", "hero24"));
	
	}
	public static function css(){ global $CORE;
ob_start();?>
<style>
 
[data-fullpage]{background-position:center;background-size:cover;background-repeat:no-repeat;margin:0; }
@media (min-width:600px){
[data-fullpage]{height:100vh;}
}
 
@media (max-width: 600px){
[data-ppt-blockid="hero24"] img { max-width:100%; } 
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