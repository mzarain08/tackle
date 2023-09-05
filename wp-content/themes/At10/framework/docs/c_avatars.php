<?php

global $CORE, $CORE_UI, $userdata;

$menu = array();
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
echo $CORE_UI->AVATAR("user", array("size" => "xs", "uid" => 0, "css" => "rounded-circle", "online" => 0));

echo $CORE_UI->AVATAR("user", array("size" => "sm", "uid" => 0.1, "css" => "rounded-circle", "online" => 0));

echo $CORE_UI->AVATAR("user", array("size" => "md", "uid" => 0.2, "css" => "rounded-circle", "online" => 0));

echo $CORE_UI->AVATAR("user", array("size" => "lg", "uid" => 0.3, "css" => "rounded-circle", "online" => 1));
$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Sizes",
	"desc" => "",
	"data" => $output,
);
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();

echo $CORE_UI->AVATAR("user", array("size" => "lg", "uid" => 0, "css" => "rounded-circle", "online" => 0));

echo $CORE_UI->AVATAR("user", array("size" => "lg", "uid" => 0, "css" => "rounded", "online" => 0));

echo $CORE_UI->AVATAR("user", array("size" => "lg", "uid" => 0, "css" => "", "online" => 0));

$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Shapes",
	"desc" => "",
	"data" => $output,
);

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();

echo $CORE_UI->AVATAR("user", array("size" => "lg", "uid" => 0.3, "css" => "rounded-circle", "online" => 0, "tooltip" => 1));

echo $CORE_UI->AVATAR("user", array("size" => "lg", "uid" => 0.4, "css" => "rounded-circle", "online" => 0, "tooltip" => 1)); 

echo $CORE_UI->AVATAR("user", array("size" => "lg", "uid" => 0.5, "css" => "rounded-circle", "online" => 0, "tooltip" => 1));

echo $CORE_UI->AVATAR("user", array("size" => "lg", "uid" => 0.6, "css" => "rounded-circle", "online" => 0, "tooltip" => 1, "icon" => "fa fa-star")); 


$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Groups",
	"desc" => "",
	"data" => $output,
);
 
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();

echo $CORE_UI->AVATAR("user", array("size" => "lg", "uid" => 0.3, "css" => "rounded-circle", "online" => 0, "tooltip" => 1));

echo $CORE_UI->AVATAR("user", array("size" => "lg", "uid" => 0.4, "css" => "rounded-circle", "online" => 0, "tooltip" => 1)); 

echo $CORE_UI->AVATAR("user", array("size" => "lg", "uid" => 0.5, "css" => "rounded-circle", "online" => 0, "tooltip" => 1));

echo $CORE_UI->AVATAR("user", array("size" => "lg", "uid" => 0.6, "css" => "rounded-circle", "online" => 0, "tooltip" => 1, "icon" => "fa fa-star")); 


$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Groups",
	"desc" => "",
	"data" => $output,
);
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
_docsSection($menu);
 ?>
 
 
