<?php
 
add_filter( 'ppt_blocks_args', 	array('block_pricing4',  'data') );
add_action( 'pricing4',  		array('block_pricing4', 'output' ) );
add_action( 'pricing4-css',  	array('block_pricing4', 'css' ) );
add_action( 'pricing4-js',  	array('block_pricing4', 'js' ) );

class block_pricing4 {

	function __construct(){}		

	public static function data($a){ global $CORE;
  
		$a['pricing4'] = array(
			"name" 	=> "Style 4",
			"image"	=> "pricing4.jpg",
			"cat"	=> "pricing",
			"widget" => "ppt-pricing",
			"desc" 	=> "", 
			"data" 	=> array( ),
			"order" => 4,
			"defaults" => array(),
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $new_settings, $userdata, $settings;
	
		
		$settings = array( );  
		 
		// ADD ON SYSTEM DEFAULTS
		$settings = $CORE->LAYOUT("get_block_settings_defaults", array("pricing4", "pricing", $settings ) );
	 
		// UPDATE DATA FROM ELEMENTOR OR CHILD THEMES
		if(is_array($new_settings)){
			 foreach($settings as $h => $j){
				if(isset($new_settings[$h]) && $new_settings[$h] != ""){
					$settings[$h] = $new_settings[$h];
				}
			 }
		}
		
		// BUILD PACKAGE DATA
		$type = "packages";
		if(in_array(THEME_KEY,array("da","es","so"))){
		$type = "memberships";
		}
		if(isset($new_settings['pricing_type']) && strlen($new_settings['pricing_type']) > 1){
		$type = $new_settings['pricing_type'];
		}
		
		// DATA
		$pricing_data = ppt_theme_pricingtable($type);
		  
		
		  
	ob_start();
	
	?>

<section>
  <div class="container">
 
 
<?php
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
if(!empty($pricing_data)){

	$settings['pricing_data'] = $pricing_data;	
	_ppt_template( 'framework/design/pricing/pricing_mobile' );

}
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
?>
  
<div class="row justify-content-md-center hide-mobile">

<?php if(!empty($pricing_data)){
 $i=1; foreach($pricing_data as $pak){ ?>
<div class="col-xl-4 col-md-6">
 
						<div class="price-table-style-2 text-center <?php if($pak['active'] == "1"){?>active<?php } ?>">
	                        <div class="price-text">
	                            <h2> 
                                <span class="<?php if(is_numeric($pak['price']) && $pak['price'] != "0"){ echo $CORE->GEO("price_formatting",array()); } ?>"><?php if($pak['price'] == 0){ echo $pak['price_text']; }else{  echo $pak['price']; } ?></span> 
                                 
                                  
                                  <span class="price-badge"><?php echo $pak['title']; ?></span>
                                  
                                
                                
                                </h2>
	                        </div>
	                        <div class="price-list">
	                            <ul>
	                               <?php if(strlen($pak['desc']) > 1){ ?>
                                   <li class="text-600 mb-2"><?php echo $pak['desc']; ?></li>
								   <?php } ?>
                                   
                                        <?php if(isset($pak['features']) && is_array($pak['features']) && !empty($pak['features']) ){ foreach($pak['features'] as $f){ ?>
                                        
		                                <li><i class="fa <?php if($f['value'] == "1"){?>fa-check<?php }else{ ?>fa-times<?php } ?> mr-2"></i> <?php echo $f['name']; ?></li>
		                                <?php } } ?>
	                            </ul>
	                        </div>
	                         <?php if($pak['button'] == "existing"){ ?>
                                <a class="primary-button opacity-5" href="#"><?php echo __("Current Plan","premiumpress"); ?></a>
                                <?php }else{ ?>
		                        <a class="primary-button" <?php echo $pak['button']; ?>><?php echo __("Select Package","premiumpress"); ?></a>
                                <?php } ?>
	                    </div>
					 
  
</div>

<?php $i++; } } ?> 

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
.price-table-style-2 ul { list-style:none; padding:30px;  }

.price-table-style-2 {position: relative;margin-bottom: 30px;padding-bottom: 40px;background: #fff;-webkit-transition: all 0.25s ease;transition: all 0.25s ease;-webkit-box-shadow: 0 2px 5px -2px rgba(123, 127, 138, 0.15);box-shadow: 0 2px 5px -2px rgba(123, 127, 138, 0.15);}
.price-table-style-2:hover {-webkit-box-shadow: 0 15px 30px 0 rgba(123, 127, 138, 0.30);box-shadow: 0 15px 30px 0 rgba(123, 127, 138, 0.30);-webkit-transform: translateY(-15px) scale(1.05);transform: translateY(-15px) scale(1.05);}
.price-table-style-2 .price-text {width: 50%;margin: 0 auto 30px;background: #eef5ff;}
.price-table-style-2 .price-text h2 {font-size: 50px;padding: 2rem 0;margin-bottom: 0;line-height: 0.8;color: #111;}
.price-table-style-2 .price-text h2 .price-badge {display: inline-block;width: 100%;text-transform: uppercase;font-size: 14px;font-weight: 500;}
.price-table-style-2 .price-list {margin-bottom: 25px;}
.price-table-style-2 .price-list li {margin-bottom: 10px;font-size: 14px;}
.price-table-style-2 .price-list li:last-child {margin-bottom: 0px;}
.price-table-style-2 .primary-button {padding: 6px 25px;display: inline-block;text-transform: uppercase;text-align: center;font-size: 16px;font-weight: 500;background: #fff;border: 1px solid #d9d9d9;color: #fb3b3a;-webkit-transition: all 0.25s linear;transition: all 0.25s linear;}
.price-table-style-2 .primary-button:hover {background: #fb3b3a;color: #fff;}
.price-table-style-2.active .primary-button {padding: 6px 25px;display: inline-block;text-transform: uppercase;text-align: center;border: 1px solid #fb3b3a;background: #fb3b3a;color: #fff;-webkit-transition: all 0.25s linear;transition: all 0.25s linear;}
.price-table-style-2.active .primary-button:hover {background: #fff;color: #fb3b3a;}
.price-table-style-2.active .price-text {background: #fb3b3a;}
.price-table-style-2.active .price-text  h2 {color: #fff;}

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
