<?php
 
add_filter( 'ppt_blocks_args', 	array('block_listings101',  'data') );
add_action( 'listings101',  		array('block_listings101', 'output' ) );
add_action( 'listings101-css',  		array('block_listings101', 'css' ) );
add_action( 'listings101-js',  		array('block_listings101', 'js' ) );

class block_listings101 {

	function __construct(){}		

	public static function data($a){ global $CORE; 
  
		$a['listings101'] = array(
			"name" 	=> "Style 101",
			"image"	=> "listings101.jpg",
			"cat"	=> "listings",
			"order" => 101,
			"desc" 	=> "", 
			"widget"	=> "ppt-listings",
			"data" 	=> array( ),	
			
			"defaults" => array( ),
			
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $listing_settings, $settings; 
	
		 $settings =  $CORE->LAYOUT("get_block_settings_defaults_new", array("listings", "listings101" ) );
		  
		 $df = array(
		 	"image1" => DEMO_IMGS."?fw=listings101a&t=".THEME_KEY,
			"image2" => DEMO_IMGS."?fw=listings101b&t=".THEME_KEY,
			
			"btn1" => 0,
			"btn2" => 0,		 
		 );
		
		 if(is_array($listing_settings) && !empty($listing_settings)){
		
			 foreach($settings as $h => $j){
				if(isset($listing_settings[$h]) && $listing_settings[$h] != ""){
					$settings[$h] = $listing_settings[$h];
				}
			 }			 
		}
		
		
		if(strlen($settings['image1']) > 1){
			 $df['image1'] = $settings['image1'];			
		}
		if(strlen($settings['image2']) > 1){
			 $df['image2'] = $settings['image2'];			
		}
		if($settings['perrow'] == ""){ $settings['perrow'] = 3; }
		  
 	 
$data = do_shortcode('[LISTINGS nav=0 small=1 show="'.$settings['show'].'" order="'.$settings['order'].'" custom="'.$settings['custom'].'" orderby="'.$settings['orderby'].'" card="'.$settings['card'].'" perrow="'.$settings['perrow'].'"  ]');		
 
 
	ob_start(); 
	?>
<section class="section-60">
  <div class="container">
    <div class="row d-flex flex-row-reverse">
      <div class="col-md-4 hide-mobile">
      
      
<a href="<?php echo home_url(); ?>/?s=" data-ppt-image1-link>
       
<div class="grid rounded overflow-hidden position-relative mb-4"> 

<figure class="effect-2 textpos-bleft">
	<img src="<?php echo $df['image1']; ?>" alt="img" data-ppt-image1>
    <figcaption>
    <div class="wrapper">
        <div class="caption">
        	
            <h4 class="text-light mb-4" data-ppt-image1-txt1><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("short", "search" ) ); ?></h4>
        
            <div class="btn btn-secondary btn-rounded-25 text-600" data-ppt-image1-txt><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "start_search" ) ); ?></div>
            
            	
        </div>
    </div>
    </figcaption>
</figure>

</div>
</a>


        
<a href="<?php echo wp_registration_url(); ?>" data-ppt-image2-link>
        
<div class="grid rounded overflow-hidden mb-4"> 
 
<figure class="effect-2 textpos-ccenter">


	<img src="<?php echo $df['image2']; ?>" alt="img" data-ppt-image2>
    <figcaption>
    <div class="wrapper">
        <div class="caption">
        
            <div class="title text-white font-weight-bold textsize-xl text-uppercase text-shadow-1" data-ppt-image2-txt><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "join_now" ) ); ?></div>
            
             <div class="btn btn-system btn-rounded-25 btn-lg mt-4 text-600" data-ppt-image1-txt><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "register" ) ); ?></div>
           
            	
        </div>
    </div>
    </figcaption>
</figure>

</div>
</a>
        
        
   
      </div>
      <div class="col-md-8">
        %data%
      </div>
    </div>
  </div>
</section>


<?php
$output = ob_get_contents();
ob_end_clean();
echo str_replace("%data%", $data,ppt_theme_block_output($output, $listing_settings, array("listings", "listings101")));
	
	}
	
		public static function js(){
		return "";
		}	
		 
		public static function css(){
		return "";
		ob_start();
		?>
<style>

figure.effect-2 figcaption::before {
    position: absolute;
    top: 10px;
    right: 10px;
    bottom: 10px;
    left: 10px;
    border: 1px solid #fff;
    content: '';
    -webkit-transition: opacity .35s,-webkit-transform .35s;
    transition: opacity .35s,transform .35s;
}
</style>
<?php	
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;
		}	
  
}

?>