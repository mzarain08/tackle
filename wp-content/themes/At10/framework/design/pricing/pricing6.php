<?php
 
add_filter( 'ppt_blocks_args', 	array('block_pricing6',  'data') );
add_action( 'pricing6',  		array('block_pricing6', 'output' ) );
add_action( 'pricing6-css',  	array('block_pricing6', 'css' ) );
add_action( 'pricing6-js',  	array('block_pricing6', 'js' ) );

class block_pricing6 {

	function __construct(){}		

	public static function data($a){ global $CORE;
  
		$a['pricing6'] = array(
			"name" 	=> "Style 6",
			"image"	=> "pricing6.jpg",
			"cat"	=> "pricing",
			"widget" => "ppt-pricing",
			"desc" 	=> "", 
			"data" 	=> array( ),
			"order" => 6,
			"defaults" => array(),
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $new_settings, $userdata, $settings;
	
		
		$settings = array( );  
		 
		// ADD ON SYSTEM DEFAULTS
		$settings = $CORE->LAYOUT("get_block_settings_defaults", array("pricing6", "pricing", $settings ) );
	 
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
						<div class="price-table-style-4 <?php if($pak['active'] == "1"){?>active<?php } ?>">
	                        <div class="price-title btn-primary">
	                            <?php echo $pak['title']; ?>
	                        </div>
	                        <div class="price-icon">
	                            <i class="<?php if(strlen($pak['icon']) > 0){ echo $pak['icon']; }else{ ?>fa fa-life-ring<?php } ?>"></i>
	                        </div>
	                        <div class="price-text">
	                            <h2>
                                
                                <span class="<?php if(is_numeric($pak['price']) && $pak['price'] != "0"){ echo $CORE->GEO("price_formatting",array()); } ?>"><?php if($pak['price'] == 0){ echo $pak['price_text']; }else{  echo $pak['price']; } ?></span> 
                                
                                </h2>
	                        </div>
	                        <div class="price-list">
	                            <ul>
	                                <?php if(strlen($pak['desc']) > 1){ ?> <li  class="text-600"><?php echo $pak['desc']; ?></li><?php } ?>
                                        <?php if(isset($pak['features']) && is_array($pak['features']) && !empty($pak['features']) ){ foreach($pak['features'] as $f){ ?>
		                                <li><i class="fa <?php if($f['value'] == "1"){?>fa-check<?php }else{ ?>fa-times<?php } ?> mr-2"></i> <?php echo $f['name']; ?></li>
		                                <?php } } ?>
	                            </ul>
	                        </div>
	                       <?php if($pak['button'] == "existing"){ ?>
                                <a class="primary-button btn-primary opacity-5" href="#"><?php echo __("Current Plan","premiumpress"); ?></a>
                                <?php }else{ ?>
		                        <a class="primary-button btn-primary" <?php echo $pak['button']; ?>><?php echo __("Select Package","premiumpress"); ?></a>
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
.price-table-style-4 ul { list-style:none; padding:30px;  }

.price-table-style-4 {position: relative;text-align: center;margin-bottom: 30px;padding-top: 30px;padding-bottom: 50px;background: #fff;-webkit-transition: all 0.25s ease;transition: all 0.25s ease;-webkit-box-shadow: 0 20px 30px 0 rgba(40, 93, 251, 0.16);box-shadow: 0 20px 30px 0 rgba(40, 93, 251, 0.16);}
.price-table-style-4:hover {-webkit-box-shadow: 0 15px 30px 0 rgba(123, 127, 138, 0.30);box-shadow: 0 15px 30px 0 rgba(123, 127, 138, 0.30);-webkit-transform: translateY(-15px) scale(1.05);transform: translateY(-15px) scale(1.05);}
.price-table-style-4 .price-title {position: relative;width: 50%;margin: -41px auto 30px;padding: 1rem;text-transform: uppercase;font-size: 14px;font-weight: 400;line-height: initial;color: #fff;background: #fb3b3a;}
.price-table-style-4 .price-title::before {content: '';position: absolute;top: 0;left: -5px;z-index: -1;border-left: 5px solid transparent;border-right: 5px solid transparent;border-bottom: 10px solid #353232;}
.price-table-style-4 .price-icon {display: inline-block;margin-bottom: 20px;position: relative;z-index: 1;}
.price-table-style-4 .price-icon::before {content: '';position: absolute;top: 0;left: -10px;height: 40px;width: 40px;border-radius: 50%;z-index: -1;background: #fb3b3a;}
.price-table-style-4 .price-icon i {text-align: center;color: #111;display: inline-block;font-size: 70px;}
.price-table-style-4 .price-text {margin-bottom: 20px;}
.price-table-style-4 .price-text h2 {font-size: 40px;}
.price-table-style-4 .price-list {margin-bottom: 30px;}
.price-table-style-4 .price-list li {margin-bottom: 10px;font-size: 14px;}
.price-table-style-4 .price-list li:last-child {margin-bottom: 0px;}
.price-table-style-4 .primary-button {padding: 10px 30px;display: inline-block;text-transform: uppercase;text-align: center;font-weight: 500;border-radius: 5px;background: #fb3b3a;color: #fff;-webkit-transition: all 0.25s linear;transition: all 0.25s linear;-webkit-box-shadow: 0 5px 20px 0 rgba(251, 59, 58, 0.3);box-shadow: 0 5px 20px 0 rgba(251, 59, 58, 0.3);}
.price-table-style-4 .primary-button:hover {background: #fb3b3a;color: #fff;-webkit-box-shadow: 0 10px 20px 0 rgba(251, 59, 58, 0.4);box-shadow: 0 10px 20px 0 rgba(251, 59, 58, 0.4);-webkit-transform: translateY(-5px);transform: translateY(-5px);}

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
