<?php
 
add_filter( 'ppt_blocks_args', 	array('block_listings2',  'data') );
add_action( 'listings2',  		array('block_listings2', 'output' ) );
//add_action( 'listings2-css',  	array('block_listings2', 'css' ) );
//add_action( 'listings2-js',  	array('block_listings2', 'js' ) );

class block_listings2 {

	function __construct(){}		

	public static function data($a){ global $CORE;  
  
		$a['listings2'] = array(
			"name" 	=> "Big List",
			"image"	=> "listings2.jpg",
			"cat"	=> "listings",
			"order" => 3,
			"desc" 	=> "", 
			"data" 	=> array( ),	
			
			"defaults" => array(
							
		 
				/* listings2 */    
				"section_padding"  => "section-60",     
				"section_bg"  => "bg-white",     
				"section_pos"  => "",     
				"section_w"  => "container",     
				"section_pattern"  => "",     
				"title_show"  => "yes",     
				"title"  => "Newly <span class='text-primary'>Added</span>",     
				"subtitle"  => "",     
				"desc"  => " ",     
				"title_style"  => "1",     
				"title_pos"  => "left",     
				"title_heading"  => "h2",     
				"title_margin"  => "mb-5",     
				"subtitle_margin"  => "mb-4",     
				"desc_margin"  => "mb-0",     
				"title_txtcolor"  => "dark",     
				"subtitle_txtcolor"  => "primary",     
				"desc_txtcolor"  => "opacity-5",     
				"title_font"  => "",     
				"subtitle_font"  => "",     
				"desc_font"  => "",     
				"title_txtw"  => "text-700",     
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
		$settings = $CORE->LAYOUT("get_block_settings_defaults", array("listings2", "listings", $settings ) ); 
 
		// UPDATE DATA FROM ELEMENTOR OR CHILD THEMES
		if(is_array($new_settings)){
			 foreach($settings as $h => $j){
				if(isset($new_settings[$h]) && $new_settings[$h] != ""){
					$settings[$h] = $new_settings[$h];
				}
			 }
		}else{		
			$default_data = $CORE->LAYOUT("get_block_defaults", "listings2");
			foreach($default_data as $h => $j){				 
					$settings[$h] = $j;
			}			  
		}
		 
 
	ob_start();
 	 
	?> 
    <section class="<?php echo $settings['section_class']." ".$settings['section_bg']." ".$settings['section_padding']." ".$settings['section_divider']; ?>">
<div class="container">
<div class="row">
  <?php if($settings['title_show'] == "yes"){ ?>
  <div class="col-12">
    <?php _ppt_template( 'framework/design/parts/title' ); ?>
  </div>
  <?php } ?>
  <div class="col-12">
    <div class="clearfix"></div>
    <?php
	 
	if(in_array($settings['card'], array("list" ) )){
	
	echo do_shortcode('[LISTINGS nav=0 card_class="col-12" '.$settings['datastring'].' ]');
 	
	}else{
	
	echo do_shortcode('[LISTINGS nav=0 small=1  '.$settings['datastring'].' ]');
	
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