<?php
 
add_filter( 'ppt_blocks_args', 	array('block_category6',  'data') );
add_action( 'category6',  		array('block_category6', 'output' ) );
add_action( 'category6-css',  	array('block_category6', 'css' ) );
add_action( 'category6-js',  	array('block_category6', 'js' ) );

class block_category6 {

	function __construct(){}		

	public static function data($a){ 
  
		$a['category6'] = array(
			"name" 	=> "Style 6",
			"image"	=> "category6.jpg",
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
			 
		 	$settings =  $CORE->LAYOUT("get_block_settings_defaults_new", array("category", "category6" ) );
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
					"id" => $term->term_id,
					"name"	=> $terms->name,  
					"link"	=> get_term_link($terms), 
					"count"	=> $terms->count,  
					"image" => $img,
					"icon" 	=> do_shortcode('[CATEGORYIMAGE term_id="'.$terms->term_id.'" pathonly=1 placeholder=1 tax="'.$df['tax'].'"]'),
					); 
					
					$i++; 
				}
			
			// PARENT CAT
			}else{
			
			if(isset($df['image'.$i]) && strlen($df['image'.$i]) > 2){
			$img =  $df['image'.$i];
			}else{
				if($df['tax'] == "store"){
				$img = do_shortcode('[STOREIMAGE]');
				}else{
				$img = do_shortcode('[CATEGORYIMAGE term_id="'.$term->term_id.'" pathonly=1 placeholder=1 big=1 tax="'.$df['tax'].'"]');
				}
			}
			
			$data[] = array( 
				"id" => $term->term_id,
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

<section class="section-60">
<div class="container">
<div class="row">
 
<div class="col-6">
 
<div class="row">   
<?php $i = 1;  foreach($data as $cat){  


 
?>
 
<div class="col-lg-4 mb-2"><a href="<?php echo $cat['link']; ?>"><?php echo $cat['name']; ?></a></div>
 
 
<?php $i++; } ?>   

</div>
  
</div>
<div class="col-md-6">

<div class="pl-lg-5">

<div class="text-600 mb-3" data-ppt-title>Popular locations</div>

 
<div data-ppt-subtitle class="mb-4">

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.
 
</div>

<div data-ppt-desc>

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.
 
</div>

</div>
</div>  
</div>
</div>
</section>
<?php
		$output = ob_get_contents();
		ob_end_clean();
		
echo ppt_theme_block_output($output, $df, array("category", "category6"));

	
	}
		public static function css(){
		ob_start();
		?>
 
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