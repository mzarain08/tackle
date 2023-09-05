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

$desc = "";

	switch(THEME_KEY){
	
		case "cm":
		case "sp": {		
			 $title = __("Create a display title for your product.","premiumpress"); 			   
		} break;
		
		case "es":
		case "da": {
		
			 $title = __("Create a display name for your profile.","premiumpress"); 
			   
		} break;
		 
		default: {
		
			 $title = __("Create a title for your ad.","premiumpress"); 
			 
		} break;
	
	}


$editID=0;

if(isset($_GET['eid']) && is_numeric($_GET['eid'])){
$editID = $_GET['eid'];
} 
 
?>
 
<?php
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
?>


<div class="form-group mt-4">
  <?php if(THEME_KEY == "ex"){ ?>
  <input type="hidden" name="form[post_title]" class="form-control" value="user profile <?php echo $CORE->USER("get_username", $userdata->ID); ?>" />
  <?php }else{ ?>
  <?php if(strlen($title) > 1){ ?> 
 

  <?php } ?>
  
 
   
 

<label class=""><?php echo $title; ?> <span class="text-danger">*</span> </label>
   
   
  <input type="input" name="form[post_title]" id="form_post_title"  data-key="title" maxlength="<?php if(!is_numeric(_ppt(array('lst', 'titlemax' ))) || _ppt(array('lst', 'titlemax' )) < 2){ echo 150; }else{ echo _ppt(array('lst', 'titlemax' )); } ?>"
               
               placeholder="<?php echo $CORE->LAYOUT("captions", "add_title") ?>"
               
               
               class="form-control  big required-field" tabindex="1" value="<?php if(isset($_GET['eid'])){ echo $CORE->get_edit_data('post_title', $_GET['eid']); } ?>">
  <?php } ?>
  
</div>







<?php /*

    <div class="d-flex">
    
 
    <label class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input "  value="1" tabindex="20">
          <div class="custom-control-label input-lg mr-2 "> 
          
          <div class=" text-center ml-3 rounded-lg"><?php echo __("Highlight My Ad","premiumpress") ?> 
      
          
          </div> 
          
          
          </div>
 	</label>

    
      <div class="badge_tooltip text-center float-right ml-3" data-direction="top">
    <div class="badge_tooltip__initiator"> 
   <i class="fal fa fa-info-circle"></i></div>
    <div class="badge_tooltip__item">   Let people know you want to sell, rent or hire quickly. <hr /> 7 days -  $100  </div>
  </div>
    
    </div>
 
*/ ?>