<?php

global $CORE, $CORE_UI, $userdata;
 


ob_start();

$themes = array("at","ct","cm","dl","dt","da","es","ll","ph","pj","mj","rt","sp","so","vt"); //"cp",
foreach($themes as $t){

$GLOBALS['TEST_THEME_KEY'] = $t; 



?>

<div class="col-md-6 col-xl-3">
    <div><?php echo $t; ?></div>
    <hr />
    <textarea style="height:300px;" class="w-100"><?php print_r(ppt_theme_listing_blocks()); ?></textarea>
</div>
<?php 

}

$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "All Theme Buttons",
	"desc" => "",
	"data" => "<div class='row'>".$output."</div>",
);


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
_docsSection($menu);


?> 