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

global $CORE, $userdata, $post, $settings; 

// FIND THE MAX PRICE OF ITEMS IN OUR DATABASE
$max_price = 85; 
 
if(isset($_GET['age1']) && is_numeric($_GET['age1'])){ $price1 = esc_attr($_GET['age1']); }else{ $price1 = __("18","premiumpress"); }		
if(isset($_GET['age2']) && is_numeric($_GET['age2']) && $_GET['age2'] > 0){ $price2 = esc_attr($_GET['age2']); }else{ $price2 = __("65","premiumpress"); }	 


// DA AGE
if(_ppt(array('lst', 'da_age')) == "0"){ return ""; }	
 
?>
<div <?php if(isset($_POST['action'])){ ?> class="container"<?php } ?>>
<div class="row text-600">

	<div class="col-md-6">
    
    <label><?php echo __("Min. Age","premiumpress"); ?></label>
    
    <input type="text" name="price1" data-formatted-text="<?php echo __("Min. Age","premiumpress"); ?>" autocomplete="off"  class="form-control val-numeric" data-type="text" data-key="age1" id="filter_age_value_1" value="<?php echo $price1; ?>" onchange="jQuery(this).addClass('customfilter')">
    </div>
    
    <div class="col-md-6">
    
    <label><?php echo __("Max. Age","premiumpress"); ?></label>
    <input type="text" class="form-control val-numeric" data-formatted-text="<?php echo __("Max. Age","premiumpress"); ?>" autocomplete="off" name="age2" data-type="text" data-key="age2" id="filter_age_value_2" value="<?php echo $price2; ?>" onchange="jQuery(this).addClass('customfilter')">
    
    </div>    

</div>
</div>


<button data-ppt-btn class="btn-primary my-3" type="button" type="submit" onclick="_filter_update();"><?php echo __("Update Results","premiumpress"); ?></button>
