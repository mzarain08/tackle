<?php
 
add_filter( 'ppt_blocks_args', 	array('block_video2',  'data') );
add_action( 'video2',  		array('block_video2', 'output' ) );
add_action( 'video2-css',  	array('block_video2', 'css' ) );
add_action( 'video2-js',  	array('block_video2', 'js' ) );

class block_video2 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['video2'] = array(
			"name" 		=> "Style 2",
			"image"		=> "video2.jpg",
			"cat"		=> "video",
			"desc" 		=> "", 
			"order" 	=> 0, 
			"widget" => "ppt-video",	
			"data" 	=> array( ),	
			
			"defaults" => array( ), 
			
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $video_settings;
	 	
		 
		 // ALL DEFAULT FIELDS
		 $df = ppt_theme_block_default(array("video","title","subtitle","desc"), 0);//
		
		 
		// APPLY CUSTOM CHANGES 
		$cc = array(
		
		
		"video_image" => "https://i.ytimg.com/vi/bPwrTpR0Pjo/hqdefault.jpg",
		"video_icon" => 1,
		"video_link" => "https://www.youtube.com/watch?v=bPwrTpR0Pjo",
		 		
		);
		
		$df = array_merge($df, $cc);
		
		// APPLY ELEMENTOR
		if(!empty($video_settings)){
			foreach($df as $k => $v){				
				if(isset($video_settings[$k]) && $video_settings[$k] != "" ){
					$df[$k] = $video_settings[$k];
				}
			}		
		}
	 
 
	ob_start();
	
	?>
<section class="section-60">

  <div class="container">
    <div class="row align-items-center">
      
      <div class="col-md-8 col-lg-6  position-relative pl-lg-5 mobile-mb-2">
          <a href="<?php echo $df['video_link']; ?>" data-ppt-video-link>
        <figure class="rounded position-relative">
        
       
     <?php if($df['video_icon'] == "1"){ ?>
     
             <div class="videoplaybutton_wrap">
            <div class="videoplaybutton bg-white" style="line-height: 110px;">
              <span class="fa fa-play fa-2x text-primary" style="position: absolute;    top: 35px;    left: 38px;">&nbsp;</span>
              <span class="ripple_playbtn bg-white">&nbsp;</span>
              <span class="ripple_playbtn bg-white">&nbsp;</span>
              <span class="ripple_playbtn bg-white">&nbsp;</span>
            </div>
          </div>
        
       <?php } ?>
        
        <img data-src="<?php echo $df['video_image']; ?>" class="img-fluid lazy rounded-lg shadow-sm"  alt="image" data-ppt-image-video>
        
        </figure>
        </a>
     
      </div>
      
     
      <div class="col-lg-6 pl-lg-5">
      
        <h2 class="mb-3" data-ppt-title>Awesome videos for everyone!</h2>
        
        <p class="text-600" data-ppt-subtitle>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. </p>
       
        <p class="mb-6" data-ppt-desc>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique.</p>
           
      </div>
     
    </div>
  
  </div>
</section>
<?php
		$output = ob_get_contents();
		ob_end_clean();
		echo ppt_theme_block_output($output, $video_settings, array("video", "video2"));
	
		}
		public static function css(){
		return "";
		ob_start();
 
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;
		}	
		public static function js(){
		return "";
		ob_start();
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;
		}	
}

?>