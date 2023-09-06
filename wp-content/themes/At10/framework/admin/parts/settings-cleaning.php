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
 
 
global $settings;


  $settings = array(
  
  "title" => __("Theme License Key","premiumpress"), 
  "desc" => __("Here you can update your license key.","premiumpress"),
  "back" => "overview",
  
  );
   _ppt_template('framework/admin/_form-wrap-top' ); ?>
<?php _ppt_template('framework/admin/blocks/login' ); ?>

<div class="mt-5"></div>
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); 


  $settings = array(
  
  "title" => __("Check for Updates","premiumpress"), 
  "desc" => __("Here you can check your running the latest theme version.","premiumpress"),
  
  );
  if(!defined('WLT_DEMOMODE')){ 
   $settings['desc'] = $settings['desc']."<br><br><a href='javascript:void(0);' onclick=\"jQuery('#resetbox').toggle();\" style='color:blue'>Reset Options</a>";
  }
  
   _ppt_template('framework/admin/_form-wrap-top' ); ?>
   
   
   <div class="card card-admin">
  <div class="card-body ">
  
  
   <div class="row">
   
   <div class="col-md-9">
   
   <label class="txt500"><?php echo __("Automatic Theme Updates","premiumpress"); ?></label>
   
    <p class="pb-0 btn-block text-muted mb-0"><?php echo __("This will allow you to update the theme via the WordPress admin area instead of having to re-download updates from the PremiumPress website.","premiumpress"); ?></p>
   
   
   <div>
   
   
   </div>
   
   </div>
   
   <div class="col-md-2">
  
        <div class="input-group mt-2">
        <div class="formrow">
          <div class="">
            <label class="radio off" style="display: none;">
            <input type="radio" name="toggle" value="off" onchange="document.getElementById('autoupdates').value='0'; jQuery('#admin_save_form').submit();">
            </label>
            <label class="radio on" style="display: none;">
            <input type="radio" name="toggle" value="on" onchange="document.getElementById('autoupdates').value='1'; jQuery('#admin_save_form').submit();">
            </label>
            <div class="toggle <?php if( in_array(_ppt('autoupdates'), array("","1")) ){  ?>on<?php } ?>">
              <div class="yes">ON</div>
              <div class="switch"></div>
              <div class="no">OFF</div>
            </div>
          </div>
        </div>
        <input type="hidden" id="autoupdates" name="admin_values[autoupdates]" value="<?php if(in_array(_ppt('autoupdates'), array("","1")) ){ echo 1; }else{ echo  _ppt('autoupdates'); } ?>">
  
      
   </div>
 </div></div>
 
   
    <div class="fs-sm text-muted mt-3">
    
    Current Theme <strong> V <?php echo THEME_VERSION; ?></strong> updated on <strong><?php echo THEME_VERSION_DATE; ?></strong>. - <a href="#" onclick="Checkforupdates();" id="checkforupdatesbtn"><?php echo __("Check for updates","premiumpress"); ?></a>
   
    </div>
 
  <div id="checkupdatesmsg" class="fs-sm text-600"></div>
   
   
  </div>
</div>


 


  
   


<script>

function Checkforupdates(){

jQuery('#checkforupdatesbtn').html("<i class='fas fa-spinner fa-spin'></i>");

jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',	
		dataType: 'json',	
		data: {			 
            admin_action: "check_updates",			 			
        },
        success: function(response) {
		
		console.log(response.status);
 
			if(response.status == "new"){
			
			jQuery('#checkupdatesmsg').html("Version "+response.msg+" is now available!");
			jQuery('#updatebtn').show();		  			 
  		 	 
			}else if(response.status == "old"){
			
			jQuery('#checkupdatesmsg').html("You are using the latest version.");			   			 
  		 	
			}else if(response.status == "error"){
			
			jQuery('#checkupdatesmsg').html(response.msg);
			  			 
  		 	
			}		
			 
			jQuery('#checkforupdatesbtn').html("Completed");
											
						
        },
        error: function(e) {
            alert("Could not validate license key.")
        }
    });

}
</script>
<?php  _ppt_template('framework/admin/_form-wrap-bottom' );  



if(!defined('WLT_DEMOMODE')){ echo "<div id='resetbox' style='display:none;'>"; }

  $settings = array(
  
  "title" => __("Website Reset","premiumpress"), 
  "desc" => __("These options will allow you to clean up or reset your website data.","premiumpress"),
  
  );
   _ppt_template('framework/admin/_form-wrap-top' ); ?>
<div class="card card-admin">
  <div class="card-body text-center py-5"> <a  href="javascript:void(0);" onclick="jQuery('#UpdateModal').modal('show');" data-ppt-btn class="btn-danger btn-lg" ><?php echo __("Delete Everything","premiumpress"); ?></a> </div>
</div>
<?php  _ppt_template('framework/admin/_form-wrap-bottom' );

if(!defined('WLT_DEMOMODE')){ echo "</div>"; }

 

 ?>
