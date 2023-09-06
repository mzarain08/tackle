<?php
 
add_filter( 'ppt_blocks_args', 	array('block_pricing3',  'data') );
add_action( 'pricing3',  		array('block_pricing3', 'output' ) );
add_action( 'pricing3-css',  	array('block_pricing3', 'css' ) );
add_action( 'pricing3-js',  	array('block_pricing3', 'js' ) );

class block_pricing3 {

	function __construct(){}		

	public static function data($a){ global $CORE;
  
		$a['pricing3'] = array(
			"name" 	=> "Style 3",
			"image"	=> "pricing3.jpg",
			"cat"	=> "pricing",
			"widget" => "ppt-pricing",
			"desc" 	=> "", 
			"data" 	=> array( ),
			"order" => 3,
			"defaults" => array( ),
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $new_settings, $userdata, $settings;
	
		
		$settings = array( );  
		 
		// ADD ON SYSTEM DEFAULTS
		$settings = $CORE->LAYOUT("get_block_settings_defaults", array("pricing3", "pricing", $settings ) );
	 
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
        <div class="price-table-style-1 text-center box<?php echo $i; ?> border <?php if($pak['active'] == "1"){?>active<?php } ?>">
          <div class="price-text">
            <h2> <span class="<?php if(is_numeric($pak['price']) && $pak['price'] != "0"){ echo $CORE->GEO("price_formatting",array()); } ?>">
              <?php if($pak['price'] == 0){ echo $pak['price_text']; }else{  echo $pak['price']; } ?>
              </span> </h2>
          </div>
          <div class="price-title">
            <h4><?php echo $pak['title']; ?></h4>
          </div>
          <div class="price-list pt-5">
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
.price-table-style-1 ul { list-style:none; padding:30px;  }

 .price-table-style-1 {position: relative;border-radius: 5px;margin-bottom: 30px;padding-bottom: 40px;background: #fff;background-repeat: no-repeat;background-size: 100% auto;-webkit-transition: all 0.25s ease;transition: all 0.25s ease;-webkit-box-shadow: 0 2px 5px -2px rgba(123, 127, 138, 0.15);box-shadow: 0 2px 5px -2px rgba(123, 127, 138, 0.15);}
.price-table-style-1:hover {-webkit-box-shadow: 0 15px 30px 0 rgba(123, 127, 138, 0.30);box-shadow: 0 15px 30px 0 rgba(123, 127, 138, 0.30);-webkit-transform: translateY(-15px) scale(1.05);transform: translateY(-15px) scale(1.05);}
.price-table-style-1 .price-text h2 {font-size: 40px;padding: 2rem 0;margin-bottom: 0;color: #fff;}
.price-table-style-1 .price-text h2 .price-badge {font-size: 14px;margin-left: 0.2rem;font-weight: 400;}
.price-table-style-1 .price-title {min-width: 65.5%;margin: 0 auto 35px 82px;text-align: left;padding: 8px 20px;border-radius: 25px 0 0 25px;background: #fff;-webkit-box-shadow: 0 2px 5px -2px rgba(123, 127, 138, 0.15);box-shadow: 0 2px 5px -2px rgba(123, 127, 138, 0.15);}
.price-table-style-1 .price-title h4 {font-size: 14px;font-weight: 500;margin-bottom: 0;color: #111;}
.price-table-style-1 .price-list {margin-bottom: 25px;}
.price-table-style-1 .price-list li {margin-bottom: 10px;font-size: 14px;}
.price-table-style-1 .price-list li:last-child {margin-bottom: 0px;}
.price-table-style-1 .primary-button {padding: 10px 30px;display: inline-block;text-transform: capitalize;text-align: center;border-radius: 5px;font-weight: 500;border: 1px solid ;-webkit-transition: all 0.25s linear;transition: all 0.25s linear;}
.price-table-style-1.box1 {background-image: url('<?php echo DEMO_IMG_PATH; ?>blocks/pricing/shape-1.png');}
.price-table-style-1.box2 {background-image: url('<?php echo DEMO_IMG_PATH; ?>blocks/pricing/shape-2.png');}
.price-table-style-1.box3 {background-image: url('<?php echo DEMO_IMG_PATH; ?>blocks/pricing/shape-3.png');}
.price-table-style-1.box1 .primary-button {border-color: #a29afd;color: #a29afd;background: #fff;-webkit-box-shadow: 0 5px 20px 0 rgba(162, 154, 253, 0.3);box-shadow: 0 5px 20px 0 rgba(162, 154, 253, 0.3);}
.price-table-style-1.box1 .primary-button:hover {background: #a29afd;color: #fff;-webkit-box-shadow: 0 10px 20px 0 rgba(162, 154, 253, 0.4);box-shadow: 0 10px 20px 0 rgba(162, 154, 253, 0.4);-webkit-transform: translateY(-5px);transform: translateY(-5px);}
.price-table-style-1.box2 .primary-button {border-color: #00b894;color: #00b894;background: #fff;-webkit-box-shadow: 0 5px 20px 0 rgba(0, 184, 148,0.3);box-shadow: 0 5px 20px 0 rgba(0, 184, 148,0.3);}
.price-table-style-1.box2 .primary-button:hover {background: #00b894;color: #fff;-webkit-box-shadow: 0 10px 20px 0 rgba(0, 184, 148,0.4);box-shadow: 0 10px 20px 0 rgba(0, 184, 148,0.4);-webkit-transform: translateY(-5px);transform: translateY(-5px);}
.price-table-style-1.box3 .primary-button {border-color: #e27055;color: #e27055;background: #fff;-webkit-box-shadow: 0 5px 20px 0 rgba(226, 112, 85,0.3);box-shadow: 0 5px 20px 0 rgba(226, 112, 85,0.3);}
.price-table-style-1.box3 .primary-button:hover {background: #e27055;color: #fff;-webkit-box-shadow: 0 10px 20px 0 rgba(226, 112, 85,0.4);box-shadow: 0 10px 20px 0 rgba(226, 112, 85,0.4);-webkit-transform: translateY(-5px);transform: translateY(-5px);}


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