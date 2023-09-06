<?php
 
add_filter( 'ppt_blocks_args', 	array('block_block_listings_small',  'data') );
add_action( 'block_listings_small',  		array('block_block_listings_small', 'output' ) );
//add_action( 'block_listings_small-css',  	array('block_block_listings_small', 'css' ) );
//add_action( 'block_listings_small-js',  	array('block_block_listings_small', 'js' ) );

class block_block_listings_small {

	function __construct(){}		

	public static function data($a){ global $CORE;  
  
		$a['block_listings_small'] = array(
			"name" 	=> "Listings Block (small)",
			"image"	=> "block_listings_small.jpg",
			"cat"	=> "block",
			"order" => 1,
			"desc" 	=> "", 
			"data" 	=> array( ),	
			
			"defaults" => array( ),
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $new_settings, $settings;
	
	
		$settings = array( 
					
				"datastring" => "custom=new&show=4",
				 
		 );  
	 
		// ADD ON SYSTEM DEFAULTS
		$settings = $CORE->LAYOUT("get_block_settings_defaults", array("block_listings_small", "block", $settings ) ); 
 
		// UPDATE DATA FROM ELEMENTOR OR CHILD THEMES
		if(is_array($new_settings)){
			 foreach($settings as $h => $j){
				if(isset($new_settings[$h]) && $new_settings[$h] != ""){
					$settings[$h] = $new_settings[$h];
				}
			 }
		}
		if(isset($new_settings['limit']) && is_numeric($new_settings['limit'])){
		$settings['datastring'] = ' show="'.$new_settings['limit'].'" ';
		}else{
		$settings['datastring'] = ' show="4" ';
		}
		
	 
 
	ob_start();
 	 
	?> 
    <?php
	 
	if(in_array($settings['card'], array("list" ) )){
	
	echo do_shortcode('[LISTINGS nav=0 card_class="col-12 col-lg-6" '.$settings['datastring'].' ]');
	
	}elseif(in_array($settings['card'], array("list-small" ) )){
	
	echo do_shortcode('[LISTINGS nav=0 card_class="col-12 col-md-6" '.$settings['datastring'].' ]');
	
	}else{
	
	echo do_shortcode('[LISTINGS nav=0 small=1  '.$settings['datastring'].' ]');
	
	}
	
	
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