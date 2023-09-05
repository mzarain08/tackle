<?php

global $CORE, $CORE_UI, $userdata;

$menu = array();
 






///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();


?>

.ppt-animate-single-rise

<h1 class="ppt-animate-single-rise ppt-animate-repeat mt-4"> Build Amazing Websites Today! </h1>  

<hr />

<h1 class="ppt-animate-single-slide-left ppt-animate-repeat mt-4"> Build Amazing Websites Today! </h1>  

<hr />
.ppt-animate-zoom-in
<h1 class="ppt-animate-zoom-in ppt-animate-repeat mt-4"> Build Amazing Websites Today! </h1>  

<hr />
.ppt-animate-rubberBand
<h1 class="ppt-animate-rubberBand ppt-animate-repeat mt-4"> Build Amazing Websites Today! </h1>  

<?php

$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Aniimated Text",
	"desc" => "",
	"data" => $output,
);












ob_start();
_ppt_template( 'framework/design/widgets/pop1' ); 
$pop1 = ob_get_contents();
ob_end_clean(); 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();


?>

<div ppt-flex-between>


<div class="p-3" ppt-border1><?php echo $pop1; ?></div>


</div>

<?php

$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Popup Circles",
	"desc" => "",
	"data" => $output,
);

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();


?>

<div ppt-flex-between>


<div class="p-3" ppt-border1> <div class="mb-3">Small </div><?php echo $pop1; ?></div>
<div class="p-3 medium" ppt-border1> <div class="mb-3">Medium </div><?php echo $pop1; ?></div>
<div class="p-3 large" ppt-border1> <div class="mb-3">Large </div><?php echo $pop1; ?></div>

</div>

<?php

$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Popup Sizes",
	"desc" => "",
	"data" => $output,
);

  
 
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
_docsSection($menu);

?>