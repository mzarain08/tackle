<?php
/* 
* Theme: PREMIUMPRESS CORE FRAMEWORK FILE
* Url: www.premiumpress.com
* Author: Mark Fail
*
* THIS FILE WILL BE UPDATED WITH EVERY UPDATE
* IF YOU WANT TO MODIFY THIS FILE, CREATE A CHILD THEME
*
* http://codex.wordpress.org/Child_Themes
*/
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }

global $CORE, $wp_query, $userdata; 

 
// LOAD HEADER 
if(!isset($GLOBALS['flag-elementor'])){
get_header(); 
}

 
$cardLayout = _ppt(array('searchcustom', 'cardlayout'));
if(_ppt(array('searchcustom', 'cardlayout')) == ""){ 
	if(in_array(THEME_KEY, array("cp"))){ $cardLayout = "list";  }else{ $cardLayout = "grid"; }  
}
if(in_array(THEME_KEY,array("cp")) || isset($_GET['listview'])){
$cardLayout = "list";
}

if(isset($_GET['full'])){
$cardLayout = "full";
}

if( isset($GLOBALS['flag-taxonomy']) && in_array($GLOBALS['flag-taxonomy-type'],array("store")) ){
$GLOBALS['flag-show-sidebar'] = 1;
}
 
$GLOBALS['flag-card-layout'] = $cardLayout;

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$GLOBALS['flag-search-filters-hidden'] = false;
if(!isset($_GET['full']) && ( isset($_GET['hidefilters']) || in_array(_ppt(array('design', 'search_filters')),array("0","2")) ) ){
$GLOBALS['flag-search-filters-hidden'] = true;
}


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$hasSidebar = 0;
$searchLayout = _ppt(array('design', 'search_layout'));

if(isset($_GET['inline'])){
$GLOBALS['flag-show-sidebar'] = 1;
}

if($searchLayout == "sidebar" || $cardLayout == "list" || _ppt(array('design', 'customsidebar')) == 1 || isset($GLOBALS['flag-show-sidebar']) ){
	$hasSidebar = 1;
}
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if(isset($_GET['map'])){
	
_ppt_template( 'search/search-mapside' );   
		 
} 
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if(isset($GLOBALS['flag-taxonomy']) && !in_array($GLOBALS['flag-taxonomy-type'],array("store"))  ){
?>
    <div class="border-bottom border-top py-3">
	<?php _ppt_template( 'search/search-breadcrumbs' ); ?>
    </div>
<?php 

}

if(isset($GLOBALS['flag-taxonomy']) && in_array($GLOBALS['flag-taxonomy-type'],array("store")) ){

 _ppt_template( 'search/search-taxonomy-top-store' ); 

}elseif(isset($GLOBALS['flag-taxonomy']) && in_array($GLOBALS['flag-taxonomy-type'],array("country")) ){

 _ppt_template( 'search/search-taxonomy-top-country' ); 

}
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
<section class="section-40 bg-light mt-1">

  <div class="container main-container">
  
    <div class="row">
  
      <?php if( $hasSidebar == "1"){  ?>
       
      <div class="col-md-12 col-lg-3" >
      
        <?php _ppt_template( 'sidebar' );  ?>
        
      </div> 
      
    <?php } ?>
      
      <div class="<?php if($hasSidebar == "1"){ ?>col-md-12 col-lg-9<?php }else{ ?>col<?php } ?>">
      
        <div class="row px-0">  
          
          <div class="col-12"> 
            
            <?php if(!isset($GLOBALS['flag-taxonomy']) ){ echo $CORE->ADVERTISING("display_banner", "search_top" ); } ?> 
           
            <?php if(!isset($GLOBALS['flag-hide-search-top']) ){ ?>
            
            <?php _ppt_template( 'search/search-sponsored' ); ?>           
            
            <?php _ppt_template( 'search/search-taxonomy-top' );  ?>
            
            <?php } ?>  
              
            <?php _ppt_template( 'search/search-filters' ); ?> 
             
			<?php _ppt_template( 'search/search-results' ); ?>
            
            <?php _ppt_template( 'search/search-taxonomy-bot' );  ?>
            
            <?php echo $CORE->ADVERTISING("display_banner", "search_bottom" ); ?> 
             
          </div>
          
        </div> 
        
      </div>  
      
    </div> 
    
  </div>
  
</section>
<?php
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
 
?>
 
<textarea style="width:100%; height:100px; display:none" id="_filter_data"></textarea>

<!-- per row/ per page / card layout -->
<input type="hidden" name="cardlayout" class="customfilter" id="filter-cardlayout"  data-type="select" data-key="cardlayout" value="<?php echo $cardLayout; ?>" />
<input type="hidden" name="perrow"  class="customfilter" data-type="select" data-key="perrow" value="<?php  

$perrow = 4;

if(isset($_GET['map']) || $hasSidebar ){
$perrow = 3;
}elseif(_ppt(array('searchcustom', 'perrow')) != ""){
$perrow = _ppt(array('searchcustom', 'perrow'));
}


echo $perrow;  ?>">
<input type="hidden" name="perpage"  class="customfilter" data-type="select" data-key="perpage" value="<?php echo $CORE->LAYOUT("default_perpage", ""); ?>">
<!-- end -->
 
<?php if(isset($_GET['uid']) && is_numeric($_GET['uid']) ){ ?>
<input type="hidden" class="customfilter"  name="userid" data-type="text" data-key="userid" value="<?php echo esc_attr($_GET['uid']); ?>" >
<?php } ?>

<?php if(isset($_GET['history']) ){ ?>
<input type="hidden" class="customfilter"  name="history" data-type="text" data-key="history" value="1" >
<?php } ?>

<?php if(isset($_GET['favs']) ){ ?>
<input type="hidden" class="customfilter" id="filter-custom-favs"  name="favorites" data-type="text" data-key="favorites" value="1" >
<?php }else{ ?>
<input type="hidden" id="filter-custom-favs"  name="favorites" data-type="text" data-key="favorites" value="1" >
<?php } ?>

<?php if(isset($GLOBALS['flag-taxonomy']) && isset($GLOBALS['flag-taxonomy-id']) && $GLOBALS['flag-taxonomy-type'] != "country" ){ ?>
<input type="hidden" name="taxonomy"  class="customfilter" data-type="text" data-key="taxonomy" value="<?php echo $GLOBALS['flag-taxonomy-type']."-".$GLOBALS['flag-taxonomy-id']; ?>" >
<?php } ?> 

<?php if(isset($_GET['tax-store']) && is_numeric($_GET['tax-store']) ){ ?>
<input type="hidden" name="taxonomy"  class="customfilter" data-type="text" data-key="taxonomy" value="store-<?php echo $_GET['tax-store']; ?>" >
<?php } ?>

<?php if(isset($_GET['s']) && strlen($_GET['s']) > 1  ){ ?>
<input type="hidden" name="s"  class="customfilter" data-type="text" data-key="keyword" value="<?php echo esc_attr($_GET['s']); ?>">
<?php } ?>

<?php if( _ppt(array('searchcustom', 'with_images')) == 1){ ?>
<input type="hidden" name="images"  class="customfilter" data-type="text" data-key="images" value="1">
<?php } ?>

<?php if(isset($_GET['city']) && strlen($_GET['city']) > 2 ){ ?>
<input type="hidden" name="newcity"  class="customfilter" data-type="text" data-key="newcity" value="<?php echo esc_attr($_GET['city']); ?>" >
<?php } ?> 

<?php if(isset($_GET['user']) ){ ?>
<input type="hiddenxxx" name="usersearch"  class="customfilter" data-type="text" data-key="usersearch" value="100">
<?php } ?>

<?php if(isset($_GET['make']) ){ ?>
<input type="hidden" name="make"  class="customfilter" data-type="text" data-key="filter-make" value="<?php echo $_GET['make']; ?>">
<?php } ?>

<?php if(isset($_GET['zipcode']) && strlen($_GET['zipcode']) > 1 ){ ?>
<input type="hidden" value="<?php echo esc_attr($_GET['zipcode']); ?>"   >
<?php } ?>



<?php 

if(isset($_GET['s'])){
	foreach($_GET as $k => $v){
	
		if($v == ""){ continue; }
		
		if(substr($k,0,3) == "tax"){
		
		if($cardLayout == "list" && _ppt(array('lst','makemodels')) != "1" &&  str_replace("tax_","",str_replace("tax-","",$k)) == "listing"){ continue; }
		
		?>         
        <input type="hidden" name="catid[]"  class="customfilter" 
        data-key="taxonomy" 
        data-custom-text="<?php echo str_replace("tax_","",str_replace("tax-","",$k)); ?>" 
        data-type="custom" 
        custom-data-value="<?php echo substr($k,4,100)."-".$v; ?>" 
        data-value="<?php echo str_replace("tax-","",$k)."-".$v; ?>" 
        value="<?php echo str_replace("tax-","",$k)."-".$v; ?>">
        <?php
		
		}elseif(substr($k,0,6) == "price1" && is_numeric($v) ){
		
		?>         
         
        
        <input type="hidden" name="price1"  
        custom-data-value="<?php echo $v; ?>" 
        class="customfilter" 
        data-key="text" 
        data-value="<?php echo $v; ?>" 
        data-custom-text="<?php echo __("Min. Price","premiumpress"); ?>"  
        data-type="custom-text" value="<?php echo $v; ?>">
        
        <?php
		
		}elseif(substr($k,0,6) == "price2" && is_numeric($v) ){
		
		?>   
        
        <input type="hidden" name="price2"   
        custom-data-value="<?php echo $v; ?>" 
        class="customfilter" 
        data-key="text" 
        data-value="<?php echo $v; ?>" 
        data-custom-text="<?php echo __("Max. Price","premiumpress"); ?>"  
        data-type="custom-text" value="<?php echo $v; ?>">
        
        <?php
		
		
		}elseif(substr($k,0,6) == "price2"){
		
		
		}
	}
}

?>


<?php 
if(!isset($GLOBALS['flag-taxonomy']) && !isset($_GET['tax-dagender']) && THEME_KEY == "da" && $userdata->ID ){
 			 
	$seek2 = get_user_meta($userdata->ID,'da-seek2',true);
	if(is_numeric($seek2) && $seek2 > 0){
	
	$term = get_term_by( 'id', $seek2, 'dagender' ); 
	if(isset($term->term_id) && is_numeric($term->term_id)){
	$k = "dagender"; $v = $seek2;
?>
        <input type="hidden" name="catid[]"  class="customfilter" 
        data-key="taxonomy" 
        data-custom-text="<?php echo $CORE->GEO("translation_tax_value", array($term->term_id, $term->name)); ?>" 
        data-type="custom-text" 
        custom-data-value="<?php echo $k."-".$v; ?>" 
        data-value="<?php echo $k."-".$v; ?>" 
        value="<?php echo $k."-".$v; ?>">
<?php 
	}
	}				  	
}


if(isset($_GET['age1']) && is_numeric($_GET['age1']) ){ ?>
<input type="hidden" 
data-key="age1"
data-value="<?php echo $_GET['age1']; ?>"
data-type="custom" 
data-custom-text-value="<?php echo __("Age","premiumpress"); ?> <?php echo $_GET['age1']; ?>+" 

name="age"  class="customfilter" data-type="text"  value="<?php echo $_GET['age1']; ?>">
<input type="hidden" name="age2"  class="customfilter" data-type="text" data-key="age2" value="999999999">

<?php } ?>
 

<?php if(is_tag()){ 
$tag_obj = $wp_query->get_queried_object();
?>
<input type="hidden" name="taxonomy"  class="customfilter" data-type="text" data-key="taxonomy" value="<?php echo $tag_obj->taxonomy."-".$tag_obj->term_id; ?>" >
<?php } ?> 

<?php if(isset($_GET['fopen']) && strlen($_GET['fopen']) > 1){ ?>
<script>
jQuery(document).ready(function(){
setTimeout(function(){  
jQuery(".filterbox-<?php echo $_GET['fopen']; ?>").trigger('click');
}, 2000);
});
</script>
<?php } ?>


<?php if(isset($_GET['zipcode']) && strlen($_GET['zipcode']) > 5 ){ ?>

<script>
jQuery(document).ready(function(){
	setTimeout(function(){  
		jQuery(".filterbox-distance").trigger('click');
		
		setTimeout(function(){  
		jQuery(".filter-keyword .form-control.customfilter").val("<?php echo strip_tags($_GET['zipcode']); ?>");
		}, 3000); 
		
	}, 2000);
});
</script>
<?php } ?>

 
<?php
 if(!isset($GLOBALS['flag-elementor'])){ get_footer(); } ?>