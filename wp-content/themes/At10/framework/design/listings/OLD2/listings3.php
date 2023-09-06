<?php
 
add_filter( 'ppt_blocks_args', 	array('block_listings3',  'data') );
add_action( 'listings3',  		array('block_listings3', 'output' ) );
add_action( 'listings3-css',  	array('block_listings3', 'css' ) );
add_action( 'listings3-js',  	array('block_listings3', 'js' ) );

class block_listings3 {

	function __construct(){}		

	public static function data($a){ global $CORE;  
  
		$a['listings3'] = array(
			"name" 	=> "1x Featured + Carousel",
			"image"	=> "listings3.jpg",
			"cat"	=> "listings",
			"order" 	=> 3,
			"desc" 	=> "", 
			"data" 	=> array( ),	

			"defaults" => array(
			 
				/* listings3 */    
				"section_padding"  => "section-60",     
				"section_bg"  => "bg-white",     
				"section_pos"  => "",     
				"section_w"  => "container",     
				"section_pattern"  => "",     
				"title_show"  => "yes",     
				"title"  => "Newly Added",     
				"subtitle"  => "Take a look at some of our latest items.",     
				"desc"  => " ",     
				"title_style"  => "1",     
				"title_pos"  => "left",     
				"title_heading"  => "h2",     
				"title_margin"  => "mb-2",     
				"subtitle_margin"  => "mb-0",     
				"desc_margin"  => "mb-0",     
				"title_txtcolor"  => "dark",     
				"subtitle_txtcolor"  => "primary",     
				"desc_txtcolor"  => "opacity-5",     
				"title_font"  => "",     
				"subtitle_font"  => "",     
				"desc_font"  => "",     
				"title_txtw"  => "font-weight-bold",     
				"subtitle_txtw"  => "font-weight-bold",     
				"datastring"  => " dataonly='1' cat='' card='info' perrow='' show='' custom='new' customvalue='' order='desc' orderby='date' debug='0' ",     
				"perrow"  => "",     
				"card"  => "info",     
				"limit"  => "",     
				"custom"  => "new", 		
			
			),			
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $new_settings, $settings;
	
	
		$settings = array( "datastring" => "custom=new num=5" );  
	 
	   // ADD ON SYSTEM DEFAULTS
		$settings = $CORE->LAYOUT("get_block_settings_defaults", array("listings3", "listings", $settings ) );
 		 
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
	
	
	// GET FEATURED
	$featured = do_shortcode('[LISTINGS dataonly=1 nav=0  custom="featured"  show=1 card_class="col-12" connected=1 ]');
	
	// NEW LISTINGS
	$data  = str_replace("data-srcxx","srcxx", do_shortcode('[LISTINGS dataonly=1 nav=0 small=1 carousel=1 '.$settings['datastring'].'  connected=1 ]'));
	
	if(strlen($data) < 10){
		$data =  str_replace(".00","", do_shortcode('[LISTINGS dataonly=1 nav=0 orderby=rand small=1 carousel=1 custom=new  connected=1 ]')); 
	} 	
	 
	?>
    
    <section class="<?php echo $settings['section_class']." ".$settings['section_bg']." ".$settings['section_padding']." ".$settings['section_divider']; ?>">
   <div class="container">
   <div class="row">
          
     
    <?php if($settings['title_show'] == "yes"){ ?>
    <div class="col-12">
      <?php _ppt_template( 'framework/design/parts/title' ); ?>
    </div>
    <?php } ?>    
 
    <div class="col-md-3 d-none d-lg-block">   
    <?php echo $featured;  ?>
    </div>
    
    <div class="col-md-9 overflow-hidden"> 
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