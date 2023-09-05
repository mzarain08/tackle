<?php
 
add_filter( 'ppt_blocks_args', 	array('block_pricing10',  'data') );
add_action( 'pricing10',  		array('block_pricing10', 'output' ) );
add_action( 'pricing10-css',  	array('block_pricing10', 'css' ) );
add_action( 'pricing10-js',  	array('block_pricing10', 'js' ) );

class block_pricing10 {

	function __construct(){}		

	public static function data($a){ global $CORE;
  
		$a['pricing10'] = array(
			"name" 	=> "Style 10",
			"image"	=> "pricing10.jpg",
			"cat"	=> "pricing",
			"widget" => "ppt-pricing",
			"desc" 	=> "", 
			"data" 	=> array( ),
			"order" => 10,
			
			"defaults" => array(),
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $new_settings, $userdata, $settings;
	
		
		$settings = array();  
		 
		// ADD ON SYSTEM DEFAULTS
		$settings = $CORE->LAYOUT("get_block_settings_defaults", array("pricing10", "pricing", $settings ) );
	 
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
  <div class="container px-0"> 
  
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
 $i=1; foreach($pricing_data as $pak){   ?>
 
 
 
 
<div class="col-xl-4 col-md-6">
						<div class="price-table-style-10 text-center <?php if($pak['active'] == "1"){?>active<?php } ?>">
	                       <?php /*if($pak['recurring'] == "1" ){ ?>
                            <span class="price-badge">
	                        	<?php if(isset($pak['days']) && $pak['days'] == "30"){ echo __("Monthly","premiumpress"); }else{ echo __("Subscription","premiumpress"); } ?>
	                        </span>
                            <?php }*/ ?>
	                        <div class="price-title">
	                            <h4><?php echo $pak['title']; ?></h4>
	                        </div>
	                        <div class="price-icon">
	                            <i class="<?php if(strlen($pak['icon']) > 0){ echo $pak['icon']; }else{ ?>fa fa-check<?php } ?>"></i>
	                        </div>
	                        <div class="price-text">
	                            <h2>
                                <span class="<?php if(is_numeric($pak['price']) && $pak['price'] != "0"){ echo $CORE->GEO("price_formatting",array()); } ?>"><?php if($pak['price'] == 0){ echo $pak['price_text']; }else{  echo $pak['price']; } ?></span>
                                
                                </h2>
	                        </div>
	                        <div class="price-list">
	                            <ul>
	                                  <?php if(strlen($pak['desc']) > 1){ ?> <li class="text-600 mb-3"><?php echo $pak['desc']; ?></li><?php } ?>
                                      
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
<style>
.price-table-style-10 ul { list-style:none; padding:0px;  }

.price-table-style-10 {position: relative;padding: 40px 20px 50px;text-align: center;border-radius: 5px;margin-bottom: 30px;overflow: hidden;background: #fff;-webkit-transition: all 0.25s ease;transition: all 0.25s ease;-webkit-box-shadow: 0 20px 30px 0 rgba(40, 93, 251, 0.16);box-shadow: 0 20px 30px 0 rgba(40, 93, 251, 0.16);}
.price-table-style-10:hover {-webkit-box-shadow: 0 15px 30px 0 rgba(123, 127, 138, 0.30);box-shadow: 0 15px 30px 0 rgba(123, 127, 138, 0.30);-webkit-transform: translateY(-15px) scale(1.05);transform: translateY(-15px) scale(1.05);}
.price-table-style-10 .price-badge {position: absolute;top: -15px;right: -50px;z-index: 1;padding: 35px 40px 10px 35px;font-size: 13px;line-height: 22px;-webkit-transform: rotate(45deg);transform: rotate(45deg);background: <?php echo $pricing_data[0]['color_primary']; ?>;color: #fff;}
.price-table-style-10 .price-title {position: absolute;top: 30px;left: 10px;writing-mode: tb-rl;padding-bottom: 5px;}
.price-table-style-10 .price-title h4 {font-size: 26px; padding:0px; margin:0px; margin-left:10px; font-weight: 500;margin-bottom: 0;color: #111;}
.price-table-style-10 .price-icon {border-bottom: 5px solid <?php echo $pricing_data[0]['color_primary']; ?>;padding: 7px;border-radius: 50%;display: inline-block;margin-bottom: 20px;}
.price-table-style-10 .price-icon i {text-align: center;color: #fff;display: inline-block;border-radius: 50%;width: 60px;height: 60px;line-height: 60px;font-size: 25px;background: <?php echo $pricing_data[0]['color_primary']; ?>;}
.price-table-style-10 .price-text {margin-bottom: 20px;}
.price-table-style-10 .price-text h2 {font-size: 40px;margin-bottom: 0;}
.price-table-style-10 .price-list {margin-bottom: 25px;}
.price-table-style-10 .price-list li {margin-bottom: 10px;font-size: 14px;}
.price-table-style-10 .price-list li:last-child {margin-bottom: 0px;}
.price-table-style-10 .primary-button {padding: 10px 30px;display: inline-block;text-transform: capitalize;text-align: center;font-weight: 500;border-radius: 5px;background:<?php echo $pricing_data[0]['color_primary']; ?>; color: #fff;-webkit-transition: all 0.25s linear;transition: all 0.25s linear;-webkit-box-shadow: 0 5px 20px 0 rgba(38, 91, 251, 0.3);box-shadow: 0 5px 20px 0 rgba(38, 91, 251, 0.3);}
.price-table-style-10 .primary-button:hover {background: <?php echo _ppt(array('design','color_secondary')); ?>;color: #fff;-webkit-box-shadow: 0 10px 20px 0 rgba(38, 91, 251, 0.4);box-shadow: 0 10px 20px 0 rgba(38, 91, 251, 0.4);-webkit-transform: translateY(-5px);transform: translateY(-5px);}
.price-table-style-10.active .primary-button {padding: 10px 30px;display: inline-block;text-transform: capitalize;-webkit-transition: all 0.25s linear;transition: all 0.25s linear;text-align: center;border-radius: 5px;background: transparent;border: 2px solid #fff;color: #fff;}
.price-table-style-10.active .primary-button:hover {background: #fff;color: <?php echo $pricing_data[0]['color_primary']; ?>;-webkit-transform: translateY(-5px);transform: translateY(-5px);}
.price-table-style-10.active {background: <?php echo $pricing_data[0]['color_primary']; ?>;-webkit-box-shadow: 0 20px 49px 0 rgba(38, 91, 251, 0.35);box-shadow: 0 20px 49px 0 rgba(38, 91, 251, 0.35);}
.price-table-style-10.active .price-badge {background: #fff;color: <?php echo $pricing_data[0]['color_primary']; ?>;}
.price-table-style-10.active .price-badge::after {border-color: #fff transparent #fff #fff;}
.price-table-style-10.active .price-title h4 {color: #fff;}
.price-table-style-10.active .price-icon {border-bottom: 5px solid #fff;}
.price-table-style-10.active .price-text h2 {color: #fff !important;}
.price-table-style-10.active .price-list li {color: #fff;}

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
