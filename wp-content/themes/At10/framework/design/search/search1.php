<?php
 
add_filter( 'ppt_blocks_args',  	array('block_search1',  'data') );
add_action( 'search1',  	array('block_search1', 'output' ) );
add_action( 'search1-css',  array('block_search1', 'css' ) );
add_action( 'search1-js',  	array('block_search1', 'js' ) );

class block_search1 {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['search1'] = array(
			"name" 	=> "Search Inline",
			"image"	=> "search1.jpg",
			"cat"	=> "search",
			
			"widget" => "ppt-search",
			
			"desc" 	=> "", 
			"data" 	=> array( ),
			
			// HIDE VALUES
			"hide-title" 	=> true,
		);		
		
		return $a;
	
	} public static function output(){ global $CORE_UI, $CORE, $settings, $search_settings, $userdata;
	
	
		// ALL DEFAULT FIELDS
		 $df = ppt_theme_blocks_defaults("search"); 
		  
		// APPLY CUSTOM CHANGES 
		$cc = array(
		"tax" 		=> "listing",
		"btn_show" => 1,
		"section_padding" => "section-40",
		 );
		 

		$df = array_merge($df, $cc);
		
		
		// 1. ELEMENTOR
		if(!empty($search_settings)){
			foreach($df as $k => $v){				
				if(isset($search_settings[$k]) && $search_settings[$k] != "" ){
					$df[$k] = $search_settings[$k];
				}
			}
			
		// 2. HOME DESIGNS		
		}else{	
			 
		 	$settings =  $CORE->LAYOUT("get_block_settings_defaults_new", array("search", "search1" ) );
		 	foreach($df as $h => $j){
				if(isset($settings[$h]) && $settings[$h] != ""){
					$df[$h] = $settings[$h];
				}
			 } 
		}
		   



///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

ob_start();
?> 

<section class="hide-mobile">
<div class="container"> 
<?php echo _ppt_template( 'search/search-filters1' );   ?>
</div>
</section><?php
$output = ob_get_contents();
ob_end_clean();
		
echo ppt_theme_block_output($output, $df, array("search", "search1"));
	
	}
	public static function js(){ global $CORE;
 
		ob_start();
 
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;
		 
	
	}		
	public static function css(){ global $CORE;
	
	 return "";
		ob_start();
		 
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;	
	
	}	
	
}

?>