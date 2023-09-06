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
if (!headers_sent()){ header('X-UA-Compatible: IE=edge'); }
 

global $CORE, $post, $userdata; 



///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

ob_start();
language_attributes();
$ll = ob_get_contents();
ob_end_clean(); 
if(!$CORE->GEO("is_right_to_left", array() ) ){
	$ll = str_replace('dir="rtl"','',$ll);
	$ll = str_replace('lang="ar"','',$ll);
}
				

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
<!DOCTYPE html>
<html xmlns="https://www.w3.org/1999/xhtml" <?php echo $ll;  ?>>
<!--[if lte IE 8 ]><html lang="en" class="ie ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="ie"><![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge" /><![endif]-->
    <title><?php echo _ppt_meta_title(); ?></title>
    
    <?php wp_head();  ?> 
    
</head>
<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

ob_start();
body_class();
$bc = ob_get_contents();
ob_end_clean(); 
if(!$CORE->GEO("is_right_to_left", array() ) ){
	$bc = str_replace("rtl ","",$bc);
}

?>
<body <?php echo $bc; ?> >

<?php 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if(_ppt_livepreview()){ 

	_ppt_template( '_preview' );  


}else{ 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


?>
<div id="wrapper" style="display:none;" class="<?php if(_ppt(array('design','sidebar_open')) == "1"){ ?>toggled<?php } ?>">

<div id="sidebar-wrapper"  style="<?php  if(_ppt(array('design','sidebar_open')) != "1"){ echo "display:none;"; } ?> <?php if(strlen(_ppt(array('design','sidebar_bg'))) > 1){ echo 'background:'._ppt(array('design','sidebar_bg')); } ?>" class="<?php if(in_array(_ppt(array('design','mobile_sidebar_shadow')), array("1",""))){ ?>shadow<?php } ?>">
<?php if(_ppt(array('design','sidebar_open')) == "1"){ _ppt_template( 'ajax/ajax-sidebar' ); } ?>
</div>

<main id="page-content-wrapper" <?php if(_ppt('footer_mobile_menu') == "1"){ ?>class="with-mobilemenu"<?php } ?>>

<?php if(isset($GLOBALS['flag-blankpage'])){
     
                     
    }else{
    
        _ppt_template( 'header', 'menu' ); 
		
		echo $CORE->ADVERTISING("display_banner", "header" ); 		
	
	} ?>
    
<?php } 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


if(defined('WLT_DEMOMODE')){

 _ppt_template( 'header', 'demo' ); 
 
}

?>

 