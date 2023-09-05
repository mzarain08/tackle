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

?>

<div class="container px-0">
  <div class="row">
    <div class="col-md-4 pr-lg-4">
      <h3 class="mt-4"><?php echo __("My Website Logo","premiumpress") ?></h3>
      <p class="text-muted lead mb-4"><?php echo __("Set your company logo text or upload a custom image.","premiumpress") ?></p>
    
      
        <div class="mt-4">
 <a href="#" onclick="jQuery('#overview-tab').trigger('click');" class="btn btn-system  font-weight-bold text-uppercase tiny"><i class="fa fa-arrow-left mr-1"></i> <?php echo __("go back","premiumpress"); ?></a>
 </div>
      
      </div>
   
 
   
   
    <div class="col-md-8">
      <div class="card card-admin">
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <input type="hidden" 
               id="up_logo_url_aid" 
               name="admin_values[design][logo_url_aid]" 
               value="<?php  echo stripslashes(_ppt(array('design', 'logo_url_aid')));  ?>"  />
              <input 
               name="admin_values[design][logo_url]" 
               type="hidden" 
               id="up_logo_url" 
               value="<?php echo stripslashes(_ppt(array('design','logo_url')));  ?>" />
              <?php if(substr(_ppt(array('design','logo_url')),0,4) == "http"){ ?>
              <div class="pptselectbox bg-light p-2 position-relative text-center   border">
                <div class="position-absolute p-2  small text-dark font-weight-bold" style="top:0px; right:0px;"><?php echo __("Dark","premiumpress") ?></div>
                <img data-src="<?php echo _ppt(array('design','logo_url')); ?>" style="max-width:100%; max-height:300px;" id="logo_url_preview" class="lazy" alt="img" /> </div>
              <div class="pptselectbtns mb-4 text-center mt-4"> <a href="<?php  echo _ppt(array('design','logo_url'));  ?>" target="_blank" class="btn btn-secondary  rounded-0" style="font-size: 10px;"><?php echo __("View","premiumpress") ?></a> <a href="javascript:void(0);"id="editImg_logo_url" class="btn btn-secondary  rounded-0" style="font-size: 10px;"><?php echo __("Edit","premiumpress") ?></a> <a href="javascript:void(0);" id="upload_logo_url" class="btn btn-secondary  rounded-0" style="font-size: 10px;"><?php echo __("Change","premiumpress") ?></a> <a href="javascript:void(0);" onclick="jQuery('#up_logo_url').val('');document.admin_save_form.submit();" class="btn btn-secondary  rounded-0" style="font-size: 10px;"><?php echo __("Delete","premiumpress") ?></a> </div>
              <?php }else{ ?>
              <div class="pptselectbox bg-light text-dark p-5 text-center position-relative">
                <div class="position-absolute p-2  small text-dark font-weight-bold" style="top:0px; right:0px;"><?php echo __("Dark","premiumpress") ?></div>
                <a href="javascript:void(0);" id="upload_logo_url">
                <div class="text-dark font-weight-bold btn btn-system btn-md"><?php echo __("select logo","premiumpress") ?></div>
                <div class="text-dark mt-4 small">.jpeg/ .png</div>
                </a> </div>
              <?php } ?>
              <script >
               jQuery(document).ready(function () {
               
               	jQuery('#editImg_logo_url').click(function() {           
               			   	 
               		tb_show('', 'media.php?attachment_id=<?php echo _ppt(array('design', 'logo_url_aid' ) ); ?>&action=edit&amp;TB_iframe=true');
					
					
               					 
               		return false;
               	});
               	
               	jQuery('#upload_logo_url').click(function() {           
               	
               		ChangeAIDBlock('up_logo_url_aid');
               		ChangeImgBlock('up_logo_url');		
               		ChangeImgPreviewBlock('logo_url_preview');
					jQuery('#textlogobox').val('');
               		
               		formfield = jQuery('#up_logo_url').attr('name');
               	 
               		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
					
					
						
					
					
					
               		return false;
               	});
               					
               });	
            </script>
              <div class="text-muted mt-3 small"><?php echo __("Image Size","premiumpress") ?>: 250px / 50px </div>
            </div>
            <div class="col-md-6">
              <input type="hidden" 
               id="up_light_logo_url_aid" 
               name="admin_values[design][light_logo_url_aid]" 
               value="<?php echo _ppt(array('design','light_logo_url_aid')); ?>"  />
              <input 
               name="admin_values[design][light_logo_url]" 
               type="hidden" 
               id="up_light_logo_url" 
               value="<?php  echo stripslashes(_ppt(array('design','light_logo_url'))); ?>" />
              <?php if(_ppt(array('design','light_logo_url')) != "" && substr(_ppt(array('design','light_logo_url')),0,4) == "http"){ ?>
              <div class="pptselectbox bg-dark p-2 position-relative text-center  ">
                <div class="position-absolute p-2  small text-white font-weight-bold" style="top:0px; right:0px;"><?php echo __("Light","premiumpress") ?></div>
                <img src="<?php echo _ppt(array('design','light_logo_url')); ?>" style="max-width:100%; max-height:300px;" id="light_logo_url_preview" /> </div>
              <div class="pptselectbtns mb-4 text-center mt-4"> <a href="<?php echo _ppt(array('design','light_logo_url'));  ?>" target="_blank" class="btn btn-secondary  rounded-0" style="font-size: 10px;"><?php echo __("View","premiumpress") ?></a> <a href="javascript:void(0);"id="editImg_light_logo_url" class="btn btn-secondary  rounded-0" style="font-size: 10px;"><?php echo __("Edit","premiumpress") ?></a> <a href="javascript:void(0);" id="upload_light_logo_url" class="btn btn-secondary  rounded-0 text-dark" style="font-size: 10px;"><?php echo __("Change","premiumpress") ?></a> <a href="javascript:void(0);" onclick="jQuery('#up_light_logo_url').val('');document.admin_save_form.submit();" class="btn btn-secondary  rounded-0" style="font-size: 10px;"><?php echo __("Delete","premiumpress") ?></a> </div>
              <?php }else{ ?>
              <div class="pptselectbox position-relative bg-dark p-5 text-center  ">
                <div class="position-absolute p-2  small text-white font-weight-bold" style="top:0px; right:0px;"><?php echo __("Light","premiumpress") ?></div>
                <a href="javascript:void(0);" id="upload_light_logo_url">
                <div class=" font-weight-bold btn btn-system btn-md"><?php echo __("select logo","premiumpress") ?></div>
                <div class="text-muted mt-4 small">.jpeg/ .png</div>
                </a> </div>
              <?php } ?>
              <script >
               jQuery(document).ready(function () {
               
               	jQuery('#editImg_light_logo_url').click(function() {           
               			   	 
               		tb_show('', 'media.php?attachment_id=<?php echo _ppt(array('design','light_logo_url_aid')); ?>&action=edit&amp;TB_iframe=true');
               					 
               		return false;
               	});
               	
               	jQuery('#upload_light_logo_url').click(function() {           
               	
               		ChangeAIDBlock('up_light_logo_url_aid');
               		ChangeImgBlock('up_light_logo_url');		
               		ChangeImgPreviewBlock('light_logo_url_preview');
					
					jQuery('#textlogobox').val('');
               		
               		formfield = jQuery('#up_light_logo_url').attr('name');
               	 
               		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
               			return false;
               	});
               					
               });	
            </script>
            </div>
          </div>
          <div class="col-12 mt-4 px-0">
            <div class="divider-or"><span>or</span></div>
          </div>
          <div class="col-12 mt-4 px-0">
            <label class="w-100 text-center mt-4"><?php echo __("Text Logo","premiumpress") ?></label>
            <textarea name="admin_values[design][textlogo]" id="textlogobox" class="form-control" style="height:100px !important;" /><?php echo trim(_ppt(array('design','textlogo'))); ?></textarea>
            <p class="py-3 text-muted small text-center"><?php echo __("The text logo is used instead of the image logo.","premiumpress") ?></p>
            <div class="p-4 bg-light text-center mt-4">
              <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress") ?></button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

 
<div class="container px-0">
  <div class="row">
    <div class="col-md-4 pr-lg-4">
      <h3 class="mt-4"><?php echo __("Website Fonts","premiumpress") ?></h3>
      <p class="text-muted lead mb-4"><?php echo __("Here you can set global font values for your website.","premiumpress") ?></p>
      
      <a href="https://fonts.google.com/" class="btn btn-dark mt-4" target="_blank">Google Fonts</a>
      
    </div>
    <div class="col-md-8">
      <div class="card card-admin">
        <div class="card-body">
          <div class="row py-3">
            <?php foreach($CORE->LAYOUT("get_fonttypes", array() ) as $fk => $f){ $thisK = _ppt(array('design', $fk));  ?>
            <div class="col-md-6 mb-4">
              <label class="txt500"><?php echo $f['name']; ?></label>
              <div class="input-group">
                <select class="form-control selectpicker" data-size="10"  data-live-search="true" name="admin_values[design][<?php echo $fk; ?>]" onchange="ApplyFont('<?php echo $fk; ?>')" id="select<?php echo $fk; ?>">
                  <?php foreach($CORE->LAYOUT("get_fonts", array() ) as $k => $f){ ?>
                  <option value="<?php echo $k; ?>" <?php if( $thisK == $k){ echo "selected=selected"; } ?>><?php echo $f; ?></option>
                  <?php } ?>
                </select>
              </div>
              
              <div class="mt-4 py-4 text-center border rounded sample_<?php echo $fk; ?>">
              
              <div class="">Sample Text</div>
              
              </div>
              
              
            </div>
            <?php } ?>
          </div>
          <div class="col-12 px-0">
            <div class="p-4 bg-light text-center mt-4">
              <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress") ?></button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>

function ApplyFont(div){
 
font = jQuery( "#select"+ div +" option:selected" ).text(); 

jQuery("head").append("<link href='https://fonts.googleapis.com/css?family="+font+"' rel='stylesheet' type='text/css'>");
jQuery("head").find('style').append('.sample_'+div+' { font-family: "'+font+'", Sans-serif; }');

}

</script>