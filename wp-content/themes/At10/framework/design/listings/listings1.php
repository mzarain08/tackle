<?php
 
add_filter( 'ppt_blocks_args', 	array('block_listings1',  'data') );
add_action( 'listings1',  		array('block_listings1', 'output' ) );
add_action( 'listings1-css',  		array('block_listings1', 'css' ) );
add_action( 'listings1-js',  		array('block_listings1', 'js' ) );

class block_listings1 {

	function __construct(){}		

	public static function data($a){ global $CORE; 
  
		$a['listings1'] = array(
			"name" 	=> "Unstyled Block (4)",
			"image"	=> "listings1.jpg",
			"cat"	=> "listings",
			"order" => 1,
			"desc" 	=> "", 
			"widget"	=> "ppt-listings",
			"data" 	=> array( ), 
			"defaults" => array( ), 
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $listing_settings, $df; 
	
	
		// ALL DEFAULT FIELDS
		 $df = ppt_theme_blocks_defaults("listings"); 
		  
		// APPLY CUSTOM CHANGES 
		$cc = array(
		"tax" 		=> "listing",
		"btn_show" => 1,
		 );
		 

		$df = array_merge($df, $cc);
		
		
		// 1. ELEMENTOR
		if(!empty($listing_settings)){
			foreach($df as $k => $v){				
				if(isset($listing_settings[$k]) && $listing_settings[$k] != "" ){
					$df[$k] = $listing_settings[$k];
				}
			}
			
		// 2. HOME DESIGNS		
		}else{	
			 
		 	$df =  $CORE->LAYOUT("get_block_settings_defaults_new", array("listings", "listings1"  ) );
		 	foreach($df as $h => $j){
				if(isset($df[$h]) && $df[$h] != ""){
					$df[$h] = $df[$h];
				}
			 } 
		}
		
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
	 

if(isset($df['perrow']) && $df['perrow'] =="" || !isset($df['perrow'])){
$df['perrow'] = 4;
$df['show'] = 4;
}


$data = do_shortcode('[LISTINGS nav=0 small=1 show="'.$df['show'].'"  order="'.$df['order'].'" custom="'.$df['custom'].'" orderby="'.$df['orderby'].'" card="'.$df['card'].'" perrow="'.$df['perrow'].'"  ]');	

if($df['show'] < 5){
$data = str_replace("mb-4","",$data);
}

 
ob_start(); ?>
<section class="section-20"><div class="container">%data%</div></section>
<?php $output = ob_get_contents();
ob_end_clean();
echo str_replace("%data%", $data, ppt_theme_block_output($output,$df, array("listings", "listings1")));
	
	}
	
		public static function js(){
		return "";
		}	
		 
		public static function css(){
		return "";
		 }	
}

?>