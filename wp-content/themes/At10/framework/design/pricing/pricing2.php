<?php
 
add_filter( 'ppt_blocks_args', 	array('block_pricing2',  'data') );
add_action( 'pricing2',  		array('block_pricing2', 'output' ) );
add_action( 'pricing2-css',  	array('block_pricing2', 'css' ) );
add_action( 'pricing2-js',  	array('block_pricing2', 'js' ) );

class block_pricing2 {

	function __construct(){}		

	public static function data($a){ global $CORE;
  
		$a['pricing2'] = array(
			"name" 	=> "Style 2",
			"image"	=> "pricing2.jpg",
			"cat"	=> "pricing",
			"widget" => "ppt-pricing",
			"desc" 	=> "", 
			"data" 	=> array( ),
			"order" => 2,
			"defaults" => array(),
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $new_settings, $userdata, $settings;
	
		
		$settings = array( );  
		 
		// ADD ON SYSTEM DEFAULTS
		$settings = $CORE->LAYOUT("get_block_settings_defaults", array("pricing2", "pricing", $settings ) );
	 
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
						<div class="price-table-style-6 text-center <?php if($pak['active'] == "1"){?>active<?php } ?>">
							<div class="price-table-head">
		                        <div class="price-title">
		                            <h4><?php echo $pak['title']; ?></h4>
		                        </div>
		                        <div class="price-text">
		                        	<h2>
                                    
		                        		<span class="<?php if(is_numeric($pak['price']) && $pak['price'] != "0"){ echo $CORE->GEO("price_formatting",array()); } ?>"><?php if($pak['price'] == 0){ echo $pak['price_text']; }else{  echo $pak['price']; } ?></span> 
                                        <?php /*if($pak['recurring'] == "1"){ ?><span class="price-badge">/ <?php echo __("Monthly","premiumpress"); ?></span><?php }*/  ?>
		                        	</h2>
		                        </div>
							</div>
							<div class="price-table-cont">
		                        <div class="price-list text-center">
		                            <ul>
		                              
                                       <?php if(strlen($pak['desc']) > 1){ ?> <li class="text-600 mb-3"><?php echo $pak['desc']; ?></li><?php } ?>
                                       
                                        <?php if(isset($pak['features']) && is_array($pak['features']) && !empty($pak['features']) ){ foreach($pak['features'] as $f){ ?>
		                                <li class=""><i class="fa <?php if($f['value'] == "1"){?>fa-check<?php }else{ ?>fa-times<?php } ?> mr-2"></i> <?php echo $f['name']; ?></li>
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
					</div>

<?php } } ?> 

</div>
  

 
  </div>
  
  
  
  
 <style>
.price-table-style-6 ul { list-style:none; padding:10px;  }
.price-table-style-6 {position: relative;text-align: center;margin-bottom: 30px;background: #fff;-webkit-transition: all 0.25s ease;transition: all 0.25s ease;-webkit-box-shadow: 0 20px 30px 0 rgba(40, 93, 251, 0.16);box-shadow: 0 20px 30px 0 rgba(40, 93, 251, 0.16);border: 3px solid #f5f8fa;}
.price-table-style-6:hover {-webkit-box-shadow: 0 15px 30px 0 rgba(123, 127, 138, 0.30);box-shadow: 0 15px 30px 0 rgba(123, 127, 138, 0.30);-webkit-transform: translateY(-15px) scale(1.05);transform: translateY(-15px) scale(1.05);}
.price-table-style-6 .price-table-head {padding: 30px 20px;background: #f5f8fa;}
.price-table-style-6 .price-title {position: relative;margin-bottom: 7px;}
.price-table-style-6 .price-title h4 {text-transform: uppercase;font-size: 14px;font-weight: 400;margin-bottom: 0px;color: <?php echo $pricing_data[0]['color_primary']; ?>;}
.price-table-style-6 .price-text h2 {font-size: 40px;font-weight: 700;margin-bottom: 0;color: #111;}
.price-table-style-6 .price-text h2 .price-badge {font-size: 14px;font-weight: 400;color: #9d9e9e;}
.price-table-style-6 .price-table-cont {padding: 40px 30px;}
.price-table-style-6 .price-list {margin-bottom: 40px;text-align: left;}
.price-table-style-6 .price-list li {margin-bottom: 10px;font-size: 14px;}
.price-table-style-6 .price-list li:last-child {margin-bottom: 0px;}
.price-table-style-6 .price-list li i {margin-right: 7px;height: 15px;width: 15px;font-size: 12px;line-height: 13px;text-align: center;border-radius: 50%;color: <?php echo $pricing_data[0]['color_primary']; ?>;border: 1px solid <?php echo $pricing_data[0]['color_primary']; ?>;}
.price-table-style-6 .primary-button {padding: 10px 30px;display: inline-block;text-transform: uppercase;text-align: center;font-weight: 500;border-radius: 30px;background: #f5f8fa;color: <?php echo $pricing_data[0]['color_primary']; ?>;-webkit-transition: all 0.25s linear;transition: all 0.25s linear;-webkit-box-shadow: 0 5px 20px 0 rgba(55, 99, 234, 0.3);box-shadow: 0 5px 20px 0 rgba(55, 99, 234, 0.3);}
.price-table-style-6 .primary-button:hover {background: #f5f8fa;color: <?php echo $pricing_data[0]['color_primary']; ?>;-webkit-box-shadow: 0 10px 20px 0 rgba(55, 99, 234, 0.4);box-shadow: 0 10px 20px 0 rgba(55, 99, 234, 0.4);-webkit-transform: translateY(-5px);transform: translateY(-5px);}
.price-table-style-6.active .primary-button {padding: 10px 30px;display: inline-block;text-transform: uppercase;text-align: center;border-radius: 30px;background: <?php echo $pricing_data[0]['color_primary']; ?>;color: #fff;-webkit-transition: all 0.25s linear;transition: all 0.25s linear;-webkit-box-shadow: 0 5px 20px 0 rgba(72, 95, 183, 0.3);box-shadow: 0 5px 20px 0 rgba(72, 95, 183, 0.3);}
.price-table-style-6.active .primary-button:hover {background: <?php echo $pricing_data[0]['color_primary']; ?>;color: #fff;-webkit-box-shadow: 0 10px 20px 0 rgba(72, 95, 183, 0.4);box-shadow: 0 10px 20px 0 rgba(72, 95, 183, 0.4);-webkit-transform: translateY(-5px);transform: translateY(-5px);}
.price-table-style-6.active {border-color: <?php echo $pricing_data[0]['color_primary']; ?>;}
.price-table-style-6.active .price-icon {background: #fff;-webkit-box-shadow: 0px 0px 0px 8px rgba(174, 194, 255, 0.5);box-shadow: 0px 0px 0px 8px rgba(174, 194, 255, 0.5);}
.price-table-style-6.active .price-icon i {color: <?php echo $pricing_data[0]['color_primary']; ?>}
.price-table-style-6.active .price-table-head {background: <?php echo $pricing_data[0]['color_primary']; ?>;}
.price-table-style-6.active .price-title h4,
.price-table-style-6.active .price-text h2,
.price-table-style-6.active .price-text h2 .price-badge {color: #fff;}

</style> 
  
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
