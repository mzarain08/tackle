<?php

global $CORE, $CORE_UI, $userdata;

$menu = array();
 
ob_start();
?>
<ul> 
<li>item 1</li>
<li>item 2</li>
<li>item 3</li>
<li>item 4</li> 
</ul>
 
<?php 

$output = ob_get_contents();
$list = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
?>
<nav ppt-nav>
	  <?php echo $list; ?> 
</nav>

<hr />

<nav ppt-nav class="spacing">
	  <?php echo $list; ?> 
</nav>

<hr />

<nav ppt-nav class="spaced">
	  <?php echo $list; ?> 
</nav>

<hr />


<nav ppt-nav class="seperator">
	  <?php echo $list; ?> 
</nav>

<hr />

<nav ppt-nav class="boxed">
	  <?php echo $list; ?> 
</nav>

<hr />

<nav ppt-nav class="boxed pill">
	  <?php echo $list; ?> 
</nav>

<hr />

<nav ppt-nav class="spacing seperator crumbs">
	  <?php echo $list; ?> 
</nav>

<hr />

<nav ppt-nav class="baseline">
	  <?php echo $list; ?> 
</nav>

<hr />

<nav ppt-nav class="list">
	  <?php echo $list; ?> 
</nav>

<nav ppt-nav class="responsive-40">
	  <?php echo $list; ?> 
</nav>
<?php 

$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Basic List",
	"desc" => "",
	"data" => $output,
);



///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
 ?>

<ul>
  <li>Lorem ipsum dolor sit amet</li>
  <li>Consectetur adipiscing elit</li>
  <li>Integer molestie lorem at massa</li>
  <li>Facilisis in pretium nisl aliquet</li>
  <li>Nulla volutpat aliquam velit</li>
</ul>


<ol>
  <li>Lorem ipsum dolor sit amet</li>
  <li>Consectetur adipiscing elit</li>
  <li>Integer molestie lorem at massa</li>
  <li>Facilisis in pretium nisl aliquet</li>
  <li>Nulla volutpat aliquam velit</li>
</ol>
<?php
$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Lists: Unordered and ordered",
	"desc" => "",
	"data" => $output,
);
 
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
_docsSection($menu);

?>