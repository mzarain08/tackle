<?php

global $CORE, $CORE_UI, $userdata;

$menu = array();

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
 ?>
 
<nav ppt-nav class="spacing seperator crumbs small pl-0">
<ul>

<li><a href="#">Page 1</a></li>
<li><a href="#">Page 2</a></li>
<li><a href="#">Page 3</a></li>
<li><a href="#">Page 4</a></li>
<li><a href="#">Page 5</a></li>
 
</ul>
</nav>  
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

<div class="p-4 bg-light rounded">
<nav ppt-nav class="spacing seperator crumbs small pl-0">
<ul>

<li><a href="#">Page 1</a></li>
<li><a href="#">Page 2</a></li>
<li><a href="#">Page 3</a></li>
<li><a href="#">Page 4</a></li>
<li><a href="#">Page 5</a></li>
 
</ul>
</nav> 
</div>
 
<?php
$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Padding",
	"desc" => "",
	"data" => $output,
);
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
_docsSection($menu);
 ?>

 
  