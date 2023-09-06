<?php
 
add_filter( 'ppt_blocks_args', 	array('block_listings6',  'data') );
add_action( 'listings6',  		array('block_listings6', 'output' ) );
//add_action( 'listings6-css',  	array('block_listings6', 'css' ) );
//add_action( 'listings6-js',  	array('block_listings6', 'js' ) );

class block_listings6 {

	function __construct(){}		

	public static function data($a){ global $CORE;  
  
		$a['listings6'] = array(
			"name" 	=> "Big List Fixed",
			"image"	=> "listings6.jpg",
			"cat"	=> "listings",
			"order" => 6,
			"desc" 	=> "", 
			"data" 	=> array( ),	
			
			"defaults" => array(
							
		 
				/* listings6 */    
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
				"subtitle_margin"  => "mb-4",     
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
	
	  
		// ADD ON SYSTEM DEFAULTS
		$settings = $CORE->LAYOUT("get_block_settings_defaults", array("listings6", "listings", $settings ) ); 
		 
 
		// UPDATE DATA FROM ELEMENTOR OR CHILD THEMES
		if(is_array($new_settings)){
			 foreach($settings as $h => $j){
				if(isset($new_settings[$h]) && $new_settings[$h] != ""){
					$settings[$h] = $new_settings[$h];
				}
			 }
		}else{
		
		$settings['datastring'] = "orderby='rand'";
		}
		
		
		 
 
	ob_start();
	  
	 
	?><section class="<?php echo $settings['section_class']." ".$settings['section_bg']." ".$settings['section_padding']." ".$settings['section_divider']; ?>">
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
	 echo str_replace("favsIcon","favsIcon noFavs", str_replace("col-12","col-4",str_replace("row", "row no-gutters", str_replace("card-ppt-search", "card-ppt-search fixed", do_shortcode('[LISTINGS nav=0 card_class="col-4 col-lg-3"  '.$settings['datastring'].' ]'))))); 
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