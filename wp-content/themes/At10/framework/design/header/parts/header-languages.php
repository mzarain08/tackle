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

global $CORE, $userdata;


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
<div class="show-mobile-inline">
<div class="d-inline-flex">

	<?php if($userdata->ID && in_array(_ppt(array('user','notify')), array("","1")) ){ ?>
    
    <div class="show-mobile show-ipad icon-notify" onclick="processNotificatons();">
    <i class="fa fa-bell">&nbsp;</i>
    </div>
    
    <?php }elseif(!$userdata->ID && !empty($CORE->GEO("get_languagelist",array()))){ 
    
    $languages =  $CORE->GEO("get_languagelist",array()); 
    ?>
    
    <div class="user-languages" onclick="processLanguages();">
    <span class="flag flag-<?php echo $CORE->GEO("get_language_icon",array());  ?>">&nbsp;</span>
    </div>
    
    <?php } ?>
    
    
    <button class="navbar-toggler menu-toggle tm border-0">
    <span class="fa fa-bars">&nbsp;</span>
    </button>

</div>
</div>