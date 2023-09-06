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
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
$phone = _ppt(array('newheader','phone'));
if($phone == ""){
$phone = _ppt(array('company','phone'));
}
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
$email = _ppt(array('newheader','email'));
if($email == ""){
$email = _ppt(array('company','email'));
}
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if(isset($_GET['ppt_live_preview']) && $phone == ""){
$phone = "123 456 789";
}

if(isset($_GET['ppt_live_preview']) && $email == ""){
$email = "admin@mywebsite.com";
}

$g = explode(",", _ppt(array('company','address')) );

?>
 
<ul class="topbar-info main-header hide-ipad">
                  <li class="hide-mobile">
                    
                      <span class="media">
                      
                        <span class="media-left">
                          <span class="icon">
                            <i class="fal fa-clock text-primary">&nbsp;</i>
                          </span>
                        </span>
                        <span class="media-content">
                          <strong><?php echo __("Monday - Friday 08:00 - 20:00","premiumpress"); ?></strong>
                          <br><?php echo __("Sunday - Closed","premiumpress"); ?>
                        </span>
                      </span>                     
                  </li>
                  <?php if(isset($g[1])){ ?>
                  <li class="hide-mobile">
                     
                      <span class="media">
                        <span class="media-left">
                          <span class="icon">
                            <i class="fal fa-map-marker text-primary">&nbsp;</i>
                          </span>
                        </span>
                        <span class="media-content">
                         
                          <strong><?php echo $g[0]; ?></strong>
                          <br><?php echo $g[1]; ?></span>
                      </span>
                 
                  </li>
                  <?php } ?>
                  <li class="hide-mobile">
                   
                      <span class="media">
                        <span class="media-left">
                          <span class="icon">
                            <i class="fal fa-phone-alt text-primary">&nbsp;</i>
                          </span>
                        </span>
                        <span class="media-content">
                         <strong><?php echo $phone; ?></strong>
                          <br><?php echo str_replace("@","<i class='fal fa-at'></i>",$email); ?></span>
                      </span>
                  
                  </li>
                
</ul> 


<?php _ppt_template( 'framework/design/header/parts/header-languages' ); ?>