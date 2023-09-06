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
  
?>

<div class="row">
  <?php
$allblocks = $CORE->LAYOUT("get_block_types",array());
	  
	foreach($allblocks as $type){ 
	
	
	if(isset($_GET['pagekey']) && $_GET['pagekey'] == "home" && in_array($type['id'], array("header","footer"))){
	 continue;
	}
	 
?>
  <div class="col-md-3 mb-4">
    <div ppt-border2 ppt-rounded>
      <img src="<?php echo $type['image']; ?>" class="img-fluid" />
      <div class="p-3" ppt-flex-between>
        <div class="text-600 text-black">
          <?php echo $type['name']; ?>
        </div>
        <a href="#" onclick="_docsLoadPage('<?php echo $type['id']; ?>');" data-title="<?php echo $type['name']; ?>" data-blockid="<?php echo $type['id']; ?>" data-navid-<?php echo $type['id']; ?> <?php echo $type['id']; ?> data-ppt-btn class="btn-system btn-sm">View</a>
      </div>
    </div>
  </div>
  <?php } ?>
</div>