<?php

global $CORE, $CORE_UI, $userdata;

$menu = array();
 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
$overlays = array("bg-overlay-dark","bg-overlay-grey","bg-overlay-primary bg-primary","bg-overlay-secondary bg-secondary","bg-gradient","bg-gradient-left","bg-overlay-gradient-left-small","bg-gradient-small");
 
ob_start();
 ?>

<div class="row">
<?php foreach($overlays as $o){ ?>

<div class="col-md-4 mb-4">


<div style="height:150px;" class="overflow-hidden position-relative y-middle">

    <div class="<?php echo $o; ?>"></div>
    
    <div class="z-1 text-700"><?php echo $o; ?></div>

</div>

</div>

<?php } ?>
</div>
 
<?php
$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Overlays",
	"desc" => "",
	"data" => $output,
);
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
_docsSection($menu);

?>