<?php
 
add_filter( 'ppt_blocks_args', 	array('block_category103',  'data') );
add_action( 'category103',  		array('block_category103', 'output' ) );
add_action( 'category103-css',  	array('block_category103', 'css' ) );
add_action( 'category103-js',  	array('block_category103', 'js' ) );

class block_category103 {

	function __construct(){}		

	public static function data($a){ 
  
		$a['category103'] = array(
			"name" 	=> "Style 103",
			"image"	=> "category103.jpg",
			"cat"	=> "category",
			"widget" => "ppt-category",
			"desc" 	=> "", 
			"data" 	=> array(  ),
			"order" => 3,			
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
			 
		 	$settings =  $CORE->LAYOUT("get_block_settings_defaults_new", array("category", "category103" ) );
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
					$img = do_shortcode('[CATEGORYIMAGE term_id="'.$terms->term_id.'" pathonly=1 placeholder=1 tax="'.$df['tax'].'"]');
					}
						
					$data[] = array( 
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
		
	ob_start();
	?>

<section class="section-40">
<div class="container">
<div class="row">
  <div class="col-md-6">
    <h2 class="mb-4 text-light" data-ppt-title><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("short", "pop_cats" ) ); ?></h2>
  </div>
 <div class="col-md-6 hide-mobile text-right">
 <a href="<?php if($tax == "store"){ echo _ppt(array('links','stores')); }else{ echo _ppt(array('links','categories')); } ?>" class="btn btn-system"><?php echo __("View All","premiumpress"); ?></a>
 </div>
 
<div class="col-12 hide-mobile">

<div class="listing1-carousel-1 owl-carousel owl-theme" data-0="1" data-1200="5" data-1000="5" data-margin="10">
<?php $i=1; foreach($data as $cat){ ?>
 
        <div class="card shadow-sm mb-md-4 card-mobile-transparent">
          <div class="card-body text-center card-hover">           
            <a href="<?php echo $cat['link']; ?>" class="text-decoration-none text-dark">            
            <div class="row">
              <div class="col-12 col-md-12">
                <img <?php if($i > 5){ ?>data-<?php } ?>src="<?php echo $cat['icon']; ?>" class="img-fluid mb-3 lazy" alt="<?php echo $cat['name']; ?>" />
              </div>              
              <div class="col-12  col-md-12">
                <div class="mobile-icon-text text-600"><?php echo $cat['name']; ?></div>
              </div>              
            </div>
              </a>
          </div>
        
       
</div>
<?php $i++; } ?>    
</div></div> 
 
 
<?php

// MOBILE
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


?> 
<div class="col-12 show-mobile"><div class="row">
<?php $i=1; foreach($data as $cat){ if($i > 9){ continue; } ?>
<div class="col-lg-3 col-md-4 col-4 col-lg-5ths ">
        <div class="card mb-md-4 card-mobile-transparent">
          <div class="card-body text-center card-hover">           
            <a href="<?php echo $cat['link']; ?>" class="text-decoration-none text-dark">            
            <div class="row">
              <div class="col-12 col-md-12">
                <div class="card p-2"><img data-src="<?php echo $cat['icon']; ?>" class="img-fluid lazy" alt="<?php echo $cat['name']; ?>" /></div>
              </div>              
              <div class="col-12  col-md-12">
                <div class="mobile-icon-text text-600 my-2"><?php echo $cat['name']; ?></div>
              </div>              
            </div>
           </a>
          </div>
    </div>
</div>
<?php $i++; } ?>    
</div></div>

<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?> 

  
</div>
</div>
</section>
<?php
		$output = ob_get_contents();
		ob_end_clean();
		
echo ppt_theme_block_output($output, $df, array("category", "category103"));

	
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
