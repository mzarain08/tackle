<?php

global $CORE, $CORE_UI, $userdata;

$menu = array();

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
 ?>

<button data-ppt-btn class="dropdown btn-primary">
Click Only
<div class="dropdown-menu">
  <a href="#" class="dropdown-item ">Link</a>
  <a href="#" class="dropdown-item ">Link</a>
   <a href="#" class="dropdown-item ">Link</a>
   <a href="#" class="dropdown-item ">Link</a>
   <a href="#" class="dropdown-item ">Link</a>
 </div>
</button>

<button data-ppt-btn class="dropdown btn-primary dropdown-bounce">
Bounce
<div class="dropdown-menu">
  <a href="#" class="dropdown-item ">Link</a>
  <a href="#" class="dropdown-item ">Link</a>
   <a href="#" class="dropdown-item ">Link</a>
   <a href="#" class="dropdown-item ">Link</a>
   <a href="#" class="dropdown-item ">Link</a>
 </div>
</button>

<button data-ppt-btn class="dropdown btn-primary dropdown-fadein">
Fade In
<div class="dropdown-menu">
  <a href="#" class="dropdown-item ">Link</a>
  <a href="#" class="dropdown-item ">Link</a>
   <a href="#" class="dropdown-item ">Link</a>
   <a href="#" class="dropdown-item ">Link</a>
   <a href="#" class="dropdown-item ">Link</a>
 </div>
</button>
<?php
$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Basic",
	"desc" => "",
	"data" => $output,
);


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
 ?>

<button data-ppt-btn class="dropdown btn-primary show">
Click Only
<div class="dropdown-menu p-0 rounded-0">



<a title="Add Listing" href="http://localhost/WP/add-listing/" class="dropdown-item">
<div class="dropdown-wrap"><div class="dropdown-title d-flex">

<div ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['clock']; ?></div>


<div><span>This is the title</span></div> </div><div class="dropdown-desc">The description will be displayed in the menu if the current themeThe description will be displayed in the menu if the current themeThe description will be displayed in the menu if the current theme</div></div>

</a>

 <a title="Add Listing" href="http://localhost/WP/add-listing/" class="dropdown-item">
<div class="dropdown-wrap"><div class="dropdown-title d-flex">

<div ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['clock']; ?></div>


<div><span>This is the title</span></div> </div><div class="dropdown-desc">The description will be displayed in the menu if the current themeThe description will be displayed in the menu if the current themeThe description will be displayed in the menu if the current theme</div></div>

</a>


 </div>
</button>

 
 
<?php
$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Basic Two",
	"desc" => "",
	"data" => $output,
);

 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
_docsSection($menu);
 ?> 