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



$txtbg = "light";
if(strlen($df['footertop_txtbg']) > 0){
$txtbg = $df['footertop_txtbg'];
}


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
if($df['footertop_show'] == "1"){
 
?>

<div class="bg-primary footer-txt-<?php echo $txtbg; ?>" <?php if(isset($df['footertop_bg_color']) && $df['footertop_bg_color'] != ""){ ?> style="background:<?php echo $df['footertop_bg_color']; ?>!important;"<?php } ?>>
<div class="container">
 
<?php 

switch($df['footertop_ftop_style']){

	case "3": {
	
	?>
<hr />
	<?php 
	} break;

	case "2": {
	
	?>
<div class="d-flex justify-content-between py-3">

    <div data-ppt-title class="lh-30"><?php echo __('Connect with us on social media', 'premiumpress' ); ?></div>
    
    <div>%social_2%</div>

</div>
	<?php 
	} break;
	
	case "1": {
	
	?>
<div style="height:15px;"> &nbsp; </div>
	<?php 
	} break;
	
	default: {
?>

<div style="height:5px;"> &nbsp; </div>

<?php	
	} break;

} ?> 

</div>
</div>
<?php } ?>