<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text124',  'data') );
add_action( 'text124',  		array('block_text124', 'output' ) );
add_action( 'text124-css',  	array('block_text124', 'css' ) );
add_action( 'text124-js',  	array('block_text124', 'js' ) );

class block_text124 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text124'] = array(
			"name" 		=> "Style 124",
			"image"		=> "text124.jpg",
			"cat"		=> "text",
			"desc" 		=> "", 
			"order" 	=> 0, 
			"widget" => "ppt-text",	
			"data" 	=> array( ),	
			
			"defaults" => array( ), 
			
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $text_settings;
	 	
		  // ALL DEFAULT FIELDS
		 $df = ppt_theme_blocks_defaults("text"); 
		  
		
		 $cc = array(
		 	"image1" => DEMO_IMGS."?fw=text124a&t=".THEME_KEY,
			"image2" => DEMO_IMGS."?fw=text124b&t=".THEME_KEY,
			"image3" => DEMO_IMGS."?fw=text124c&t=".THEME_KEY,
			"image4" => DEMO_IMGS."?fw=text124d&t=".THEME_KEY,
			
			"image1_txt" => $CORE->LAYOUT("get_placeholder_text_new", array("text124a", "t" ) ),
			"image2_txt" => $CORE->LAYOUT("get_placeholder_text_new", array("text124b", "t" ) ),
			"image3_txt" => $CORE->LAYOUT("get_placeholder_text_new", array("text124c", "t" ) ),
			"image4_txt" => $CORE->LAYOUT("get_placeholder_text_new", array("text124d", "t" ) ),
			"image5_txt" => $CORE->LAYOUT("get_placeholder_text_new", array("text124e", "t" ) ),
			"image6_txt" => $CORE->LAYOUT("get_placeholder_text_new", array("text124f", "t" ) ),
			
			"image1_txt1" => "Pellentesque nec lacus elit.",
			"image2_txt1" => "Pellentesque nec lacus elit.",
			"image3_txt1" => "Pellentesque nec lacus elit.",
			"image4_txt1" => "Pellentesque nec lacus elit.",
					
			"btn1" => 1,
			"btn2" => 0, 
			
			"title" => $CORE->LAYOUT("get_placeholder_text_new", array("hero1", "t" ) ),
			"subtitle" => $CORE->LAYOUT("get_placeholder_text_new", array("hero1", "s" ) ),
			
		 );
		 
		$df = array_merge($df, $cc);
		
		// APPLY ELEMENTOR
		if(!empty($text_settings)){
			foreach($df as $k => $v){				
				if(isset($text_settings[$k]) && $text_settings[$k] != "" ){
					$df[$k] = $text_settings[$k];
				}
			}		
		// 2. HOME DESIGNS		
		}else{	
			 
		 	$settings =  $CORE->LAYOUT("get_block_settings_defaults_new", array("text", "text124" ) );
		 	foreach($df as $h => $j){
				if(isset($settings[$h]) && $settings[$h] != ""){
					$df[$h] = $settings[$h];
				}
			 } 
		}
	 
 
	ob_start();
	
	
	$data = array();
	$i=1; while($i < 5){
			$data[] = array( 
				"image" =>  $df['image'.$i],				 
				"name"	=> $df['image'.$i.'_txt'],
				"desc"	=> $df['image'.$i.'_txt1'],
				"css"	=> "ppt-h350",
				"link"	=> home_url()."/?s=", 
			); 
	
	$i++;
	}
	
	?><section class="section-60 border-bottom">
  <div class="container">
    <div class="row">
      <div class="container">
        <div class="row">
          
          
          <div class="col-12 text-md-center mb-4">
          
            
              <h1 class="text-primary" data-ppt-title><?php echo $df['title']; ?></h1>
              
              <p class="lead" data-ppt-subtitle><?php echo $df['subtitle']; ?></p>
        </div>
            
    <div class="col-12 hide-mobile">
        <div class="row">
    <?php $i=1; foreach($data as $cat){ ?>
         <div class="col-12 col-md-6 col-lg-3 mb-4">
            <div class="overflow-hidden text124-card style3 <?php echo $cat['css']; ?>">
              <div class="bg-gradient" style="z-index:1;">&nbsp;</div>
              <figure>
                <div class="bg-image" data-bg="<?php echo $cat['image']; ?>"  data-ppt-image<?php echo $i; ?>-bg>&nbsp;</div>
              </figure>
              <a href="<?php echo $cat['link']; ?>" data-ppt-image<?php echo $i; ?>-link>
              <h4> <strong data-ppt-image<?php echo $i; ?>_txt><?php echo $cat['name']; ?></strong> <span data-ppt-image<?php echo $i; ?>_txt1><?php echo $cat['desc']; ?></span> </h4>
              </a>
            </div>
          </div>
    <?php $i++; } ?>        
        </div> 
      </div>
       <?php if($df['btn1']){ ?>
      <div class="col-12 text-center my-sm-4">        
        <a href="<?php echo home_url()."/?s="; ?>" class="btn-lg btn-primary btn-rounded-25  mt-2 btn-icon icon-after" data-ppt-btn data-ppt-btn-link>
        <span data-ppt-btn_txt><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "start_search" ) ); ?></span> <i class="fa fa-long-arrow-alt-right">&nbsp;</i>
        </a>       
      </div>
       <?php } ?>
       
    </div>
  </div>
</section>
<?php

$output = ob_get_contents();
ob_end_clean();
echo ppt_theme_block_output($output, $df, array("text", "text124"));
	
	}
		public static function css(){
		ob_start();
		?>
<style>
 
.text124-card figure{margin:0}
.text124-card img{transition:all linear .25s}
.text124-card{background-color:#fff;box-shadow:0 0 25px rgba(0,0,0,.1);background-position:center;overflow:hidden;position:relative; transition:all linear .25s; width: 100%; border-radius: 10px; height:320px; min-width:200px;  }
.text124-card h4{ z-index: 2; position:absolute;font-size:25px;font-weight:700;color:#fff;transition:all linear .25s;text-shadow:0 0 20px rgba(0,0,0,.5)}
.text124-card h4 strong { font-weight:600; } 
 
.text124-card.style3 h4{left:0;bottom:20px;text-align:center;width:100%;font-size:30px;color:#fff; line-height:35px; }
.text124-card.style3 h4 span{font-size:13px;display:block}.text124-card.style3:hover img{filter:grayscale(100%)}
.text124-card.style3:hover h4{bottom:30px}   

 </style>
<?php	
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;
		}	
		public static function js(){
		return "";
		ob_start();
		?>
<?php	
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;
		}	
}

?>