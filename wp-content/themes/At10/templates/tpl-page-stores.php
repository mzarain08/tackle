 <?php
/*
Template Name: [PAGE - STORES]
*/
 
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
 
global  $userdata, $CORE; 

$GLOBALS['flag-stores'] = 1;
 
$pageLinkingID = _ppt_pagelinking("stores");

if( substr($pageLinkingID ,0,9) == "elementor" ){

	get_header(); 

	echo do_shortcode( "[premiumpress_elementor_template id='".substr($pageLinkingID,10,100)."']");
	
	get_footer();

}else{ 
   
 
	get_header(); 
	
	//_ppt_template( 'page-before' );
	
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


$useOwn = 1;
if(THEME_KEY == "cp"){
	
	include(get_template_directory() ."/framework/data/_stores.php");
	$storesList = $GLOBALS['_list_stores'];
	
	$hide_stores = _ppt(array('storedata', 'hide'));
	$hide_stores_data = explode(",",$hide_stores);
 	$useOwn = 0;
	
	
	$termdata = get_terms('store', 'orderby=count&order=desc&hide_empty=0&number=1000');
 	 
	foreach ($termdata as $term) { 
	
		if(in_array(filterme($term->slug), $hide_stores_data)){
			continue;
		}
	 	
		if(isset($storesList[$term->slug])){
		 
		$storesList[$term->slug] = array("name" =>  $term->name, "link" => get_term_link($term->term_id, "store"), "img" => do_shortcode('[STOREIMAGE sid="'.$term->term_id.'"]') );
		
		}else{
		
		$storesList[$term->slug] = array("name" =>  $term->name, "link" => get_term_link($term->term_id, "store"), "img" => do_shortcode('[STOREIMAGE sid="'.$term->term_id.'"]') );
		
		}
		
		 
	}
	  
	 	 
	 
}

if($useOwn){	
	$termdata = get_terms('store', 'orderby=count&order=desc&hide_empty=0&number=1000');
	$total_cats = count($termdata);		
	
	$categoryList = array();
	$i=1; $sf = 0;
	foreach ($termdata as $term) { 
	 
		if($term->parent == "0"){
			
			$categoryList[$term->term_id] = array("name" =>  $term->name, "slug" => $term->slug, "data" => array() );
		
		}elseif(isset($categoryList[$term->parent])){
		
			array_push($categoryList[$term->parent]['data'], array("id" => $term->term_id, "name" =>  $term->name, "slug" => $term->slug ) );
		
		}
	}
	$total_parent_cats = count($categoryList);
	
} 


$letters = range('A', 'Z');

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

switch(THEME_KEY){

 case "es":{
  $title =  __("All Agencies","premiumpress");
  $subtitle = __("List of all stores","premiumpress"); 
 } break;
 
 case "so":{
  $title =  __("All Brands","premiumpress");
  $subtitle = __("List of all brands","premiumpress"); 
 } break;
 
 default:{ 
  $title = __("All Retailers","premiumpress");
   $subtitle = __("List of all stores","premiumpress");
 } break;
}
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


if($useOwn){


?>
<nav class="page-breadcrumbs border-bottom">
<div class="container py-4">
 
<h1 class="<?php if($total_cats < 50){ ?>text-center text-sm-left<?php } ?> h3 mb-0 pb-0"><?php echo $title; ?></h1>

<?php if($total_cats > 50){ ?>

    <p class="mt-2 opacity-5"><?php echo $subtitle ?></p>
    
    <div class="d-flex justify-content-between mt-4 tablist hide-mobile">
        
        <div class="tab tab-all active"><a href="javascript:void(0);" onclick="filterLetters('all');"><?php echo __("All","premiumpress") ?></a></div>
        
        <?php foreach($letters as $l){ ?>
        
        <div class="tab tab-<?php echo $l; ?>"><a href="javascript:void(0);" onclick="filterLetters('<?php echo $l; ?>');"><?php echo $l; ?></a></div>
        
        <?php } ?>
    </div>
    
    
    <select onchange="filterCategory(this.value);" class="form-control show-mobile">
    <option value="all"><?php echo SearchFilterCaptions("all-category",__("All Stores","premiumpress")); ?></option>
    <?php foreach($categoryList as $catid => $catdata){  ?> 
    <option value="<?php echo $catid; ?>"><?php echo $catdata['name']; ?></option>
    <?php } ?>
    </select>

<?php } ?>

</div>
</nav>

<div class="bg-light">
<div class="container py-4">


<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
if($total_cats < 50){ 
?>

    <div class="row">
      <?php
	   
		$termdata = get_terms('store', 'orderby=count&order=desc&hide_empty=0&number=30&parent=0');
		
		$total_merchants = count($termdata);
		$i=1; $sf = 0;
        foreach ($termdata as $term) { 
	 
		 // LINK 
         $link = get_term_link($term);		 
		 
		 // IMAGE
		 $big = 0;
		 $img = do_shortcode('[CATEGORYIMAGE term_id="'.$term->term_id.'" pathonly=1 big="'.$big.'" placeholder=1 tax="store"]');
		
		?>
      <div class="col-lg-3 col-md-4 col-4 col-lg-5ths">
        <div class="card shadow-sm mb-md-4 card-mobile-transparent">
          <div class="card-body text-center card-hover">
           
            <a href="<?php echo $link; ?>" class="text-decoration-none text-dark">
            
            <div class="row">
              <div class="col-12 col-md-12">
                <img data-src="<?php echo $img; ?>" class="img-fluid mb-3 lazy" alt="<?php echo $term->name; ?>" />
              </div>
              
              <div class="col-12  col-md-12">
                <div class="icon-text small text-600"><?php echo $term->name; ?></div>
              </div>
              
            </div>
              </a>
          </div>
        
        </div>
      </div>
      <?php $i++; } ?>
    </div>
<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
}else{
?>

	<?php foreach($letters as $l){ ?>
    <div class="wrap wrap-<?php echo $l; ?>" id="<?php echo $l; ?>">
    <h3><?php echo $l; ?></h3>
    <hr />
    <div class="py-3 ">
   <div class=""> 
		<?php $i =1; foreach($categoryList as $catid => $catdata){  ?>    
            
            <?php if(substr(strtolower($catdata['name']), 0,1) == strtolower($l)){ ?>
            
            
           <div class="clearfix mb-4 category-wrap category-<?php echo $catid; ?>" data-topcatid="<?php echo $catid; ?>">
           
            <strong class="h4"><a href="<?php echo get_term_link($catdata['slug'], "store"); ?>" class="text-dark"><?php echo $catdata['name']; ?></a></strong>
            
            
            <?php if(isset($catdata['data']) && !empty($catdata['data'])){ ?>
            <div class="row mt-4">
            
				<?php foreach($catdata['data'] as $subcat){ ?>                	
                    <div class="col-6 col-md-4 py-2 mobile-text-12"><a href="<?php echo get_term_link($subcat['slug'], "listing"); ?>"><?php echo $subcat['name']; ?> </a></div>                
                <?php } ?>
             </div>
            <?php } ?>
            
           </div>
            
          
            <?php $i++; } ?> 
           
            
        <?php } ?>  
    </div>
 	</div>
    </div>
    <?php } ?>
     
<?php } ?>

</div>
</div>

<style>
.tablist .tab { padding: 5px 15px;  }
.tablist .tab.active { background:#111; border-radius:4px; }
.tablist .tab.active a { color:#fff; font-weight:bold; }
.bg-image-wrap { height:130px; width:100%; border-radius:4px; position:relative; background: #fff; border: 1px solid #ddd; }
.bg-image-wrap .bg-image { background-size: unset; background-repeat: no-repeat;  }

@media (max-width: 575.98px) {
.bg-image-wrap { height:100px; }
.bg-image-wrap .bg-image {
    background-size: contain;
 
}
}
</style>
 
<script>
function filterLetters(l){
	
	jQuery(".tab").removeClass('active');
	jQuery(".tab-"+l).addClass('active');
	
	
	
	if(l == "all"){
		
		jQuery(".wrap").show();
		cleanCats();
		
	}else{
		jQuery(".wrap").hide();
		jQuery(".wrap-"+l).show();		
	}

}
function filterCategory(l){ 
	
	if(l == "all"){
		
		jQuery(".wrap").show();
		cleanCats();
		
	}else{
		jQuery(".wrap").hide();
		jQuery(".hascat-"+l).show();
				
	}

}

function cleanCats(){

	var a = jQuery(".wrap");
    a.each(function (a) {
        wrapid = jQuery(this).attr('id').toString();
		
	 
		var a = jQuery(".wrap-"+wrapid+" .category-wrap");
		a.each(function (a) {
			topid = jQuery(this).attr('data-topcatid');
			
			jQuery('.wrap-'+wrapid+'').addClass(" hascat-"+topid)
			 
		});  
		
		 
		links = jQuery('.wrap-'+wrapid+' a').length; 
		if(links == 0){
			jQuery(this).hide();
			jQuery('.tablist').removeClass('justify-content-between');
			jQuery(".tab-"+wrapid).hide();
			 
		}
    }); 

}

jQuery(document).ready(function(){

cleanCats();

});

</script>
<?php
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////// 


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

}else{
?>
<div class="border-bottom">
<div class="container py-4">
 
<h1><?php echo $title; ?></h1>

<p><?php echo $subtitle; ?></p>

<div class="d-flex justify-content-between mt-4 tablist hide-mobile">
	
    <div class="tab tab-all active"><a href="javascript:void(0);" onclick="filterStores('all');"><?php echo __("All","premiumpress") ?></a></div>
    
	<?php foreach($letters as $l){ ?>
    
    <div class="tab tab-<?php echo $l; ?>"><a href="javascript:void(0);" onclick="filterStores('<?php echo $l; ?>');"><?php echo $l; ?></a></div>
    
    <?php } ?>
</div>

<select onchange="filterStores(this.value);" class="form-control show-mobile">
<option value="all"><?php echo __("All Retailers","premiumpress") ?></option>
<?php foreach($letters as $l){ ?>
<option value="<?php echo $l; ?>"><?php echo $l; ?></option>
<?php } ?>
</select>

</div>
</div>
<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 

?>
<div class="bg-white">
<div class="container py-4">

	<?php foreach($letters as $l){ ?>
    <div class="wrap wrap-<?php echo $l; ?>">
    <h3><?php echo $l; ?></h3>
    <hr />
    <div class="py-3 mb-4">
   <div class="row no-gutters"> 
		<?php $i =1; foreach($storesList as $store => $storedata){
		 
		if(in_array(filterme($store), $hide_stores_data)){
			continue;
		}
		 ?>    
            
            <?php if(substr(strtolower($store), 0,1) == strtolower($l)){ ?>
              
            <?php if($i < 5){ ?>
            
            <div class="col-md-3 col-6">
            
                <div class="pr-3 mb-4">
                   <a href="<?php if(isset($storedata['link'])){ echo $storedata['link']; }else{ echo home_url(); ?>/pptstore/<?php echo filterme($store); ?>/<?php } ?>">
                   <div class="bg-image-wrap">
                   <div class="bg-image" data-bg="<?php echo $storedata['img']; ?>" style="background-size: contain!important;"></div>
                   </div>
                   </a>
               </div>
           
           </div>
            
            <?php }else{ ?>
            
            <div class="col-6 col-md-3 py-2">
            <strong><a href="<?php echo home_url(); ?>/pptstore/<?php echo filterme($store); ?>/" class="text-dark"><?php echo $storedata['name']; ?></a></strong>
            </div>          
            
            <?php } ?>
          
            <?php $i++; } ?> 
            
        <?php } ?>  
    </div>
 	</div>
    </div>
    <?php } ?>
     
    
</div>
</div>

<style>
.tablist .tab { padding: 5px 15px;  }
.tablist .tab.active { background:#111; border-radius:4px; }
.tablist .tab.active a { color:#fff; font-weight:bold; }
.bg-image-wrap { height:130px; width:100%; border-radius:4px; position:relative; background: #fff; border: 1px solid #ddd; }
.bg-image-wrap .bg-image { background-size: unset; background-repeat: no-repeat;  }

@media (max-width: 575.98px) {
.bg-image-wrap { height:100px; }
.bg-image-wrap .bg-image {
    background-size: contain;
 
}
}
</style>
 
<script>

function filterStores(l){
	
	jQuery(".tab").removeClass('active');
	jQuery(".tab-"+l).addClass('active');
	
	if(l == "all"){
		
		jQuery(".wrap").show();
		
	}else{
		jQuery(".wrap").hide();
		jQuery(".wrap-"+l).show();
		
	}

}

</script>
<?php

}
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////// 

	//_ppt_template( 'page-after' );
	
	get_footer(); 

}  ?>