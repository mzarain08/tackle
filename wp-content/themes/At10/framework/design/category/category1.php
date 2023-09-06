<?php
 
add_filter( 'ppt_blocks_args', 	array('block_category1',  'data') );
add_action( 'category1',  		array('block_category1', 'output' ) );
add_action( 'category1-css',  	array('block_category1', 'css' ) );
add_action( 'category1-js',  	array('block_category1', 'js' ) );

class block_category1 {

	function __construct(){}		

	public static function data($a){ 
  
		$a['category1'] = array(
			"name" 	=> "Style 1",
			"image"	=> "category1.jpg",
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
			 
		 	$settings =  $CORE->LAYOUT("get_block_settings_defaults_new", array("category", "category1" ) );
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
			
			
			
			if(isset($df['image'.$i]) && strlen($df['image'.$i]) > 2){
			$img =  $df['image'.$i];
			$icon = $img;
			}else{
				
				$img = $image;
			
				if($df['tax'] == "store"){
				$image = do_shortcode('[STOREIMAGE]');
				$icon = $image;
				}else{
				$image = ""; //do_shortcode('[CATEGORYIMAGE term_id="'.$term->term_id.'" pathonly=1 placeholder=1 big=1 tax="'.$df['tax'].'"]');
				$icon = do_shortcode('[CATEGORYIMAGE term_id="'.$term->term_id.'" pathonly=1 placeholder=1 tax="'.$df['tax'].'"]');
				}
			
			}
			
			$data[] = array( 
				"name"	=> $term->name,  
				"link"	=> get_term_link($term), 
				"count"	=> $term->count,  
				"image" => $img,
				"icon" 	=> $icon,
			); 
			
			$i++; 
			
			}
	
	} 
	
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
		
	ob_start();
	?>

<section class="section-top-40">
<div class="container">
<div class="row">

 

<div class="col-md-6 mb-4">

<h2 data-ppt-title><?php

 if($df['tax'] == "store"){ 
 
 echo $CORE->LAYOUT("get_placeholder_text_new", array("short", "pop_stores" ) ); 
 
 }else{
  echo $CORE->LAYOUT("get_placeholder_text_new", array("short", "pop_cats" ) ); 
 
 }
 ?></h2>

</div>
  
<div class="col-md-6 hide-mobile text-right">


  <ul class="d-inline-flex">
    <li><a href="javascript:void(0);" class="btn prev btn-system mr-2" data-ppt-btn><span class="fa fa-arrow-left"></span></a></li>
    <li><a href="javascript:void(0);" class="btn next btn-system" data-ppt-btn><span class="fa fa-arrow-right"></span></a></li>
    </ul>

</div>
 
 
<div class="col-12 hide-mobile px-0">

<div class="listing1-carousel-1 owl-carousel owl-theme" data-0="1" data-1200="5" data-1000="5" data-margin="10">
<?php $i=1; foreach($data as $cat){ ?>
 
      
          <div class="card-body text-center card-hover">           
            <a href="<?php echo $cat['link']; ?>" class="text-decoration-none text-dark">            
            <div class="row">
              <div class="col-12 col-md-12">
                <div class="card shadow-sm mb-md-3 card-mobile-transparent <?php if($df['tax'] == "store"){ ?>py-4<?php } ?>"> 
                <img <?php if($i > 5){ ?>data-<?php } ?>src="<?php echo $cat['icon']; ?>" class="img-fluid mb-3 lazy" <?php if($df['tax'] == "store"){ ?>style="max-height:90px;"<?php } ?> alt="<?php echo $cat['name']; ?>" />
                </div>
              </div>              
              <div class="col-12  col-md-12">
                <div class="text-600 "><?php echo $cat['name']; ?></div>
              </div>              
            </div>
              </a>
         
        
       
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
                <div class="mobile-icon-text text-600 my-2 fs-sm"><?php echo $cat['name']; ?></div>
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
		
echo ppt_theme_block_output($output, $df, array("category", "category1"));

	
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
