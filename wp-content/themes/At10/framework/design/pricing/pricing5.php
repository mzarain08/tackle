<?php
 
add_filter( 'ppt_blocks_args', 	array('block_pricing5',  'data') );
add_action( 'pricing5',  		array('block_pricing5', 'output' ) );
add_action( 'pricing5-css',  	array('block_pricing5', 'css' ) );
add_action( 'pricing5-js',  	array('block_pricing5', 'js' ) );

class block_pricing5 {

	function __construct(){}		

	public static function data($a){ global $CORE;
  
		$a['pricing5'] = array(
			"name" 	=> "Style 5",
			"image"	=> "pricing5.jpg",
			"cat"	=> "pricing",
			"widget" => "ppt-pricing",
			"desc" 	=> "", 
			"data" 	=> array( ),
			"order" => 5,
			"defaults" => array(),
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $new_settings, $userdata, $settings;
	
		
		$settings = array( );  
		 
		// ADD ON SYSTEM DEFAULTS
		$settings = $CORE->LAYOUT("get_block_settings_defaults", array("pricing5", "pricing", $settings ) );
	 
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
						<div class="price-table-style-3 border text-center box<?php echo $i; ?> <?php if($pak['active'] == "1"){?>active<?php } ?>">
							<div class="price-table-head">
		                        <div class="price-title">
		                            <h2><?php echo $pak['title']; ?></h2>
		                           
		                        </div>
		                        <div class="price-text">
                                
                                <span class="<?php if(is_numeric($pak['price']) && $pak['price'] != "0"){ echo $CORE->GEO("price_formatting",array()); } ?>"><?php if($pak['price'] == 0){ echo $pak['price_text']; }else{  echo $pak['price']; } ?></span> 
                                
		                        	 
		                        </div>
							</div>
	                        <div class="price-list">
	                            <ul>
	                               <?php if(strlen($pak['desc']) > 1){ ?> <li class="mb-3 text-600"><?php echo $pak['desc']; ?></li><?php } ?>
                                   
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




      <?php /* if(isset($GLOBALS['flag-add']) && $userdata->ID && $settings["pricing_type"] == "packages" && $CORE->USER("membership_hasaccess", "listings") && $CORE->USER("get_user_free_membership_addon", array("listings", $userdata->ID)) > 0 ){ ?>
      <div class="col-12 mt-4">
      
      <div class="alert alert-info text-center">
      <?php echo str_replace("%s", "<u class='font-weight-bold'>".$CORE->USER("get_user_free_membership_addon", array("listings", $userdata->ID))."</u>", __("You have %s free listings left. Pick any listing package above to continue.","premiumpress")); ?>
      </div>
     
      </div>
      <?php } */ ?>
      
      
      <?php if(isset($_GET['upgrade']) && $userdata->ID){ $mem = $CORE->USER("get_user_membership", $userdata->ID); $da = $CORE->date_timediff($mem['date_expires'],'');   ?>
      <div class="col-12 mt-4">
      <?php if(in_array(_ppt(array('mem','paktime')), array("","1"))){ ?>
      <div class="alert alert-info text-center">
      <?php echo str_replace("%s", "<u class='font-weight-bold'>".$da['days-left']."</u>", __("Buy a new membership today and get the %s days left on your old membership added completely free!","premiumpress")); ?>
      </div>
      <?php } ?>
     
      </div>
      <?php } ?> 

 
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
.price-table-style-3 ul { list-style:none; padding:30px;  }

.price-table-style-3 {position: relative;border-radius: 5px;margin-bottom: 30px;padding-bottom: 40px;background: #fff;background-repeat: no-repeat;background-size: 100% auto;-webkit-transition: all 0.25s ease;transition: all 0.25s ease;-webkit-box-shadow: 0 2px 5px -2px rgba(123, 127, 138, 0.15);box-shadow: 0 2px 5px -2px rgba(123, 127, 138, 0.15);}
.price-table-style-3:hover {-webkit-box-shadow: 0 15px 30px 0 rgba(123, 127, 138, 0.30);box-shadow: 0 15px 30px 0 rgba(123, 127, 138, 0.30);-webkit-transform: translateY(-15px) scale(1.05);transform: translateY(-15px) scale(1.05);}
.price-table-style-3 .price-table-head {display: flex;padding: 20px 25px 25px;}
.price-table-style-3 .price-title {flex: 1;align-self: center;text-align: left;}
.price-table-style-3 .price-title h2 {font-size: 30px;text-transform: uppercase;margin-bottom: 0;color: #fff;}
.price-table-style-3 .price-title .price-disc {font-size: 13px;text-transform: uppercase;color: #fff;}
.price-table-style-3 .price-text {text-align: right;font-size: 26px;font-weight: 500;align-self: center;color: #fff;}
.price-table-style-3 .price-list li {padding: 1rem;font-size: 14px;border-bottom: 1px solid #e6e2e2;}
.price-table-style-3 .primary-button {padding: 10px 30px;display: inline-block;text-transform: capitalize;text-align: center;font-weight: 500;border-radius: 5px;border: 1px solid ;-webkit-transition: all 0.25s linear;transition: all 0.25s linear;}
.price-table-style-3.box1 .price-table-head {background: #f35764;}
.price-table-style-3.box2 .price-table-head {background: #2bcc6f;}
.price-table-style-3.box3 .price-table-head {background: #feb73b;}
.price-table-style-3.box1 .primary-button {border-color: #f35764;color: #fff;background: #f35764;}
.price-table-style-3.box1 .primary-button:hover {background: #fff;color: #f35764;-webkit-transform: translateY(-5px);transform: translateY(-5px);}
.price-table-style-3.box2 .primary-button {border-color: #2bcc6f;color: #fff;background: #2bcc6f;}
.price-table-style-3.box2 .primary-button:hover {background: #fff;color: #2bcc6f;-webkit-transform: translateY(-5px);transform: translateY(-5px);}
.price-table-style-3.box3 .primary-button {border-color: #feb73b;color: #fff;background: #feb73b;}
.price-table-style-3.box3 .primary-button:hover {background: #fff;color: #feb73b;-webkit-transform: translateY(-5px);transform: translateY(-5px);}
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
