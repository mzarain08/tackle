<?php

global $CORE, $CORE_UI, $userdata;



ob_start();
_ppt_template( 'cards/themes/search1' ); 
$search1 = ob_get_contents();
ob_end_clean(); 

ob_start();
_ppt_template( 'cards/themes/search2' ); 
$search2 = ob_get_contents();
ob_end_clean(); 

ob_start();
_ppt_template( 'cards/themes/search3' ); 
$search3 = ob_get_contents();
ob_end_clean(); 

ob_start();
_ppt_template( 'cards/themes/search4' ); 
$search4 = ob_get_contents();
ob_end_clean(); 

ob_start();
_ppt_template( 'cards/themes/search5' ); 
$search5 = ob_get_contents();
ob_end_clean(); 

ob_start();
_ppt_template( 'cards/themes/search6' ); 
$search6 = ob_get_contents();
ob_end_clean(); 

ob_start();
_ppt_template( 'cards/themes/search7' ); 
$search7 = ob_get_contents();
ob_end_clean(); 

ob_start();
_ppt_template( 'cards/themes/search_cp' ); 
$search_cp = ob_get_contents();
ob_end_clean(); 
 

ob_start();
_ppt_template( 'cards/themes/search_list1' ); 
$list1 = ob_get_contents();
ob_end_clean(); 

ob_start();
_ppt_template( 'cards/themes/search_list_cp' ); 
$listcp = ob_get_contents();
ob_end_clean(); 
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
 
  
 
 
 
 
ob_start();

?>
<div class="row">
<div class="col-md-6 col-xl-3">
<?php 


$data = ppt_theme_block_output($search1, array(
//"title" 			=> "123", 
//"subtitle" 			=> "456", 
 

),array("widget")); 
 

echo $data;
 
 ?>
</div>
<div class="col-md-6 col-xl-3">
<?php 


$data = ppt_theme_block_output($search2, array(
//"title" 			=> "123", 
//"subtitle" 			=> "456", 
 

),array("widget")); 
 

echo $data;
 
 ?>
</div>

<div class="col-md-6 col-xl-3">
<?php 


$data = ppt_theme_block_output($search3, array(
//"title" 			=> "123", 
//"subtitle" 			=> "456", 
 

),array("widget")); 
 

echo $data;
 
 ?>
</div>

<div class="col-md-6 col-xl-3">
<?php 


$data = ppt_theme_block_output($search4, array(
//"title" 			=> "123", 
//"subtitle" 			=> "456", 
 

),array("widget")); 
 

echo $data;
 
 ?>
</div>

<div class="col-md-6 col-xl-3">
<?php 


$data = ppt_theme_block_output($search5, array(
//"title" 			=> "123", 
//"subtitle" 			=> "456", 
 

),array("widget")); 
 

echo $data;
 
 ?>
</div>


<div class="col-md-6 col-xl-3">
<?php 


$data = ppt_theme_block_output($search6, array(
//"title" 			=> "123", 
//"subtitle" 			=> "456", 
 

),array("widget")); 
 

echo $data;
 
 ?>
</div>


<div class="col-md-6 col-xl-3">
<?php 


$data = ppt_theme_block_output($search7, array(
//"title" 			=> "123", 
//"subtitle" 			=> "456", 
 

),array("widget")); 
 

echo $data;
 
 ?>
</div>

<div class="col-md-6 col-xl-3">
<?php 


$data = ppt_theme_block_output($search_cp, array(
//"title" 			=> "123", 
//"subtitle" 			=> "456", 
 

),array("widget")); 
 

echo $data;
 
 ?>
</div>


</div>
<?php 

$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Grid Cards",
	"desc" => "",
	"data" => $output,
);



///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


 
 
ob_start();

?>
<div class="row">
<div class="col-12">
<?php 


$data = ppt_theme_block_output($list1, array(
//"title" 			=> "123", 
//"subtitle" 			=> "456", 
 

),array("widget")); 
 

echo $data;
 
 ?>
</div>

<div class="col-12">
<?php 


$data = ppt_theme_block_output($listcp, array(
//"title" 			=> "123", 
//"subtitle" 			=> "456", 
 

),array("widget")); 
 

echo $data;
 
?>
</div>

 


</div>
<?php 

$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "List Cards",
	"desc" => "",
	"data" => $output,
);





ob_start();

 

?>

<div class="col-md-6 col-xl-3">
 <?php echo $CORE_UI->PLACEHOLDER("grid"); ?> 
</div>

<hr />
<div class="col-12">
 <?php echo $CORE_UI->PLACEHOLDER("list"); ?> 
</div>

<?php 

 

$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Placeholders",
	"desc" => "",
	"data" => "<div class='row'>".$output."</div>",
);



 
ob_start();

$themes = array("at","ct","cm","dl","dt","da","es","ll","ph","pj","mj","rt","sp","so","vt"); //"cp",
foreach($themes as $t){

$GLOBALS['TEST_THEME_KEY'] = $t;


ob_start();
_ppt_template( 'cards/themes/search_'.$t ); 
$listcp = ob_get_contents();
ob_end_clean(); 



?>

<div class="col-md-6 col-xl-3">
   
        <div><?php echo $t; ?></div>
        
        <?php echo $listcp; ?>
        
</div>
<?php 

}

$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Theme Cards",
	"desc" => "",
	"data" => "<div class='row'>".$output."</div>",
);

 
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
_docsSection($menu); 

  
?>