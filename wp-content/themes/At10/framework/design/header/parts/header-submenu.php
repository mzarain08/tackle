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

global $CORE, $userdata, $settings;


if(!isset($settings['submenu_bg'])){

	$settings['submenu_bg'] = "bg-light";
}

if(!isset($settings['submenu_menu_class'])){

	$settings['submenu_menu_class'] = "";
}

if(!isset($settings['submenu_shadow'])){

	$settings['submenu_shadow'] = "shadow-sm";
}

if(!isset($settings['submenu_css'])){

	$settings['submenu_css'] = "navbar-light py-2";
} 
?>
<nav class="elementor_mainmenu elementor_submenu navbar-bottom navbar navbar-expand-lg d-none d-lg-block <?php echo $settings['submenu_css']; ?> <?php echo $settings['submenu_shadow']; ?> <?php if(isset($settings['submenu_bg'])){ echo $settings['submenu_bg']; } ?> ">
  
  <div class="container <?php if(!in_array( _ppt(array('design','boxed_layout')), array("1","1a","1b") )){ ?>px-md-0<?php } ?>">
    <div class="collapse navbar-collapse main-menu" id="header2menubar"> 
	
	<?php if(isset($settings['seperator'])){ ?>
    <?php echo do_shortcode('[MAINMENU class="navbar-nav seperator '.$settings['submenu_menu_class'].'" style=1]');  ?> 
    <?php }else{ ?>
    <?php echo do_shortcode('[MAINMENU class="navbar-nav '.$settings['submenu_menu_class'].'" style=1]');  ?> 
    <?php } ?>
	</div>
    <?php if($settings['btn_show'] == "yes"){ ?>
    <div class="d-flex align-items-center ml-3 d-none d-lg-block">
      <?php _ppt_template( 'framework/design/parts/btn' ); ?>
    </div>
    <?php } ?>
  </div>
</nav>
