<?php

global $CORE, $CORE_UI, $userdata;

 

ob_start();
_ppt_template( 'single/single-content-data-title' );
$author = ob_get_contents();
ob_end_clean(); 


ob_start();
_ppt_template( 'single/single-title1' );
$title1 = ob_get_contents();
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

	"name" => "Title Unstyled",
	"desc" => "single/single-content-data-title",
	"data" => $output,
);

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
?>
 
<?php echo $title1; ?>
 
<?php

$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Title Styled 1",
	"desc" => "single/single-title1",
	"data" => $output,
);
 
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
_docsSection($menu);
?>


<link rel='stylesheet'   href='<?php echo CDN_PATH.'css/css.theme-gallery.css'; ?>' media='all' /> 