<?php
 
add_filter( 'ppt_blocks_args', 	array('block_listings2d',  'data') );
add_action( 'listings2d',  		array('block_listings2d', 'output' ) );
//add_action( 'listings2d-css',  	array('block_listings2d', 'css' ) );
//add_action( 'listings2d-js',  	array('block_listings2d', 'js' ) );

class block_listings2d {

	function __construct(){}		

	public static function data($a){ global $CORE;  
  
		$a['listings2d'] = array(
			"name" 	=> "Big List - Style 2",
			"image"	=> "listings2d.jpg",
			"cat"	=> "listings",
			"order" => 3,
			"desc" 	=> "", 
			"data" 	=> array( ),	
			
			"defaults" => array(
							
		 
				/* listings2d */    
				"section_padding"  => "section-top-60",     
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
					
				"datastring" => "custom=new",
				 
		 );  
	 
		// ADD ON SYSTEM DEFAULTS
		$settings = $CORE->LAYOUT("get_block_settings_defaults", array("listings2d", "listings", $settings ) ); 
 
		// UPDATE DATA FROM ELEMENTOR OR CHILD THEMES
		if(is_array($new_settings)){
			 foreach($settings as $h => $j){
				if(isset($new_settings[$h]) && $new_settings[$h] != ""){
					$settings[$h] = $new_settings[$h];
				}
			 }
		} 
		 
 
	ob_start();
	  
	 
	?><section class="<?php echo $settings['section_class']." ".$settings['section_bg']." ".$settings['section_padding']." ".$settings['section_divider']; ?>">
<div class="container">
<div class="row">
 
  <div class="col-12">
  
  
        <?php if($settings['title_show'] == "yes"){ ?>
       <div class="block-header"><h3 class="block-header__title"><?php if(strlen($settings['title']) > 1){ echo $settings['title']; }else{ echo __("Newly Added","premiumpress"); } ?></h3><div class="block-header__divider"></div></div>
       <?php } ?>
       
    <div class="clearfix"></div>
    <?php
	 
	if(in_array($settings['card'], array("list" ) )){
	
	echo do_shortcode('[LISTINGS nav=0 card_class="col-12 col-md-12" '.$settings['datastring'].' ]');
	
	}elseif(in_array($settings['card'], array("list-small" ) )){
	
	echo do_shortcode('[LISTINGS nav=0 '.$settings['datastring'].' ]');
	
	}else{
	echo do_shortcode('[LISTINGS nav=0 small=1 '.$settings['datastring'].' ]');
	}
	
	
	  ?> </div>
</div>
</section>
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