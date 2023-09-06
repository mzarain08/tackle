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

global $post, $CORE_UI, $userdata, $CORE;
 
?>

<nav ppt-nav class="spaced baseline"><ul class="pl-0">
 
<li class="hide-mobile">


 <div class="badge_tooltip text-center" data-direction="top">
          <div class="badge_tooltip__initiator">
  
 %status%
  
          </div>
          <div class="badge_tooltip__item">
            %hits% <?php echo __("Views","premiumpress"); ?>
          </div>
        </div>




</li>

<li>
<a href="<?php echo _ppt(array('links','add')); ?>?eid=%postid%" class="btn-system text-600" data-ppt-btn>
<div class="d-flex">
	<div ppt-flex-middle><div ppt-icon-20 data-ppt-icon-size="20" class="mr-2 mt-n1"><?php echo $CORE_UI->icons_svg['pencil']; ?></div></div> 
	<div ppt-flex-middle><?php echo __("Edit Page","premiumpress"); ?></div> 
</div>

</a> 
</li>

<li>
<a href="javascript:void(0)" onclick="processStats(%postid%);" class="btn-system text-600" data-ppt-btn>
<div class="d-flex">
	<div ppt-flex-middle><div ppt-icon-20 data-ppt-icon-size="20" class="mr-2 mt-n1"><?php echo $CORE_UI->icons_svg['chart']; ?></div></div> 
	<div ppt-flex-middle><?php echo __("Statistics","premiumpress"); ?></div> 
</div> 
</a> 
</li>

<li>
<a href="javascript:void(0)" onclick="processListingUpgrade(%postid%);" class="btn-system text-600" data-ppt-btn>
<div class="d-flex">
	<div ppt-flex-middle><div ppt-icon-20 data-ppt-icon-size="20" class="mr-2 mt-n1"><?php echo $CORE_UI->icons_svg['light-bulb']; ?></div></div> 
	<div ppt-flex-middle><?php echo __("Upgrades","premiumpress"); ?></div> 
</div> 
</a> 
</li>



</ul>
</nav>

<hr />