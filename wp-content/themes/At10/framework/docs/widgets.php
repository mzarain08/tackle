<?php

global $CORE, $CORE_UI, $userdata, $wp_scripts; $menu = array();

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
_ppt_template( 'framework/design/widgets/footer1' ); 
$output = ob_get_contents();
ob_end_clean();
 
$output = ppt_theme_block_output($output, array(

//"f1a" => "testing 123","f1b" => "testing 123", "icon3" => "svg-star"

),array("widget"));

$menu[] = array(

	"name" => "Footer 1",
	"desc" => "",
	"data" => $output,
);

 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
_ppt_template( 'framework/design/widgets/stats1' ); 
$output = ob_get_contents();
ob_end_clean();
 
$output = ppt_theme_block_output($output, array("f1a" => "testing 123","f1b" => "testing 123", "icon3" => "svg-star"),array("widget"));

$menu[] = array(

	"name" => "Stats 1",
	"desc" => "",
	"data" => $output,
);

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
_ppt_template( 'framework/design/widgets/stats2' ); 
$output = ob_get_contents();
ob_end_clean();
 
$output = ppt_theme_block_output($output, array("f1a" => "testing 123","f1b" => "testing 123", "icon3" => "svg-star"),array("widget"));

$menu[] = array(

	"name" => "Stats 1",
	"desc" => "",
	"data" => $output,
);

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 
ob_start();
echo '<div ppt-border1 class="p-4">';
_ppt_template( 'framework/design/widgets/icon64_3_text' ); 
echo '</div>';
$output = ob_get_contents();
ob_end_clean();
$output= ppt_theme_block_output($output, array("f1a" => "testing 123","f1b" => "testing 123", "icon3" => "svg-star"),array("widget"));

$menu[] = array(

	"name" => "3 Icons (64) Row + Text",
	"desc" => "",
	"data" => $output,
);

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
_ppt_template( 'framework/design/widgets/icon64_3_text1' ); 
$output = ob_get_contents();
ob_end_clean();
$output = ppt_theme_block_output($output, array("f1a" => "testing 123","f1b" => "testing 123", "icon3" => "svg-star"),array("widget"));
$menu[] = array(

	"name" => "3 Icons (64) Boxed + Text",
	"desc" => "",
	"data" => $output,
);

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 
ob_start();
echo '<div ppt-border1 class="p-4">';
_ppt_template( 'framework/design/widgets/icon32_3_text' ); 
echo '</div>';
$output = ob_get_contents();
ob_end_clean();
$output = ppt_theme_block_output($output, array("f1a" => "testing 123","f1b" => "testing 123", "icon3" => "svg-star"),array("widget"));
$menu[] = array(

	"name" => "3 Icons + Text",
	"desc" => "",
	"data" => $output,
);


// WORKING HOURS
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 
ob_start();
_ppt_template( 'framework/design/widgets/icon32_2_text' ); 
$output = ob_get_contents();
ob_end_clean();
$output = ppt_theme_block_output($output, array("f1a" => "testing 123","f1b" => "testing 123", "icon3" => "svg-star"),array("widget"));
$menu[] = array(

	"name" => "2 Icons + Text",
	"desc" => "",
	"data" => $output,
);

 

// LIST RIGHT
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 
ob_start();
_ppt_template( 'framework/design/widgets/list_right' ); 
$output = ob_get_contents();
ob_end_clean();
 
$f = ppt_theme_block_output($output, array("title" => "testing 123","subtitle" => "testing 123", "icon" => "fa-star", "link" => "http://google.com"),array("widget"));
$f .= ppt_theme_block_output($output, array("title" => "testing 123","subtitle" => "testing 123", "icon" => "fa-star", "link" => "http://google.com"),array("widget"));
$f .= ppt_theme_block_output($output, array("title" => "testing 123","subtitle" => "testing 123", "icon" => "fa-star", "link" => "http://google.com"),array("widget"));
 
$menu[] = array(

	"name" => "List Box",
	"desc" => "",
	"data" => $f,
);


// LIST RIGHT
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

ob_start();
_ppt_template( 'framework/design/widgets/popup' ); 
$output = ob_get_contents();
ob_end_clean(); 
$output = ppt_theme_block_output($output, array("title" => "testing 123","subtitle" => "testing 123", "icon" => "fa-star", "link" => "http://google.com"),array("widget"));
 $menu[] = array(

	"name" => "Pop Box",
	"desc" => "",
	"data" => $output,
);

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
_docsSection($menu);

?>