<?php

global $CORE, $CORE_UI, $userdata;

 
 ?>
 
 <?php
$themes = array("at","ct","cm","dl","dt","da","es","ll","ph","pj","mj","rt","sp","so","vt"); //"cp",
foreach($themes as $t){

$GLOBALS['TEST_THEME_KEY'] = $t;
$fieldsData = "";
$fieldsData = ppt_theme_listing_buttons('defaults');

echo $t;
?>
 
<textarea class="w-100" style="height:250px;"><?php print_r($fieldsData); ?></textarea>

<?php 


foreach($fieldsData as $k => $v){ 

 
echo "<span class='mr-3 text-500 btn-system' data-ppt-btn>".$v['name']."</span>";
}

$grid_top = array(); $grid_bottom = array(); $mobile =  array(); $single_top = array();

foreach($fieldsData as $k => $v){ 

	if(isset($v['show'])){
		
		if(in_array("single_top",$v['show'])){
		  $single_top[] = $v;
		}
		 
	} 
}
 
echo "<br><br><strong>Single Top</strong>: ";
foreach($single_top as $k => $v){ 

echo "<span class='mr-3'>".$v['name']."</span>";
}
 
echo "<hr />";

}
?>
 