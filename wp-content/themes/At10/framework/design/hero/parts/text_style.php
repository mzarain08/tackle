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
 
global $df, $settings, $CORE;

if(!isset($df['text_format_text_style'])){
$df['text_format_text_style'] = "";
}

switch($df['text_format_text_style']){	 
	
		case "1": {
		
?>

       <div class="text-700" data-ppt-subtitle><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("hero1", "s" ) ); ?></div>
       
        <h1 data-ppt-title><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("hero1", "t" ) ); ?></h1>
        
        <?php if(isset($df['desc']) &&  strlen($df['desc']) > 1){ ?>
        <div class="lh-30" data-ppt-desc>&nbsp;</div>
        <?php } ?>
        
        
<?php
		} break;
		
 
		default: {
		
?>

<h1 data-ppt-title><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("hero1", "t" ) ); ?></h1>
        
<p class="lead" data-ppt-subtitle><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("hero1", "s" ) ); ?></p>
        
<?php if(isset($df['desc']) && strlen($df['desc']) > 1){ ?>
<div class="lh-30" data-ppt-desc>&nbsp;</div>
<?php } ?>

<?php
		} break;	
}

?>