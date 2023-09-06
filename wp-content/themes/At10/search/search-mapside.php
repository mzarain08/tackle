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
 
global $CORE;  

$GLOBALS['set-searchmap'] = 1;


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
?>

<div class="wrapper d-flex align-items-stretch border-top search-mapside">
  <div id="map_sidebar">
     
    <?php _ppt_template( 'search/search-filters' ); ?>
    
    <?php _ppt_template( 'search/search-results' ); ?>
    
  </div>
  <div id="map_sidebar_results" class="map-container">
    <div id="map-main" style="    height: 100%;    width: 100%;">
    </div>
    <ul class="mapnavigation bg-primary list-unstyled m-0">
      <li><a href="#" class="prevmap-nav"><?php echo __("Prev","premiumpress"); ?></a></li>
      <li><a href="#" class="nextmap-nav"><?php echo __("Next","premiumpress"); ?></a></li>
    </ul>
    <textarea id="mapdatabox" class="dynamic_map w-100" style="display:none; height:100px;">none</textarea>
    <input value="<?php if(is_numeric(_ppt(array('maps','zoom')))){ echo _ppt(array('maps','zoom')); }else{ echo 15; } ?>" class="map-zoom" type="hidden" />
  </div>
</div>
<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
?>
<script>
jQuery(window).on('load', function(){
									   
		 
		jQuery(window).on('scroll', function() {
											 
		 	//console.log(jQuery(this).scrollTop());
			if(jQuery(this).scrollTop() > 100) {
				
				 
				jQuery('#map_sidebar_results').attr('style','');
				
				 jQuery(window).trigger('resize');
			 
			} else {
				
				 jQuery('#map_sidebar_results').attr('style','max-height: 90vh;');
				
			}
			 
			
		}); 
	
});
jQuery(document).ready(function(){ 
   <?php if(isset($_GET['zipcode']) && strlen($_GET['zipcode']) ){ ?>
    jQuery('.filterby-link-distance').addClass('up').trigger('click');
   <?php }else{ ?>
   jQuery('.filterby-link-distance').hide();
   <?php } ?>
});
</script>