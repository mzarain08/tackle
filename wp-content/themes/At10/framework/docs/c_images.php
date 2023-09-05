<?php

global $CORE, $CORE_UI, $userdata;

$menu = array();
 
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();

echo $CORE_UI->IMAGES("image", array("size" => "md", "pid" => 0, "css" => "", "src" => "https://premiumpress1063.b-cdn.net/_demoimagesv10/es/products/escort/15.jpg")); 

$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Responsive 800x600",
	"desc" => "",
	"data" => $output,
);

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();

echo $CORE_UI->IMAGES("image", array("size" => "md", "pid" => 0, "css" => "", "src" => "https://premiumpress1063.b-cdn.net/_demoimagesv10/es/products/escort/15.jpg"));

$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Responsive 800x1200",
	"desc" => "",
	"data" => $output,
);


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();

echo $CORE_UI->IMAGES("image", array("size" => "", "pid" => 0, "css" => ""));

echo $CORE_UI->IMAGES("image", array("size" => "", "pid" => 0.1, "css" => "col-md-8")); 

echo $CORE_UI->IMAGES("image", array("size" => "", "pid" => 0.2, "css" => "col-md-4"));


$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Responsive Image Sizes",
	"desc" => "",
	"data" => $output,
);


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();

echo $CORE_UI->IMAGES("image", array("size" => "mmd", "pid" => 0.3, "css" => "responsive rounded")); 

echo $CORE_UI->IMAGES("image", array("size" => "mmd", "pid" => 0.4, "css" => "responsive rounded", "text" => "Image with text"));

$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Category Images",
	"desc" => "",
	"data" => $output,
);
 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();

?>
<label class="btn-block small text-600">extra small - xs</label>
<?php echo $CORE_UI->IMAGES("image", array("size" => "xs", "pid" => 0, "css" => "")); ?> 
<?php echo $CORE_UI->IMAGES("image", array("size" => "xs", "pid" => 0.1, "css" => "")); ?>
<?php echo $CORE_UI->IMAGES("image", array("size" => "xs", "pid" => 0.2, "css" => "")); ?>
 

</div>
<div class="mb-4">
<label class="btn-block small text-600">small - sm</label>
<?php echo $CORE_UI->IMAGES("image", array("size" => "sm", "pid" => 0, "css" => "")); ?>
<?php echo $CORE_UI->IMAGES("image", array("size" => "sm", "pid" => 0.1, "css" => "")); ?>
</div>
<div class="mb-4">
<label class="btn-block small text-600">medium - md</label>
<?php echo $CORE_UI->IMAGES("image", array("size" => "md", "pid" => 0, "css" => "")); ?>
</div>
<?php

$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Fixed Images",
	"desc" => "",
	"data" => $output,
); 
 
 
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
_docsSection($menu);

?>