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

global $CORE, $settings, $CORE_UI;

$settings = array(

"title" => __("Ad Details","premiumpress"), 

"desc" =>__("Here you can add/edit a live ad.","premiumpress"),

"back" => "overview",

); 

_ppt_template('framework/admin/_form-wrap-top' ); ?>

<div class="card card-admin">
  <div class="card-body">
  
    <form method="post" action="" enctype="multipart/form-data">
      <input type="hidden" name="popupid" value="<?php if(isset($_GET['eid']) && is_numeric($_GET['eid'])){ echo esc_attr($_GET['eid']); }else{ echo 1; }  ?>" />      
      <div class="row">
	  <?php
	  
	  $eid = "";
	  if(isset($_GET['eid']) && is_numeric($_GET['eid']) ){
	  $eid = $_GET['eid'];
	  }	  
	  
	  $fields = $CORE->ADVERTISING("popup_fields", array()); 
	  foreach( $fields as $k => $f){ 
	  
	  echo $CORE_UI->FIELD(array("popup",$k), $f, $eid);
	  
	  } ?> 
      </div>
      
      <div class="p-4 bg-light text-center mt-4">
        <button type="submit" data-ppt-btn class="btn-primary"> <?php echo __("Save Changes","premiumpress"); ?></button>
      </div>
    </form>
    
    
 

<div class="mt-5">


<div class="mt-4 mb-3 tiny text-uppercase opacity-5"><?php echo __("Example Popup","premiumpress"); ?></div>

<div class="card-notice-container">
    <div class="card-notice _reverse _visible shadow-sm">
      <div class="card card-notice _reverse _visible ">
      
        <div class="card-body">
          <div class="d-flex">
            <div>
              <div style="height:50px; width:50px;" class="rounded bg-light mr-4 position-relative">
                <div class="bg-image rounded visible" data-bg="https://premiumpress1063.b-cdn.net/_demoimagesv10/user/1.jpg">
                </div>
              </div>
            </div>
            <div class="_msg_login" style="display: block;"><a href="#" class="_link"><strong class="_username">John Doe</strong><br /> Has just logged in.</a></div>
             
            
          </div>
        </div>
  
      </div>
    </div>
  </div>

</div>

    
  </div>
</div>

<script>

 
jQuery( document ).ready(function() { 
 
jQuery("#field_popup_type").on("change", function (e) {
 
 	jQuery(".field_wrap_popup_title").hide();
 	jQuery(".field_wrap_popup_image").hide();
	jQuery(".field_wrap_popup_link").hide();
 	jQuery(".field_wrap_popup_userid").hide();
	
	if(jQuery(this).val() == 1){
	
 	jQuery(".field_wrap_popup_title").show();
 	jQuery(".field_wrap_popup_image").show();
	jQuery(".field_wrap_popup_link").show();
	
	} else {
	jQuery(".field_wrap_popup_userid").show();
	} 

});  

}); 
</script>

<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?>
