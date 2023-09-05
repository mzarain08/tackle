<?php
 
add_filter( 'ppt_blocks_args', 	array('block_pricing9',  'data') );
add_action( 'pricing9',  		array('block_pricing9', 'output' ) );
add_action( 'pricing9-css',  	array('block_pricing9', 'css' ) );
add_action( 'pricing9-js',  	array('block_pricing9', 'js' ) );

class block_pricing9 {

	function __construct(){}		

	public static function data($a){ global $CORE;
  
		$a['pricing9'] = array(
			"name" 	=> "Style 9",
			"image"	=> "pricing9.jpg",
			"cat"	=> "pricing",
			"widget" => "ppt-pricing",
			"desc" 	=> "", 
			"data" 	=> array( ),
			"order" => 9,
			"defaults" => array(),
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $new_settings, $userdata, $settings;
	
		
		$settings = array( );  
		 
		// ADD ON SYSTEM DEFAULTS
		$settings = $CORE->LAYOUT("get_block_settings_defaults", array("pricing9", "pricing", $settings ) );
	 
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

if($type == "memberships"){

$GLOBALS['flag-pricingtable'] = 1;
echo "<div  class='hide-mobile'>";
_ppt_template( 'ajax/ajax-modal-memberships' );
echo "</div>";

}else{
		
?>

<div class="row justify-content-md-center hide-mobile">

<?php if(!empty($pricing_data)){
 $i=1; foreach($pricing_data as $pak){ ?>
 
 
<div class="col-xl-4 col-md-6">
						<div class="price-table-style-8 text-center <?php if($pak['active'] == "1"){?>active<?php } ?>">
	                        <div class="price-title">
	                            <h4><?php echo $pak['title']; ?></h4>
	                        </div>
	                        <div class="price-text text-dark">
	                        	<h2>
	                        		<span class="<?php if(is_numeric($pak['price']) && $pak['price'] != "0"){ echo $CORE->GEO("price_formatting",array()); } ?>"><?php if($pak['price'] == 0){ echo $pak['price_text']; }else{  echo $pak['price']; } ?></span> 
	                        	</h2>
	                        </div>
	                        <div class="price-list">
	                            <ul>
	                                 <?php if(strlen($pak['desc']) > 1){ ?> <li><?php echo $pak['desc']; ?></li><?php } ?>
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
.price-table-style-8 ul { list-style:none; padding:30px;  }
.price-table-style-8 {position: relative;border-radius: 5px;margin-bottom: 30px;background: #fff;-webkit-transition: all 0.25s ease;transition: all 0.25s ease;-webkit-box-shadow: 0 20px 30px 0 rgba(40, 93, 251, 0.16);box-shadow: 0 20px 30px 0 rgba(40, 93, 251, 0.16);}
.price-table-style-8:hover {-webkit-box-shadow: 0 15px 30px 0 rgba(123, 127, 138, 0.30);box-shadow: 0 15px 30px 0 rgba(123, 127, 138, 0.30);-webkit-transform: translateY(-15px) scale(1.05);transform: translateY(-15px) scale(1.05);}
.price-table-style-8 .price-title {padding-top: 30px;}
.price-table-style-8 .price-title h4 {font-size: 16px;font-weight: 500;margin-bottom: 0;text-transform: uppercase;}
.price-table-style-8 .price-text {margin-bottom: 20px;margin-top: 5px;}
.price-table-style-8 .price-text h2 {font-size: 70px;margin-bottom: 0; }
.price-table-style-8 .price-text h2 i {font-size: 14px;font-weight: 400;color: #111;}
.price-table-style-8 .price-text h2 .price-badge {font-size: 14px;font-weight: 400;color: #111;}
.price-table-style-8 .price-list li {padding: 15px;font-size: 14px;border-top: 1px dashed #e6e2e2;}
.price-table-style-8 .primary-button {padding: 18px 30px;display: inline-block;width: 100%;text-transform: capitalize;text-align: center;font-size: 16px;font-weight: 500;border-radius: 0 0 5px 5px;background: #313c50;color: #fff;-webkit-transition: all 0.25s linear;transition: all 0.25s linear;-webkit-box-shadow: 0 5px 20px 0 rgba(38, 91, 251, 0.3);box-shadow: 0 5px 20px 0 rgba(38, 91, 251, 0.3);}
.price-table-style-8 .primary-button:hover {background: #fe2a5c;color: #fff;-webkit-box-shadow: 0 10px 20px 0 rgba(38, 91, 251, 0.4);box-shadow: 0 10px 20px 0 rgba(38, 91, 251, 0.4);}
.price-table-style-8.active {background: #fe2a5c;}
.price-table-style-8.active .price-title h4,
.price-table-style-8.active .price-text h2,
.price-table-style-8.active .price-list li {color: #fff;}
.price-table-style-8.active .price-list li {border-top: 1px dashed rgba(255,255,255,0.4);}
.price-table-style-8.active .price-text h2 i,
.price-table-style-8.active .price-text h2 .price-badge {color: rgba(255,255,255,0.7);}
.price-table-style-8.active .primary-button {background: #d61e53;}
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
