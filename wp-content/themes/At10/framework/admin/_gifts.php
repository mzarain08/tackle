<?php
/* =============================================================================
   USER ACTIONS
   ========================================================================== */
// CHECK THE PAGE IS NOT BEING LOADED DIRECTLY
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }

// SETUP GLOBALS
global $wpdb, $CORE, $settings;

 
 
_ppt_template('framework/admin/header' ); 

_ppt_template('framework/admin/_form-top' ); 
?>
<div class="tab-content d-flex flex-column h-100">
       
      
       
 <div class="tab-pane  active" 
        data-title="<?php echo __("Gift Settings","premiumpress"); ?>" 
        data-desc="<?php echo __("Here you can change the user settings for your website.","premiumpress"); ?>"
        data-icon="fa-user-cog" 
        id="user" 
        role="tabpanel" aria-labelledby="cleaning-tab">
       
        </div><!-- end design home tab -->       
     

</div>
 
<?php _ppt_template('framework/admin/_form-bottom' ); ?> 
 <input type="hidden" value=""  id="current_bg_id" />
 <script>

jQuery(document).ready(function() {

var my_original_editor = window.send_to_editor;


 	jQuery('.download_path_select').click(function() {     
	
	var thisid = jQuery(this).attr('id');   
	
	jQuery("#current_bg_id").val(thisid);  
           
		   tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
		   
			window.send_to_editor = function(html) {	
			 
			 		
				var regex = /src="(.+?)"/;
				var rslt =html.match(regex);
				 
				var imgrex = /wp-image-(.+?)"/;
				var imgid = html.match(imgrex);
			 
				var imgurl = rslt[1];
				var imgaid = imgid[1];
				console.log("#download_"+jQuery("#current_bg_id").val());
				jQuery("#download_"+jQuery("#current_bg_id").val()).val(imgurl); 
				
				tb_remove();
				
				window.send_to_editor = my_original_editor;
			 
			 
			}		   
		   
		   
           return false;
    });
               		
 

}); 
</script>
   
<?php  _ppt_template('framework/admin/footer' );  ?>