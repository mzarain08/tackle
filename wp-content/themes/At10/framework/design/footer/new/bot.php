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

// LOAD IN SETTINGS	
$footer = ppt_footer_settings($settings);


// 
$txtbg = "light";
if(strlen($df['footerbot_txtbg']) > 0){
$txtbg = $df['footerbot_txtbg'];
}
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if($df['footerbot_show'] == "1"){ 
?>

<div class=" py-3 footer-txt-<?php echo $txtbg; ?>" <?php if(isset($df['footerbot_bg_color']) && strlen($df['footerbot_bg_color']) > 3){ ?> style="background:<?php echo $df['footerbot_bg_color']; ?>!important;"<?php } ?>>
<div class="container">

<?php 

switch($df['footerbot_fbot_style']){

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

case "1": {
?>

<div class="row px-0 ">
  <div class="col-md-6">
    <div class="copyright opacity-8 lh-30" data-ppt-copyright>
      %copy%
    </div>
  </div>
  <div class="col-md-6 text-right d-none d-md-block">
  %social_1%
  </div>
</div>
<?php
} break;

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

case "2": {
?>

<div class="row px-0">
  <div class="col-md-12 text-center lh-30">
    <div class="copyright opacity-8" data-ppt-copyright>
      %copy%
    </div>
  </div>
</div>
<?php
} break;

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

case "3": {
?>

<div class="row px-0">
  <div class="col-md-12 text-right lh-30">
    <div class="copyright opacity-8" data-ppt-copyright>
      %copy%
    </div>
  </div>
</div>
<?php
} break;


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

case "4": {
?>

<div class="row px-0">
  <div class="col-md-6">
    <div class="copyright opacity-8 lh-30" data-ppt-copyright>
      %copy%
    </div>
  </div>
  <div class="col-md-6 text-right d-none d-md-block"> <img data-src="%cards%" alt="cards" class="lazy" /> </div>
</div>
<?php
} break;


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

case "5": {
?>

<div class="row px-0">
  <div class="col-md-6">
    <div class="copyright opacity-8 lh-30" data-ppt-copyright>
      %copy%
    </div>
  </div>
  <div class="col-md-6 text-right d-none d-md-block">
  %social_2%
  </div>
</div>

<?php
} break;

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

case "6": {
?>

<div class="row px-0 fs-14">
<div class="col-12">
<div class="my-3"><div style="height:1px;" class="bg-dark opacity-2">&nbsp;</div></div>
</div>
  <div class="col-md-5">
    <div class="copyright opacity-8 text-center text-md-left" data-ppt-copyright>
      %copy%
    </div>
  </div>
  <div class="col-md-7 text-right d-none d-md-block">
  <nav ppt-nav class="d-inline-flex  justify-content-center"> %menu_footer% </nav>
  </div>
</div>

<?php
} break;

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

case "7": {
?>

<div class="row px-0 fs-14">

  <div class="col-md-5">
    <div class="copyright opacity-8 text-center text-md-left" data-ppt-copyright>
      %copy%
    </div>
  </div>
  <div class="col-md-7 text-right d-none d-md-block">
  <nav ppt-nav class="d-inline-flex  justify-content-center"> %menu_footer% </nav>
  </div>
</div>

<?php
} break;


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

case "8": {
?>



<div class="row px-0">

<div class="col-12">
<div class="my-3"><div style="height:1px;" class="bg-dark opacity-2">&nbsp;</div></div>
</div>
  <div class="col-md-6">
    <div class="copyright opacity-8 lh-30 text-center text-md-left" data-ppt-copyright>
     %copy%
    </div>
  </div>
  <div class="col-md-6 text-right d-none d-md-block"><img data-src="%cards%" alt="cards" class="lazy" /> </div>
</div>

<?php
} break;

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

case "9": {
?>

 
<div class="row px-0">
  <div class="col-md-6">
    <div class="copyright opacity-8 lh-30 text-center text-md-left" data-ppt-copyright>
     %copy%
    </div>
  </div>
  <div class="col-md-6 text-right d-none d-md-block"><img data-src="%cards%" alt="cards" class="lazy" /> </div>
</div>

<?php
} break;

	
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
default:  {
?>

<div class="row px-0">
<div class="col-12">
<div class="my-3"><div style="height:1px;" class="bg-dark opacity-2">&nbsp;</div></div>
</div>
  <div class="col-md-6">
    <div class="copyright opacity-8 lh-30" data-ppt-copyright>
      %copy%
    </div>
  </div>
  <div class="col-md-6 text-right d-none d-md-block">
  %social_1%
  </div>
</div>
<?php 

} break;

}
?>
</div>
</div>
<?php } ?>