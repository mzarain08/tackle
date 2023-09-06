<?php
 
add_filter( 'ppt_blocks_args', 	array('block_category7',  'data') );
add_action( 'category7',  		array('block_category7', 'output' ) );
add_action( 'category7-css',  	array('block_category7', 'css' ) );
add_action( 'category7-js',  	array('block_category7', 'js' ) );

class block_category7 {

	function __construct(){}		

	public static function data($a){ 
  
		$a['category7'] = array(
			"name" 	=> "Style 6",
			"image"	=> "category7.jpg",
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
		"btn_show"  => 1, 
		
		"image1" => DEMO_IMG_PATH."icons/cat1.png",
		"image2" => DEMO_IMG_PATH."icons/cat2.png",
		"image3" => DEMO_IMG_PATH."icons/cat3.png",
		"image4" => DEMO_IMG_PATH."icons/cat4.png",
		"image5" => DEMO_IMG_PATH."icons/cat5.png",
		"image6" => DEMO_IMG_PATH."icons/cat6.png",
		
		
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
			 
		 	$settings =  $CORE->LAYOUT("get_block_settings_defaults_new", array("category", "category7" ) );
		 	foreach($df as $h => $j){
				if(isset($settings[$h]) && $settings[$h] != ""){
					$df[$h] = $settings[$h];
				}
			 } 
		}
		    

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
	
	$limit = 6;
	if(isset($df['limit']) && $df['limit'] > 0){
	$limit = $df['limit'];
	} 
	
	$hide_empty = 0;
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
  
			
			if(isset($df['image'.$i]) && strlen($df['image'.$i]) > 2){
				$img =  $df['image'.$i];
			}else{
				if($df['tax'] == "store"){
					$img = do_shortcode('[STOREIMAGE]');
				}else{
					$img = do_shortcode('[CATEGORYIMAGE term_id="'.$term->term_id.'" pathonly=1 placeholder=1 big=1 tax="'.$df['tax'].'"]');
				}
			}
			
			$data[$term->term_id] = array( 
				"id" => $term->term_id,
				"name"	=> $term->name,  
				"link"	=> get_term_link($term), 
				"count"	=> $term->count,  
				"image" => $img,
				"icon" 	=> do_shortcode('[CATEGORYIMAGE term_id="'.$term->term_id.'" pathonly=1 placeholder=1 tax="'.$df['tax'].'"]'),
				"subs" => array(),
			); 
			
			
				$termdatasub = get_terms($df['tax'], 'orderby=count&order=desc&hide_empty=0&parent='.$term->term_id);
				if(is_wp_error( $termdatasub )){ 
					 
				}else{
				
					$si=1;
					foreach ($termdatasub as $sub) {
					
						if($si > 10){
						 continue;
						}
						
						if(isset($df['image'.$si]) && strlen($df['image'.$si]) > 2){
						
						$img =  $df['image'.$si];
						
						}else{
							if($df['tax'] == "store"){
							$img = do_shortcode('[STOREIMAGE]');
							}else{
							$img = do_shortcode('[CATEGORYIMAGE term_id="'.$sub->term_id.'" pathonly=1 placeholder=1 big=1 tax="'.$df['tax'].'"]');
							}
						}
						
							
						$data[$term->term_id]['subs'][$sub->term_id] = array( 
						"id" => $sub->term_id,
						"name"	=> $sub->name,  
						"link"	=> get_term_link($sub), 
						"count"	=> $sub->count,  
						"image" => $img,
						"icon" 	=> do_shortcode('[CATEGORYIMAGE term_id="'.$sub->term_id.'" pathonly=1 placeholder=1 tax="'.$df['tax'].'"]'),
						); 
						
						$si++; 
					}
				
				
				} 
			
			
			$i++; 
			
		 
	
	}  
	
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

	ob_start();
	?>

<section class="section-60 featured-categories">
 
 

<div class="container">
<div class="row">

<?php if($df['title_show'] != "0"){ ?>
<div class="col-12 text-center mb-4">

<div class="text-600 mb-3 fs-lg" data-ppt-title>Featured Categories</div>
 
<div data-ppt-subtitle class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>

</div>
<?php } ?>

<?php $si = 1; foreach($data as $cat){   ?>
<div class="col-lg-4 col-md-6 col-12">

<div class="single-category">
<h3 class="heading"><?php echo $cat['name']; ?></h3>
<ul>
<?php $i=1; foreach($cat['subs'] as $sub){ if($i > 5){ continue; }  ?>
<li><a href="<?php echo $sub['link']; ?>"><?php echo $sub['name']; ?></a></li>
<?php $i++; } ?>
</ul>
<div class="images">
<img data-src="<?php echo $df['image'.$si]; ?>" alt="<?php echo $cat['name']; ?>" class="lazy" data-ppt-image1>
</div>
</div>

</div>
<?php $si++; } ?>


 
 
</div>
</div>
</section>
<?php
		$output = ob_get_contents();
		ob_end_clean();
		
echo ppt_theme_block_output($output, $df, array("category", "category7"));

	
	}
		public static function css(){
		ob_start();
		?>
<style>
.featured-categories .single-category {
    padding: 40px;
    margin-top: 30px;
    border: 2px solid #f0f0f0;
    position: relative;
    background: #fff;
    z-index: 0;
}
.featured-categories .single-category .heading {
    font-size: 17px;
    font-weight: 700;
    color: #081828;
}
.featured-categories .single-category ul {
    margin-top: 20px;
}
.featured-categories .single-category ul li a {
    color: #666;
}
.featured-categories .single-category ul li {
    display: block;
    margin-bottom: 4px;
}
.featured-categories .single-category ul li a:hover {
    color: #0167F3;
    padding-left: 5px;
}
.featured-categories .single-category img {
    position: absolute;
    right: 0;
    top: 50%;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
    z-index: -1;
	max-width: 200px;
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