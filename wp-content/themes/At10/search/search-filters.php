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



<?php echo _ppt_template( 'search/search-filters1' );   ; ?>

<?php
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
<div id="currentFilters" style="cursor:pointer;"></div>
<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
?> 


<div id="search-toggle-bar">
<div class="mb-4 d-md-flex justify-content-md-between  <?php if(isset($GLOBALS['flag-sidebar'])){ ?>has-sidebar<?php }else{ ?>mt-4<?php } ?>">
 
<?php
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
 
$showonly = ppt_theme_checkbox_filters();
 

if(isset($GLOBALS['flag-searchpage']) && in_array(_ppt(array('user','favs')), array("","1")) && !isset($_GET['map']) ){ 
$showonly["favs"] = array("name" => __("Favorites","premiumpress") );
}

if(in_array(THEME_KEY, array("cp") ) && _ppt(array('cashback', 'enable' )) == '1' ){
unset($showonly["favs"]);
}

if(!in_array(_ppt(array('design', 'search_filters')),array("0")) && !isset($GLOBALS['flag-sidebar']) && $Shownfilters > 9){ 
$showonly["morefilters"] = array("name" => __("More Filters","premiumpress") );
} 


if(in_array(_ppt(array('design', 'search_filters')),array("2"))){
 $showonly["morefilters"] = array("name" => __("More Filters","premiumpress") );
}

if(!empty($showonly)){
?>
 
<div class="d-flex hide-mobile hide-ipad filterToggle">
<?php $i=1; foreach($showonly as $k => $s){ 
	
	if( _ppt(array('searchcheckbox', $k)) == "0" ){ continue; }
	
?>
<div class="d-flex mr-4">
      
<span class="toggle-me toggle-<?php echo $k; ?>-wrap <?php if(isset($_GET['map']) && $k == "map"){ echo "on"; } ?>" onclick="filterToggle('<?php echo $k; ?>');">

<?php if(in_array($k, array("favs"))){ ?> 

<span ppt-icon-24 data-ppt-icon-size="24" class="mr-2 mt-n1"><?php echo $CORE_UI->icons_svg['heart-full']; ?></span>
      
<?php }elseif(in_array($k, array("morefilters"))){ ?> 
    
<span ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['popup']; ?></span> 
    
<?php }else{ ?>
      
<span ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['toggle_off']; ?></span>
<span ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['toggle_on']; ?></span>


<?php } ?>
      
      
      
      <span><?php echo $s['name']; ?></span>
      </div>
      
      <?php if(!in_array($k, array("morefilters","map"))){ ?>     
     <input type="hidden" class="toggle-<?php echo $k; ?>" data-type="text" data-key="<?php echo $k; ?>" value="1" >
		<?php } ?>
        
    <?php $i++; } ?>
   
 

</div>
<script>
function filterToggle(val){

	if(val == "map"){
	
	window.location = "<?php if(isset($_GET['map'])){  echo home_url()."/?s="; }else{ echo home_url()."/?s=&map=1"; } ?>";
	
	}else if(val == "favs"){
		
		
		<?php if(!$userdata->ID){ ?>
		
		processLogin(0);
		
		<?php }else{ ?>
	
		var favsf = jQuery('#filter-custom-favs');
		if(favsf.hasClass('on')){
		favsf.removeClass('on').addClass('off');
		favsf.removeClass("customfilter"); 
		}else{
		favsf.removeClass('off').addClass('on');
		favsf.addClass("customfilter");
		}
		

		var toggleFieldWrap = jQuery('.toggle-'+val+'-wrap');
		if(toggleFieldWrap.hasClass('on')){
		toggleFieldWrap.removeClass('on').addClass('off');
		}else{
		toggleFieldWrap.removeClass('off').addClass('on');
		}
		
		_filter_update();
		
		<?php } ?>
	
	}else if(val == "morefilters"){
	 	
		<?php if($GLOBALS['flag-search-filters-hidden']){ ?>
		
		
		jQuery(".filterboxWrap").toggleClass('show-mobile');
		
		<?php }else{ ?><?php } ?>
		var toggleFieldWrap = jQuery('.toggle-'+val+'-wrap');
		if(toggleFieldWrap.hasClass('on')){
		toggleFieldWrap.removeClass('on').addClass('off');
		jQuery("._closedxxx").addClass("_closed").removeClass("_closedxxx");
		}else{
		toggleFieldWrap.removeClass('off').addClass('on');
		jQuery("._closed").addClass("_closedxxx").removeClass("_closed");
		}
		
	
	}else{

		var toggleField = jQuery('.toggle-'+val);
		var toggleFieldWrap = jQuery('.toggle-'+val+'-wrap');
		if(toggleFieldWrap.hasClass('on')){
		toggleFieldWrap.removeClass('on').addClass('off');
		toggleField.removeClass("customfilter"); 
		}else{
		toggleFieldWrap.removeClass('off').addClass('on');
		toggleField.addClass("customfilter");
		}
		_filter_update(); 
	
	}

}
</script>
 
<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

} ?> 

<div>


    <div class="d-flex">
    <div class="filterSortby">
    <?php
    
    $sortBy = ppt_theme_orderby_filters(); 
    
    ?>
    

    <select onchange="filterSortBy(this.value)" class="sortby">
    <option value="" data-dir="d"><?php echo __("Most Relevant","premiumpress"); ?></option>
    <?php foreach($sortBy as $k => $n){ ?>
    <option value="<?php echo $k; ?>" data-dir="d" <?php if(isset($_GET['sort']) && !in_array($_GET['sort'],array("expiry")) && $k == $_GET['sort']){ echo "selected=selected"; } ?>><?php echo $n['up']; ?></option>
    <option value="<?php echo $k; ?>" data-dir="u" <?php if(isset($_GET['sort']) && in_array($_GET['sort'],array("expiry")) && $k == $_GET['sort']){ echo "selected=selected"; } ?>><?php echo $n["down"]; ?></option>
    <?php } ?>
    </select> 


</div>

 <div class="d-flex ml-3 hide-mobile">



<div class="badge_tooltip text-center" data-direction="top">
<div class="badge_tooltip__initiator"> 
<div ppt-icon-24 data-ppt-icon-size="24" class="js-text-primary cursor" onclick="_updatecardlayout('grid')"><?php echo $CORE_UI->icons_svg['grid']; ?></div>

</div>
<div class="badge_tooltip__item"><?php echo __("Grid View","premiumpress"); ?></div>
</div>



<div class="badge_tooltip text-center" data-direction="top">
<div class="badge_tooltip__initiator"> 
<div ppt-icon-24 data-ppt-icon-size="24" class="js-text-primary cursor ml-2" <?php if($GLOBALS['flag-card-layout'] == "list"){ ?>onclick="_updatecardlayout('list')"<?php }else{?> onclick="window.location='<?php echo home_url(); ?>/?s=&listview=1<?php if(isset($_GET['user'])){ echo "&user=1"; } ?>';" <?php } ?>><?php echo $CORE_UI->icons_svg['list']; ?></div>

</div>
<div class="badge_tooltip__item"><?php echo __("List View","premiumpress"); ?></div>
</div>
 

 

<?php if(!in_array(THEME_KEY,array("sp","vt","cm","so","cp","cb")) && !isset($_GET['map']) && _ppt(array('maps','enable')) == 1 && in_array(_ppt(array("maps","provider")), array("mapbox","google"))  ){ ?>



<div class="badge_tooltip text-center" data-direction="top">
<div class="badge_tooltip__initiator"> 

<div ppt-icon-24 data-ppt-icon-size="24" class="js-text-primary cursor ml-2" onclick="window.location='<?php echo home_url(); ?>/?s=&map=1';"><?php echo $CORE_UI->icons_svg['map-marker']; ?></div>

</div>
<div class="badge_tooltip__item"><?php echo __("Map View","premiumpress"); ?></div>
</div>



<?php } ?>
 
</div>
    
 </div>   
 </div>      
    

 <input type="hidden" name="sort" class="customfilter" id="filter-sortby-main"  data-type="select" data-key="sortby" value="<?php if(isset($_GET['sort'])){ 
 
 if(in_array($_GET['sort'],array("expiry"))){ echo $_GET['sort']."-u"; }else{ echo $_GET['sort']."-d"; } } ?>" />
    
    <script>
    function filterSortBy(val){
    	
		if(val == ""){
		jQuery('#filter-sortby-main').removeClass('customfilter');
		}else{
		
		jQuery('#filter-sortby-main').addClass('customfilter');
		
        var sortSel = jQuery('.sortby option:selected');
        var dir = sortSel.attr("data-dir");
        
        var sortField = jQuery('#filter-sortby-main');	
        sortField.val(val+'-'+ dir); 
		
		}
     
        _filter_update(); 
    
    }
    </script>
    </div>
 

</div>


