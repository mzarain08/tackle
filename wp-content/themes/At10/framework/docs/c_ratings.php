<?php

global $CORE, $CORE_UI, $userdata;

$menu = array();

 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();

echo $CORE_UI->RATING("score", array("css" => "", "total" => 0, "reviews" => 1, "size" => "lg", "bg" => "bg-primary"));

echo $CORE_UI->RATING("score", array("css" => "", "total" => 5, "reviews" => 1, "size" => "lg", "bg" => "bg-primary"));

 echo $CORE_UI->RATING("score", array("css" => "", "total" => 4, "reviews" => 1, "size" => "lg", "bg" => "bg-primary")); 

echo $CORE_UI->RATING("score", array("css" => "", "total" => 3, "reviews" => 1, "size" => "lg", "bg" => "bg-primary"));

echo $CORE_UI->RATING("score", array("css" => "", "total" => 2, "reviews" => 1, "size" => "lg", "bg" => "bg-primary"));

echo $CORE_UI->RATING("score", array("css" => "", "total" => 1, "reviews" => 1, "size" => "lg", "bg" => "bg-primary"));

echo "<hr>";

echo $CORE_UI->RATING("score", array("css" => "", "total" => 4, "reviews" => 1, "size" => "xs", "bg" => "bg-primary"));

echo $CORE_UI->RATING("score", array("css" => "", "total" => 4, "reviews" => 1, "size" => "sm", "bg" => "bg-primary"));

echo $CORE_UI->RATING("score", array("css" => "", "total" => 5, "reviews" => 1, "size" => "md", "bg" => "bg-primary"));

echo $CORE_UI->RATING("score", array("css" => "", "total" => 5, "reviews" => 1, "size" => "lg", "bg" => "bg-primary"));

echo $CORE_UI->RATING("score", array("css" => "", "total" => 5, "reviews" => 1, "size" => "xl", "bg" => "bg-primary"));


$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Score Rating",
	"desc" => "",
	"data" => $output,
);
 
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();

?>


<div><?php echo $CORE_UI->RATING("stars", array("css" => "", "total" => 52323, "total_show" => "1",  "reviews" => 5,  "reviews_show" => 1, "size" => "lg", "tooltip" => 1)); ?></div>

<hr />

   
<div class="mb-2"><?php echo $CORE_UI->RATING("stars", array("css" => "", "total" => 1, "total_show" => "1", "reviews_show" => 1, "reviews" => 1, "size" => "lg", "bg" => "bg-primary")); ?></div>
<div class="mb-2"><?php echo $CORE_UI->RATING("stars", array("css" => "", "total" => 2, "total_show" => "1", "reviews_show" => 1, "reviews" => 2, "size" => "lg", "bg" => "bg-primary")); ?></div>
<div class="mb-2"><?php echo $CORE_UI->RATING("stars", array("css" => "", "total" => 3, "total_show" => "1", "reviews_show" => 1, "reviews" => 3, "size" => "lg", "bg" => "bg-primary")); ?></div>
<div class="mb-2"><?php echo $CORE_UI->RATING("stars", array("css" => "", "total" => 4, "total_show" => "1", "reviews_show" => 1, "reviews" => 4, "size" => "lg", "bg" => "bg-primary")); ?></div>
<div><?php echo $CORE_UI->RATING("stars", array("css" => "", "total" => 5, "reviews_show" => 1, "reviews" => 5, "total_show" => "1", "size" => "lg", "bg" => "bg-primary")); ?></div>
 
<?php

$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Star Rating With Full Results",
	"desc" => "",
	"data" => $output,
);


 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();

?>


<div><?php echo $CORE_UI->RATING("stars", array("css" => "", "total" => 5, "reviews" => 5, "size" => "lg")); ?></div>

<hr />

   
<div class="mb-2"><?php echo $CORE_UI->RATING("stars", array("css" => "", "total" => 1, "reviews" => 0, "size" => "lg", "bg" => "bg-primary")); ?></div>
<div class="mb-2"><?php echo $CORE_UI->RATING("stars", array("css" => "", "total" => 2, "reviews" => 0, "size" => "lg", "bg" => "bg-primary")); ?></div>
<div class="mb-2"><?php echo $CORE_UI->RATING("stars", array("css" => "", "total" => 3, "reviews" => 0, "size" => "lg", "bg" => "bg-primary")); ?></div>
<div class="mb-2"><?php echo $CORE_UI->RATING("stars", array("css" => "", "total" => 4, "reviews" => 0, "size" => "lg", "bg" => "bg-primary")); ?></div>
<div><?php echo $CORE_UI->RATING("stars", array("css" => "", "total" => 5, "reviews" => 0, "size" => "lg", "bg" => "bg-primary")); ?></div>
 
<?php

$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Star Rating Without Reviews",
	"desc" => "",
	"data" => $output,
);


 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();

?>


<div><?php echo $CORE_UI->RATING("stars", array("css" => "", "total" => 5, "reviews" => 5, "total_show" => "0", "reviews_show" => 0, "size" => "lg")); ?></div>

<hr />

   
<div class="mb-2"><?php echo $CORE_UI->RATING("stars", array("css" => "", "total" => 5, "total_show" => "0", "reviews_show" => 0,"reviews" => 0, "size" => "lg", "bg" => "bg-primary")); ?></div>
<div class="mb-2"><?php echo $CORE_UI->RATING("stars", array("css" => "", "total" => 4, "total_show" => "0", "reviews_show" => 0,"reviews" => 0, "size" => "lg", "bg" => "bg-primary")); ?></div>
<div class="mb-2"><?php echo $CORE_UI->RATING("stars", array("css" => "", "total" => 3, "total_show" => "0", "reviews_show" => 0,"reviews" => 0, "size" => "lg", "bg" => "bg-primary")); ?></div>
<div class="mb-2"><?php echo $CORE_UI->RATING("stars", array("css" => "", "total" => 2, "total_show" => "0", "reviews_show" => 0,"reviews" => 0, "size" => "lg", "bg" => "bg-primary")); ?></div>
<div><?php echo $CORE_UI->RATING("stars", array("css" => "", "total" => 1, "total_show" => "0", "reviews_show" => 0, "reviews" => 2, "size" => "lg", "bg" => "bg-primary")); ?></div>
 
<?php

$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Star Rating Without Reviews &amp; Total",
	"desc" => "",
	"data" => $output,
);

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();

?>


 
   
<div class="mb-2"><?php echo $CORE_UI->RATING("stars", array("css" => "", "total" => 5, "reviews" => 5, "size" => "lg", "tooltip" => 1)); ?></div>
 
 
<?php

$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Star Rating + Tooltip",
	"desc" => "",
	"data" => $output,
);

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();

?>


 
 <div class="mb-2"><?php echo $CORE_UI->RATING("stars", array("css" => "", "total" => 5, "reviews" => 1, "size" => "lg", "tooltip" => 1, "short" => 1, "bg" => "bg-primary")); ?></div>
<hr />
<div class="mb-2"><?php echo $CORE_UI->RATING("stars", array("css" => "", "total" => 5, "reviews" => 2, "size" => "lg", "tooltip" => 1, "short" => 1)); ?></div>
 <hr />   
<div class="mb-2"><?php echo $CORE_UI->RATING("stars", array("css" => "", "total" => 0, "reviews" => 3, "size" => "lg", "tooltip" => 1, "short" => 1)); ?></div>
 
 
<?php

$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Short Style",
	"desc" => "",
	"data" => $output,
);

 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();

echo $CORE_UI->RATING("stars", array("css" => "mb-3 btn-block", "total" => 1, "reviews" => 5, "size" => "xs")); 

echo $CORE_UI->RATING("stars", array("css" => "mb-3 btn-block", "total" => 2, "reviews" => 5, "size" => "sm"));

echo $CORE_UI->RATING("stars", array("css" => "mb-3 btn-block", "total" => 3, "reviews" => 5, "size" => "md")); 

echo $CORE_UI->RATING("stars", array("css" => "mb-3 btn-block", "total" => 4, "reviews" => 5, "size" => "lg"));


echo "<hr>";

echo $CORE_UI->RATING("stars", array("css" => "mb-3 btn-block", "total" => 1, "reviews" => 5, "size" => "xs", "bg" => "bg-primary")); 

echo $CORE_UI->RATING("stars", array("css" => "mb-3 btn-block", "total" => 2, "reviews" => 5, "size" => "sm", "bg" => "bg-primary"));

echo $CORE_UI->RATING("stars", array("css" => "mb-3 btn-block", "total" => 3, "reviews" => 5, "size" => "md", "bg" => "bg-primary")); 

echo $CORE_UI->RATING("stars", array("css" => "mb-3 btn-block", "total" => 4, "reviews" => 5, "size" => "lg", "bg" => "bg-primary"));




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
_docsSection($menu);

?>