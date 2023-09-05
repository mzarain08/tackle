<?php

global $CORE, $CORE_UI, $userdata;

 

ob_start();
_ppt_template( 'single/single-content-data-subtitle' );
$author = ob_get_contents();
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

	"name" => "Subtitle Unstyled",
	"desc" => "single/single-content-data-subtitle",
	"data" => $output,
);

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
?>

<nav ppt-nav class="d-flex border-bottom pb-1 mb-3 fs-6">
<?php echo $author; ?>
</nav>
<?php

$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Subtitle Styled",
	"desc" => "single/single-subtitle",
	"data" => $output,
);
 
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
_docsSection($menu);
?>