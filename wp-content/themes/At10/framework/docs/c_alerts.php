<?php

global $CORE, $CORE_UI, $userdata;

?>

 
<?php

$menu = array();
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
?>


<div class="alert alert-success p-3">

    <div class="d-flex">
        <div class="ml-3">
        <div ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['check-circle']; ?></div>
        </div>    
        <div class="ml-3">
        An example alert with an icon
        </div>    
    </div>

</div>


<div class="alert alert-warning p-3 mt-4">

    <div class="d-flex">
        <div class="ml-3">
        <div ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['check-circle']; ?></div>
        </div>    
        <div class="ml-3">
        An example alert with an icon
        </div>    
    </div>

</div>

<div class="alert alert-danger p-3 mt-4">

    <div class="d-flex">
        <div class="ml-3">
        <div ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['check-circle']; ?></div>
        </div>    
        <div class="ml-3">
        An example alert with an icon
        </div>    
    </div>

</div>

<?php
$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Basic",
	"desc" => "",
	"data" => $output,
);



_docsSection($menu);

?> 