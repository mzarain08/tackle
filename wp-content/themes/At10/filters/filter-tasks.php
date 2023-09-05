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

 
?>

<div class="card card-filter">
  <div class="card-body"> 
  <a href="javascript:void(0)" onclick="jQuery('#collapse_age').toggle();">
  
  
<div class="block-header">
<h5 class="block-header__title"><?php  echo __("Task","premiumpress");  ?></h5>
<div class="block-header__divider"></div> 
</div>
  
  
    </a>
    
   <div class="filter-content collapse" id="collapse_age">
    


<?php

$tasks = array(

	"basic" => array(
	
		"name" =>  __("Task","premiumpress"),
		"color" =>  "bg-danger",
		
	),
	
	"urgent" => array(
	
		"name" =>  __("Urgent","premiumpress"),
		"color" =>  "bg-warning",
		
	),
	
	"featured" => array(
	
		"name" =>  __("Featured","premiumpress"),
		"color" =>  "bg-success",
		
	),
	
);

foreach($tasks as $k => $t){
?>

<div class="d-flex task mb-2 w-100">

    <label class="custom-control custom-checkbox">
      <input type="checkbox"  class="custom-control-input customfilter"  data-type="checkbox" data-key="<?php echo $k; ?>" data-value="1" onclick="_filter_update()">
      <span class="custom-control-label"></span> 
	  
	  

<span class="span-task <?php echo $t['color']; ?>"><?php echo $t['name']; ?></span>
 </label>
 
</div>
<?php } ?>

<style>

.span-task { padding: 5px 20px;    border-radius: 5px;    font-size: 14px;    color: #fff; font-size:12px; font-weight:bold; width:100%; }

</style>


</div>



</div>
</div> 