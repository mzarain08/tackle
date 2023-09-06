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

global $CORE, $CORE_UI;


if(isset($_GET['eid']) && $_GET['eid'] > 0){



?>

<div id="ajax_response_msg" class="text-600"></div>


<ul class="d-md-flex justify-content-between">  

<li >

<div class="d-flex mobile-mb-2">
<a href="#user-avatar" onclick="jQuery('#user-avatar .ppt-accordion').addClass('show');jQuery('#user-avatar .ppt-accordion > .d-flex').hide(); jQuery('#user-avatar .ppt-accordion > .d-flex').hide();" class="text-dark">
	<?php echo $CORE_UI->AVATAR("user", array("size" => "md", "uid" => $_GET['eid'], "css" => "rounded", "online" => 0, "link" => 0)); ?>
</a>
<div class=" ml-3">
	<div class="fs-md text-600"><?php echo $CORE->USER("get_username",$_GET['eid']); ?></div>
    <div class="fs-sm opacity-5"><?php echo $CORE->USER("get_display_name",$_GET['eid']); ?></div>
</div>
</div>
 
</li>
 
 
 


<li class="ml-auto">

<nav ppt-nav class="sepetator">
<ul>

<?php if( THEME_KEY == "dt" && isset($_GET['eid']) && in_array(_ppt(array('design','display_claim')), array("","1")) &&  get_user_meta($_GET['eid'], "claimed", true ) != "" ){ ?>
<li>
    
  <a href="javascript:void(0);" onclick="jQuery('#claimbox').toggle();"  class="btn-warning text-600" data-ppt-btn>
  <?php echo __("Claimed","premiumpress"); ?>
    </a> 
</li>
<?php } ?>


    <li>
    <?php if($CORE->USER("get_verified", $_GET['eid'])){ ?>
    <a href="#user-verify" onclick="jQuery('#user-verify .ppt-accordion').addClass('show');jQuery('#user-verify .ppt-accordion > .d-flex').hide();" class="btn-success text-600" data-ppt-btn>
        <div class="d-flex">
            <div ppt-flex-middle><div ppt-icon-20 data-ppt-icon-size="20" class="mr-2 mt-n1"><?php echo $CORE_UI->icons_svg['verified']; ?></div></div> 
            <div ppt-flex-middle><?php echo __("Verified","premiumpress"); ?></div> 
        </div> 
    </a>
    <?php }else{ ?>
    <a href="#user-verify"  onclick="jQuery('#user-verify .ppt-accordion').addClass('show');jQuery('#user-verify .ppt-accordion > .d-flex').hide();" class="btn-warning text-600" data-ppt-btn>
        <div class="d-flex">
            <div ppt-flex-middle><div ppt-icon-20 data-ppt-icon-size="20" class="mr-2 mt-n1"><?php echo $CORE_UI->icons_svg['not-verified']; ?></div></div> 
            <div ppt-flex-middle><?php echo __("Not Verified","premiumpress"); ?></div> 
        </div> 
    </a>
    <?php } ?>
     
    </a> 
    </li> 


    <li class="hide-mobile">
   
    
        <div class="badge_tooltip text-center z-10" data-direction="left">
        <div class="badge_tooltip__initiator"> 
                            
 <a href="javascript:void(0);" onclick="jQuery('#adminedit').toggle();"  class="btn-system text-600" data-ppt-btn>
    <div ppt-icon-16 data-ppt-icon-size="16"><?php echo $CORE_UI->icons_svg['email']; ?></div>  
    </a> 
                            
        </div>
            <div class="badge_tooltip__item"><?php echo __("Send Email","premiumpress"); ?></div>
        </div> 
    
    </li> 

 
    <li class="hide-mobile">
    
        <div class="badge_tooltip text-center z-10" data-direction="left">
        <div class="badge_tooltip__initiator"> 
                            
    <a href="user-edit.php?user_id=<?php echo esc_attr($_GET['eid']); ?>" class="btn-system text-600" data-ppt-btn target="_blank">
    <div ppt-icon-16 data-ppt-icon-size="16"><?php echo $CORE_UI->icons_svg['wordpress']; ?></div>
    </a>                    
        </div>
            <div class="badge_tooltip__item"><?php echo __("WordPress Editor","premiumpress"); ?></div>
        </div> 
    
    </li>

    <li class="hide-mobile">
    
        <div class="badge_tooltip text-center z-10" data-direction="left">
        <div class="badge_tooltip__initiator"> 
                            
        <a href="<?php echo $CORE->USER("get_user_profile_link", $_GET['eid'] ); ?>" class="btn-system text-dark" data-ppt-btn target="_blank">
        <div ppt-icon-16 data-ppt-icon-size="16"><?php echo $CORE_UI->icons_svg['user-circle']; ?></div>
        </a>
                            
        </div>
            <div class="badge_tooltip__item"><?php echo __("View Public Profile","premiumpress"); ?></div>
        </div> 
    
    </li>

    <li><a href="javascript:void(0);" onclick="ajax_delete_user('<?php echo $_GET['eid']; ?>')" class="btn-danger text-600" data-ppt-btn><?php echo __("Delete","premiumpress"); ?></a>  </li>
</li>
</ul> 
</li>    
  
</ul>
</nav> 


<hr />
<nav ppt-nav class="fs-sm">
<ul>
<li> 
    <div class="d-flex">
        <div ppt-flex-middle><div ppt-icon-20 data-ppt-icon-size="20" class="mr-2 mt-n1"><?php echo $CORE_UI->icons_svg['calendar']; ?></div></div> 
        <div ppt-flex-middle><?php echo $CORE->USER("get_joined", $_GET['eid']); ?></div> 
    </div> 

</li>

<li> 
    <div class="d-flex">
        <div ppt-flex-middle><div ppt-icon-20 data-ppt-icon-size="20" class="mr-2 mt-n1"><?php echo $CORE_UI->icons_svg['clock']; ?></div></div> 
        <div ppt-flex-middle><?php echo __("Online","premiumpress"); ?> <?php echo $CORE->USER("get_lastlogin", $_GET['eid']); ?></div> 
    </div> 

</li>


<li> <a href="admin.php?page=orders&uid=<?php echo $_GET['eid']; ?>" class="text-dark">
    <div class="d-flex">
        <div ppt-flex-middle><div ppt-icon-20 data-ppt-icon-size="20" class="mr-2 mt-n1"><?php echo $CORE_UI->icons_svg['cart']; ?></div></div> 
        <div ppt-flex-middle><?php echo $CORE->ORDER("count_invoices_by_userid", $_GET['eid']); ?> <?php echo __("Orders","premiumpress"); ?> </div> 
    </div> 
</a>
</li>

<?php if( $CORE->LAYOUT("captions","listings") ){ 

	$data = $CORE->USER("count_user_listings", $_GET['eid']);
 
 ?>
<li> <a href="admin.php?page=listings&uid=<?php echo $_GET['eid']; ?>" class="text-dark">
    <div class="d-flex">
        <div ppt-flex-middle><div ppt-icon-20 data-ppt-icon-size="20" class="mr-2 mt-n1"><?php echo $CORE_UI->icons_svg['clipboard-check']; ?></div></div> 
        <div ppt-flex-middle><?php echo $data['total']." ".$CORE->LAYOUT("captions","2"); ?></div> 
    </div> 
    </a>

</li>
<?php } ?>
 
              
<?php

$duedate = get_user_meta($_GET['eid'], "deleteme", true); 
if(strlen($duedate) > 0){ 

?>
<li class="deletemealert"> 


       <div class="badge_tooltip text-center z-10" data-direction="left">
        <div class="badge_tooltip__initiator"> 
                            
<a href="#user-deleteaccount"  onclick="jQuery('#user-deleteaccount .ppt-accordion').addClass('show');jQuery('#user-deleteaccount .ppt-accordion > .d-flex').hide();" class="text-dark">
    <div class="d-flex text-danger">
        <div ppt-flex-middle><div ppt-icon-20 data-ppt-icon-size="20" class="mr-2 mt-n1"><?php echo $CORE_UI->icons_svg['trash']; ?></div></div> 
        <div ppt-flex-middle><?php echo $duedate; ?></div> 
    </div> 
    </a>                 
        </div>
            <div class="badge_tooltip__item"><?php echo __("User requested account deletion.","premiumpress"); ?><hr /><?php echo $duedate; ?></div>
        </div> 





</li>

<?php }



//if(_ppt(array('mem','enable')) == "1" ){			
				
$mem = $CORE->USER("get_user_membership", $_GET['eid']); 	

//print_r($mem);


			 
?>

<li class="ml-auto"> 
<a href="#user-membership"  onclick="jQuery('#user-membership .ppt-accordion').addClass('show');jQuery('#user-membership .ppt-accordion > .d-flex').hide(); " class="text-dark">

<?php if(!empty($mem) && $mem['expired'] == 0){  ?>
    <div class="d-flex">
        <div ppt-flex-middle><div ppt-icon-20 data-ppt-icon-size="20" class="mr-2 mt-n1"><?php echo $CORE_UI->icons_svg['star']; ?></div></div> 
        <div ppt-flex-middle><?php echo $mem['name']; ?></div> 
    </div> 
<?php }else{ ?>
<?php echo __("No Membership","premiumpress"); ?>
<?php } ?>
</a>
</li>

<?php
 
//}
?>


</ul>
</nav>
 
<?php } ?>








  
  
  
  
<?php 


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////



if( THEME_KEY == "dt" && isset($_GET['eid']) && in_array(_ppt(array('design','display_claim')), array("","1")) &&  get_user_meta($_GET['eid'], "claimed", true ) != "" ){

$c = get_user_meta($_GET['eid'], "claimed", true ); 

 ?>
<div id="claimbox" style="display:none;">   
 
 <hr>   
    
<div class="row"> 
    <div class="col-md-5">    
    <div class="fs-5 text-600"><?php echo __("Claimed Listing","premiumpress"); ?></div>   
        <div class="fs-7 mt-3 pr-lg-5 opacity-5"></div> 
        </div>
    <div class="col-md-7">
    
        <div ppt-border1="" class="p-3">
        
                     <?php echo __("This user has claimed the listing ","premiumpress"); ?>
             
            <span class="text-600"><a href="<?php echo get_permalink($c); ?>" target="_blank"><?php echo get_the_title($c); ?></a></span>
             
 <hr />
 <a href="javascript:void(0)" onclick="resetClaim();" class="btn btn-primary" data-ppt-btn><?php echo __("Reset Claim","premiumpress"); ?></a>
        </div>
    </div> 
</div> 

 


 

<script>
function resetClaim(){
 										   
 	
jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',	
		dataType: 'json',	
		data: {
            single_action: "single_claimlisting_reset",
			uid: "<?php echo $_GET['eid']; ?>",
			pid: "<?php echo $c; ?>",
			 		
        },
        success: function(response) {
 
			if(response.status == "ok"){
			
			jQuery('.clreset').show(); 
			 jQuery('.clrinfo').hide(); 
			 
			 alert("Reset Successful. Refresh the page.");			 
  		 	
			}else{			
		 			
			}			
        },
        error: function(e) {
            console.log(e)
        }
    });	
 		
}
</script>
</div>

<?php 


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


} ?>  












<?php

if(isset($_GET['eid']) && is_numeric($_GET['eid']) ){ 
 

?>
<div id="adminedit" style="display:none">

    
    <div class="row">
    <div class="col-md-5" ppt-flex-middle>
    
    
     
    <a href="javascript:void(0);" onClick="processMessage(<?php echo $_GET['eid']; ?>);" data-ppt-btn class="btn-primary btn-lg"> <span><?php echo __("Private Message","premiumpress"); ?></span> </a>
    
    
    </div> 
 
    <div class="col-md-7">
  

	<div class="w-100">
	<div ppt-box class="rounded">
	<div class="_header" ppt-flex-row>
	<div class="_title"><?php echo __("Email User","premiumpress"); ?></div>

	<div class="_close">
    <div ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['smile']; ?></div>
    </div>
    </div>

	<div class="_content py-3 ppt-forms style3" id="pending_message_box">
    
    
<div class="mb-3"><?php echo __("Use this form to send a quick email to the user.","premiumpress"); ?></div>

<input type="text" name="" id="pending_subject" class="form-control mb-2" placeholder="<?php echo __("Email Subject Title","premiumpress"); ?>" value="" />
<textarea style="height:150px;" id="pending_message" name="custom[approval_message]" class="w-100 form-control" placeholder="<?php echo __("Message displayed to the user.","premiumpress"); ?>"><?php echo get_post_meta($_GET['eid'],'approval_message',true); ?></textarea>
 

    
    </div>

	<div class="_footer small border-top py-2 text-center">
    
    <button type="button" onclick="ajax_send_pending()" class="mb-2 btn btn-dark mt-2"><?php echo __("Send Email","premiumpress"); ?></button>
    
    </div>
</div>



 
<script>

function ajax_send_pending(){
 
if(jQuery('#pending_subject').val() == ""){
jQuery('#pending_subject').focus();
alert("<?php echo __("Please enter a valid email subject title.","premiumpress"); ?>");
}else{
jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',	
		dataType: 'json',	
		data: {
            admin_action: "send_pending_msg",
			uid: '<?php echo get_post_field( 'post_author', $_GET['eid']); ?>',
			subj: jQuery('#pending_subject').val(),
			msg: jQuery('#pending_message').val(),
        },
        success: function(response) {
  
			if(response.status == "ok"){
			 
  		 		jQuery("#pending_message_box").html("<div class='alert alert-success text-center'><?php echo __("Message Sent","premiumpress"); ?></div>");
			}else{			
				 		
			}			
        },
        error: function(e) {
            console.log(e)
        }
    });
}	
}// end are you sure

</script>
 


    </div>
    </div> 
</div>
</div>
<hr />

<?php } ?>




 

<form method="post" action=""  onsubmit="return ppt_validate_new_user();" id="postid-<?php echo $_GET['eid']; ?>" class="user_form">
<input type="hidden" name="edituserid" value="<?php if(isset($_GET['eid']) && is_numeric($_GET['eid'])){ echo esc_attr($_GET['eid']); }else{ echo 0; }?>" />
   
<?php

$fields = ppt_user_fields();

foreach($fields as $k => $v){

$showHide = 0;
if(isset($v['hide']) && $v['hide'] == 1){
$showHide = 1;
}
if(isset($_GET['eid']) && $_GET['eid'] > 0){
$showHide = 1; 
}
?>


<div id="user-<?php echo $k; ?>">   
 
<?php if($showHide){ ?> 
<div class="ppt-accordion" style="cursor:pointer;"> 
 
<div class="d-flex flex-row border-top p-3 py-lg-4">
  <div class="w-100" ppt-flex-between>
    <div class="w-100 btn-show">
      <div class="fs-6 text-600 ">
      <?php echo $v['title']; ?>
      </div>
    </div>
    <div ppt-icon-32 class="hide-show btn-show">
      <?php echo $CORE_UI->icons_svg['add']; ?>
    </div>
     <div ppt-icon-32 class="show-hide btn-show">
      <?php echo $CORE_UI->icons_svg['close']; ?>
    </div>
  </div>
</div>


<div class="hide border-top p-3">   
<?php } ?>    
    
<div class="row"> 
    <div class="col-md-5">    
    <div class="fs-5 text-600"><?php echo $v['title']; ?></div>   
    <?php if(isset($v['desc']) && strlen($v['desc']) > 1){ ?>
    <div class="fs-7 mt-3 pr-lg-5 opacity-5"><?php echo $v['desc']; ?></div> 
    <?php } ?>
    </div>
    <div class="col-md-7">
    
        <div ppt-border1 class="p-3">
        
            <div class="row">
                <?php
                if(isset($v['fields'])){
                    
                    foreach($v['fields'] as $fk => $f){ ?>
                    
                    <?php if(!in_array($f['type'],array("hidden"))){ ?>
                    
                    <div class="<?php if(in_array($f['type'],array("textarea","membership","customfields","backgroundimg","deleteaccount"))){ ?>col-md-12<?php }else{ ?>col-md-6<?php } ?> py-2">
                    
                     
                    <?php if(!in_array($f['type'],array("deleteaccount"))){ ?>
                   
                   <div ppt-flex-between>
                    
                    <label><?php echo $f['title']; ?></label>
                    
					<?php if(isset($f['info'])){ ?>
                    
                   <div class="badge_tooltip text-center z-10" data-direction="top">
                    <div class="badge_tooltip__initiator">  <div ppt-icon-16 data-ppt-icon-size="16"><?php echo $CORE_UI->icons_svg['info-circle']; ?></div> </div>
                    <div class="badge_tooltip__item"><?php echo $f['info']; ?></div>
                  </div>
                    
                    <?php } ?>
                    
                    
                    </div>
					<?php } ?>
                    
                    <?php } ?>
					
					<?php
                    
                    $f['key'] = $fk;
                     
                    echo $CORE_UI->FIELD_USER($f);
                    
                    ?>
                    
                    <?php if(!in_array($f['type'],array("hidden"))){ ?></div><?php } ?>
                    
                    <?php
                    
                    }
                } 
            
          ?> 
            </div>
        
        <?php if($showHide && !in_array($f['type'],array("deleteaccount"))){ ?>
        <button type="submit" data-ppt-btn class="btn-primary mt-3"><?php echo __("Save Settings","premiumpress"); ?></button>
        <?php } ?>     
        
        </div>
    </div> 
</div> 

<?php if($showHide){ ?> 


</div></div>
<?php } ?>
<?php if(!$showHide){ ?> 
<hr />
<?php } ?>

</div>

<?php   }    ?>

<div class="p-4 bg-light text-center ">
	<button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
</div>
 

</form>
<?php
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
?>
<script>
function ppt_validate_new_user(){

	result = ppt_form_validation('.user_form');	
	if(result == 0){
	
		alert("<?php echo __("Please complete all required fields.","premiumpress"); ?>");
		
		 
		
			var a = jQuery(".hasTrigger");
			a.each(function (a) {
			jQuery(this).addClass("show");
			});
		
		
		jQuery("html, body").animate({ scrollTop: 0 }, "slow");			
		return false;
	}	
	return true;
}

</script>