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
  
  "title" => __("User Profile Page","premiumpress"), 
  "desc" => __("Here you can turn on/off display options on the default WordPress author pages.","premiumpress"),
  
	"back" => "overview",

  
  );
   _ppt_template('framework/admin/_form-wrap-top' ); ?>
  
   
<div class="card card-admin">
  <div class="card-body">
<?php
  
$g = array(

"allow_profile" => array(
		 
			 "name" => __("Profile Pages","premiumpress"), 
			 "desc" => __("Turn OFF to prevent users from accessing the WordPress author page","premiumpress"), 
			 "type" => "yesno", 
			 "d" => "1",
			  "col8" => true 
		 ),	
		 
		  
		 
	
		 "author_links" => array(
		 
			 "name" => __("User Website Links","premiumpress"), 
			 "desc" => __("Turn OFF to hide the users personal website button.","premiumpress"), 
			 "type" => "yesno", 
			 "d" => "1",
			  "col8" => true 
		 ),	
		 	 /*
		 "author_comments" => array(
		 
			 "name" => __("Author Comments","premiumpress"), 
			 "desc" => __("Turn OFF to hide comment display on the author profile page.","premiumpress"), 
			 "type" => "yesno", 
			 "d" => "1",
			  "col8" => true 
		 ),
		 
		 "author_ads" => array(
		 
			 "name" => __("Author Ads","premiumpress"), 
			 "desc" => __("Turn OFF to hide ads display on the author profile page.","premiumpress"), 
			 "type" => "yesno", 
			 "d" => "1",
			  "col8" => true 
		 ),	 
		 
		 "author_reputation" => array(
		 
			 "name" => __("Author Reputation","premiumpress"), 
			 "desc" => __("Turn OFF to hide the reputation display on the author profile page.","premiumpress"), 
			 "type" => "yesno", 
			 "d" => "1",
			 "col8" => true 
		 ),*/

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

<?php  

if(in_array(THEME_KEY,array("cp","da"))){

}elseif( $CORE->LAYOUT("captions","listings") ){ 

 
  $settings = array(
  "title" => __("Background Images","premiumpress"), 
  "desc" => __("Here you can set your own background images for users accounts.","premiumpress")."<br>(1150px / 300px)",
   );
   
   _ppt_template('framework/admin/_form-wrap-top' ); ?>
<div class="card card-admin">
  <div class="card-body">
    <!-- ------------------------- -->
    <div class="container px-0 border-bottom mb-3">
      <div class="row py-2">
        <div class="container">
          <div class="row">
            <?php

$lst_backgrounds = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14);


foreach($lst_backgrounds as $k ){

	$defaultimg = DEMO_IMG_PATH."backgroundimages/".$k.".jpg";
 
?>
            <div class="col-md-6 text-center p-2">
              <figure>
                <div class="position-relative"> 
                
                <img data-src="<?php if(_ppt(array('bgimg', $k)) == ""){ echo $defaultimg; }else{ echo _ppt(array('bgimg', $k )); } ?>" alt="img" class="img-fluid lazy"> 
                
                </div>
              </figure>
              <div class="input-group position-relative">
                <button type="button"  id="path<?php echo $k; ?>" class="position-absolute download_path_select" style="right:10px; top:10px; z-index: 1; font-size: 11px; background:none !important;"><?php echo __("Select File","premiumpress"); ?></button>
                <input class="form-control" id="download_path<?php echo $k; ?>" name="admin_values[bgimg][<?php echo $k; ?>]" value="<?php if(_ppt(array('bgimg', $k)) == ""){ }else{ echo _ppt(array('bgimg', $k )); } ?>" />
              </div>
            </div>
            <?php } ?>
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
          </div>
        </div>
      </div>
    </div> 
    
    <div class="p-4 bg-light text-center mt-4">
      <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
    </div>
  </div>
</div>
<?php _ppt_template('framework/admin/_form-wrap-bottom' );  ?>
<?php } ?>

 