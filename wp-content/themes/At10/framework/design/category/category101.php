<?php
 
add_filter( 'ppt_blocks_args', 	array('block_category101',  'data') );
add_action( 'category101',  		array('block_category101', 'output' ) );
add_action( 'category101-css',  	array('block_category101', 'css' ) );
add_action( 'category101-js',  	array('block_category101', 'js' ) );

class block_category101 {

	function __construct(){}		

	public static function data($a){ 
  
		$a['category101'] = array(
			"name" 	=> "Style 101",
			"image"	=> "category101.jpg",
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
			 
		 	$settings =  $CORE->LAYOUT("get_block_settings_defaults_new", array("category", "category4" ) );
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
			}else{
				if($df['tax'] == "store"){
				$img = do_shortcode('[STOREIMAGE]');
				}else{
				$img = do_shortcode('[CATEGORYIMAGE term_id="'.$term->term_id.'" pathonly=1 placeholder=1 big=1 tax="'.$df['tax'].'"]');
				}
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

<section class="section-60">
<div class="container">
<div class="row">
  <div class="col-12">
    <h2 class="mb-5" data-ppt-title>Most popular categories</h2>
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

    <div class="row">
      <div class="col-sm-6 col-md-6 col-lg-3">
        <div class="card-category101">
         <div class="bg-image" data-bg="<?php echo $data[0]['image']; ?>">&nbsp;</div>
        <div class="bg-gradient" style="z-index:1;">&nbsp;</div>
          <h5><a href="<?php echo $data[0]['link']; ?>"><?php echo $data[0]['name']; ?></a></h5>
        </div>
      </div>
      <div class="col-sm-6 col-md-6 col-lg-4">
        <div class="card-category101">
         <div class="bg-image" data-bg="<?php echo $data[1]['image']; ?>">&nbsp;</div>
        <div class="bg-gradient" style="z-index:1;">&nbsp;</div>
          <h5><a href="<?php echo $data[1]['link']; ?>"><?php echo $data[1]['name']; ?></a></h5>
          
        </div>
      </div>
      <div class="col-sm-6 col-md-6 col-lg-5">
        <div class="card-category101">
         <div class="bg-image" data-bg="<?php echo $data[2]['image']; ?>">&nbsp;</div>
        <div class="bg-gradient" style="z-index:1;">&nbsp;</div>
          <h5><a href="<?php echo $data[2]['link']; ?>"><?php echo $data[2]['name']; ?></a></h5>
       
        </div>
      </div>
      <div class="col-sm-6 col-md-6 col-lg-5">
        <div class="card-category101">
         <div class="bg-image" data-bg="<?php echo $data[3]['image']; ?>">&nbsp;</div>
        <div class="bg-gradient" style="z-index:1;">&nbsp;</div>
           <h5><a href="<?php echo $data[3]['link']; ?>"><?php echo $data[3]['name']; ?></a></h5>
         
        </div>
      </div>
      <div class="col-sm-6 col-md-6 col-lg-4">
        <div class="card-category101">
         <div class="bg-image" data-bg="<?php echo $data[4]['image']; ?>">&nbsp;</div>
        <div class="bg-gradient" style="z-index:1;">&nbsp;</div>
          <h5><a href="<?php echo $data[4]['link']; ?>"><?php echo $data[4]['name']; ?></a></h5>
        
        </div>
      </div>
      <div class="col-sm-6 col-md-6 col-lg-3">
     
        <div class="card-category101">
        <div class="bg-image" data-bg="<?php echo $data[5]['image']; ?>"></div>
        <div class="bg-gradient" style="z-index:1;">&nbsp;</div>
           <h5><a href="<?php echo $data[5]['link']; ?>"><?php echo $data[5]['name']; ?></a></h5>
      
        </div>
     
      </div>
    </div>


  
</div>
</div>
</section>
<?php
		$output = ob_get_contents();
		ob_end_clean();
		
echo ppt_theme_block_output($output, $df, array("category", "category101"));

	
	}
		public static function css(){
		ob_start();
		?>
<style>
 
.card-category101{position:relative;text-align:center;margin-bottom:30px;cursor:pointer;z-index:1;width:100%;height:230px; border-radius: 8px;     overflow: hidden; }
.card-category101:hover h5{bottom:42px;}
.card-category101:hover p{visibility:visible;bottom:15px;opacity:1;}
.card-category101 h5{position:absolute;bottom:30px;left:50%;z-index:1;width:100%;font-weight:500;text-align:center;text-transform:capitalize;-webkit-transform:translateX(-50%);transform:translateX(-50%);transition:all linear .3s;-webkit-transition:all linear .3s;-moz-transition:all linear .3s;-ms-transition:all linear .3s;-o-transition:all linear .3s;}
.card-category101 h5 a{color:#fff;}
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
