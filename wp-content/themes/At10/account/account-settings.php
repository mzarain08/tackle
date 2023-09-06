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
 
   global $CORE, $CORE_UI, $userdata;



?>


<div class="fs-lg text-600 mb-2"><?php echo __("Settings","premiumpress") ?></div>

<p class="mb-4"><?php echo __("Please keep your account details updated.","premiumpress") ?></p>


<form method="post" action=""  onsubmit="return ppt_validate_new_user();" class="user_form ppt-forms style3">
<input type="hidden" name="action" value="userupdate" />
   
<?php

$fields = ppt_user_fields();

foreach($fields as $k => $v){

$showHide = 1;

if(isset($v['adminonly'])){ continue; }


 
?>


<div id="user-<?php echo $k; ?>">   
 
<?php if($showHide){ ?> 
<div class="ppt-accordion" style="cursor:pointer;"> 
 
<div class="d-flex flex-row border-top p-3 py-lg-4">
  <div class="w-100" ppt-flex-between>
    <div class="w-100 btn-show">
      <div class="fs-6 text-600 ">
      <?php echo $v['title']; ?>
      </div>
    </div>
    <div ppt-icon-32 class="hide-show btn-show">
      <?php echo $CORE_UI->icons_svg['add']; ?>
    </div>
     <div ppt-icon-32 class="show-hide btn-show">
      <?php echo $CORE_UI->icons_svg['close']; ?>
    </div>
  </div>
</div>


<div class="hide border-top p-3">   
<?php } ?>    
    
<div class="row"> 
    <div class="col-md-12">    
   
    <?php if(isset($v['desc']) && strlen($v['desc']) > 1){ ?>
    <div class="fs-7 mt-3 pr-lg-5 opacity-5"><?php echo $v['desc']; ?></div> 
    <?php } ?>
    </div>
    <div class="col-md-12">
    
        <div class="py-3">
        
            <div class="row">
                <?php
                if(isset($v['fields'])){
                    
                    foreach($v['fields'] as $fk => $f){ ?>
                    
                    <?php if(!in_array($f['type'],array("hidden"))){ ?>
                    
                    <div class="<?php if(in_array($f['type'],array("textarea","membership","customfields","backgroundimg","deleteaccount"))){ ?>col-md-12<?php }else{ ?>col-md-6<?php } ?> py-2">
                    
                     
                    <?php if(!in_array($f['type'],array("deleteaccount","customfields"))){ ?>
                   
                   <div ppt-flex-between>
                    
                    <label><?php echo $f['title']; ?></label>
                    
					<?php if(isset($f['info'])){ ?>
                    
                   <div class="badge_tooltip text-center z-10" data-direction="top">
                    <div class="badge_tooltip__initiator">  <div ppt-icon-16 data-ppt-icon-size="16"><?php echo $CORE_UI->icons_svg['info-circle']; ?></div> </div>
                    <div class="badge_tooltip__item"><?php echo $f['info']; ?></div>
                  </div>
                    
                    <?php } ?>
                    
                    
                    </div>
					<?php } ?>
                    
                    <?php } ?>
					
					<?php
                    
                    $f['key'] = $fk;
                     
                    echo $CORE_UI->FIELD_USER($f);
                    
                    ?>
                    
                    <?php if(!in_array($f['type'],array("hidden"))){ ?></div><?php } ?>
                    
                    <?php
                    
                    }
                } 
            
          ?> 
            </div>
        
 
        </div>
    </div> 
</div> 

<?php if($showHide){ ?> 


</div></div>
<?php } ?>
<?php if(!$showHide){ ?> 
<hr />
<?php } ?>

</div>

<?php   }    ?>



<button class="btn-primary btn-lg mt-4" type="submit" id="savemydetailsbutton" data-ppt-btn><?php echo __("Save Changes","premiumpress"); ?></button>
 
 
 

</form>
<?php
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
?>
<script>
function ppt_validate_new_user(){

	result = ppt_form_validation('.user_form');	
	if(result == 0){
		
		jQuery(".ppt-accordion").addClass("show");
	
		jQuery("html, body").animate({ scrollTop: 0 }, "slow");			
		return false;
	}	
	return true;
}

</script>
<?php if(isset($_GET['sub']) && strlen($_GET['sub']) > 1){ ?>
<script>
jQuery(document).ready(function(){ 

jQuery('#user-<?php echo $_GET['sub']; ?> .ppt-accordion').addClass('show');
jQuery('#user-<?php echo $_GET['sub']; ?> .ppt-accordion > .d-flex').hide();

});
</script>
<?php } ?>