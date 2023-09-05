<?php
 
add_filter( 'ppt_blocks_args', 	array('block_listings5',  'data') );
add_action( 'listings5',  		array('block_listings5', 'output' ) );
add_action( 'listings5-css',  	array('block_listings5', 'css' ) );
add_action( 'listings5-js',  	array('block_listings5', 'js' ) );

class block_listings5 {

	function __construct(){}		

	public static function data($a){ global $CORE;  
  
		$a['listings5'] = array(
			"name" 	=> "Category + Carousel (left)",
			"image"	=> "listings5.jpg",
			"cat"	=> "listings",
			"order" 	=> 5,
			"desc" 	=> "", 
			"data" 	=> array( ),			
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $new_settings, $settings;
	
	
		$settings = array( "datastring" => "custom=new num=5" );  
	 
	   // ADD ON SYSTEM DEFAULTS
		$settings = $CORE->LAYOUT("get_block_settings_defaults", array("listings5", "listings", $settings ) );
 		 
		// UPDATE DATA FROM ELEMENTOR OR CHILD THEMES
		if(is_array($new_settings)){
			 foreach($settings as $h => $j){
				if(isset($new_settings[$h]) && $new_settings[$h] != ""){
					$settings[$h] = $new_settings[$h];
				}
			 }
		} 
		 
		
		// GET CATEGORY
		$cat_id 	= "";
		$cat_name 	= "";
		$cat_desc	= "";
		
		if(isset($new_settings['category_ids']) && strlen($new_settings['category_ids']) > 1){
			
			$catid = explode(",",$new_settings['category_ids']);
			if(isset($catid[0]) && is_numeric($catid[0])){
			$cat_id = $catid[0];
			}
			
		}
		
		if(!is_numeric($cat_id)){
			
			// GET RANDOM CATEGORY
			$categories = get_terms('listing', 'orderby=count&order=desc&hide_empty=0&num=1');  
			if(isset($categories[0]->term_id) && is_numeric($categories[0]->term_id)){			 
			$cat_id 	= $categories[0]->term_id;
			$cat_name 	= $categories[0]->name;
			$cat_desc	= $categories[0]->description;			
			}
		
		}elseif(is_numeric($cat_id)){
		
			$categories = get_term($cat_id,"listing");
			if(isset($categories->term_id) && is_numeric($categories->term_id)){			 
			$cat_id 	= $categories->term_id;
			$cat_name 	= $categories->name;
			$cat_desc	= $categories->description;			
			}
		
		
		}
		 
		
		
	ob_start();
	
	$randomID = rand(0,9999);
	
 	
	$data  = str_replace("data-srcxx","srcxx", do_shortcode('[LISTINGS dataonly=1 nav=0 small=1 cat="'.$cat_id.'" carousel=1 '.$settings['datastring'].' ]'));
	
	if(strlen($data) < 10){
			$data =  str_replace(".00","", do_shortcode('[LISTINGS dataonly=1 nav=0 orderby=rand small=1 carousel=1 custom=new ]')); 
	} 
	
	 
	?><section class="<?php echo $settings['section_class']." ".$settings['section_bg']." ".$settings['section_padding']." ".$settings['section_divider']; ?>" id="listings5<?php echo $randomID; ?>">
   <div class="container">
   <div class="row"> 
 
    <div class="col-md-3 d-none d-lg-block">
    
   
   <div class="h-100 bg-primary text-light p-5">
   
   <h4 class="mb-4"><?php echo $cat_name; ?></h4>
   
   <p style="height:118px; overflow:hidden;" class="small"><?php echo $cat_desc; ?></p>
   
   <a href="<?php echo $cat_name; ?>" class="btn btn-outline-light text-light mt-5 font-weight-bold">View More</a>
   
   
   </div>
   
    </div>
    
    <div class="col-md-9 overflow-hidden">
     
  
 
 <div  class="owl-carousel owl-theme" data-1000="3" data-600="2" data-1200="3"> <?php echo  $data;  ?> </div> 
   
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

#listings5<?php echo $randomID; ?> .card-ppt-search { margin-bottom:0px !important; }

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