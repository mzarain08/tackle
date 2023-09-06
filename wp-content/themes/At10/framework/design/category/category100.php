<?php
 
add_filter( 'ppt_blocks_args', 	array('block_category100',  'data') );
add_action( 'category100',  		array('block_category100', 'output' ) );
add_action( 'category100-css',  	array('block_category100', 'css' ) );
add_action( 'category100-js',  	array('block_category100', 'js' ) );

class block_category100 {

	function __construct(){}		

	public static function data($a){ 
  
		$a['category100'] = array(
			"name" 	=> "Style 100",
			"image"	=> "category100.jpg",
			"cat"	=> "category",
			"widget" => "ppt-category",
			"desc" 	=> "", 
			"data" 	=> array(  ),
			"order" => 1,	
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $category_settings, $settings;
	
	
		// ALL DEFAULT FIELDS
		 $df = ppt_theme_blocks_defaults("category"); 
		  
		// APPLY CUSTOM CHANGES 
		$cc = array(
		"tax" 		=> "listing",
		"btn_show" => 1,
		 );
		 

		$df = array_merge($df, $cc);
		
		
		// 1. ELEMENTOR
		if(!empty($category_settings)){
			foreach($df as $k => $v){				
				if(isset($category_settings[$k]) && $category_settings[$k] != "" ){
					$df[$k] = $category_settings[$k];
				}
			}
			
		// 2. HOME DESIGNS		
		}else{	
			 
		 	$settings =  $CORE->LAYOUT("get_block_settings_defaults_new", array("category", "category100" ) );
		 	foreach($df as $h => $j){
				if(isset($settings[$h]) && $settings[$h] != ""){
					$df[$h] = $settings[$h];
				}
			 } 
		}
		    

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
	
	$limit = 100;
	if(isset($df['limit']) && $df['limit'] > 0){
	$limit = $df['limit'];
	} 
	
	$hide_empty = 1;
	if(isset($df['hide_empty']) && $df['hide_empty'] !=""){
	$hide_empty = $df['hide_empty'];
	} 
	
	$orderby = "menu_order";
	if(isset($df['orderby']) && $df['orderby'] != ""){
		$orderby = $df['orderby'];
	} 
	
	$order = "desc";
	if(isset($df['order']) && $df['order'] != ""){
		$order = $df['order'];
	} 
 
	$showOnlyCats = array();	
	if(!empty($df['cat'])){
		$showOnlyCats = $df['cat'];
		if(!is_array($showOnlyCats)){
		$showOnlyCats = array($showOnlyCats);
		}
	}
	
	
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

  
	$termdata = get_terms($df['tax'], 'orderby='.$orderby.'&order='.$order.'&hide_empty='.$hide_empty.'&parent=0');
	if(is_wp_error( $termdata )){ 
		echo $termdata->get_error_message(); 
		return;
	}
	$total_merchants = count($termdata);
 
	$data = array(); $i=1;
	foreach ($termdata as $term) {
 	
			if(!empty($showOnlyCats) && !in_array($term->term_id,$showOnlyCats)){
			continue; 
			}
			
			if($i > $limit){
			$i++; continue;
			}
 
			// SUB CATS ONLY
			if(isset($df['cat_subs']) && $df['cat_subs'] == "1"){
			 
				$termdatasub = get_terms($df['tax'], 'orderby=count&order=desc&hide_empty='.$hide_empty.'&parent='.$term->term_id);
				if(is_wp_error( $termdatasub )){ 
					echo $termdatasub->get_error_message(); 
					return;
				}
				  
				foreach ($termdatasub as $terms) {
				
					if($i > $limit){
					 continue;
					}
					
					if(isset($df['image'.$i]) && strlen($df['image'.$i]) > 2){
					$img =  $df['image'.$i];
					}else{
					$img = do_shortcode('[CATEGORYIMAGE term_id="'.$terms->term_id.'" pathonly=1 placeholder=1 big=1 tax="'.$df['tax'].'"]');
					}
						
					$data[] = array( 
					"name"	=> $terms->name,  
					"link"	=> get_term_link($terms), 
					"count"	=> $terms->count,  
					"image" => $img,
					"icon" 	=> do_shortcode('[CATEGORYIMAGE term_id="'.$terms->term_id.'" pathonly=1 placeholder=1 tax="'.$df['tax'].'"]'),
					"css" => "",
					); 
					
					$i++; 
				}
			
			// PARENT CAT
			}else{
			
			if($df['tax'] == "store"){
			$image = do_shortcode('[STOREIMAGE]');
	 		}else{
			$image = do_shortcode('[CATEGORYIMAGE term_id="'.$term->term_id.'" pathonly=1 placeholder=1 big=1 tax="'.$df['tax'].'"]');
			}
			
			if(isset($df['image'.$i]) && strlen($df['image'.$i]) > 2){
			$img =  $df['image'.$i];
			}else{
			$img = $image;
			}
			
			$data[] = array( 
				"name"	=> $term->name,  
				"link"	=> get_term_link($term), 
				"count"	=> $term->count,  
				"image" => $img,
				"icon" 	=> do_shortcode('[CATEGORYIMAGE term_id="'.$term->term_id.'" pathonly=1 placeholder=1 tax="'.$df['tax'].'"]'),
				"css" => "",
			);
			
			
			
			$i++; 
			
			}
	
	} 
	
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
		
	ob_start();
	?>

<section class="section-60">
<div class="container">
<div class="row">
  <div class="col-12">
    <h2 class="mb-5" data-ppt-title><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("short", "pop_cats" ) ); ?></h2>
  </div>

<div class="col-12 show-mobile px-0"><div class="row">
<?php foreach($data as $cat){ ?>
<div class="col-lg-3 col-md-4 col-4 col-lg-5ths ">
        <div class="card shadow-sm mb-md-4 card-mobile-transparent">
          <div class="card-body text-center card-hover">           
            <a href="<?php echo $cat['link']; ?>" class="text-decoration-none text-dark">            
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
    <div class="listing1-carousel-1 owl-carousel owl-theme" data-0="1" data-1200="5" data-1000="5" data-margin="10">
    <?php foreach($data as $cat){ ?>
          <div class="p-2">
            <div class="overflow-hidden ppt-card-category100 style2 <?php echo $cat['css']; ?>">
              <div class="bg-gradient" style="z-index:1;">&nbsp;</div>
              <figure>
                <div class="bg-image" data-bg="<?php echo $cat['image']; ?>">&nbsp;</div>
              </figure>
              <a href="<?php echo $cat['link']; ?>">
              <h4><?php echo $cat['name']; ?></h4>
              </a>
            </div>
          </div>
    <?php } ?>
    </div>
</div>
</div>

  

</div>
</section>
<?php
 

		$output = ob_get_contents();
		ob_end_clean();
		
echo ppt_theme_block_output($output, $df, array("category", "category100"));

	
	}
		public static function css(){
		ob_start();
		?>
<style>
 
.ppt-card-category100 figure{margin:0}
.ppt-card-category100 img{transition:all linear .25s}
.ppt-card-category100{background-color:#fff;box-shadow:0 0 25px rgba(0,0,0,.1);background-position:center;overflow:hidden;position:relative; transition:all linear .25s; width: 100%; border-radius: 10px; height:290px; min-width:200px;  }
.ppt-card-category100 h4{ z-index: 2; position:absolute;font-size:25px;font-weight:700;color:#fff;transition:all linear .25s;text-shadow:0 0 20px rgba(0,0,0,.5)}
.ppt-card-category100.style1 h4{ text-align:left;top:10px;left:10px;padding:15px 20px;background:linear-gradient(140deg,rgba(0,0,0,.4) 0,rgba(255,255,0,0) 50%);transition:all linear .25s;min-width:150px;min-height:150px}
.ppt-card-category100.style1:hover h4{top:15px;left:15px}.ppt-card-category100.style1 h4 span{position:absolute;bottom:40px;left:25px;color:#fff;font-size:13px;transition:all linear .25s}
.ppt-card-category100.style1:hover img{filter:brightness(80%)}
.ppt-card-category100.style2 h4{left:30px;bottom:20px;font-size:30px;color:#fff}.ppt-card-category100.style2 h4 span{position:absolute;bottom:-25px;left:0;color:#fff;font-size:13px;transition:all linear .25s}
.ppt-card-category100.style2:hover img{filter:grayscale(100%)}
.ppt-card-category100.style2:hover h4{bottom:50px;  }
.ppt-card-category100.style3 h4{left:0;bottom:20px;text-align:center;width:100%;font-size:30px;color:#fff}
.ppt-card-category100.style3 h4 span{font-size:13px;display:block}.ppt-card-category100.style3:hover img{filter:grayscale(100%)}
.ppt-card-category100.style3:hover h4{bottom:30px}  


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
