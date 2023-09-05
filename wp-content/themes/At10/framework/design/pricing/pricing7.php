<?php
 
add_filter( 'ppt_blocks_args', 	array('block_pricing7',  'data') );
add_action( 'pricing7',  		array('block_pricing7', 'output' ) );
add_action( 'pricing7-css',  	array('block_pricing7', 'css' ) );
add_action( 'pricing7-js',  	array('block_pricing7', 'js' ) );

class block_pricing7 {

	function __construct(){}		

	public static function data($a){ global $CORE;
  
		$a['pricing7'] = array(
			"name" 	=> "Style 7",
			"image"	=> "pricing7.jpg",
			"cat"	=> "pricing",
			"widget" => "ppt-pricing",
			"desc" 	=> "", 
			"data" 	=> array( ),
			"order" => 7,
			"defaults" => array(),
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $new_settings, $userdata, $settings;
	
		
		$settings = array( );  
		 
		// ADD ON SYSTEM DEFAULTS
		$settings = $CORE->LAYOUT("get_block_settings_defaults", array("pricing7", "pricing", $settings ) );
	 
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
						<div class="price-table-style-5 <?php if($pak['active'] == "1"){?>active<?php } ?>">
	                        <div class="price-icon">
	                            <i class="<?php if(strlen($pak['icon']) > 0){ echo $pak['icon']; }else{ ?>fa fa-life-ring<?php } ?>"></i>
	                        </div>
	                        <div class="price-title">
	                            <h2><?php echo $pak['title']; ?></h2>
	                        </div>
	                        <div class="price-list">
	                            <ul>
	                              <?php if(strlen($pak['desc']) > 1){ ?> <li><?php echo $pak['desc']; ?></li><?php } ?>
                                        <?php if(isset($pak['features']) && is_array($pak['features']) && !empty($pak['features']) ){ foreach($pak['features'] as $f){ ?>
		                                <li><i class="fa <?php if($f['value'] == "1"){?>fa-check<?php }else{ ?>fa-times<?php } ?> mr-2"></i> <?php echo $f['name']; ?></li>
		                                <?php } } ?>
	                            </ul>
	                        </div>
	                        <div class="price-text">
	                            <h4><span class="<?php if(is_numeric($pak['price']) && $pak['price'] != "0"){ echo $CORE->GEO("price_formatting",array()); } ?>"><?php if($pak['price'] == 0){ echo $pak['price_text']; }else{  echo $pak['price']; } ?></span> </h4>
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
  
<style>
.price-table-style-5 ul { list-style:none; padding:30px;  }

.price-table-style-5 {position: relative;padding: 60px 20px;text-align: center;border-radius: 5px;margin-bottom: 30px;background: #fff;-webkit-transition: all 0.25s ease;transition: all 0.25s ease;-webkit-box-shadow: 0 20px 30px 0 rgba(40, 93, 251, 0.16);box-shadow: 0 20px 30px 0 rgba(40, 93, 251, 0.16);}
.price-table-style-5:hover {-webkit-box-shadow: 0 15px 30px 0 rgba(123, 127, 138, 0.30);box-shadow: 0 15px 30px 0 rgba(123, 127, 138, 0.30);-webkit-transform: translateY(-15px) scale(1.05);transform: translateY(-15px) scale(1.05);}
.price-table-style-5 .price-icon {display: inline-block;margin-bottom: 30px;position: relative;height: 70px;width: 70px;line-height: 70px;padding: 10px;border-radius: 50px;background: <?php echo $pricing_data[0]['color_primary']; ?>;-webkit-box-shadow: 0px 0px 0px 8px rgba(55, 99, 234, 0.2);box-shadow: 0px 0px 0px 8px rgba(55, 99, 234, 0.2);}
.price-table-style-5 .price-icon i {text-align: center;color: #fff;display: inline-block;font-size: 2.5rem;}
.price-table-style-5 .price-title {position: relative;margin-bottom: 20px;}
.price-table-style-5 .price-title h2 {text-transform: capitalize;font-size: 30px;margin-bottom: 0;font-weight: 700;color: #111;}
.price-table-style-5 .price-text {margin-bottom: 25px;}
.price-table-style-5 .price-text h4 {font-size: 28px;font-weight: 700;margin-bottom: 0;color: <?php echo $pricing_data[0]['color_primary']; ?>;}
.price-table-style-5 .price-text h4 .price-badge {font-size: 0.8rem;font-weight: 500;color: #111;}
.price-table-style-5 .price-list {margin-bottom: 20px;}
.price-table-style-5 .price-list li {margin-bottom: 10px;font-size: 14px;}
.price-table-style-5 .price-list li:last-child {margin-bottom: 0px;}
.price-table-style-5 .primary-button {padding: 10px 30px;display: inline-block;text-transform: uppercase;text-align: center;font-weight: 500;border-radius: 5px;background: <?php echo $pricing_data[0]['color_primary']; ?>;color: #fff;-webkit-transition: all 0.25s linear;transition: all 0.25s linear;-webkit-box-shadow: 0 5px 20px 0 rgba(55, 99, 234, 0.3);box-shadow: 0 5px 20px 0 rgba(55, 99, 234, 0.3);}
.price-table-style-5 .primary-button:hover {background: <?php echo $pricing_data[0]['color_primary']; ?>;color: #fff;-webkit-box-shadow: 0 10px 20px 0 rgba(55, 99, 234, 0.4);box-shadow: 0 10px 20px 0 rgba(55, 99, 234, 0.4);-webkit-transform: translateY(-5px);transform: translateY(-5px);}
.price-table-style-5.active .primary-button {padding: 10px 30px;display: inline-block;text-transform: uppercase;text-align: center;border-radius: 5px;background: #fff;color: #000;-webkit-transition: all 0.25s linear;transition: all 0.25s linear;-webkit-box-shadow: 0 5px 20px 0 rgba(244, 82, 91, 0.3);box-shadow: 0 5px 20px 0 rgba(244, 82, 91, 0.3);}
.price-table-style-5.active .primary-button:hover {background: #fff;color:#000;-webkit-box-shadow: 0 10px 20px 0 rgba(244, 82, 91, 0.4);box-shadow: 0 10px 20px 0 rgba(244, 82, 91, 0.4);-webkit-transform: translateY(-5px);transform: translateY(-5px);}
.price-table-style-5.active {background: <?php echo $pricing_data[0]['color_primary']; ?>;}
.price-table-style-5.active .price-icon {background: #fff;-webkit-box-shadow: 0px 0px 0px 8px rgba(174, 194, 255, 0.5);box-shadow: 0px 0px 0px 8px rgba(174, 194, 255, 0.5);}
.price-table-style-5.active .price-icon i {color: <?php echo $pricing_data[0]['color_primary']; ?>}
.price-table-style-5.active .price-title h2,
.price-table-style-5.active .price-text h4,
.price-table-style-5.active .price-text h4 .price-badge,
.price-table-style-5.active .price-list li {color: #fff;}
</style>
  
</section>  
 
<?php
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;	
	
	}
		public static function css(){
		return "";
		ob_start();
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
