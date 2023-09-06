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

global $CORE, $settings, $userdata;
 
 
$settings['btn'] = "yes";
 
if($settings['btn_bg_txt'] == ""){ $settings['btn_bg_txt'] ="text-light"; }
if($settings['btn_bg'] == ""){ $settings['btn_bg'] ="primary"; }
if($settings['btn_txt'] == ""){ $settings['btn_txt'] = "<i class='fa fa-plus'></i> add new";  }


if(_ppt(array('newheader','btn_txt')) != ""){
 $settings['btn_txt'] = _ppt(array('newheader','btn_txt'));
}
 			 
			
?>

<ul class="list-inline mb-0 small-list">
  <li class="list-inline-item ">
 
  <?php _ppt_template( 'framework/design/header/parts/header-languages' ); ?>
 
  </li>
  <li class="list-inline-item hide-mobile mr-0 pr-0">
    <?php
			 
			 if(THEME_KEY == "sp"){
			 
			 _ppt_template( 'framework/design/parts/cart' ); 
			 
			 }else{		 
			 
			  _ppt_template( 'framework/design/parts/btn' ); 
			  
			 } 
			  
			  ?>
  </li>
</ul>
