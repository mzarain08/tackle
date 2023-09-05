<?php

global $CORE, $CORE_UI, $userdata;

 

ob_start();
_ppt_template( 'single/single-content-data-gifts' );
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

	"name" => "Gifts Unstyled",
	"desc" => "",
	"data" => $output,
);



///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
 

?>

<nav ppt-nav ppt-flex>
<ul class="d-flex justify-content-between">

<li>
<div class="ppt-empty-box">
Empty
</div>
</li>

<li>
<div class="ppt-empty-box">
Empty
</div>
</li>

<li>
<div class="ppt-empty-box">
Empty
</div>
</li>

<li>
<div class="ppt-empty-box">
Empty
</div>
</li>

<li>
<div class="ppt-empty-box">
Empty
</div>
</li>

</ul>
</nav>

 
<?php

$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Gifts Styled",
	"desc" => "",
	"data" => $output,
);

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
 

?>
<div ppt-box class="rounded">
 

    
<div class="_header border-top" ppt-flex-row>
<div class="_title w-100"><?php echo __("Gifts Received","premiumpress"); ?></div>
</div>
    <div class="_content p-3">
    
    <?php echo $author; ?>
    
    </div>  
    
    <div class="_footer small" ppt-flex-row>
    
    Box Footer 
    
    <div ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['arrow-long-right']; ?></div>
    
    </div>

</div>
<?php

$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Gifts Styled",
	"desc" => "",
	"data" => $output,
);
 
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
_docsSection($menu);
?>


<link rel='stylesheet'   href='<?php echo CDN_PATH.'css/css.theme-gallery.css'; ?>' media='all' /> 