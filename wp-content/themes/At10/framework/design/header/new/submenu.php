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
 
if($df['submenu_show'] == "1"){ 

$SubStyle = "bg-white shadow-sm border-bottom navbar-light ";

switch($df['submenu_bg']){
	
	case "bg-primary":
	case "1": {
	$SubStyle = "bg-primary  navbar-dark";
	$btnColor = "btn-secondary";
	} break;
	
	case "bg-secondary":
	case "2": {
	$SubStyle = "bg-secondary  navbar-dark";
	$btnColor = "btn-primary";
	} break;
	
	case "bg-light":
	case "3": {
	$SubStyle = "bg-light  navbar-light";
	$btnColor = "btn-dark";
	} break;
	
	case "bg-dark":
	case "4": {
	$SubStyle = "bg-dark  navbar-dark";
	$btnColor = "btn-light";
	} break;
	
	case "bg-black":
	case "5": {
	$SubStyle = "bg-black  navbar-dark";
	$btnColor = "btn-white";
	} break;	
	
	case "bg-white":
	case "6": {
	$SubStyle = "bg-white navbar-light";
	$btnColor = "btn-primary";
	} break;
	
	case "bg-white":
	case "7": {
	$SubStyle = "bg-white navbar-light";
	$btnColor = "btn-primary";
	} break;
	
	default: {
	
		$SubStyle = $df['submenu_bg']." navbar-light";
		$btnColor = "btn-light";
		
	}
} 

 
switch($df['submenu_style']){





case "15": {
?>
 

<?php 
} break;




 
case "10": {
?>
<div <?php if(isset($df['submenu_bg_color'])){ ?> style="background:<?php echo $df['submenu_bg_color']; ?>!important;"<?php } ?> class="hide-mobile elementor_submenu py-2 <?php echo $SubStyle; ?> shadow-sm">
  <div class="container ">
<div class="row">
<div class="col-md-5">
 <form method="get" action="<?php echo home_url(); ?>" style="max-width:400px;">
            <div class="bg-white rounded-lg p-1 d-flex">
              <input class="typeahead form-control form-control-lg border-0 mb-0" type="text"  name="s" placeholder="<?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "start_search_here" ) ); ?>">
              <button class="btn-primary btn-search" data-ppt-btn type="submit"><?php echo __("Search","premiumpress"); ?></button>
            </div>
          </form>
</div>
<div class="col-md-7">
 <nav ppt-nav class="seperator spacing text-600 d-flex justify-content-center mt-2"><?php echo do_shortcode('[MAINMENU style=1]');  ?>
    </nav>
</div>
</div>   
  </div>
</div>
<?php 
} break;

case "9": {
?>
<div <?php if(isset($df['submenu_bg_color'])){ ?> style="background:<?php echo $df['submenu_bg_color']; ?>!important;"<?php } ?> class="hide-mobile elementor_submenu py-2 <?php echo $SubStyle; ?> shadow-sm">
 
 
<div id="main-category-wrap">
    <div id="navMenu" class="style2">
      <div id="navMenu-wrapper">
        <ul id="cat-items">
          <div id="menuSelector"></div><?php
  		 
		echo wp_list_categories( array(
                                 								'taxonomy'  	=> 'listing',
                                 								'depth'         => 1,	
                                 								'hierarchical'  => 1,		
                                 								'hide_empty'    => 0,
                                 								'echo'			=> false,
                                 								'title_li' 		=> '',
                                 								'show_count' 	=> 0,
                                 								'orderby' 		=> 'term_order',
                                 							  
                                 								) );
  		?>
        <div class="navMenu-paddles">
          <button class="navMenu-paddle-left i fa <?php if($CORE->GEO("is_right_to_left", array() )){ ?>fa-angle-right<?php }else{ ?>fa-angle-left<?php } ?>"> </button>
          <button class="navMenu-paddle-right fa <?php if($CORE->GEO("is_right_to_left", array() )){  ?>fa-angle-left<?php }else{ ?>fa-angle-right<?php } ?>"> </button>
        </div>
      </div>
    </div> 

  
  </div>
</div> 
 

<?php 
} break;

case "8": {
?>
<div <?php if(isset($df['submenu_bg_color'])){ ?> style="background:<?php echo $df['submenu_bg_color']; ?>!important;"<?php } ?> class="hide-mobile elementor_submenu py-2 <?php echo $SubStyle; ?> shadow-sm">
 
 
<div id="main-category-wrap">
    <div id="navMenu">
      <div id="navMenu-wrapper">
        <ul id="cat-items">
          <div id="menuSelector"></div><?php
  		 
		echo wp_list_categories( array(
                                 								'taxonomy'  	=> 'listing',
                                 								'depth'         => 1,	
                                 								'hierarchical'  => 1,		
                                 								'hide_empty'    => 0,
                                 								'echo'			=> false,
                                 								'title_li' 		=> '',
                                 								'show_count' 	=> 0,
                                 								'orderby' 		=> 'term_order',
                                 							  
                                 								) );
  		?>
        <div class="navMenu-paddles">
          <button class="navMenu-paddle-left i fa <?php if($CORE->GEO("is_right_to_left", array() )){ ?>fa-angle-right<?php }else{ ?>fa-angle-left<?php } ?>"> </button>
          <button class="navMenu-paddle-right fa <?php if($CORE->GEO("is_right_to_left", array() )){  ?>fa-angle-left<?php }else{ ?>fa-angle-right<?php } ?>"> </button>
        </div>
      </div>
    </div> 

  
  </div>
</div> 
 

<?php 
} break;

 
case "7": {
?>
<div <?php if(isset($df['submenu_bg_color'])){ ?> style="background:<?php echo $df['submenu_bg_color']; ?>!important;"<?php } ?> class="hide-mobile elementor_submenu py-2 <?php echo $SubStyle; ?> shadow-sm">
  <div class="container ">
    <nav ppt-nav class="seperator spacing text-600 d-flex justify-content-center"><?php echo do_shortcode('[MAINMENU style=1]');  ?>
    </nav>
  </div>
</div>
<?php 
} break;




case "1": {
?>
<div <?php if(isset($df['submenu_bg_color'])){ ?> style="background:<?php echo $df['submenu_bg_color']; ?>!important;"<?php } ?>  class="hide-mobile elementor_submenu border-top-black border-bottom-black <?php echo $SubStyle; ?>" style="border-bottom: 1px solid #000; border-top: 1px solid #000;">
  <div class="container ">
    <nav ppt-nav class="boxed d-flex  text-600">
	
	<?php echo do_shortcode('[MAINMENU style=1 class="d-flex justify-content-between"]');  ?>
    
      <div class="hide-ipad ml-auto py-1">
        <?php if($df['btn_show'] == "1" && !$userdata->ID ){ ?>
        <?php if(THEME_KEY == "sp"){ ?>
        <a href="<?php echo _ppt(array('links','cart')); ?>" data-ppt-btn class="<?php echo $btnColor; ?> btn-rounded-25 text-600" data-ppt-btn-txt>
        <i class="fal fa-shopping-basket">&nbsp;</i> <?php echo __("My Basket","premiumpress"); ?></a>
        <?php }else{ ?>
        <a href="<?php echo _ppt(array('links','add')); ?>" data-ppt-btn class="<?php echo $btnColor; ?> btn-rounded-25 text-600" data-ppt-btn-txt><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "addnew" ) ); ?></a>
        <?php } ?>
        <?php } ?>
        <?php if($df['btn2_show'] == "1" && $userdata->ID ){ ?>
        <?php if(THEME_KEY == "sp"){ ?>
        <a href="<?php echo _ppt(array('links','cart')); ?>" data-ppt-btn class="<?php echo $btnColor; ?> btn-rounded-25 text-600" data-ppt-btn-txt>
        <i class="fal fa-shopping-basket">&nbsp;</i> <?php echo __("My Basket","premiumpress"); ?></a>
        <?php }else{ ?>
        <a href="<?php echo _ppt(array('links','add')); ?>" data-ppt-btn class="<?php echo $btnColor; ?> btn-rounded-25 text-600" data-ppt-btn2-txt><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "addnew" ) ); ?></a>
        <?php } ?>
        <?php } ?>
      </div>
    </nav>
  </div>
</div>
<?php 
} break;

case "2": {
?>
<div <?php if(isset($df['submenu_bg_color'])){ ?> style="background:<?php echo $df['submenu_bg_color']; ?>!important;"<?php } ?>  class="hide-mobile elementor_submenu border-top-black border-bottom-black shadow-sm <?php echo $SubStyle; ?>" style="border-bottom: 1px solid #000;">
  <div class="container ">
    <nav ppt-nav class="boxed no-y d-flex  text-600">
	
	<?php echo do_shortcode('[MAINMENU style=1 class="d-flex justify-content-between"]');  ?>
    
      <div class="hide-ipad ml-auto py-1 d-flex align-items-center">

<?php if($userdata->ID){ ?>
<nav ppt-nav class="seperator fs-sm text-uppercase"><ul>
<li><a href="<?php echo _ppt(array('links','myaccount')); ?>"><?php echo __("My Account","premiumpress"); ?></a></li>

  
</ul>
</nav>
<?php }else{ ?>
<nav ppt-nav class="seperator fs-sm text-uppercase"><ul>
<li><a href="<?php echo wp_registration_url(); ?>"><?php echo __("signup","premiumpress"); ?></a></li>

<li><a href="#" onclick="processLogin();"><?php echo __("login","premiumpress"); ?></a></li>
 
</ul>
</nav>
<?php } ?>
   
 
      </div>
    </nav>
  </div>
</div>
<?php 
} break;

default: 
?>
<div class="hide-mobile elementor_submenu py-2 <?php echo $SubStyle; ?> shadow-sm" <?php if(isset($df['submenu_bg_color'])){ ?> style="background:<?php echo $df['submenu_bg_color']; ?>!important;"<?php } ?>>
  <div class="container ">
    <nav ppt-nav class="seperator spacing text-600 d-flex pl-0"> <?php echo do_shortcode('[MAINMENU style=1]');  ?>
      <div class="hide-ipad ml-auto">
        <?php if($df['btn_show'] == "1" && !$userdata->ID ){ ?>
        <?php if(THEME_KEY == "sp"){ ?>
        <a href="<?php echo _ppt(array('links','cart')); ?>" data-ppt-btn class="<?php echo $btnColor; ?> btn-rounded-25 text-600" data-ppt-btn-txt><i class="fal fa-shopping-basket">&nbsp;</i> <?php echo __("My Basket","premiumpress"); ?></a>
        <?php }else{ ?>
        <a href="<?php echo _ppt(array('links','add')); ?>" data-ppt-btn class="<?php echo $btnColor; ?> btn-rounded-25 text-600" data-ppt-btn-txt><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "addnew" ) ); ?></a>
        <?php } ?>
        <?php } ?>
        <?php if($df['btn2_show'] == "1" && $userdata->ID ){ ?>
        <?php if(THEME_KEY == "sp"){ ?>
        <a href="<?php echo _ppt(array('links','cart')); ?>" data-ppt-btn class="<?php echo $btnColor; ?> btn-rounded-25 text-600" data-ppt-btn-txt><i class="fal fa-shopping-basket">&nbsp;</i> <?php echo __("My Basket","premiumpress"); ?></a>
        <?php }else{ ?>
        <a href="<?php echo _ppt(array('links','add')); ?>" data-ppt-btn class="<?php echo $btnColor; ?> btn-rounded-25 text-600" data-ppt-btn2-txt><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "addnew" ) ); ?></a>
        <?php } ?>
        <?php } ?>
      </div>
    </nav>
  </div>
</div>
<?php 
} 

}

?>