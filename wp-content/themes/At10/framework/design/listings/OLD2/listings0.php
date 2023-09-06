<?php
 
add_filter( 'ppt_blocks_args', 	array('block_listings0',  'data') );
add_action( 'listings0',  		array('block_listings0', 'output' ) );
//add_action( 'listings0-css',  		array('block_listings0', 'css' ) );
//add_action( 'listings0-js',  		array('block_listings0', 'js' ) );

class block_listings0 {

	function __construct(){}		

	public static function data($a){ global $CORE; 
  
		$a['listings0'] = array(
			"name" 	=> "Row of Listings",
			"image"	=> "listings0.jpg",
			"cat"	=> "listings",
			"order" => 0,
			"desc" 	=> "", 
			"data" 	=> array( ),	
			
			"defaults" => array(
					
 
					/* listings0 */    
					"section_padding"  => "section-60",     
					"section_bg"  => "bg-white",     
					"section_pos"  => "",     
					"section_w"  => "container",     
					"section_pattern"  => "",     
					"title_show"  => "yes",     
					"title"  => "Featured <span class='text-primary'>Listings</span>",     
					"subtitle"  => "",     
					"desc"  => " ",     
					"title_style"  => "1",     
					"title_pos"  => "left",     
					"title_heading"  => "h3",     
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
				"datastring" => "custom=new num=12",
		 );  
	 
		// ADD ON SYSTEM DEFAULTS
		$settings = $CORE->LAYOUT("get_block_settings_defaults", array("listings0", "listings", $settings ) ); 

		// UPDATE DATA FROM ELEMENTOR OR CHILD THEMES
		if(is_array($new_settings)){
			 foreach($settings as $h => $j){
				if(isset($new_settings[$h]) && $new_settings[$h] != ""){
					$settings[$h] = $new_settings[$h];
				}
			 }
		}else{
		
			$default_data = $CORE->LAYOUT("get_block_defaults", "listings0");
			foreach($default_data as $h => $j){				 
					$settings[$h] = $j;
			 }
			  
		}
		
		
		if(isset($new_settings['limit']) && is_numeric($new_settings['limit'])){
		$settings['datastring'] = ' show="'.$new_settings['limit'].'" ';
		}else{
		$settings['datastring'] = ' show="4" ';
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
      
    <?php
	 
	if(in_array($settings['card'], array("list" ) )){
	
	echo do_shortcode('[LISTINGS nav=0 card_class="col-12 col-lg-6" '.$settings['datastring'].' ]');
 	
	}else{
	
	echo do_shortcode('[LISTINGS nav=0 small=1  '.$settings['datastring'].' ]');
	
	}
	
	
	  ?> 
          
          
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