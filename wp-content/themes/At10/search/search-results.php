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
 
global $CORE, $CORE_UI, $userdata; 


if(!isset($GLOBALS['flag-card-layout'])){
$GLOBALS['flag-card-layout'] = "";
} 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
?>

 
<div  id="noresults" style="display:none;">
    <div class="p-4 py-5 text-center font-weight-bold">
     <i class="fal fa-frown fa-8x mb-4 text-light"></i>
     <?php if(isset($GLOBALS['flag-account'])){ ?>
     
      <h4><?php echo __("Nothing Found","premiumpress"); ?></h4>
     
     <?php }else{ ?>
      <div class="py-2"><?php echo __("No Results Found","premiumpress"); ?></div>    
      <a href="<?php echo home_url(); ?>/?s=" class="btn btn-primary btn-md text-light mx-auto" style="max-width:200px;"><?php echo __("Reset Filters","premiumpress"); ?></a>  
      <?php } ?>
    </div>
</div>
 

<?php 
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
?>
<div class="ajax-search-placeholders w-100" data-list <?php if(isset($GLOBALS['flag-card-layout']) && $GLOBALS['flag-card-layout'] == "list"){ }else{ ?>style="display:none;"<?php } ?>>
<div class="container px-0">
    <?php echo $CORE_UI->PLACEHOLDER("list"); ?>
    <?php echo $CORE_UI->PLACEHOLDER("list"); ?>
    <?php echo $CORE_UI->PLACEHOLDER("list"); ?>
    <?php echo $CORE_UI->PLACEHOLDER("list"); ?>
    <?php echo $CORE_UI->PLACEHOLDER("list"); ?>  
</div>
</div>
<?php 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
?>
<div class="ajax-search-placeholders w-100" data-grid  <?php if(!isset($GLOBALS['flag-account']) && ( $GLOBALS['flag-card-layout'] == "grid" || $GLOBALS['flag-card-layout'] == "")){ }else{ ?>style="display:none;"<?php } ?>>
<div class='container px-0'><div class="row">
<?php 

$i =1; 
$show = 12;
$divcss = "col-lg-4";
$perrow = 4;
if(isset($_GET['map']) || isset($GLOBALS['flag-sidebar']) || isset($GLOBALS['flag-account']) ){
$perrow = 3;
}elseif(_ppt(array('searchcustom', 'perrow')) != ""){
$perrow = _ppt(array('searchcustom', 'perrow'));
}
 

	$divcss = "col-lg-3";
	$show = 18;
	if($perrow == 3){
	$divcss = " col-lg-4";
	}elseif($perrow == 5){
		$divcss = " col-lg-4 col-lg-5ths";
		$show = 18;
	} 
 

while($i < $show){ ?>
<div class="col-12 col-sm-6 col-md-6 <?php  echo $divcss; ?>">
<?php echo $CORE_UI->PLACEHOLDER("grid"); ?> 
</div>
<?php $i++; } ?>

</div>
</div></div>
<?php  


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
?>
 
<div id="ajax-search-output" class="mb-2"></div>
 
<div id="ajax-navbar-showhide" style="display:none">
  <div class="d-flex justify-content-center align-items-center py-2 small text-muted letter-spacing-1  my-4 pt-3"> 
    <div class="ajax-search-pagenav pagination-md"></div>
  </div>
  <div class="text-center small opacity-5 mt-n4 tiny text-uppercase"><span class="ajax-search-found">100</span> <?php echo __("results found","premiumpress"); ?> </div>
</div>

 