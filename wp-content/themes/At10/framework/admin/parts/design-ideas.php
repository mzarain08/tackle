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


function compare_lastname($a, $b){

	return strnatcmp($a['order'], $b['order']);

} 

?>

<nav ppt-nav="" class="sepetator pl-0">
  <ul>
    <li>
      <div class="fs-md text-600">
        <?php echo __("Ready Made Designs","premiumpress"); ?>
      </div>
      <div class="mt-2 opacity-8">
        <?php echo __("Choose any design to be applied to your homepage.","premiumpress"); ?>
      </div>
    </li>
    <li class="ml-auto"> <a href="<?php echo home_url(); ?>/wp-admin/admin.php?page=design&resetdemo=1"   class="btn-primary btn-lg confirm" data-ppt-btn=""> <span><?php echo __("Reset Design","premiumpress"); ?></span> </a> </li>
  </ul>
</nav>
<hr />
<style>
.card-ppt-search .bg-overlay-dark {display:none; }

.card-ppt-search:hover .bg-overlay-dark {display:block; }

</style>
<div class="row">
  <div class="col-12">
    <div class="row">
      <?php 

$categories = $CORE->LAYOUT("get_demo_categories", array());
foreach($categories[THEME_KEY] as $cid => $cat){ 
$g = $CORE->LAYOUT("load_designs_by_theme", $cid); 
usort($g, 'compare_lastname');  
foreach($g as $key => $h){ 

 

?>
      <div class="col-md-3 text-center mb-2">
        <div class="card-ppt-search p-2 shadow-sm" ppt-border1>
          <figure style="min-height:150px;" class="position-relative"> <img data-src="<?php echo $h['image']; ?>" class="img-fluid lazy" alt="alt">
            <div class="bg-overlay-dark">
            </div>
            <div class="read_more px-3" style="top:20%">
              <a href="<?php echo home_url(); ?>/?design=<?php echo $h['key']; ?>" target="_blank" data-ppt-btn class="btn-system text-600 btn-block list mb-2"> <?php echo __("View Design","premiumpress"); ?></a>
              <?php if(defined('ELEMENTOR_VERSION')){ ?>
              <a href="admin.php?page=design&loadpage=<?php echo $h['key'] ?>&full=1" target="_blank" data-ppt-btn class="btn-system text-600 btn-block list mb-2"> <?php echo __("Load Elementor","premiumpress"); ?> </a>
              <?php } ?>
              <?php if(isset($h['elementor']) && !defined('ELEMENTOR_VERSION')){  }else{ ?>
              <a href="javascript:void(0);" onclick="jQuery('#loaddesign').val('<?php echo $h['key'] ?>');document.loaddemodesign.submit();" data-ppt-btn class="btn-system text-600 btn-block list mb-2"> <?php echo __("Install Theme","premiumpress"); ?> </a>
              <?php } ?>
            </div>
          </figure>
        </div>
        <div class="mb-5">
          <?php  if(isset($h['elementor']) ){ ?>
          <div class="tiny text-danger">
            requires elementor
          </div>
          <?php } ?>
        </div>
      </div>
      <?php } ?>
      <?php } ?>
    </div>
  </div>
</div>
