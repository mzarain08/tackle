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

global $CORE, $CORE_UI, $LAYOUT, $wpdb, $wp_query, $userdata;
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 
if((!in_array(THEME_KEY, array('cp','vt','cm','sp')) && !isset($GLOBALS['flag-taxonomy']) ) || ( isset($GLOBALS['flag-taxonomy']) && !in_array($GLOBALS['flag-taxonomy-type'],array("store","country"))) ){
 

?>
<div class="my-3 hide-mobile" id="search-tax-top">
<div class="row">

    <div class="col-md-6 text-600">
    
     <?php if(!isset($GLOBALS['flag-taxonomy']) ){ ?>
     
     <?php echo __("Explore","premiumpress"); ?> 
     
     <?php }elseif(isset($GLOBALS['flag-taxonomy-name'])){ ?>
     
    <?php echo  $GLOBALS['flag-taxonomy-name']; ?>
    
    <?php } ?>
    

    <em class="text-500 ajax-search-found-wrap" style="display:none;"> 
    
    
    <span class="ajax-search-found"></span> <?php echo __("results","premiumpress"); ?> 
    
  
    
    </em>
 
    	 
	</div>
    <div class="col-md-6 text-right text-600">
 
    <?php if(_ppt(array('lst','addon_sponsored_enable')) == "1" && $GLOBALS['flag-sponsored-shown'] > 0){ ?>
   
    <div class="sponsored-text cursor text-right" style="display:none" onclick="processSponsored(0);">
 		
        <span>
		<div class="d-inline-flex">
		<span class="mr-2"><?php echo __("Sponsored Ads","premiumpress"); ?></span> 
        
        <div ppt-icon-16 data-ppt-icon-size="16"><?php echo $CORE_UI->icons_svg['info-circle']; ?></div>
        </div>
         </span> 
        
        
    </div>
    <?php } ?>   
    
    </div>
</div>
</div>

<?php } ?>