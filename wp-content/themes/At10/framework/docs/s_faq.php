<?php

global $CORE, $CORE_UI, $userdata;

 

ob_start();
_ppt_template( 'single/single-content-data-faq' );
$author = ob_get_contents();
ob_end_clean(); 
 
ob_start();
_ppt_template( 'single/single-faq' );
$author1 = ob_get_contents();
ob_end_clean(); 
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();

echo $author;

$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "FAQ Unstyled",
	"desc" => "",
	"data" => $output,
);

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();

echo $author1;

$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "FAQ Styled",
	"desc" => "",
	"data" => $output,
);
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
_docsSection($menu);
?>