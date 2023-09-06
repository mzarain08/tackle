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

$settings = array(
   

	"title" => __("Registration Page","premiumpress"), 
		
	"desc-small" => __("Configure your user registration process here.","premiumpress"),	
		
	"desc" => __("These settings are applied to the user registration page.","premiumpress"),
 
	"back" => "overview",

		
	//"video" => "https://www.youtube.com/watch?v=tcq0LAATZQg",
  
  );
 _ppt_template('framework/admin/_form-wrap-top' );
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


   ?>
   
   <div class="card card-admin">
  <div class="card-body">
  
  <?php
  
  $g = array(	
	
	
		 "users_can_register" => array(
		 
			 "name" => "", 
			 "desc" => "",
			 "type" => "custom",
			 "path" => "register",
			 "col12" => true 
		 ),
		 
		 
 );
  
 
 
 
 foreach ($g as $fieldkey => $fielddata){ echo str_replace("border-bottom","",$CORE_ADMIN->LoadCongifField($fielddata, $fieldkey, "register")); }
?>


    
    
  </div>
  
   
      <div class="p-4 bg-light text-center">
      <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
    </div>
  
</div>
<!-- end admin card --> 

 
  <?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?>
 
  
  
 
   
 
 

   <?php 
   
   
$g = array(	
	
	 
/* 
		 "username" => array(
		 
			 "name" => __("User Sets Username","premiumpress"),
			 "desc" => __("Let users create their own username instead of the system creating one for them.","premiumpress"),
			 "type" => "yesno", 
			 "d" => "1",
			 "col8" => true  
		 ),	
		 		 
		 "password" => array(
		 
			 "name" => __("User Sets Password","premiumpress"),
			 "desc" => __("Let users create their own password instead of the system emailing them one.","premiumpress"),
			 "type" => "yesno", 
			 "d" => "1",
			 "col8" => true 
		 ),	
		
		 "hide_firstlast" => array(
		 
			 "name" => __("Hide First/Last Name","premiumpress"),
			 "desc" => __("Turn ON to disable the first/last name registration and profile fields.","premiumpress"),
			 "type" => "yesno", 
			 "d" 	=> "1",
			"col8" => true 
		 ),	
		 
	 "mobile" => array(
		 
			 "name" => __("Mobile Phone","premiumpress"), 
			 "desc" => __("Show the mobile phone input box.","premiumpress"), 
			 "type" => "yesno", 
			 "d" 	=> 0,
			 "col8" => true 
		 ),
		  */
	 
		 /* 
		  "da_seeking" => array(
		 
			 "name" => __("Hide Seeking User Option","premiumpress"),
			 "desc" => __("Turn ON to disable the seeking user selection field.","premiumpress"),
			 "type" => "yesno", 
			 "d" 	=> "0",
			"col8" => true 
		 ),	
		 
		 "da_reggender" => array(
		 
			 "name" => __("Hide Gender Option","premiumpress"),
			 "desc" => __("Turn ON to disable the gender option at registration.","premiumpress"),
			 "type" => "yesno", 
			 "d" 	=> "0",
			"col8" => true 
		 ),	
		  */
		 			
 /*
		 "mobilenumber" => array(
		 
			 "name" => __("Mobile Number","premiumpress"), 
			 "desc" => __("Let users add their mobile number during registration.","premiumpress"),
			 "type" => "yesno", 
			 "d" => "0" ,
			 "col4" => 1,
		 ),		
		 */
		   
 
 
);


if(in_array(THEME_KEY, array("da","ex")) ){

}else{
//unset($g['da_seeking']);
//unset($g['da_reggender']);
 
}

 
 
 foreach ($g as $fieldkey => $fielddata){ echo $CORE_ADMIN->LoadCongifField($fielddata, $fieldkey, "register"); }
?>

 
 
 
  
  
<div class="container px-0">
  <div class="row">
    <div class="col-md-4 pr-lg-4">
      <h3 class="mt-4"><?php echo __("Page Design","premiumpress"); ?></h3> 
      
      <p><?php echo __("Here you can pick a design for the signup page.","premiumpress"); ?></p>
      
             <div class="mt-4">
 <a href="#" onclick="jQuery('#overview-tab').trigger('click');" class="btn btn-system  font-weight-bold text-uppercase tiny"><i class="fa fa-arrow-left mr-1"></i> <?php echo __("go back","premiumpress"); ?></a>
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

		$SetThis = _ppt(array('design','register_layout'));
		if($SetThis == ""){ $SetThis = 6; }
		
		
		foreach($snames as $i => $name){ ?>
            <div class="col-md-4">
              <div class="card-top-image  bg-light position-relative" style="overflow:hidden; <?php if($i == $SetThis){ ?>border:2px solid red;<?php }else{ ?>border:1px solid #ddd;<?php } ?>">
                <a href="<?php echo wp_registration_url(); ?>&style=<?php echo $i; ?>&reset=1" target="_blank"> <img data-src="<?php echo DEMO_IMG_PATH; ?>/_register/register_style<?php echo $i; ?>.jpg" class="img-fluid lazy" alt="img" /> </a>
              </div>
              <div class="text-left py-2 w-100 mb-5 small font-weight-bold tiny">
                <?php echo $name; ?>
              </div>
            </div>
            <?php $i++; } ?>
          </div>
          <div class="row border-bottom  pb-3 pt-2 mb-3">
            <div class="col-md-7">
              <label class="font-weight-bold mb-2"><?php echo __("Register Layout","premiumpress"); ?></label>
              <p class="text-muted"><?php echo __("Set the default design for the register page.","premiumpress"); ?></p>
            </div>
            <div class="col-md-5 mt-3 formrow">
              <select name="admin_values[design][register_layout]" class="form-control">
                <?php foreach($snames as $i => $name){ ?>
                <option value="<?php echo $i; ?>" <?php if($i == $SetThis){ echo "selected=selected"; }  ?>><?php echo $name; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="row border-bottom  pb-3 pt-2 mb-3">
            <div class="col-md-6">
              <label class="font-weight-bold mb-2"><?php echo __("Register Background","premiumpress"); ?></label>
              <p class="text-muted"><?php echo __("Set the background image.","premiumpress"); ?></p>
            </div>
            <div class="col-md-6">
              <?php

$k=1;
$defaultimg = _ppt('register_bgimg');
?>
              <div>
                <figure>
                  <div class="position-relative">
                  <?php if($defaultimg != ""){ ?>
                    <img data-src="<?php echo _ppt('register_bgimg');  ?>" alt="img" class="img-fluid lazy">
                    <?php } ?>
                  </div>
                </figure>
                <div class="input-group position-relative">
                  <button type="button"  id="path<?php echo $k; ?>" class="position-absolute register_download_path_select" style="right:10px; top:10px; z-index: 100; font-size: 11px; background:#fff;"> <?php echo __("Select File","premiumpress"); ?></button>
                  <input class="form-control" id="register_download_path<?php echo $k; ?>" name="admin_values[register_bgimg]" value="<?php if(_ppt('register_bgimg') == ""){ }else{ echo _ppt('register_bgimg'); } ?>" />
                </div>
              </div>
              <input type="hidden" value=""  id="register_current_bg_id" />
              <script>

jQuery(document).ready(function() {

var my_original_editor = window.send_to_editor; 

 	jQuery('.register_download_path_select').click(function() {     
	
	var thisid = jQuery(this).attr('id');   
	
			jQuery("#register_current_bg_id").val(thisid);  
           
		   tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
		   
			window.send_to_editor = function(html) {	
			 
			 		
				var regex = /src="(.+?)"/;
				var rslt =html.match(regex);
				 
				var imgrex = /wp-image-(.+?)"/;
				var imgid = html.match(imgrex);
			 
				var imgurl = rslt[1];
				var imgaid = imgid[1];
				 
				jQuery("#register_download_"+jQuery("#register_current_bg_id").val()).val(imgurl); 
				
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