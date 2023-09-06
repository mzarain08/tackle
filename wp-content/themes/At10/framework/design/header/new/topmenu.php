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

global $CORE, $userdata, $CORE_UI, $df;


$topMenuCode = "";
 
if($df['topmenu_show'] == "1"){
	
	$settings = array();
	$settings['topmenu_show'] = "yes";
	$settings['topmenu_bg'] = $df['topmenu_bg'];
	
	if(in_array($df['topmenu_bg'],array("bg-light","bg-white","bg-soft"))){ 
	$settings['topmenu_bg'] .= " border-bottom text-dark";
	}else{
	$settings['topmenu_bg'] .= " navbar-dark";
	
	
}
 
// LANGUAGES
$languages =  $CORE->GEO("get_languagelist",array()); 
 
// CURRENCY
$currency =  $CORE->GEO("get_currencylist",array()); 
 
// CUSTOM LOGIN PAGE
$login_form = _ppt(array('design','login_layout'));

if(!isset($df['topmenu_style'])){ $df['topmenu_style'] = 0; }

 
switch($df['topmenu_style']){

 
case "3": {

$footer_phone = "44 1232 9389 1233";
if(strlen(_ppt(array('company','phone')) > 2)){
$footer_phone = _ppt(array('company','phone'));
}

?>

<nav class="py-2 elementor_topmenu <?php if(isset($settings['topmenu_bg'])){ echo $settings['topmenu_bg']; } ?> hide-mobile hide-ipad small text-500" 
<?php if(isset($df['topmenu_bg_color'])){ ?> style="background:<?php echo $df['topmenu_bg_color']; ?>!important;"<?php } ?>>
  <div class="container">
    <div class="row">
      <div class="col-md-6 text-left">
      <nav ppt-nav class="ppt-top-menu pl-0 faded">
      <ul>
      <li class="mr-lg-4"><a  href="<?php echo _ppt(array('links','contact')); ?>"><i class="fal mr-2 fa-envelope"></i> <?php echo __("Open 24/7","premiumpress"); ?></a> </li>
     
     <li><a  href="<?php echo _ppt(array('links','contact')); ?>"><i class="fal mr-2 fa-phone-alt"></i> <?php echo $footer_phone; ?></a> </li>
     
      </ul>
      </nav>
      
      </div>
      <div class="col-md-6  pr-0 text-right" ppt-flex-end>
        <nav ppt-nav class="ppt-top-menu pl-0 faded"> <?php echo do_shortcode('[MAINMENU topnav=1][/MAINMENU]'); ?> </nav>
      </div> 
    </div>
  </div>
</nav>
<?php


} break;
case "2": {

?>

<nav class="py-2 elementor_topmenu <?php if(isset($settings['topmenu_bg'])){ echo $settings['topmenu_bg']; } ?> hide-mobile hide-ipad small text-500" 
<?php if(isset($df['topmenu_bg_color'])){ ?> style="background:<?php echo $df['topmenu_bg_color']; ?>!important;"<?php } ?>>
  <div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-6 pr-0 text-right" ppt-flex-end>
        <nav ppt-nav class="ppt-top-menu pl-0"> <?php echo do_shortcode('[MAINMENU topnav=1][/MAINMENU]'); ?> </nav>
      </div> 
    </div>
  </div>
</nav>
<?php


} break;

default: {
  
?>
<nav class="py-2 elementor_topmenu <?php if(isset($settings['topmenu_bg'])){ echo $settings['topmenu_bg']; } ?> hide-mobile hide-ipad small text-500" 
<?php if(isset($df['topmenu_bg_color'])){ ?> style="background:<?php echo $df['topmenu_bg_color']; ?>!important;"<?php } ?>>
  <div class="container">
    <div class="row">
      <div class="col-md-6 pr-0">
        <nav ppt-nav class="ppt-top-menu pl-0"> <?php echo do_shortcode('[MAINMENU topnav=1][/MAINMENU]'); ?> </nav>
      </div>
      <div class="col d-none d-md-block">
        <nav ppt-nav class="seperator" ppt-flex-end>
          <ul>
            <?php if(is_array($currency) && !empty($currency) ){  $dfc = $CORE->GEO("get_currency_icon",array()); ?>
            <li class="dropdown"> <a href="#" class="dropdown-toggle noc" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?php if(strpos($dfc, "fa") !== false){ ?>
              <i class="<?php echo $dfc; ?>"></i>
              <?php }else{ ?>
              <span><?php echo $dfc; ?></span>
              <?php } ?>
              </a>
              <div class="dropdown-menu">
                <?php  foreach($currency as $h){ ?>
                <a class="dropdown-item" href="<?php echo $h['link']; ?>">
                <?php if(strpos($h['icon'], "fa") !== false){ ?>
                <i class="<?php echo $h['icon']; ?> float-right mt-2"></i>
                <?php }else{ ?>
                <span class="float-right mt-1"><?php echo $h['icon']; ?></span>
                <?php } ?>
                <?php echo $h['name']; ?></a>
                <?php } ?>
              </div>
            </li>
            <?php } ?>
            <?php if(!$userdata->ID){ ?>
            <li> <a <?php if(in_array($login_form,array("","0"))){ ?>href="javascript:void(0);" onclick="processLogin();"<?php }else{ ?>href="<?php echo wp_login_url(); ?>"<?php } ?>><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "sign_in" ) ); ?></a> </li>
            <?php if( ( defined('WLT_DEMOMODE') ||  get_option('users_can_register') == 1 )   ){ ?>
            <li> <a href="<?php echo wp_registration_url(); ?>"><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "register" ) ); ?></a> </li>
            <?php } ?>
            <?php }else{ ?>
            <li> <a class="sign-up  lrm-register" href="<?php echo _ppt(array('links','myaccount')); ?>"><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "my_account" ) ); ?></a> </li>
            <li> <a class="sign-up  lrm-register" href="<?php echo wp_logout_url(home_url()); ?>"><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "logout" ) ); ?></a> </li>
            <?php } ?>
            <?php if(is_array($languages) && !empty($languages)){ ?>
            <li class=" w dropdown hide-mobile"> <a href="#" class="dropdown-toggle noc" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="flag flag-<?php echo $CORE->GEO("get_language_icon",array());  ?>">&nbsp;</span></a>
              <div class="dropdown-menu mt-n2">
                <?php foreach($languages as $h){ ?>
                <a class="dropdown-item" href="<?php echo $h['link']; ?>"><i class="<?php echo $h['icon']; ?> float-right mt-2"></i> <?php echo $h['name']; ?></a>
                <?php } ?>
              </div>
            </li>
            <?php } ?>
            <?php if(in_array(THEME_KEY,array("sp"))){ ?>
            <li> <a class="sign-up  lrm-register" href="<?php echo _ppt(array('links','cart')); ?>"> <?php echo __("Cart","premiumpress"); ?> <span class="cart-basket-count-wrapper" style="display:none;"><i class="fal fa-shopping-basket">&nbsp;</i> <span class="cart-basket-count">0</span></span> </a> </li>
            <?php } ?>
            <?php if($df['topmenu_social'] == "1"){ ?>
            <li class="hide-ipad"> <?php echo $CORE_UI->ICONS("social", array("uid" => 0, "css" => "", "style" => "2", "size" => "xs", "website" => 1, "header" => 1)); ?> </li>
            <?php } ?>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</nav>
<?php } break;

} } 

?>