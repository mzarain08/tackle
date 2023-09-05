<?php
 
add_filter( 'ppt_blocks_args', 	array('block_stores6',  'data') );
add_action( 'stores6',  		array('block_stores6', 'output' ) );
add_action( 'stores6-css',  	array('block_stores6', 'css' ) );
add_action( 'stores6-js',  	array('block_stores6', 'js' ) );

class block_stores6 {

	function __construct(){}		

	public static function data($a){   global $CORE;
  
		$a['stores6'] = array(
			"name" 		=> "Style 6",
			"image"		=> "stores6.jpg",
			"cat"		=> "store",
			"desc" 		=> "", 
			"order" 	=> 6, 
			
			"data" 	=> array( ),
			
			
			"defaults" => array(
					
					"section_padding" => "section-80",
					"section_bg"	=>	"bg-light",	
					
					// TEXT						
					"title_show" 		=> "yes",
					"title_style" 		=> "1",
					"title_heading" 	=> "h2",
					"title_pos" 		=> "left",
					
					
					"title" 			=> "Featured Stores",					 
					"subtitle"			=>  "",					
					"desc" 				=> "Over 1,000 stores and coupons online right now - find the best deals and offers today!",
					 	
					"title_margin"		=> "mb-4",
					"subtitle_margin"	=> "",
					"desc_margin" 		=> "",					
					
					"title_font" 		=> "",
					"subtitle_font" 	=> "",
					"desc_font" 		=> "",
					 
					"title_txtcolor" 	=> "light",
					"subtitle_txtcolor" => "opacity-5",
					"desc_txtcolor" 	=> "opacity-5",
					
					"title_txtw" 		=> "",
					"subtitle_txtw" 	=> "",
					 
					
					// BUTTON					
					"btn_show" 			=> "yes",						
					"btn_style" 		=> "4",				
					"btn_size" 			=> "btn-md",
					"btn_icon" 			=> "",				
					"btn_icon_pos" 		=> "",
					"btn_font" 			=> "",
					"btn_txt" 			=> __("All Stores","premiumpress"),
					"btn_link" 			=> _ppt(array('links','stores')),
					"btn_bg" 			=> "light",
					"btn_bg_txt" 		=> "text-light",					
					"btn_margin" 		=> "mt-2",
				 
					
					 
			), 
						
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $new_settings, $settings;
	
	
		$settings = array( );  
		 
		// ADD ON SYSTEM DEFAULTS
		$settings = $CORE->LAYOUT("get_block_settings_defaults", array("stores6", "store", $settings ) );
	 
		// UPDATE DATA FROM ELEMENTOR OR CHILD THEMES
		if(is_array($new_settings)){
			 foreach($settings as $h => $j){
				if(isset($new_settings[$h]) && $new_settings[$h] != ""){
					$settings[$h] = $new_settings[$h];
				}
			 }
		} 
		
	 
$settings['card'] 			= "store";
$settings['custom'] 		= "stores";
$settings['datastring'] 	= "";
$settings['perrow'] 	= "5"; 
$randomID = rand();



	ob_start();
	
	?>

<section id="stores6-carousel-<?php echo $randomID; ?>" class="<?php echo $settings['section_class']." ".$settings['section_bg']." ".$settings['section_padding']." ".$settings['section_divider']; ?>">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="clearfix">
        </div>
        <?php if($settings['title_show'] == "yes"){ ?>
        <div class="d-flex mb-4 justify-content-between">
          <div>
            <h4 class="font-weight-bold mb-0 font-<?php echo $settings['title_font'];  ?> text-<?php echo $settings['title_txtcolor']; ?> <?php echo $settings['title_txtw']; ?>"><?php echo $settings['title']; ?></h4>
          </div>
          <div>
<a class="btn bg-white btn-sm text-muted prev px-2 mt-2 border"><i class="fa fa-angle-left px-1" aria-hidden="true"></i></a> <a class="btn bg-white btn-sm text-muted next px-2 mt-2 border"><i class="fa fa-angle-right px-1" aria-hidden="true"></i></a>
          </div>
        </div>
        <?php } ?>
        <div  class="owl-carousel owl-theme" id="stores6"  data-1000="4" data-600="4">
          <?php
		
$termdata = get_terms('store', 'orderby=term_order&hide_empty=0&number=10');
$start= 1;
$per_page 	= 10;
$total_merchants = count($termdata);  
         
$i=1; $sf = 0;
foreach ($termdata as $term) { 

if($i > 10){ continue;}
	 
	// LINK 
	$link = get_term_link($term); 
	
	// ICON
	$icon = do_shortcode('[CATEGORYIMAGE term_id="'.$term->term_id.'" pathonly=1 placeholder=1 tax="store"]');
	
	// IMAGE
	$img = do_shortcode('[CATEGORYIMAGE term_id="'.$term->term_id.'" pathonly=1 small=0 placeholder=1 tax="store"]');
	
	// TITLE
	if( defined('WLT_DEMOMODE') ){ 
		$did = filter_var($term->name, FILTER_SANITIZE_NUMBER_INT);			 
		if(is_numeric($did) && isset($GLOBALS['CORE_THEME']['storedata'][$did]['title'])){		
			$title =  $GLOBALS['CORE_THEME']['storedata'][$did]['title'];	
		}else{	
			$title = $CORE->GEO("translation_tax", array($term->term_id, $term->name)); 
		}
	 
	}else{ $title =$CORE->GEO("translation_tax", array($term->term_id, $term->name));  }
?>
          <div class="card-ppt-search border-0 mb-0 shadow-sm">
            <figure class="p-0 border-0"> <a href="<?php echo $link; ?>"> <img src="<?php echo $img; ?>" class="img-fluid" alt="<?php echo $term->name; ?>">
              <div class="read_more">
                <span><?php echo __("view","premiumpress"); ?></span>
              </div>
              </a> </figure>
            <div class="card-body position-relative border-top">
              <a href="<?php echo $link; ?>"><div class="bg-white imagebox"><img src="<?php echo $icon; ?>" class="img-fluid shadow-sm hide-mobile" /></div></a>
              <h3 class="mt-1 h2 link-dark"><a href="<?php echo $link; ?>"><?php echo  $title; ?></a></h3>
            </div>
          </div>
          <?php $i++; } ?>
        </div>
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
#stores6 .owl-stage-outer { padding-bottom:10px; }
#stores6 .owl-stage-outer .card-body .imagebox { width:100px; position:absolute; right:10px; top:-50px; }
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
