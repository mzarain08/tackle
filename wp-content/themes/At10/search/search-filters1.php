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

global $CORE, $CORE_UI, $userdata, $Shownfilters;
 
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>

<div <?php if(isset($GLOBALS['flag-sidebar'])){ ?>class="show-mobile"<?php } ?>>

<div class="position-relative filter-keyword mb-4 show-mobile">

  <input type="text" class="form-control customfilter typeahead shadow-sm" name="keyword" id="keyword" data-type="text" <?php if(!$CORE->isMobileDevice()){ ?>onchange="_filter_update()" <?php } ?> data-key="keyword" autocomplete="off"  data-formatted-text="<?php echo __("Keyword","premiumpress"); ?>" placeholder="<?php echo __("Keyword..","premiumpress"); ?>" value="<?php if(isset($_GET['s'])){ echo esc_attr($_GET['s']); } ?>" style="height:50px;">
  
   
  <button class="btn iconbit" type="button" onclick="_filter_update()" style="position:absolute; top:5px; right:5px;" >
  
      <span ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['search'];?></span>
  
  </button>
  
  
</div>


<div class="position-relative show-mobile  mb-4">
 

    <div class="p-3  filterbox mobile m-0 cursor" ppt-border1 cursor onclick="jQuery('.filterboxWrap').toggleClass('_show');"> 
        
        <span ppt-icon-16 data-ppt-icon-size="16"><?php echo $CORE_UI->icons_svg['sliders'];?></span>
        
        <span class="text-600 ml-2"><?php echo __("Filters","premiumpress"); ?></span>
        
        <em class="opacity-5 ml-3 text-500 ajax-search-found-wrap" style="display:none;"> <span class="ajax-search-found"></span> <?php echo __("results","premiumpress"); ?> </em>
    </div> 
</div> 

<div class="filterboxWrap <?php if(isset($GLOBALS['flag-search']) && $GLOBALS['flag-search-filters-hidden'] ){ ?>show-mobile<?php } ?>" >
<ul> 
<?php


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$filters = ppt_theme_main_filters();

//$s = _ppt("searchfilter");
//print_r($s);

$Shownfilters=1;
foreach($filters as $f){
		
		
		$filter =  $f['key'];
 	 	$title 	=  $f['name'];
	 	$type 	=  "";
		if(isset($f['type'])){
			$type = $f['type'];
		}
		 
 		
		// HIDE 
		if(_ppt(array("searchfilter",$filter)) == "0" || (isset($GLOBALS['flag-taxonomy-type']) && $GLOBALS['flag-taxonomy-type'] == str_replace("tax_","",$filter) ) ){ continue; }
		
		if($filter == "tax_listing" && isset($GLOBALS['flag-taxonomy'])){
		continue;
		}
		 
		
		if($filter == "distance" && isset($GLOBALS['flag-taxonomy']) && $GLOBALS['flag-taxonomy-type'] == "country"){
		continue;
		}
		
		 
		// TITLE
		$title = SearchFilterCaptions($filter, $title);
		if($type == "tax"){
		$title = $CORE->GEO("translation_tax_key", str_replace("tax_","",$filter));
		$title = SearchFilterCaptions($filter, $title);
		}
		
		
		?>
        <li class="<?php if($Shownfilters > 8){ ?>_closed<?php } ?>">
        
        <div data-tag="<?php echo str_replace("tax_","", $filter); ?>" ppt-border1  ppt-flex-between class="p-3 text-dark <?php if(!isset($GLOBALS['flag-search'])){ ?>link-dark<?php } ?> filterbox-<?php echo $filter; ?> taxonomy" 
        onclick="<?php if(!isset($GLOBALS['flag-search'])){ ?>window.location='<?php echo home_url(); ?>/?s=&fopen=<?php echo $filter; ?>'<?php }elseif(_ppt(array('searchcustom','login_filters')) == "1" && !$userdata->ID){?>processLogin(0)<?php }else{ ?>processFilterbox('<?php echo $filter; ?>','<?php echo $type; ?>');<?php } ?>">
       
       <div class="text-600 filtertxt"><?php echo $title; ?></div>
       
       
       <div ppt-icon-16 data-ppt-icon-size="16"><?php echo $CORE_UI->icons_svg['chevron-down']; ?></div>
      
        
        
        </div> 
        </li>
        
        <?php
		
		$Shownfilters++; 
 
}

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
?>
</ul>
<div class="clearfix"></div>
</div>
</div>