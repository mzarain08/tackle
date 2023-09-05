<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text129',  'data') );
add_action( 'text129',  		array('block_text129', 'output' ) );
add_action( 'text129-css',  	array('block_text129', 'css' ) );
add_action( 'text129-js',  	array('block_text129', 'js' ) );

class block_text129 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text129'] = array(
			"name" 		=> "Style 129",
			"image"		=> "text129.jpg",
			"cat"		=> "text",
			"desc" 		=> "", 
			"order" 	=> 0, 
			"widget" => "ppt-text",	
			"data" 	=> array( ),	
			
			"defaults" => array( ), 
			
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $text_settings;
	 	
		 
		 $df = array(
		 	"image1" => DEMO_IMGS."?fw=text129a&t=".THEME_KEY,
			"image2" => DEMO_IMGS."?fw=text129b&t=".THEME_KEY,
			"image3" => DEMO_IMGS."?fw=text129c&t=".THEME_KEY,
			"image4" => DEMO_IMGS."?fw=text129d&t=".THEME_KEY,
			
			"image1-txt" => $CORE->LAYOUT("get_placeholder_text_new", array("text129a", "t" ) ),
			"image2-txt" => $CORE->LAYOUT("get_placeholder_text_new", array("text129b", "t" ) ),
			"image3-txt" => $CORE->LAYOUT("get_placeholder_text_new", array("text129c", "t" ) ),
			"image4-txt" => $CORE->LAYOUT("get_placeholder_text_new", array("text129d", "t" ) ),
 
			"image1-txt1" => $CORE->LAYOUT("get_placeholder_text_new", array("text129a", "s" ) ),
			"image2-txt1" => $CORE->LAYOUT("get_placeholder_text_new", array("text129b", "s" ) ),
			"image3-txt1" => $CORE->LAYOUT("get_placeholder_text_new", array("text129c", "s" ) ),
			"image4-txt1" => $CORE->LAYOUT("get_placeholder_text_new", array("text129d", "s" ) ),
					
			"btn_show" => 0,
			"btn2" => 0, 
			
		 );
		  
		 
		 if(is_array($text_settings) && !empty($text_settings)){		 	
			
			 // UPDATE DATA FROM ELEMENTOR OR CHILD THEMES
			 
				 foreach($text_settings as $h => $j){
					if(isset($text_settings[$h]) && $text_settings[$h] != ""){
						$df[$h] = $text_settings[$h];
					}
				 }
			 
			
			 
			 $df['btn_show'] = $text_settings['btn_show'];
			 $df['btn2'] = $text_settings['btn2_show'];
			 
			 
		 }
		  
	 
 
	ob_start();
	
	
	$data = array();
	$i=1; while($i < 5){
			$data[] = array( 
				"image" =>  $df['image'.$i],				 
				"name"	=> $df['image'.$i.'-txt'],
				"desc"	=> $df['image'.$i.'-txt1'],
				"css"	=> "ppt-h350",
				"link"	=> home_url()."/?s=", 
			); 
	
	$i++;
	}
	
	?>

<section class="section-40 bg-soft">
  <div class="container">
    <div class="row">
     
<div class="col-12 mb-4">
<h2 data-ppt-title><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("short", "latest_deals" ) ); ?></h2>
</div>
        
<div class="col-12">
<div class="show-mobile px-0">
<?php foreach($data as $cat){ ?>
 <a href="<?php echo $cat['link']; ?>" class="text-decoration-none text-dark bg-white link-dark btn-block border shadow-sm p-2 rounded">
  
<div class="d-flex"> 
   
    <div style="width:80px; height:50px;" class="bg-light mr-4 rounded overflow-hidden position-relative">
    <div class="overlay-inner z-1">&nbsp;</div>
    <div class="bg-image" data-bg="<?php echo $cat['image']; ?>" >&nbsp;</div>
    </div> 

	<div class="w-100"> 
    <div class="d-flex justify-content-between">
    
        <div class="mt-2">
		
		<div class="text-700"><?php echo $cat['name']; ?></div>
        
        <div class="tiny opacity-5"><?php echo $cat['desc']; ?></div>
        
        </div>     
         
        <i class="fa fa-chevron-right fa-2x mt-2 mr-2">&nbsp;</i> 
        
    </div>   
    	 
 	</div> 
   
</div>

</a>
<?php } ?>    
</div>
</div>         
            
<div class="col-12 hide-mobile">
        <div class="row">
    <?php $i=1; foreach($data as $cat){ ?>
         <div class="col-12 col-md-6 col-lg-3 mb-4">
            <div class="overflow-hidden text129-card style3 <?php echo $cat['css']; ?>">
              <div class="bg-gradient" style="z-index:1;">&nbsp;</div>
              <figure>
                <div class="bg-image" data-bg="<?php echo $cat['image']; ?>"  data-ppt-image<?php echo $i; ?>-bg>&nbsp;</div>
              </figure>
              <a href="<?php echo $cat['link']; ?>" data-ppt-image<?php echo $i; ?>-link>
              <h4> <strong data-ppt-image<?php echo $i; ?>-txt><?php echo $cat['name']; ?></strong> <span data-ppt-image<?php echo $i; ?>-txt1><?php echo $cat['desc']; ?></span> </h4>
              </a>
            </div>
          </div>
    <?php $i++; } ?>        
        </div> 
</div>
      
      
 <?php if($df['btn_show']){ ?>
      <div class="col-12 text-center my-sm-4">        
        <a href="<?php echo home_url()."/?s="; ?>" class="btn-lg btn-primary btn-rounded-25  mt-2 btn-icon icon-after" data-ppt-btn data-ppt-btn-link>
        <span data-ppt-btn-txt><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "start_search" ) ); ?></span> <i class="fa fa-long-arrow-alt-right">&nbsp;</i>
        </a>       
</div>
<?php } ?>
       
    </div>
  </div>
</section>
<?php

$output = ob_get_contents();
ob_end_clean();
echo ppt_theme_block_output($output, $text_settings, array("text", "text129"));
	
	}
		public static function css(){
		ob_start();
		?>
<style>
 
.text129-card figure{margin:0}
.text129-card img{transition:all linear .25s}
.text129-card{background-color:#fff;box-shadow:0 0 25px rgba(0,0,0,.1);background-position:center;overflow:hidden;position:relative; transition:all linear .25s; width: 100%; border-radius: 10px; height:320px; min-width:200px;  }
.text129-card h4{ z-index: 2; position:absolute;font-size:25px;font-weight:700;color:#fff;transition:all linear .25s;text-shadow:0 0 20px rgba(0,0,0,.5)}
.text129-card h4 strong { font-weight:600; } 

[data-ppt-blockid="text129"] .show-mobile a { color:#000; }
 
[data-ppt-blockid="text129"].bg-primary .show-mobile a { color:#fff; }
 
.text129-card.style3 h4{left:0;bottom:20px;text-align:center;width:100%;font-size:30px;color:#fff; line-height:40px; }
.text129-card.style3 h4 span{font-size:13px;display:block}.text129-card.style3:hover img{filter:grayscale(100%)}
.text129-card.style3:hover h4{bottom:30px}   


.mobile-icon-text { font-size:14px !important; }
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