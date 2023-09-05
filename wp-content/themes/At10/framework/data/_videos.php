<?php
/* 
* Theme: PREMIUMPRESS CORE FRAMEWORK FILE
* Url: www.premiumpress.com
* Author: Mark Fail1
*
* THIS FILE WILL BE UPDATED WITH EVERY UPDATE
* IF YOU WANT TO MODIFY THIS FILE, CREATE A CHILD THEME
*
* http://codex.wordpress.org/Child_Themes
*/ 

/// NOTICE
// ALL IMAGES ARE EMBDED WITH COPYRIGHT CONTENT
// DO NOT STEAL
 
$videos = array();

// FOOD
$store['vid1'] = array(
'title' => "Nigella’s Cook, Eat, Repeat", 
'image' => 'http://localhost/vids/food1.jpg', 
'desc' => "Nigella shares her take on the bhorta, a dish of fried and mashed vegetables favoured in the Indian subcontinent, to which she introduces a very British ingredient",

'cat' => "Food"
);

$store['vid2'] = array(
'title' => "Nadiya's Fast Flavours", 
'image' => 'http://localhost/vids/food2.jpg', 
'desc' => "Bringing back the fun into our everyday meals",
'cat' => "Food"
);

$store['vid3'] = array(
'title' => "Thrifty Cooking in the Doctor’s Kitchen", 
'image' => 'http://localhost/vids/food3.jpg', 
'desc' => "Bringing back the fun into our everyday meals",
'cat' => "Food"
);

$store['vid4'] = array(
'title' => "Paula McIntyre’s Hamely Kitchen", 
'image' => 'http://localhost/vids/food4.jpg', 
'desc' => "Bringing back the fun into our everyday meals",
'cat' => "Food"
);

$store['vid5'] = array(
'title' => "Cooking in the Doctor's Kitchen", 
'image' => 'http://localhost/vids/food5.jpg', 
'desc' => "Bringing back the fun into our everyday meals",
'cat' => "Food"
);

 

$GLOBALS['_list'] = $store;
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

function filterme($t){

$t = strtolower(str_replace("&","",str_replace(",","",str_replace(" ","",str_replace("'","",$t)))));

return $t;

}

?>