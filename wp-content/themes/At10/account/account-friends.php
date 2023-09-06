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

global $CORE, $CORE_UI, $userdata;

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 
$followers = $CORE->USER("get_subscribers_followingme", $userdata->ID);
$followersCount = count($followers);

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$blocked = $CORE->USER("get_blocked", $userdata->ID);
$blockedCount = count($blocked); 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$friends = $CORE->USER("get_subscribers_followers", $userdata->ID);
$friendCount = count($friends);

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 
?>

<div class="fs-lg text-600 mb-4"><?php echo __("My Friends","premiumpress"); ?></div>

     
<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
?>

<div class="col-md-4 px-0 mb-4">
<select class="form-control" onchange="showlists(this.value);">

<option value="friends"><?php echo __("My Friends","premiumpress") ?></option>
<option value="followers"><?php echo __("My Followers","premiumpress") ?></option>
<option value="blocked"><?php echo __("Blocked","premiumpress") ?></option>

 

</select>
</div>
 

<?php 


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
?>
<div class="mylist mylist-friends">

  <div class=" no-msg" style="display:none;">   
  <div class="opacity-5"><?php echo __("You have not added any friends yet.","premiumpress") ?></div>  
  </div>
  

<?php if(count($friends) > 0){ ?>

 
<?php foreach($friends  as $g){ 
 
 $plink = $CORE->USER("get_user_profile_link", $g);
 $name = $CORE->USER("get_username", $g);
 if($name == ""){ $friendCount--; continue; }
 
 ?>

<div ppt-border1 class="p-3 friendcard">
 
 <div class="d-flex">
 
      <div style="width:150px;" class="hide-mobile">
      
        <div style="height:60px; width:60px;" class="bg-light rounded position-relative overflow-hidden">
       
         	<?php echo $CORE_UI->AVATAR("user", array("size" => "xxl", "uid" => $g, "css" => "", "online" => 1)); ?> 
            
         </div>
       
      </div>
      <div class="w-100 mx-3" ppt-flex="">
      
        <div class="text-600 fs-5">  <a href="<?php echo $plink; ?>" class="text-dark text-decoration-none"><?php echo $name; ?></a> </div>
        
        <div class="fs-sm mt-2 opacity-5"> <?php echo __("Last Online","premiumpress"); ?> <?php echo $CORE->USER("get_lastlogin", $g); ?></div>
        
      </div>
      <div ppt-flex-between="" ppt-flex-end="">      
        
       <?php echo do_shortcode('[BUTTON_USER type="subscribe" class="btn-system btn-block list" text=1 uid="'.$g.'"]'); ?>
     
      </div>
      
    </div> 
    
</div>
 
 
<?php } ?>
 
<?php } ?>
</div>

<?php
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
?>
<div class="mylist mylist-blocked">

 
 
  <div class="no-msg" style="display:none;">   
 
  <div class="opacity-5"><?php echo __("You have not blocked anyone.","premiumpress") ?></div>   
  </div>
  

<?php if(count($blocked) > 0){ ?>

 
<?php foreach($blocked  as $g){ 
 
 $plink = $CORE->USER("get_user_profile_link", $g);
 $name = $CORE->USER("get_username", $g);
 if($name == ""){ $friendCount--; continue; }
 
 ?>
 
 

<div ppt-border1 class="p-3 friendcard">
 
 <div class="d-flex">
 
      <div style="width:150px;" class="hide-mobile">
      
        <div style="height:60px; width:60px;" class="bg-light rounded position-relative overflow-hidden">
       
         	<?php echo $CORE_UI->AVATAR("user", array("size" => "xxl", "uid" => $g, "css" => "", "online" => 1)); ?> 
            
         </div>
       
      </div>
      <div class="w-100 mx-3" ppt-flex="">
      
        <div class="text-600 fs-5">  <a href="<?php echo $plink; ?>" class="text-dark text-decoration-none"><?php echo $name; ?></a> </div>
        
        <div class="fs-sm mt-2 opacity-5"> <?php echo __("Last Online","premiumpress"); ?> <?php echo $CORE->USER("get_lastlogin", $g); ?></div>
        
      </div>
      <div ppt-flex-between="" ppt-flex-end="">      
        
       <?php echo do_shortcode('[BUTTON_USER type="block" class="btn-system btn-block list" text=1 uid="'.$g.'"]'); ?>
     
      </div>
      
    </div> 
    
</div>
 
 
<?php } ?>
 
<?php } ?>
</div> 

<?php
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
?>
<div class="mylist mylist-followers">

  <div class="no-msg" style="display:none;">   
 
  <div class="opacity-5"><?php echo __("You have no fans yet.","premiumpress") ?></div>   
  </div>
  

<?php if(count($followers) > 0){ ?>

 
<?php foreach($followers as $g){ 
 
 $plink = $CORE->USER("get_user_profile_link", $g);
 $name = $CORE->USER("get_username", $g);
 if($name == ""){ $friendCount--; continue; }
 
 ?>

<div ppt-border1 class="p-3 friendcard">
 
 <div class="d-flex">
 
      <div style="width:150px;" class="hide-mobile">
      
        <div style="height:60px; width:60px;" class="bg-light rounded position-relative overflow-hidden">
       
         	<?php echo $CORE_UI->AVATAR("user", array("size" => "xxl", "uid" => $g, "css" => "", "online" => 1)); ?> 
            
         </div>
       
      </div>
      <div class="w-100 mx-3" ppt-flex="">
      
        <div class="text-600 fs-5">  <a href="<?php echo $plink; ?>" class="text-dark text-decoration-none"><?php echo $name; ?></a> </div>
        
        <div class="fs-sm mt-2 opacity-5"> <?php echo __("Last Online","premiumpress"); ?> <?php echo $CORE->USER("get_lastlogin", $g); ?></div>
        
      </div>
      <div ppt-flex-between="" ppt-flex-end="">      
        
       <?php echo do_shortcode('[BUTTON_USER type="block" class="btn-system btn-block list" text=1 uid="'.$g.'"]'); ?>
     
      </div>
      
    </div> 
    
</div>
<?php } ?>
 
<?php } ?>
</div>
 
 
 
<?php 


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
?>
<script> 


jQuery(document).ready(function(){ 
 
	jQuery(".count-friends").html(jQuery(".mylist-friends .friendcard").length); 
	jQuery(".count-followers").html(jQuery(".mylist-followers .friendcard").length); 
	jQuery(".count-blocked").html(jQuery(".mylist-blocked .friendcard").length); 

	if(jQuery(".mylist-friends .friendcard").length == 0){
	jQuery(".mylist-friends .no-msg").show();
	}
	
	if(jQuery(".mylist-blocked .friendcard").length == 0){
	jQuery(".mylist-blocked .no-msg").show();
	}
	
	if(jQuery(".mylist-followers .friendcard").length == 0){
	jQuery(".mylist-followers .no-msg").show();
	}
	
	showlists('friends');

});
   
   

function ajax_delete_mysubscribers(){
	 
	if(confirm("<?php echo trim(__("Are you sure?","premiumpress")); ?>")) {
	   
		   jQuery.ajax({
			   type: "POST",
			   url: '<?php echo home_url(); ?>/',		
			data: {
				   action: "subscribe_deleteall",
				   uid: "<?php echo $userdata->ID; ?>",
			 
			   },
			   success: function(response) {	
					jQuery('.friendcard').hide();
					jQuery("#mylist-friends .no-msg").show();
			   },
			   error: function(e) {
				   console.log(e)
			   }
		   });
	   
	}
   
}
 
function showlists(type){

	jQuery('.mylist').hide() 
	jQuery('.mylist-'+type).show(); 

}	
</script> 