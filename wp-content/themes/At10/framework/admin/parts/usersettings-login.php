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
 
 
global $settings, $CORE_ADMIN, $CORE;


?>



<div class="container px-0">
  <div class="row">
    <div class="col-md-4 pr-lg-4">
      <h3 class="mt-4"><?php echo __("Login Design","premiumpress"); ?></h3> 
       <p><?php echo __("Here you can pick a design for the signin page.","premiumpress"); ?></p>
      <div class="mt-4">
 <a href="#" onclick="jQuery('#overview-tab').trigger('click');" class="btn btn-system btn-sm font-weight-bold text-uppercase"><i class="fa fa-arrow-left mr-1"></i> <?php echo __("go back","premiumpress"); ?></a>
 </div>
    </div>
    <div class="col-md-8">
      <div class="card card-admin">
        <div class="card-body">
          <div class="row">
            <?php

		$snames = array(
			
			0 => "Default",
			1 => "Style 1",
			2 => "Style 2",
			3 => "Style 3",
			4 => "Style 4",
			5 => "Style 5",
			6 => "Style 6",
			7 => "Style 7",
			 
		);

		$SetThis = _ppt(array('design','login_layout'));
		if($SetThis == ""){ $SetThis = 6; }
		
		
		foreach($snames as $i => $name){ ?>
            <div class="col-12 col-md-4">
              <div class="card-top-image  bg-light position-relative" style="overflow:hidden; <?php if($i == $SetThis){ ?>border:2px solid red;<?php }else{ ?>border:1px solid #ddd;<?php } ?>">
                <a href="<?php echo home_url(); ?>/wp-login.php?style=<?php echo $i; ?>&reset=1" target="_blank"> <img data-src="<?php echo DEMO_IMG_PATH; ?>/_register/login_style<?php echo $i; ?>.jpg" class="img-fluid lazy" alt="img" /> </a>
              </div>
              <div class="text-left py-2 w-100 mb-5 small font-weight-bold tiny">
                <?php echo $name; ?>
              </div>
            </div>
            <?php $i++; } ?>
          </div>
          <div class="row border-bottom  pb-3 pt-2 mb-3">
            <div class="col-md-7">
              <label class="font-weight-bold mb-2"><?php echo __("Login Layout","premiumpress"); ?></label>
              <p class="text-muted"><?php echo __("Set the default design for the login page.","premiumpress"); ?></p>
            </div>
            <div class="col-md-5 mt-3 formrow">
              <select name="admin_values[design][login_layout]" class="form-control">
                <?php foreach($snames as $i => $name){ ?>
                <option value="<?php echo $i; ?>" <?php if($i == $SetThis){ echo "selected=selected"; }  ?>><?php echo $name; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="row border-bottom  pb-3 pt-2 mb-3">
            <div class="col-md-6">
              <label class="font-weight-bold mb-2"><?php echo __("Login Background","premiumpress"); ?></label>
              <p class="text-muted"><?php echo __("Set the background image.","premiumpress"); ?></p>
            </div>
            <div class="col-md-6">
              <?php

$k=1;
$defaultimg = _ppt('login_bgimg');
?>
              <div>
                <figure>
                  <div class="position-relative">
                  <?php if($defaultimg != ""){ ?>
                    <img data-src="<?php echo _ppt('login_bgimg'); ?>" alt="img" class="img-fluid lazy">
                    <?php } ?>
                  </div>
                </figure>
                <div class="input-group position-relative">
                  <button type="button"  id="path<?php echo $k; ?>" class="position-absolute login_download_path_select" style="right:10px; top:10px; z-index: 100; font-size: 11px; background:#fff;"> <?php echo __("Select File","premiumpress"); ?></button>
                  <input class="form-control" id="login_download_path<?php echo $k; ?>" name="admin_values[login_bgimg]" value="<?php if(_ppt('login_bgimg') == ""){ }else{ echo _ppt('login_bgimg'); } ?>" />
                </div>
              </div>
              <input type="hidden" value=""  id="login_current_bg_id" />
              <script>

jQuery(document).ready(function() {

var my_original_editor = window.send_to_editor; 

 	jQuery('.login_download_path_select').click(function() {     
	
	var thisid = jQuery(this).attr('id');   
	
			jQuery("#login_current_bg_id").val(thisid);  
           
		   tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
		   
			window.send_to_editor = function(html) {	
			 
			 		
				var regex = /src="(.+?)"/;
				var rslt =html.match(regex);
				 
				var imgrex = /wp-image-(.+?)"/;
				var imgid = html.match(imgrex);
			 
				var imgurl = rslt[1];
				var imgaid = imgid[1];
				 
				jQuery("#login_download_"+jQuery("#login_current_bg_id").val()).val(imgurl); 
				
				tb_remove();
				
				window.send_to_editor = my_original_editor;
			 
			 
			}		   
		   
		   
           return false;
    }); 

}); 
</script>
            </div>
          </div>
          <div class="p-4 bg-light text-center mt-4">
            <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<?php
 $settings = array(
  
  "title" => __("Login Page Design","premiumpress"), 
  "desc" => __("Disable the theme login page design.","premiumpress"),

	"back" => "overview",



  );
   _ppt_template('framework/admin/_form-wrap-top' ); ?>
  
   
<div class="card card-admin">
  <div class="card-body">
  
  
  <div class="container px-0 border-bottom mb-3 ">
  <div class="row py-2">
    <div class="col-md-9">
      <label class="txt500"><?php echo __("Disable Theme Login Page","premiumpress"); ?></label>
      <p class="text-muted"><?php echo __("This will display the WordPress user login page instead.","premiumpress"); ?></p> 
       
    </div>
    <div class="col-md-3">
      <div  class="mt-3 formrow">
        <label class="radio off">
        <input type="radio" name="toggle" 
                        value="off" onchange="document.getElementById('wplogin').value='0'">
        </label>
        <label class="radio on">
        <input type="radio" name="toggle"
                        value="on" onchange="document.getElementById('wplogin').value='1'">
        </label>
        <div class="toggle <?php if(_ppt(array("user","wplogin")) == 1){  ?>on<?php } ?>">
          <div class="yes">ON</div>
          <div class="switch"></div>
          <div class="no">OFF</div>
        </div>
      </div>
      <input type="hidden" id="wplogin" name="admin_values[user][wplogin]" value="<?php if(_ppt(array("user","wplogin")) == ""){ echo 0; }else{ echo _ppt(array("user","wplogin")); } ?>">
      
      
    </div>
  </div>
</div>

      <div class="p-4 bg-light text-center mt-4">
      <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
    </div>
    
  </div>
</div>
<!-- end admin card -->
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?>
 



