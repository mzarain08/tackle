<?php
/* 
* Theme: PREMIUMPRESS CORE FRAMEWORK FILE
* Url: www.premiumpress.com
* Author: Mark Fail
*
* THIS FILE WILL BE UPDATED WITH EVERY UPDATE
* IF YOU WANT TO MODIFY THIS FILE, CREATE A CHILD THEME
*
* http://codex.wordpress.org/Child_Themes
*/
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }

global $CORE, $userdata, $post;
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

// LIMIT
$limit = 4;
if(in_array(THEME_KEY,array("cp"))){
$limit = 8;
}

 
ob_start();		
if(defined('WLT_DEMOMODE') && in_array(THEME_KEY,array("es"))){
	$data =  str_replace("data-src","src", str_replace(".00","", do_shortcode('[LISTINGS perrow=4 nav=0 orderby=rand small=1 show=4 custom=random hide="'.$post->ID.'"]'))); 
}elseif(defined('WLT_DEMOMODE') && THEME_KEY != "da"){
	$data =  str_replace("data-src","src", str_replace(".00","", do_shortcode('[LISTINGS perrow=4 nav=0 orderby=rand small=1 show='.$limit.' custom=rel hide="'.$post->ID.'"]'))); 
}else{
	$data =  str_replace("data-src","src", str_replace(".00","",do_shortcode('[LISTINGS perrow=4 nav=0 orderby=rand small=1 show='.$limit.' custom=related hide="'.$post->ID.'"]'))); 
}
$data .= ob_get_contents();	
ob_end_clean(); 
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////	

if(strlen($data) < 100){
 
	$data =  do_shortcode('[LISTINGS perrow=4 nav=0 orderby=rand small=1 custom="new" show="'.$limit.'" card="grid" hide="'.$post->ID.'"]'); 
}


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

echo $data; 

?>