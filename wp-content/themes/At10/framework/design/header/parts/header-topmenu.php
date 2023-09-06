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

global $CORE, $userdata, $settings, $CORE_UI, $df;



if(isset($settings['topmenu_show']) && $settings['topmenu_show'] == "yes"){ 

// LANGUAGES
$languages =  $CORE->GEO("get_languagelist",array()); 
 
// CURRENCY
$currency =  $CORE->GEO("get_currencylist",array()); 
if(!isset($settings['topmenu_bg']) || isset($settings['topmenu_bg']) && $settings['topmenu_bg'] == ""){
	$settings['topmenu_bg'] = "bg-dark";
}

// CUSTOM LOGIN PAGE
$login_form = _ppt(array('design','login_layout'));

 
 
?>

<nav class="elementor_topmenu d-none d-md-block <?php if(isset($settings['topmenu_bg'])){ echo $settings['topmenu_bg']; } ?> text-light">
  <div class="container"> 
  
    <div class="row">
      <div class="col-md-6 pr-0"> <?php echo str_replace("menu-item","list-inline-item",do_shortcode('[MAINMENU topnav=1 class="clearfix mb-0 seperator list-inline mb-0"][/MAINMENU]')); ?> </div>
      <div class="col d-none d-md-block">
        <ul class="list-inline p-0 mb-0 float-right seperator">
        
          <?php if(is_array($currency) && !empty($currency) ){  $dfc = $CORE->GEO("get_currency_icon",array()); ?>
          
          <li class="list-inline-item dropdown w  hide-mobile"> <a href="#" class="dropdown-toggle noc" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          
           	 <?php if(strpos($dfc, "fa") !== false){ ?>
              <i class="<?php echo $dfc; ?>"></i>
              <?php }else{ ?>
              <span><?php echo $dfc; ?></span>
              <?php } ?>
          </a>
            
            
            <div class="dropdown-menu mt-n2">
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
          <li class="list-inline-item">
          <a <?php if(in_array($login_form,array("","0"))){ ?>href="javascript:void(0);" onclick="processLogin();"<?php }else{ ?>href="<?php echo wp_login_url(); ?>"<?php } ?>> <?php echo __("Sign In","premiumpress"); ?></a>         
           </li>
           <?php if( ( defined('WLT_DEMOMODE') ||  get_option('users_can_register') == 1 )   ){ ?>
          <li class="list-inline-item">
          <a href="<?php echo wp_registration_url(); ?>"> <?php echo __("Register","premiumpress"); ?></a>         
           </li>
           <?php } ?>
           
          <?php }else{ ?>
          <li class="list-inline-item"> <a class="sign-up  lrm-register" href="<?php echo _ppt(array('links','myaccount')); ?>"> <?php echo __("My Account","premiumpress"); ?></a> </li>
          
		  <li class="list-inline-item"> <a class="sign-up  lrm-register" href="<?php echo wp_logout_url(home_url()); ?>"> <?php echo __("Logout","premiumpress"); ?></a> </li>
		  <?php } ?>
          
          
          <?php if(is_array($languages) && !empty($languages)){ ?>
          <li class="list-inline-item w dropdown hide-mobile"> <a href="#" class="dropdown-toggle noc" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="flag flag-<?php echo $CORE->GEO("get_language_icon",array());  ?>">&nbsp;</span></a>
            <div class="dropdown-menu mt-n2">
              <?php foreach($languages as $h){ ?>
              <a class="dropdown-item" href="<?php echo $h['link']; ?>"><i class="<?php echo $h['icon']; ?> float-right mt-2"></i> <?php echo $h['name']; ?></a>
              <?php } ?>
            </div>
          </li>
          <?php } ?>
          <li class="list-inline-item px-0 hide-ipad">
          
          <?php echo $CORE_UI->ICONS("social", array("uid" => 0, "css" => "", "style" => "2", "size" => "xs", "website" => 1, "header" => 1)); ?>
           
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>
<?php } ?>
