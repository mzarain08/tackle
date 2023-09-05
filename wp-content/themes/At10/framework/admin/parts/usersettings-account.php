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


$g = array(
 
 	  "contactus" => array(
		 
			 "name" => __("Dashboard - Contact Us Button","premiumpress"), 
			 "desc" => "", 
			 "type" => "yesno", 
			 "d" => "1",
			  "col8" => true 
		 ),	 
		 
		 
		"accountimg" => array(
		 
			 "name" => __("Dashboard - Main Image","premiumpress"), 
			 "desc" => "", 
			 "type" => "yesno", 
			 "d" => "1",
			  "col8" => true 
		 ),	 
		 
		 
		 
		 	 
		  "friends" => array(
		 
			 "name" => __("Friends System","premiumpress"), 
			 "desc" => "", 
			 "type" => "yesno", 
			 "d" => "1",
			  "col8" => true 
		 ),	
		  
		  
		  "orders" => array(
		 
			 "name" => __("Invoice System","premiumpress"), 
			 "desc" => "", 
			 "type" => "yesno", 
			 "d" 	=> 1 ,
			 "col8" => true 
		 ),	
		   
  
);

if(in_array(THEME_KEY, array("sp","cp","cb","cm")) ){

unset($g['friends']);

}

 
 
 $settings = array(
  
  "title" => __("Welcome Text","premiumpress"), 
  "desc" => __("Here you can customize the dashboard welcome page.","premiumpress"),
  
	"back" => "overview",

  
  ); 
  
   _ppt_template('framework/admin/_form-wrap-top' ); ?>
   
<div class="card card-admin">
  <div class="card-body">
 
 

<div class="row border-bottom  pb-3 pt-2 mb-3 ppt-forms style3">
<div class="col-md-12">

<label class="font-weight-bold mb-2"><?php echo __("Welcome Message","premiumpress"); ?></label>

<p class="text-muted"><?php echo __("This text is displayed to users who have logged in less than 5 times.","premiumpress"); ?></p>

<textarea class="form-control" style="height:100px;" name="admin_values[account_welcometxt]"><?php echo _ppt('account_welcometxt'); ?></textarea>

</div>
</div>




<div class="row border-bottom  pb-3 pt-2 mb-3 ppt-forms style3">
<div class="col-md-12">

<label class="font-weight-bold mb-2"><?php echo __("Default Message","premiumpress"); ?></label>

<p class="text-muted"><?php echo __("This text is displayed to users who have logged in more than 5 times","premiumpress"); ?></p>

<textarea class="form-control" style="height:100px;" name="admin_values[account_defaulttxt]"><?php echo _ppt('account_defaulttxt'); ?></textarea>

</div>
</div>
 
 
           <div class="row border-bottom  pb-3 pt-2 mb-3">
            <div class="col-md-6">
              <label class="font-weight-bold mb-2"><?php echo __("Account Page Image","premiumpress"); ?></label>
              <p class="text-muted"><?php echo __("Set the background image for the dashboard page.","premiumpress"); ?></p>
            </div>
            <div class="col-md-6">
              <?php

$k=1;
$defaultimg = _ppt('account_bgimg');
?>
              <div>
                <figure>
                  <div class="position-relative">
                  <?php if($defaultimg != ""){ ?>
                    <img data-src="<?php echo _ppt('account_bgimg'); ?>" alt="img" class="img-fluid lazy">
                    <?php } ?>
                  </div>
                </figure>
                <div class="input-group position-relative mt-3">
                  <button type="button"  id="path<?php echo $k; ?>" class="position-absolute account_download_path_select" style="right:10px; top:10px; z-index: 100; font-size: 11px; background:#fff;"> <?php echo __("Select File","premiumpress"); ?></button>
                  <input class="form-control" id="account_download_path<?php echo $k; ?>" name="admin_values[account_bgimg]" value="<?php if(_ppt('account_bgimg') == ""){ }else{ echo _ppt('account_bgimg'); } ?>" />
                </div>
              </div>
              
   </div>  </div>        
              <input type="hidden" value=""  id="account_current_bg_id" />
              <script>

jQuery(document).ready(function() {

var my_original_editor = window.send_to_editor; 

 	jQuery('.account_download_path_select').click(function() {     
	
	var thisid = jQuery(this).attr('id');   
	
			jQuery("#account_current_bg_id").val(thisid);  
           
		   tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
		   
			window.send_to_editor = function(html) {	
			 
			 		
				var regex = /src="(.+?)"/;
				var rslt =html.match(regex);
				 
				var imgrex = /wp-image-(.+?)"/;
				var imgid = html.match(imgrex);
			 
				var imgurl = rslt[1];
				var imgaid = imgid[1];
				 
				jQuery("#account_download_"+jQuery("#account_current_bg_id").val()).val(imgurl); 
				
				tb_remove();
				
				window.send_to_editor = my_original_editor;
			 
			 
			}		   
		   
		   
           return false;
    }); 

}); 
</script>
 

      <div class="p-4 bg-light text-center mt-4">
      <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
    </div>
    
  </div>
</div>
<!-- end admin card -->
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?> 

<?php

 $settings = array(
  
  "title" => __("Display Settings","premiumpress"), 
  "desc" => __("Here you can change the display options in the user accout page.","premiumpress"),
  
	"back" => "overview",

  
  ); 
  
   _ppt_template('framework/admin/_form-wrap-top' ); ?>
   
<div class="card card-admin">
  <div class="card-body">
  
  
<label><?php echo __("Account Display Options","premiumpress"); ?></label>
<div class="row no-guttersx px-0 mt-2">
    
<?php 
 
foreach($g as $k => $f ){ ?>
        <div class="col-md-6">
        <label class="custom-control custom-checkbox"> 
        
        <input type="checkbox" 
        value="1" 
        class="custom-control-input" 
        id="user_<?php echo $k; ?>check" 
        onchange="ChekSeF('#user_<?php echo $k; ?>');"
         
		<?php if( in_array(_ppt(array('user', $k)), array("","1")) ){ ?>checked=checked<?php } ?>> 
        
          <input type="hidden" name="admin_values[user][<?php echo $k; ?>]" id="user_<?php echo $k; ?>add" value="<?php if( in_array(_ppt(array('user', $k)), array("","1")) ){ echo 1; }else{ echo 0; } ?>"> 
       
      	<span class="custom-control-label"><?php echo $f['name']; ?></span>
        </label>
        </div>
<?php  } ?>
</div>


        <script>
		function ChekSeF(div){
		
			if (jQuery(div+'check').is(':checked')) {			
				jQuery(div+'add').val(1);			
			}else{			
				jQuery(div+'add').val(0);
			}
		
		}
		</script>  
        
        
        

<hr />
  
<?php

// COUNTRY LIST
$countrylist = array();
foreach ($GLOBALS['core_country_list'] as $key=>$option) {
$countrylist[$key] = array("id" => $key , "name" => $option);
} 

$g = array(

 "account_usercountry" => array(
		 
			 "name" => __("Default Country","premiumpress"),  
			 "desc" => __("Select a default display country for users.","premiumpress"), 
			 "type" => "select", 
			 "values" => $countrylist, 
		 ),


);
foreach ($g as $fieldkey => $fielddata){ echo $CORE_ADMIN->LoadCongifField($fielddata, $fieldkey, "user"); }
?> 
        
        
        
        

      <div class="p-4 bg-light text-center mt-4">
      <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
    </div>
    
  </div>
</div>
<!-- end admin card -->
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?> 