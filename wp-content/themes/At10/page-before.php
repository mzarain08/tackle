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

global $CORE;

if(!isset($GLOBALS['flag-blog'])){

 _ppt_template( 'page-breadcrumbs' ); 

}
?>
<div class="bg-light ppt-page-body">
<?php
if( _ppt(array('design', 'customsidebar')) == 1 || isset($GLOBALS['flag-page-sidebar']) ){

?>

<div class="container pt-4 ">

<div class="row <?php if( isset($GLOBALS['flag-blog']) ){ }else{ ?>d-md-flex flex-row-reverse<?php } ?>">
	
   
    <div class="col-lg-9">
    
    	<div class="<?php if(isset($GLOBALS['flag-page-nopadding'])){ }else{ ?>card-page<?php } ?> card-mobile-transparent mobile-negative-margin-x">
    
    		<div class="<?php if(isset($GLOBALS['flag-page-nopadding'])){ }else{ ?>card-body<?php } ?>">
    
<?php  }  ?>