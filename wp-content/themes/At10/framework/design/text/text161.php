<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text161',  'data') );
add_action( 'text161',  		array('block_text161', 'output' ) );
add_action( 'text161-css',  	array('block_text161', 'css' ) );
add_action( 'text161-js',  	array('block_text161', 'js' ) );

class block_text161 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text161'] = array(
			"name" 		=> "Style 161",
			"image"		=> "text161.jpg",
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
		 
		 $imga = "";
		 if(isset($_SESSION['design_preview'])){
			$imga = "&ct=".$_SESSION['design_preview'];
		}
	 
		 $cc = array(
		 	"image1" => DEMO_IMGS."?fw=text160&i=1&t=".THEME_KEY."&cp=".$imga,
			"image2" => DEMO_IMGS."?fw=text160&i=2&t=".THEME_KEY."&cp=".$imga,
			"image3" => DEMO_IMGS."?fw=text160&i=3&t=".THEME_KEY."&cp=".$imga,
			"image4" => DEMO_IMGS."?fw=text160&i=4&t=".THEME_KEY."&cp=".$imga,
			"image5" => DEMO_IMGS."?fw=text160&i=5&t=".THEME_KEY."&cp=".$imga,
			"image6" => DEMO_IMGS."?fw=text160&i=6&t=".THEME_KEY."&cp=".$imga,
			"image7" => DEMO_IMGS."?fw=text160&i=7&t=".THEME_KEY."&cp=".$imga,
			"image8" => DEMO_IMGS."?fw=text160&i=8&t=".THEME_KEY."&cp=".$imga,
			"image9" => DEMO_IMGS."?fw=text160&i=9&t=".THEME_KEY."&cp=".$imga,
			"image10" => DEMO_IMGS."?fw=text160&i=10&t=".THEME_KEY."&cp=".$imga,
			
			
			"image9" => DEMO_IMGS."?fw=text160&i=9&t=".THEME_KEY."&cp=".$imga,
			
			"image1-txt" => $CORE->LAYOUT("get_placeholder_text_new", array("text124a", "t" ) ),
			"image2-txt" => $CORE->LAYOUT("get_placeholder_text_new", array("text124b", "t" ) ),
			"image3-txt" => $CORE->LAYOUT("get_placeholder_text_new", array("text124c", "t" ) ),
			"image4-txt" => $CORE->LAYOUT("get_placeholder_text_new", array("text124d", "t" ) ),
			"image5-txt" => $CORE->LAYOUT("get_placeholder_text_new", array("text124e", "t" ) ),
			"image6-txt" => $CORE->LAYOUT("get_placeholder_text_new", array("text124f", "t" ) ),
			"image7-txt" => $CORE->LAYOUT("get_placeholder_text_new", array("text124f", "t" ) ),
			"image8-txt" => $CORE->LAYOUT("get_placeholder_text_new", array("text124f", "t" ) ),
			"image9-txt" => $CORE->LAYOUT("get_placeholder_text_new", array("text124f", "t" ) ),
			"image10-txt" => $CORE->LAYOUT("get_placeholder_text_new", array("text124f", "t" ) ),
			"image11-txt" => $CORE->LAYOUT("get_placeholder_text_new", array("text124f", "t" ) ),
			
			"image1-txt1" => "Pellentesque nec lacus elit.",
			"image2-txt1" => "Pellentesque nec lacus elit.",
			"image3-txt1" => "Pellentesque nec lacus elit.",
			"image4-txt1" => "Pellentesque nec lacus elit.",
			"image5-txt1" => "Pellentesque nec lacus elit.",
			"image6-txt1" => "Pellentesque nec lacus elit.",
			"image7-txt1" => "Pellentesque nec lacus elit.",
			"image8-txt1" => "Pellentesque nec lacus elit.",
			"image9-txt1" => "Pellentesque nec lacus elit.",
			"image10-txt1" => "Pellentesque nec lacus elit.",
					
			"btn1" => 1,
			"btn2" => 0, 
			
			"title" => $CORE->LAYOUT("get_placeholder_text_new", array("short", "pop" ) ),
			
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
			 
		 	$settings =  $CORE->LAYOUT("get_block_settings_defaults_new", array("text", "text161" ) );
		 	foreach($df as $h => $j){
				if(isset($settings[$h]) && $settings[$h] != ""){
					$df[$h] = $settings[$h];
				}
			 } 
		}
		  
 
	ob_start();
	
	
	$data = array();
	$i=1; while($i < 11){
	
			$link = home_url()."/?s=";
			
			if(THEME_KEY == "cp"){
			
			$link = _ppt(array('links','stores'));
			}
		
			$data[] = array( 
				"image" => $df['image'.$i],				 
				"name"	=> $df['image'.$i.'-txt'],
				"desc"	=> $df['image'.$i.'-txt1'],
				"css"	=> "ppt-h350",
				"link"	=> $link, 
			); 
	
	$i++;
	}
 
	
	?>

<section class="section-60">
<div class="container">
<div class="row">

<div class="col-12">
  <h2 class="mb-4" data-ppt-title><?php echo $df['title']; ?></h2>
  <div data-ppt-subtitle> </div>
</div>
<div class="col-12">
  <div class="row">
    <?php $i=1; foreach($data as $cat){ ?>
    <div class="mb-4 col-6 col-md-3 col-md-5ths">
      <div class="p-3" ppt-border1>
        <a href="<?php echo $cat['link']; ?>" data-ppt-image<?php echo $i; ?>-link><img src="<?php echo $cat['image']; ?>" data-ppt-image<?php echo $i; ?> class="img-fluid" /></a>
      </div>
    </div>
    <?php $i++; } ?>
  </div>
</div>
</div>
</section>
<?php

$output = ob_get_contents();
ob_end_clean();
echo ppt_theme_block_output($output, $df, array("text", "text161"));
	
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
		?>
<?php	
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;
		}	
}

?>