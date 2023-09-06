<?php
 
add_filter( 'ppt_blocks_args', 	array('block_category2',  'data') );
add_action( 'category2',  		array('block_category2', 'output' ) );
add_action( 'category2-css',  	array('block_category2', 'css' ) );
add_action( 'category2-js',  	array('block_category2', 'js' ) );

class block_category2 {

	function __construct(){}		

	public static function data($a){ 
  
		$a['category2'] = array(
			"name" 	=> "Style 2 - Basic List",
			"image"	=> "category2.jpg",
			"cat"	=> "category",
			"widget" => "ppt-category",
			"desc" 	=> "", 
			"data" 	=> array(  ),
			"order" => 2,			
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $category_settings, $settings;
 
		// ALL DEFAULT FIELDS
		 $df = ppt_theme_blocks_defaults("category"); 
		  
		// APPLY CUSTOM CHANGES 
		$cc = array(
		"tax" 		=> "listing",
		"btn_show" => 1,
		"section_padding" => "section-top-40",
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
			 
		 	$settings =  $CORE->LAYOUT("get_block_settings_defaults_new", array("category", "category2" ) ); 
			
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
					"icon" 	=> do_shortcode('[CATEGORYIMAGE term_id="'.$terms->term_id.'" pathonly=1 placeholder=1 tax="listing"]'),
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
			); 
			
			$i++; 
			
			}
	
	} 
	
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

	ob_start();
	?>

<section>
  <div class="container">
    <div class="row mb-3">
      <div class="col-md-12 mb-4">
        <div class="text-600 d-md-flex justify-content-between align-items-center">
          <div>
            <h2 data-ppt-title><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("short", "pop_cats" ) ); ?></h2>
            <div class="my-3" data-ppt-desc>
              Lorem ipsum dolor sit amet, consectetur adipiscing elit.
            </div>
          </div>
          <div>
          
          <?php if($df['btn_show']){ ?>
            <a href="<?php echo home_url(); ?>/?s=" class="btn-rounded-25 btn-lg btn-system btn-icon icon-after" data-ppt-btn data-ppt-btn-link> <span data-ppt-btn-txt><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "search_all" ) ); ?></span> <i class="fa fa-long-arrow-alt-right">&nbsp;</i> </a> 
            
            <?php } ?>
            
            
          </div>          
        </div>
      </div>
      <?php $i=1; foreach($data as $cat){ ?>
      <div class="col-md-4 col-lg-3 mb-3">
        <a href="<?php echo $cat['link']; ?>" class="text-decoration-none text-dark">
        <div class="text-600 d-flex justify-content-between">
          <div>
            <?php echo $cat['name']; ?>
          </div>
          <div>
            <?php echo number_format($cat['count'],0); ?>
          </div>
        </div>
        </a>
      </div>
      <?php $i++; } 


?>
    </div>
  </div>
</section>
<?php
		$output = ob_get_contents();
		ob_end_clean();
		
echo ppt_theme_block_output($output, $df, array("category", "category2"));

	
	}
		public static function css(){
		ob_start();
		?>
<style>
 
 
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