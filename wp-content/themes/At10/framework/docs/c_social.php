<?php

global $CORE, $CORE_UI, $userdata;

$menu = array();
 
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();

echo $CORE_UI->ICONS("social", array("uid" => 0, "css" => "mb-3", "style" => "1", "size" => "lg"));
    
echo $CORE_UI->ICONS("social", array("uid" => 0, "css" => "mb-3", "style" => "2", "size" => "lg"));
     
echo $CORE_UI->ICONS("social", array("uid" => 0, "css" => "mb-3", "style" => "3", "size" => "lg"));
     
echo $CORE_UI->ICONS("social", array("uid" => 0, "css" => "mb-3", "style" => "4", "size" => "lg"));
 

$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Socials",
	"desc" => "",
	"data" => $output,
);


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();

echo $CORE_UI->ICONS("social", array("uid" => 0, "css" => "mb-3", "style" => "2", "size" => "xs"));
     
echo $CORE_UI->ICONS("social", array("uid" => 0, "css" => "mb-3", "style" => "2", "size" => "sm"));
    
echo $CORE_UI->ICONS("social", array("uid" => 0, "css" => "mb-3", "style" => "2", "size" => "md")); 
    
echo $CORE_UI->ICONS("social", array("uid" => 0, "css" => "mb-3", "style" => "2", "size" => "lg"));
    
echo $CORE_UI->ICONS("social", array("uid" => 0, "css" => "mb-3", "style" => "2", "size" => "xl")); 

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

echo $CORE_UI->ICONS("social", array("uid" => 0, "css" => "mb-3", "style" => "2", "size" => "lg"));
     
echo $CORE_UI->ICONS("social", array("uid" => 0, "css" => "rounded", "style" => "2", "size" => "lg"));
   
echo $CORE_UI->ICONS("social", array("uid" => 0, "css" => "rounded-circle", "style" => "2", "size" => "lg")); 

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

echo $CORE_UI->ICONS("social", array("uid" => 0, "css" => "rounded", "style" => "2", "size" => "lg","share" => 1));


echo $CORE_UI->ICONS("social", array("uid" => 0, "css" => "rounded", "style" => "2", "size" => "md","share" => 1)); 

$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Share Buttons",
	"desc" => "",
	"data" => $output,
);


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
_docsSection($menu);
 ?>
 

