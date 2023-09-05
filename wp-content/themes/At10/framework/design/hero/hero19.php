<?php
 
add_filter( 'ppt_blocks_args',  array('block_hero19',  'data') );
add_action( 'hero19',  			array('block_hero19', 'output' ) );
add_action( 'hero19-css',  		array('block_hero19', 'css' ) );
add_action( 'hero19-js',  		array('block_hero19', 'js' ) );

class block_hero19 {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['hero19'] = array(
			"name" 	=> "Hero 19",
			"image"	=> "hero19.jpg",
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
			"image1" => "http://localhost/bg1.png",
			"btn_show" => 1,
			"btn2_show" => 0,	
			"searchbox" => 0,				
			"image1_show" => 1,
			"video_show" => 0, 
			
			"title" 	=> "Build {awesome} websites <br /> with PremiumPress themes.",
			
			"title_underline" => "1",
			"title_underline_color" => "#FF9200",
			
			"subtitle" 	=> "Lorem ipsum dolor sit amet, consectetur adipiscing elit <br /> Praesent tempus eleifend risus ut congue.",
			"desc" 		=> "*No credit card required",
			
			"btn_txt" => "Start 14-Days Free Trail",
			
			"section_bg" => "ppt-gradient1",
			
			
		 
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
		 	$settings =  $CORE->LAYOUT("get_block_settings_defaults_new", array("hero", "hero19" ) );
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
 
<div class="container position-relative z-10 text-center hero-padding-top-140" >


<div class="row">

<div class="col-md-10 mx-auto">

    <h1 class="text-white text-600 mb-4  text-shadow-sm" data-ppt-title><?php echo $df['title']; ?></h1>
    
    <div class="text-500 text-light lh-30" data-ppt-subtitle><?php echo $df['subtitle']; ?></div>
    
    <div class="my-4 d-flex d-sm-inline-flex h1buttonbox mx-auto px-3">
            
            <?php if(THEME_KEY == "sp"){ ?>
            
              <?php if($df['btn_show'] == "1"){ ?>
               <a href="<?php echo home_url(); ?>/?s=" class="btn-lg btn-primary text-600" data-ppt-btn data-ppt-btn2-txt><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "start_search" ) ); ?></a>
              <?php } ?>
             
            <?php }else{ ?>
            
              <?php if($df['btn_show'] == "1"){ ?>
              
              <a href="<?php echo $df['btn_link']; ?>" class="btn-lg btn-system text-600"  data-ppt-btn data-ppt-btn-txt><?php echo $df['btn_txt']; ?></a>
             
              <?php } ?>
              
              <?php if($df['btn2_show'] == "1"){ ?>
              <a href="<?php echo home_url(); ?>/?s=" class="btn-lg btn-primary text-600"  data-ppt-btn data-ppt-btn2-txt><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "start_search" ) ); ?></a>
              <?php } ?>
              
            <?php } ?>
              
    </div> 
    
    <div class="text-500 text-light lh-30 opacity-5 mb-5 mobile-mb-4" data-ppt-desc><?php echo $df['desc']; ?></div>
 
</div>
 
</div>

</div>


<div class="container-fluid px-0">
<div class="position-relative mb-n5">

    <div class="overflow-hidden w-100 animate-bgScroll relative z-10 mt-4" style="background:url('<?php echo $df['image1']; ?>')  0% 0% / auto 100% repeat-x;"></div>
        
</div>

</div> 
 
</section>
 
<?php
$output = ob_get_contents();
ob_end_clean();
echo ppt_theme_block_output($output, $df, array("hero", "hero19"));
	
	}
	public static function css(){ global $CORE;
ob_start();?>
<style>

.animate-bgScroll {    -webkit-animation: bg-scroll 120s linear infinite;    animation: bg-scroll 120s linear infinite; height:500px;	}
@keyframes bg-scroll{0%{background-position:0 0}to{background-position:-3746px 0}}
[data-fullpage]{background-position:center;background-size:cover;background-repeat:no-repeat;margin:0; }
@media (min-width:600px){
[data-fullpage]{height:100vh;}
}
@media (min-width: 600px){	[data-fullpage] ._contents {		top: 25%;	} 
}
@media (max-width: 575.98px){
.animate-bgScroll {   
	height:200px!important;
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