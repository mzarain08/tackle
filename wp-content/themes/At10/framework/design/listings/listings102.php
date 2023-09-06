<?php
 
add_filter( 'ppt_blocks_args', 	array('block_listings102',  'data') );
add_action( 'listings102',  		array('block_listings102', 'output' ) );
add_action( 'listings102-css',  		array('block_listings102', 'css' ) );
add_action( 'listings102-js',  		array('block_listings102', 'js' ) );

class block_listings102 {

	function __construct(){}		

	public static function data($a){ global $CORE; 
  
		$a['listings102'] = array(
			"name" 	=> "Style 102",
			"image"	=> "listings102.jpg",
			"cat"	=> "listings",
			"order" => 102,
			"desc" 	=> "", 
			"widget"	=> "ppt-listings",
			"data" 	=> array( ),	 
			"defaults" => array( ),
			
			
			"elementor_data" 	=> "listings102.json",
			
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $listing_settings, $settings; 
	
		 $settings =  $CORE->LAYOUT("get_block_settings_defaults_new", array("listings", "listings102" ) );
		  
		 $df = array(
		 	"image1" => DEMO_IMGS."?fw=listings102a&t=".THEME_KEY,
			"image2" => DEMO_IMGS."?fw=listings102b&t=".THEME_KEY,
			
			"btn_show" => 0,
			 		 
		 );
		 	
		 if(is_array($listing_settings) && !empty($listing_settings)){
		
			 foreach($settings as $h => $j){
				if(isset($listing_settings[$h]) && $listing_settings[$h] != ""){
					$settings[$h] = $listing_settings[$h];
				}
			 }	
			 
			 $df['btn_show'] = $listing_settings['btn_show'];		 
		}
		
	 
		if($settings['perrow'] == ""){ $settings['perrow'] = 3; }		
		if($settings['card'] == ""){ $settings['card'] = "list"; }
		if($settings['show'] == ""){ $settings['show'] = "10"; }  
		 
 	 
$data = do_shortcode('[LISTINGS nav=0 small=1 show="'.$settings['show'].'" order="'.$settings['order'].'" custom="'.$settings['custom'].'" orderby="'.$settings['orderby'].'" card="'.$settings['card'].'" perrow="'.$settings['perrow'].'"  ]');		


ob_start();
_ppt_template( 'sidebar' );
$sidebar = ob_get_contents();
ob_end_clean();
 
	ob_start(); 
	?>
<section class="section-60">
  <div class="container">
    <div class="row ">
      <div class="col-md-12 col-lg-3" >
      
        %sidebar%
        
      </div> 
      <div class="col">
        %data%
        
        <?php if($df['btn_show']){ ?>
        <div class="mt-4 text-center">
        
        <a href="<?php echo home_url(); ?>/?s=" class="btn btn-primary text-600 btn-lg"><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "load_more" ) ); ?></a>
        
        </div>
        <?php } ?>
        
      </div>
    </div>
  </div>
</section>
<?php
$output = ob_get_contents();
ob_end_clean();
echo str_replace("%sidebar%",$sidebar,str_replace("%data%", $data,ppt_theme_block_output($output, $listing_settings, array("listings", "listings102"))));
	
	}
	
		public static function js(){
		return "";
		}	
		 
		public static function css(){
		return "";
		 }	
}

?>