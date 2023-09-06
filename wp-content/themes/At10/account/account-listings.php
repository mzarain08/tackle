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

global $CORE, $userdata; 

$title = str_replace("%s", $CORE->LAYOUT("captions","2"),__("My %s","premiumpress"));;



$listng_data = $CORE->USER("count_user_listings", $userdata->ID);
if($listng_data['total'] == 1){
$title = str_replace("%s", $CORE->LAYOUT("captions","1"),__("My %s","premiumpress"));;
}

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>

<div class="fs-lg text-600 mb-4"><?php echo $title; ?></div>
 
<?php



///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
?>
 

<div class="col-md-4 px-0 mb-3">
    <select class="form-control customfilter" id="poststatusop" data-type="select" onchange="_filter_update()" data-key="post_status">
    <?php 
    $s =  $CORE->PACKAGE("get_status",  array() ); 
    foreach($s as $status){
    
    if(in_array($status['key'],array("trash"))){ continue; }
    ?>
    <option value="<?php echo $status['key']; ?>"><?php echo $status['name']; ?> (<?php echo $listng_data[$status['key']]; ?>)</option>
    <?php } ?>
    </select>
</div>

          
<?php 

$GLOBALS['flag-card-layout'] = "list";
_ppt_template( 'search/search-results' ); ?>
 

<input type="hidden" name="cardlayout" class="customfilter" id="filter-cardlayout"  data-type="select" data-key="cardlayout" value="list-account" />
<input type="hidden" name="perrow"  class="customfilter" data-type="select" data-key="perrow" value="3">
<input type="hidden" name="perpage"  class="customfilter" data-type="select" data-key="perpage" value="12">
<input type="hidden" name="userid" class="customfilter" id="filter-userid"  data-type="select" data-key="userid" value="<?php echo $userdata->ID; ?>" />
<input type="hidden" name="nosponsored" class="customfilter" id="filter-nosponsored"  data-type="select" data-key="nosponsored" value="1" />
<textarea style="width:100%; height:100px; display:none" id="_filter_data"></textarea>  