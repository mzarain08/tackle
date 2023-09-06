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
 
 
global $settings, $CORE_ADMIN, $CORE, $CORE_UI;


  $settings = array(
  
  "title" => __("Auto Generated Ads","premiumpress"), 
  
  "desc" => __("The theme will auto create new ads when an event happens. Ads will last 1 hour and then delete themselves.","premiumpress"),  
   
  "back" => "overview",

  
  );    
  
  _ppt_template('framework/admin/_form-wrap-top' ); 
  
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
  
 $g = array(

 
	/*
	 "msg" => array(
		 
			 "name" => __("New Message Notifications","premiumpress"), 
			 "desc" => __("Turn on/off user notifications when they get a new message.","premiumpress"), 
			 "type" => "yesno", 
			 "d" => 1,
			 "col8" => true 
		 ),	
		*/ 
		 
	 "login" => array(
		 
			 "name" => __("User Login","premiumpress"), 
			 "desc" => __("Auto create user login notifications.","premiumpress"), 
			 "type" => "yesno", 
			 "d" => 0,
			 "col8" => true 
		 ),	
		 
		 
	 "logout" => array(
		 
			 "name" => __("User Logout","premiumpress"), 
			 "desc" => __("Auto create user logout notifications.","premiumpress"), 
			 "type" => "yesno", 
			 "d" => 0,
			 "col8" => true 
		 ),	
		 
		 
		 
	 "upgrade" => array(
		 
			 "name" => __("User Upgraded","premiumpress"), 
			 "desc" => __("Auto create user account upgrade notifications.","premiumpress"), 
			 "type" => "yesno", 
			 "d" => 0,
			 "col8" => true 
		 ),	 
  
); 
  
  
  ?>
   
<div class="card card-admin">
  <div class="card-body">
  
  
  <?php foreach ($g as $fieldkey => $fielddata){ echo str_replace("border-bottom","",$CORE_ADMIN->LoadCongifField($fielddata, $fieldkey, "liveads")); }; ?>

  
      <div class="p-4 bg-light text-center mt-4">
      <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
    </div>
    
  </div>
</div>
<!-- end admin card --> 

 

<?php _ppt_template('framework/admin/_form-wrap-bottom' );
  
  
  
  $settings = array(
  
  "title" => __("Guest Popups","premiumpress"), 
  
  "desc" => __("Custom pop-ups are randomly selected and displayed to visitors only.","premiumpress"),  
   
  "back" => "overview",

  
  );    
  
  _ppt_template('framework/admin/_form-wrap-top' ); 
  
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
  
 $g = array(

 
	 
	 "guests" => array(
		 
			 "name" => __("Enable Guest Popups","premiumpress"), 
			 "desc" => __("Turn on/off the guest popup system.","premiumpress"), 
			 "type" => "yesno", 
			 "d" => 1,
			 "col8" => true 
		 ),	
		 
		 
	  
  
);  
 
  ?>
   
<div class="card card-admin">
  <div class="card-body">
  
  
  <?php foreach ($g as $fieldkey => $fielddata){ echo str_replace("border-bottom","",$CORE_ADMIN->LoadCongifField($fielddata, $fieldkey, "liveads")); }; ?>
 



<?php


$data = array(
	
	1 => array(
		"title" => "<strong>Gemma</strong> has just logged in! Say Hello.",
		"img"	=> "https://premiumpress1063.b-cdn.net/_demoimagesv10/popups/es/1.png",
		"link"	=> "",
	),
	2 => array(
		"title" => "<strong>Sammy</strong> has updated her photo. Do you like it?",
		"img"	=> "https://premiumpress1063.b-cdn.net/_demoimagesv10/popups/es/2.png",
		"link"	=> "",
	), 
	3 => array(
		"title" => str_replace("%s", strtolower($CORE->LAYOUT("captions","1")),"<strong>Mark</strong> has just created a new %s. Take a look."),
		"img"	=> "https://premiumpress1063.b-cdn.net/_demoimagesv10/user/1.jpg",
		"link"	=> "",
	),
	4 => array(
		"title" => "<strong>James</strong> bought the Gold Membership. <small>34 mins ago.</small>",
		"img"	=> "https://premiumpress1063.b-cdn.net/_demoimagesv10/user/2.jpg",
		"link"	=> "",
	),
);

 $i=1; while($i < 5){ 
 
 $title = _ppt(array('liveads','g'.$i.'_title'));
 $img 	= _ppt(array('liveads','g'.$i.'_img'));
 $link 	= _ppt(array('liveads','g'.$i.'_link'));
 
 if($title == "" && isset($data[$i])){
 
	$title 	= $data[$i]["title"];
	$img 	= $data[$i]["img"];
	$link 	= $data[$i]["link"];	
 }
 
 
 ?>
<div class="row mt-4">

    <div class="col-md-2">
    
    
     <?php
	 
	 if(strlen($img) > 1){
	 
	 
	  $r = rand(15434,1999);
	  
	  echo $CORE_UI->IMAGES("image", array("size" => "xxs", "src" => $img, "css" => "rounded mx-2 force", "link"=> 0,"pid" => $r));
	  ?>
      
      
      <?php
	  }
	  
	  ?>
      
      
<button type="button" onclick="NewsPreview(<?php echo $i; ?>);" class="btn btn-system"><?php echo __("Preview","premiumpress"); ?></button>
    
    </div>
    
    <div class="col-md-10">
    
    <input type="text" class="form-control <?php echo $i; ?>_title" name="admin_values[liveads][g<?php echo $i; ?>_title]" placeholder="Display caption here..." value="<?php echo $title; ?>" />
    
     <input type="text" class="form-control mt-2 <?php echo $i; ?>_img" name="admin_values[liveads][g<?php echo $i; ?>_img]" placeholder="Image Path: http://..." value="<?php echo $img; ?>" />
     
     <input type="text" class="form-control mt-2" name="admin_values[liveads][g<?php echo $i; ?>_link]" placeholder="Clicked Link: http://..." value="<?php echo $link; ?>" />
   
    </div> 

</div>
<?php $i++; } ?>

<script>
 

function NewsPreview(id){
 
	jQuery("#ppt-notice-new-custom").find("._username").html(jQuery("."+id+"_title").val());
	jQuery("#ppt-notice-new-custom").find(".bg-image").css("background-image", "url(" + jQuery("."+id+"_img").val() + ")");	
 
	var r = jQuery("#ppt-notice-new-custom").html();
	pptModal("notice-new-custom", r, "modal-bottom-right", "ppt-animate-bouncein w-700", 1);
 

}
</script>

      <div class="p-4 bg-light text-center mt-4">
      <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
    </div>
    
  </div>
</div>
<!-- end admin card --> 

 
  <?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?>