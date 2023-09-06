<?php
 
add_filter( 'ppt_blocks_args', 	array('block_pricing11',  'data') );
add_action( 'pricing11',  		array('block_pricing11', 'output' ) );
add_action( 'pricing11-css',  	array('block_pricing11', 'css' ) );
add_action( 'pricing11-js',  	array('block_pricing11', 'js' ) );

class block_pricing11 {

	function __construct(){}		

	public static function data($a){ global $CORE;
  
		$a['pricing11'] = array(
			"name" 	=> "Sellspace Table",
			"image"	=> "pricing11.jpg",
			"cat"	=> "pricing",
			"widget" => "ppt-pricing",
			"desc" 	=> "", 
			"data" 	=> array( ),
			"order" => 110,
			
			"defaults" => array(),
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $new_settings, $userdata, $settings;
	
		
		$settings = array( );  
		 
		// ADD ON SYSTEM DEFAULTS
		$settings = $CORE->LAYOUT("get_block_settings_defaults", array("pricing11", "pricing", $settings ) );
	 
		// UPDATE DATA FROM ELEMENTOR OR CHILD THEMES
		if(is_array($new_settings)){
			 foreach($settings as $h => $j){
				if(isset($new_settings[$h]) && $new_settings[$h] != ""){
					$settings[$h] = $new_settings[$h];
				}
			 }
		} 
		
		   
		// BUILD PACKAGE DATA
		$type = "advertising";
		 
		if(isset($new_settings['pricing_type']) && strlen($new_settings['pricing_type']) > 1){
		$type = $new_settings['pricing_type'];
		}
		
		// DATA
		$pricing_data = ppt_theme_pricingtable($type);
		
		 
	 
	ob_start();
	 
	
	?>
 
<section>
 



  <div class="pricing-wrapper">
    <div class="container">
      <div class="row"> 
      
        <?php if(empty($pricing_data)){ ?>
        <div class="col-12">
          <div class="py-5 text-center"> <div class="alert alert-danger"><i class="fal fa-frown"></i> <?php echo __("Everything has sold out!","premiumpress"); ?> </div></div>
        </div>
        <?php
		
		}elseif(!empty($pricing_data)){ $i=1;
 


	// TEXT CHANGES
	$btnColor = "btn-primary";
	$bgColor = "bg-light";
	$linkColor = "";
	 

 ?>


 <div class="col-md-8 mx-auto mb-5">
<?php foreach($pricing_data as $pak){ ?> 

    <div class="card p-2 shadow-sm mb-4 p-3 bg-white" ppt-border1>
      <div class="row">
       
        <div class="col-lg-9">
        
        <?php if($settings["pricing_type"] == "advertising"){ ?>
        
         <img src="<?php echo $pak['icon']; ?>" class="img-fluid" style="max-width:80px; margin-right:30px; float:left;" alt="advertising" />
         
         <?php } ?>
        
          <div class="mb-3 text-700"><?php echo $pak['title']; ?></div>
          <div>
          
          <span class="<?php echo $CORE->GEO("price_formatting",array()); ?>"><?php if($pak['price'] == "0"){ echo $pak['price_text']; }else{  echo $pak['price']; } ?></span> 
		  
		  <?php echo __("for","premiumpress"); ?> <?php echo $pak['subtitle']; ?>
          
          <?php if(isset($pak['size'])){ ?>
          <span class="badge badge-success"><?php echo __("Banner Size","premiumpress"); ?>  <?php echo $pak['size']; ?></span>
          <?php } ?>
          
          </div>
          
        </div>
        
        <div class="col-lg-3 text-center">
           
          <a data-ppt-btn class="btn-primary btn-block mt-3" 
								<?php if($userdata->ID){ ?>
                                href="javascript:void(0);" 
                                onclick="processNewPayment('<?php echo $pak['paycode']; ?>');" 
                                <?php }else{ ?>
                                href="javascript:void(0)" onclick="processLogin(1,'');"
                                <?php } ?>> <?php echo __("Select Package","premiumpress"); ?> </a>
                                  
          
          
        </div>
        
      </div>
    </div>
    
<?php } ?>
</div>
<?php } ?> 
     
</div></div>   </div>  
  

 
<?php
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;	
	
	}
		public static function css(){
		ob_start();
		?>
<style></style>
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