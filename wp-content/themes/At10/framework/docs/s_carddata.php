<?php

global $CORE, $CORE_UI, $userdata;

 
 ?>
 
 <?php
$themes = array("at","ct","cm","dl","dt","da","es","ll","ph","pj","mj","rt","sp","so","vt"); //"cp",
foreach($themes as $t){

$GLOBALS['TEST_THEME_KEY'] = $t;
$fieldsData = "";
$fieldsData = ppt_theme_card_data('defaults');

echo $t;
?>
 
<textarea class="w-100" style="height:250px;"><?php print_r($fieldsData); ?></textarea>

<?php 


foreach($fieldsData as $k => $v){ 

if(!isset($v['example'])){ $v['example'] = ""; }

echo "<span class='mr-3'>".$k." <span class='fs-sm'>(".$v['example'].")</span></span>";
}

$grid_top = array();

$grid_bottom = array(); 

$list_top = array();

$list_bottom = array();

$mobile =  array(); 

$single_short = array();

$single_long = array();

foreach($fieldsData as $k => $v){ 

	if(isset($v['show'])){
		
		if(in_array("single_short",$v['show'])){
		  $single_short[] = $v;
		}
		
		if(in_array("single_long",$v['show'])){
		  $single_long[] = $v;
		}
		
		if(in_array("grid_top",$v['show'])){
		  $grid_top[] = $v;
		}
		if(in_array("grid_bottom",$v['show'])){
		  $grid_bottom[] = $v;
		}
		
		if(in_array("list_top",$v['show'])){
		  $list_top[] = $v;
		}
		if(in_array("list_bottom",$v['show'])){
		  $list_bottom[] = $v;
		}
		
		if(in_array("mobile",$v['show'])){
		  $mobile[] = $v;
		}
	} 
}
echo "<hr><strong>Grid Top</strong>: ";
foreach($grid_top as $k => $v){ 

echo "<span class='mr-3 badge badge-primary'>".$v['name']."</span>";
}
echo "<br><br><strong>Grid Bottom</strong>: ";
foreach($grid_bottom as $k => $v){ 

echo "<span class='mr-3 badge badge-primary'>".$v['name']."</span>";
}


echo "<hr><strong>List Top</strong>: ";
foreach($list_top as $k => $v){ 

echo "<span class='mr-3 badge badge-secondary'>".$v['name']."</span>";
}
echo "<br><br><strong>List Bottom</strong>: ";
foreach($list_bottom as $k => $v){ 

echo "<span class='mr-3 badge badge-secondary'>".$v['name']."</span>";
}

echo "<hr><strong>Single Short</strong>: ";
foreach($single_short as $k => $v){ 

echo "<span class='mr-3 badge badge-warning'>".$v['name']."</span>";
}

echo "<br><br><strong>Single Long</strong>: ";
foreach($single_long as $k => $v){ 

echo "<span class='mr-3 badge badge-warning'>".$v['name']."</span>";
}

echo "<hr><strong>Mobile</strong>: ";
foreach($mobile as $k => $v){ 

echo "<span class='mr-3 badge badge-danger'>".$v['name']."</span>";
}
echo "<hr />";

}
?>
 