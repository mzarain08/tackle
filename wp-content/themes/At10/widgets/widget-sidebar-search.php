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
   
   global $CORE, $userdata, $settings, $post, $CORE_UI; 



$style = _ppt(array('searchliststyle', 'cardlayout'));
if($style == ""){
$style = 1;
}
 

if($style == 1){
?>
<div ppt-box class="rounded ppt-forms style3 card-sidebar-filters">
 
<div class="_content pt-2">

<?php 
}

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$filters = ppt_theme_main_filters();


$Shownfilters=1;
foreach($filters as $f){
		
		
		$filter =  $f['key'];
 	 	$title 	=  $f['name'];
	 	$type 	=  "";
		if(isset($f['type'])){
			$type = $f['type'];
		}
		
		if(THEME_KEY == "dl" && $filter == "tax_listing"){ continue; }
		
		
		if($style == 2 && $filter == "distance" ){ continue; }
		
		// HIDE 
		if(_ppt(array("searchfilter",$filter)) == "0"  ){ continue; } //|| (isset($GLOBALS['flag-taxonomy-type']) && $GLOBALS['flag-taxonomy-type'] == str_replace("tax_","",$filter) )
		
		if($filter == "tax_listing" && isset($GLOBALS['flag-taxonomy'])){
		$type =  $GLOBALS['flag-taxonomy-id'];
		}
		
		 
		// TITLE
		$title = SearchFilterCaptions($filter, $title);
		if($type == "tax"){
		$title = $CORE->GEO("translation_tax_key", str_replace("tax_","",$filter));
		$title = SearchFilterCaptions($filter, $title);
		} 
		
		
		?>
        
        
<?php if($style == 2){ ?>
<div ppt-box class="rounded ppt-forms style3 card-sidebar-filters"> 
<div class="_content pt-2 mb-3">
<?php } ?>
        
        
<div class="card card-filter filter-<?php echo $filter; ?>">

<div class="card-title"  onclick="jQuery('.filter-toggle-<?php echo $filter; ?>').toggle();"><?php echo $title; ?></div>
         
        <?php 
		
		$_POST['sidebar'] = 1;		
		$_POST['fid'] = $filter;		
		$_POST['showtax'] = $type;
		?>

<div class="filter-content filter-toggle-<?php echo $filter; ?>"  style="<?php if($style == 1 && $Shownfilters == 1){ }elseif($style == 2){ }else{ echo "display:none;";  } ?>"><?php _ppt_template( 'ajax/ajax-modal-filter' );  ?> </div>
        
  
</div>
         
    
<?php if($style == 2){ ?>
</div> 
</div> 
<?php } ?>       
        
        <?php
		
		
		$Shownfilters++; 
 
}


if($style == 1){
?>
</div>
</div>
<?php } ?>