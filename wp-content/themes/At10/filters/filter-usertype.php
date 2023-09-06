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

<div class="card card-filter hide-mobile">
  <div class="card-body"> <a href="#" data-toggle="collapse" data-target="#collapse_showonly" aria-expanded="true">
 
   
<div class="block-header">
<h5 class="block-header__title"><?php echo __("User Type","premiumpress"); ?></h5>
<div class="block-header__divider"></div> 
</div>  
   
   
    </a>
    <div class="filter-content collapse" id="collapse_showonly">
    
     
 
 
<label class="custom-control custom-checkbox">
      <input type="checkbox" class="custom-control-input customfilter" data-type="checkbox"   data-key="user_fr" data-value="1" onclick="_filter_update()" onChange="addnewfilter('1','user_fr');" >
      <span class="custom-control-label"></span>  <?php  if(THEME_KEY == "ex"){ echo __("Teacher","premiumpress"); }else{ echo __("Employer","premiumpress"); } ?>
</label>


<label class="custom-control custom-checkbox">
      <input type="checkbox" class="custom-control-input customfilter" data-type="checkbox"   data-key="user_em" data-value="1" onclick="_filter_update()" onChange="addnewfilter('1','user_fr');" >
      <span class="custom-control-label"></span> <?php if(THEME_KEY == "ex"){ echo __("User","premiumpress");  }elseif(THEME_KEY == "jb"){ echo __("Job Seeker","premiumpress"); }else{ echo __("Freelancer","premiumpress"); } ?>
</label>


 
	   
    </div>
  </div>
</div>
