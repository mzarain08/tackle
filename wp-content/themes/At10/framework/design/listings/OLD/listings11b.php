<?php
 
add_filter( 'ppt_blocks_args', 	array('block_listings11b',  'data') );
add_action( 'listings11b',  		array('block_listings11b', 'output' ) );
add_action( 'listings11b-css',  	array('block_listings11b', 'css' ) );
add_action( 'listings11b-js',  	array('block_listings11b', 'js' ) );

class block_listings11b {

	function __construct(){}		

	public static function data($a){ global $CORE;  
  
		$a['listings11b'] = array(
			"name" 	=> "Split Carousel - Style 2",
			"image"	=> "listings11b.jpg",
			"cat"	=> "listings",
			"order" 	=> 2.1,
			"desc" 	=> "", 
			"data" 	=> array( ),			
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $new_settings, $settings;
	
	
		$settings = array( "datastring" => "custom=new num=5" );  
	 
	   // ADD ON SYSTEM DEFAULTS
		$settings = $CORE->LAYOUT("get_block_settings_defaults", array("listings11b", "listings", $settings ) );
 		 
		// UPDATE DATA FROM ELEMENTOR OR CHILD THEMES
		if(is_array($new_settings)){
			 foreach($settings as $h => $j){
				if(isset($new_settings[$h]) && $new_settings[$h] != ""){
					$settings[$h] = $new_settings[$h];
				}
			 }
		} 	
	ob_start();
	
	$randomID = rand(0,9999);
	
 	
	$data  = str_replace("data-srcxx","srcxx", do_shortcode('[LISTINGS dataonly=1 nav=0 small=1 carousel=1 '.$settings['datastring'].' ]'));
	
	if(strlen($data) < 10){
			$data =  str_replace(".00","", do_shortcode('[LISTINGS dataonly=1 nav=0 orderby=rand small=1 carousel=1 custom=new ]')); 
	} 
	
	 
	?><section class="<?php echo $settings['section_class']." ".$settings['section_bg']." ".$settings['section_padding']." ".$settings['section_divider']; ?>" id="listings11b<?php echo $randomID; ?>">
   <div class="container">
   <div class="row"> 
 
    <div class="col-md-3 d-none d-lg-block">
    
    <div class="block-header"><h3 class="block-header__title"><?php echo __("New","premiumpress"); ?></h3><div class="block-header__divider"></div></div>
    
    <?php 
	$settings['card'] = "blank";
	
	echo do_shortcode('[LISTINGS dataonly=1 nav=0  custom="new"  show=1 card_class="col-12" ]');  ?>  
    </div>
    
    <div class="col-md-9 overflow-hidden">
     
  <div class="block-header"><h3 class="block-header__title"><?php echo __("Featured","premiumpress"); ?></h3><div class="block-header__divider"></div></div>
  
 
 <div  class="owl-carousel owl-theme" data-1000="3" data-600="2" data-1200="3"> <?php echo  $data;  ?> </div> 
   
    </div>   
         
      </div>
   </div>
</section>
 
<?php
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;	
	
	}
		public static function css(){
		ob_start();
		?>
<style>
.block-header{display:-ms-flexbox;display:flex;-ms-flex-align:center;align-items:center;margin-bottom:24px; font-size:28px;font-weight:700; }
.block-header__title{margin-bottom:0;font-size:20px;}
.block-header__divider{-ms-flex-positive:1;flex-grow:1;height:2px;background:#ebebeb;}
.block-header__title+.block-header__divider{margin-left:16px;}
@media (max-width:767px){
.block-header{display:-ms-flexbox;display:flex;-ms-flex-wrap:wrap;flex-wrap:wrap;}
}
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