<?php
 
add_filter( 'ppt_blocks_args', 	array('block_listings1b',  'data') );
add_action( 'listings1b',  		array('block_listings1b', 'output' ) );
//add_action( 'listings1b-css',  		array('block_listings1b', 'css' ) );
//add_action( 'listings1b-js',  		array('block_listings1b', 'js' ) );

class block_listings1b {

	function __construct(){}		

	public static function data($a){ global $CORE; 
  
		$a['listings1b'] = array(
			"name" 	=> "Single Carousel - Style 2",
			"image"	=> "listings1b.jpg",
			"cat"	=> "listings",
			"order" => 1.1,
			"desc" 	=> "", 
			"data" 	=> array( ),	
			
			"defaults" => array(
					
 
					/* listings1b */    
					"section_padding"  => "section-top-40",     
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
					"title_heading"  => "h3",     
					"title_margin"  => "mb-2",     
					"subtitle_margin"  => "mb-1",     
					"desc_margin"  => "mb-0",     
					"title_txtcolor"  => "dark",     
					"subtitle_txtcolor"  => "primary",     
					"desc_txtcolor"  => "opacity-5",     
					"title_font"  => "",     
					"subtitle_font"  => "",     
					"desc_font"  => "",     
					"title_txtw"  => "text-800",     
					"subtitle_txtw"  => "text-700",     
					"datastring"  => " dataonly='1' cat='' card='info' perrow='' show='' custom='new' customvalue='' order='desc' orderby='date' debug='0' ",     
					"perrow"  => "",     
					"card"  => "info",     
					"limit"  => "",     
					"custom"  => "new", 		
					 
			),
			
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $new_settings, $settings;
	
	
		$settings = array(
				  
				"datastring" => "custom=new num=12",
				 
		 );  
	 
		// ADD ON SYSTEM DEFAULTS
		$settings = $CORE->LAYOUT("get_block_settings_defaults", array("listings1b", "listings", $settings ) ); 

		// UPDATE DATA FROM ELEMENTOR OR CHILD THEMES
		if(is_array($new_settings)){
			 foreach($settings as $h => $j){
				if(isset($new_settings[$h]) && $new_settings[$h] != ""){
					$settings[$h] = $new_settings[$h];
				}
			 }
		} 
 
	ob_start();
	 
	?>
<section class="<?php echo $settings['section_class']." ".$settings['section_bg']." ".$settings['section_padding']." ".$settings['section_divider']; ?>">
  <div class="container">
    <div class="row">
     
    
     
      <div class="col-12">
      
       <?php if($settings['title_show'] == "yes"){ ?>
       <div class="block-header"><h3 class="block-header__title"><?php if(strlen($settings['title']) > 1){ echo $settings['title']; }else{ echo __("Popular","premiumpress"); } ?></h3><div class="block-header__divider"></div></div>
       <?php } ?>
      
        <div class="clearfix"></div>
        <div class="listing1-carousel-1 owl-carousel owl-theme"> <?php
		
		
		if(isset($_GET['ppt_live_preview'])){
		echo str_replace("data-src","src",do_shortcode('[LISTINGS card="" dataonly=1 nav=0 small=1 carousel=1 '.$settings['datastring'].' ]')); 
		}else{
		echo do_shortcode('[LISTINGS card="" dataonly=1 nav=0 small=1 carousel=1 '.$settings['datastring'].' ]'); 		
		}
		
		  ?> </div>
      </div>
    </div>
  </div>
</section>
 

<?php
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;	
	
	}
	
		public static function js(){
		
		ob_start();
		?>
<?php	
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;
		 }	
}

?>