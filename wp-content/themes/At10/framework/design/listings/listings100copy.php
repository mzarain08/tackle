<?php
 
add_filter( 'ppt_blocks_args', 	array('block_listings100copy',  'data') );
add_action( 'listings100copy',  		array('block_listings100copy', 'output' ) );
add_action( 'listings100copy-css',  		array('block_listings100copy', 'css' ) );
add_action( 'listings100copy-js',  		array('block_listings100copy', 'js' ) );

class block_listings100copy {

	function __construct(){}		

	public static function data($a){ global $CORE; 
  
		$a['listings100copy'] = array(
			"name" 	=> "+ Title (Copy)",
			"image"	=> "listings100copy.jpg",
			"cat"	=> "listings",
			"order" => 100,
			"desc" 	=> "", 
			"copy" 	=> "1", 
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
		"btn_txt" => $CORE->LAYOUT("get_placeholder_text_new", array("short", "more" ) ),
		"title" => $CORE->LAYOUT("get_placeholder_text_new", array("short", "featured_listings" ) ),
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
			 
		 	$settings =   $CORE->LAYOUT("get_block_settings_defaults_new", array("listings", "listings100copy"  ) );
		 
		 	foreach($df as $h => $j){
				if(isset($settings[$h]) && $settings[$h] != ""){
					$df[$h] = $settings[$h];
				}
			 } 
		}
		 
		
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
	 
 
$data = do_shortcode('[LISTINGS nav=0 small=1 show="'.$df['show'].'" order="'.$df['order'].'" custom="'.$df['custom'].'" orderby="'.$df['orderby'].'" card="'.$df['card'].'" perrow="'.$df['perrow'].'"  ]');		
 
	ob_start();
	
	?>

<section class="section-60">
  <div class="container">
    <div class="row">
    <?php if(strlen($df['title']) > 0){ ?>
      <div class="col-lg-12">
        <div class="d-flex justify-content-between">
          <h2 class="mb-5" data-ppt-title><?php echo $df['title']; ?></h2>
          <div>
            <?php if($df['btn_show']){ ?>
            <a href="<?php echo home_url(); ?>/?s=" data-ppt-btn data-ppt-btn-link class="btn-system"><?php echo $df['btn_txt']; ?></a>
            <?php } ?>
          </div>
        </div>
      </div>
      <?php } ?>
      <div class="col-12">
        %data%
      </div>
    </div>
  </div>
</section>
<?php
		$output = ob_get_contents();
		ob_end_clean();
echo str_replace("%data%", $data,ppt_theme_block_output($output, $df, array("listings", "listings100copy")));
	
	}
	
		public static function js(){
		return "";
		}	
		 
		public static function css(){
		return "";
		 }	
		 
}

?>