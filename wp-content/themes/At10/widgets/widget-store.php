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

global $CORE, $LAYOUT, $CORE_UI, $wpdb, $wp_query;
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$term = get_term_by('slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$description = "";
$store_fb = "";
$store_phone = "";
$store_email = "";
$store_website = "";
$store_address = "";
$store_afflink = "";
$store_image = "";

if( strlen(_ppt('category_sidebar_description_'.$term->term_id)) >  5){  
	$description = _ppt('category_sidebar_description_'.$term->term_id);
}elseif($term->description != ""){
	$description = $term->description;
}
 

if( strlen(_ppt('storeaddress_'.$term->term_id)) >  2){  
	$store_address = _ppt('storeaddress_'.$term->term_id);
}
if( strlen(_ppt('storelink_'.$term->term_id)) >  2){  
	$store_website = _ppt('storelink_'.$term->term_id);
	if(substr($store_website,0,4) != "http"){
		$store_website = "https://".$store_website;
	}
}
if( strlen(_ppt('storefb_'.$term->term_id)) >  2){  
	$store_fb = _ppt('storefb_'.$term->term_id);
}
if( strlen(_ppt('storeemail_'.$term->term_id)) >  2){  
	$store_email = _ppt('storeemail_'.$term->term_id);
}
if( strlen(_ppt('storephone_'.$term->term_id)) >  2){  
	$store_phone = _ppt('storephone_'.$term->term_id);
}
if( strlen(_ppt('category_image_'.$term->term_id)) >  2){  
	$store_image = do_shortcode('[CATEGORYIMAGE term_id="'.$term->term_id.'" pathonly=1 big=1 placeholder=1 tax="store"]');
}

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 
if(THEME_KEY == "cp"){ 


	 
?>
<div class="card hide-mobile mb-4"><div class="card-body text-600">
   
<?php 


$filter = "tax_ctype";
$_POST['sidebar'] = 1;		
$_POST['fid'] = $filter;		
$_POST['showtax'] = 1;
_ppt_template( 'ajax/ajax-modal-filter' ); 
?>
<hr />

<div class="fs-sm opacity-5 mb-3"><?php echo __("Deal Ends","premiumpress"); ?></div>
<div class="card-sidebar-filters">
<div class="filter-ends">
 
<?php
$filter = "ends";
$_POST['sidebar'] = 1;		
$_POST['fid'] = $filter;		
$_POST['showtax'] = 1;
_ppt_template( 'ajax/ajax-modal-filter' ); 
 ?>
 
</div>
</div>
</div></div>



<?php } 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


?>
 


<?php if(strlen($description) > 0 || defined('WLT_DEMOMODE') ){ ?>
<div class="card hide-mobile mb-4"><div class="card-body">
  
      <p class="text-muted small">
      
      <?php if(defined('WLT_DEMOMODE') ){ ?>
        
        <div class="mb-4 mt-4 small">
        <strong>About Us</strong>
        
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue.</p>
        </div>
        
        <div class="mb-4 small">
        <strong>Customer Service</strong>
        
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue.</p>
        </div>
        
        <div class="mb-4 small">
        <strong>Top Deals</strong>
        
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue.</p>
        </div>
        
        <?php
		
		}elseif($description != ""){ 
		
			echo $description; 
		
		}else{ echo $term->description; } ?>
      </p>
   
</div>
</div> 
<?php } ?>