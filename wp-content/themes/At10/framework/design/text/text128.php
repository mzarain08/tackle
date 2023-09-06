<?php
 
add_filter( 'ppt_blocks_args', 	array('block_text128',  'data') );
add_action( 'text128',  		array('block_text128', 'output' ) );
add_action( 'text128-css',  	array('block_text128', 'css' ) );
add_action( 'text128-js',  	array('block_text128', 'js' ) );

class block_text128 {

	function __construct(){}		

	public static function data($a){  global $CORE;
  
		$a['text128'] = array(
			"name" 		=> "Style 128",
			"image"		=> "text128.jpg",
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
		 	"image1" => DEMO_IMGS."?fw=text124a&t=".THEME_KEY,
			"image2" => DEMO_IMGS."?fw=text124b&t=".THEME_KEY,
			"image3" => DEMO_IMGS."?fw=text124c&t=".THEME_KEY,
			"image4" => DEMO_IMGS."?fw=text124d&t=".THEME_KEY,
			
			"image1-txt" => $CORE->LAYOUT("get_placeholder_text_new", array("text124a", "t" ) ),
			"image2-txt" => $CORE->LAYOUT("get_placeholder_text_new", array("text124b", "t" ) ),
			"image3-txt" => $CORE->LAYOUT("get_placeholder_text_new", array("text124c", "t" ) ),
			"image4-txt" => $CORE->LAYOUT("get_placeholder_text_new", array("text124d", "t" ) ),
 
			"image1-txt1" => "Pellentesque nec lacus elit.",
			"image2-txt1" => "Pellentesque nec lacus elit.",
			"image3-txt1" => "Pellentesque nec lacus elit.",
			"image4-txt1" => "Pellentesque nec lacus elit.",
					
			"btn1" => 0,
			"btn2" => 0, 
			
		 );
		 
		 
		 if(is_array($text_settings) && !empty($text_settings)){		 	
			
			 // UPDATE DATA FROM ELEMENTOR OR CHILD THEMES
			 
				 foreach($text_settings as $h => $j){
					if(isset($text_settings[$h]) && $text_settings[$h] != ""){
						$df[$h] = $text_settings[$h];
					}
				 }
			 
			
			 
			 $df['btn1'] = $text_settings['btn_show'];
			 $df['btn2'] = $text_settings['btn2_show'];
			 
			 
		 }
		 
		 
	$termdata = get_terms('listing', 'orderby=count&order=desc&hide_empty=0&number=9&parent=0');
	$total_merchants = count($termdata);
 
	$catdata = array();
	foreach ($termdata as $term) {
	 
			$catdata[] = array(  
				"icon" 	=> do_shortcode('[CATEGORYIMAGE term_id="'.$term->term_id.'" pathonly=1 placeholder=1 tax="listing"]'),
				"name"	=> $term->name,
				 
				"css"	=> "ppt-h350",
				"link"	=> get_term_link($term), 
			); 
	 
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

<section class="section-60">
  <div class="container">
    <div class="row">
      <div class="container">
        <div class="row">
           
          <div class="col-12 mb-4">
           
              <h2 data-ppt-title><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("short", "pop_cats" ) ); ?></h2>
               
        </div>
            
<div class="col-12 show-mobile px-0"><div class="row">
<?php foreach($catdata as $cat){ ?>
<div class="col-lg-3 col-md-4 col-4 col-lg-5ths ">
        <div class="card shadow-sm mb-md-4 card-mobile-transparent">
          <div class="card-body text-center card-hover">           
            <a href="<?php echo $cat['link']; ?>" class="text-decoration-none">            
            <div class="row">
              <div class="col-12 col-md-12">
                <img data-src="<?php echo $cat['icon']; ?>" class="img-fluid mb-3 lazy" alt="<?php echo $cat['name']; ?>" />
              </div>              
              <div class="col-12  col-md-12">
                <div class="mobile-icon-text text-600"><?php echo $cat['name']; ?></div>
              </div>              
            </div>
              </a>
          </div>
        
        </div>
</div>
<?php } ?>    
</div></div>
            
            
    <div class="col-12 hide-mobile">
        <div class="row">
    <?php $i=1; foreach($data as $cat){ ?>
         <div class="col-12 col-md-6 col-lg-3 mb-4">
            <div class="overflow-hidden text128-card style3 <?php echo $cat['css']; ?>">
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
       <?php if($df['btn1']){ ?>
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
echo ppt_theme_block_output($output, $text_settings, array("text", "text128"));
	
	}
		public static function css(){
		ob_start();
		?>
<style>
 
.text128-card figure{margin:0}
.text128-card img{transition:all linear .25s}
.text128-card{background-color:#fff;box-shadow:0 0 25px rgba(0,0,0,.1);background-position:center;overflow:hidden;position:relative; transition:all linear .25s; width: 100%; border-radius: 10px; height:320px; min-width:200px;  }
.text128-card h4{ z-index: 2; position:absolute;font-size:25px;font-weight:700;color:#fff;transition:all linear .25s;text-shadow:0 0 20px rgba(0,0,0,.5)}
.text128-card h4 strong { font-weight:600; } 

[data-ppt-blockid="text128"] .show-mobile a { color:#000; }
 
[data-ppt-blockid="text128"].bg-primary .show-mobile a { color:#fff; }
 
.text128-card.style3 h4{left:0;bottom:20px;text-align:center;width:100%;font-size:30px;color:#fff; line-height:40px; }
.text128-card.style3 h4 span{font-size:13px;display:block}.text128-card.style3:hover img{filter:grayscale(100%)}
.text128-card.style3:hover h4{bottom:30px}   


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