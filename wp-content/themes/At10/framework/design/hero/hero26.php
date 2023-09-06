<?php
 
add_filter( 'ppt_blocks_args',  array('block_hero26',  'data') );
add_action( 'hero26',  			array('block_hero26', 'output' ) );
add_action( 'hero26-css',  		array('block_hero26', 'css' ) );
add_action( 'hero26-js',  		array('block_hero26', 'js' ) );

class block_hero26 {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['hero26'] = array(
			"name" 	=> "Hero 26",
			"image"	=> "hero26.jpg",
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
		 	"image" => "https://premiumpress1063.b-cdn.net/_demoimagesv10/icons/bg11.png",
			"image1" => "",
			"btn_show" => 1,
			"btn2_show" => 1,
				
			"searchbox" => 0,				
			"image1_show" => 0,
			"video_show" => 0, 
			
			"title" 	=> "Build {[awesome,totally cool,amazing]} websites today!",
			
			"title_color" => "#081c27", 
			
			"title_animated" => 2,
			
			"title_underline" => 1,
			"title_underline_color" => "#f6682a",
			
			"subtitle" 	=> "Lorem ipsum dolor sit amet, consectetur adipiscing elit <br /> Praesent tempus eleifend risus ut congue.",
			"desc" 		=> "",
			
			"btn_txt" => "Join Free Today!",
			
			"btn2_txt" => "Watch Video",
			
			"btn2_link" => "https://www.youtube.com/watch?v=bPwrTpR0Pjo",
			
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
		 	$settings =  $CORE->LAYOUT("get_block_settings_defaults_new", array("hero", "hero26" ) );
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

<section class="position-relative"  data-fullpage="1">
 
<div class="container position-relative z-10 hero-padding-top-200" >


<div class="row align-items-center mobile-text-center">
<div class="col-lg-6">

 
    <h1 class="text-600 mb-4 fs-xxl lh-90 text-white" data-ppt-title><?php echo $df['title']; ?></h1>
    
    <div class="text-500 lh-40 opacity-5 fs-6 text-white" data-ppt-subtitle><?php echo $df['subtitle']; ?></div>
    
   
     
     
     <div class="mt-5 mb-4 mobile-mb-2">
     
  <a href="<?php echo $df['btn_link']; ?>" class="btn-lg btn-primary text-600 list mb-4"  data-ppt-btn data-ppt-btn-txt><?php echo $df['btn_txt']; ?></a>
         
  <?php if($df['btn2_show'] == "1"){ ?>
  
   <a href="<?php echo $df['btn2_link']; ?>" class="btn-lg btn-transparent text-600 list mb-4 shadow-0 text-white"  data-ppt-btn><span class="fa fa-play-circle mr-2">&nbsp;</span> <span data-ppt-btn2-txt><?php echo $df['btn2_txt']; ?></span> </a>
   
   <?php } ?>
  
  </div> 
     
     
   
 <div class="text-500 lh-40  fs-6 opacity-5 mb-4 text-white" data-ppt-desc>
 
 <?php echo $CORE->LAYOUT("get_placeholder_text_new", array("short", "already" ) ); ?>
  <a href="javascript:void(0);" onclick="processLogin();" class="text-white"><u><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "sign_in" ) ); ?></u></a>
  
  </div>
   

</div>

 
      <?php if($df['image1_show'] == "1"){ ?>
      <div class="<?php if(isset($df['image1_offset']) && $df['image1_offset'] == "1"){ ?>col-lg-5 offset-lg-1<?php }elseif(isset($df['image1_offset']) && $df['image1_offset'] == "2"){?>col-lg-4 offset-lg-2<?php }else{ ?>col-lg-6<?php } ?>">
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
echo ppt_theme_block_output($output, $df, array("hero", "hero26"));
	
	}
	public static function css(){ global $CORE;
ob_start();?>
<style>
 
[data-fullpage]{background-position:center;background-size:cover;background-repeat:no-repeat;margin:0; }
@media (min-width:600px){
[data-fullpage]{height:100vh;}
}
@media (min-width: 576px) and (max-width: 991.98px){
 
[data-ppt-blockid="hero26"] .bg-image { background-size: auto!important; background-position: -200px; } 
} 
@media (max-width: 600px){
[data-ppt-blockid="hero26"] img { max-width:100%; }  
[data-ppt-blockid="hero26"] .bg-image { background-size: auto!important; background-position: -200px; } 
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