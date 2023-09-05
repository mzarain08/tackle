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

$accountTypes = $CORE->USER("get_account_type_all", array());
if(!empty( $accountTypes ) ){ 

?>


<div class="col-12 border-bottom mt-4 px-0">
    <div class="row">
  
        <div class="col-md-6">
            <label class="w-100"><?php echo __("Photo Verification (Account Type)","premiumpress"); ?></label>
            
            <p class="text-muted"><?php echo __("Set which account types to show the verification form too.","premiumpress"); ?></p>
          </div>
        
    
    <div class="col-md-6">
    
    
<?php   foreach($accountTypes as $k => $f ){ 

if(in_array($k,array("banned","visitor"))){ continue; }

?>
<div class="mb-4">
 
 

         <label class="custom-control custom-checkbox">
              <input type="checkbox"  value="1" 
       
        class="custom-control-input" 
        id="photo_usertype_<?php echo $k; ?>check" 
        onchange="CheckPhotoUserType('#photo_usertype_<?php echo $k; ?>');"
         
		<?php if( in_array(_ppt(array("photo_usertype",$k)), array("","1")) ){ ?>checked=checked<?php } ?>>
              <input type="hidden" name="admin_values[photo_usertype][<?php echo $k; ?>]" id="photo_usertype_<?php echo $k; ?>add"  value="<?php if(in_array(_ppt(array("photo_usertype",$k)), array("","1"))){ echo 1; }else{ echo 0; } ?>">
              <span class="custom-control-label h6"><?php echo $f['name']; ?></span> </label>
              
              <div class="fs-sm opacity-5">
              <?php echo $f['desc']; ?>
              </div>
              
              <hr /> 

</div>

<?php } ?>
    
    
             
        
          </div>
  </div>
</div>

     <script>
		function CheckPhotoUserType(div){
		
			if (jQuery(div+'check').is(':checked')) {			
				jQuery(div+'add').val(1);			
			}else{			
				jQuery(div+'add').val(0);
			}
		
		}
		</script>
<?php } ?> 