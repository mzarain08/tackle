<?php
 
 
add_filter( 'ppt_blocks_args', 	array('block_header21a',  'data') );
add_action( 'header21a',  		array('block_header21a', 'output' ) );
add_action( 'header21a-css',  	array('block_header21a', 'css' ) );
add_action( 'header21a-js',  	array('block_header21a', 'js' ) );

class block_header21a {

	function __construct(){}		

	public static function data($a){ 
  
		$a['header21a'] = array(
			"name" 	=> "Style 21",
			"image"	=> "header21a.jpg",
			"cat"	=> "header",
			"desc" 	=> "", 
			"data" 	=> array( ),
			"order" 	=> 20.1,
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $userdata, $new_settings, $settings;
	
		
		// ADD ON SYSTEM DEFAULTS
		$settings = array();
		$settings = $CORE->LAYOUT("get_block_settings_defaults", array("header21a", "header", $settings ) );
 
		  
		 // UPDATE DATA FROM ELEMENTOR OR CHILD THEMES
		 if(is_array($new_settings)){
			 foreach($settings as $h => $j){
				if(isset($new_settings[$h]) && $new_settings[$h] != ""){
					$settings[$h] = $new_settings[$h];
				}
			 }
		 }
		 
		ob_start();
		
		?>

<header class="elementor_header header21a bg-white b-bottom navbar-light">

 <?php $settings['topmenu_bg'] = "bg-white text-dark border-bottom"; _ppt_template( 'framework/design/header/parts/header-topmenu' ); ?>
 
  <div class="container topcontainer">
    <div class="row">
      <div class="col-lg-3 col-md-4">
      
      <div class="d-flex justify-content-between">
      
        <a class="navbar-brand" href="<?php echo home_url(); ?><?php if(defined('WLT_DEMOMODE')){ ?>/?reset=1<?php } ?>"> <?php echo $CORE->LAYOUT("get_logo","light");  ?> <?php echo $CORE->LAYOUT("get_logo","dark");  ?> </a>
        
        
<?php _ppt_template( 'framework/design/header/parts/header-languages' ); ?>
        
        </div>
        
      </div>
      <div class="col-lg-5 col-md-7 hide-mobile">
        <form action="<?php echo home_url(); ?>" class="search">
          <div class="input-group">
            <input type="text" class="form-control rounded pl-5 typeahead border-0 bg-light" name="s" placeholder="<?php if(THEME_KEY == "cp"){ echo __("Store name or keyword..","premiumpress"); }else{ echo __("Keyword..","premiumpress"); } ?>" autocomplete="off">
          </div>
          <button class="btn position-absolute text-muted opacity-5" style="top:5px; left:20px;z-index:999;" type="submit"><i class="fal fa-search"></i></button>
        </form>
      </div>
      <div class="col-md-4 px-0 hide-ipad hide-mobile">
        <div class="row no-gutters">
        	
          <?php if(THEME_KEY == "cp"){ ?>
          <div class="col-md-3 text-center offset-md-2">
            <a href="javascript:void(0)" onclick="jQuery('.subheader-list-cat').hide();jQuery('.subheader-list-store').toggle();" class="text-dark"><i class="fal fa-layer-group fa-1x "></i>
            <div class="small font-weight-bold">
              <?php echo __("Stores","premiumpress") ?>
            </div>
            </a>
          </div>
          <?php }elseif(_ppt(array('lst','websitepackages')) == 1){ ?>
          <div class="col-md-3 text-center offset-md-2">
            <a href="<?php echo _ppt(array('links','add')); ?>" class="text-dark"><i class="fal fa-layer-group fa-1x"></i>
            <div class="small font-weight-bold">
              <?php echo str_replace("%s", $CORE->LAYOUT("captions","1"),__("Add %s","premiumpress")); ?>
            </div>
            </a>
          </div>
          <?php } ?>
          <div class="col-md-3 text-center">
            <a href="javascript:void(0)" onclick="jQuery('.subheader-list-store').hide();jQuery('.subheader-list-cat').toggle();" class="text-dark"><i class="fal fa-tags fa-1x "></i>
            <div class="small font-weight-bold">
              <?php echo __("Categories","premiumpress") ?>
            </div>
            </a>
          </div>
          
          <div class="col-md-3 text-center">
            <a href="<?php echo _ppt(array('links','blog')); ?>" class="text-dark"><i class="fal fa-newspaper fa-1x "></i>
            <div class="small font-weight-bold">
              <?php echo __("Latest News","premiumpress") ?>
            </div>
            </a>
          </div>
          
        </div>
      </div>
    </div>
  </div>
</header>
<?php
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if(THEME_KEY == "cp"){
?>

<div class="bg-white subheader-list-store border-bottom" style="display:none;">
  <div class="container">
    <div class="row pt-4 pb-1">
      <?php
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$args =  array('taxonomy' => 'store', 'orderby'  => 'name', 'order' => 'desc', 'hide_empty' => true, 'parent' => 0,'number' => 5 ); 
$term_query = new WP_Term_Query( $args );
$categories = array();
if ( ! empty( $term_query->terms ) ) {
	foreach ( $term_query ->terms as $term ) {
		$categories[] = $term;
	}
}
$i=1;
foreach ($categories as $category) { 
	
	if($category->parent != 0){ continue; }

	// ICON
	$image = do_shortcode('[CATEGORYIMAGE term_id="'.$category->term_id.'" pathonly=1 tax="store"]');
	
	if($image == ""){

		if(isset($category->term_id) && isset($GLOBALS['CORE_THEME']['category_icon_small_'.$category->term_id]) && $GLOBALS['CORE_THEME']['category_icon_small_'.$category->term_id] != ""   ){
			$caticon = "fa ".str_replace("&", "&amp;",$GLOBALS['CORE_THEME']['category_icon_small_'.$category->term_id]);
		}else{
		   $caticon = "fa fa-check";
	   }
   
   }			 
					

?>
      <div class="col-6 col-md-2 text-center float-left">
        <a href="<?php echo get_term_link($category); ?>" class="text-decoration-none">
        <?php if($image != ""){ ?>
        <img src="<?php echo $image; ?>" class="img-fluid"  alt="<?php echo $category->name; ?>">
        <?php }else{ ?>
        <i class="<?php echo $caticon; ?>"></i>
        <?php } ?>
        </a>
        <h5 class="small font-weight-bold opacity-5"><?php echo $category->name; ?></h5>
      </div>
      <?php $i++; } ?>
      <div class="col-6 col-md-2 text-center float-left">
        <a href="<?php echo _ppt(array('links','stores')); ?>" class="text-decoration-none"> <i class="fa fa-ellipsis-h"></i> </a>
        <h5 class="small font-weight-bold opacity-5"><?php echo __("All Stores","premiumpress") ?></h5>
      </div>
    </div>
  </div>
</div>
<?php

}
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


?>
<div class="bg-white subheader-list-cat border-bottom" style="display:none;">
  <div class="container">
    <div class="row pt-4 pb-1">
      <?php 
		 
		 
$args =  array('taxonomy' => 'listing', 'orderby'  => 'name', 'order' => 'desc', 'hide_empty' => true, 'parent' => 0,'number' => 5 ); 
$term_query = new WP_Term_Query( $args );
$categories = array();
if ( ! empty( $term_query->terms ) ) {
	foreach ( $term_query ->terms as $term ) {
		$categories[] = $term;
	}
}
$i=1;
 
foreach ($categories as $category) { 
 

	// ICON
	$image = do_shortcode('[CATEGORYIMAGE term_id="'.$category->term_id.'" pathonly=1]');
	
	if($image == ""){

		if(isset($category->term_id) && isset($GLOBALS['CORE_THEME']['category_icon_small_'.$category->term_id]) && $GLOBALS['CORE_THEME']['category_icon_small_'.$category->term_id] != ""   ){
		
			$caticon = "fal ".str_replace("&", "&amp;",$GLOBALS['CORE_THEME']['category_icon_small_'.$category->term_id]);
			
		}else{
		
			$cat_icons_small = array( 'fa-car', 'fa-archive', 'fa-university', 'fa-coffee', 'fa-heart', 'fa-desktop', 'fa-film', 'fa-futbol', 'fa-bus' );	
				
			if(isset($cat_icons_small[$c])){
				$caticon = "fal ".$cat_icons_small[$c];
			}else{
				$caticon = "fal fa-check";
			}
		}
	
	}

?>
      <div class="col-6 col-md-2 text-center float-left">
        <a href="<?php echo get_term_link($category); ?>" class="text-decoration-none">
        <?php if($image != ""){ ?>
        <img src="<?php echo $image; ?>" class="img-fluid"  alt="<?php echo $category->name; ?>">
        <?php }else{ ?>
        <i class="<?php echo $caticon; ?>"></i>
        <?php } ?>
        </a>
        <h5 class="small font-weight-bold opacity-5"><?php echo $category->name; ?></h5>
      </div>
      <?php } ?>
      <div class="col-6 col-md-2 text-center float-left">
        <a href="<?php echo _ppt(array('links','categories')); ?>" class="text-decoration-none"> <i class="fa fa-ellipsis-h"></i> </a>
        <h5 class="small font-weight-bold opacity-5"><?php echo __("All Categories","premiumpress") ?></h5>
      </div>
    </div>
  </div>
</div>
<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////



		$output = ob_get_contents();
		ob_end_clean();
		echo $output;	
	
		}
		
		public static function js(){ 
		return "";
		}
		
		public static function css(){ 
		 
		ob_start(); ?>
<style>
.header21a .topcontainer { padding: 20px 10px 20px 10px; }
.header21a .no-gutters i { font-size:24px; margin-bottom:10px; }
.header21a .no-gutters a { font-weight:bold; text-transform:uppercase; font-size:14px; }
.header21a .input-group input { height: 47px; border-radius: 25px !important; }
.subheader-list-cat a, .subheader-list-store a { width: 100px; border:1px solid #efefef; height: 100px; color:#444; background:#fff; display:block; text-align:center; margin: auto; line-height: 90px; font-size: 25px; margin-bottom: 10px; overflow: hidden; }

@media(max-width:575px){ 
.header21a .topcontainer { padding: 20px 0px; }
.navbar-brand { padding:0px; }
}
</style>
<?php 
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;
		}	
		
}

?>
