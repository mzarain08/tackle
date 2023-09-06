<?php
 
add_filter( 'ppt_blocks_args', 	array('block_pricing1',  'data') );
add_action( 'pricing1',  		array('block_pricing1', 'output' ) );
add_action( 'pricing1-css',  	array('block_pricing1', 'css' ) );
add_action( 'pricing1-js',  	array('block_pricing1', 'js' ) );

class block_pricing1 {

	function __construct(){}		

	public static function data($a){ global $CORE;
  
		$a['pricing1'] = array(
			"name" 		=> "Style 1",
			"image"		=> "pricing1.jpg",
			"cat"		=> "pricing",
			"widget" 	=> "ppt-pricing",
			"desc" 		=> "", 
			"order" => 1,
			"data" 		=> array( ),			
			"defaults" 	=> array(),
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $new_settings, $userdata, $settings;
	
		
		$settings = array( );  
		 
	  
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
  
  
  <div class="pricing-wrapper hide-mobile">
    <div class="container">
      <div class="row">
    
        <?php if(!empty($pricing_data)){

 $i=1; foreach($pricing_data as $pak){ 
  
 
 ?>
        <div class="<?php if(count($pricing_data) == 4){ ?>col-xl-3 col-lg-6 col-md-6 <?php }elseif(count($pricing_data) > 2){ ?>col-md-6  col-lg-4<?php }else{ ?>  col-lg-4 mx-auto<?php } ?>">
          
          <div class="price-box" ppt-border1>
          
          <?php if(isset($pak['active']) && $pak['active'] == "1"){?>
           <span class="featuredribbion hide-mobile shadow-sm"><?php echo __("Popular","premiumpress"); ?></span>
          <?php } ?>
           
           
            <ul class="pricing-list list-unstyled lh-30 mb-4">
            
              <li class="price-value <?php if($pak['price'] == 0 ){ echo "free ";} ?> <?php if(is_numeric($pak['price']) && $pak['price'] != "0"){ echo $CORE->GEO("price_formatting",array()); } ?> <?php if(count($pricing_data) > 3){ ?>price-set price-small<?php } ?>">
                <?php if($pak['price'] == "0"){ echo $pak['price_text']; }else{  echo $pak['price']; } ?>
              </li>
              
              <li class="price-title font-weight-bold mb-3"><?php echo $pak['title']; ?></li>
              
             
                <?php if(isset($pak['features']) && is_array($pak['features']) && !empty($pak['features']) ){ foreach($pak['features'] as $f){ ?>
		                                <li><i class="fa <?php if($f['value'] == "1"){?>fa-check<?php }else{ ?>fa-times<?php } ?> mr-2"></i> <?php echo $f['name']; ?></li>
		                                <?php } } ?>
              
            </ul>
            
            
            <div class="price-tagx btn-system link-dark btn-lg" data-ppt-btn>
            
            
             <?php if($pak['button'] == "existing"){ ?>
                                <a  href="#"><?php echo __("Current Plan","premiumpress"); ?></a>
                                <?php }else{ ?>
		                        <a  <?php echo $pak['button']; ?>><?php echo __("Select Package","premiumpress"); ?></a>
                                <?php } ?>
            
             
              
            </div>
          </div>
        </div>
    
        <?php $i++; } } ?>
      </div>
  
      
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

.bg-primary ul.pricing-list, 
.bg-dark ul.pricing-list, 
.bg-black ul.pricing-list, 
.bg-secondary ul.pricing-list, 
.bg-primary ul.pricing-list .text-muted, 
.bg-dark ul.pricing-list .text-muted, 
.bg-secondary ul.pricing-list .text-muted {
color:#fff !important; 
}
.bg-primary .bg-light ul.pricing-list, 
.bg-dark .bg-light ul.pricing-list, 
.bg-black .bg-light ul.pricing-list, 
.bg-secondary .bg-light ul.pricing-list, 
.bg-primary .bg-light ul.pricing-list .text-muted, 
.bg-dark .bg-light ul.pricing-list .text-muted, 
.bg-secondary .bg-light ul.pricing-list .text-muted  {
color:#111 !important; 
}
 
.bg-primary .price-box:not(.bg-light) .price-tag a, 
.bg-black .price-box:not(.bg-light) .price-tag a, 
.bg-dark .price-box:not(.bg-light) .price-tag a, 
.bg-secondary .price-box:not(.bg-light) .price-tag a { border: 1px solid #fff !important; color:#fff !important;  }

.price-box {
	position: relative;
    margin: 20px 10px 20px 5px;
    padding: 50px 10px 32px 10px;
    overflow: hidden;
    text-align: center;
    border: 1px solid #dfdfdf;
    background-color: transparent;
    border-radius: 8px 8px;
	transition: all 0.3s ease-in-out;
	-webkit-transition: all 0.3s ease-in-out;
}
 

ul.pricing-list{
	padding: 0 30px;
}

ul.pricing-list li.price-title{	
	font-size: 16px;
	line-height: 24px; 	 
}

ul.pricing-list li.price-value{	
	font-size: 70px;
	line-height: 70px;
	display: block;
	margin-bottom: 10px;	 
}

ul.pricing-list li.price-tiny { font-size:20px; }
ul.pricing-list li.price-small { font-size:40px; }
ul.pricing-list li.price-medium { font-size:60px; }

ul.pricing-list li.price-subtitle{	
	margin-bottom: 10px;
	font-size: 16px;
	line-height: 24px;
	 
}

ul.pricing-list li.price-text{
	display: block;	
	font-weight: 400;
	margin-bottom: 5px;
}
 
 
.price-tag a {
	 
	background: transparent;
	 border: 1px solid #111; 
	 color:#111; 
	border-radius: 5px 5px;
	padding: 15px 30px;
	display: inline-block;
	font-size: 15px;
	line-height: 24px;
	font-weight: 600;
	 
	transition: all 0.3s ease-in-out;
	-webkit-transition: all 0.3s ease-in-out;
}

.price-tag a:hover{
	background: #fff;
	border:1px solid #fff;
	color: #e84d3c;
}

.price-tag-line a{
	 
	background: transparent;
	border:1px solid #fff;
	border-radius: 5px 5px;
	padding: 15px 30px;
	display: inline-block;
	font-size: 15px;
	line-height: 24px;
	font-weight: 600;
	margin: 30px 0 5px 0;
	transition: all 0.3s ease-in-out;
	-webkit-transition: all 0.3s ease-in-out;
}

ul.pricing-list .price-tag-line a:hover{
	color: #e84d3c;
	background: #fff;
	border:1px solid #fff;
}

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