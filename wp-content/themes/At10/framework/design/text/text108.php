<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text108',  'data') );
add_action( 'text108',  		array('block_text108', 'output' ) );
add_action( 'text108-css',  	array('block_text108', 'css' ) );
add_action( 'text108-js',  	array('block_text108', 'js' ) );

class block_text108 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text108'] = array(
			"name" 		=> "Style 108",
			"image"		=> "text108.jpg",
			"cat"		=> array("text","icon"),
			"desc" 		=> "", 
			"order" 	=> 0, 
			"widget" => "ppt-text",	
			"data" 	=> array( ),	
			
			"defaults" => array( ), 
			
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $df, $text_settings;
	 	
		 
		  // ALL DEFAULT FIELDS
		 $df = ppt_theme_blocks_defaults("text"); 
		 
		 $cc = array(
		 	"image" => DEMO_IMGS."?fw=text108&t=".THEME_KEY,
			"btn1_show" => 1,
			"btn2_show" => 0,		 
		 );
		 
		 $df = array_merge($df, $cc);
		 
		// APPLY ELEMENTOR
		if(!empty($text_settings)){
			foreach($df as $k => $v){				
				if(isset($text_settings[$k]) && $text_settings[$k] != "" ){
					$df[$k] = $text_settings[$k];
				}
			}
			
		}else{		 
		 	$settings =  $CORE->LAYOUT("get_block_settings_defaults_new", array("text", "text108" ) );
		 	foreach($df as $h => $j){
				if(isset($settings[$h]) && $settings[$h] != ""){
					$df[$h] = $settings[$h];
				}
			 } 
		 }
		
	 
 
	ob_start();
	
	?> 
    
<section class="section-60 ppt-block-text">

  <div class="container">
 
    <div class="row align-items-center">
    
      <div class="col-lg-6 order-2">
      
        <div class="shadow-sm shadow-hover me-lg-6" ppt-border1>
          <div class="card-body p-md-4">
            <div class="d-flex flex-row">
              <div>
                <span class="number-box bg-primary text-light"><span class="number">01</span></span>
              </div>
              <div>
                <h4 class="mb-1" data-ppt-f1a>Create your free account</h4>
                <p class="mb-0" data-ppt-f1b>Nulla vitae elit libero pharetra augue dapibus.</p>
              </div>
            </div>
          </div>
  
        </div>
 
        <div class="shadow-sm shadow-hover ms-lg-13 mt-6" ppt-border1>
          <div class="card-body p-6">
            <div class="d-flex flex-row">
              <div>
                <span class="number-box bg-primary text-light"><span class="number">02</span></span>
              </div>
              <div>
                <h4 class="mb-1" data-ppt-f2a>Complete your details </h4>
                <p class="mb-0" data-ppt-f2b>Vivamus sagittis lacus vel augue laoreet.</p>
              </div>
            </div>
          </div>
       
        </div>
  
        <div class="shadow-sm shadow-hover mx-lg-6 mt-6" ppt-border1>
          <div class="card-body p-6">
            <div class="d-flex flex-row">
              <div>
                <span class="number-box bg-primary text-light"><span class="number">03</span></span>
              </div>
              <div>
                <h4 class="mb-1" data-ppt-f3a>Connect with users</h4>
                <p class="mb-0" data-ppt-f3b>Cras mattis consectetur purus sit amet.</p>
              </div>
            </div>
          </div>
    
        </div>
    
      </div>
  
      <div class="col-lg-6  pr-lg-5">
      
        <h2 class="mb-4" data-ppt-title>1,2,3 easy steps!</h2>
        
        <p class="lead mb-5" data-ppt-subtitle>Find out everything you need to know and more about how our website works.</p>
        
        <p data-ppt-desc>Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Nullam quis risus eget urna mollis ornare.</p>
        
         
          <?php if(THEME_KEY == "sp"){ ?>
        
          <?php if($df['btn1_show']){ ?>
          <a href="<?php echo home_url(); ?>/?s=" class="btn-lg btn-primary  mt-2 mobile-mb-4" data-ppt-btn data-ppt-btn-txt><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "start_search" ) ); ?></a>
          <?php } ?>
         
        <?php }else{ ?>
        
        <?php if($df['btn1_show']){ ?>
        <a href="<?php echo _ppt(array('links','add')); ?>" class="btn-lg btn-primary  mt-2 mobile-mb-4" data-ppt-btn data-ppt-btn-txt><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "addnew" ) ); ?></a>
        <?php } ?>
        <?php if($df['btn2_show']){ ?>
        <a href="<?php echo home_url(); ?>/?s=" class="btn-lg btn-primary  mt-2 mobile-mb-4" data-ppt-btn data-ppt-btn2-txt><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "start_search" ) ); ?></a>
        <?php } ?>
        
        <?php } ?>
         
     
      </div>
 
    </div>
 
  </div>
 
</section>
 
<?php
 

		$output = ob_get_contents();
		ob_end_clean();
echo ppt_theme_block_output($output,  $df, array("text", "text108"));
	
	}
		public static function css(){
		ob_start();
?>

<style>
.mt-6 {
    margin-top: 1.5rem!important;
}
@media (min-width: 992px){
.ms-lg-13 {
    margin-left: 4rem!important;
}
}

.number-box {
    width: 40px;
    height: 40px;
    font-size: 16px;
    display: inline-block;
    margin-right: 30px;
    border-radius: 100%;
    text-align: center;
    line-height: 40px;
    font-weight: 600;
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
