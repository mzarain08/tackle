<?php

global $CORE, $CORE_UI, $userdata;

 
   
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();

?>

<div class="text-600 fs-md mb-4">Icon only</div>

<?php echo do_shortcode('[BUTTON_USER type="favs" class="btn btn-system" icon=1 uid="'.$userdata->ID.'"]'); ?>
<?php echo do_shortcode('[BUTTON_USER type="subscribe" class="btn btn-system" icon=1 uid="'.$userdata->ID.'"]'); ?>
<?php echo do_shortcode('[BUTTON_USER type="block" class="btn btn-system" icon=1 uid="'.$userdata->ID.'"]'); ?>

<?php echo do_shortcode('[BUTTON_USER type="like" class="btn btn-system" icon=1 uid="'.$userdata->ID.'"]'); ?>
<?php echo do_shortcode('[BUTTON_USER type="dislike" class="btn btn-system" icon=1 uid="'.$userdata->ID.'"]'); ?>



<hr />
<div class="text-600 fs-md mb-4">Text only</div>

<?php echo do_shortcode('[BUTTON_USER type="favs" class="btn btn-system" text=1 uid="'.$userdata->ID.'"]'); ?>
<?php echo do_shortcode('[BUTTON_USER type="subscribe" class="btn btn-system" text=1 uid="'.$userdata->ID.'"]'); ?>
<?php echo do_shortcode('[BUTTON_USER type="block" class="btn btn-system" text=1 uid="'.$userdata->ID.'"]'); ?>

<?php echo do_shortcode('[BUTTON_USER type="like" class="btn btn-system" text=1 uid="'.$userdata->ID.'"]'); ?>
<?php echo do_shortcode('[BUTTON_USER type="dislike" class="btn btn-system" text=1 uid="'.$userdata->ID.'"]'); ?>

<hr />
<div class="text-600 fs-md mb-4">Text No Style</div>

<?php echo do_shortcode('[BUTTON_USER type="favs" button="0" class="" text=1 uid="'.$userdata->ID.'"]'); ?>
<?php echo do_shortcode('[BUTTON_USER type="subscribe" button="0" class="" text=1 uid="'.$userdata->ID.'"]'); ?>
<?php echo do_shortcode('[BUTTON_USER type="block" button="0" class="" text=1 uid="'.$userdata->ID.'"]'); ?>

<?php echo do_shortcode('[BUTTON_USER type="like" button="0" class="" text=1 uid="'.$userdata->ID.'"]'); ?>
<?php echo do_shortcode('[BUTTON_USER type="dislike" button="0" class="" text=1 uid="'.$userdata->ID.'"]'); ?>

<?php

$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Subscribe Buttons",
	"desc" => "",
	"data" => $output,
);
 
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
_docsSection($menu);
?> 